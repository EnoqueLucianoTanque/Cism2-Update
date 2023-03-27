<?php

namespace App\Http\Controllers\Pre_Writing\GrantManager;

use App\Http\Controllers\Controller;
use App\Models\DocumentProject;
use App\Models\DocumentType;
use App\Models\Project;
use App\Models\ProjectStageMicro;
use App\Models\Staff;
use App\Models\User;
use App\Models\TimelineProject;
use App\Models\WorkGroupRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Notification\PostAwardNotification;
use App\Http\Controllers\Notification\EmailUserController;

class PreWritingConfigController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $investigators=Staff::get();
        $role_group=WorkGroupRole::get();
        $staff = Staff::get();
        $document_type = DocumentType::get();
        $project_stage_micro = ProjectStageMicro::get();


        return view('pre_writing.grant_manager.pre_writing_config', [
            'investigators'=>$investigators,
            'role_groups'=>$role_group,
            'staff' => $staff,
            'document_type' => $document_type,
            'project_stage_micro' => $project_stage_micro
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
        $user_id = session('user_id');
        try{

            $rules = [
                'support_document' => 'nullable|mimes:docx,doc,pdf',
                'orcamento_geral' => 'required|string',
            ];
            $messages = array(
                'support_document.nullable' => translate('documento_invalido'),
                'orcamento_geral.required' => translate('este_campo_obrigatorio')
            );

            $validate = Validator::make($request->all(), $rules, $messages);
            if ($validate->fails())
            {
                return response()->json(['success' => false, 'message' => $validate->errors(),'state'=>412,'data'=>array()], 200);
            }
            $dp_local_path = '';
            if($request->hasFile('support_document'))
            {
                $file = $request->file('support_document');
                $extension = $file->getClientOriginalExtension();
                $document = time().'.'.$extension;
                $dp_local_path = $document; 
                $request->support_document->move(public_path('docs'), $document);
            }


            $dp_id = DB::table('dp_document_project')->max('dp_id') + 1;
            //dd(base64_decode($request->input('p_id')));
            DocumentProject::create([
                'dp_id' => $dp_id,
                'p_id' => base64_decode($request->input('p_id')),
                'dt_id' => 5,
                'psm_id' => 3,
                'dp_name' => 'Documento de suporte',
                'dp_description' => 'Documento de suporte',
                'dp_local_path' => $dp_local_path
            ]);
            $project_old= Project::where("p_id","=",base64_decode($request->p_id))->first();
            Project::where("p_id","=",base64_decode($request->p_id))
            ->update(['p_updated_by'=>1,'updated_at'=>now(),'deleted_at'=>now()]);

            $orcamento = str_replace('.00','', $request->orcamento_geral);
            $orcamento = str_replace(',','',$orcamento);


            $project = new Project();
            $project->p_id = $project_old->p_id;
            $project->p_name = $project_old->p_name;
            $project->p_description = $project_old->p_description;
            $project->p_submitted_at = $project_old->p_submitted_at;
            $project->p_deadline = $project_old->p_deadline;
            $project->p_budget = $project_old->p_budget;
            $project->p_web_url = $project_old->p_web_url;
            $project->p_end_date = $project_old->p_end_date;
            $project->p_support_document = $project_old->p_support_document;
            $project->p_source = $project_old->p_source;
            $project->p_general_budget = $orcamento;
            $project->p_currency = $project_old->p_currency;
            $project->p_state = $project_old->p_state;
            $project->u_id = $project_old->u_id;
            $project->psm_id = 4;
            $project->created_at = $project_old->created_at;
            $project->p_updated_by = $user_id;
            $project->sa_id = $project_old->sa_id;
            $project->p_acronym = $project_old->p_acronym;
            $project->p_consortium = $project_old->p_consortium;
            $project->updated_at = now();
            $project->save();

            $email = new EmailUserController();
            $sendTo = $email->getEmailUsers(2);

            $get_email_pi = User::where('u_id', $project_old->u_id)->first();

            $email_notification = new PostAwardNotification();

            array_push($sendTo, Auth::user()->email, $get_email_pi->email);

            $msg = 'Hello, The Grant Manager submitted the budget for the proposal. '.$project_old->p_name.' and awaits final approval from the pre-award manager.';

            $data = array(
                'title'=> 'Budget submission',
                'body'=> $msg,
                'document' => asset('docs/' . $dp_local_path),
                'subject' => 'Budget submission'
            );

        $email_notification->sendEmail($sendTo, $data, '');


           return response()->json(['success' => false, 'message' => translate('requisao_submetida_sucesso'),'state'=>200,'data'=>array()], 200);

        } catch (Exception $ex) {
            return response()->json(['success' => false, 'message' => "Technical error. please contact to support team.",'state'=>500,'data'=>array()], 200);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project=Project::with('work_group_project','time_line','user_project','documentsProject')->where('p_id','=',base64_decode($id))->first();
        //return json_encode($project);
        $investigators=Staff::get();
        $role_group=WorkGroupRole::get();
        $staff = Staff::get();
        $document_type = DocumentType::get();
        $project_stage_micro = ProjectStageMicro::get();

        $timeline = TimelineProject::with('projectTimeline')
            ->where('p_id', base64_decode($id))
            ->first();

        return view('pre_writing.grant_manager.pre_writing_config', ['investigators'=>$investigators,'project'=>$project,'role_groups'=>$role_group,'staff' => $staff,
            'document_type' => $document_type,
            'project_stage_micro' => $project_stage_micro,
            'projects' => $project, 
            'timeline' => $timeline
        ]);
    }
    public function grant_manager_index()
    {

        $project= Project::with('work_group_project','time_line','user_project','documentsProject','project_state', 'project_research_area')
        ->where('p_projects.deleted_at', NULL)
        ->where('p_projects.psm_id', 3)
        ->get();
        // dd($project);

        return view('pre_writing.grant_manager.project_list',[
            'projetos' => $project
        ]);
    }

    public function grant_manager_approval($id){
        $project=Project::with('work_group_project','time_line','user_project','documentsProject')
        ->where('p_id','=',base64_decode($id))
        ->where('p_projects.deleted_at', NULL)
        ->first();
        // dd($project);
        $investigators=Staff::get();
        $role_group=WorkGroupRole::get();
        
        $data_aprovacao = DB::table('p_projects')->select('updated_at')->where("psm_id", 2)->where('p_state', 'Em curso')->where('p_id', base64_decode($id))->first();
        // dd($data_aprovacao);

        return view('pre_writing.grant_manager.approval',[
            'project' => $project,
            'investigators'=>$investigators,
            'role_groups'=>$role_group,
            'data_aprovacao' => $data_aprovacao
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
        //
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
}
