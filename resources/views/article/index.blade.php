@extends('layout.template')
@section('page_title', translate('gestao_artigo'))
@section('page_title_', translate('artigos'))
@section('page_title_active', translate('artigo_publicados'))
@section('user_role', session('role_name'))
@section('user_name', session('user_name'))
@section('page_name', translate('artigos'))
@section('content')
<div class="row">
    <div class="block block-condensed">
        <div class="app-heading app-heading-small">
            <div class="col-lg-6 title">
                <h5> {{translate('lista_artigo')}}</h5>
            </div>
            <div class="col-lg-6 title text-right">
                <a class="btn btn-primary" href="{{route('article.new_article')}}"><span class="fa fa-plus"></span> {{translate('novo_artigo')}}</a>
            </div>
        </div>

        <div class="block-content">
{{-- {{ dd($articles) }} --}}
            @if(empty($article))
                <div class="table-responsive">
                    <table class="table table-striped table-bordered datatable-extended">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{translate('autores')}}</th>
                                <th>{{translate('area_pesquisa')}}</th>
                                <th>{{translate('projecto')}}</th>
                                <th>{{translate('title')}}</th>
                                <th>Link</th>
                                <th>{{translate('documento')}}</th>
                                <th>{{translate('data_registo')}}</th>
                                <th>{{translate('accoes')}}</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $key => $article)
                            {{-- {{dd(Str::length($article->a_description))}} --}}
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        <ul style="width: 150px; list-style: square;">
                                            @foreach ($article->article_authors as $author)
                                                <li>{{!empty($author->authors)? $author->authors->ca_name:translate('nao_definido')}}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{!empty($article->category)?$article->category->sa_name:translate('nao_definido')}}</td>
                                    <td>{{empty($article->articleByProject)? translate('nao_definido'): $article->articleByProject->p_name}}</td>
                                    <td>{{$article->a_title}}</td>
                                    <td>{{$article->a_link}}</td>
                                    <td>
                                        @if(!empty($article->a_document_path))
                                            <a href="{{asset('articles/docs').'/'.$article->a_document_path}}" target="_blank" class="btn-link"> <span class="icon-download" > Baixar</span></a>
                                        @else   
                                            {{translate('no_record')}}
                                        @endif
                                    </td>
                                    
                                    <td>{{$article->a_start_date}}</td>
                                    {{-- <td>{{date_format($article->a_start_date, 'd-m-Y')}}</td> --}}
                                    <td style="width: 200px"> 
                                        @if ($article->a_state == 1)
                                            <button
                                                type="button"
                                                class="btn btn-danger desactive_article"
                                                article-title="{{ $article->a_title }}"
                                                article-id="{{ base64_encode($article->a_id) }}"
                                                data-toggle="modal"
                                                data-target="#modal-danger">
                                                <span class="fa fa-trash"></span>
                                            </button>
                                        @else
                                            <a href="#" class="btn btn-success"> {{translate('activar')}}</a>
                                        @endif
                                        <a
                                            href="{{route("cism.blog_details", base64_encode($article->a_id))}}"
                                            target="_blanck"
                                            class="btn btn-info"
                                            ><span class="fa fa-eye"></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="row">
                    <div class="col-sm-12">
                        <img src="{{asset('img/ilustrator/em_desenvolvimento.svg')}}"
                            class="img-responsive center-block d-block mx-auto"
                            height="90px"
                            width="90px"
                            alt="Sample Image">
                        <p class="text-center">{{translate('no_record')}}</p>
                    </div>
                </div>
            @endif
        <!-- START HEADING -->
        </div>

    </div>

</div>

<!-- MODAL DANGER -->
<div class="modal fade" id="modal-danger" tabindex="-1" role="dialog" aria-labelledby="modal-danger-header">
    <div class="modal-dialog modal-danger" role="document">
        <button type="button" class="submit" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-danger-header">{{translate('desactivar_artigo')}}</h4>
            </div>
            <form action="{{ route("article.article_desative") }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="article_id" value="" id="article_id">
                    <div class="form-group">
                        <div class="col-md-6">
                            <div class="input-group">
                                {{-- <input type="text" id="p_name" class="form-control" value=""> --}}

                            </div>
                        </div>
                        <h3> {{translate('tem_certeza_deseja_desactivar_artigo')}}<strong id="nome_projeto">  </strong> ? </h3>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">{{translate('cancelar')}}</button>
                    <button type="submit" id="btn_remove" class="btn btn-danger ">{{translate('confirmar')}}</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- END MODAL DANGER -->
@endsection

@section('scripts')
 <script>

    $(function(){
        $(".desactive_article").click(function(e){
            e.preventDefault();
            var id_article = $(this).attr("article-id");
            var nome_project = $(this).attr("article-title");

            // var project_name = $("#project_name").val();
            $("#article_id").val(id_article);
            $("#nome_projeto").text(nome_project);

        });

        $("#btn_remove").click(function(){
            var id_project = $("#p_id").val();
        });

});

</script>
@endsection

