<!DOCTYPE html>
<html lang="en, pt">
    <head>
        <title>CISM</title>

        <!-- META SECTION -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="shortcut icon" href="{{asset('assets/img/logo.png')}}" type="image/jpg">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">

        <!-- END META SECTION -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
        <script src="{{asset('assets/js/vendor/jquery.maskMoney.js') }}" type="text/javascript"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
        <!-- CSS INCLUDE -->
        @yield("scripts_head")
        <!-- EOF CSS INCLUDE -->
        @yield('css')
        <style>
            @font-face{
                font-family: "interstate"; 
                src: local('../../web/assets/fonts/')
            }
            /* Center the loader */
            .loader {
              position: absolute;
              left: 50%;
              top: 50%;
              z-index: 1;
              width: 120px;
              height: 120px;
              margin: -76px 0 0 -76px;
              border: 16px solid #f3f3f3;
              border-radius: 50%;
              border-top: 16px solid #eaac00;
              border-right: 16px solid #007a43;
              border-bottom: 16px solid white;
              overflow:
              -webkit-animation: spin 2s linear infinite;
              animation: spin 2s linear infinite;
            }
            #logo_hover:hover{
                /* background: #fff9e6 !important; */
                background-color: #f3f3f3 !important;
                pointer-events: none !important;
            }

            @-webkit-keyframes spin {
              0% { -webkit-transform: rotate(0deg); }
              100% { -webkit-transform: rotate(360deg); }
            }

            @keyframes spin {
              0% { transform: rotate(0deg); }
              100% { transform: rotate(360deg); }
            }

            /* Add animation to "page content" */
            .animate-bottom {
              position: relative;
              -webkit-animation-name: animatebottom;
              -webkit-animation-duration: 1s;
              animation-name: animatebottom;
              animation-duration: 1s
            }

            @-webkit-keyframes animatebottom {
              from { bottom:-100px; opacity:0 }
              to { bottom:0px; opacity:1 }
            }

            @keyframes animatebottom {
              from{ bottom:-100px; opacity:0 }
              to{ bottom:0; opacity:1 }
            }
            /* width */

            #myDiv {
              display: none;
              text-align: center;
            }

        </style>
    </head>
    <body>
        {{-- <div class="lds-spinner"></div> --}}
        <div id="loader" class="loader"></div>

        <!-- APP WRAPPER -->
        <div id="app" style="display:none;" class="app animate-bottom">

            <!-- START APP CONTAINER -->
            <div class="app-container">
                <!-- START SIDEBAR -->
                <div class="app-sidebar app-navigation app-navigation-style-default app-navigation-custom app-navigation-open-hover dir-left" style="height: 1024px;" data-type="close-other">
                    <a href="{{route('cism.home')}}" class="app-navigation-logo" id="logo_hover"> CISM
                    </a>

                    <nav>
                    <ul>
                            <li class="title ">Menu</li>
                            @can("isAdmin")                            

                            <li><a href="{{ route("admin.dashboard") }}" class="{{request()->is('admin/dashboard')?'active':""}}"><span class="fa fa-tachometer" style="color: rgba(255, 255, 255, 0.925)"></span>  {{translate('dashboard')}}</a></li>
                            
                            @endcannot
                            @if(Auth::user()->can("isInvestigator"))
                                <li><a href="{{ route('pre_writing.investigator.project') }}" class="{{ request()->is('pre-writing/investigator/project-list') ? 'active' : "" }}"><span class="fa fa-edit" style="color: rgba(255, 255, 255, 0.925)"></span> Pre award</a></li>
                                <li>
                                    <a href="#" class=""><span class="fa fa-check-square-o" style="color: rgba(255, 255, 255, 0.925)"></span> Post award</a>
                                    <ul>
                                        <li><a href="{{route('configs_post_award.index')}}" class="{{ request()->is('post-award/configs') ? 'active' : "" }}"><span class="nav-icon-hexa">Ps</span> {{translate('projecto')}}</a></li>
                                        <li><a href="{{route('study_phase.index')}}" class="{{ request()->is('post-award/study-phase') ? 'active' : "" }}"><span class="nav-icon-hexa">Ps</span> {{translate('actualizar_estudo')}}</a></li>
                                        {{-- <li><a href="{{route('post_award.project_charter_index')}}" class=""><span class="nav-icon-hexa">Pc</span> Project Charter</a></li> --}}
                                        {{-- <li><a href="{{route('post_award.project_charter_index')}}" class=""><span class="nav-icon-hexa">Pc</span> Project Charter</a></li> --}}
                                    </ul>
                                </li>
                                
                            @endif
                            @if(Auth::user()->can("grantManager"))
                                <li><a href="{{ route('grant.project_list')}}" class="{{request()->is('pre-writing/grant-manager/project_list')?'active':""}}"><span class="fa fa-edit" style="color: rgba(255, 255, 255, 0.925)"></span> Pre award</a></li>
                                {{-- <li><a href="{{route('configs_post_award.index')}}"><span class="nav-icon-hexa">Ps</span> Post award</a></li> --}}
                            @endif

                            @if(Auth::user()->can("studyTeam") || Auth::user()->can("scientificCoordinator") || Auth::user()->can("ethicalCoordinator"))
                                <li><a href="{{route('configs_post_award.index')}}" class="{{request()->is('post-award/configs')?'active':""}}" ><span class="fa fa-check-square-o" style="color: rgba(255, 255, 255, 0.925)"></span> Post award</a></li>
                                <li>
                                    <ul>
                                        <li>

                                        <a href="{{route('configs_post_award.index')}}"><span class="fa fa-check-square-o" style="color: rgba(255, 255, 255, 0.925)"></span> Post award</a>
                                    </li>
                                </ul>
                            </li>
                            @can("scientificCoordinator")
                            <li>
                                <a href="#"><span class="fa fa-folder-open-o" style="color: rgba(255, 255, 255, 0.925)"></span> {{translate('gestao_artigos')}}<span class="label label-success label-bordered label-ghost"></span></a>
                                <ul>
                                    <li>
                                        <a href="{{route('article.new_article')}}" class="{{request()->is('post-award/article/create')?'active':""}}"><span class="nav-icon-hexa" style="color: rgba(255, 255, 255, 0.925)">na</span> {{translate('novo_artigo')}}</a>
                                    </li>
                                    <li> 

                                        <a href="{{route('article_post_award.index')}}" class="{{request()->is('post-award/article')?'active':""}}" ><span class="nav-icon-hexa" style="color: rgba(255, 255, 255, 0.925)">A</span> {{translate('artigos')}}</a>
                                    </li>

                                </ul>
                            </li>
                            @endcan
                            @endif

                            {{-- @can("pre_award_manager" ) --}}
                            @if(Auth::user()->can("pre_award_manager"))
                            <li><a href="{{route('pam.project_list')}}"><span class="nav-icon-hexa">Pa</span> Pre award</a></li>
                                <li><a href="{{route('configs_post_award.index')}}"><span class="nav-icon-hexa">Po</span> Post award</a></li
                            @endif
                            {{-- @if(Auth::user()->r_id == 2) --}}
                            @can("scientific_director")
                            <li><a href="{{route('pam.project_list')}}"><span class="nav-icon-hexa">Pa</span> Pre award</a></li>
                            @endcan

                            {{-- @endif --}}
                            @if(Auth::user()->can("management") || Auth::user()->can("isAdmin")) 
                            <li><a href="{{route('pam.project_list')}}" class="{{request()->is('pre-writing/pre-award-manager/project_approval')?'active':""}}"><span class="fa fa-edit" style="color: rgba(255, 255, 255, 0.925)"></span> Pre award</a></li>
                            <li><a href="{{route('configs_post_award.index')}}" class="{{request()->is('post-award/configs')?'active':""}}"><span class="fa fa-check-square-o" style="color: rgba(255, 255, 255, 0.925)"></span> Post award</a></li>
                            <li>
                                <a href="#"><span class="fa fa-folder-open-o" style="color: rgba(255, 255, 255, 0.925)"></span> {{translate('gestao_artigos')}}<span class="label label-success label-bordered label-ghost"></span></a>
                                <ul>
                                    <li>
                                        <a href="{{route('article.new_article')}}" class="{{request()->is('post-award/article/create')?'active':""}}"><span class="nav-icon-hexa" style="color: rgba(255, 255, 255, 0.925)">na</span> {{translate('novo_artigo')}}</a>
                                    </li>
                                    <li>

                                        <a href="{{route('article_post_award.index')}}" class="{{request()->is('post-award/article')?'active':""}}" ><span class="nav-icon-hexa" style="color: rgba(255, 255, 255, 0.925)">A</span> {{translate('artigos')}}</a>
                                    </li>

                                </ul>
                            </li>
                            <li>
                                <a href="#"  class="{{request()->is('reports/project')?'active':""}}"> <span class="fa fa-line-chart" style="color: rgba(255, 255, 255, 0.925)"></span> {{translate('relatorios')}} <span class="label label-success label-bordered label-ghost"></span></a>
                                <ul>
                                    <li> <a href="{{route("report.index")}}" class="{{request()->is('reports/project')?'active':""}}"><span class="nav-icon-hexa">na</span> {{translate("projectos")}}</a> </li>
                                </ul>
                            </li>
                            @endif
                        @if(Auth::user()->can("isAdmin"))
                        {{-- @can("isAdmin") --}}
                            <li>
                                <a href="#"><span class="fa fa-users" style="color: rgba(255, 255, 255, 0.925)"></span> {{translate('gestao_utilizador')}}<span class="label label-success label-bordered label-ghost"></span></a>
                                <ul>
                                    <li>
                                        <a href="{{route('admin.register')}}" class="{{request()->is('admin/user-create')?'active':""}}"><span class="fa fa-user-plus" style="color: rgba(255, 255, 255, 0.925)"></span>{{translate('novo_utilizador')}}</a>
                                    </li>
                                    <li>
                                        <a href="{{route('blocked_user.list')}}" class="{{request()->is('admin/users/blocked')?'active':""}}"><span class="fa fa-user-times" style="color: rgba(255, 255, 255, 0.925)"></span>{{translate('user_blocked')}}</a>
                                    </li>
                                    <li>

                                        <a href="{{route("admin.user_list")}}" class="{{request()->is('admin/users')?'active':""}}"><span class="fa fa-users" style="color: rgba(255, 255, 255, 0.925)"></span>{{translate('lista_utilizador')}}</a>
                                    </li>
                                    
                                </ul>
                            </li>
                            <li><a href="{{route('logs')}}" class="{{request()->is('admin/logs')?'active':""}}"><span class="fa fa-history" style="color: rgba(255, 255, 255, 0.925)"></span>Logs </a></li>
                        @endif
                        {{-- @can('isAdmin') --}}
                        @if(Auth::user()->can("isAdmin"))
                            <li>
                                <a href="#"><span class="fa fa-cog" style="color: rgba(255, 255, 255, 0.925)"></span> {{translate('definicoes')}}<span class="label label-success label-bordered label-ghost"></span></a>
                                <ul>
                                    <li>
                                        <a href="{{route("funder.index")}}" class="{{request()->is('admin/funder/list')?'active':""}}"><span class="fa fa-street-view" style="color: rgba(255, 255, 255, 0.925)"></span>{{translate('gestao_financiador')}}</a>
                                    </li>
                                    
                                    <li><a href="{{route('system_configuration')}}" class="{{request()->is('configuration/system')?'active':""}}"><span class="fa fa-wrench" style="color: rgba(255, 255, 255, 0.925)"></span>{{translate('sistema')}}</a></li>
                                    
                                </ul>
                            </li>
                            
                        @endif


                        </ul>    
                    </nav>
                </div>
                <!-- END SIDEBAR -->

                <!-- START APP CONTENT -->
                <div class="app-content app-sidebar-left">
                    <!-- START APP HEADER -->
                    <div class="app-header app-header-design-default">
                        <ul class="app-header-buttons">
                            <li class="visible-mobile"><a href="#" class="btn btn-link btn-icon" data-sidebar-toggle=".app-sidebar.dir-left"><span class="icon-menu"></span></a></li>
                            <li class="hidden-mobile"><a href="#" class="btn btn-link btn-icon" data-sidebar-minimize=".app-sidebar.dir-left"><span class="icon-menu"></span></a></li>
                        </ul>
                       

                        <ul class="app-header-buttons pull-right">
                            <li>
                                <div class="contact contact-rounded contact-bordered contact-lg contact-ps-controls hidden-xs">
                                    <img src="{{asset('assets/images/user/no-image.png')}}" alt="John Doe">
                                    <div class="contact-container">
                                        <a href="{{ route("configuration.user") }}">@yield('user_name')</a>
                                        <span>@yield('user_role')</span>
                                    </div>
                                </div>
                            </li>
                            

                            <li>

                                @php
                                    if(Session::has('locale')){
                                        $locale = Session::get('locale', Config::get('app.locale'));
                                    }
                                    else{
                                        $locale = env('DEFAULT_LANGUAGE');
                                    }
                                @endphp

                                        <select class="selectpicker" id="change-language" data-width="fit">

                                        @foreach (\App\Models\Language::all() as $key => $language)


                                                <option value="{{ $language->code }}" data-flag="{{ $language->code }}" @if($locale == $language->code) selected @endif>{{ $language->name }}</option>

                                        @endforeach
                                        </select>
                            </li>


                            <li>
                                <button
                                    href="#"
                                    data-href="{{route("logout")}}"
                                    data-toggle="modal"
                                    data-target="#modal-logout"
                                    class="btn btn-default"
                                    >
                                    {{translate("terminar_sessao")}}
                                    <i class="fa fa-sign-out"></i>
                                </button>  
                            </li>
                        </ul>
                    </div>
                    <!-- END APP HEADER  -->

                    <!-- START PAGE HEADING -->
                    <div class="app-heading app-heading-bordered app-heading-page">
                        <div class="title">
                            <h2>@yield('page_title')</h2>
                            <p>@yield('title_description')</p>
                        </div>
                    </div>
                    <div class="app-heading-container app-heading-bordered bottom">
                        <ul class="breadcrumb">
                            <li> @yield('page_name') </li>
                            <li>@yield('page_title_')</li>
                            <li class="active">@yield('page_title_active')</li>
                            {{-- <li class="active">Form Wizard</li> --}}
                        </ul>
                    </div>
                    <!-- END PAGE HEADING -->

                    <!-- START PAGE CONTAINER -->
                    <div style="overflow: scroll; max-width: 100vmax; width: 99%; max-height: 80vh; height: 100%; margin-bottom: 24px">

                        <div class="container">
                            @include('partials.alerts')

                            @yield('content')

                        </div>
                        <!-- END PAGE CONTAINER -->
                    </div>

                </div>
                <!-- END APP CONTENT -->

            </div>
            <!-- END APP CONTAINER -->

         <!-- START APP FOOTER -->
         <div class="app-footer app-footer-default" id="footer">
            <div class="app-footer-line">
                <div class="copyright">CISM &copy; {{ '20' . date('y') }} Centro de Investigação em Saúde da Manhiça </div>
                <div class="pull-right">
                    <ul class="list-inline">
                        <li><a href="{{route("cism.home")}}">{{translate('pagina_inicial')}}</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- END APP FOOTER -->
        <!-- START APP SIDEPANEL -->
        <div class="app-sidepanel scroll" data-overlay="show">


        </div>
        <!-- END APP SIDEPANEL -->

        <!-- APP OVERLAY -->
        <div class="app-overlay"></div>
        <!-- END APP OVERLAY -->
    </div>
    <!-- END APP WRAPPER -->
    <div class="modal fade" id="modal-logout" tabindex="-1" role="dialog" aria-labelledby="modal-success-header">
        <div class="modal-dialog modal-success" role="document">
            <button type="button" class="submit" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>
    
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-danger-header">{{translate('terminar_sessao')}}</h4>
                </div>
                <div class="modal-body">
                    <h3> {{translate('tem_certeza_terminar_sessao')}} </h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">{{translate('cancelar')}}</button>
                    <a class="btn btn-success btn-ok">{{translate('confirmar')}}</a>
                </div>
    
            </div>
        </div>
    </div>


    <!-- IMPORTANT SCRIPTS -->
    <script type="text/javascript" src="{{asset('assets/js/vendor/jquery/jquery.min.js')}}"></script>
    <script type="text/javascript" src=" {{asset('assets/js/vendor/jquery/jquery-ui.min.js')}} "></script>
    <script type="text/javascript" src=" {{asset('assets/js/vendor/bootstrap/bootstrap.min.js')}} "></script>
    <script type="text/javascript" src=" {{asset('assets/js/vendor/moment/moment.min.js')}} "></script>
    {{-- <script type="text/javascript" src=" {{asset('assets/js/vendor/moment/jquery-migrate.min.js')}} "></script>  --}}

    <script type="text/javascript" src=" {{asset('assets/js/vendor/customscrollbar/jquery.mCustomScrollbar.min.js')}} "></script>
    <script type="text/javascript" src=" {{asset('assets/js/vendor/bootstrap-select/bootstrap-select.js')}} "></script>
    <script type="text/javascript" src=" {{asset('assets/js/vendor/select2/select2.full.min.js')}} "></script>
    <script type="text/javascript" src=" {{asset('assets/js/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.js')}} "></script>

    <script type="text/javascript" src=" {{asset('assets/js/vendor/maskedinput/jquery.maskedinput.min.js')}} "></script>
    <script type="text/javascript" src=" {{asset('assets/js/vendor/form-validator/jquery.form-validator.min.js')}} "></script>

    <script type="text/javascript" src=" {{asset('assets/js/vendor/noty/jquery.noty.packaged.js')}} "></script>

    <script type="text/javascript" src=" {{asset('assets/js/vendor/datatables/jquery.dataTables.min.js')}} "></script>
    <script type="text/javascript" src=" {{asset('assets/js/vendor/datatables/dataTables.bootstrap.min.js')}} "></script>

