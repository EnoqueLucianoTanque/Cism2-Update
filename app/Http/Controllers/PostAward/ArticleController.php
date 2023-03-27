<?php

namespace App\Http\Controllers\PostAward;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleAuthors;
use App\Models\SearchArea;
use App\Models\File;
use App\Models\Project;
use App\Models\ArticleCategory;
use App\Models\CismAuthor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
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
        $article = Article::with('category', 'articleByProject', 'article_authors')
        ->where('deleted_at', NULL)
        ->where('a_state', 1)
        ->orderBy('a_id', 'desc')
        ->get();
        // dd($article);
        return view('article.index', [
            'articles' => $article
        ]);
    }

    public function new_article()
    {
        $categories = ArticleCategory::where('deleted_at', NULL)
        ->get();
        $authors = CismAuthor::whereNull('deleted_at')
        ->where('ca_state', 1)
        ->get();
        
        return view('article.new_article',[
            'categories' => $categories,
            'authors' => $authors
        ]);
    }

    public function store_new_article(Request $request)
    {
        // return $request->all();
        try{
            $rules = [
                'title' => 'required|string',
                'autores.*' => 'required',
                'categoria_artigo' => 'required',
                'link_artigo' => 'required',
                // 'document' => 'required',
            ];

            // $user_id = session('user_id');

            $messages = array(
                // 'content.required' => 'Este campo é obrigatório',
                'title.required' =>  translate('este_campo_obrigatorio'),
                'link_artigo.required' =>  translate('este_campo_obrigatorio'),
                'autores.required' =>  translate('este_campo_obrigatorio'),
                'categoria_artigo.required' =>  translate('este_campo_obrigatorio'),
            );

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput();
            }

            // $category = ArticleCategory::where('ac_description', 'like',$request->categoria_artigo)->first();
            $search_area = SearchArea::where('sa_name', 'like',$request->categoria_artigo)->first();
            // return $category;
            $sa_id = '';
            if(empty($search_area)){
                $sa_id = DB::table('sa_search_area')->max('sa_id') + 1;
                SearchArea::create([
                    'sa_id' => $sa_id,
                    'sa_name' => $request->categoria_artigo,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'sa_created_by' => Auth::user()->u_id,
                    'sa_updated_by' => Auth::user()->u_id,
                ]);
            }else{
                $sa_id = $search_area->sa_id;
            }
            // return $ac_id;
            $dp_local_path = '';

            if($request->hasFile('document')){
                $file = $request->file('document');
                $extension = $file->getClientOriginalExtension();
                $document = $file->getClientOriginalName() . '_' . time() . '.' . $extension;
                $dp_local_path = $document;
                $file->move(public_path('articles/docs'), $document);
                
            }
            $f_id = DB::table('f_file')->max('f_id') + 1;

            $a_id =DB::table('a_article')->max('a_id') + 1;

            
            $article = new Article();
            $article->a_id = $a_id;
            $article->a_title = $request->title;
            $article->a_link = $request->link_artigo;
            $article->a_document_path = (!isset($request->document))?NULL:$dp_local_path;
            $article->a_start_date = date('Y-m-d');
            $article->p_id =(!isset($request->p_id))?NULL:base64_decode($request->p_id);
            $article->sa_id = $sa_id;
            $article->a_created_by = Auth::user()->u_id;
            $article->a_updated_by = Auth::user()->u_id;
            $article->created_at = now();
            $article->updated_at = now();
            $article->save();
            if($this->store_article_authors($request->autores, $a_id)){
                return redirect()->back()->with('error', translate('ocorreu_erro'));
            }
            
            File::create([
                'f_id' => $f_id,
                'f_name' => $request->title,
                'f_path' => $dp_local_path,
                'f_created_by' => Auth::user()->u_id,
                'f_updated_by' => Auth::user()->u_id,
                'created_at' => now(),
                'updated_at' => now(),
                'a_id' => $a_id
            ]);
            // return redirect()->route('configs_post_award.edit', base64_decode($request->p_id))->with('success', 'Artigo registado com sucesso');
            return redirect()->route('article_post_award.index')->with('success', translate('requisao_submetida_sucesso'));
            return redirect()->back()->with('success', translate('requisao_submetida_sucesso'));            
            return redirect()->back()->withErrors($validator)->withInput();


        } catch (Exception $ex) {
            return redirect()->back()->with('error', translate('ocorreu_erro'));
        }
    }

    public function store_article_authors($authors=array(), $a_id)
    {
        foreach($authors as $author){
            $aa_id = DB::table('aa_article_authors')->max('aa_id')+1;
            $author_article = new ArticleAuthors();
            $author_article->aa_id = $aa_id;
            $author_article->a_id = $a_id;
            $author_article->ca_id = base64_decode($author);
            $author_article->created_at = now();
            $author_article->updated_at = now();
            $author_article->save();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $categories = ArticleCategory::where('deleted_at', NULL)
        ->get();
        $project = Project::where('p_id', base64_decode($id))->whereNull('deleted_at')->first();
        $authors = CismAuthor::whereNull('deleted_at')
        ->where('ca_state', 1)
        ->get();

        return view('article.register', [
            'categories' => $categories,
            'project' => $project,
            'p_id' => $id,
            'authors' => $authors
        ]);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $rules = [
                'description' => 'required|string',
                'title' => 'required|string',
            ];

            $validate = Validator::make($request->all(), $rules);
            if ($validate->fails())
            {
                return response()->json(['success' => false, 'message' => $validate->errors(),'state'=>412,'data'=>array()], 200);

//                return redirect()->back()->withErrors($validate->errors());
            }
            $a_id =DB::table('a_article')->max('a_id') + 1;

            $article = new Article();
            $article->a_id = $a_id;
            // $article->a_description = $request->description;
            $article->a_title = $request->title;
            $article->a_start_date = now();
            $article->p_id = $request->project_id;
            // $article->st_id = null;
            // $article->t_id = $request->task_id;
            $article->a_created_by = Auth::user()->u_id;
            $article->a_updated_by = Auth::user()->u_id;

            $article->created_at = date('Y-m-d h:i:s');
            $article->updated_at = date('Y-m-d h:i:s');
            $article->save();
            for ($i=0;$i<=(int)$request->limit_articles; $i++) {
//                echo 'document_file_'.$id.'_'.$i;

                if ($request->hasFile('document_file_' . $i)) {

//                    return "doc";
                    $file = $request->file('document_file_'  . $i);
                    $extension = $file->getClientOriginalExtension();
                    $document = $file->getClientOriginalName() . '_' . time() . '.' . $extension;
                    $dp_local_path = $document;
                    $request['document_file_' . $i]->move(public_path('docs'), $document);
                    $document_project_id = DB::table('f_file')->max('f_id') + 1;
                    $document_project = new File();
                    $document_project->f_id = $document_project_id;
                    $document_project->f_start_date = now();
                    $document_project->t_id = null;
                    $document_project->t_id = null;
                    $document_project->a_id = $a_id;
                    $document_project->f_name = $request['description_doc_' . $i];
                    $document_project->f_description = $request['description_doc_' . $i];
                    $document_project->f_path = $dp_local_path;
                    $document_project->f_created_by = Auth::user()->u_id;
                    $document_project->f_updated_by = Auth::user()->u_id;
                    $document_project->created_at = now();
                    $document_project->updated_at = now();
                    $document_project->save();

                }
            }
            return response()->json(['success' => true, 'message' => translate('requisao_submetida_sucesso'),'state'=>200,'data'=>array()], 200);

//            return redirect()->back()->with('success', 'Medicine added successfully.');

        } catch (Exception $ex) {
            return response()->json(['success' => false, 'message' => "Technical error. please contact to support team.",'state'=>500,'data'=>array()], 200);

//            return redirect()->back()->withErrors('Technical error. please contact to support team.');
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
    public function desative_article(Request $request)
    {
        $old_article = Article::where('a_id', base64_decode($request->article_id))
        ->where('deleted_at', NULL)
        ->first();
        // dd()
        Article::where('a_id', base64_decode($request->article_id))
        ->update([
            "deleted_at" => now()
        ]);
        // $user_id = session("user_id");
        Article::create([
            'a_id' =>  $old_article->a_id,
            'a_title' => $old_article->a_title,
            'a_start_date' => $old_article->a_start_date,
            'a_state' => ($old_article->a_state == 1)?"0":"1",
            'p_id' => $old_article->p_id,
            'sa_id' => $old_article->sa_id,
            "a_link" => $old_article->a_link,
            "a_document_path" => $old_article->a_document_path,
            'a_created_by' => $old_article->a_created_by,
            'created_at' => $old_article->created_at,
            'updated_at' => now(),
            'a_updated_by' => Auth::user()->u_id,
        ]);

        return redirect()->back()->with('success', translate('requisao_submetida_sucesso'));
    }
}
