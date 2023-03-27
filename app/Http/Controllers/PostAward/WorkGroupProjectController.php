<?php

namespace App\Http\Controllers\PostAward;

use App\Http\Controllers\Controller;
use App\Models\MemberRole;
use App\Models\Staff;
use App\Models\WorkGroupMember;
use App\Models\WorkGroupProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WorkGroupProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // try {
        \App\Models\WorkGroupProject::where("p_id","=",base64_decode($request->project_id))->where('ps_id','=',2)
            ->update(['wgp_created_by'=>1,'updated_at'=>now(),'deleted_at'=>now()]);

//        try {
        $working_project_group_id = DB::table('wgp_work_group_project')->max('wgp_id') + 1;
        $working_project_group = new WorkGroupProject();
        $working_project_group->wgp_id = $working_project_group_id;
        $working_project_group->wgp_name = '';
        $working_project_group->ps_id =2;
        $working_project_group->wgp_description = 'Grupo de trabalho';
        $working_project_group->wgp_start_date = now();
        $working_project_group->p_id = base64_decode($request->project_id);
        $working_project_group->wgp_created_by = Auth::user()->u_id;
        $working_project_group->wgp_updated_by = Auth::user()->u_id;
        if ($working_project_group->save()) {
//                return response()->json(['success' => false, 'message' => (int)$request->max_index,'state'=>200,'data'=>array()], 200);
            $work_group_project = WorkGroupProject::where('p_id',base64_decode($request->project_id))
            ->first();
            $working_project_group_id = '';
            if(!empty($work_group_project)){
                $working_project_group_id = $work_group_project->wgp_id;
            }else{
                $working_project_group_id = DB::table('wgp_work_group_project')->max('wgp_id') + 1;
            }
            for ($i = 0; $i < (int)$request->max_index; $i++) {

                if (isset($request["membro_selected_" . $i]) && isset($request["role_" . $i])) {
                    $work_group_member_id = DB::table('wgm_work_group_member')->max('wgm_id') + 1;

                    $work_group_member = new WorkGroupMember();
                    $work_group_member->wgm_id = $work_group_member_id;
                    $work_group_member->wgm_name = $request["membro_selected_" . $i];
                    $work_group_member->wgm_description = $request["membro_selected_" . $i];
                    $work_group_member->wgr_id = 1;
                    $work_group_member->wgm_start_date = now();
                    $work_group_member->s_id = $this->check_staff($request["membro_selected_" . $i])->s_id;
                    $work_group_member->wgp_id = $working_project_group_id;
                    $work_group_member->wgm_created_by = Auth::user()->u_id;
                    $work_group_member->wgm_updated_by = Auth::user()->u_id;
//                        return json_encode($work_group_member);
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
            return response()->json(['success' => false, 'message' => translate('requisao_submetida_sucesso'),'state'=>200,'data'=>array()], 200);

        }
        return response()->json(['success' => false, 'message' => translate('requisao_submetida_sucesso'),'state'=>200,'data'=>array()], 200);
        // }catch (\Exception $exception){
        //     return response()->json(['success' => false, 'message' => "Technical error. please contact to support team.",'state'=>500,'data'=>array()], 500);

        // }
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
        //
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
    function check_staff($name){
        $staff = Staff::where('s_name','like',$name)->first();
        if (empty($staff)){
            $staff_id = DB::table('s_staff')->max('s_id') + 1;

            $staff= new Staff();
            $staff->s_id= $staff_id;
            $staff->s_name=$name;
            $staff->save();
            return $staff;
        }
        return $staff;
    }
}
