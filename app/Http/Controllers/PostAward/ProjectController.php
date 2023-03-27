<?php

namespace App\Http\Controllers\PostAward;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Notification\PostAwardNotification;
use App\Http\Controllers\ProjectMonitoringPlanController;
use App\Models\Article;
use App\Models\Config;
use App\Models\Task;
use App\Models\DocumentProject;
use App\Models\ProjectConformity;
use App\Models\ProjectCharter;

use App\Models\DocumentType;
use App\Models\Project;
use App\Models\LinkProject;
use App\Models\ProjectStageMicro;
use App\Models\Staff;
use App\Models\User;
use App\Models\TimelineProject;
use App\Models\WorkGroupRole;
use App\Models\Conformity;
use App\Models\ExternalComitteeState;
use App\Models\ProjectExternalState;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    protected $project_monitoring;
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->project_monitoring = new ProjectMonitoringPlanController();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        switch (Auth::user()->r_id) {
            case 1: // PI user
                $projects = DB::table('p_projects')
                ->select('p_projects.p_id', 'psm_id', 'p_name','pc_start_date', 'pc_end_date', 'p_deadline', 'p_general_budget', 'pc_acronym',  'pc_project_charters.p_target_population','pc_project_charters.p_data_collection_location', 'p_currency', 'pc_pi', 'pc_co_pi', 'p_main_procedure', 's_name')
                ->join('pc_project_charters', 'pc_project_charters.p_id', 'p_projects.p_id')
                ->join('sa_search_area', 'sa_search_area.sa_id', 'p_projects.sa_id')
                ->join('users', 'users.u_id', 'p_projects.u_id')
                ->join('s_staff', 's_staff.s_id', 'users.s_id')
                ->whereNull('p_projects.deleted_at')
                ->whereNull('pc_project_charters.deleted_at')
                ->where('p_projects.u_id', Auth::user()->u_id)
                ->where('p_projects.p_state', "Aprovado")
                // ->groupBy('sa_search_area.sa_name')
                ->orderBy('p_projects.p_id', 'DESC')
                ->get();
                // dd($projects);
                // dd( Auth::user()->u_id);
            break;
            default:
                
                $projects = Project::with("project_charter")
                ->whereNull("deleted_at")
                ->where("psm_id", ">=", 5)
                ->orderBy('p_projects.p_id', 'DESC')
                ->get();

            break;
        }
        // dd($projects); 
        return view('post_award.project_list', [
            'projects'=>$projects,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return "Adicionar campos novos da tbl projeto";
        try{
            $project_old= Project::where("p_id","=",base64_decode($request->project_id))->first();
            Project::where("p_id","=",base64_decode($request->project_id))
                ->update(['updated_at'=>now(),'deleted_at'=>now()]);
            $project = new Project();
            $project->p_id=$project_old->p_id;
            $project->p_name=$project_old->p_name;
            $project->p_description=$project_old->p_description;
            $project->p_submitted_at=$project_old->p_submitted_at;
            $project->p_deadline=$project_old->p_deadline;
            $project->p_budget=$project_old->p_budget;
            $project->p_general_budget=$project_old->p_general_budget;
            $project->p_state=$project_old->p_state;
            $project->u_id=$project_old->u_id;
            $project->created_at=$project_old->created_at;
            $project->psm_id=15;
            $project->p_updated_by=Auth::user()->u_id;
            $project->updated_at=now();
            $project->p_source=$project_old->p_source;
            $project->p_currency=$project_old->p_currency;
            $project->sa_id=$project_old->sa_id;
            $project->p_consortium=$project_old->p_consortium;
            $project->p_acronym=$project_old->p_acronym;
            $project->p_web_url=$project_old->p_web_url;
            $project->p_end_date=$project_old->p_end_date;
            $project->p_reasons=$project_old->p_reasons;
            $project->p_support_document=$project_old->p_support_document;
            $project->save();
            return redirect()->back()->with('success', translate('requisao_submetida_sucesso'));
        } catch (Exception $ex) {
            return redirect()->back()->with('error', translate('erro_tecnico'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = Gate::inspect("isInvestigator");
        if($response->allowed()){

            $project=Project::with('work_group_project','time_line','user_project','documentsProject','work_group_project_stage_two','articles','tasks')
            ->where('p_id','=',base64_decode($id))
            ->first();
            // dd($project);
            //return json_encode($project);
            $investigators=Staff::get();
            $role_group=WorkGroupRole::get();
            $staff = Staff::get();
            $document_types = DocumentType::get();
            $project_stage_micro = ProjectStageMicro::get();
            $documents=  DB::table('dp_document_project') // Busca documento de consortium e Draft protocol
                ->join('psm_project_stage_micro', 'dp_document_project.psm_id', '=', 'psm_project_stage_micro.psm_id')
                ->join('dt_document_type', 'dp_document_project.dt_id', '=', 'dt_document_type.dt_id')
                ->where('dp_document_project.p_id','=', base64_decode($id))
    //            ->where('psm_project_stage_micro.ps_id','=', 2)
                ->where('dt_document_type.dt_id','=', 6)
                ->where('dt_document_type.dt_id','=', 7)
                ->whereNull('dp_document_project.deleted_at')
                ->groupBy('dp_document_project.dp_id')
                ->orderBy('dp_document_project.updated_at', 'DESC')
                ->get();
                // dd($documents);
            $draft=  DB::table('dp_document_project')
                ->join('psm_project_stage_micro', 'dp_document_project.psm_id', '=', 'psm_project_stage_micro.psm_id')
                ->join('dt_document_type', 'dp_document_project.dt_id', '=', 'dt_document_type.dt_id')
                ->where('dp_document_project.p_id','=', base64_decode($id))
    //            ->where('psm_project_stage_micro.ps_id','=', 2)
    //            ->where('dt_document_type.dt_id','=', 6)
                ->where('dt_document_type.dt_id','=', 7)
                ->whereNull('dp_document_project.deleted_at')
                ->groupBy('dp_document_project.dp_id')
                ->orderBy('dp_document_project.updated_at', 'DESC')
                ->first();
            $consortium=  DB::table('dp_document_project')
                ->join('psm_project_stage_micro', 'dp_document_project.psm_id', '=', 'psm_project_stage_micro.psm_id')
                ->join('dt_document_type', 'dp_document_project.dt_id', '=', 'dt_document_type.dt_id')
                ->where('dp_document_project.p_id','=', base64_decode($id))
    //            ->where('psm_project_stage_micro.ps_id','=', 2)
                ->where('dt_document_type.dt_id','=', 6)
    //            ->where('dt_document_type.dt_id','=', 7)
                ->whereNull('dp_document_project.deleted_at')
                ->groupBy('dp_document_project.dp_id')
                ->orderBy('dp_document_project.updated_at', 'DESC')
                ->first();
            $timeline = TimelineProject::with('projectTimeline')
                ->where('p_id', base64_decode($id))
                ->first();
            $project_status= Config::where('c_type','like','task_state')->get();
            // dd($project_status);
            $status_count=[];
            // if(count($project->tasks) > 0){
                foreach ($project_status as $state){
                    $status_count[$state->c_id]=0;
                    foreach ($project->tasks as $task){
                        if ($task->t_state==$state->c_id){
                            $status_count[$state->c_id]=$status_count[$state->c_id]+1;
                        }
                    }
                }
            // }
            $ur_document = DocumentProject::where('p_id',base64_decode($id))->where('psm_id', 9)->first(); // documento anexado pela Unidade reguladora
            $cc_document = DocumentProject::where('p_id',base64_decode($id))->where('psm_id', 11)->first(); // documento anexado pela Unidade reguladora
            $ethical_document = DocumentProject::where('p_id',base64_decode($id))->where('psm_id', 13)->first();
            $wgp_id = DB::table('wgp_work_group_project')->select('wgp_id')->where('p_id', base64_decode($id))->first();
            // dd($wgp_id);
            $tasks = Task::with("members", 'task_state', 'agenda_monitoria', 'task_conformities')->where('p_id', base64_decode($id))->whereNull('deleted_at')->get();
            // dd(count($tasks));
            $project_charter_story = ProjectCharter::with("user_stories", "study_reports")->where("p_id", base64_decode($id))->get();
            $project_state = ProjectExternalState::where('p_id', base64_decode($id))->whereNull('deleted_at')->first();
           if(empty($project_state)){
                $external_state = ExternalComitteeState::where('ecs_id', 1)->get();
           }else{
                $external_state = ExternalComitteeState::get();
           }
           $project_conformities = DB::table("pc_project_conformities")
            ->select('s_name', 'c_description', "pc_project_conformities.created_at")
            ->join('p_projects', 'pc_project_conformities.p_id', 'p_projects.p_id')
            ->join("c_conformity", "pc_project_conformities.c_id", "c_conformity.c_id")
            ->join("users", 'users.u_id', 'pc_project_conformities.pc_created_by')
            ->join('s_staff', 's_staff.s_id', 'users.s_id')
            ->where("p_projects.p_id",  base64_decode($id))
            ->whereNUll("p_projects.deleted_at")
            ->groupBy("c_conformity.c_description")
            ->get();
            $conformity_report=DocumentProject::where('dt_id', 13)->where('p_id', base64_decode($id))->whereNull('deleted_at')->get();
        //    dd($project_conformities);
            if($project->psm_id == 13){
                return view('post_award.pre_writing_config', [
                    'investigators'=>$investigators,'project'=>$project,'role_groups'=>$role_group,'staff' => $staff,
                    'project_conformities'=>$project_conformities,
                    'conformity_report' => $conformity_report,
                    'document_types' => $document_types,
                    'project_stage_micro' => $project_stage_micro,
                    'projects' => $project,
                    'timeline' => $timeline,
                    'status_count' => $status_count,
                    'documents' => $documents,
                    'project_status' => $project_status,
                    'wgp_id' => $wgp_id,
                    'ethical_document '=> $ethical_document,
                    'tasks' => $tasks,
                    'project_charter_story' => $project_charter_story,
                    'monitoring_plan' => $this->project_monitoring->showMonitoringPlan(base64_decode($id))
                ]);
           }
           
           
            // return view('post_award.temp', [
            return view('post_award.add_docs', [
                'investigators'=>$investigators,'project'=>$project,'role_groups'=>$role_group,'staff' => $staff,
                'document_types' => $document_types,
                'project_stage_micro' => $project_stage_micro,
                'projects' => $project,
                'timeline' => $timeline,
                'draft' => $draft,
                'status_count' => $status_count,
                'consortium' => $consortium,
                'dt_document_type' => $documents,
                'project_status' => $project_status,
                'ur_document' => $ur_document,
                'external_state' => $external_state,
                // 'project_state' => $project_state,
                'cc_document' => $cc_document,
                'ethical_document' => $ethical_document,
                'wgp_id' => $wgp_id,
                'tasks' => $tasks,
                'monitoring_plan' => $this->project_monitoring->showMonitoringPlan(base64_decode($id))
            ]);
        }else{
            return redirect()->route('auth');
        }
    }
    public function unidade_reguladora_show_details($id){
        $project=Project::with('work_group_project','time_line','user_project','documentsProject','work_group_project_stage_two','articles','tasks')->where('p_id','=',base64_decode($id))->first();

        $investigators=Staff::get();
        $role_group=WorkGroupRole::get();
        $staff = Staff::get();
        $document_types = DocumentType::get();
        $project_stage_micro = ProjectStageMicro::get();
        $documents=  DB::table('dp_document_project')
            ->join('psm_project_stage_micro', 'dp_document_project.psm_id', '=', 'psm_project_stage_micro.psm_id')
            ->join('dt_document_type', 'dp_document_project.dt_id', '=', 'dt_document_type.dt_id')
            ->where('dp_document_project.p_id','=', base64_decode($id))
//            ->where('psm_project_stage_micro.ps_id','=', 2)
            ->where('dt_document_type.dt_id','=', 6)
            ->where('dt_document_type.dt_id','=', 7)
            ->whereNull('dp_document_project.deleted_at')
            ->groupBy('dp_document_project.dp_id')
            ->orderBy('dp_document_project.updated_at', 'DESC')
            ->get();
        $draft=  DB::table('dp_document_project')
            ->join('psm_project_stage_micro', 'dp_document_project.psm_id', '=', 'psm_project_stage_micro.psm_id')
            ->join('dt_document_type', 'dp_document_project.dt_id', '=', 'dt_document_type.dt_id')
            ->where('dp_document_project.p_id','=', base64_decode($id))
//            ->where('psm_project_stage_micro.ps_id','=', 2)
//            ->where('dt_document_type.dt_id','=', 6)
            ->where('dt_document_type.dt_id','=', 7)
            ->whereNull('dp_document_project.deleted_at')
            ->groupBy('dp_document_project.dp_id')
            ->orderBy('dp_document_project.updated_at', 'DESC')
            ->first();
        $consortium=  DB::table('dp_document_project')
            ->join('psm_project_stage_micro', 'dp_document_project.psm_id', '=', 'psm_project_stage_micro.psm_id')
            ->join('dt_document_type', 'dp_document_project.dt_id', '=', 'dt_document_type.dt_id')
            ->where('dp_document_project.p_id','=', base64_decode($id))
//            ->where('psm_project_stage_micro.ps_id','=', 2)
            ->where('dt_document_type.dt_id','=', 6)
//            ->where('dt_document_type.dt_id','=', 7)
            ->whereNull('dp_document_project.deleted_at')
            ->groupBy('dp_document_project.dp_id')
            ->orderBy('dp_document_project.updated_at', 'DESC')
            ->first();
        $timeline = TimelineProject::with('projectTimeline')
            ->where('p_id', base64_decode($id))
            ->first();
        $project_status= Config::where('c_type','like','task_state')->get();
        $status_count=[];
        foreach ($project_status as $state){
            $status_count[$state->c_id]=0;
            foreach ($project->tasks as $task){
                if ($task->t_state==$state->c_id){
                    $status_count[$state->c_id]=$status_count[$state->c_id]+1;
                }
            }
        }
        $tasks = Task::with("members", 'task_state', 'agenda_monitoria', 'task_conformities')->where('p_id', base64_decode($id))->whereNull('deleted_at')->get();
        // $project_conformities = ProjectConformity::with("project_conformities","user_created")->where("p_id", base64_decode($id))->whereNull('deleted_at')->get();
        $conformity_report=DocumentProject::where('dt_id', 13)->where('p_id', base64_decode($id))->whereNull('deleted_at')->get();
        // dd($conformity_report);

        $project_conformities = DB::table("pc_project_conformities")
        ->select('s_name', 'c_description', "pc_project_conformities.created_at")
        ->join('p_projects', 'pc_project_conformities.p_id', 'p_projects.p_id')
        ->join("c_conformity", "pc_project_conformities.c_id", "c_conformity.c_id")
        ->join("users", 'users.u_id', 'pc_project_conformities.pc_created_by')
        ->join('s_staff', 's_staff.s_id', 'users.s_id')
        ->where("p_projects.p_id",  base64_decode($id))
        ->whereNUll("p_projects.deleted_at")
        ->groupBy("c_conformity.c_description")
        ->get();
        // dd($temp);

        $conformities =Conformity::get();
        return view('post_award.verify_protocol', ['investigators'=>$investigators,'project'=>$project,'role_groups'=>$role_group,'staff' => $staff,
            'document_types' => $document_types,
            'project_stage_micro' => $project_stage_micro,
            'projects' => $project,
            'timeline' => $timeline,
            'draft' => $draft,
            'status_count' => $status_count,
            'tasks' => $tasks,
            'consortium' => $consortium,
            'dt_document_type' => $documents,
            'project_status' => $project_status,
            'conformities' => $conformities,
            'conformity_report' => $conformity_report,
            'project_conformities' => $project_conformities,
            'monitoring_plan' => $this->project_monitoring->showMonitoringPlan(base64_decode($id))
        ]);
    }
    public function aprovacao_científica_show_details($id){
        $project=Project::with('work_group_project','time_line','user_project','documentsProject','work_group_project_stage_two','articles','tasks')->where('p_id','=',base64_decode($id))->first();
        //return json_encode($project);
        $investigators=Staff::get();
        $role_group=WorkGroupRole::get();
        $staff = Staff::get();
        $document_types = DocumentType::get();
        $project_stage_micro = ProjectStageMicro::get();
        $documents=  DB::table('dp_document_project')
            ->join('psm_project_stage_micro', 'dp_document_project.psm_id', '=', 'psm_project_stage_micro.psm_id')
            ->join('dt_document_type', 'dp_document_project.dt_id', '=', 'dt_document_type.dt_id')
            ->where('dp_document_project.p_id','=', base64_decode($id))
//            ->where('psm_project_stage_micro.ps_id','=', 2)
            ->where('dt_document_type.dt_id','=', 6)
            ->where('dt_document_type.dt_id','=', 7)
            ->whereNull('dp_document_project.deleted_at')
            ->groupBy('dp_document_project.dp_id')
            ->orderBy('dp_document_project.updated_at', 'DESC')
            ->get();
        $draft=  DB::table('dp_document_project')
            ->join('psm_project_stage_micro', 'dp_document_project.psm_id', '=', 'psm_project_stage_micro.psm_id')
            ->join('dt_document_type', 'dp_document_project.dt_id', '=', 'dt_document_type.dt_id')
            ->where('dp_document_project.p_id','=', base64_decode($id))
//            ->where('psm_project_stage_micro.ps_id','=', 2)
//            ->where('dt_document_type.dt_id','=', 6)
            ->where('dt_document_type.dt_id','=', 7)
            ->whereNull('dp_document_project.deleted_at')
            ->groupBy('dp_document_project.dp_id')
            ->orderBy('dp_document_project.updated_at', 'DESC')
            ->first();
        $consortium=  DB::table('dp_document_project')
            ->join('psm_project_stage_micro', 'dp_document_project.psm_id', '=', 'psm_project_stage_micro.psm_id')
            ->join('dt_document_type', 'dp_document_project.dt_id', '=', 'dt_document_type.dt_id')
            ->where('dp_document_project.p_id','=', base64_decode($id))
//            ->where('psm_project_stage_micro.ps_id','=', 2)
            ->where('dt_document_type.dt_id','=', 6)
//            ->where('dt_document_type.dt_id','=', 7)
            ->whereNull('dp_document_project.deleted_at')
            ->groupBy('dp_document_project.dp_id')
            ->orderBy('dp_document_project.updated_at', 'DESC')
            ->first();
        $timeline = TimelineProject::with('projectTimeline')
            ->where('p_id', base64_decode($id))
            ->first();
//        $project_status= Config::where('c_type','like','task_state')->get();
        $project_status= Config::where('c_type','like','task_state')->get();
        $status_count=[];
        foreach ($project_status as $state){
            $status_count[$state->c_id]=0;
            foreach ($project->tasks as $task){
                if ($task->t_state==$state->c_id){
                    $status_count[$state->c_id]=$status_count[$state->c_id]+1;
                }
            }
        }
        // $link_projects = LinkProject::where('p_id', base64_decode($id))->get();
        // dd($link_projects);
        $articles = Article::with("files", 'category')->where('p_id', base64_decode($id))->whereNull('deleted_at')->get();
        $pi_protocol_document = DocumentProject::where('p_id',base64_decode($id))->where('psm_id', 9)->first();
        $document_for_cci = DocumentProject::where("p_id", base64_decode($id))->where('dt_id', '>', 14)->whereNull('deleted_at')->get();
        // dd($document_for_cci);
        // return view('post_award.temp', [
        return view('post_award.scientific_review', [
            'investigators'=>$investigators,'project'=>$project,'role_groups'=>$role_group,'staff' => $staff,
            'document_types' => $document_types,
            'project_stage_micro' => $project_stage_micro,
            'projects' => $project,
            'timeline' => $timeline,
            'draft' => $draft,
            'status_count' => $status_count,
            'consortium' => $consortium,
            'dt_document_type' => $documents,
            'project_status' => $project_status,
            'pi_protocol_document' => $pi_protocol_document,
            // 'link_projects' => $link_projects,
            'articles' => $articles,
            'document_for_cci' => $document_for_cci
        ]);
    }
    public function aprovacao_etica_show_details($id){
        $project=Project::with('work_group_project','time_line','user_project','documentsProject','work_group_project_stage_two','articles','tasks')
        ->where('p_id','=',base64_decode($id))
        ->whereNull('deleted_at')
        ->first();
        //return json_encode($project);
        $investigators=Staff::get();
        $role_group=WorkGroupRole::get();
        $staff = Staff::get();
        $document_types = DocumentType::get();
        $project_stage_micro = ProjectStageMicro::get();
        $documents=  DB::table('dp_document_project')
            ->join('psm_project_stage_micro', 'dp_document_project.psm_id', '=', 'psm_project_stage_micro.psm_id')
            ->join('dt_document_type', 'dp_document_project.dt_id', '=', 'dt_document_type.dt_id')
            ->where('dp_document_project.p_id','=', base64_decode($id))
//            ->where('psm_project_stage_micro.ps_id','=', 2)
            ->where('dt_document_type.dt_id','=', 6)
            ->where('dt_document_type.dt_id','=', 7)
            ->whereNull('dp_document_project.deleted_at')
            ->groupBy('dp_document_project.dp_id')
            ->orderBy('dp_document_project.updated_at', 'DESC')
            ->get();
        $draft=  DB::table('dp_document_project')
            ->join('psm_project_stage_micro', 'dp_document_project.psm_id', '=', 'psm_project_stage_micro.psm_id')
            ->join('dt_document_type', 'dp_document_project.dt_id', '=', 'dt_document_type.dt_id')
            ->where('dp_document_project.p_id','=', base64_decode($id))
//            ->where('psm_project_stage_micro.ps_id','=', 2)
//            ->where('dt_document_type.dt_id','=', 6)
            ->where('dt_document_type.dt_id','=', 7)
            ->whereNull('dp_document_project.deleted_at')
            ->groupBy('dp_document_project.dp_id')
            ->orderBy('dp_document_project.updated_at', 'DESC')
            ->first();
        $consortium=  DB::table('dp_document_project')
            ->join('psm_project_stage_micro', 'dp_document_project.psm_id', '=', 'psm_project_stage_micro.psm_id')
            ->join('dt_document_type', 'dp_document_project.dt_id', '=', 'dt_document_type.dt_id')
            ->where('dp_document_project.p_id','=', base64_decode($id))
//            ->where('psm_project_stage_micro.ps_id','=', 2)
            ->where('dt_document_type.dt_id','=', 6)
//            ->where('dt_document_type.dt_id','=', 7)
            ->whereNull('dp_document_project.deleted_at')
            ->groupBy('dp_document_project.dp_id')
            ->orderBy('dp_document_project.updated_at', 'DESC')
            ->first();
        $timeline = TimelineProject::with('projectTimeline')
            ->where('p_id', base64_decode($id))
            ->first();
        $project_status= Config::where('c_type','like','task_state')->get();
        $status_count=[];
        foreach ($project_status as $state){
            $status_count[$state->c_id]=0;
            foreach ($project->tasks as $task){
                if ($task->t_state==$state->c_id){
                    $status_count[$state->c_id]=$status_count[$state->c_id]+1;
                }
            }
        }
        $ethical_review = DocumentProject::where('p_id',base64_decode($id))->where('psm_id', 19)->get(); // documento anexado pela PI
        return view('post_award.etical_review', ['investigators'=>$investigators,'project'=>$project,'role_groups'=>$role_group,'staff' => $staff,
            'document_types' => $document_types,
            'project_stage_micro' => $project_stage_micro,
            'projects' => $project,
            'timeline' => $timeline,
            'draft' => $draft,
            'consortium' => $consortium,
            'status_count' => $status_count,
            'ethical_review' => $ethical_review,
            'dt_document_type' => $documents,
            'project_status' => $project_status,
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $project=Project::with('work_group_project','time_line','user_project','documentsProject','work_group_project_stage_two','articles','tasks')->where('p_id','=',base64_decode($id))->first();
        // dd($project);
        //return json_encode($project);
        $investigators= DB::table('s_staff')
            ->join('users', 'users.s_id', '=', 's_staff.s_id')
            ->where('users.r_id','=', 7)
            ->where('users.state',1)
            ->whereNull('s_staff.deleted_at')
            ->groupBy('s_staff.s_id')
            ->get();
        //     $investigators= Project::with('work_group_project_stage_two')->where('p_id', base64_decode($id))
        // ->whereNull('deleted_at')
        // ->get();
        $role_group=WorkGroupRole::get();
        $staff = Staff::get();
        $document_types = DocumentType::get();
        $project_stage_micro = ProjectStageMicro::get();
        $documents=  DB::table('dp_document_project')
            ->join('psm_project_stage_micro', 'dp_document_project.psm_id', '=', 'psm_project_stage_micro.psm_id')
            ->join('dt_document_type', 'dp_document_project.dt_id', '=', 'dt_document_type.dt_id')
            ->where('dp_document_project.p_id','=', base64_decode($id))
            ->where('psm_project_stage_micro.ps_id','=', 2)
            ->whereNull('dp_document_project.deleted_at')
            ->groupBy('dp_document_project.dp_id')
            ->orderBy('dp_document_project.updated_at', 'DESC')
            ->get();
        $timeline = TimelineProject::with('projectTimeline')
            ->where('p_id', base64_decode($id))
            ->first();
        $project_status= Config::where('c_type','like','task_state')->get();
        $status_count=[];
        foreach ($project_status as $state){
            $status_count[$state->c_id]=0;
            foreach ($project->tasks as $task){
                if ($task->t_state==$state->c_id){
                    $status_count[$state->c_id]=$status_count[$state->c_id]+1;
                }
            }
        }
        $final_report = DocumentProject::where('p_id', base64_decode($id))->where('dt_id', 14)->first();
        
//        return json_encode($project);

//        $project = Project::with('documentsProject', 'user_project')
//        ->where('p_id', base64_decode($id))
//        ->first();
$project_conformities = DB::table("pc_project_conformities")
        ->select('s_name', 'c_description', "pc_project_conformities.created_at")
        ->join('p_projects', 'pc_project_conformities.p_id', 'p_projects.p_id')
        ->join("c_conformity", "pc_project_conformities.c_id", "c_conformity.c_id")
        ->join("users", 'users.u_id', 'pc_project_conformities.pc_created_by')
        ->join('s_staff', 's_staff.s_id', 'users.s_id')
        ->where("p_projects.p_id",  base64_decode($id))
        ->whereNUll("p_projects.deleted_at")
        ->groupBy("c_conformity.c_description")
        ->get();
        $conformity_report=DocumentProject::where('dt_id', 13)->where('p_id', base64_decode($id))->whereNull('deleted_at')->get();
$project_charter_story = ProjectCharter::with("user_stories", "study_reports")->where("p_id", base64_decode($id))->get();
        return view('post_award.pre_writing_config', ['investigators'=>$investigators,'project'=>$project,'role_groups'=>$role_group,'staff' => $staff,
            'document_types' => $document_types,
            'project_stage_micro' => $project_stage_micro,
            'projects' => $project,
            'project_conformities'=>$project_conformities,
            'conformity_report' => $conformity_report,
            'timeline' => $timeline,
            'status_count' => $status_count,
            'documents' => $documents,
            'project_status' => $project_status,
            'final_report' => $final_report,
            'project_charter_story' => $project_charter_story,
            'monitoring_plan' => $this->project_monitoring->showMonitoringPlan(base64_decode($id))
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{

                $rules = [
                    'document' => 'nullable|mimes:docx,doc,pdf',
                    'state' => 'required|in:Aprovado,Reprovado',
    //                'dt_id' => 'required|integer',
    //                'psm' => 'required|integer',
    //                'description' => 'required|string',
                ];

                $validate = Validator::make($request->all(), $rules);
                if ($validate->fails())
                {
                    return redirect()->back()->withErrors($validate->errors());

                }
                // if($this->project_monitoring->store($request, $id)){
                    if($request->hasFile('document'))
                    {
                        $file = $request->file('document');
                        $extension = $file->getClientOriginalExtension();
                        $document = time().'.'.$extension;
                        $dp_local_path = $document;
                        $request->document->move(public_path('docs'), $document);
                        $document_project_id = DB::table('dp_document_project')->max('dp_id') + 1;
                        $document_project = new DocumentProject();
                        $document_project->dp_id=$document_project_id;
                        $document_project->dt_id=4;
                        $document_project->p_id=base64_decode($id);
                        $document_project->psm_id=9;
                        $document_project->dp_name='documento anexado após a aprovação da unidade_reguladora';
                        $document_project->dp_description='documento anexado após a aprovação da unidade_reguladora';
                        $document_project->dp_local_path=$dp_local_path;
                        $document_project->created_at=now();
                        $document_project->updated_at=now();
                        $document_project->save();

                        $project_old= Project::where("p_id","=",base64_decode($id))->first();
                        Project::where("p_id","=",base64_decode($id))
                            ->update(['updated_at'=>now(),'deleted_at'=>now()]);

                        $project = new Project();
                        $project->p_id=$project_old->p_id;
                        $project->p_name=$project_old->p_name;
                        $project->p_description=$project_old->p_description;
                        $project->p_submitted_at=$project_old->p_submitted_at;
                        $project->p_deadline=$project_old->p_deadline;
                        $project->p_budget=$project_old->p_budget;
                        $project->p_general_budget=$project_old->p_general_budget;
                        $project->p_state=$project_old->p_state;
                        $project->u_id=$project_old->u_id;
                        $project->created_at=$project_old->created_at;
                        $project->psm_id=($request->state=="Aprovado")? 9:10;
                        $project->p_updated_by=Auth::user()->u_id;
                        $project->updated_at=now();
                        $project->p_acronym = $project_old->p_acronym;
                        $project->p_consortium = $project_old->p_consortium;
                        $project->p_currency = $project_old->p_currency;
                        $project->sa_id = $project_old->sa_id;
                        $project->p_web_url = $project_old->p_web_url;
                        $project->p_support_document = $project_old->p_support_document;
                        $project->p_reasons = $project_old->p_reasons;
                        $project->p_source = $project_old->p_source;
                        $project->p_actual_state = $project_old->p_actual_state;
                        $project->p_target_population = $project_old->p_target_population;
                        $project->p_data_collection_location = $project_old->p_data_collection_location;
                        $project->p_end_date = $project_old->p_end_date;
                        $project->save();
                        $email_notification = new PostAwardNotification();

                        $get_email_pi = User::where('u_id', $project_old->u_id)->first();
                        $sendTo = array(Auth::user()->email, $get_email_pi->email);
                        // $msg = 'Hello, the project '.$project_old->p_name.' has been '. ($request->state=='Aprovado')?'Approved':'Rejected'.' by the RU';
                        // return $request->state;
                        if($request->state=='Aprovado'){
                            $msg = 'Hello, the project '.$project_old->p_name.' has been Approved  by the RU';
                        }else{
                            $msg = 'Hello, the project '.$project_old->p_name.' has been Rejected  by the RU';  
                        }
                        $data = array(
                            'title'=> 'Regulatory Unit approval',
                            'body'=> $msg,
                            'document' => asset('docs/' . $dp_local_path),
                            'subject' => 'Conformity Approval'
                        );
                        //return $data;
                    $email_notification->sendEmail($sendTo, $data);
                    }
                // }

            return redirect()->back()->with('success', translate('requisao_submetida_sucesso'));
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Technical error. please contact to support team.');
        }
    }

    public function resend_protocol(Request $request)
    {
        $rules = [
            'document_protocol' => 'nullable|mimes:docx,doc,pdf',
            'cci_document' => 'nullable|mimes:docx,doc,pdf'
        ];

        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails())
        {
            return redirect()->back()->withErrors($validate->errors())->withInput();
        }
        $dp_local_path = '';
        $dp_local_path_2 = '';
        DocumentProject::where("p_id", base64_decode($request->p_id))->where('dt_id', 15)
        ->update([
            'deleted_at' => now()
        ]);

        DocumentProject::where("p_id", base64_decode($request->p_id))->where('dt_id', 16)
        ->update([
            'deleted_at' => now()
        ]);

        if($request->hasFile('document_protocol'))
        {
            $file = $request->file('document_protocol');
            $extension = $file->getClientOriginalExtension();
            $document = time().'.'.$extension;
            $dp_local_path = $document;
            $file->move(public_path('docs'), $document);
            $document_project_id = DB::table('dp_document_project')->max('dp_id') + 1;
            $document_project = new DocumentProject();
            $document_project->dp_id=$document_project_id;
            $document_project->dt_id=15;
            $document_project->p_id=base64_decode($request->p_id);
            $document_project->psm_id=9;
            $document_project->dp_name=translate('documento_anexado');
            $document_project->dp_description=translate('documento_anexado');
            $document_project->dp_local_path=$dp_local_path;
            $document_project->created_at=now();
            $document_project->updated_at=now();
            $document_project->save();
        }

        if($request->hasFile('cci_document'))
        {
            $file = $request->file('cci_document');
            $extension = $file->getClientOriginalExtension();
            $document = $file->getClientOriginalName().time().'.'.$extension;
            $dp_local_path_2 = $document;
            $file->move(public_path('docs'), $document);
            $document_project_id = DB::table('dp_document_project')->max('dp_id') + 1;
            $document_project = new DocumentProject();
            $document_project->dp_id=$document_project_id;
            $document_project->dt_id=16;
            $document_project->p_id=base64_decode($request->p_id);
            $document_project->psm_id=9;
            $document_project->dp_name=translate('documento_anexado_cci');
            $document_project->dp_description=translate('documento_anexado_cci');
            $document_project->dp_local_path=$dp_local_path_2;
            $document_project->created_at=now();
            $document_project->updated_at=now();
            $document_project->save();
        }
            
        $project_old= Project::where("p_id","=",base64_decode($request->p_id))->first();
        Project::where("p_id","=",base64_decode($request->p_id))
            ->update(['updated_at'=>now(),'deleted_at'=>now()]);

        $project = new Project();
        $project->p_id=$project_old->p_id;
        $project->p_name=$project_old->p_name;
        $project->p_description=$project_old->p_description;
        $project->p_submitted_at=$project_old->p_submitted_at;
        $project->p_deadline=$project_old->p_deadline;
        $project->p_budget=$project_old->p_budget;
        $project->p_general_budget=$project_old->p_general_budget;
        $project->p_state=$project_old->p_state;
        $project->u_id=$project_old->u_id;
        $project->created_at=$project_old->created_at;
        $project->psm_id=22;
        $project->p_updated_by=Auth::user()->u_id;
        $project->updated_at=now();
        $project->p_acronym = $project_old->p_acronym;
        $project->p_consortium = $project_old->p_consortium;
        $project->p_currency = $project_old->p_currency;
        $project->sa_id = $project_old->sa_id;
        $project->p_web_url = $project_old->p_web_url;
        $project->p_support_document = $project_old->p_support_document;
        $project->p_reasons = $project_old->p_reasons;
        $project->p_source = $project_old->p_source;
        $project->p_actual_state = $project_old->p_actual_state;
        $project->p_target_population = $project_old->p_target_population;
        $project->p_data_collection_location = $project_old->p_data_collection_location;
        $project->p_end_date = $project_old->p_end_date;
        $project->save();
        $email_notification = new PostAwardNotification();

        $get_email_pi = User::where('u_id', $project_old->u_id)->first();
        $sendTo = array(Auth::user()->email, $get_email_pi->email);
        $msg = 'Hello, the PI submitted the Protocol to the ICC'.$project_old->p_name.' for approval.';

        $data = array(
            'title'=> 'CCI ',
            'body'=> $msg,
            'document' => asset('docs/' . $dp_local_path),
            'subject' => 'ICC approval'
        );

        $email_notification->sendEmail($sendTo, $data);
        return redirect()->back()->with('success', translate('requisao_submetida_sucesso'));    
    }

    public function pi_response_cibs_modal(Request $request)
    {
        
        $rules = [
            'protocolo' => 'nullable|mimes:docx,doc,pdf',
            'apendice.*' => 'nullable|mimes:docx,doc,pdf',
        ];

        $validate = Validator::make($request->all(), $rules);
        // dd($validate->errors());
        if ($validate->fails())
        {
            return response()->json(['success' => false, 'message' => $validate->errors(),'state'=>412,'data'=>array()], 200);
        }
        DocumentProject::where("p_id", base64_decode($request->p_id))->where('psm_id', 19)->where('dt_id', 9)->update([
            'deleted_at' => now()
        ]);
        
        if($request->hasFile('protocolo'))
        {
            $file = $request->file('protocolo');
            $extension = $file->getClientOriginalExtension();
            $document = time().'.'.$extension;
            $dp_local_path = $document;
            $request->protocolo->move(public_path('docs'), $document);

            $document_project_id = DB::table('dp_document_project')->max('dp_id') + 1;
            $document_project = new DocumentProject();
            $document_project->dp_id=$document_project_id;
            $document_project->dt_id=9;
            $document_project->p_id=(int)base64_decode($request->p_id);
            $document_project->psm_id=19;
            $document_project->dp_name=translate('protocolo');
            $document_project->dp_description='';
            $document_project->dp_local_path=$dp_local_path;
            $document_project->created_at=now();
            $document_project->updated_at=now();
            $document_project->save();
        }
        foreach($request->apendice as $key => $apendice){
            // $file = $request->file('apendice');
            $dp_local_path = '';
            $file = $apendice;
            $extension = $file->getClientOriginalExtension();
            $document = $file->getClientOriginalName().'_'.$key.'.'.$extension;
            $dp_local_path = $document;
            $file->move(public_path('docs'), $document);
            $key++;
            $document_project_id = DB::table('dp_document_project')->max('dp_id') + 1;
            $document_project = new DocumentProject();
            $document_project->dp_id=$document_project_id;
            $document_project->dt_id=9;
            $document_project->p_id=(int)base64_decode($request->p_id);
            $document_project->psm_id=19;
            $document_project->dp_name='Apêndice_'. (string)$key;
            $document_project->dp_description='';
            $document_project->dp_local_path=$dp_local_path;
            $document_project->created_at=now();
            $document_project->updated_at=now();
            $document_project->save();
        }

        $project_old= Project::where("p_id","=",base64_decode($request->p_id))->first();
            Project::where("p_id","=",base64_decode($request->p_id))
                ->update(['updated_at'=>now(),'deleted_at'=>now()]);

            $project = new Project();
            $project->p_id=$project_old->p_id;
            $project->p_name=$project_old->p_name;
            $project->p_description=$project_old->p_description;
            $project->p_submitted_at=$project_old->p_submitted_at;
            $project->p_deadline=$project_old->p_deadline;
            $project->p_budget=$project_old->p_budget;
            $project->p_general_budget=$project_old->p_general_budget;
            $project->p_state=$project_old->p_state;
            $project->u_id=$project_old->u_id;
            $project->created_at=$project_old->created_at;
            $project->psm_id=19;
            $project->p_updated_by=Auth::user()->u_id;
            $project->updated_at=now();
            $project->p_acronym = $project_old->p_acronym;
            $project->p_consortium = $project_old->p_consortium;
            $project->p_currency = $project_old->p_currency;
            $project->sa_id = $project_old->sa_id;
            $project->p_web_url = $project_old->p_web_url;
            $project->p_support_document = $project_old->p_support_document;
            $project->p_reasons = $project_old->p_reasons;
            $project->p_source = $project_old->p_source;
            $project->p_actual_state = $project_old->p_actual_state;
            $project->p_target_population = $project_old->p_target_population;
            $project->p_data_collection_location = $project_old->p_data_collection_location;
            $project->p_end_date = $project_old->p_end_date;
            $project->save();

             return redirect()->back()->with('success', translate('requisao_submetida_sucesso'));
           
    }
    public function pi_response_cibs(Request $request)
    {
        
        $rules = [
            'protocolo' => 'nullable|mimes:docx,doc,pdf',
            'apendice.*' => 'nullable|mimes:docx,doc,pdf',
        ];

        $validate = Validator::make($request->all(), $rules);
        // dd($validate->errors());
        if ($validate->fails())
        {
            return response()->json(['success' => false, 'message' => $validate->errors(),'state'=>412,'data'=>array()], 200);
        }
        DocumentProject::where("p_id", base64_decode($request->p_id))->where('psm_id', 19)->where('dt_id', 9)->update([
            'deleted_at' => now()
        ]);
        
        if($request->hasFile('protocolo'))
        {
            $file = $request->file('protocolo');
            $extension = $file->getClientOriginalExtension();
            $document = time().'.'.$extension;
            $dp_local_path = $document;
            $request->protocolo->move(public_path('docs'), $document);

            $document_project_id = DB::table('dp_document_project')->max('dp_id') + 1;
            $document_project = new DocumentProject();
            $document_project->dp_id=$document_project_id;
            $document_project->dt_id=9;
            $document_project->p_id=(int)base64_decode($request->p_id);
            $document_project->psm_id=19;
            $document_project->dp_name=translate('protocolo');
            $document_project->dp_description='';
            $document_project->dp_local_path=$dp_local_path;
            $document_project->created_at=now();
            $document_project->updated_at=now();
            $document_project->save();
        }
        foreach($request->apendice as $key => $apendice){
            // $file = $request->file('apendice');
            $dp_local_path = '';
            $file = $apendice;
            $extension = $file->getClientOriginalExtension();
            $document = $file->getClientOriginalName().'_'.$key.'.'.$extension;
            $dp_local_path = $document;
            $file->move(public_path('docs'), $document);
            $key++;
            $document_project_id = DB::table('dp_document_project')->max('dp_id') + 1;
            $document_project = new DocumentProject();
            $document_project->dp_id=$document_project_id;
            $document_project->dt_id=9;
            $document_project->p_id=(int)base64_decode($request->p_id);
            $document_project->psm_id=19;
            $document_project->dp_name='Apêndice_'. (string)$key;
            $document_project->dp_description='';
            $document_project->dp_local_path=$dp_local_path;
            $document_project->created_at=now();
            $document_project->updated_at=now();
            $document_project->save();
        }

        $project_old= Project::where("p_id","=",base64_decode($request->p_id))->first();
            Project::where("p_id","=",base64_decode($request->p_id))
                ->update(['updated_at'=>now(),'deleted_at'=>now()]);

            $project = new Project();
            $project->p_id=$project_old->p_id;
            $project->p_name=$project_old->p_name;
            $project->p_description=$project_old->p_description;
            $project->p_submitted_at=$project_old->p_submitted_at;
            $project->p_deadline=$project_old->p_deadline;
            $project->p_budget=$project_old->p_budget;
            $project->p_general_budget=$project_old->p_general_budget;
            $project->p_state=$project_old->p_state;
            $project->u_id=$project_old->u_id;
            $project->created_at=$project_old->created_at;
            $project->psm_id=19;
            $project->p_updated_by=Auth::user()->u_id;
            $project->updated_at=now();
            $project->p_acronym = $project_old->p_acronym;
            $project->p_consortium = $project_old->p_consortium;
            $project->p_currency = $project_old->p_currency;
            $project->sa_id = $project_old->sa_id;
            $project->p_web_url = $project_old->p_web_url;
            $project->p_support_document = $project_old->p_support_document;
            $project->p_reasons = $project_old->p_reasons;
            $project->p_source = $project_old->p_source;
            $project->p_actual_state = $project_old->p_actual_state;
            $project->p_target_population = $project_old->p_target_population;
            $project->p_data_collection_location = $project_old->p_data_collection_location;
            $project->p_end_date = $project_old->p_end_date;
            $project->save();

            //  return redirect()->back()->with(['success' => false, 'message' => "Sucesso",'state'=>200,'data'=>$request->all()], 200);
            //  with('success', 'Documentos submetidos com sucesso');
           return response()->json(['success' => true, 'message' => translate('requisao_submetida_sucesso'),'state'=>200,'data'=>$request->all()], 200);
    }

    public function pi_response(Request $request)
    {
        // return $request->all();
        $rules = [
            'document' => 'nullable|mimes:docx,doc,pdf'
        ];

        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails())
        {
            return redirect()->back()->withErrors($validate->errors());

        }
        if($request->hasFile('protocol_document'))
        {
            $file = $request->file('protocol_document');
            $extension = $file->getClientOriginalExtension();
            $document = time().'.'.$extension;
            $dp_local_path = $document;
            $file->move(public_path('docs'), $document);
            $document_project_id = DB::table('dp_document_project')->max('dp_id') + 1;
            $document_project = new DocumentProject();
            $document_project->dp_id=$document_project_id;
            $document_project->dt_id=8;
            $document_project->p_id=base64_decode($request->p_id);
            $document_project->psm_id=18;
            $document_project->dp_name='';
            $document_project->dp_description='';
            $document_project->dp_local_path=$dp_local_path;
            $document_project->created_at=now();
            $document_project->updated_at=now();
            $document_project->save();
        }
    $project_old= Project::where("p_id","=",base64_decode($request->p_id))->first();
    Project::where("p_id","=",base64_decode($request->p_id))
        ->update(['updated_at'=>now(),'deleted_at'=>now()]);

    $project = new Project();
    $project->p_id=$project_old->p_id;
    $project->p_name=$project_old->p_name;
    $project->p_description=$project_old->p_description;
    $project->p_submitted_at=$project_old->p_submitted_at;
    $project->p_deadline=$project_old->p_deadline;
    $project->p_budget=$project_old->p_budget;
    $project->p_general_budget=$project_old->p_general_budget;
    $project->p_state=$project_old->p_state;
    $project->u_id=$project_old->u_id;
    $project->created_at=$project_old->created_at;
    $project->psm_id=18;
    $project->p_updated_by=Auth::user()->u_id;
    $project->updated_at=now();
    $project->p_acronym = $project_old->p_acronym;
    $project->p_consortium = $project_old->p_consortium;
    $project->p_currency = $project_old->p_currency;
    $project->sa_id = $project_old->sa_id;
    $project->p_web_url = $project_old->p_web_url;
    $project->p_support_document = $project_old->p_support_document;
    $project->p_reasons = $project_old->p_reasons;
    $project->p_source = $project_old->p_source;
    $project->p_actual_state = $project_old->p_actual_state;
    $project->p_target_population = $project_old->p_target_population;
    $project->p_data_collection_location = $project_old->p_data_collection_location;
    $project->p_end_date = $project_old->p_end_date;
    $project->save();

        return response()->json(['success' => true, 'message' => "Sucesso",'state'=>200,'data'=>$request->all()], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function aprovacao_científica(Request $request, $id)
    {
        try{

            $rules = [
                'document' => 'nullable|mimes:docx,doc,pdf',
                'state' => 'required|in:Aprovado,Reprovado'
            ];
            $messages = [
                "document.mimes" => translate("documento_invalido"),
                "state.required" => translate("este_campo_obrigatorio")
            ];

            $validate = Validator::make($request->all(), $rules, $messages);
            if ($validate->fails())
            {
                return redirect()->back()->withErrors($validate->errors())->withInput();
            }
            $dp_local_path="";
            // return $request->hasFile('document');
            if($request->hasFile('document'))
            {
                $file = $request->file('document');
                $extension = $file->getClientOriginalExtension();
                $document = time().'.'.$extension;
                $dp_local_path = $document;
                $request->document->move(public_path('docs'), $document);
                $document_project_id = DB::table('dp_document_project')->max('dp_id') + 1;
                $document_project = new DocumentProject();
                $document_project->dp_id=$document_project_id;
                $document_project->dt_id=8;
                $document_project->p_id=base64_decode($id);
                $document_project->psm_id=11;
                $document_project->dp_name=translate('protocolo');
                $document_project->dp_description=translate('protocolo');
                $document_project->dp_local_path=$dp_local_path;
                $document_project->created_at=now();
                $document_project->updated_at=now();
               $document_project->save();
            }
            $project_old= Project::where("p_id","=",base64_decode($id))->first();
            Project::where("p_id","=",base64_decode($id))
                ->update(['updated_at'=>now(),'deleted_at'=>now()]);

            $project = new Project();
            $project->p_id=$project_old->p_id;

            $project->p_name=$project_old->p_name;
            $project->p_description=$project_old->p_description;
            $project->p_submitted_at=$project_old->p_submitted_at;
            $project->p_deadline=$project_old->p_deadline;
            $project->p_budget=$project_old->p_budget;
            $project->p_general_budget=$project_old->p_general_budget;
            $project->p_state=$project_old->p_state;
            $project->u_id=$project_old->u_id;
            $project->p_web_url =$project_old->p_web_url;
            $project->p_data_collection_location =$project_old->p_data_collection_location;
            $project->p_target_population =$project_old->p_target_population;
            $project->p_support_document =$project_old->p_support_document;
            $project->p_actual_state =$project_old->p_actual_state;
            $project->p_currency =$project_old->p_currency;
            $project->p_acronym =$project_old->p_acronym;
            $project->p_source =$project_old->p_source;
            $project->sa_id =$project_old->sa_id;
            $project->p_consortium =$project_old->p_consortium;
            $project->created_at=$project_old->created_at;
            $project->psm_id=($request->state=='Aprovado')?11:12;
            $project->p_updated_by=Auth::user()->u_id;
            $project->updated_at=now();


            $project->save();
            $email_notification = new PostAwardNotification();

            $get_email_pi = User::where('u_id', $project_old->u_id)->first();
            $sendTo = array(Auth::user()->email, $get_email_pi->email);
            
            if($request->state=='Aprovado'){
                $msg = 'Hello, the project '.$project_old->p_name.' has been Approved by the Scientific Unit';
            }else{
                $msg = 'Hello, the project '.$project_old->p_name.' has been Rejected by the Scientific Unit';
            }
            $data = array(
                'title'=> 'Scientific approval',
                'body'=> $msg,
                'document' =>  ($request->hasFile('document'))?asset('docs/' . $dp_local_path):NULL,
                'subject' => 'ICC approval'
            );
            //return $data;
        $email_notification->sendEmail($sendTo, $data);
            return redirect()->back()->with('success', translate('requisao_submetida_sucesso'));
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Technical error. please contact to support team.');
        }
    }
    public function aprovacao_final(Request $request)
    {
        try{

            // $rules = [
            //     'state' => 'required|in:Aprovado,Reprovado',
            // ];

            // $validate = Validator::make($request->all(), $rules);
            // if ($validate->fails())
            // {
            //     return redirect()->back()->withErrors($validate->errors());

            // }

            $project_old= Project::where("p_id","=",base64_decode($request->p_id))->first();
            Project::where("p_id","=",base64_decode($request->p_id))
                ->update(['updated_at'=>now(),'deleted_at'=>now()]);
            $project = new Project();
            $project->p_id=$project_old->p_id;
                $project->p_name=$project_old->p_name;
                $project->p_description=$project_old->p_description;
                $project->p_submitted_at=$project_old->p_submitted_at;
                $project->p_deadline=$project_old->p_deadline;
                $project->p_budget=$project_old->p_budget;
                $project->p_general_budget=$project_old->p_general_budget;
                $project->p_state=$project_old->p_state;
                $project->u_id=$project_old->u_id;
                $project->p_web_url =$project_old->p_web_url;
                $project->p_data_collection_location =$project_old->p_data_collection_location;
                $project->p_target_population =$project_old->p_target_population;
                $project->p_support_document =$project_old->p_support_document;
                $project->p_actual_state =$project_old->p_actual_state;
                $project->p_currency =$project_old->p_currency;
                $project->p_acronym =$project_old->p_acronym;
                $project->p_source =$project_old->p_source;
                $project->sa_id =$project_old->sa_id;
                $project->p_consortium =$project_old->p_consortium;
                $project->created_at=$project_old->created_at;
                $project->psm_id=16;
                $project->p_updated_by=Auth::user()->u_id;
                $project->updated_at=now();
            $project->save();
            // if(($request->state!='Aprovado')){
            //     DocumentProject::where('dt_id', 21)->where('p_id', $project_old->p_id)->whereNull('deleted_at')
            //     ->update([
            //         'deleted_at'=>now()
            //     ]);
            // }
            $email_notification = new PostAwardNotification();
            $sendTo=[];
            $get_email_pi = User::where('u_id', $project_old->u_id)->first();
            array_push($sendTo,Auth::user()->email, $get_email_pi->email);
            $msg = 'Hello, the study '.$project_old->p_name." Completed successfully. \n Congratulations!!!";

            $data = array(
                'title'=> 'Final phase',
                'body'=> $msg,
                'document' => NULL,
                'subject' => 'Final phase'
            );
            //return $data;
        $email_notification->sendEmail($sendTo, $data);

            return redirect()->back()->with('success', translate('requisao_submetida_sucesso'));
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Technical error. please contact to support team.');
        }
    }
    public function aprovacao_etica(Request $request, $id)
    {
        try{

            $rules = [
                'carta_resposta' => 'nullable|mimes:docx,doc,pdf',
                'state' => 'required|in:Aprovado,Reprovado',

            ];
            $messages = [
                "carta_resposta.mimes" => translate("documento_invalido"),
                "state.required" => translate("este_campo_obrigatorio")
            ];

            $validate = Validator::make($request->all(), $rules, $messages);
            if ($validate->fails())
            {
                return redirect()->back()->withErrors($validate->errors());

            }
            if($request->state == 'Reprovado'){
                DocumentProject::where("p_id", base64_decode($id))->where('psm_id', 13)->where('dt_id', 11)->update([
                    'deleted_at' => now()
                ]);
            }

            $dp_local_path='';
           if($request->hasFile('carta_resposta'))
           {
               $file = $request->file('carta_resposta');
               $extension = $file->getClientOriginalExtension();
               $document = time().'.'.$extension;
               $dp_local_path = $document;
               $file->move(public_path('docs'), $document);
               $document_project_id = DB::table('dp_document_project')->max('dp_id') + 1;
               $document_project = new DocumentProject();
               $document_project->dp_id=$document_project_id;
               $document_project->dt_id=11;
               $document_project->p_id=base64_decode($id);
               $document_project->psm_id=13;
               $document_project->dp_name=translate('carta_resposta');
               $document_project->dp_description=translate('carta_resposta');
               $document_project->dp_local_path=$dp_local_path;
               $document_project->created_at=now();
               $document_project->updated_at=now();
               $document_project->save();
           }
            $project_old= Project::where("p_id","=",base64_decode($id))->first();
            Project::where("p_id","=",base64_decode($id))
                ->update(['updated_at'=>now(),'deleted_at'=>now()]);

            $project = new Project();
            $project->p_id=$project_old->p_id;
            $project->p_name=$project_old->p_name;
            $project->p_description=$project_old->p_description;
            $project->p_submitted_at=$project_old->p_submitted_at;
            $project->p_deadline=$project_old->p_deadline;
            $project->p_budget=$project_old->p_budget;
            $project->p_general_budget=$project_old->p_general_budget;
            $project->p_state=$project_old->p_state;
            $project->u_id=$project_old->u_id;
            $project->p_web_url =$project_old->p_web_url;
            $project->p_data_collection_location =$project_old->p_data_collection_location;
            $project->p_target_population =$project_old->p_target_population;
            $project->p_support_document =$project_old->p_support_document;
            $project->p_actual_state =$project_old->p_actual_state;
            $project->p_currency =$project_old->p_currency;
            $project->p_acronym =$project_old->p_acronym;
            $project->p_source =$project_old->p_source;
            $project->sa_id =$project_old->sa_id;
            $project->p_consortium =$project_old->p_consortium;
            $project->created_at=$project_old->created_at;
            $project->psm_id=($request->state=='Aprovado')?23:14;
            $project->p_updated_by=Auth::user()->u_id;
            $project->updated_at=now();
            $project->save();

            $email_notification = new PostAwardNotification();

            $get_email_pi = User::where('u_id', $project_old->u_id)->first();
            $sendTo = array(Auth::user()->email, $get_email_pi->email);
          
            if($request->state=='Aprovado'){
                $msg = 'Hello, the project '.$project_old->p_name.' has been Approved by the Ethical Unit';
            }else{
                $msg = 'Hello, the project '.$project_old->p_name.' has been Rejected by the Ethical Unit';
            }
            $data = array(
                'title'=> 'Ethical approval',
                'body'=> $msg,
                'document' => ($request->hasFile('carta_resposta'))?asset('docs/' . $dp_local_path):NULL,
                'subject' => 'Ethical approval'
            );
            $email_notification->sendEmail($sendTo, $data);
            return redirect()->back()->with('success', translate('requisao_submetida_sucesso'));
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Technical error. please contact to support team.');
        }
    }

    public function final_report_pi(Request $request)
    {
        $rules = [
            'final_report' => 'required|mimes:doc,docx,pdf'
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails())
        {
            return redirect()->back()->withErrors($validate->errors())->withInput();
        }
        $dp_local_path='';
        if($request->hasFile('final_report'))
        {
            $report = $request->file('final_report');
            $extension = $report->getClientOriginalExtension();
            $document = time().'.'.$extension;
            $dp_local_path = $document;
            $report->move(public_path('docs'), $document);
            $document_project_id = DB::table('dp_document_project')->max('dp_id') + 1;
            $document_project = new DocumentProject();
            $document_project->dp_id=$document_project_id;
            $document_project->dt_id=14;
            $document_project->p_id= base64_decode($request->p_id);
            $document_project->psm_id=21;
            $document_project->dp_name='Relatório Final';
            $document_project->dp_description='Relatório Final';
            $document_project->dp_local_path=$dp_local_path;
            $document_project->created_at=now();
            $document_project->updated_at=now();
            $document_project->save();

            $project_old= Project::where("p_id","=", base64_decode($request->p_id))->first();
            Project::where("p_id","=",base64_decode($request->p_id))
                ->update(['updated_at'=>now(),'deleted_at'=>now()]);

            $project = new Project();
            $project->p_id=$project_old->p_id;
            $project->p_name=$project_old->p_name;
            $project->p_description=$project_old->p_description;
            $project->p_submitted_at=$project_old->p_submitted_at;
            $project->p_deadline=$project_old->p_deadline;
            $project->p_budget=$project_old->p_budget;
            $project->p_general_budget=$project_old->p_general_budget;
            $project->p_state=$project_old->p_state;
            $project->u_id=$project_old->u_id;
            $project->p_web_url =$project_old->p_web_url;
            $project->p_data_collection_location =$project_old->p_data_collection_location;
            $project->p_target_population =$project_old->p_target_population;
            $project->p_support_document =$project_old->p_support_document;
            $project->p_actual_state =$project_old->p_actual_state;
            $project->p_currency =$project_old->p_currency;
            $project->p_acronym =$project_old->p_acronym;
            $project->p_source =$project_old->p_source;
            $project->sa_id =$project_old->sa_id;
            $project->p_consortium =$project_old->p_consortium;
            $project->created_at=$project_old->created_at;
            $project->psm_id=21;
            $project->p_updated_by=Auth::user()->u_id;
            $project->updated_at=now();
            $project->save();
        }

        $email_notification = new PostAwardNotification();
        $sendTo=[];
        $get_email_management = User::where('r_id', 8)->get(); // Role = Management
        foreach($get_email_management as $email){
            array_push($sendTo, $email->email);
        }
        $msg = 'Hello, the final report has been submitted for the project '. $request->p_name. "to approval. \n";

        $data = array(
            'title'=> 'Final report',
            'body'=> $msg,
            'document' => asset('docs/' . $dp_local_path),
            'subject' => 'Final report'
        );
        $email_notification->sendEmail($sendTo, $data);

        return redirect()->back()->with('success', translate('requisao_submetida_sucesso'));
    }
}
