@extends('web.layout.template')

@section('content')
<div class="page-hero bg-image overlay-dark" style="background-image: url({{asset('web/assets/img/bg_image_1.jpg')}});">
  <div class="hero-section">
    <div class="container text-center wow zoomIn">
      <h1 class="display-4">{{translate('portal_pesquisa_cism')}} CISM</h1>
      {{-- <a href="#" class="btn btn-primary">Iniciar uma pesquisa</a> --}}
    </div>
  </div>
</div>


<div class="bg-light" hidden>
  <div class="page-section py-3 mt-md-n5 custom-index">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-4 py-3 py-md-0">
          <div class="card-service wow fadeInUp">
            <div class="circle-shape bg-secondary text-white">
              <span class="mai-chatbubbles-outline"></span>
            </div>
            <p><span>Chat</span> with a doctors</p>
          </div>
        </div>
        <div class="col-md-4 py-3 py-md-0">
          <div class="card-service wow fadeInUp">
            <div class="circle-shape bg-primary text-white">
              <span class="mai-shield-checkmark"></span>
            </div>
            <p><span>One</span>-Health Protection</p>
          </div>
        </div>
        <div class="col-md-4 py-3 py-md-0">
          <div class="card-service wow fadeInUp">
            <div class="circle-shape bg-accent text-white">
              <span class="mai-basket"></span>
            </div>
            <p><span>One</span>-Health Pharmacy</p>
          </div>
        </div>
      </div>
    </div>
  </div> <!-- .page-section -->

  <div class="page-section pb-0">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 py-3 wow fadeInUp">
          <h1>Welcome to Your Health <br> Center</h1>
          <p class="text-grey mb-4">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Accusantium aperiam earum ipsa eius, inventore nemo labore eaque porro consequatur ex aspernatur. Explicabo, excepturi accusantium! Placeat voluptates esse ut optio facilis!</p>
          <a href="about.html" class="btn btn-primary">Learn More</a>
        </div>
        <div class="col-lg-6 wow fadeInRight" data-wow-delay="400ms">
          <div class="img-place custom-img-1">
            <img src="{{asset('web/assets/img/bg-doctor.png')}}" alt="">
          </div>
        </div>
      </div>
    </div>
  </div> <!-- .bg-light -->
</div> <!-- .bg-light -->

