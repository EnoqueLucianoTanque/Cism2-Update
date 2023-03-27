<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Recuperação de senha</title>

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
    </head>
    <body>

        <!-- APP WRAPPER -->
        <div class="app">
            @include('partials.alerts')
            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </div>
                            @endif

            <!-- START APP CONTAINER -->
            <div class="app-container" style="margin-top: 70px">
                <div class="app-login-box">
                    <div class="app-login-box-user"><img src="{{asset('assets/img/logo.png')}}" alt="John Doe"></div>
                    <div class="app-login-box-title">
                        <div class="title">{{translate('formulario_recuperacao_senha')}}.</div>
                        {{-- <div class="subtitle"></div> --}}
                    </div>
                    <div class="app-login-box-container">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group">
                                <label for="email" class="col-md-2 control-label">Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus >
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password" class=" control-label">{{ translate('nova_senha')}}</label>

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            {!! RecaptchaV3::initJs() !!}
    
                            {!! RecaptchaV3::field('recaptcha') !!}

                            <div class="form-group">
                                <label for="password-confirm" class="control-label">{{ translate('digite_novamente_senha') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <div class="form-group text-center" style="margin-bottom: 5px">
                                <button type="submit" class="btn btn-primary">
                                    {{ translate('submeter') }}
                                </button>

                            </div>
                        </form>
                        <div class="app-login-box-footer">
                            &copy; CISM. {{translate('todos_direitos_reservados')}} 
                        </div>
                    </div>

                </div>
                <!-- END APP CONTAINER -->

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
        <!-- END APP SCRIPTS -->
    </body>
</html>
