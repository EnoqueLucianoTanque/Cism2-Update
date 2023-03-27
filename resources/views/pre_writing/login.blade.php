<!DOCTYPE html>
<html lang="en">
    <head>
        <title>CISM | Login</title>

        <!-- META SECTION -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="shortcut icon" href="{{asset('assets/img/logo1.png')}}" type="image/jpg">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <!-- END META SECTION -->
        <!-- CSS INCLUDE -->
        <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
        <!-- EOF CSS INCLUDE -->
        <script src="{{"https://www.google.com/recaptcha/api.js?explicit&hl=".Session::get('locale', Config::get('app.locale'))}}"></script>
    </head> 
    <body>
{{-- {{dd(env('DEFAULT_LANGUAGE'))}} --}}
        <!-- APP WRAPPER -->
        <div class="app">
            @include('partials.alerts')
            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </div>
                            @endif

            <!-- START APP CONTAINER -->
            <div class="app-container" style="">

                <div class="app-login-box">
                    <div class="app-login-box-user"> <a href="{{route("cism.home")}}"> <img src="{{asset('assets/img/logo.png')}}" alt="John Doe"></a></div>
                    <div class="app-login-box-title">
                        <div class="title">{{translate('possui_conta')}}</div>
                        <div class="subtitle">{{translate('insira_credencias')}}</div>
                    </div>
                    <div class="app-login-box-container">
                        <form action="{{route('authenticate')}}" method="POST" id="login-form">
                        @csrf
                        {{-- <div class="g-recaptcha" data-sitekey="your_site_key"></div> --}}
                            <div class="form-group">
                                <input type="text"  class="form-control" name="email" placeholder="{{translate('email_addrress')}}">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" style="color: red">
                                        <strong >{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif 
                            </div>
                            {{-- {{dd(env('RECAPTCHAV2_SITEKEY'))}} --}}
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="{{translate('senha')}}">
                                @if (!empty($attempt))
                                
                                    <span class="invalid-feedback" style="color: red">
                                        <strong >{{$attempt}} {{translate('minutos')}}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="6LezTAMeAAAAAAyzweCgNgQwIzdOkL7-Bq73dtcF"></div>    
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="invalid-feedback" style="color: red">
                                        <strong >{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                

                                <div class="row">
                                    <div class="col-md-6 col-xs-6">
                                        <div class="app-checkbox">
                                            <label><input type="checkbox" name="app-checkbox-1" value="0"> {{translate('remeber')}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <button 
                                            class="btn btn-primary btn-block"
                                            >Log in
                                        </button>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        @if (Route::has('password.request'))
                                        <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modal-primary">{{translate('esqueceu_senha')}}</button>
                                        @endif
                                    </div>

                                </div>

                            </div>
                            {{-- @else
                                
                                
                            @endif --}}
                        </form>
                    </div>

                    <div class="app-login-box-footer">
                        &copy; CISM. {{translate('todos_direitos_reservados')}} 
                    </div>
                </div>

            </div>
            <!-- END APP CONTAINER -->

        </div>
        <!-- END APP WRAPPER -->
        <div class="modal fade" id="modal-primary" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal-primary-header">
            <div class="modal-dialog modal-primary" role="document">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>

                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-primary-header">{{translate('recuperacao_senha')}}</h4>
                    </div>
                    <form action="{{ route('password.email') }}" method="post" id="form_password_reset">
                        @csrf
                        <div class="modal-body">
                            <h3>{{translate('digite_email_recuperar_senha')}}</h3>
                            <div class="form-group row">
                                <div class="form-group">
                                    {{-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label> --}}
                                    <div class="col-md-12">
                                        <input placeholder="{{translate('email')}}" id="email" type="email" class="form-control" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link" data-dismiss="modal">{{translate('fechar')}}</button>
                            <button type="submit" class="btn btn-success" id="btn_submit">{{translate('enviar')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- IMPORTANT SCRIPTS -->
        <script type="text/javascript" src="{{ asset('assets/js/vendor/jquery/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/vendor/jquery/jquery-migrate.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/vendor/jquery/jquery-ui.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/vendor/bootstrap/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/vendor/moment/moment.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/vendor/customscrollbar/jquery.mCustomScrollbar.min.js') }}"></script>
        <!-- END IMPORTANT SCRIPTS -->
        <!-- APP SCRIPTS -->
        <script type="text/javascript" src="{{ asset('assets/js/app.js')}}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/app_plugins.js')}}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/app_demo.js')}}"></script>
        <
        <!-- END APP SCRIPTS -->


        <script>
            function onSubmit(token) {
                document.getElementById("login-form").submit();
            }            
                       
            // $("#form_password_reset").submit(function(e){
            //     let email = document.getElementById("email").value;
            //     alert("Um email foi enviado para o email "+ email + "por favor verifique a sua caixa de mensagens.")
            // });
        </script>
    </body>
</html>
