<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Models\Article;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

use \stdClass;

class DashboardController extends Controller
{
    protected $project, $users, $articles;
    public function __construct(Project $project)
    {
        $this->middleware("auth");
        $this->project = $project;
        $this->users = new User;
        $this->articles = new Article;
    }

    public function dashboard()
    {
        $response = Gate::inspect("isAdmin");
        if($response->allowed()){

            $project_info = new stdClass();
            $users = new stdClass();
            $article = new stdClass();
            $project_info->all_projects = $this->project->where('psm_id','>','4')->where("psm_id", "<=", 21)->whereNull('deleted_at')->count();
            $project_info->propostas = $this->project->where('psm_id','<','5')->count();
            $project_info->projects_submitted = $this->project->where("p_state","Submetido")->count();
            $project_info->project_active = $this->project->where("p_state", "Em curso")->count();
            $project_info->project_rejected = $this->project->where("p_state", "Rejeitado")->count();


            $users->all_users = $this->users->count();
            $users->active = $this->users->where('state',1)->count();
            $users->user_from_other_institution = $this->users->where('ui_id','<>',1)->count();
            $users->user_from_cism = $this->users->where('ui_id',1)->count();
            $article->article_submitted=$this->articles->count();
            $article->article_active=$this->articles->where("a_state", 1)->whereNull('deleted_at')->count();

            // dd($users);
            return view("admin.dashboard",[
                "project"=>$project_info,
                "article"=>$article,
                "users"=>$users
            ]);
        }else{
            abort(403);
        }
    }

    public function getContextData(Request $request)
    {

        $fields=(array)$request->all();

        if(!empty($fields['id'])){

            switch ($fields['id']) {
                case 1:
                    $query = 'SELECT COUNT(p.p_id) AS total, MONTHNAME(p.p_submitted_at) AS mes
                    FROM p_projects p JOIN psm_project_stage_micro psm ON p.psm_id=psm.psm_id
                    WHERE p.deleted_at IS NULL AND psm.ps_id =2  GROUP BY mes';
                    $chart_bar = new \stdClass;
                    $chart_bar->total = 0;
                    $chart_bar->x_values=array('');
                    $chart_bar->y_values=array(0);
                    $data = DB::select($query);
                    $soma=0;
                    if(!empty($data)){
                        foreach($data as $row){
                            array_push($chart_bar->x_values, $row->mes);
                            array_push($chart_bar->y_values, $row->total);
                            $soma+=$row->total;
                        }
                    }
                    $chart_bar->total = $soma;
                    return $chart_bar;
                break;

                case 2:
                    $query = 'SELECT sa_search_area.sa_name, COUNT(*) AS project_nr
                    FROM sa_search_area JOIN p_projects ON sa_search_area.sa_id = p_projects.sa_id
                    WHERE p_projects.deleted_at IS NULL
                    GROUP BY sa_search_area.sa_name';

                    $chart_bar = new \stdClass;
                    $chart_bar->total = 0;
                    $chart_bar->x_values=array('');
                    $chart_bar->y_values=array(0);
                    $data = DB::select($query);
                    $soma=0;
                    if(!empty($data)){
                        foreach($data as $row){
                            array_push($chart_bar->x_values, $row->sa_name);
                            array_push($chart_bar->y_values, $row->project_nr);
                            $soma+=$row->project_nr;
                        }
                    }
                    $chart_bar->total = $soma;
                    return $chart_bar;
                break;

                case 3:
                    $query = 'SELECT COUNT(*) AS total, p_state FROM p_projects p
                    JOIN psm_project_stage_micro psm ON psm.psm_id=p.psm_id
                    JOIN ps_project_stage ps on ps.ps_id = psm.ps_id
                    WHERE p.deleted_at IS NULL AND YEAR(p.p_submitted_at) = "'.date("Y").'" AND ps.ps_id=1
                    GROUP BY p.p_state';

                    $chart_bar = new \stdClass;
                    $chart_bar->total = 0;
                    $chart_bar->x_values=array('');
                    $chart_bar->y_values=array(0);
                    $data = DB::select($query);
                    $soma=0;
                    if(!empty($data)){
                        foreach($data as $row){
                            array_push($chart_bar->x_values, $row->p_state);
                            array_push($chart_bar->y_values, $row->total);
                            $soma+=$row->total;
                        }
                    }
                    $chart_bar->total = $soma;
                    return $chart_bar;
                break;

                default:

                 return;
            }
        }



    }
}