<div class="page-section" hidden>
  <div class="container">
    <h1 class="text-center mb-5 wow fadeInUp">Our Doctors</h1>

    <div class="owl-carousel wow fadeInUp" id="doctorSlideshow">
      <div class="item">
        <div class="card-doctor">
          <div class="header">
            <img src="{{asset('web/assets/img/doctors/doctor_1.jpg')}}" alt="">
            <div class="meta">
              <a href="#"><span class="mai-call"></span></a>
              <a href="#"><span class="mai-logo-whatsapp"></span></a>
            </div>
          </div>
          <div class="body">
            <p class="text-xl mb-0">Dr. Stein Albert</p>
            <span class="text-sm text-grey">Cardiology</span>
          </div>
        </div>
      </div>
      <div class="item">
        <div class="card-doctor">
          <div class="header">
            <img src="{{asset('web/assets/img/doctors/doctor_2.jpg')}}" alt="">
            <div class="meta">
              <a href="#"><span class="mai-call"></span></a>
              <a href="#"><span class="mai-logo-whatsapp"></span></a>
            </div>
          </div>
          <div class="body">
            <p class="text-xl mb-0">Dr. Alexa Melvin</p>
            <span class="text-sm text-grey">Dental</span>
          </div>
        </div>
      </div>
      <div class="item">
        <div class="card-doctor">
          <div class="header">
            <img src="{{asset('')}}/assets/img/doctors/doctor_3.jpg" alt="">
            <div class="meta">
              <a href="#"><span class="mai-call"></span></a>
              <a href="#"><span class="mai-logo-whatsapp"></span></a>
            </div>
          </div>
          <div class="body">
            <p class="text-xl mb-0">Dr. Rebecca Steffany</p>
            <span class="text-sm text-grey">General Health</span>
          </div>
        </div>
      </div>
      <div class="item">
        <div class="card-doctor">
          <div class="header">
            <img src="{{asset('')}}/assets/img/doctors/doctor_3.jpg" alt="">
            <div class="meta">
              <a href="#"><span class="mai-call"></span></a>
              <a href="#"><span class="mai-logo-whatsapp"></span></a>
            </div>
          </div>
          <div class="body">
            <p class="text-xl mb-0">Dr. Rebecca Steffany</p>
            <span class="text-sm text-grey">General Health</span>
          </div>
        </div>
      </div>
      <div class="item">
        <div class="card-doctor">
          <div class="header">
            <img src="{{asset('')}}/assets/img/doctors/doctor_3.jpg" alt="">
            <div class="meta">
              <a href="#"><span class="mai-call"></span></a>
              <a href="#"><span class="mai-logo-whatsapp"></span></a>
            </div>
          </div>
          <div class="body">
            <p class="text-xl mb-0">Dr. Rebecca Steffany</p>
            <span class="text-sm text-grey">General Health</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="page-section bg-light">
  <div class="container">
    @if(!empty($article))
        <h1 class="text-center wow fadeInUp">{{translate('artigos_recentes')}}</h1>
        <div class="row mt-5">
        {{-- {{dd(empty($article))}} --}}

        @foreach ($article as $articles)
            @if(!empty($articles->get_article_by_investigator))
            {{-- {{dd($articles->files->f_path)}} --}}
            @if(!empty($articles->files))
                <div class="col-lg-4 py-2 wow zoomIn">
                    <div class="card-blog">
                        <div class="body">
                        <h5 class="post-title"><a href="{{ route('cism.blog_details', base64_encode($articles->a_id))}}">{{ $articles->a_title }}</a></h5>
                        <div class="site-info">
                          @foreach ($articles->article_authors as $author)
                            <div class="avatar mr-2">
                              <div class="avatar-img">
                                  <img src="{{asset('img/user/no-image.png')}}" alt="">
                              </div>
                              <span>{{ !empty($author->authors)?$author->authors->ca_name:translate('nao_definido')}}</span>
                              </div>
                            @endforeach
                            <div>
                              {{-- <span class="mai-time"> {{$articles->a_start_date}}</span> <br> --}}
                              <span class="mai-time"> {{date('d-m-Y', strtotime($articles->a_start_date))}}</span> <br>
                              <a href="{{ route('cism.blog_details', base64_encode($articles->a_id))}}"> <span class="mai-link">
                                </span> {{ translate('mais_detalhes') }}</a>
                              {{-- <span class="mai-time"></span> {{$articles->a_start_date}} --}}
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            @endif
            @endif
        @endforeach

      <div class="col-12 text-center mt-4 wow zoomIn">
        <a href="{{route('cism.artigo')}}" class="btn btn-primary">{{translate('mais_artigo')}}</a>
      </div>

      @else
    <div class="col-12 text-center mt-4 wow zoomIn">
        <h3 class="text-center wow fadeInUp">{{translate('no_record')}}!</h3>
    </div>
    @endif

    </div>
  </div>
</div> <!-- .page-section -->



<div class="page-section banner-home bg-image" hidden style="background-image: url(../assets/img/banner-pattern.svg);" >
  <div class="container py-5 py-lg-0">
    <div class="row align-items-center">
      <div class="col-lg-4 wow zoomIn">
        <div class="img-banner d-none d-lg-block">
          <img src="{{asset('web/assets/img/mobile_app.png')}}" alt="">
        </div>
      </div>
      <div class="col-lg-8 wow fadeInRight">
        <h1 class="font-weight-normal mb-3">Get easy access of all features using One Health Application</h1>
        <a href="#"><img src="{{asset('web/assets/img/google_play.svg')}}" alt=""></a>
        <a href="#" class="ml-2"><img src="{{asset('web/assets/img/app_store.svg')}}  " alt=""></a>
      </div>
    </div>
  </div>
</div> <!-- .banner-home -->
@endsection
