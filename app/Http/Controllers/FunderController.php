<?php

namespace App\Http\Controllers;

use App\Models\Funder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FunderController extends Controller
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
        $funder = Funder::whereNull('deleted_at')
        ->orderBy('f_id', 'desc')
        ->get();
        return view('admin.funder.funders_list',['funders'=>$funder]);
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
            'nome' => 'required|unique:f_funders,f_name'
        ];
        $messages = [
            'nome.required'=>translate('este_campo_obrigatorio'),
            'nome.unique'=>translate('financiador_existe'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $funder = new Funder();
        $f_id = DB::table('f_funders')->max('f_id') + 1;

        $funder->f_name = $request->nome;
        $funder->f_id = $f_id;
        $funder->created_at = now();
        $funder->updated_at = now();
        $funder->f_created_by = Auth::user()->u_id;
        $funder->f_updated_by = Auth::user()->u_id;
        $funder->save();
        return redirect()->back()->with('success', translate('requisao_submetida_sucesso'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Funder  $funder
     * @return \Illuminate\Http\Response
     */
    public function show(Funder $funder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Funder  $funder
     * @return \Illuminate\Http\Response
     */
    public function edit(Funder $funder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Funder  $funder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Funder $funder)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Funder  $funder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Funder $funder)
    {
        //
    }
    public function changeFunderState($id)
    {
        $old_funder = Funder::where('f_id', base64_decode($id))->whereNull('deleted_at')->first();
        Funder::where('f_id', base64_decode($id))
        ->whereNull('deleted_at')
        ->update([
            'deleted_at'=>now()
        ]);
        $funder = new Funder();
        $funder->f_id = $old_funder->f_id;
        $funder->f_name = $old_funder->f_name;
        $funder->f_created_by = $old_funder->f_created_by;
        $funder->created_at = $old_funder->created_at;
        $funder->f_updated_by =Auth::user()->u_id;
        $funder->f_state = ($old_funder->f_state==1)?0:1;
        $funder->save();
        return redirect()->back()->with('success', translate('requisao_submetida_sucesso'));
    }
}
