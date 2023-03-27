<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\SearchArea;
use Illuminate\Support\Facades\DB;

class ProjectReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    public function project_state_report()
    {
        $project = Project::with("project_research_area","user_project","time_line","project_stage_micro")
        ->whereNull("deleted_at")
        // ->groupBy("sa_name")
        ->orderBy("p_id", "desc")
        ->get();
        $research_area = SearchArea::whereNull("deleted_at")->get();
        $data = $this->fetch_year();

        return view("admin.report.project_state_report",[
            'project'=>$project,
            'research_area'=> $research_area,
            'year_list'=>$data
        ]);

    }

    public function report(Request $request)
    {

        $fields=(array)$request->all();

        if(!empty($fields['id'])){

            switch ($fields['id']) {
                case 1:
                    $query = 'select sa_search_area.sa_name, count(*) as project_nr
                    from sa_search_area join p_projects on sa_search_area.sa_id = p_projects.sa_id
                    where p_projects.deleted_at IS NULL
                    GROUP BY sa_search_area.sa_name';

                    $project_evolution = new \stdClass;

                    $project_evolution->project_chart = DB::select($query);
                    $project_evolution->total_active = Project::whereNull("deleted_at")->count();
                    if(!empty($project_evolution->project_chart)){
                        foreach($project_evolution->project_chart as $row){
                            $ouptput[]=array(
                                'estado'=> $row->sa_name,
                                'projeto'=> floatVal($row->project_nr)
                            );
                        }  
                    }

                    echo json_encode($ouptput);

                    // return response()->json([
                    //     'data'=> $data,
                    //     'total'=> $project_evolution->total_active
                    // ], 200);
                    break;
                case 2:

                    $project = DB::select("select sa_search_area.sa_name, count(*) as project_nr
                    from sa_search_area join p_projects on sa_search_area.sa_id = p_projects.sa_id
					JOIN tp_timeline_project ON tp_timeline_project.p_id = p_projects.p_id
                    where p_projects.deleted_at IS NULL
                    AND tp_timeline_project.tp_start_at BETWEEN ? AND ?
                    GROUP BY sa_search_area.sa_name", [$fields["data_inicio"], $fields["data_final"]]);
                    if(!empty($project)){
                        foreach($project as $row){
                            $ouptput[]=array(
                                'estado'=> $row->sa_name,
                                'projeto'=> floatVal($row->project_nr)
                            );
                        }
                    }

                    return json_encode($ouptput);

                    break;
                case 3:
                    $project = DB::select("select p_projects.p_state, count(*) as project_nr
                    from p_projects where p_projects.deleted_at IS NULL GROUP BY p_projects.p_state");
                    $data = array();

                    if(!empty($project)){
                        foreach($project as $projects){
                            array_push($data, [
                                'x'=> $projects->p_state, 'value'=> $projects->project_nr
                            ]);
                        }
                        array_push($data, [
                            'normal'=>   [
                                'fill'=> "#fff",
                                'stroke'=> null,
                                'label'=> array('enabled'=>true)
                            ],
                            'hovered'=>  [
                                'fill'=>"#5cd65c",
                                'label'=> array('enabled'=>true)
                            ],
                            'selected'=> [
                                'fill'=> "#5cd65c",
                                'label'=> array('enabled'=>true)
                            ]]);
                    }
                    return response()->json(['data'=>$data], 200);
                break;
                case 4:
                    $project = DB::select("select p.p_state, count(*) as project_nr from p_projects p
                    JOIN psm_project_stage_micro psm ON psm.psm_id = p.psm_id
                    JOIN ps_project_stage ps ON ps.ps_id = psm.ps_id
                    where p.deleted_at IS NULL AND ps.ps_id=1
                    GROUP BY p.p_state");

                    $data = array();

                    if(!empty($project)){
                        foreach($project as $projects){
                            array_push($data, [
                                'x'=> $projects->p_state, 'value'=> $projects->project_nr
                            ]);
                        }
                    }
                break;
                case 5:
                    $query = 'SELECT sa_search_area.sa_name, COUNT(*) AS project_nr, YEAR (p_projects.p_submitted_at) AS ano
                    FROM sa_search_area join p_projects on sa_search_area.sa_id = p_projects.sa_id
                    where p_projects.deleted_at IS NULL
                    GROUP BY ano, sa_search_area.sa_name';

                    $data = $this->queryDatabase($query);
                    if(!empty($data)){

                        foreach ($data as $row) {
                            $data2[]=array(
                                'header'=>(int)$row->ano, 'rows'=>$row->sa_name, 'total'=> (int)$row->project_nr
                            );
                        }
                        return json_encode($data2);
                    }
                    break;
                case 6:
                        $query = 'SELECT  p_projects.p_state,COUNT(*) as project_nr FROM sa_search_area JOIN  p_projects ON  sa_search_area.sa_id = p_projects.sa_id
                        JOIN psm_project_stage_micro psm ON psm.psm_id = p_projects.psm_id
                        JOIN ps_project_stage ps ON ps.ps_id = psm.ps_id
                        WHERE p_projects.deleted_at IS NULL AND  ps.ps_id=1
                        GROUP BY  p_projects.p_state';

                        $data = $this->queryDatabase($query);
                        if(!empty($data)){

                            foreach ($data as $row) {
                                $data2[]=array(
                                    'estado'=>$row->p_state, 'quantidade'=> (int)$row->project_nr
                                );
                            }
                            return json_encode($data2);
                        }
                        break;
                        case 7:
                            $query = 'SELECT  sa_search_area.sa_name, p_projects.p_name, psm.psm_name  FROM sa_search_area JOIN  p_projects ON  sa_search_area.sa_id = p_projects.sa_id
                            JOIN psm_project_stage_micro psm ON psm.psm_id = p_projects.psm_id
                            JOIN ps_project_stage ps ON ps.ps_id = psm.ps_id
                            WHERE p_projects.deleted_at IS NULL AND  ps.ps_id=1';
                            $data=$this->queryDatabase($query);
                            if(!empty($data)){

                                foreach ($data as $row) {
                                    $data2[]=array(
                                        'estado'=>$row->psm_name, 'nome'=> $row->p_name, 'area_pesquisa'=>$row->sa_name
                                    );
                                }
                                return json_encode($data2);
                            }
                            break;
                            case 8:
                                $projects = Project::with('project_research_area', 'project_user_collaborator', 'user_project')
                                ->whereNull('deleted_at')
                                ->get();
                                $data=array();
                                foreach ($projects as $project) {
                                    array_push($data,[
                                        'area_pesquisa'=> !empty($project->project_research_area)?$project->project_research_area->sa_name:'',
                                        'pi'=>!empty($project->user_project->staff)?$project->user_project->staff->s_name:'',
                                        'pi_back_up'=>!empty($project->project_user_collaborator->cism_collaborator->staff)?$project->project_user_collaborator->cism_collaborator->staff->s_name:'Interino',
                                        'nome_interno'=>$project->p_name,
                                        'inicio_projeto'=>$project->p_submitted_at,
                                        'estado_atual'=>$project->p_actual_state,
                                        'local_recolha_dados'=>$project->p_data_collection_location,
                                        'pop_alvo'=>$project->p_target_population,
                                    ]);
                                }
                                echo json_encode($data);
                            break;
                            case 9:
                                $projects = DB::select('SELECT p.p_state, p.p_currency , sa.sa_name, p.p_name, s.s_name AS autor, staff2.s_name AS pi_back_up, p.p_submitted_at, p.p_actual_state  ,p.p_web_url, p.p_data_collection_location, p.p_target_population, p.p_budget, p.p_general_budget, p.p_reasons FROM p_projects p JOIN
                                sa_search_area sa ON p.sa_id=sa.sa_id JOIN users u ON u.u_id=p.u_id JOIN s_staff s ON s.s_id=u.s_id
                                JOIN cpc_cism_project_collaborator cpc ON cpc.p_id =p.p_id JOIN users user_colaborator ON  user_colaborator.u_id = cpc.cpc_cism_collaborator_id
                                JOIN s_staff staff2 ON staff2.s_id=user_colaborator.s_id
                                JOIN psm_project_stage_micro psm ON psm.psm_id = p.psm_id JOIN ps_project_stage ps ON ps.ps_id=psm.ps_id
                                WHERE p.deleted_at IS NULL  AND ps.ps_id=1');

                                $data=array();
                                foreach ($projects as $project) {
                                    array_push($data,[
                                        'area_pesquisa'=> !empty($project->sa_name)?$project->sa_name:'',
                                        'pi'=>!empty($project->autor)?$project->autor:'',
                                        'pi_back_up'=>!empty($project->pi_back_up)?$project->pi_back_up:'Investigador interino',
                                        'nome_interino'=>$project->p_name,
                                        'inicio_projeto'=>$project->p_submitted_at,
                                        'link_call'=> $project->p_web_url,
                                        'estado_atual'=>!empty($project->p_actual_state)? $project->p_actual_state: "Não definido.",
                                        'estado'=>($project->p_state==="Rejeitado")?"Reprovado" : $project->p_state,
                                        'local_recolha_dados'=>!empty($project->p_data_collection_location)?$project->p_data_collection_location:"Não definido.",
                                        'pop_alvo'=>!empty($project->p_target_population)?$project->p_target_population:"Não definido.",
                                        'financiamento'=> number_format($project->p_budget, 2, '.', ',') . ' '. $project->p_currency,
                                        'financiamento_final'=> !empty($project->p_general_budget)? number_format($project->p_general_budget, 2, '.', ',') . ' '. $project->p_currency:"ainda não definido.",
                                        'razoes_reprovacao'=> !empty($project->p_reasons)?$project->p_reasons:$project->p_state
                                    ]);
                                }
                                echo json_encode($data);

                            break;
                case 10:
                    $projects = DB::select('SELECT p.p_currency, p.p_source, p.p_state, p.updated_at, staff_approval.s_name AS staff_aprovou ,sa.sa_name, p.p_name, s.s_name AS autor, staff2.s_name AS pi_back_up, p.p_submitted_at  ,p.p_web_url, p.p_data_collection_location, p.p_target_population, p.p_budget, p.p_general_budget, p.p_reasons FROM p_projects p JOIN
                    sa_search_area sa ON p.sa_id=sa.sa_id JOIN users u ON u.u_id=p.u_id JOIN s_staff s ON s.s_id=u.s_id
                    JOIN cpc_cism_project_collaborator cpc ON cpc.p_id =p.p_id JOIN users user_colaborator ON  user_colaborator.u_id = cpc.cpc_cism_collaborator_id
                    JOIN s_staff staff2 ON staff2.s_id=user_colaborator.s_id
                    JOIN psm_project_stage_micro psm ON psm.psm_id = p.psm_id JOIN ps_project_stage ps ON ps.ps_id=psm.ps_id
                    JOIN users user_approval ON user_approval.u_id = p.p_updated_by
                    JOIN s_staff staff_approval ON user_approval.s_id=staff_approval.s_id
                    WHERE p.deleted_at IS NULL  AND ps.ps_id=1
                    GROUP BY p.p_state, staff2.s_name');

                        $data=array();
                        foreach ($projects as $project) {
                            array_push($data,[
                                'data_resposta'=> $project->updated_at,
                                'respondido_pelo'=> $project->staff_aprovou,
                                'fonte'=>$project->p_source,
                                'area_pesquisa'=> !empty($project->sa_name)?$project->sa_name:'',
                                'pi'=>!empty($project->autor)?$project->autor:'',
                                'pi_back_up'=>!empty($project->pi_back_up)?$project->pi_back_up:'PI',
                                'nome_interno'=>$project->p_name,
                                'inicio_projeto'=>$project->p_submitted_at,
                                'link_call'=> $project->p_web_url,
                                'fonte'=> $project->p_source,
                                'estado'=>($project->p_state==="Rejeitado")?"Reprovado" : $project->p_state,
                                'financiamento'=> number_format($project->p_budget, 2, '.', ',') . ' '. $project->p_currency
                            ]);
                        }
                        echo json_encode($data);

                break;
                case 11:
                    $query = 'SELECT COUNT(p.p_id) AS total, MONTHNAME(p.p_submitted_at) AS mes
                    FROM p_projects p JOIN psm_project_stage_micro psm ON p.psm_id=psm.psm_id
                    WHERE p.deleted_at IS NULL AND psm.ps_id =2 AND p.p_submitted_at BETWEEN "'.$fields['data_inicio']. '" AND "'.$fields['data_final'].'"  GROUP BY mes';

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
                default:
                    # code...
                    break;
            }

        }
    }
    public function queryDatabase($query)
    {
        $data = DB::select($query);
        return $data;
    }

    public function report_relatorio(){
        $data['year_list'] = $this->fetch_year();
        return view("admin.report.report")->with($data);
    }



    public function fetch_year(){
        $data = DB::select('SELECT EXTRACT(YEAR FROM p.p_submitted_at) AS anos FROM p_projects p
        WHERE p.deleted_at IS NULL GROUP BY anos');
        return $data;
    }
    public function fetch_data(Request $request){
        //return json_encode($this->fetch_chart_data($request->input('year')));

        if($request->input('year')){
            $chart_data = $this->fetch_chart_data($request->input('year'));
            foreach($chart_data as $row){
                $ouptput[]=array(
                    'estado'=> $row->p_state,
                    'projeto'=> floatVal($row->total)
                );
            }
            echo json_encode($ouptput);
        }
    }


    public function fetch_chart_data($year){
        $data = DB::select('SELECT EXTRACT(YEAR FROM p.p_submitted_at) AS ano, COUNT(*) AS total, p_state FROM p_projects p
        WHERE p.deleted_at IS NULL AND YEAR(p.p_submitted_at) = ?
        GROUP BY p.p_state', [$year]);
        return $data;
    }
}
