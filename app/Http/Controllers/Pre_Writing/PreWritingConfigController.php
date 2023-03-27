<?php

namespace App\Http\Controllers\Pre_Writing;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\DocumentType;
use App\Models\MemberRole;
use App\Models\Project;
use App\Models\ProjectStageMicro;
use App\Models\Staff;
use App\Models\User;
use App\Models\WorkGroupMember;
use App\Models\WorkGroupProject;
use App\Models\WorkGroupRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\TimelineProject;

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


        return view('pre_writing.pre_award_manager.pre_writing_config', [
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

    public function store_timeline_project(Request $request)
    {
        $project_id = base64_decode($request->input('project_id'));

        $tp_id = DB::table('tp_timeline_project')->max('tp_id') + 1;
        TimelineProject::create([
            'p_id' => $project_id,
            'tp_id' => $tp_id,
            'tp_start_at' => $request->input('data_inicio'),
            'tp_end_date' => $request->input('data_fim'),
            'tp_created_by' => Auth::user()->u_id,
            'tp_updated_by' => Auth::user()->u_id,
        ]);
    }
    public function store(Request $request)
    {
        // try {
            $work_group_project = WorkGroupProject::where('p_id',base64_decode($request->project_id))
            ->first();
            $working_project_group_id = '';
            if(!empty($work_group_project)){
                $working_project_group_id = $work_group_project->wgp_id;
            }else{
                $working_project_group_id = DB::table('wgp_work_group_project')->max('wgp_id') + 1;
            }
            WorkGroupProject::where("p_id","=",base64_decode($request->project_id))
                ->update(['wgp_created_by'=>Auth::user()->u_id,'updated_at'=>now(),'deleted_at'=>now()]);

//        try {
            $this->store_timeline_project($request);


            $working_project_group = new WorkGroupProject();
            $working_project_group->wgp_id = $working_project_group_id;
            $working_project_group->wgp_name = '';
            $working_project_group->wgp_description = 'Grupo de trabalho';
            $working_project_group->wgp_start_date = now();
            $working_project_group->p_id = base64_decode($request->project_id);
            $working_project_group->wgp_created_by = Auth::user()->u_id;
            $working_project_group->wgp_updated_by = Auth::user()->u_id;
            if ($working_project_group->save()) {


                for ($i = 0; $i < (int)$request->max_index; $i++) {

                    if (isset($request["membro_selected_" . $i]) && isset($request["role_" . $i])) {
                        $work_group_member_id = DB::table('wgm_work_group_member')->max('wgm_id') + 1;

                        $work_group_member = new WorkGroupMember();
                        $work_group_member->wgm_id = $work_group_member_id;
                        $work_group_member->wgm_name = $request["membro_selected_" . $i];
                        $work_group_member->wgm_description = $request["membro_selected_" . $i];
                        $work_group_member->wgr_id = $request["role_" . $i][0];
                        $work_group_member->wgm_start_date = now();
                        $work_group_member->s_id = $this->check_staff($request["membro_selected_" . $i])->s_id;
                        $work_group_member->wgp_id = $working_project_group_id;
                        $work_group_member->wgm_created_by = Auth::user()->u_id;
                        $work_group_member->wgm_updated_by = Auth::user()->u_id;

                        $work_group_member->save();
                        foreach ($request["role_" . $i] as $role){
                            $member_role_id = DB::table('mr_member_role')->max('mr_id') + 1;
                            $member_role = new MemberRole();
                            $member_role->mr_id=$member_role_id;
                            $member_role->mr_start_date=now();
                            $member_role->wgm_id=$work_group_member_id;
                            $member_role->wgr_id=$role;
                            $member_role->mr_created_by=Auth::user()->u_id;
                            $member_role->mr_updated_by=Auth::user()->u_id;
                            $member_role->save();

                        }

                    }
                }

                $old_project = DB::table('p_projects')
                ->where('p_id', base64_decode($request->project_id))
                ->where('deleted_at', NULL)
                ->first();
                Project::where('p_id', base64_decode($request->project_id))
                ->update([
                    'deleted_at' => now()
                ]);

           Project::create([
                'p_id' => base64_decode($request->input('project_id')),
                'p_name' => $old_project->p_name,
                'p_consortium' => $old_project->p_consortium,
                'p_acronym' => $old_project->p_acronym,
                'p_description' => $old_project->p_description,
                'p_submitted_at' => $old_project->p_submitted_at,
                'p_deadline' => $old_project->p_deadline,
                'p_budget' => $old_project->p_budget,
                'p_end_date'=>$old_project->p_end_date,
                'p_web_url' => $old_project->p_web_url,
                'p_support_document' => $old_project->p_support_document,
                'p_source' => $old_project->p_source,
                'p_general_budget' => $old_project->p_general_budget,
                'p_state' => "Em curso",
                'u_id' => $old_project->u_id,
                'psm_id' => 2,
                'sa_id' => $old_project->sa_id,
                'p_currency' => $old_project->p_currency,
                'p_updated_by' => Auth::user()->u_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
                return response()->json(['success' => false, 'message' => translate('requisao_submetida_sucesso'),'state'=>200,'data'=>array()], 200);

            }
            return response()->json(['success' => false, 'message' => translate('requisao_submetida_sucesso'),'state'=>200,'data'=>array()], 200);

    }
    function check_staff($name){
        $staff = Staff::where('s_name','like',$name)->first();
        if (empty($staff)){
            $staff_id = DB::table('s_staff')->max('s_id') + 1;

            $staff= new Staff();
            $staff->s_id= $staff_id;
            $staff->s_name=$name;
            $staff->save();

            $user = new User();
            $u_id = DB::table('users')->max('u_id')+1;

            $user->u_id = $u_id;
            $user->id= $u_id;
            $user->s_id = $staff_id;
            $user->r_id = 11;
            $user->state = 1;
            $user->username = '';
            $user->email = trim($name, " ").'@cism';
            $user->password = Hash::make('cism');
            $user->save();
            return $staff;
        }
        return $staff;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project=Project::with('work_group_project','time_line','user_project','documentsProject')
        ->where('p_id','=',base64_decode($id))->first();
        //return json_encode($project);
        $investigators=Staff::get();
        $role_group=WorkGroupRole::get();
        $staff = Staff::get();
        $document_type = DocumentType::get();
        $project_stage_micro = ProjectStageMicro::get();

        $timeline = TimelineProject::with('projectTimeline')
            ->where('p_id', base64_decode($id))
            ->first();


//        $project = Project::with('documentsProject', 'user_project')
//        ->where('p_id', base64_decode($id))
//        ->first();
        return view('pre_writing.grant_manager.pre_writing_config', ['investigators'=>$investigators,'project'=>$project,'role_groups'=>$role_group,'staff' => $staff,
            'document_type' => $document_type,
            'project_stage_micro' => $project_stage_micro,
            'projects' => $project,
            'timeline' => $timeline
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
        $project=Project::with('work_group_project','time_line','user_project','documentsProject')
        ->where('p_id','=',base64_decode($id))
        ->first();

        $investigators=Staff::get();
        $role_group=WorkGroupRole::get();
        $staff = Staff::get();
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
