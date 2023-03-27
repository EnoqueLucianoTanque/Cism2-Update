<?php

namespace App\Http\Controllers\Configuration;

use App\Http\Controllers\Controller;
use App\Models\Recipient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class RecipientController extends Controller
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
            'r_name' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect()->back()->with('error', translate('ocorreu_erro'));
        }

        $recipient = new Recipient();
        $r_id = DB::table('r_recipients')->max("r_id")+1;
        $recipient->r_id = $r_id;
        $recipient->r_name = $request->r_name;
        $recipient->r_updated_by = Auth::user()->u_id;
        $recipient->r_created_by = Auth::user()->u_id;
        $recipient->created_at = now();
        $recipient->updated_at = now();
        $recipient->save();

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
        $old_recipient = Recipient::where('r_id', base64_decode($id))->whereNull('deleted_at')->first();
        
        Recipient::where('r_id',base64_decode($id))
        ->update([
            'deleted_at' => now()
        ]);

        $recipient = new Recipient();
        $r_id = DB::table("r_recipients")->max("r_id")+1;

        $recipient->r_id = $r_id;
        $recipient->r_name = $old_recipient->r_name;
        $recipient->r_state = ($old_recipient->r_state==1)?0:1;
        $recipient->r_updated_by = Auth::user()->u_id;
        $recipient->r_created_by = Auth::user()->u_id;
        $recipient->created_at = $old_recipient->created_at;
        $recipient->updated_at = now();
        $recipient->save();

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
