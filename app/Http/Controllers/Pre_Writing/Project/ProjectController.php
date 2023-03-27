<?php

namespace App\Http\Controllers\Pre_writing\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cokie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

use App\Models\DocumentType;
use App\Models\MemberRole;
use App\Models\CismProjectCollaborator;
// use App\Models\Project;
// use App\Models\ProjectStageMicro;
use App\Models\Staff;
use App\Models\User;
use App\Models\WorkGroupMember;
use App\Models\WorkGroupProject;
use App\Models\ProjectQuestion;
use App\Models\ProjectAnswer;
// use Illuminate\Http\Request;
use App\Models\WorkGroupRole;
use App\Models\SearchArea;
// use Illuminate\Support\Facades\DB;

use App\Models\TimelineProject;
use App\Models\Recipient;
use App\Http\Controllers\Notification\EmailUserController;
use App\Http\Controllers\Pre_Writing\Project\VideoProjectController;
use App\Http\Controllers\Pre_Writing\Project\ProjectDateLimitController;
use App\Http\Controllers\Pre_Writing\Project\ProjectAnswerController;
use App\Http\Controllers\Pre_Writing\Project\ConsortiumMemberProjectController;
use App\Http\Controllers\Pre_Writing\Project\RecipientController;
use App\Http\Controllers\Configuration\ProjectStateController;
use App\Models\Funder;
use App\Models\Project;
//use App\Models\ProjectState;
// use App\Models\Staff;
// use App\Models\DocumentType;
use App\Models\ProjectStageMicro;

