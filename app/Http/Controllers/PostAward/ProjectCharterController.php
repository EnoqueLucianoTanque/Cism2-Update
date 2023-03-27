<?php

namespace App\Http\Controllers\PostAward;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectCharter;
use App\Models\Recipient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\PostAward\DocumentProjectCharteController;
use App\Http\Controllers\Pre_Writing\Project\ConsortiumMemberProjectController;

use App\Models\ConsortiumMemberProject;

class ProjectCharterController extends Controller
{
    public $document_charter, $consortium_member;
    public function __construct()
    {
        $this->middleware("auth");
        $this->document_charter = new DocumentProjectCharteController();
        $this->consortium_member = new ConsortiumMemberProjectController();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = DB::table('p_projects')
        ->select('p_projects.p_id', 'p_name', 'p_acronym', 'sa_name', 'p_budget', 'p_submitted_at', 'p_deadline', 's_description', 'p_currency')
        ->join('sa_search_area', 'sa_search_area.sa_id', 'p_projects.sa_id')
        ->join('ps_project_state', 'ps_project_state.p_id', 'p_projects.p_id')
        ->join('s_state', 's_state.s_id', 'ps_project_state.s_id')
        ->where('ps_project_state.s_id', 5)
        ->whereNull('p_projects.deleted_at')
        ->get();
        // dd($project);
        return view('post_award.project_charter.project_list',[
            'projects' => $project
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($p_id)
    {
        $project = Project::with('user_project')->where('p_id', base64_decode($p_id))->first();
        // dd($project);
        $consortium_member = ConsortiumMemberProject::where('p_id', base64_decode($p_id))->whereNull('deleted_at')->get();
        
        $recipients = Recipient::get();

        return view('post_award.project_charter.register',[
            'project' => $project,
            'recipients' => $recipients,
            'consortium_member'=> $consortium_member
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
        $rules = [
            'pc_acronym' => 'required|min:2',
            'pc_objective'=> 'required',
            'pc_pi'=> 'required',
            // 'pc_co_pi'=> 'required',
            'pc_start_date'=> 'required',
            'pc_end_date'=> 'required',
            'p_data_collection_location'=> 'required',
            'p_target_population'=> 'required',
            'document'=> 'required',
            'p_actual_state'=> 'required',
            'p_main_procedure'=> 'required',
            // 'p_target_population'=> 'required',
            // 'p_data_collection_location'=> 'required',
            // 'p_main_procedure'=> 'required',
        ];
        $messages = [
            'pc_acronym.required' => translate('este_campo_obrigatorio'),
            'pc_objective.required' => translate('este_campo_obrigatorio'),
            'pc_pi.required' => translate('este_campo_obrigatorio'),
            'pc_co_pi.required' => translate('este_campo_obrigatorio'),
            'pc_start_date.required' => translate('este_campo_obrigatorio'),
            'pc_end_date.required' => translate('este_campo_obrigatorio'),
            'p_data_collection_location.required' => translate('este_campo_obrigatorio'),
            'p_target_population.required' => translate('este_campo_obrigatorio'),
            'document.required' => translate('este_campo_obrigatorio'),
            'p_main_procedure.required' => translate('este_campo_obrigatorio'),
            'p_actual_state.required' => translate('este_campo_obrigatorio'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $pc_id = DB::table('pc_project_charters')->max('pc_id')+1;
        ProjectCharter::create([
            'pc_id' => $pc_id,
            'p_id' => base64_decode($request->p_id),
            'pc_objective' => $request->pc_objective,
            'pc_pi' => $request->pc_pi,
            'pc_co_pi' => !empty($request->sub_recipient[0])?$request->sub_recipient[0]:'',
            'pc_start_date' => $request->pc_start_date,
            'pc_end_date' => $request->pc_end_date,
            'p_target_population' => $request->p_target_population,
            'p_data_collection_location' => $request->p_data_collection_location,
            'pc_prelliminary_results' => $request->pc_prelliminary_results,
            'p_main_procedure' => $request->p_main_procedure,
            'p_actual_state' => $request->p_actual_state,
            'pc_acronym' => $request->pc_acronym,
            'pc_updated_by' => Auth::user()->u_id,
            'pc_created_by' => Auth::user()->u_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $this->document_charter->store($request, $pc_id);
        $this->consortium_member->update_consortium_member($request, $request->p_id);
        return redirect()->route('configs_post_award.index')->with('success', translate('requisao_submetida_sucesso'));
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
        return view("post_award.study_phase.project_management");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = [
            'p_data_collection_location'=> 'required',
            'p_target_population'=> 'required',
            'document'=> 'required',
            'p_actual_state'=> 'required',
            'pc_prelliminary_results'=> 'required',
        ];
        $messages = [
            'pc_objective.required' => translate('este_campo_obrigatorio'),
            'p_data_collection_location.required' => translate('este_campo_obrigatorio'),
            'p_target_population.required' => translate('este_campo_obrigatorio'),
            'document.required' => translate('este_campo_obrigatorio'),
            'p_actual_state.required' => translate('este_campo_obrigatorio'),
            'pc_prelliminary_results.required' => translate('este_campo_obrigatorio'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        $old_project = ProjectCharter::where("pc_id", base64_decode($request->pc_id))->first();
        // dd($request->pc_id);
        if(!empty($old_project)){

            ProjectCharter::where("pc_id", base64_decode($request->pc_id))->update([
                'deleted_at' => now()
            ]);
            ProjectCharter::create([
                'pc_id' => $old_project->pc_id,
                'p_id' => $old_project->p_id,
                'pc_objective' => $request->pc_objective,
                'pc_pi' => $old_project->pc_pi,
                'pc_co_pi' => $old_project->pc_co_pi,
                'pc_start_date' => $old_project->pc_start_date,
                'pc_end_date' => $old_project->pc_end_date,
                'p_target_population' => $request->p_target_population,
                'p_data_collection_location' => $request->p_data_collection_location,
                'p_main_procedure' => $old_project->p_main_procedure,
                'pc_prelliminary_results' => $request->pc_prelliminary_results,
                'p_actual_state' => $request->p_actual_state,
                'pc_acronym' => $old_project->pc_acronym,
                'pc_updated_by' => Auth::user()->u_id,
                'pc_created_by' => $old_project->pc_created_by,
                'created_at' => $old_project->created_at,
                'updated_at' => now(),
            ]);
            $this->document_charter->store($request, $old_project->pc_id);
            return redirect()->back()->with('success', translate('requisao_submetida_sucesso'));
            
        }
        return redirect()->back()->with('error', translate('ocorreu_erro'));
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
