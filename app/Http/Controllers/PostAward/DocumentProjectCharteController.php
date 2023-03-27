<?php

namespace App\Http\Controllers\PostAward;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DocumentProjectCharter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DocumentProjectCharteController extends Controller
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
    public function store(Request $request, $pc_id)
    {
        $dp_local_path = '';
        if($request->hasFile('document'))
        {
            $file = $request->file('document');
            $extension = $file->getClientOriginalExtension();
            $document = time().'.'.$extension;
            $dp_local_path = $document;
            $request->document->move(public_path('docs'), $document);
        }
        $dpc_id = DB::table('dpc_document_project_charters')->max('dpc_id') + 1;
        DocumentProjectCharter::create([
            'dpc_id' => $dpc_id,
            'pc_id' => $pc_id,
            'dpc_path' =>$dp_local_path,
            'dpc_description' => translate('relatorio_estudo'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return true;
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
