@extends('web.layout.template')
@section('content')


<div class="page-section pt-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <nav aria-label="Breadcrumb">
          <ol class="breadcrumb bg-transparent py-0 mb-5">
            <li class="breadcrumb-item"><a href="{{route('cism.home')}}">{{translate('inicio')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('cism.artigo')}}">{{translate('projectos')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{translate('detalhes')}}</li>
          </ol>
        </nav>
      </div>
    </div> <!-- .row -->

    <div class="row">
      <div class="col-lg-8">
        <article class="blog-details">
            @if(!empty($video))
            <div class="post-thumb">
                    <video width="100%" height="300vh" controls>
                        <source src="{{!empty($video)? asset('video/'.$video->pv_video_path):""}}" type="{{"video/".$video->pv_mime_type}}">
                        Your browser does not support HTML video.
                    </video>
                    <p>{{!empty($video)?$video->pv_title:"Nenhum vídeo disponível."}}</p>

                </div>
            @endif
          <div class="post-meta">
            <div class="post-author">
              <span class="text-grey mai-person"></span> <a href="#">{{ !empty($project->user_project->staff)?$project->user_project->staff->s_name:$project->project_charter->pc_pi}}. </a> |
              <span class="text-grey mai-person"></span> <a href="#">{{ $project->project_charter->pc_co_pi}} (PI BACK-UP)</a>
            </div>
            <span class="divider">|</span>
            <div class="post-date">
              {{-- <a href="#">{{$project->p_submitted_at}}</a> --}}
              <a href="#">{{date('d-m-Y', strtotime($project->p_submitted_at))}}</a>
            </div>
            <span class="divider">|</span>
            <div>
              <a href="#">{{translate('area_pesquisa')}}: </a> <a href="#">{{$project->project_research_area->sa_name}}</a>
            </div>
          </div>
          <h1 class="text-left mb-3">{{$project->p_name}} ({{$project->project_charter->pc_acronym}})</h1>
          <div class="post-content text-justify">
              {!! $project->p_description !!}
          </div>
          <br>
          <h5 class="post-title h5">{{translate('objectivos')}}</h5>
          <div class="post-content text-justify">
              {!! $project->project_charter->pc_objective !!}
          </div>
          <br>
          <h5 class="post-title h5">{{translate('local_recolha_dados')}} </h5>
          <div class="post-content">
              {!! $project->project_charter->p_data_collection_location !!}
          </div>
          <br>
          <h5 class="post-title h5">{{translate('pop_alvo')}}</h5>
          <div class="post-content">
              {!! $project->project_charter->p_target_population !!}
          </div>
          <br>
          <h5 class="post-title h5">{{translate('ponto_situacao')}}</h5>
          <div class="post-content">
              {!! $project->project_charter->p_actual_state !!}
          </div>
          <br>

          <div class="post-tags">
            <a href="{{route('cism.project_download', base64_encode($project->p_id))}}"class="tag-link">{{translate('clique_aqui')}} <span class="mai-dowload"></span> </a> {{translate('para_baixar_documento_projecto')}}
          </div>
        </article> <!-- .blog-details -->
      </div>
      <div class="col-lg-4">
        <div class="sidebar">
          <div class="sidebar-block">
            <h3 class="sidebar-title">{{translate('area_pesquisa')}}</h3>
            <ul class="categories">
                <li><a href="#"> <span>{{$project->project_research_area->sa_name}}</span></a></li>
            </ul>
          </div>
          <div class="sidebar-block">
            <h3 class="sidebar-title">{{translate('detalhes')}}</h3>
            {{-- <h3 class="sidebar-title">Documento de Suporte</h3> --}}
            <div class="blog-item">
            </div>
            <div class="meta">
                <a class="" target="_blanck" href="{{asset('docs').'/'.$project->p_support_document}}"> <span class="mai-download">{{translate('document_support')}}</span></a> <br>
                {{-- <a href="#"><span class="mai-calendar"> {{$project->project_charter->pc_start_date}} - {{$project->project_charter->pc_end_date}}</span></a> <br> --}}
                <a href="#"><span class="mai-calendar"> {{date('d-m-Y', strtotime($project->project_charter->pc_start_date))}} - {{date('d-m-Y', strtotime($project->project_charter->pc_end_date))}}</span></a> <br>
                {{-- <a href="#"><span class="mai-person"></span>AAAA</a> --}}
            </div>
            {{-- <ul class="categories">
                <li><a href="{{asset('docs').'/'.$project->p_support_document}}"> <span>baixar</span></a></li>
            </ul> --}}
          </div>

          {{-- <div class="sidebar-block">
            <h3 class="sidebar-title">Artigos recentes</h3>
            @forelse ($recente_articles as $recente_article)
                <div class="blog-item">
                    @foreach($recente_article->files as $file)
                    <a class="post-thumb" href="{{route('cism.blog_details', base64_encode($recente_article->a_id))}}">
                    <img src="{{ !empty($file)? asset('img/articles/'.$file->f_path):asset('img/not_found_60.png')}}" alt="">
                    </a>
                    <h5 class="post-title"><a href="{{asset('docs').'/'.$file->f_path}}" target="_blank" rel="noopener noreferrer"> Relatório</a></h5>
                    @endforeach
                    <div class="content">
                        <h5 class="post-title"><a href="{{route('cism.blog_details', base64_encode($recente_article->a_id))}}">{{$recente_article->a_title}}</a></h5>
                        <div class="meta">
                            <a href="#"><span class="mai-calendar"></span>{{$recente_article->a_start_date}}</a>
                            <a href="#"><span class="mai-person"></span>{{ !empty($article->get_article_by_investigator->staff)? $article->get_article_by_investigator->staff->s_name :"Não definido"}}</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="blog-item">
                    <p>Nenhum artigo recente foi encontrado.</p>
                </div>
            @endforelse
        </div> --}}
      </div>
    </div> <!-- .row -->
  </div> <!-- .container -->
</div> <!-- .page-section -->

</div>
@endsection

