@extends('web.layout.template')

@section('content')

<div class="page-banner overlay-dark bg-image" style="background-image: url({{ asset('web/assets/img/bg_image_1.jpg') }});">
    <div class="banner-section">
      <div class="container text-center wow fadeInUp">
        <nav aria-label="Breadcrumb">
          <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
            <li class="breadcrumb-item"><a href="{{ route('cism.home') }}">{{translate('inicio')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{translate('registar')}}</li>
          </ol>
        </nav>
        {{-- <h1 class="font-weight-normal">{{translate('registar')}}</h1> --}}
      </div> <!-- .container -->
    </div> <!-- .banner-section -->
  </div> <!-- .page-banner -->

  <div class="page-section">
    <div class="container">
      <h1 class="text-center wow fadeInUp">{{translate('formulario_registo_usuario')}}</h1>
      <h3 class="text-center wow fadeInUp">{{translate('formulario_registo_pi')}}</h3>

      @if (Session::has('success'))
        <div class="clearfix"></div>
        <div class="alert alert-success" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {!! Session::get('success') !!}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

      <form action="{{route('cism.store')}}"  method="post" >
          @csrf
          {{-- <input type="hidden" name="key" > --}}
        <div class="row mb-3">

          <div class="col-sm-6 py-2 wow fadeInLeft">
            <label for="fullName">{{translate('nome_completo')}}</label>
            <input type="text" id="fullName" class="form-control"  value="{{ old('s_name') }}" name="s_name" placeholder="{{translate('nome_completo')}}">
            @error('s_name')
                <span style="color: red"> {{ $message }}</span>
            @enderror
          </div>

          <div class="col-sm-6 py-2 wow fadeInRight">
            <label for="emailAddress">{{translate('email')}}</label>
            <input name="email" type="email" value="{{ old('email') }}" class="form-control" placeholder="{{translate('endereco_email')}}" autocomplete="off">
            @error('email')
                <span style="color: red"> {{ $message }}</span>
            @enderror
          </div>
          <div class="col-sm-6 py-2 wow fadeInLeft">
            <label for="password">{{translate('senha')}}</label>
            <input type="password" id="senha" class="form-control"  name="password" placeholder="{{translate('senha')}}" autocomplete="off">
            @error('password')
                <span style="color: red"> {{ $message }}</span>
            @enderror
          </div>
          <div class="col-sm-6 py-2 wow fadeInRight">
            <label for="emailAddress">{{translate('senha_novamente')}}</label>
            <input type="password" id="senha2" class="form-control"  name="password_2" placeholder="{{translate('senha_novamente')}}">
          </div>

          <div class="col-sm-6 py-2 wow fadeInRight">
            <label for="contact">{{translate('nr_celular')}}</label>
            {{-- <input type="tel" id="phone" name="phone" placeholder="Digite numero de telefone" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" required> --}}
            <input type="tel" id="contact" class="form-control"  value="{{ old('contacto') }}" name="contacto" placeholder="{{translate('nr_celular')}}">
            @error('contacto')
                <span style="color: red"> {{ $message }}</span>
            @enderror
          </div>
          <div class="col-sm-6 py-2 wow fadeInLeft">
            <label for="contact">{{translate('funcionario_cism')}}</label>
            <select name="estado" id="user_check" class="form-control" title="{{translate('select_option')}}">
                <option value="1">{{translate('sim')}}</option>
                <option value="0">{{translate('nao')}}</option>
            </select>
            @error('contacto')
                <span style="color: red"> {{ $message }}</span>
            @enderror
          </div>



          <div class="col-sm-6 py-2 wow fadeInLeft" id="nome_instituicao_div">
            <label for="nome_instituicao">{{translate('nome_instituicao')}}</label>
            <input list="nome_instituicao"
            name="nome_instituicao"
            placeholder="{{translate('nome_instituicao')}}"
            class="form-control"
            type="text"
            >
            <datalist id="nome_instituicao" class="form-group">
                @foreach ($instituicao as $instituicao)
                    <option value="{{ $instituicao->ui_description }}">
                @endforeach
            </datalist>

            @error('nome_instituicao')
                <span style="color: red"> {{ $message }}</span>
            @enderror
          </div>

          <div class="col-sm-6 py-2 wow fadeInRigth">
            {{-- <div class="g-recaptcha" data-sitekey="{{env('RECAPTCHAV2_SITEKEY')}}"></div>      --}}
            <div class="g-recaptcha" data-sitekey="6Lf51T0eAAAAABPKn9Mp5sGeyjFAWcU5MQuQrMO2"></div>     
            @if ($errors->has('g-recaptcha-response')) 
                <span class="invalid-feedback" style="color: red">
                    <strong >{{ $errors->first('g-recaptcha-response') }}</strong>
                </span>
            @endif
            @error('g-recaptcha-response')
              <span style="color: red"> {{ $message }}</span>
            @enderror

          </div>

          <div class="col-sm-6 py-2 wow fadeInCenter">
            <button type="submit" class="btn btn-primary wow zoomIn">{{translate('registar')}}</button>
        </div>

        </div>

      </form>
    </div>
  </div>



  @include('web.layout.modals')
@endsection

@section("scripts")
    <script>
        $(document).ready(function(){
            $("#nome_instituicao_div").hide();
            $("#user_check").change(function(){
                var answer = $("#user_check").val();
                if(answer == 0){
                    $('#nome_instituicao_div').css('visibility','visible');
                    $("#nome_instituicao_div").show();
                }else{
                    $("#nome_instituicao_div").hide();
                }

            })
        });
    </script>

@endsection
