<?php

namespace App\Http\Controllers;

use App\Models\ProjectConformity;
use App\Models\DocumentProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProjectConformityController extends Controller
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
            // 'tasks_id_' => 'required',
            'relatorio_atividade' => 'required',
            'conformity' => 'required'
        ];

        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails())
        {
            return redirect()->back()->with('error', translate('ocorreu_erro'));
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
            $pc_id = DB::table('pc_project_conformities')->max('pc_id') +1;
            $project_conformity = new ProjectConformity();
            $project_conformity->pc_id = $pc_id;
            $project_conformity->p_id = base64_decode($request->p_id);
            $project_conformity->c_id = $conformity;
            $project_conformity->pc_created_by = Auth::user()->u_id;
            $project_conformity->pc_updated_by = Auth::user()->u_id;
            $project_conformity->created_at = now();
            $project_conformity->updated_at = now();
            $project_conformity->save();

        }
        return redirect()->back()->with('success', translate('requisao_submetida_sucesso'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectConformity  $projectConformity
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectConformity $projectConformity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectConformity  $projectConformity
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectConformity $projectConformity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectConformity  $projectConformity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectConformity $projectConformity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectConformity  $projectConformity
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectConformity $projectConformity)
    {
        //
    }
}
