<?php

namespace App\Http\Controllers;

use App\Models\ProjectMonitoringPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProjectMonitoringPlanController extends Controller
{
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
        $rules = [
            // 'p_id' => 'required',
            'data_monitoria' => 'required',
            'agenda' => 'required'
        ];

        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails())
        {
            return redirect()->back()->with('error', translate('ocorreu_erro'));
        }
        $dp_local_path = '';
        if($request->hasFile('agenda')){
            $agenda = $request->file('agenda');
            $extension = $agenda->getClientOriginalExtension();
            $document = time().'.'.$extension;
            $dp_local_path = $document;
            $agenda->move(public_path('docs'), $document);
            $pmp_id = DB::table('pmp_project_monitoring_plans')->max('pmp_id') + 1;
            $project_monitoring = new ProjectMonitoringPlan();

            $project_monitoring->pmp_id = $pmp_id;
            $project_monitoring->p_id = base64_decode($request->p_id);
            $project_monitoring->pmp_created_by = Auth::user()->u_id;
            $project_monitoring->pmp_updated_by = Auth::user()->u_id;
            $project_monitoring->pmp_monitoring_date = $request->data_monitoria;
            $project_monitoring->pmp_monitoring_schedule = "Agenda de monitoramento";
            $project_monitoring->pmp_monitoring_schedule_document_path = $dp_local_path;
            $project_monitoring->updated_at=now();
            $project_monitoring->created_at=now();
            $project_monitoring->save();
        }
        return redirect()->back()->with('success', translate('requisao_submetida_sucesso'));
        // return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectMonitoringPlan  $projectMonitoringPlan
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectMonitoringPlan $projectMonitoringPlan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectMonitoringPlan  $projectMonitoringPlan
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectMonitoringPlan $projectMonitoringPlan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectMonitoringPlan  $projectMonitoringPlan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectMonitoringPlan $projectMonitoringPlan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectMonitoringPlan  $projectMonitoringPlan
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectMonitoringPlan $projectMonitoringPlan)
    {
        //
    }

    public function showMonitoringPlan($id)
    {
        return ProjectMonitoringPlan::where("p_id", $id)->whereNull('deleted_at')->get();
    }
}
