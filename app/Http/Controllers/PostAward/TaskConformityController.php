<?php

namespace App\Http\Controllers\PostAward;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\TaskConformity;
use App\Models\DocumentProject;

class TaskConformityController extends Controller
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
            'p_id' => 'required',
            'tasks_id_' => 'required',
            'relatorio_atividade' => 'required',
            'conformity' => 'required'
        ];

        $validate = Validator::make($request->all(), $rules);
        // dd($validate->errors());
        if ($validate->fails())
        {
            return redirect()->back()->with('error', 'Ocorreu um erro ao submeter o seu pedido, por favor verifique se preencheu devidamente todos os campos.');
        }

        if($request->hasFile('relatorio_atividade')){


            $report = $request->file('relatorio_atividade');
            $extension = $report->getClientOriginalExtension();
            $document = time().'.'.$extension;
            $dp_local_path = $document;
            $report->move(public_path('docs'), $document);

            $dp_id = DB::table('dp_document_project')->max('dp_id') + 1;
            $document_project = new DocumentProject();
            $document_project->dp_id = $dp_id;
            $document_project->dt_id = 13;
            $document_project->p_id = base64_decode($request->p_id);
            $document_project->psm_id = 7;
            $document_project->dp_name = 'Relatório de actividades';
            $document_project->dp_description = 'Relatório de actividades';
            $document_project->dp_local_path = $dp_local_path;
            $document_project->created_at = now();
            $document_project->updated_at = now();
            $document_project->save();
        }

        foreach($request->conformity as $conformity){
            $tc_id = DB::table('tc_task_conformities')->max('tc_id') +1;
            $task = new TaskConformity();
            $task->tc_id = $tc_id;
            $task->t_id = base64_decode($request->tasks_id_);
            $task->c_id = $conformity;
            $task->tc_created_by = Auth::user()->u_id;
            $task->tc_updated_by = Auth::user()->u_id;
            $task->created_at = now();
            $task->updated_at = now();
            $task->save();

        }
        return redirect()->back()->with('success', 'relatório sobre as actividades e as Planilhas de Seguimento adicionada com sucesso');
        //return json_encode ($request->all());
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
}
