<?php

namespace App\Http\Controllers\Configuration;

use App\Http\Controllers\Controller;
use App\Models\CismAuthor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CismAuthorController extends Controller
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
            'ca_name' => 'required|unique:ca_cism_authors'
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return redirect()->back()->with('warning', translate('ocorreu_erro'));
        }

        $ca_id = DB::table('ca_cism_authors')->max('ca_id')+1;
        $cism_author = new CismAuthor();
        $cism_author->ca_id = $ca_id;
        $cism_author->ca_name = $request->ca_name;
        $cism_author->created_at = now();
        $cism_author->updated_at = now();
        $cism_author->save();

        return redirect()->back()->with('success', translate('requisao_submetida_sucesso'));
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
    public function update($id)
    {
        $old_data = CismAuthor::where('ca_id', base64_decode($id))->whereNull('deleted_at')->first();
        CismAuthor::where('ca_id', base64_decode($id))->whereNull('deleted_at')
        ->update([
            'deleted_at' => now()
        ]);
        
        $cism_author = new CismAuthor();
        $cism_author->ca_id = $old_data->ca_id;
        $cism_author->ca_name = $old_data->ca_name;
        $cism_author->ca_state = ($old_data->ca_state==1)?0:1;
        $cism_author->created_at = $old_data->created_at;
        $cism_author->updated_at = now();
        $cism_author->save();
        return redirect()->back()->with('success', translate('requisao_submetida_sucesso'));
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
