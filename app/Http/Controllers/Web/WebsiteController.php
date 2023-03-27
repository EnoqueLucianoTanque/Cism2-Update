<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Notification\EmailValidationController;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Staff;
use App\Models\Article;
use App\Models\Project;
use App\Models\Task;
use App\Models\StaffContact;
use App\Models\DocumentProject;
use App\Models\ArticleCategory;
use App\Models\UserInstitution;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Pre_Writing\Project\VideoProjectController;
use App\Models\WebConfig;

class WebsiteController extends Controller
{
    // use RedirectsUsers;
    public function __construct ()
    {
        $this->video_project = new VideoProjectController();
    }

    public function index()
    {
        $article = Article::with('files', 'article_authors', 'category')
        ->whereNull('deleted_at')
        ->orderBy('a_id', 'desc') 
        ->limit(3)
        ->get();
        // dd($article);
        return view('web.index', [
            'article' => $article
        ]);
    }
    public function about()
    {
        // $web_config = WebConfig::whereNull('deleted_at')->get();
        $data = new \stdClass;
        $data->about_us = WebConfig::whereNull('deleted_at')->where('wt_id', 3)->first();
        $data->title = WebConfig::whereNull('deleted_at')->where('wt_id', 4)->first();
        
        return view('web.about', [
            'data' => $data
        ]);
    }
    public function contact()
    {
        return view('web.contact');
    }
    public function artigo()
    {
        $category = DB::select('SELECT sa.sa_id,COUNT(*) AS total, sa.sa_name FROM a_article a 
        JOIN sa_search_area sa ON sa.sa_id = a.sa_id
        WHERE a.deleted_at IS NULL 
        GROUP BY sa.sa_name');

        $article = Article::with('article_authors', 'category') 
        ->where('deleted_at', null)
        ->orderBy('a_id', 'desc')
        ->paginate(6);
        // ->get();
        $recente_article = Article::with('article_authors')
        ->whereNull('deleted_at')
        ->orderBy('a_id', 'desc')
        ->limit(3)
        ->get();

        return view('web.artigos', [
            'articles' => $article,
            'categories' => $category,
            'recente_articles'=>$recente_article
        ]);
    }

    public function article_by_category($id)
    {
        $category = DB::select('SELECT sa.sa_id, COUNT(*) AS total, sa.sa_name FROM a_article a JOIN sa_search_area sa ON a.sa_id = sa.sa_id where sa.deleted_at is NULL GROUP BY sa.sa_name');

        $article = Article::with('get_article_by_investigator', 'files', 'category')
        ->where('deleted_at', null)
        ->where('sa_id', base64_decode($id))
        ->orderBy('a_id', 'desc')
        ->paginate(4);

        $recente_article = Article::with('get_article_by_investigator', 'files')
        ->whereNull('deleted_at')
        ->where('sa_id', base64_decode($id))
        ->orderBy('a_id', 'desc')
        ->limit(3)
        ->get();

        return view('web.article_by_category', [
            'articles' => $article,
            'categories' => $category,
            'recente_articles'=>$recente_article
        ]);
    }

    public function article_details($id)
    {
        return view('web.article_detail');
    }
    public function register()
    {
        $user_institution = UserInstitution::where('deleted_at', NULL)
        ->where('ui_description', '<>', 'CISM')
        ->get();


        return view('web.register', [
            'instituicao' => $user_institution
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'email' => 'required|email|max:191|unique:users,email,NULL,id,deleted_at,NULL',
            'password' => 'required|min:8',
            'password_2' => 'required',
            's_name' => 'required',
            'contacto' => 'required:min:9',
            'g-recaptcha-response' => 'required'
        ]; 

        $messages = array(
            'email.required' => translate('este_campo_obrigatorio'),
            'password.required' => translate('este_campo_obrigatorio'),
            's_name.required' => translate('este_campo_obrigatorio'),
            'contacto.required' => translate('este_campo_obrigatorio'),
            'email.unique' => translate('email_cadastrado'),
            'password.min' => translate('senha_conter_8_caracteres'),
            'g-recaptcha-response.required' => translate('este_campo_obrigatorio'),
        );


        $id_instituicao = '';

        if($request->input("estado") == 0 ){ // nao pertence a instituição

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput();
            }

            if(strcmp($request->input('password'), $request->input('password_2')) !== 0){
                return redirect()->back()->withErrors('message',translate('digite_senhas_iguais'));
            }

            $instituicao = UserInstitution::where('ui_description', $request->input('nome_instituicao'))
            ->where('deleted_at', NULL)
            ->first();

            if(empty($instituicao->ui_id)){
                $ui_id = DB::table('ui_user_institution')->max('ui_id') + 1;

                $id_instituicao = $ui_id;

                UserInstitution::create([
                    'ui_id' => $ui_id,
                    'ui_description' => $request->input('nome_instituicao'),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }else{
                $id_instituicao = $instituicao->ui_id;
            }
            //$id_instituicao = $instituicao->sa_id;
        }else{
            $id_instituicao = (int) '1';
        }

        // dd($id_instituicao);

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        if(strcmp($request->input('password'), $request->input('password_2')) !== 0){
            return redirect()->back()->withErrors('message',translate('digite_senhas_iguais'));
        }

        $s_id = DB::table('s_staff')->max('s_id') + 1;
        Staff::create([
            's_id' => $s_id,
            's_name' => $request->input('s_name'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $u_id = DB::table('users')->max('u_id') + 1;

        $users = User::create([
           'u_id' => $u_id,
           's_id' => $s_id,
           'r_id' => 1,
           'id' => $u_id,
           'username' => $request->input('username'),
           'email' => $request->input('email'),
           'password' => Hash::make($request->input('password')),
           'ui_id' => $id_instituicao,
           'created_at' => now(),
           'updated_at' => now(),
        //    'email_verified_at'=>now()
        ]);

        $sc_id = DB::table('sc_staff_contact')->max('sc_id') + 1;

        StaffContact::create([
            'sc_id' => $sc_id,
            'sc_contact' => $request->input('contacto'),
            'u_id' => $u_id,
            'sc_updated_by' => $u_id
        ]);

        $email = new EmailValidationController();  
        $sendTo = $request->email;
        $msg = 'Hello, Please click on the link below to confirm your email and complete the registration. If you have not registered, no action is required.';
        $message = array(
            'title'=> 'Email verification',
            'body'=> $msg
        );

        $email->sendEmail($sendTo, $message, base64_encode($u_id), 'Email verification');        

        return redirect()->back()->with('success', translate('email_confirmacao'));
    }

    protected function guard()
    {
        return Auth::guard();
    }

    protected function registered($id)
    {
        $user = User::where('id', $id)
        ->update([
            'email_verified_at'=>now()
        ]);
        return $user;
    }

    public function blog_details($id)
    {
        $category = DB::select('SELECT sa.sa_id, COUNT(*) AS total, sa.sa_name FROM a_article a JOIN sa_search_area sa ON a.sa_id = sa.sa_id where a.deleted_at is NULL GROUP BY sa.sa_name');

        $article = Article::with('get_article_by_investigator', 'files', 'category')
        ->where('deleted_at', null)
        ->where('a_id', base64_decode($id))
        ->first();


        $recente_article = Article::with('get_article_by_investigator', 'files')
        ->where('deleted_at', null)
        ->where('a_created_by', $article->a_created_by)
        ->where('a_id', '<>', base64_decode($id))
        ->orderBy('a_id', 'desc')
        ->limit(3)
        ->get();
        // dd($recente_article);
        return view('web.blog_details', [
            'article' => $article,
            'category' => $category,
            'recente_articles' => $recente_article
        ]);
    }

    public function projects()
    {
        $query = 'SELECT p.p_id, sa.sa_name, pc.pc_acronym, pc.pc_pi, pc.pc_co_pi, pc.pc_start_date, pc.pc_end_date, pc.p_target_population, pc.p_data_collection_location, pc.p_actual_state FROM p_projects p JOIN sa_search_area sa ON p.sa_id = sa.sa_id
        JOIN pc_project_charters pc ON p.p_id = pc.p_id
        JOIN psm_project_stage_micro psm ON p.psm_id = psm.psm_id
        WHERE psm.ps_id=2 and p.deleted_at IS NULL and pc.deleted_at is NULL
        GROUP BY sa.sa_name, pc.pc_acronym
        ORDER BY p.p_id DESC';

        $projects = $this->queryDatabase($query);

        $projects_pre_award = Project::with("project_stage_micro", "project_research_area")
        ->where("psm_id", "<", 5)
        ->whereNull("deleted_at")
        ->orderBy("p_id", 'desc')
        ->get();

        return view('web.project', [
            'projects' => $projects,
            'projects_pre_award' => $projects_pre_award
        ]);
    }

    public function project_details($id)
    {
        $project = Project::with('user_project', 'project_charter','project_research_area', 'documentsProject', 'project_state')
        ->where('p_id', base64_decode($id))
        ->whereNull('deleted_at')
        ->first();
        $video = $this->video_project->show(base64_decode($id));

        // dd($project);
        // dd($video);
        return view('web.project_details',[
            'project' => $project,
            'video' => $video
        ]);
    }
    public function proposal_details($id)
    {
        $project = Project::with('user_project','project_research_area', 'project_state', 'project_user_collaborator')
        ->where('p_id', base64_decode($id))
        ->whereNull('deleted_at')
        ->first();
        $concept_note = DocumentProject::where('psm_id', 2)->where('p_id', base64_decode($id))->whereNUll('deleted_at')->first();
        $video = $this->video_project->show(base64_decode($id));

        // dd(empty($concept_note));
        // dd($video);
        return view('web.proposal_details',[
            'project' => $project,
            'video' => $video,
            'concept_note' => $concept_note
        ]);
    }

    public function proposal_download($id)
    {

        $project = Project::with('user_project','project_research_area', 'project_state')
        ->where('p_id', base64_decode($id))
        ->whereNull('deleted_at')
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
        $font2 = array('size' => 14, 'bold' => true, 'color' => '000');
        $subtitle = array('size' => 14, 'bold' => false, 'color' => '000');
        $subtitleSecondary = array('size' => 11, 'bold' => false, 'color' => '85837f');
        $heading = array('size' => 14, 'bold' => false, 'color' => '65676B');
        $fullLineHorizontalRule = array('weight' => 0, 'width' => 450, 'height' => 0);

        $section = $phpWord->addSection();
        $section->addImage(asset("assets/img/logo.png"), array(
            'width' => 124,
            'height' => 84,
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
        //===============================================================
        if(!empty($project)){
            // dd($project->p_general_budget == NULL)
            $section->addText("PI: ". !empty($project->user_project)?$project->user_project->staff->s_name:"");
            $section->addTextBreak(1);
            $section->addText(translate('nome').': '. $project->p_name. ' ('.$project->p_currency.")", $font2);
            $section->addTextBreak(1);
            $section->addText(translate('area_pesquisa').': '. $project->project_research_area->sa_name, $font2);
            $section->addTextBreak(1);
            $section->addText(translate('estado').' '. !empty($project->project_state)?$project->project_state->project_state->s_description:"", $font);
            $section->addTextBreak(1);
            $section->addText(translate('descricao'). ': '. $project->p_description, $font);
            $section->addTextBreak(1);
            $section->addText("Timeline: ". $project->p_submitted_at. " até " . $project->p_deadline, $font);
            $section->addTextBreak(1);
            $section->addText( translate('financiamento_necessario').': '. number_format($project->p_budget, 2, '.', ',') . ' '. $project->p_currency, $font);
            $section->addTextBreak(1);
            $section->addText(translate('fonte_projecto').': '. $project->p_source, $font);
            $section->addTextBreak(1);
            $section->addText(translate('call_link').': '. $project->p_web_url, $font);
            $section->addTextBreak(1);

        }



        //===============================================================

        $footer = $section->addFooter();
        $footer->addPreserveText(translate('pagina'). '{PAGE} de {NUMPAGES}.', null, array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $footer->addPreserveText(date('Y-m-d'), null, array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT));
        $footer->addText("CISM - Centro de Investigação em Saúde da Manhiça", $subtitleSecondary);


        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        try {
            $objWriter->save(storage_path('projects/'.$project->p_name.'.docx'));
        } catch (Exception $e) {
        }

        return response()->download(storage_path('projects/'.$project->p_name.'.docx'));
    }
    public function project_download($id)
    {
        $tasks = Task::where('p_id', base64_decode($id))->get();
        // dd($tasks);
        $project = Project::with('user_project', 'project_charter','project_research_area', 'project_state','project_stage_micro')
        ->where('p_id', base64_decode($id))
        ->whereNull('deleted_at')
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
        $font2 = array('size' => 14, 'bold' => true, 'color' => '000');
        $subtitle = array('size' => 14, 'bold' => true, 'color' => '000');
        $subtitleSecondary = array('size' => 11, 'bold' => false, 'color' => '85837f');
        $heading = array('size' => 14, 'bold' => false, 'color' => '65676B');
        $fullLineHorizontalRule = array('weight' => 0, 'width' => 450, 'height' => 0);

        $section = $phpWord->addSection();
        $section->addImage(asset("assets/img/logo.png"), array(
            'width' => 124,
            'height' => 84,
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
        if(!empty($project->project_charter)){

            $section->addTextBreak(1);
            $section->addText(
                "PI: ". $project->project_charter->pc_pi." \n PI BACK-UP: ".$project->project_charter->pc_co_pi , $font2
            );
            $section->addTextBreak(1);
            $section->addText(translate('nome').': '. $project->p_name. ' ('.$project->project_charter->pc_acronym.")", $font2);
            
            // $section->addTextBreak(1);
            $section->addText(translate('estado_projecto'). ': '. !empty($project->project_stage_micro)?$project->project_stage_micro->project_stage->ps_description:translate('nao_definido'), $font);
            // $section->addTextBreak(1);
            $section->addText(translate('estado'). ': '. !empty($project->project_stage_micro)?$project->project_stage_micro->psm_name:translate('nao_definido'), $font);
            $section->addTextBreak(1);
            $section->addText("Timeline: ". $project->project_charter->pc_start_date. ' '.translate('ate').' ' . $project->project_charter->pc_end_date, $font);
            // $section->addTextBreak(1);
            $section->addText(translate('descricao'),$subtitle);
            $section->addText($project->p_description, $font);
            $section->addTextBreak(1);
            $section->addText(translate('objectivos'), $subtitle);
            $section->addText($project->project_charter->pc_objective, $font);
            $section->addTextBreak(1);
            $section->addText(translate('local_recolha_dados'), $subtitle);
            $section->addText($project->project_charter->p_data_collection_location, $font);
            $section->addTextBreak(1);
            $section->addText(translate('pop_alvo'), $subtitle);
            $section->addText($project->project_charter->p_target_population, $font);
            $section->addTextBreak(1);
            $section->addText(translate('ponto_situacao'), $subtitle);
            $section->addText($project->project_charter->p_actual_state, $font);
            $section->addTextBreak(1);
            $section->addText(translate('procedimento_principal'), $subtitle);
            $section->addText($project->project_charter->p_main_procedure, $font);
            $section->addText(translate('fim_documento'), $font);
            
        }

        //===============================================================

        $footer = $section->addFooter();
        $footer->addPreserveText(translate('pagina') .' '. '{PAGE} de {NUMPAGES}.', null, array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $footer->addPreserveText(date('Y-m-d'), null, array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT));
        $footer->addText("CISM - Centro de Investigação em Saúde da Manhiça", $subtitleSecondary);


        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        try {
            $objWriter->save(storage_path('projects/'.$project->p_name.'.docx'));
        } catch (Exception $e) {
        }

        return response()->download(storage_path('projects/'.$project->p_name.'.docx'));
    }

    public function queryDatabase($query)
    {
        $data = DB::select($query);
        return $data;
    }
}
