<?php

namespace App\Http\Controllers\Pre_Writing\Project;

use App\Http\Controllers\Controller;
use App\Models\ConsortiumMemberProject;
use Illuminate\Http\Request;
use illuminate\Support\Facades\DB;
use illuminate\Support\Facades\Auth;
use App\Models\Recipient;

class ConsortiumMemberProjectController extends Controller
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
    public function store(Request $request, $p_id)
    {
        $cmp_id = DB::table("cmp_consortium_member_project")->max("cmp_id") + 1;
        $recipient_name = Recipient::where('r_name', $request->principal_recipient)->first();
        $recipient_id = '';
        if(empty($recipient_name)){
            $recipient = new Recipient();
            $recipient_id = DB::table('r_recipients')->max('r_id') + 1;
            $recipient->r_id = $recipient_id;
            $recipient->r_name = $request->principal_recipient;
            $recipient->r_updated_by = Auth::user()->u_id;
            $recipient->r_created_by = Auth::user()->u_id;
            $recipient->created_at = now();
            $recipient->updated_at = now();
            $recipient->save();
        }else{
            $recipient_id = $recipient_name->r_id;
        }
        ConsortiumMemberProject::create([
            'cmp_id' => $cmp_id,
            'cmp_name' => $request->principal_recipient,
            'p_id' => $p_id,
            'cmr_id'=> 1, //principal recipient
            'cmp_created_by'=> Auth::user()->u_id,
            'cmp_updated_by'=> Auth::user()->u_id,
            'created_at'=>now(),
            'updated_at'=>now()
            ]
        );
        if(!empty($request->sub_recipient )){
            foreach($request->sub_recipient as $sub_recipient){
                ConsortiumMemberProject::create([
                    'cmp_id' => $cmp_id+1,
                    'cmp_name' => $sub_recipient,
                    'p_id' => $p_id,
                    'cmr_id'=> 2, //sub recipient
                    'cmp_created_by'=> Auth::user()->u_id,
                    'cmp_updated_by'=> Auth::user()->u_id,
                    'created_at'=>now(),
                    'updated_at'=>now(),
                    ]
                );
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ConsortiumMemberProject  $consortiumMemberProject
     * @return \Illuminate\Http\Response
     */
    public function show($p_id)
    {
        return ConsortiumMemberProject::with('consortiumMemberProject')
        ->where('p_id', $p_id)
        ->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ConsortiumMemberProject  $consortiumMemberProject
     * @return \Illuminate\Http\Response
     */
    public function edit(ConsortiumMemberProject $consortiumMemberProject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ConsortiumMemberProject  $consortiumMemberProject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConsortiumMemberProject $consortiumMemberProject)
    {
        //
    }

    public function update_consortium_member(Request $request, $p_id)
    {
        ConsortiumMemberProject::where("p_id", base64_decode($p_id))
        ->update([
            'deleted_at' => now()
        ]);
        if(!empty($request->sub_recipient)){
            foreach($request->sub_recipient as $name){
                $cmp_id = DB::table("cmp_consortium_member_project")->max('cmp_id') + 1;
                $consortium_member = new  ConsortiumMemberProject();
                $consortium_member->cmp_id = $cmp_id;
                $consortium_member->cmp_name = $name;
                $consortium_member->p_id = base64_decode($p_id);
                $consortium_member->cmr_id = 2;
                $consortium_member->cmp_created_by = Auth::user()->u_id;
                $consortium_member->cmp_updated_by = Auth::user()->u_id;
                $consortium_member->created_at = now();
                $consortium_member->updated_at = now();
                $consortium_member->save();
            }
        }
        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ConsortiumMemberProject  $consortiumMemberProject
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConsortiumMemberProject $consortiumMemberProject)
    {
        //
    }
}
