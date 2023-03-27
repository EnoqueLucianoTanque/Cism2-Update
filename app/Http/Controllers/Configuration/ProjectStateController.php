<?php

namespace App\Http\Controllers\Configuration;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ProjectState;
use App\Models\State;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectStateController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($p_id, $psm_id) //psm verifica se a proposta ja sofreu a aprovação final do pre award manager (caso seja  >= 4 )
    {

        $project_state = ProjectState::with('project_state')
        ->where('p_id', base64_decode($p_id))
        ->first();
        if(!empty($project_state)){
            $state = State::where('s_id', '<>', $project_state->s_id)
            ->get();
        }else{
            $state = State::get();
        }
        $project = Project::get()->where('p_id', base64_decode($p_id))->first();

        return view('configuration.project_state',[
            'states'=>$state,
            'project_state' => $project_state ,
            'project_stage_micro'=> base64_decode($psm_id),
            'project' => $project->p_name
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->edit(base64_decode($request->s_id), base64_decode($request->p_id));
        if(base64_decode($request->s_id) == 5){
            return redirect()->back()->with('success', translate('requisao_submetida_sucesso'));
        }else{
            return redirect()->back()->with('info', translate('requisao_submetida_sucesso'));
        }

        // return redirect()->route('configs_post_award.index')->with('success', 'Estado da proposta alterada com sucesso');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectState  $projectState
     * @return \Illuminate\Http\Response
     */
    public function show($p_id)
    {
        return ProjectState::with('project_state')
        ->where('p_id', base64_decode($p_id))
        ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectState  $projectState
     * @return \Illuminate\Http\Response
     */
    public function edit($s_id, $p_id)
    {
        $old_project_state = ProjectState::where('p_id', $p_id)->first();
        if(!empty($old_project_state)){
            ProjectState::where('p_id', $p_id)
            ->update([
                'deleted_at' => now()
            ]);
            $ps_id = DB::table('ps_project_state')->max('ps_id') + 1;

            ProjectState::create([
                'ps_id' => $ps_id,
                'ps_created_by'=> Auth::user()->u_id,
                'created_at'=> now(),
                'updated_at'=> now(),
                's_id' => $s_id,
                'p_id' => $p_id
            ]);
            if($s_id != 1){

                Project::where('p_id', $p_id)->whereNull('deleted_at')
                ->update([
                    'p_state'=> "Aprovado"
                ]);
            }
        }else{
            $ps_id = DB::table('ps_project_state')->max('ps_id') + 1;

            ProjectState::create([
                'ps_id' => $ps_id,
                'ps_created_by'=> Auth::user()->u_id,
                'created_at'=> now(),
                'updated_at'=> now(),
                's_id' => $s_id,
                'p_id' => $p_id
            ]);

            if($s_id != 1){

                Project::where('p_id', $p_id)->whereNull('deleted_at')
                ->update([
                    'p_state'=> "Aprovado"
                ]);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectState  $projectState
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectState $projectState)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectState  $projectState
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectState $projectState)
    {
        //
    }
}
