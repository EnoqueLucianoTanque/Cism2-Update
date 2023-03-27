<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <meta name="copyright" content="MACode ID, https://macodeid.com/">

  <title>CISM - {{translate('pagina_pesquisa')}}</title>
  <link rel="shortcut icon" href="{{asset('assets/img/logo.png')}}" type="image/jpg">

  <link rel="stylesheet" href="{{asset('web/assets/css/maicons.css')}} ">

  <link rel="stylesheet" href="{{asset("web/assets/css/bootstrap.css")}}">

  <link rel="stylesheet" href="{{asset('web/assets/vendor/owl-carousel/css/owl.carousel.css')}}">

  <link rel="stylesheet" href="{{asset('web/assets/vendor/animate/animate.css')}}">

  <link rel="stylesheet" href="{{asset('web/assets/css/theme.css')}}">
  <style>
    @font-face{
      font-family: "interstate"; 
      src: local('../web/fonts/')
    }
  </style>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
  @yield('styles')
  <script src="{{"https://www.google.com/recaptcha/api.js?explicit&hl=".Session::get('locale', Config::get('app.locale'))}}"></script>

</head> 
<body>

  <!-- Back to top button -->
  <div class="back-to-top"></div>

  <header>
    <div class="topbar">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 text-sm">
            <div class="site-info">
              <a href="#"><span class="mai-call text-primary"></span> (+258)  21 81 01 81  /  21 81 00 02</a>
              <span class="divider">|</span>
              <a href="#"><span class="mai-mail text-primary"></span> fundação.manhica@manhica.net</a>
            </div>
          </div>
          {{-- <div class="col-sm-4 text-right text-sm">
            
          </div> --}}
          <div class="col-sm-4 text-right text-sm">
            <div class="social-mini-button">
              <a target="_blank" href="https://web.facebook.com/cism.manhica"><span class="mai-logo-facebook-f"></span></a>
              <a target="_blank" href="https://twitter.com/Manhica_CISM"><span class="mai-logo-twitter"></span></a>
              <a target="_blank" href="https://www.youtube.com/channel/UCkf5aEMVC5V7dCnHmfW8lCg"><span class="mai-logo-youtube"></span></a>
              <a target="_blank" href="https://mz.linkedin.com/company/cismmanhicaorg"><span class="mai-logo-linkedin"></span></a>
            </div>
            {{-- <div class="social-mini-button"> --}}
              {{-- <span class="mai-language" ></span> --}}
              
              @php
                                    if(Session::has('locale')){
                                        $locale = Session::get('locale', Config::get('app.locale'));
                                    }
                                    else{
                                        $locale = env('DEFAULT_LANGUAGE');
                                    }
                                @endphp

        
                                        {{-- <select class="form-control" id="change-language" data-width="fit">
                                          <option selected>{{translate('mudar_idioma')}}</option>
                                        @foreach (\App\Models\Language::all() as $key => $language)


                                                <option value="{{ $language->code }}" data-flag="{{ $language->code }}" @if($locale == $language->code) selected @endif>{{ $language->name }}</option>

                                        @endforeach
                                        </select> --}}
            {{-- </div> --}}
          </div>
        </div> <!-- .row -->
      </div> <!-- .container -->
    </div> <!-- .topbar -->

    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="https://www.cismmanhica.org/"> <img src=" {{asset('web/assets/img/CISM.png')}} "> </a>


        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport" aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupport">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item {{ request()->is('web/index') ? 'active' : "" }}">
              <a class="nav-link" style="line-height: 35px"  href="{{ route('cism.home') }}">{{translate('inicio')}}</a>
            </li>
            <li class="nav-item {{ request()->is('web/project') ? 'active' : "" }}">
              <a class="nav-link" href="{{route('cism.projects')}}">{{translate('projectos')}}</a>
            </li>
            <li class="nav-item {{ request()->is('web/artigo') ? 'active' : "" }}">
              <a class="nav-link" href="{{route('cism.artigo')}}">{{translate('artigos')}}</a>
            </li>
            <li class="nav-item {{ request()->is('web/register') ? 'active' : "" }}">
              <a class="nav-link" href="{{ route('cism.new_user') }}">{{translate('registar')}}</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="{{ route('auth') }}">Login</a>
            </li>

          </ul>
        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>
  </header>

  @yield('content')


  @include('web.layout.modals')

   <!-- .banner-home -->

  {{-- <footer class="page-footer">
    <div class="container">
      <div class="row px-md-3">
        

        <div class="col-sm-6 col-lg-3 py-3">
          <h5>{{translate('contactos')}}</h5>
          <p class="footer-link mt-2">Manhiça, Maputo</p>
          <a href="#" class="footer-link">info@cism.co.mz</a>
        </div>
      </div>

      <hr>

      <p id="copyright">Copyright &copy; {{date('Y')}} <a href="#" target="_blank">CISM</a>. {{translate('todos_direitos_reservados')}}</p>
    </div>
  </footer> --}}
  <footer class="page-footer">
    <h1  class="text-center wow fadeInUp">{{translate('endereco_contacto')}}</h1>
    <p style="border-bottom: 1px solid white; margin: 2px 25% 0 25%"></p>
    
    <div class="container">
      <div class="row px-md-12">

        <div class="col-sm-3 col-lg-3 py-3">
          <h5>{{translate("endereco_1")}}</h5>
          <ul class="footer-menu">
           <li>{{translate("endereco_1_detalhe")}}</li>
           <li>{{translate("endereco_1_contacto")}}</li>
          </ul>
        </div>

        <div class="col-sm-3 col-lg-3 py-3">
          <h5>{{translate("endereco_2")}}</h5>
          <ul class="footer-menu">
           <li>{{translate("endereco_2_detalhe")}}</li>
           <li>{{translate("endereco_2_contacto")}}</li>
          </ul>
        </div>
        <div class="col-sm-3 col-lg-3 py-3">
          <h5>{{translate("endereco_3")}}</h5>
          <ul class="footer-menu">
           <li>{{translate("endereco_3_detalhe")}}</li>
           <li>{{translate("endereco_3_contacto")}}</li>
          </ul>
        </div>

        
        <div class="col-sm-3 col-lg-3 py-3">
          <h5>{{translate("endereco_4")}}</h5>
          <ul class="footer-menu">
           <li>{{translate("endereco_4_detalhe")}}</li>
           <li>{{translate("endereco_4_contacto")}}</li>
          </ul>

          <h5 class="mt-3">{{translate('redes_socias')}}</h5>
          <div class="footer-sosmed mt-3">
            <a target="_blank" href="https://web.facebook.com/cism.manhica"><span class="mai-logo-facebook-f"></span></a>
            <a target="_blank" href="https://twitter.com/Manhica_CISM"><span class="mai-logo-twitter"></span></a>
            <a target="_blank" href="https://www.youtube.com/channel/UCkf5aEMVC5V7dCnHmfW8lCg"><span class="mai-logo-youtube"></span></a>
            <a target="_blank" href="https://mz.linkedin.com/company/cismmanhicaorg"><span class="mai-logo-linkedin"></span></a>              
          </div>
        </div>
      </div>

      <hr>
      

      {{-- <p id="copyright">Copyright &copy; {{date('Y')}} <a href="https://www.cismmanhica.org" target="_blank">CISM</a>. {{translate('todos_direitos_reservados')}}</p> --}}
    </div>
  </footer>
  <hr>
  <h1 class="text-left wow fadeInUp" style="margin-left:10%;">{{translate('parceiros')}}</h1>
  <div class="row" style="margin-left:0%; display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: start; width: 100%; overflow: scroll;">
    @foreach (\App\Models\CismPartners::all() as $partners)
        <div style="height: 190px; width: 100%; margin-left: -80px">
          <div class="card" style="width: 5px; margin-top: 25px; margin-left: 8rem; border: 0;">
            <a href="{{$partners->link}}" target="_blank" rel="noopener noreferrer">
              <img src="{{asset('web/assets/img/partners/'.$partners->icon)}}"  width="130px" height="120px" alt={{$partners->description}}>
            </a>
          </div>
        </div>
    @endforeach
  </div>
  {{-- <div class="page-section">
    <div class="container">
      <h1 class="text-center wow fadeInUp">{{translate('parceiros')}}</h1>
      <div class="row">
        @foreach (\App\Models\CismPartners::all() as $partners)
        <div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: start; width: 100%;">
          <div class="card" style="width: 8rem; margin-bottom: 70px; margin-left: 10rem; border: 0;">
            <a href="{{$partners->link}}" target="_blank" rel="noopener noreferrer">
              <img src="{{asset('web/assets/img/partners/'.$partners->icon)}}" class="card-img-top" alt={{$partners->description}}>
            </a>
          </div>
        </div>
          @endforeach


      </div>

      </div>
    </div>
  </div> --}}


<script src="{{asset('web/assets/js/jquery-3.5.1.min.js')}}"></script>

<script src="{{asset('web/assets/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{asset('web/assets/vendor/owl-carousel/js/owl.carousel.min.js')}}"></script>

<script src="{{asset('web/assets/vendor/wow/wow.min.js')}}"></script>

<script src="{{asset('web/assets/js/theme.js')}}"></script>
@yield("scripts")
<script>
$('#change-language').on('change', function(e){
  e.preventDefault();
      var locale = $(this).val();
      $.post('{{ route('language.change') }}',{_token:'{{ csrf_token() }}', locale:locale}, function(data){
        location.reload();
      }); 

});  
</script>

</body>
</html>
