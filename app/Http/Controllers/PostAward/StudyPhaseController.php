<?php

namespace App\Http\Controllers\PostAward;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Article;
use App\Models\Config;
use App\Models\Task;
use App\Models\File;
use App\Models\ProjectCharter;

class StudyPhaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tasks = DB::table('t_task')
        // ->select('t_task.t_id', 'p_name', 't_task.t_description', 't_start_date', 't_due_date', 'c_name')
        // ->join('tm_task_member', 'tm_task_member.t_id', 't_task.t_id')
        // ->join('c_config', 'c_config.c_id', 't_state')
        // ->join('s_staff', 's_staff.s_id', 'tm_task_member.s_id')
        // ->join('users', 's_staff.s_id', 'users.s_id')
        // ->join('p_projects', 't_task.p_id', 'p_projects.p_id')
        // ->where('users.u_id', Auth::user()->u_id)
        // ->whereNull('t_task.deleted_at')
        // ->groupBy('c_config.c_name')
        // ->get();

        // $config = Config::whereNull('deleted_at')->get();
        // // dd($tasks);
        // // $article = Article::with("tasks")->where('')
        // // dd($tasks);
        // return view('post_award.study_phase.study_management',[
        //     'tasks' => $tasks,
        //     'states' => $config
        // ]);
        switch(Auth::user()->r_id){
            case 1:
                $projects = ProjectCharter::with("project")
                ->where("pc_project_charters.pc_created_by", Auth::user()->u_id)
                ->whereNull("pc_project_charters.deleted_at")
                ->orderBy("pc_project_charters.pc_id")
                ->get();
                
            break;
            case 11:
                $projects = DB::table("pc_project_charters")
                ->join('wgp_work_group_project', "wgp_work_group_project.p_id", "pc_project_charters.p_id")
                ->join("wgm_work_group_member", "wgm_work_group_member.wgp_id", "wgp_work_group_project.wgp_id")
                ->join("s_staff", "s_staff.s_id", "wgm_work_group_member.s_id")
                ->join("users", "s_staff.s_id", "users.s_id")
                ->where("users.u_id", Auth::user()->u_id)
                ->whereNull("pc_project_charters.deleted_at")
                ->groupBy("pc_project_charters.pc_acronym")
                ->get();
            break;

        }
        return view("post_award.study_phase.project_management",[
            'projects' => $projects
        ]);



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
            'task_id' => 'required',
            'estado' => 'required',
            // 'relatorio' => 'required',
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails())
        {
            return redirect()->back()->with('error', translate('ocorreu_erro'));
        }
        $old_task = Task::where('t_id', base64_decode($request->task_id))->whereNull('deleted_at')->first();
        Task::where('t_id', base64_decode($request->task_id))
        ->update([
            'deleted_at' => now()
        ]);
        // $t_id = DB::table('t_task')->max('t_id') + 1;
        $task = new Task();
        $task->t_id = $old_task->t_id;
        $task->t_name = $old_task->t_name;
        $task->t_description = $old_task->t_description;
        $task->t_start_date = $old_task->t_start_date;
        $task->t_final_date = $old_task->t_final_date;
        $task->t_due_date = $old_task->t_due_date;
        $task->p_id = $old_task->p_id;
        $task->t_state = $request->estado;
        $task->t_created_by = $old_task->t_created_by;
        $task->t_updated_by = Auth::user()->u_id;
        $task->created_at = $old_task->created_at;
        $task->updated_at = now();
        $task->save();

        if($request->estado == 3 || $request->estado == 4){

            if($request->hasFile('relatorio')){
                $report = $request->file('relatorio');
                $extension = $report->getClientOriginalExtension();
                $document = time().'.'.$extension;
                $dp_local_path = $document;
                $report->move(public_path('docs'), $document);
                $f_id = DB::table('f_file')->max('f_id') + 1;
                $file = new File();
                $file->f_id = $f_id;
                $file->t_id=$old_task->t_id;
                $file->f_name='Relatório de estudo';
                $file->f_description='Relatório de estudo';
                $file->f_path=$dp_local_path;
                $file->f_start_date=now();
                $file->updated_at=now();
                $file->created_at=now();
                $file->f_created_by=Auth::user()->u_id;
                $file->f_updated_by=Auth::user()->u_id;
                $file->save();
            }
        }

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
        $reports = Task::with('files')->where('t_id', base64_decode($id))->get();
        // dd($reports);
        return view('post_award.study_phase.view_report',[
            'reports' => $reports
        ]);
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
