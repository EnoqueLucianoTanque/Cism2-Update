@extends('web.layout.template')
@section('content')


<div class="page-section pt-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <nav aria-label="Breadcrumb">
          <ol class="breadcrumb bg-transparent py-0 mb-5">
            <li class="breadcrumb-item"><a href="{{route('cism.home')}}">{{translate('inicio')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('cism.artigo')}}">{{translate('artigos')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{translate('detalhes_artigo')}}</li>
          </ol>
        </nav>
      </div>
    </div> <!-- .row -->

    <div class="row">
      <div class="col-lg-8">
        <article class="blog-details">
         
          <div class="post-meta">
            <div class="post-author">
              <span class="text-grey">By</span> <a href="#">{{ !empty($article->get_article_by_investigator->staff)? $article->get_article_by_investigator->staff->s_name :translate('nao_definido')}}</a>
            </div>
            <span class="divider">|</span>
            <div class="post-date">
              {{-- <a href="#">{{$article->a_start_date}}</a> --}}
              <a href="#">{{date('d-m-Y', strtotime($article->a_start_date))}}</a>
            </div>
            <span class="divider">|</span>
            <div>
              <a href="#">{{translate('area_pesquisa')}}</a>, <a href="#">{{empty($article->category)?translate('nao_definido'):$article->category->sa_name}}</a>
            </div>
          </div>
          <h2 class="post-title h1">{{$article->a_title}}</h2>
          <div class="post-content">

            <a href="{{$article->a_link}}"class="tag-link" target="_blanck">{{translate('link_externo_artigo')}}<span class="mai-dowload"></span> </a>
            <br>
            @if(!empty($article->a_document_path))
            <a href="{{asset('articles/docs').'/'.$article->a_document_path}}"class="tag-link" target="_blanck">{{translate('documento')}}<span class="mai-dowload"></span> </a>
            @endif
          </div>
          <div class="post-tags">

          </div>
        </article> <!-- .blog-details -->

      </div>
      <div class="col-lg-4">
        <div class="sidebar">

          <div class="sidebar-block">
            <h3 class="sidebar-title">{{translate('area_pesquisa')}}</h3>
            <ul class="categories">
              @if(count($category)>0)
                @foreach ($category as $categorie) 
                <li><a href="{{route('cism.article_by_category', base64_encode($categorie->sa_id))}}">{{ $categorie->sa_name}} <span> {{$categorie->total}}</span></a></li>
                @endforeach
              @else   
                <span>{{translate('no_record')}}</span>
              @endif 
            </ul>
          </div>

          <div class="sidebar-block">
            <h3 class="sidebar-title">{{translate('artigos_recentes')}}</h3>
            @forelse ($recente_articles as $recente_article)
                <div class="blog-item">
                    <div class="content">
                        <h5 class="post-title"><a href="{{route('cism.blog_details', base64_encode($recente_article->a_id))}}">{{$recente_article->a_title}}</a></h5>
                        <div class="meta">
                            
                            @foreach ($recente_article->article_authors as $author)
                              <span class="mai-person"></span>{{ !empty($author->authors)?$author->authors->ca_name:translate('nao_definido')}}
                              <br>     
                            @endforeach
                            <a href="#"><span class="mai-calendar"></span>{{$recente_article->a_start_date}}</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="blog-item">
                    <p>{{translate('no_record')}}</p>
                </div>
            @endforelse

        </div>
      </div>
    </div> <!-- .row -->
  </div> <!-- .container -->
</div> <!-- .page-section -->

</div>
@endsection

