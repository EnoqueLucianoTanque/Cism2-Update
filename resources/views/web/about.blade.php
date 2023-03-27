@extends('web.layout.template')

@section('content')
<div class="page-banner overlay-dark bg-image" style="background-image: url({{asset('web/assets/img/bg_image_1.jpg')}});">
  <div class="banner-section">
    <div class="container text-center wow fadeInUp">
      <nav aria-label="Breadcrumb">
        <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
          <li class="breadcrumb-item"><a href="{{route('cism.home')}}">{{translate('inicio')}}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{translate('sobre_nos')}}</li>
        </ol>
      </nav>
      <h1 class="font-weight-normal">{{translate('sobre_nos')}}</h1> 
    </div> <!-- .container -->
  </div> <!-- .banner-section -->
</div> <!-- .page-banner -->

{{-- <div class="page-section bg-light">
  <div class="container">
    <div class="row">
      <div class="col-md-4 py-3 wow zoomIn">
        <div class="card-service">
          <div class="circle-shape bg-secondary text-white">
            <span class="mai-chatbubbles-outline"></span>
          </div>
          <p><span>Chat</span> with a doctors</p>
        </div>
      </div>
      <div class="col-md-4 py-3 wow zoomIn">
        <div class="card-service">
          <div class="circle-shape bg-primary text-white">
            <span class="mai-shield-checkmark"></span>
          </div>
          <p><span>One</span>-Health Protection</p>
        </div>
      </div>
      <div class="col-md-4 py-3 wow zoomIn">
        <div class="card-service">
          <div class="circle-shape bg-accent text-white">
            <span class="mai-basket"></span>
          </div>
          <p><span>One</span>-Health Pharmacy</p>
        </div>
      </div>
    </div>
  </div>
</div> --}}

<div class="page-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 wow fadeInUp">
        <h1 class="text-center mb-3">{!! !empty($data)?$data->title->wc_description:translate('nao_definido') !!}</h1>
        <div class="text-lg">
          <p>  {!! !empty($data)?$data->about_us->wc_description: translate('nao_definido') !!}</p>

        </div>
      </div>
    </div>
  </div>
</div>

@endsection

