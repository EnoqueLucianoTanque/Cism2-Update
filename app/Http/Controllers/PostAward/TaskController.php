<?php

namespace App\Http\Controllers\PostAward;

use App\Http\Controllers\Controller;
use App\Models\DocumentProject;
use App\Models\File;
use App\Models\SubTask;
use App\Models\Task;
use App\Models\TaskMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
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
          try {
                $t_id = DB::table('t_task')->max('t_id') + 1;
                $task= new Task();
                $task->t_id=$t_id;
                $task->t_name=$request->description;
                $task->t_description=$request->description;
                $task->t_start_date=$request->start_date;
                $task->t_due_date=$request->due_date;
                $task->t_final_date=$request->final_date;
                $task->p_id=$request->project_id;
                $task->t_state=$request->state;
                $task->t_created_by=Auth::user()->u_id;
                $task->t_updated_by=Auth::user()->u_id;
                $task->created_at=now();
                $task->updated_at=now();
                $task->save();
                foreach ($request->member as $member){
                    $tm_id = DB::table('tm_task_member')->max('tm_id') + 1;
                    $task_member= new TaskMember();
                    $task_member->tm_id=$tm_id;
                    $task_member->t_id=$t_id;
                    $task_member->st_id=null;
                    $task_member->s_id=$member;
                    $task_member->tm_start_date=now();
                    $task_member->tm_created_by=Auth::user()->u_id;
                    $task_member->tm_updated_by=Auth::user()->u_id;
                    $task_member->created_at=now();
                    $task_member->updated_at=now();
                    $task_member->save();
                }
                for ($i=1;$i<=(int)$request->limit_tasks; $i++){
                    echo $i;
                    if (isset($request['description_'.$i])){
                        $st_id = DB::table('st_sub_task')->max('st_id') + 1;
                        $sub_task= new SubTask();
                        $sub_task->st_id=$st_id;
                        $sub_task->st_name=$request['description_'.$i];
                        $sub_task->st_description=$request['description_'.$i];
                        $sub_task->st_start_date=$request['start_date_'.$i];
                        $sub_task->st_due_date=$request['due_date_'.$i];
                        $sub_task->st_final_date=$request['final_date_'.$i];
                        $sub_task->st_state=$request['state_'.$i];
                        $sub_task->t_id=$t_id;
                        $sub_task->st_created_by=Auth::user()->u_id;
                        $sub_task->st_updated_by=Auth::user()->u_id;
                        $sub_task->created_at=now();
                        $sub_task->updated_at=now();
                        $sub_task->save();
                        foreach ($request['member_'.$i] as $member){
                            $tm_id = DB::table('tm_task_member')->max('tm_id') + 1;
                            $task_member= new TaskMember();
                            $task_member->tm_id=$tm_id;
                            $task_member->t_id=null;
                            $task_member->st_id=$st_id;
                            $task_member->s_id=$member;
                            $task_member->tm_start_date=now();
                            $task_member->tm_created_by=Auth::user()->u_id;
                            $task_member->tm_updated_by=Auth::user()->u_id;
                            $task_member->created_at=now();
                            $task_member->updated_at=now();
                            $task_member->save();
                        }
                    }

                }
              return response()->json(['success' => false, 'message' => "Tarefa criada com sucesso.",'state'=>200,'data'=>array()], 200);
          }catch (\Exception $exception){
             return response()->json(['success' => false, 'message' => "Technical error. please contact to support team.",'state'=>500,'data'=>array()], 500);

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
//        try {
            $task_old=Task::where('t_id','=',base64_decode($id))->first();
            if (empty($task_old)){
                return redirect()->back()->with('error',"Tafera não encontrada por favor verifique.");

//                return response()->json(['success' => false, 'message' => "Tafera não encontrada por favor verifique.",'state'=>404,'data'=>array()], 200);
            }

//            $t_id = DB::table('t_task')->max('t_id') + 1;
            Task::where("t_id","=",base64_decode($id))
                ->update(['updated_at'=>now(),'t_updated_by'=>1,'deleted_at'=>now()]);
            $task= new Task();
            $task->t_id=$task_old->t_id;
            $task->t_name=$request->description;
            $task->t_description=$request->description;
            $task->t_start_date=$request->start_date;
            $task->t_due_date=$request->due_date;
            $task->t_final_date=$request->final_date;
            $task->p_id=$task_old->p_id;
            $task->t_state=$request->state;
            $task->t_created_by=$task_old->t_created_by;
            $task->t_updated_by=Auth::user()->u_id;
            $task->created_at=now();
            $task->updated_at=$task_old->updated_at;
            $task->save();
            foreach ($request->member as $member){
                TaskMember::where("t_id","=",base64_decode($id))
                    ->update(['updated_at'=>now(),'tm_updated_by'=>1,'deleted_at'=>now()]);
                $tm_id = DB::table('tm_task_member')->max('tm_id') + 1;
                $task_member= new TaskMember();
                $task_member->tm_id=$tm_id;
                $task_member->t_id=$task_old->t_id;
                $task_member->st_id=null;
                $task_member->s_id=$member;
                $task_member->tm_start_date=now();
                $task_member->tm_created_by=Auth::user()->u_id;
                $task_member->tm_updated_by=Auth::user()->u_id;
                $task_member->created_at=now();
                $task_member->updated_at=now();
                $task_member->save();
            }
//            $docum_project= new DocumentProjectController();

            for ($i=0;$i<=(int)$request->limit_docs; $i++){
//                echo 'document_file_'.$id.'_'.$i;

                if($request->hasFile('document_file_'.$task_old->t_id.'_'.$i))
                {

//                    return "doc";
                    $file = $request->file('document_file_'.$task_old->t_id.'_'.$i);
                    $extension = $file->getClientOriginalExtension();
                    $document = $file->getClientOriginalName().'_'.time().'.'.$extension;
                    $dp_local_path = $document;
                    $request['document_file_'.$task_old->t_id.'_'.$i]->move(public_path('docs'), $document);
                    $document_project_id = DB::table('f_file')->max('f_id') + 1;
                    $document_project = new File();
                    $document_project->f_id=$document_project_id;
                    $document_project->f_start_date=now();
                    $document_project->t_id=$task_old->t_id;
                    $document_project->st_id=null;
                    $document_project->f_name=$request['description_doc_'.$task_old->t_id.'_'.$i];
                    $document_project->f_description=$request['description_doc_'.$task_old->t_id.'_'.$i];
                    $document_project->f_path=$dp_local_path;
                    $document_project->f_created_by=Auth::user()->u_id;
                    $document_project->f_updated_by=Auth::user()->u_id;
                    $document_project->created_at=now();
                    $document_project->updated_at=now();
                    $document_project->save();

                }

//                $docum_project->store_documents($request->document_type,base64_decode($request->project_id),5,$request->document_name,$request->document_description,$request)
            }

            return redirect()->back()->with('success', "Tarefa actualizada com sucesso.");
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