{{--    <script type="text/javascript" src=" {{asset('assets/js/vendor/sweetalert/sweetalert.min.js')}} "></script>--}}
    <script type="text/javascript" src=" {{asset('assets/js/vendor/knob/jquery.knob.min.js')}} "></script>

    <script type="text/javascript" src=" {{asset('assets/js/vendor/jvectormap/jquery-jvectormap.min.js')}} "></script>
    <script type="text/javascript" src=" {{asset('assets/js/vendor/jvectormap/jquery-jvectormap-world-mill-en.js')}} "></script>
    <script type="text/javascript" src=" {{asset('assets/js/vendor/jvectormap/jquery-jvectormap-us-aea-en.js')}} "></script>

    <script type="text/javascript" src=" {{asset('assets/js/vendor/sparkline/jquery.sparkline.min.js')}} "></script>

    <script type="text/javascript" src=" {{asset('assets/js/vendor/morris/raphael.min.js')}} "></script>
    <script type="text/javascript" src=" {{asset('assets/js/vendor/morris/morris.min.js')}} "></script>

    <script type="text/javascript" src=" {{asset('assets/js/vendor/rickshaw/d3.v3.js')}} "></script>
    <script type="text/javascript" src=" {{asset('assets/js/vendor/rickshaw/rickshaw.min.js')}} "></script>

    <script type="text/javascript" src=" {{asset('assets/js/vendor/isotope/isotope.pkgd.min.js')}} "></script>

    <script type="text/javascript" src=" {{asset('assets/js/vendor/dropzone/dropzone.js')}} "></script>
    <script type="text/javascript" src=" {{asset('assets/js/vendor/nestable/jquery.nestable.js')}} "></script>
    <script type="text/javascript" src=" {{asset('assets/js/vendor/cropper/cropper.min.js')}} "></script>

    <script type="text/javascript" src=" {{asset('assets/js/vendor/tableexport/tableExport.js')}} "></script>
    <script type="text/javascript" src=" {{asset('assets/js/vendor/tableexport/jquery.base64.js')}} "></script>
    <script type="text/javascript" src=" {{asset('assets/js/vendor/tableexport/html2canvas.js')}} "></script>
    <script type="text/javascript" src=" {{asset('assets/js/vendor/tableexport/jspdf/libs/sprintf.js')}} "></script>
    <script type="text/javascript" src=" {{asset('assets/js/vendor/tableexport/jspdf/jspdf.js')}} "></script>
    <script type="text/javascript" src=" {{asset('assets/js/vendor/tableexport/jspdf/libs/base64.js')}} "></script>

    <script type="text/javascript" src=" {{asset('assets/js/vendor/bootstrap-daterange/daterangepicker.js')}} "></script>
    <script type="text/javascript" src=" {{asset('assets/js/vendor/bootstrap-tour/bootstrap-tour.min.js')}} "></script>
    <script type="text/javascript" src=" {{asset('assets/js/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js')}} "></script>
    <script type="text/javascript" src=" {{asset('assets/js/vendor/fullcalendar/fullcalendar.js')}} "></script>
    <script type="text/javascript" src=" {{asset('assets/js/vendor/smartwizard/jquery.smartWizard.js')}} "></script>

    <script type="text/javascript" src="{{asset('assets/js/app.js')}} "></script>
    <script type="text/javascript" src="{{asset('assets/js/app_plugins.js')}} "></script>
    <script type="text/javascript" src="{{asset('assets/js/app_demo.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/sweetalert.min.js')}} "></script>
    <script type="text/javascript" src="{{asset('assets/js/cism/commonMaster.js')}} "></script>
    <script src="{{asset('assets/js/vendor/jquery.maskMoney.js') }}" type="text/javascript"></script>
    <script src="{{"https://www.google.com/recaptcha/api.js?explicit&hl=".Session::get('locale', Config::get('app.locale'))}}"></script>
    
{{--        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>--}}
<script>

    var myVar;
    $( window ).on( "load", function() {
        // myVar = setTimeout(showPage, 3000);
        showPage();
        // var temp = document.getElementById("nextBtn");
        $("#nextBtn").text("{{translate('proximo')}}").button("refresh");
        $("#prevBtn").text("{{translate('anterior')}}").button("refresh");

        // temp.text('Save').button("refresh");
        // console.log(temp); 
    });
    $('#modal-logout').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

    function showPage() {
        document.getElementById("loader").style.display = "none";
        document.getElementById("app").style.display = "block";
    }
      $(function () {
        $("#files").change(function () {
          filename = this.files[0].name;
          if (filename != null) {
            $("#file_upload").text(filename);
          } else {
            $("#file_upload").text("Select text");
          }
        });
      });

            $('#change-language').on('change', function(e){
                e.preventDefault();
                var locale = $(this).val();
                
                $.post('{{ route('language.change') }}',{_token:'{{ csrf_token() }}', locale:locale}, function(data){
                    location.reload();
                }); 
                sessionStorage.setItem("language", locale);
            });

</script>
    @yield('scripts')
    <!-- END APP SCRIPTS -->
</body>
</html>
