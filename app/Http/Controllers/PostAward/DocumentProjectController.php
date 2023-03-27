<?php

namespace App\Http\Controllers\PostAward;

use App\Http\Controllers\Controller;
use App\Models\DocumentProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DocumentProjectController extends Controller
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
        try{

            $rules = [
                'document' => 'nullable|mimes:docx,doc,pdf',
                'document_type' => 'required|integer',
                'document_name' => 'required|string|max:255',
                'document_description' => 'required|string|max:500',
                'project_id' => 'required|string',
            ];

            $validate = Validator::make($request->all(), $rules);
            if ($validate->fails())
            {
                return redirect()->back()->withErrors($validate->errors());

//                return response()->json(['success' => false, 'message' => $validate->errors(),'state'=>412,'data'=>array()], 200);
            }
            if($this->store_documents($request->document_type,base64_decode($request->project_id),5,$request->document_name,$request->document_description,$request)){
                return redirect()->back()->with('success',translate('requisao_submetida_sucesso'));

//                return response()->json(['success' => false, 'message' => "Actualizado com sucesso.",'state'=>200,'data'=>array()], 200);
            }
            return redirect()->back()->with('error', 'Technical error. please contact to support team.');

//            return response()->json(['success' => false, 'message' => "Technical error. please contact to support team.",'state'=>500,'data'=>array()], 200);

        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Technical error. please contact to support team.');

//            return response()->json(['success' => false, 'message' => "Technical error. please contact to support team.",'state'=>500,'data'=>array()], 200);

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
        $doc= DocumentProject::where("dp_id","=",base64_decode($id))->first();
        DocumentProject::where("dp_id","=",base64_decode($id))
            ->update(['updated_at'=>now(),'deleted_at'=>now()]);
        if($request->hasFile('document'))
        {
            $file = $request->file('document');
            $extension = $file->getClientOriginalExtension();
            $document = time().'.'.$extension;
            $dp_local_path = $document;
            $request->document->move(public_path('docs'), $document);
        }
//        $document_project_id = DB::table('dp_document_project')->max('dp_id') + 1;
        $document_project = new DocumentProject();
        $document_project->dp_id=base64_decode($id);
        $document_project->dt_id=$doc->dt_id;
        $document_project->p_id=$doc->p_id;
        $document_project->psm_id=$doc->psm_id;
        $document_project->dp_name=$doc->dp_name;
        $document_project->dp_description=$doc->dp_description;
        $document_project->dp_local_path=$dp_local_path;
        $document_project->created_at=$doc->created_at;
        $document_project->updated_at=now();
        $document_project->save();
        return redirect()->back()->with('success', 'Actualizado com sucesso.');

//        return redirect()->back()->with('success', 'Documento actualizado com sucesso.');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DocumentProject::where("dp_id","=",base64_decode($id))
            ->update(['updated_at'=>now(),'deleted_at'=>now()]);
        return redirect()->back()->with('success', 'Documento removido com sucesso.');

//        return response()->json('Success', 200);
    }
    public function store_documents($dt_id,$p_id,$psm,$name,$description,$request){
        if($request->hasFile('document'))
        {
            $file = $request->file('document');
            $extension = $file->getClientOriginalExtension();
            $document = time().'.'.$extension;
            $dp_local_path = $document;
            $request->document->move(public_path('docs'), $document);
        }
        $document_project_id = DB::table('dp_document_project')->max('dp_id') + 1;
        $document_project = new DocumentProject();
        $document_project->dp_id=$document_project_id;
        $document_project->dt_id=$dt_id;
        $document_project->p_id=$p_id;
        $document_project->psm_id=$psm;
        $document_project->dp_name=$name;
        $document_project->dp_description=$description;
        $document_project->dp_local_path=$dp_local_path;
        $document_project->created_at=now();
        $document_project->updated_at=now();
        return $document_project->save();
    }


}