class ProjectController extends Controller
{
    private $video_project,
        $project_answer,
        $project_consortium,
        $project_state,
        $recipient;
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->video_project = new VideoProjectController();
        $this->project_answer = new ProjectAnswerController();
        $this->project_consortium = new ConsortiumMemberProjectController();
        $this->project_state = new ProjectStateController();
        $this->recipient = new RecipientController();
    }
    public function register(Request $request)
    {
        $search_project = SearchArea::where('deleted_at', NULl)
        ->get();
        $user_id = Auth::user()->u_id;
        $project_question = ProjectQuestion::whereNull('deleted_at')->get();

        $recipients = Recipient::get()->where('r_state', 1)->whereNull('deleted_at');

        $user_company =User::with('user_external_institution')
        ->where('u_id', Auth::user()->u_id)
        ->where('state',1)
        ->first();


        $staff = User::with('staff', 'user_external_institution')
        ->where('deleted_at', NULL)
        ->where('ui_id', 1)
        ->get();
        

        $funders = Funder::where('f_state', 1)->whereNull('deleted_at')->get();

        return view('pre_writing.principal_investigator.register_project', [
            'search_project' => $search_project,
            'users' => $staff,
            'funders' => $funders,
            'if_cism_collaborator' => !empty($user_company->user_external_institution)?$user_company->user_external_institution->ui_id:1,
            'project_question' =>$project_question,
            'recipients' => $recipients
        ]);
    }

    public function getProjectByInvestigator(Request $request)
    {

        $project = Project::with('project_stage_micro', 'project_research_area', 'project_state')
        ->whereNull('p_projects.deleted_at')
        ->where('p_projects.u_id', Auth::user()->u_id)
        ->where('psm_id', '<=', 5) //projetos em Pre award
        ->orderBy('p_projects.p_id', 'desc')
        ->get();
        // dd($project);
        // return $project;

        return view('pre_writing.principal_investigator.show_project_list', [
            'project' => $project,
        ]);
    }


    public function pi_project_detail($p_id)
    {
        $project = Project::with('user_project')
        ->where('p_id', base64_decode($p_id))
        ->first();
        $data_aprovacao = DB::table('p_projects')->select('updated_at')->where("psm_id", 2)->where('p_state', 'Em curso')->where('p_id', base64_decode($p_id))->first();
        // dd($data_aprovacao);
        $collaborator = CismProjectCollaborator::with('cism_collaborator')
        ->where('p_id', base64_decode($p_id))
        ->first();
        //dd($collaborator);
        $project_author = DB::table('s_staff')
        ->join('users', 'users.s_id', 's_staff.s_id')
        ->join('p_projects', 'p_projects.u_id', 'users.u_id')
        ->join('r_roles', 'r_roles.r_id', 'users.r_id')
        ->where('p_projects.p_id', base64_decode($p_id))
        ->where('users.state',1)
        ->first();



        $video = $this->video_project->show(base64_decode($p_id));
        $answers = $this->project_answer->show(base64_decode($p_id));
        // dd($answers);

        $project_document = DB::table('p_projects')
        ->join('dp_document_project', 'dp_document_project.p_id', 'p_projects.p_id')
        ->where('p_projects.p_id', base64_decode($p_id))
        ->first();

        return view('pre_writing.principal_investigator.project_detail', [
            'project' => $project,
            'project_author' => $project_author,
            'project_document' => $project_document,
            'collaborator' => $collaborator,
            'video' => $video,
            'answers' => $answers,
            'member_consortium' => $this->project_consortium->show(base64_decode($p_id)),
            'data_aprovacao' => $data_aprovacao
        ]);

    }

    public function create_project(Request $request, $project_stage_micro)
    {
        $p_id = DB::table('p_projects')->max('p_id') + 1;

        $user_id = session('user_id');
        $dp_local_path = '';
        if($request->hasFile('document'))
        {
            $file = $request->file('document');
            $extension = $file->getClientOriginalExtension();
            $document = time().'.'.$extension;
            $dp_local_path = $document;
            $request->document->move(public_path('docs'), $document);
        }


        $valor = str_replace('.00','',$request->input('project_budject'));
        $valor = str_replace(',','',$valor);

        $search_project_name = SearchArea::where('sa_name', $request->input('area_pesquisa'))->first();
        
        $sa_id2 = '';
        if(empty($search_project_name->sa_name)){
            $sa_id = DB::table('sa_search_area')->max('sa_id') + 1;
            $sa_id2 = $sa_id;
            SearchArea::create([
                'sa_id' => $sa_id,
                'sa_name' => $request->input('area_pesquisa'),
                'created_at' => now(),
                'updated_at' => now(),
                'sa_created_by' => Auth::user()->u_id,
                'sa_updated_by' => Auth::user()->u_id
            ]);
        }else{
            $sa_id2 = $search_project_name->sa_id;
        }
        // dd($sa_id2);
        $project = Project::create([
            'p_id' => $p_id,
            'p_name' => $request->input('project_name'),
            'p_acronym' => $request->input('acronimo'),
            'p_description' => $request->input('project_description'),
            'p_submitted_at' => now(),
            'p_deadline' => $request->input('estimated_deadline'),
            'p_budget' => $valor,
            'p_end_date' =>$request->input('start_date'),
            'p_web_url' => $request->input('web_url'),
            'p_support_document' => $dp_local_path,
            'p_source' => $request->input('p_source'),
            'p_state' => 'Em curso',
            'p_consortium' => $request->input('consortium'),
            'u_id' => Auth::user()->u_id,
            'p_currency' => $request->input('moeda'),
            'psm_id' => $project_stage_micro,
            'p_updated_by' => Auth::user()->u_id,
            'sa_id' => (int) $sa_id2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        //dd(session('user_company'));

        $this->video_project->store($request, $p_id);
        $this->project_answer->store($request, $p_id);
        $this->project_state->edit(1, $p_id);
        if($request->consortium == 'sim'){
            $this->project_consortium->store($request, $p_id);  
        }

        $user_company =User::with('user_external_institution')
        ->where('u_id', Auth::user()->u_id)
        ->where('state',1)
        ->first();

        if($user_company->user_external_institution->ui_id != 1){
            $cpc_id = DB::table('cpc_cism_project_collaborator')->max('cpc_id') + 1;
            CismProjectCollaborator::create([
                'cpc_id' => $cpc_id,
                'p_id' => $p_id,
                'cpc_cism_collaborator_id' => base64_decode($request->input('colaborador')),
                'cpc_created_by' => Auth::user()->u_id,
                'cpc_updated_by' => Auth::user()->u_id,
                'created_at' => now()
            ]);
        }

        $email = new EmailUserController();
        $email_user = $email->getEmailUsers(2); // envia a notificação para o oi e os usuários com role pre-award-manager

        array_push($email_user, Auth::user()->email);

        $message = array(
            'title'=> 'Proposal submitted', 'body'=>'Hello, a new project proposal with the name '.$request->project_name.' has been submitted for initial approval for the Pre Award Manager.'
        );
        // dd($email_user);
        $email->sendEmail($email_user, $message, 'New Proposal submitted');

    }


    public function store(Request $request)
    {
        // dd($request);
        // $user_company =User::with('user_external_institution')
        // ->where('u_id', Auth::user()->u_id)
        // ->where('state',1)
        // ->first();
        
        if($request->consortium == 'nao'){
            $rules = [
                'g-recaptcha-response' => 'recaptchav3:register,0.5',
                'project_name' => 'required',
                'start_date' => 'required',
                'acronimo' => 'required',
                // 'colaborador' => ($user_company->user_external_institution->ui_id != 1)?'required': NULL,
                'project_description' => 'required',
                'project_budject' => 'required',
                'estimated_deadline' => 'required',
                'area_pesquisa' => 'required',
                'moeda' => 'required',
                "resposta"    => "required|array|min:3",
                "resposta.*"  => "required|string|min:3",
                'video' => 'mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4,application/octet-stream|max:5000000'
            ];
        }else{
            $rules = [
                'project_name' => 'required',
                'start_date' => 'required',
                'project_description' => 'required',
                'acronimo' => 'required',
                'principal_recipient' => 'required',
                // 'colaborador' => ($user_company->user_external_institution->ui_id != 1)?'required': NULL,
                // 'sub_recipient' => 'required',
                'project_budject' => 'required',
                'estimated_deadline' => 'required',
                'area_pesquisa' => 'required',
                'moeda' => 'required',
                "resposta"    => "required|array|min:3",
                "resposta.*"  => "required|string|min:3",
                'video' => 'mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4,application/octet-stream|max:5000000'
            ];
        }
        $user_id = session('user_id');

        $messages = array(
            'project_name.required' => translate('este_campo_obrigatorio'),
            'project_description.required' => translate('este_campo_obrigatorio'),
            'acronimo.required' => translate('este_campo_obrigatorio'),
            'project_budject.required' => translate('este_campo_obrigatorio'),
            'sub_recipient.required' => translate('este_campo_obrigatorio'),
            'principal_recipient.required' => translate('este_campo_obrigatorio'),
            'estimated_deadline.required' => translate('este_campo_obrigatorio'),
            'start_date.required' => translate('este_campo_obrigatorio'),
            'area_pesquisa.required' => translate('este_campo_obrigatorio'),
            'moeda.required' => translate('este_campo_obrigatorio'),
            'video.mimetypes' => translate('video_invalido'),
            'video.max' => translate('tamanho_video'),
            'resposta.*.required' => translate('responda_questoes')
        );

        $validator = Validator::make($request->all(), $rules, $messages);


        if ($validator->fails()) {
            // dd($validator->errors());
            return redirect()->back()->withErrors($validator->errors())->withInput()->with('error', translate('verifique_todos_campos'));
        }

        $project = $this->create_project($request, 1); //Submissão de um projeto ainda na faze do pre_writing

        $project_created = Project::with('project_stage_micro')
        ->where('p_projects.deleted_at', NULL)
        ->where('p_projects.u_id', $user_id)
        ->orderBy('p_projects.created_at', 'desc')
        ->get();

        return redirect()->route('pre_writing.investigator.project', [
            'project' => $project_created
        ])->with('success', translate('requisao_submetida_sucesso'));

    }

    public function scientific_approval($p_id)
    {
        $response = Gate::inspect("isAdmin");
        $response2 = Gate::inspect("scientific_director"); 

        // if($response->allowed() || $response2->allowed()){
        if(session("role")==12){

            $project = Project::with('user_project')
            ->where('p_id', base64_decode($p_id))
            ->first();
            //dd($project);
            $project_author = DB::table('s_staff')
            ->join('users', 'users.s_id', 's_staff.s_id')
            ->join('p_projects', 'p_projects.u_id', 'users.u_id')
            ->join('r_roles', 'r_roles.r_id', 'users.r_id')
            ->where('p_projects.p_id', base64_decode($p_id))
            ->first();

            $project_document = DB::table('p_projects')
            ->join('dp_document_project', 'dp_document_project.p_id', 'p_projects.p_id')
            ->where('p_projects.p_id', base64_decode($p_id))
            ->first();

            $collaborator = CismProjectCollaborator::with('cism_collaborator')
            ->where('p_id', base64_decode($p_id))
            ->first();
            $video = $this->video_project->show(base64_decode($p_id));
            $answers = $this->project_answer->show(base64_decode($p_id));

            $user = DB::table('users')->where('u_id', $project->p_updated_by)
            ->join('s_staff', 's_staff.s_id', 'users.s_id')
            ->first();
            // dd($user);

            return view('pre_writing.pre_award_manager.approve_scientific_director',[
                'project' => $project,
                'project_author' => $project_author,
                'project_document' => $project_document,
                'collaborator' => $collaborator,
                'video'=>$video,
                'answers'=>$answers,
                'member_consortium' => $this->project_consortium->show(base64_decode($p_id)),
                'user' => $user
            ]);
        }else{
            // return 'Teste';
            abort(403, translate('nao_tem_permissao'));
            // return redirect()->route("auth");
        }
    }

    public function pre_award_manager_index()
    {
        // dd(Auth::user()->r_id);
        // if(Auth::user()->r_id == 2 ||)
        switch (Auth::user()->r_id) {
            case 2:
                $project = Project::with('project_stage_micro', 'project_research_area')
                ->whereNull('p_projects.deleted_at')
                ->where('p_projects.psm_id', '<=', 5)
                ->orderBy('p_projects.p_id', 'desc')
                ->get();
                return view('pre_writing.pre_award_manager.project_list',[
                    'projetos' => $project
                ]);
            break;
            case 12:
                $project = Project::with('project_stage_micro', 'project_research_area')
                ->whereNull('p_projects.deleted_at')
                ->where('p_projects.psm_id', 0)
                ->orderBy('p_projects.p_id', 'desc')
                ->get();   
                return view('pre_writing.pre_award_manager.project_list',[
                    'projetos' => $project
                ]);
                // return $project;             
            default:
            $project = Project::with('project_stage_micro', 'project_research_area')
                ->whereNull('p_projects.deleted_at')
                ->where('p_projects.psm_id','<=', 5)
                ->orderBy('p_projects.p_id', 'desc')
                ->get();   
                return view('pre_writing.pre_award_manager.project_list',[
                    'projetos' => $project
                ]);
            break;
            return redirect()->route('auth');
        }
    }
    public function project_state_index($id){

        $project=Project::with('work_group_project','time_line','user_project','documentsProject')
        ->where('dp_document_project.psm_id', 3)
        ->where('p_id','=',base64_decode($id))->first();
        return json_encode($project);
        // $investigators=Staff::get();
        $investigators = DB::table('users')->join('s_staff', 's_staff.s_id', 'users.s_id')
        ->where('users.state',1)
        ->whereNull('s_staff.deleted_at')
        ->get();
        $role_group=WorkGroupRole::get();
        $staff = DB::table('users')->join('s_staff', 's_staff.s_id', 'users.s_id')
        ->where('users.state',1)
        ->whereNull('s_staff.deleted_at')
        ->get();
        $document_type = DocumentType::get();
        $project_stage_micro = ProjectStageMicro::get();

        $timeline = TimelineProject::with('projectTimeline')
            ->where('p_id', base64_decode($id))
            ->first();

        return view('pre_writing.pre_award_manager.pre_writing_config', ['investigators'=>$investigators,'project'=>$project,'role_groups'=>$role_group,'staff' => $staff,
            'document_type' => $document_type,
            'project_stage_micro' => $project_stage_micro,
            'projects' => $project,
            'timeline' => $timeline
        ]);
    }
/************************************ */
    public function project_details($p_id)
    {
        $response = Gate::inspect("isAdmin");
        $response2 = Gate::inspect("pre_award_manager");

        if($response->allowed() || $response2->allowed()){

            $project = Project::with('user_project')
            ->where('p_id', base64_decode($p_id))
            ->first();
            //dd($project);
            $project_author = DB::table('s_staff')
            ->join('users', 'users.s_id', 's_staff.s_id')
            ->join('p_projects', 'p_projects.u_id', 'users.u_id')
            ->join('r_roles', 'r_roles.r_id', 'users.r_id')
            ->where('p_projects.p_id', base64_decode($p_id))
            ->first();


            $project_document = DB::table('p_projects')
            ->join('dp_document_project', 'dp_document_project.p_id', 'p_projects.p_id')
            ->where('p_projects.p_id', base64_decode($p_id))
            ->first();

            $collaborator = CismProjectCollaborator::with('cism_collaborator')
            ->where('p_id', base64_decode($p_id))
            ->first();
            $video = $this->video_project->show(base64_decode($p_id));
            $answers = $this->project_answer->show(base64_decode($p_id)); 

            $nr_days = ProjectDateLimitController::getDateDifference(base64_decode($p_id));
            // return $nr_days;
            if($nr_days[0]->nr_dias>= 180){
                ProjectDateLimitController::setProjectLost(base64_decode($p_id));
            }

            return view('pre_writing.pre_award_manager.project_detail',[
                'project' => $project,
                'project_author' => $project_author, 
                'project_document' => $project_document,
                'collaborator' => $collaborator,
                'video'=>$video,
                'answers'=>$answers,
                'nr_days' => $nr_days,
                'member_consortium' => $this->project_consortium->show(base64_decode($p_id))
            ]);
        }else{
            return redirect()->route("auth");
        }
    }
    public function pre_award_manager_approval($id){
        $response = Gate::inspect("isAdmin");
        $response2 = Gate::inspect("pre_award_manager");

        if($response->allowed() || $response2->allowed()){

            $project=Project::with('work_group_project','time_line','user_project','documentsProject', 'project_state')
            ->where('p_id','=',base64_decode($id))
            ->where('p_projects.deleted_at', NULL)
            ->first();
            // dd($project);
            $investigators=Staff::get();
            $role_group=WorkGroupRole::get();
            // dd($project);
            return view('Pre_writing.Pre_award_manager.approval',[
                'project' => $project,
                'investigators'=>$investigators,
                'role_groups'=>$role_group
            ]);
        }else{
            return redirect()->route("auth");
        }
    }


    public function project_approval(Request $request)
    {

        $response = Gate::inspect("pre_award_manager");
        $response2 = Gate::inspect("isAdmin");

        if($response->allowed() || $response2->allowed()){

            if($request->input('p_state') == 'Aprovado') { // aprovado

                $rules = [
                    'p_state' => 'required'
                ];

                $messages = array(
                    'p_state.required' => translate('este_campo_obrigatorio')
                );

                $validator = Validator::make($request->all(), $rules, $messages);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator->errors())->withInput();
                }
                $old_project = DB::table('p_projects')->where('p_id', base64_decode($request->input('project_id')))
                ->where('deleted_at', NULl)
                ->first();

                Project::where('p_id', base64_decode($request->input('project_id')))
                ->update([
                    'deleted_at' => now()
                ]);

                //dd($old_project);

               Project::create([
                    'p_id' => base64_decode($request->input('project_id')),
                    'p_name' => $old_project->p_name,
                    'p_acronym' => $old_project->p_acronym,
                    'p_consortium' => $old_project->p_consortium,
                    'p_description' => $old_project->p_description,
                    'p_submitted_at' => now(),
                    'p_end_date'=>$old_project->p_end_date,
                    'p_deadline' => $old_project->p_deadline,
                    'p_budget' => $old_project->p_budget,
                    'p_web_url' => $old_project->p_web_url,
                    'p_support_document' => $old_project->p_support_document,
                    'p_source' => $old_project->p_source,
                    'p_general_budget' => $old_project->p_general_budget,
                    'p_state' => $old_project->p_state,
                    'u_id' => $old_project->u_id,
                    'p_currency' => $old_project->p_currency,
                    'sa_id' => $old_project->sa_id,
                    'psm_id' => 5,
                    'p_updated_by' => Auth::user()->u_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);



            }else{ // reprovado
                // dd($request->input('p_state'));
                $rules = [
                    'p_state' => 'required',
                    'reasons'=> 'required'
                ];

                $messages = array(
                    'p_state.required' => translate('este_campo_obrigatorio'),
                    'reasons.required' => translate('este_campo_obrigatorio'),
                );

                $validator = Validator::make($request->all(), $rules, $messages);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator->errors())->withInput()->with('error', translate('ocorreu_erro'));
                }
                $old_project = DB::table('p_projects')->where('p_id', base64_decode($request->input('project_id')))
                ->where('deleted_at', NULl)
                ->first();

                Project::where('p_id', base64_decode($request->input('project_id')))
                ->update([
                    'deleted_at' => now()
                ]);

        //         //dd($old_project);

               Project::create([
                    'p_id' => base64_decode($request->input('project_id')),
                    'p_name' => $old_project->p_name,
                    'p_consortium' => $old_project->p_consortium,
                    'p_acronym' => $old_project->p_acronym,
                    'p_description' => $old_project->p_description,
                    'p_submitted_at' => $old_project->p_submitted_at,
                    'p_end_date' => $old_project->p_end_date,
                    'p_deadline' => $old_project->p_deadline,
                    'p_budget' => $old_project->p_budget,
                    'p_web_url' => $old_project->p_web_url,
                    'p_support_document' => $old_project->p_support_document,
                    'p_source' => $old_project->p_source,
                    'p_general_budget' => $old_project->p_general_budget,
                    'p_state' => 'Rejeitado',
                    'p_reasons'=> $request->input('reasons'),
                    'u_id' => $old_project->u_id,
                    'p_currency' => $old_project->p_currency,
                    'sa_id' => $old_project->sa_id,
                    'psm_id' => 5,
                    'p_updated_by' => Auth::user()->u_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

            }
        }else{
            return redirect()->route("auth");
        }

        $email = new EmailUserController(); 
        $get_email_pi = User::where('u_id', $old_project->u_id)->first();
        $sendTo = array(Auth::user()->email, $get_email_pi->email);
        $msg = '';

        if($request->input('p_state') === 'Aprovado')
            $msg = 'Hello, the project proposal '.$old_project->p_name.' has been approved by the Pre-Award Manager.';
        else
            $msg = 'Hello, the project proposal '.$old_project->p_name. ' has been reproved by the Pre-Award Manager.';

        $message = array(
            'title'=> 'Final approval',
            'body'=> $msg
        );

        $email->sendEmail($sendTo, $message, 'Final approval');

        $project = DB::table('p_projects')
        ->where('deleted_at', NULL)
        ->orderBy('p_id', 'desc')
        ->get();
        return redirect()->route('pam.project_list', [
            'projetos' => $project
        ])->with('success', translate('requisao_submetida_sucesso'));

    }
    public function second_scientific_approval(Request $request)
    {
        if($request->input('p_state') == 'Aprovado') { // aprovado
            $rules = [
                'p_state' => 'required'
            ];

            $messages = array(
                'p_state.required' => translate('este_campo_obrigatorio')
            );

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput();
            }

            $old_project = DB::table('p_projects')->where('p_id', base64_decode($request->input('project_id')))->first();
            Project::where('p_id', base64_decode($request->input('project_id')))
            ->update([
                'deleted_at' => now(),
                'p_state' => 'Rejeitado',
                'p_updated_by' => Auth::user()->id
            ]);
           Project::create([
                'p_id' => base64_decode($request->input('project_id')),
                'p_name' => $old_project->p_name,
                'p_consortium' => $old_project->p_consortium,
                'p_acronym' => $old_project->p_acronym,
                'p_description' => $old_project->p_description,
                'p_submitted_at' => $old_project->p_submitted_at,
                'p_deadline' => $old_project->p_deadline,
                'p_end_date' => $old_project->p_end_date,
                'p_budget' => $old_project->p_budget,
                'p_web_url' => $old_project->p_web_url,
                'p_support_document' => $old_project->p_support_document,
                'p_source' => $old_project->p_source,
                'p_general_budget' => $old_project->p_general_budget,
                'p_state' => 'Em curso',
                'u_id' => $old_project->u_id,
                'p_currency' => $old_project->p_currency,
                'sa_id' => $old_project->sa_id,
                'psm_id' =>2,
                'p_updated_by' => Auth::user()->u_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $message = array(
                'title'=> 'Scientific approval', 'body'=>'Hello, the project proposal '.$old_project->p_name.' has been Approved'. " .  \n".
                ' Access our platform via the link below for more information.'
            );

        }else{ 
            $rules = [
                'p_state' => 'required',
                'reasons' => 'required'
            ];

            $messages = array(
                'p_state.required' => translate('este_campo_obrigatorio'),
                'reasons.required' => translate('este_campo_obrigatorio')
            );

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput()->with('error', translate('ocorreu_erro'));
            }

            $old_project = DB::table('p_projects')->where('p_id', base64_decode($request->input('project_id')))->first();
            Project::where('p_id', base64_decode($request->input('project_id')))
            ->update([
                'p_state' => $request->input('p_state'),
                'p_updated_by' =>Auth::user()->u_id,
                'deleted_at' => now(),
            ]);

            Project::create([
                'p_id' => base64_decode($request->input('project_id')),
                'p_name' => $old_project->p_name,
                'p_consortium' => $old_project->p_consortium,
                'p_acronym' => $old_project->p_acronym,
                'p_description' => $old_project->p_description,
                'p_submitted_at' => $old_project->p_submitted_at,
                'p_deadline' => $old_project->p_deadline,
                'p_end_date' => $old_project->p_end_date,
                'p_budget' => $old_project->p_budget,
                'p_web_url' => $old_project->p_web_url,
                'p_support_document' => $old_project->p_support_document,
                'p_source' => $old_project->p_source,
                'p_general_budget' => $old_project->p_general_budget,
                'p_state' => 'Rejeitado',
                'p_reasons' =>$request->input("reasons"),
                'u_id' => $old_project->u_id,
                'psm_id' => 1,
                'sa_id' => $old_project->sa_id,
                'p_currency' => $old_project->p_currency,
                'p_updated_by' => Auth::user()->u_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $message = array(
                'title'=> 'Scientific approval', 'body'=>'Hello, the project proposal '.$old_project->p_name.' has been Rejected'. " .  \n Because: ".$request->reasons.".
                \n \n Access our platform via the link below for more information."
            );
        }
        $sendTo=[];
        $email_user_controller = new EmailUserController();
        $email_user = $email_user_controller->getEmailUsers(12); // busca os emails dos usuários com role grant-manager

        $get_email_pi = User::where('u_id', $old_project->u_id)->first();

        array_push($sendTo,
            Auth::user()->email, 
            $get_email_pi->email
        );
        foreach($email_user as $email){
            array_push($sendTo, $email);
        }

        // return $sendTo;
        // return $message;
        
        $email_user_controller->sendEmail($sendTo, $message, 'Scientific approval');

        return redirect()->back()->with('success', translate('requisao_submetida_sucesso'));
        
    }
    public function first_project_approval(Request $request)
    {
        if($request->input('p_state') == 'Aprovado') { // aprovado
            $rules = [
                'p_state' => 'required'
            ];

            $messages = array(
                'p_state.required' => translate('este_campo_obrigatorio')
            );

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput();
            }

            $old_project = DB::table('p_projects')->where('p_id', base64_decode($request->input('project_id')))->first();
            Project::where('p_id', base64_decode($request->input('project_id')))
            ->update([
                'deleted_at' => now(),
                'p_state' => 'Rejeitado',
                'p_updated_by' => Auth::user()->id
            ]);
           Project::create([
                'p_id' => base64_decode($request->input('project_id')),
                'p_name' => $old_project->p_name,
                'p_consortium' => $old_project->p_consortium,
                'p_acronym' => $old_project->p_acronym,
                'p_description' => $old_project->p_description,
                'p_submitted_at' => $old_project->p_submitted_at,
                'p_deadline' => $old_project->p_deadline,
                'p_end_date' => $old_project->p_end_date,
                'p_budget' => $old_project->p_budget,
                'p_web_url' => $old_project->p_web_url,
                'p_support_document' => $old_project->p_support_document,
                'p_source' => $old_project->p_source,
                'p_general_budget' => $old_project->p_general_budget,
                'p_state' => 'Em curso',
                'u_id' => $old_project->u_id,
                'p_currency' => $old_project->p_currency,
                'sa_id' => $old_project->sa_id,
                'psm_id' =>0,
                'p_updated_by' => Auth::user()->u_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $message = array(
                'title'=> 'First approval', 'body'=>'Hello, the project proposal '.$old_project->p_name." has been Approved. \n".
                ' Access our platform via the link below for more information.'
            );

        }else{ 
            $rules = [
                'p_state' => 'required',
                'reasons' => 'required'
            ];

            $messages = array(
                'p_state.required' => translate('este_campo_obrigatorio'),
                'reasons.required' => translate('este_campo_obrigatorio')
            );
            

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput()->with('error', translate('ocorreu_erro'));
            }

            $old_project = DB::table('p_projects')->where('p_id', base64_decode($request->input('project_id')))->first();
            Project::where('p_id', base64_decode($request->input('project_id')))
            ->update([
                'p_state' => $request->input('p_state'),
                'p_updated_by' =>Auth::user()->u_id,
                'deleted_at' => now(),
            ]);

            Project::create([
                'p_id' => base64_decode($request->input('project_id')),
                'p_name' => $old_project->p_name,
                'p_consortium' => $old_project->p_consortium,
                'p_acronym' => $old_project->p_acronym,
                'p_description' => $old_project->p_description,
                'p_submitted_at' => $old_project->p_submitted_at,
                'p_deadline' => $old_project->p_deadline,
                'p_end_date' => $old_project->p_end_date,
                'p_budget' => $old_project->p_budget,
                'p_web_url' => $old_project->p_web_url,
                'p_support_document' => $old_project->p_support_document,
                'p_source' => $old_project->p_source,
                'p_general_budget' => $old_project->p_general_budget,
                'p_state' => 'Rejeitado',
                'p_reasons' =>$request->input("reasons"),
                'u_id' => $old_project->u_id,
                'psm_id' => $old_project->psm_id,
                'sa_id' => $old_project->sa_id,
                'p_currency' => $old_project->p_currency,
                'p_updated_by' => Auth::user()->u_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $message = array(
                'title'=> 'First approval', 'body'=>'Hello, the project proposal '.$old_project->p_name.' has been Rejected.'. "\n Because: ".$request->reasons.  
                ' . Access our platform via the link below for more information.'
            );
        }
        $sendTo=[];
        $email_user_controller = new EmailUserController();
        $email_user = $email_user_controller->getEmailUsers(12); // busca os emails dos usuários com role de director cientifico
        $get_email_pi = User::where('u_id', $old_project->u_id)->first();

        array_push($sendTo, Auth::user()->email, $get_email_pi->email);
        
        foreach($email_user as $email){
            array_push($sendTo, $email);
        }
        
        // $message = array(
        //     'title'=> 'First approval', 'body'=>'Hello, the project proposal'.$old_project->p_name.' has been '.($request->input('p_state')=='Aprovado')?'Approved':'Rejected'. ' .  '.
        //     ' Access our platform via the link below for more information.'
        // );
        $email_user_controller->sendEmail($sendTo, $message, 'First approval');

        $project = DB::table('p_projects')
        ->whereNull('deleted_at')
        ->orderBy('p_id')
        ->get();
        return redirect()->route('pam.project_list', [
            'projetos' => $project
        ])->with('success', translate('requisao_submetida_sucesso'));

    }

    public function grant_manager_index()
    {
       

        $project = DB::table('ps_project_state')
        ->join('p_projects', 'ps_project_state.p_id', 'p_projects.p_id')
        ->join('users', 'ps_project_state.ps_created_by', 'users.u_id')
        ->join('s_staff', 'users.s_id', 's_staff.s_id')
        ->where('users.r_id', 2)
        ->where('ps_state', 'Aprovado')
        ->get();


        return view('pre_writing.grant_manager.index',[
            'projetos' => $project,

        ]);
    }

    public function grant_manager_edit(Request $request, $p_id)
    {
        $project = Project::with('user_project')
        ->where('p_id', base64_decode($p_id))
        ->first();

        $project_author = DB::table('s_staff')
        ->join('users', 'users.s_id', 's_staff.s_id')
        ->join('p_projects', 'p_projects.u_id', 'users.u_id')
        ->join('r_roles', 'r_roles.r_id', 'users.r_id')
        ->where('p_projects.p_id', base64_decode($p_id))
        ->where('users.state',1)
        ->first();

        $project_document = DB::table('p_projects')
        ->join('dp_document_project', 'dp_document_project.p_id', 'p_projects.p_id')
        ->where('p_projects.p_id', base64_decode($p_id))
        ->first();

        $work_group = DB::table('p_projects')
        ->join('wgp_work_group_project', 'wgp_work_group_project.p_id', 'p_projects.p_id')
        ->join('wgm_work_group_member', 'wgm_work_group_member.wgp_id', 'wgp_work_group_project.wgp_id')
        ->join('wgr_work_group_role', 'wgr_work_group_role.wgr_id', 'wgm_work_group_member.wgr_id')
        ->join('s_staff', 's_staff.s_id', 'wgm_work_group_member.s_id')
        ->where('p_projects.p_id', base64_decode($p_id))
        ->get();

        // $staff = Staff::get();
        $staff = DB::table('users')->join('s_staff', 's_staff.s_id', 'users.s_id')
        ->where('users.state',1)
        ->whereNull('s_staff.deleted_at')
        ->get();
        $document_type = DocumentType::get();
        $project_stage_micro = ProjectStageMicro::get(); 

        
        return view('pre_writing.grant_manager.approval',[
            'project' => $project,
            'project_author' => $project_author,
            'project_document' => $project_document,
            'workgroup' => $work_group,
            'staff' => $staff,
            'document_type' => $document_type,
            'project_stage_micro' => $project_stage_micro
        ]);
    }

    public function document_download($pd_id){
        //dd(asset('docs/index.php'));
        return Storage::download(asset('docs/index.php'));
    }

    public function remove_project(Request $request)
    {
        Project::where('p_id', base64_decode($request->input('project_id')))
        ->update([
            'deleted_at' => now(),
            'u_id' => Auth::user()->u_id
        ]);

        return redirect()->back()->with("success", translate('requisao_submetida_sucesso'));
    }

    public function pre_award_dashboard()
    {
        return view('pre_writing.pre_award_manager.index');
    }
}
