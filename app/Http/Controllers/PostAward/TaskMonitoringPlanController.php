<?php

namespace App\Http\Controllers\PostAward;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TaskMonitoringPlan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskMonitoringPlanController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'task_id' => 'required',
            'data_monitoria' => 'required',
            'agenda' => 'required'
        ];

        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails())
        {
            return redirect()->back()->with('error', 'Ocorreu um erro ao submeter o seu pedido, por favor verifique se preencheu devidamente todos os campos.');
        }
        $dp_local_path = '';
        if($request->hasFile('agenda')){
            $agenda = $request->file('agenda');
            $extension = $agenda->getClientOriginalExtension();
            $document = time().'.'.$extension;
            $dp_local_path = $document;
            $agenda->move(public_path('docs'), $document);
            $tmp_id = DB::table('tmp_task_monitoring_plans')->max('tmp_id') + 1;
            $task_monitoring = new TaskMonitoringPlan();

            $task_monitoring->tmp_id = $tmp_id;
            $task_monitoring->t_id = base64_decode($request->task_id);
            $task_monitoring->tmp_created_by = Auth::user()->u_id;
            $task_monitoring->tmp_updated_by = Auth::user()->u_id;
            $task_monitoring->tmp_monitoring_date = $request->data_monitoria;
            $task_monitoring->tmp_monitoring_schedule = "Agenda de monitoramento";
            $task_monitoring->tmp_monitoring_schedule_document_path = $dp_local_path;
            $task_monitoring->updated_at=now();
            $task_monitoring->created_at=now();
            $task_monitoring->save();
        }
        return redirect()->back()->with('success', 'Agenda de monitoria adicionada com sucesso');

    }
}
