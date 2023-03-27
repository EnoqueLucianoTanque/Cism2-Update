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
        
    </head> 
    <body>
{{-- {{dd(env('DEFAULT_LANGUAGE'))}} --}}
        <!-- APP WRAPPER -->
        <div class="app">
            @include('partials.alerts')

            <!-- START APP CONTAINER -->
            <div class="app-container" style="">

                <div class="app-login-box">
                    <div class="app-login-box-user"><img src="{{asset('assets/img/logo.png')}}" alt="John Doe"></div>
                    <div class="app-login-box-title">
                        <div class="title">{{translate('muitas_tentativas_login')}}</div>
                        <div class="subtitle"> <span style="color: red"> {{translate('redicionar_automaticamente_'). ' '.translate('tente_novamente_em'). ' '.\App\Models\Configuration::getConfigurationType('decayMinutes').' '.translate('minutos')}}</span></div>
                    </div>
                    <div class="app-login-box-container">
                        <form action="" method="POST" id="login-form">
                        @csrf
                        {{-- <div class="g-recaptcha" data-sitekey="your_site_key"></div> --}}
                            
                            
                            
                        
                            <div class="form-group">

                                <div class="row">
                                    @if ($errors->has('attempt'))
                                        <span class="invalid-feedback" style="color: red">
                                            {{-- {{dd($errors)}} --}}
                                            <strong >{{ $errors->first('attempt') }}</strong>
                                        </span>
                                    @endif
                                    
                                </div>

                            </div>
                            <div class="form-group">
                                <div id="output">

                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="app-login-box-footer">
                        &copy; CISM. {{translate('todos_direitos_reservados')}} 
                    </div>
                </div>

            </div>
            <!-- END APP CONTAINER -->

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


        <script>
            
            function showCountdown(countSeconds)
            {  
                var countStatus = new Date(1000 * countSeconds).toISOString().substr(11, 8);
                document.getElementById('output').innerHTML = "{{translate('tente_novamente_em')}}: " + countStatus;
            }
            let seconds = "{{\App\Models\Configuration::getConfigurationType('decayMinutes')}}" ;
            let minutes = parseFloat(seconds)*60;
            var count = minutes;

            function countdown() {
            // starts countdown
            if (count === 0) {
                // location.reload();
                // document.getElementById("btn_login_form").style.visibility = "visible";
                window.location.href = "{{route('auth')}}";
                
                return;
            }
            count--;
                setTimeout(countdown, 1000);
                showCountdown(count);
            
            };

            countdown(); 
        </script>
    </body>
</html>
