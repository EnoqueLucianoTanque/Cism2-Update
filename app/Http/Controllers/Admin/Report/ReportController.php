<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\ProjectCharter;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(["auth", "verified"]);
    }
    public function index()
    {
        return view("admin.report.reports");
    }

    public function getReportData(Request $request) 
    {
        // return $request->all();
        switch ($request->id) {
            case 1:
                $query = 'SELECT sa.sa_name, COUNT(p.sa_id) as project_nr FROM ps_project_state ps
                INNER JOIN p_projects p ON (p.p_id = ps.p_id)
                left JOIN sa_search_area sa ON  (sa.sa_id = p.sa_id)
                WHERE ps.s_id=5 AND p.deleted_at IS NULL AND ps.deleted_at IS NULL AND DATE( ps.created_at) BETWEEN ? AND ?
                GROUP BY sa.sa_name';

                $query_table = 'SELECT p.p_id, sa.sa_name,   p.p_name, pc.pc_acronym, pc.pc_pi, pc.p_actual_state FROM  pc_project_charters pc JOIN p_projects p ON p.p_id = pc.p_id
                JOIN sa_search_area sa ON sa.sa_id = p.sa_id
                JOIN ps_project_state ps ON ps.p_id = p.p_id
                WHERE ps.deleted_at IS NULL AND ps.s_id = 5 AND DATE( ps.created_at) BETWEEN ? AND ?
                GROUP BY p.p_id';

                $chart_bar = new \stdClass;
                $chart_bar->total = 0;
                $chart_bar->x_values=array('');
                $chart_bar->y_values=array(0);
                $chart_bar->data=[];
                $data = DB::select($query, [$request->data_inicio, $request->data_final]);
                $data_table = DB::select($query_table, [$request->data_inicio, $request->data_final]);
                $soma=0;
                // return $data;
                // return count($data_table);
                if(!empty($data)){
                    foreach($data as $row){
                        array_push($chart_bar->x_values, $row->sa_name);
                        array_push($chart_bar->y_values, $row->project_nr);
                        $soma+=$row->project_nr;
                    }
                }
                if(count($data_table)>0){
                    foreach($data_table as $key => $row){
                        array_push($chart_bar->data,[
                            'index' => $key+1,
                            'area_pesquisa' => $row->sa_name,
                            'p_name' => $row->p_name,
                            'pc_acronym' => $row->pc_acronym,
                            'pc_pi' => $row->pc_pi,
                            'p_actual_state' => substr($row->p_actual_state,0,50),
                            'p_id' => base64_encode ($row->p_id)
                        ]);
                    }
                }
                $chart_bar->total = $soma;
                return $chart_bar;
            break;
            case 2:
                $query = 'SELECT
                CASE
                    WHEN YEAR (ps.created_at) BETWEEN YEAR(?) AND YEAR(?) then YEAR(ps.created_at)
                END AS ano, COUNT(sa.sa_id) AS total, sa.sa_name
                FROM p_projects p JOIN ps_project_state ps ON (p.p_id = ps.p_id AND s_id = 5)
                JOIN sa_search_area sa ON sa.sa_id = p.sa_id
                WHERE p.deleted_at IS NULL AND YEAR (ps.created_at) BETWEEN YEAR(?) AND YEAR(?)
                GROUP BY sa.sa_name, ANO';
                $data = DB::select($query, [$request->data_inicio, $request->data_final, $request->data_inicio, $request->data_final]);


                $query2 = 'SELECT p.p_id ,sa.sa_name, pc.pc_acronym, pc.pc_pi, pc.p_actual_state  FROM  p_projects p JOIN ps_project_state ps ON (p.p_id = ps.p_id AND s_id = 5)
                JOIN sa_search_area sa ON sa.sa_id = p.sa_id
                JOIN pc_project_charters pc ON (pc.p_id = p.p_id AND pc.deleted_at IS NULL)
                WHERE p.deleted_at IS NULL AND YEAR (ps.created_at) BETWEEN YEAR(?) AND YEAR(?)
                GROUP BY sa.sa_name, p.p_name';

                $data_table = DB::select($query2,  [$request->data_inicio, $request->data_final]);



                $chart_bar = new \stdClass;
                $chart_bar->total = 0;
                $chart_bar->x_values=[];
                $chart_bar->y_values=[];
                // $chart_bar->data=[];
                $chart_bar->data_table=[];
                $soma=0;

                if(count($data) > 0){
                    foreach($data as $key => $row){
                        array_push($chart_bar->x_values, ($row->sa_name));
                        array_push($chart_bar->y_values, ($row->total));
                        $soma+=$row->total;
                    }
                    $chart_bar->total = $soma;
                }
                if(count($data_table) > 0){
                    foreach($data_table as $key => $row){
                        array_push($chart_bar->data_table,[
                            'index' => $key+1,
                            'sa_name' => $row->sa_name,
                            // 'p_name' => $row->p_name,
                            'pc_acronym' => $row->pc_acronym,
                            'pc_pi' => $row->pc_pi,
                            'p_actual_state' => $row->p_actual_state,
                            'p_id' => base64_encode ($row->p_id)
                        ]);
                    }
                    return $chart_bar;
                }
                return false;
            break;
            case 3:
                $query = 'SELECT
                CASE when YEAR(ps.created_at) BETWEEN YEAR(?) AND YEAR(?) THEN YEAR(ps.created_at)
                END AS ano, s.s_description, COUNT(*) AS total FROM p_projects p
                JOIN ps_project_state ps ON (p.p_id = ps.p_id AND ps.deleted_at IS NULL) JOIN s_state s ON s.s_id = ps.s_id
                WHERE p.deleted_at IS NULL  and ps.s_id < 5 AND YEAR(ps.created_at)  BETWEEN YEAR(?) AND YEAR(?)
                GROUP BY s.s_description';

                $query2 = 'SELECT p.p_id, sa.sa_name, p.p_name, s.s_description AS state, st.s_name  FROM p_projects p
                JOIN sa_search_area sa ON sa.sa_id = p.sa_id
                JOIN users ON (users.u_id = p.u_id) 
                JOIN s_staff st ON(st.s_id = users.s_id AND users.state = 1)
                JOIN ps_project_state ps ON (p.p_id = ps.p_id) JOIN s_state s ON s.s_id = ps.s_id
                WHERE p.deleted_at IS NULL  AND ps.deleted_at IS NULL and ps.s_id < 5 AND YEAR(ps.created_at)  BETWEEN YEAR(?) AND YEAR(?)
                GROUP BY s.s_description, p.p_name';

                $data = DB::select($query, [$request->data_inicio, $request->data_final, $request->data_inicio, $request->data_final]);

                $data_table = DB::select($query2,[$request->data_inicio, $request->data_final]);

                $chart_bar = new \stdClass;
                $chart_bar->total = 0;
                $chart_bar->x_values=array('');
                $chart_bar->y_values=array(0);
                $chart_bar->data=[];
                $chart_bar->data_table=[];
                $soma=0;

                if(count($data) > 0){
                    foreach($data as $key => $row){
                        array_push($chart_bar->data,[
                            'index' => $key+1,
                            'state' => $row->s_description,
                            'ano' => $row->ano,
                            'total' => $row->total,
                        ]);
                        array_push($chart_bar->x_values, $row->s_description);
                        array_push($chart_bar->y_values, $row->total);
                        $soma+=$row->total;
                    }
                    $chart_bar->total = $soma;
                    // 
                }

                if(count($data_table) > 0){
                    foreach($data_table as $key => $row){
                        array_push($chart_bar->data_table,[
                            'index' => $key+1,
                            'sa_name' => $row->sa_name,
                            'p_name' => $row->p_name,
                            'pi' => $row->s_name,
                            'state' => $row->state,
                            'p_id' => base64_encode($row->p_id)
                        ]);
                    }
                }
                return $chart_bar;
                // return false;
            break;
            case 4:
                $query = 'SELECT c.c_description, COUNT(pcs.c_id) as total FROM pc_project_conformities pcs
                JOIN c_conformity c ON (c.c_id = pcs.c_id)
                WHERE pcs.created_at BETWEEN ? AND ? and pcs.deleted_at is NULL
                GROUP BY c.c_id';

                $query2 = 'SELECT p.p_acronym, p.p_id, sa.sa_name, p.p_name, st.s_name, c.c_description FROM p_projects p JOIN sa_search_area sa ON sa.sa_id = p.sa_id JOIN users ON (users.u_id = p.u_id) 
                JOIN s_staff st ON(st.s_id = users.s_id AND users.state = 1)
                JOIN pc_project_conformities pcs ON pcs.p_id = p.p_id
                JOIN c_conformity c ON (c.c_id = pcs.c_id)
                WHERE pcs.created_at BETWEEN ? AND ? and p.deleted_at is NULL
                GROUP BY p.p_name';

                $data = DB::select($query, [$request->data_inicio, $request->data_final]);
                $data_table = DB::select($query2, [$request->data_inicio, $request->data_final]);
                // return $data_table;
                $chart_bar = new \stdClass;
                $chart_bar->total = 0;
                $chart_bar->x_values=array('');
                $chart_bar->y_values=array(0);
                $chart_bar->data=[];
                $chart_bar->data_table=[];
                $soma=0;

                if(count($data) > 0){
                    foreach($data as $key => $row){
                        array_push($chart_bar->x_values, $row->c_description);
                        array_push($chart_bar->y_values, $row->total);
                        $soma+=$row->total;
                    }
                    $chart_bar->total = $soma;
                    
                }

                if(count($data_table) > 0){
                    foreach($data_table as $key => $row){
                        array_push($chart_bar->data_table,[
                            'index' => $key+1,
                            'sa_name' => $row->sa_name,
                            'p_name' => $row->p_name,
                            'acronimo' => $row->p_acronym,
                            'pi' => $row->s_name,
                            'c_name' => $row->c_description,
                            'p_id' => base64_encode($row->p_id)
                        ]);
                    }
                    return $chart_bar;
                }
                return $chart_bar;
                return $request;
            break;
            case 5: 
                $query = 'SELECT case 
                when YEAR(a.created_at) BETWEEN YEAR(?) AND YEAR(?) THEN YEAR(a.created_at)
                END AS ano, COUNT(aa.a_id) as total, ca.ca_name
                FROM a_article a JOIN aa_article_authors aa ON (a.a_id = aa.a_id AND a.deleted_at IS NULL) 
                JOIN ca_cism_authors ca ON (ca.ca_id = aa.ca_id)
                WHERE a.deleted_at IS NULL AND YEAR (a.created_at) BETWEEN YEAR(?) AND YEAR(?) 
                GROUP BY ca.ca_name';
                
                $articles = Article::with('category', 'articleByProject', 'article_authors')
                ->where('deleted_at', NULL)
                ->where('a_state', 1)
                ->orderBy('a_id', 'desc')
                ->get();
                

                $data = DB::select($query, [$request->data_inicio, $request->data_final, $request->data_inicio, $request->data_final]);

                $chart_bar = new \stdClass;
                $chart_bar->article=[];
                $chart_bar->article_data=[];
                $chart_bar->x_values=array('');
                $chart_bar->y_values=array(0);
                $chart_bar->total=0;
                $soma=0;
                
                if(count($data)>0){
                    foreach($data as $key => $info){
                        array_push($chart_bar->article_data,[
                            'index' => $key+1,
                            'total' => $info->total,
                            'ano' => $info->ano,
                            'ca_name' => $info->ca_name
                        ]);
                        array_push($chart_bar->x_values, $info->ca_name);
                        array_push($chart_bar->y_values, $info->total);
                        $soma+=$info->total;
                    }
                    $chart_bar->total = $soma;
                }


                return $chart_bar;
            break;
            case 6:
                $query = 'SELECT * FROM p_projects p JOIN pc_project_charters pc ON (p.p_id = pc.p_id AND pc.deleted_at IS NULL)
                        WHERE p.psm_id >= 7 AND p.psm_id < 16 AND p.deleted_at IS NULL AND pc.created_at BETWEEN ? AND ?';

                $result = DB::select($query, [$request->data_inicio, $request->data_final]);
                $response = new \stdClass;
                $response->data=[];

                if(count($result)>0){
                    foreach($result as $key => $row){
                        array_push($response->data,[
                            'index'=> $key+1,
                            'pc_id' => $row->p_id,
                            // 'pc_id' => base64_encode($row->p_id),0
                            'nome'=>$row->p_name,
                            'acronimo'=>$row->p_acronym,
                            'objectivo'=> substr($row->pc_objective,0,40),
                            'resultado_preliminares'=> (strlen($row->pc_prelliminary_results)>50)? substr($row->pc_prelliminary_results, 0, 50). ' ...': substr($row->pc_prelliminary_results, 0, 50),
                            'pop_alvo'=> $row->p_target_population,
                            'local_dados'=> $row->p_data_collection_location,
                            'pi'=> $row->pc_pi,
                            // 'financiamento'=> $row->p_general_budget
                            'financiamento'=> number_format($row->p_general_budget, 2, '.', ',') . ' '.$row->p_currency
                        ]);
                    }
                    $response->result = array(
                        'status' => true,
                        'msg' => null
                    );
                    return $response;
                }else{
                    $response->result = array(
                        'status' => false,
                        'msg' => translate('no_record')
                    );
                    return $response;
                }
                
                
            break;
            default:
                return false;
                break;
        }
        // return $request->all();
    }

    public function download_study_implementation_report($id)
    {
        $project = ProjectCharter::with('project')
        ->whereNull('deleted_at')
        ->where('p_id', $id)
        // ->where('p_id', \base64_decode($id))
        ->first();

        // dd($project);
        $subtitleLine1 = 'Centro de Investigação em Saúde da Manhiça';

        // return $project->
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $properties = $phpWord->getDocInfo();
        $properties->setCreator('System');
        $properties->setCompany('CISM');
        $properties->setTitle(translate('detalhes_projecto'));
        $phpWord->setDefaultFontName('Arial');

        $title = array('size' => 24, 'bold' => false);
        $font = array('size' => 12, 'bold' => false, 'color' => '000');
        $font2 = array('size' => 12, 'bold' => true, 'color' => '000');
        $subtitle = array('size' => 12, 'bold' => true, 'color' => '000');
        $subtitleSecondary = array('size' => 11, 'bold' => false, 'color' => '85837f');
        $heading = array('size' => 14, 'bold' => false, 'color' => '65676B');
        $fullLineHorizontalRule = array('weight' => 0, 'width' => 450, 'height' => 0);

        $section = $phpWord->addSection();
        $section->addImage(asset("assets/img/logo.png"), array(
            'width' => 100,
            'height' => 70,
            'wrappingStyle' => 'square',
            'positioning' => 'absolute',
            'posHorizontal'    => \PhpOffice\PhpWord\Style\Image::POSITION_HORIZONTAL_CENTER,
            'posHorizontalRel' => 'margin',
            'posVerticalRel' => 'line'
        ));
        $section->addTextBreak(4);
        $section->addText($subtitleLine1, $subtitle, 'pStyleCenter');
        $section->addLine($fullLineHorizontalRule);
        $section->addTextBreak(1);
        $phpWord->addParagraphStyle('pStyleCenter', array('align' => \PhpOffice\PhpWord\Style\Image::POSITION_HORIZONTAL_CENTER));
        // dd(empty($project->project_charter));
        if(!empty($project)){

            $section->addTextBreak(1);
            $section->addText(
                "PI: ". $project->pc_pi." \n PI BACK-UP: ".$project->pc_co_pi , $font2
            );
            $section->addTextBreak(1);
            $section->addText(translate('nome').': '. $project->project->p_name. ' ('.$project->pc_acronym.")", $font2);
            
            // $section->addTextBreak(1);
            $section->addText(translate('estado_projecto'), $subtitle);
            $section->addText(!empty($project->project->project_stage_micro)?$project->project->project_stage_micro->project_stage->ps_description:translate('nao_definido'), $font);
            // $section->addTextBreak(1);
            $section->addText(translate('estado'). ': '. !empty($project->project->project_stage_micro)?$project->project->project_stage_micro->psm_name:translate('nao_definido'), $font);
            $section->addTextBreak(0);
            $section->addText("Timeline: ". $project->pc_start_date. ' '.translate('ate').' ' . $project->pc_end_date, $font);
            // $section->addTextBreak(1);
            $section->addText(translate('descricao'),$subtitle);
            $section->addText($project->project->p_description, $font);
            $section->addTextBreak(0);
            $section->addText(translate('objectivos'), $subtitle);
            $section->addText($project->pc_objective, $font);
            $section->addTextBreak(0);
            $section->addText(translate('local_recolha_dados'), $subtitle);
            $section->addText($project->p_data_collection_location, $font);
            $section->addTextBreak(0);
            $section->addText(translate('pop_alvo'), $subtitle);
            $section->addText($project->p_target_population, $font);
            $section->addTextBreak(1);
            $section->addText(translate('ponto_situacao'), $subtitle);
            $section->addText($project->p_actual_state, $font);
            $section->addTextBreak(0);
            $section->addText(translate('procedimento_principal'), $subtitle);
            $section->addText($project->p_main_procedure, $font);
            $section->addTextBreak(0);
            $section->addText(translate('resultado_preliminares'), $subtitle);
            $section->addText($project->pc_prelliminary_results, $font);

            $section->addText(translate('fim_documento'), $font);
            
        }

        //===============================================================

        $footer = $section->addFooter();
        $footer->addPreserveText(translate('pagina') .' '. '{PAGE} de {NUMPAGES}.', null, array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $footer->addPreserveText(date('Y-m-d'), null, array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT));
        $footer->addText("CISM - Centro de Investigação em Saúde da Manhiça", $subtitleSecondary);


        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        try {
            $objWriter->save(storage_path('projects/'.$project->project->p_name.'.docx'));
        } catch (Exception $e) {
        }

        return response()->download(storage_path('projects/'.$project->project->p_name.'.docx'));
    }
}
