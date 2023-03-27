@extends('web.layout.template')

@section('content')
    <div class="page-banner overlay-dark bg-image" style="background-image: url({{asset('web/assets/img/bg_image_1.jpg')}});">
    <div class="banner-section">
      <div class="container text-center wow fadeInUp">
        <nav aria-label="Breadcrumb">
          <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
            <li class="breadcrumb-item"><a href="{{route('cism.home')}}">{{translate('inicio')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{translate('artigos')}}</li>
          </ol>
        </nav>
        <h1 class="font-weight-normal">{{translate('artigos')}}</h1>
      </div> <!-- .container -->
    </div> <!-- .banner-section -->
  </div> <!-- .page-banner -->

  <div class="page-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">

                @if(count($articles)>0)
                    <div class="row">
                        @foreach ($articles as $article)
                            <div class="col-sm-6 py-3">
                                <div class="card-blog">
                                <div class="body">
                                    <h5 class="post-title">  <a href="{{route('cism.blog_details', base64_encode($article->a_id))}}">{{$article->a_title}}</a></h5>
                                    <div class="site-info">
                                      @foreach ($article->article_authors as $author)
                                        <div class="avatar mr-2">
                                          <div class="avatar-img">
                                              <img src="{{asset('img/user/no-image.png')}}" alt="">
                                          </div>
                                          <span>{{ !empty($author->authors)?$author->authors->ca_name:translate('nao_definido')}}</span>
                                          </div>
                                        @endforeach
                                        <div>
                                          {{-- <span class="mai-time"> {{$article->a_start_date}}</span> <br> --}}
                                          <span class="mai-time">{{date('d-m-Y', strtotime($article->a_start_date))}}</span> <br>
                                          <a href="{{ route('cism.blog_details', base64_encode($article->a_id))}}"> <span class="mai-link">
                                            </span> {{ translate('mais_detalhes') }}</a>
                                          {{-- <span class="mai-time"></span> {{$articles->a_start_date}} --}}
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>

                        @endforeach


                        <div class="col-12 my-5 d-flex justify-content-center">
                            {!! $articles->links() !!}
                            
                        </div>
                    </div> <!-- .row -->
                @else
                    <div class="col-12 text-center mt-4 wow zoomIn">
                        <h3 class="text-center wow fadeInUp">{{translate('no_record')}}</h3>
                    </div>
                @endif
            </div>



            {{-- </div> --}}
        <div class="col-lg-4">
          <div class="sidebar">

            <div class="sidebar-block">
                <h3 class="sidebar-title">{{translate('area_pesquisa')}}</h3>
                <ul class="categories">
                    @forelse ($categories as $categorie) 
                        <li><a href="{{route('cism.article_by_category', base64_encode($categorie->sa_id))}}">{{ $categorie->sa_name}} <span> {{$categorie->total}}</span></a></li>
                    @empty
                        <a href="#"class="tag-link"></a>
                    @endforelse
                </ul>
              </div>

            <div class="sidebar-block">
                <h3 class="sidebar-title">{{translate('artigos_recentes')}}</h3>
                @forelse ($recente_articles as $recente_article)
                    <div class="blog-item">
                        <div class="content">
                            <h5 class="post-title"><a href="{{route('cism.blog_details', base64_encode($recente_article->a_id))}}">{{$recente_article->a_title}}</a></h5>
                            <div class="meta">
                                {{-- <a href="#"><span class="mai-calendar"></span>{{$recente_article->a_start_date}}</a> --}}
                                <a href="#"><span class="mai-calendar"></span>{{date('d-m-Y', strtotime($recente_article->a_start_date))}}</a>
                            </div>
                              @foreach ($recente_article->article_authors as $author)
                              <span class="mai-person"></span>{{ !empty($author->authors)?$author->authors->ca_name:translate('nao_definido')}}
                              <br>
                                 
                               @endforeach
                        </div>
                    </div>
                    {{-- </div> --}}
                @empty
                    <div class="blog-item">
                        <p>{{translate('no_record')}}</p>
                    </div>
                @endforelse
            </div>


          </div>
        </div>
      </div> <!-- .row -->
    </div> <!-- .container -->
  </div> <!-- .page-section -->
@endsection
