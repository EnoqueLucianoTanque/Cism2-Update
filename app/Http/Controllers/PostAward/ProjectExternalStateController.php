<?php

namespace App\Http\Controllers\PostAward;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectExternalState;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProjectExternalStateController extends Controller
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
            'document' => 'nullable|mimes:docx,doc,pdf',
            'estado' => 'required'
        ];

        // $messages = [
        //     "document.mimes" => translate("documento_invalido"),
        //     "estado.required" => translate("este_campo_obrigatorio")
        // ];
        $validate = Validator::make($request->all(), $rules);
        // dd($validate->errors());
        if ($validate->fails())
        {
            return redirect()->back()->with("error", translate("ocorreu_erro"));
        }

        $ecs_id = $request->estado;
        $dp_local_path = '';
        if($request->hasFile('document'))
        {
            $file = $request->file('document');
            $extension = $file->getClientOriginalExtension();
            $document = time().'.'.$extension;
            $dp_local_path = $document;
            $request->document->move(public_path('docs'), $document);
        }        
        if($ecs_id === "3"){
            
            ProjectExternalState::where('p_id', base64_decode($request->p_id))
            ->whereNull('deleted_at')
            ->update([
                'deleted_at' =>now()
            ]);

            $pes_id = DB::table("pes_project_external_state")->max('pes_id') +1;
            $project_external = new ProjectExternalState();
            $project_external->pes_id = $pes_id;
            $project_external->p_id = base64_decode($request->p_id);
            $project_external->ecs_id = $request->estado;
            $project_external->pes_updated_by = Auth::user()->u_id;
            $project_external->pes_created_by = Auth::user()->u_id;
            $project_external->pes_document_path = $dp_local_path;
            $project_external->created_at = now();
            $project_external->updated_at = now();
            $project_external->save();            
            

            $project_old= Project::where("p_id","=",base64_decode($request->p_id))->first();
            Project::where("p_id",base64_decode($request->p_id))
                ->update(['updated_at'=>now(),'deleted_at'=>now()]);
    
            $project = new Project();
            $project->p_id=$project_old->p_id;
            $project->p_name=$project_old->p_name;
            $project->p_description=$project_old->p_description;
            $project->p_submitted_at=$project_old->p_submitted_at;
            $project->p_deadline=$project_old->p_deadline;
            $project->p_budget=$project_old->p_budget;
            $project->p_general_budget=$project_old->p_general_budget;
            $project->p_state=$project_old->p_state;
            $project->u_id=$project_old->u_id;
            $project->created_at=$project_old->created_at;
            $project->psm_id=13;
            $project->p_updated_by=Auth::user()->u_id;
            $project->updated_at=now();
            $project->p_acronym = $project_old->p_acronym;
            $project->p_consortium = $project_old->p_consortium;
            $project->p_currency = $project_old->p_currency;
            $project->sa_id = $project_old->sa_id;
            $project->p_web_url = $project_old->p_web_url;
            $project->p_support_document = $project_old->p_support_document;
            $project->p_reasons = $project_old->p_reasons;
            $project->p_source = $project_old->p_source;
            $project->p_actual_state = $project_old->p_actual_state;
            $project->p_target_population = $project_old->p_target_population;
            $project->p_data_collection_location = $project_old->p_data_collection_location;
            $project->p_end_date = $project_old->p_end_date;
            $project->save();    
            return redirect()->back()->with('success', translate('requisao_submetida_sucesso'));  // verificar para onde deve redirecionar apos a inserção
        }else{
            $old_pes = ProjectExternalState::where('p_id', base64_decode($request->p_id))->whereNull('deleted_at')->first();
            if(empty($old_pes)){
                
                                
                $pes_id = DB::table("pes_project_external_state")->max('pes_id') +1;
                $project_external = new ProjectExternalState();
                $project_external->pes_id = $pes_id;
                $project_external->p_id = base64_decode($request->p_id);
                $project_external->ecs_id = $request->estado;
                $project_external->pes_updated_by = Auth::user()->u_id;
                $project_external->pes_created_by = Auth::user()->u_id;
                $project_external->created_at = now();
                $project_external->updated_at = now();
                $project_external->pes_document_path = $dp_local_path;
                $project_external->save();
                return redirect()->back()->with('success', translate('requisao_submetida_sucesso'));
            }
            ProjectExternalState::where('p_id', base64_decode($request->p_id))
            ->whereNull('deleted_at')
            ->update([
                'deleted_at' =>now()
            ]);
            // $pes_id = DB::table("pes_project_external_state")->max('pes_id') +1;
            $project_external = new ProjectExternalState();
            $project_external->pes_id = $old_pes->pes_id;
            $project_external->p_id = $old_pes->p_id;
            $project_external->ecs_id = $request->estado;
            $project_external->pes_updated_by = $old_pes->pes_updated_by;
            $project_external->pes_created_by = $old_pes->pes_created_by;
            $project_external->created_at = $old_pes->created_at;
            $project_external->pes_document_path = $old_pes->pes_document_path;
            $project_external->updated_at = now();
            $project_external->save(); 
            return redirect()->back()->with('success', translate('requisao_submetida_sucesso'));           
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
