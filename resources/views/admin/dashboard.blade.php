@extends('layout.template')
@section('page_title', translate('dashboard'))
@section('title_description', translate('pagina_inicial'))
{{-- @section('page_name', 'Pre Award') --}}
@section('page_title_', translate('menu'))
@section('page_title_active', translate('dashboard'))
@section('user_role', session('role_name'))
@section('user_name', session('user_name'))
@section('scripts_head')
<script
src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>

@endsection
@section('css')
    <style>
        .chart-container{
            width: 100%;
            max-width: 1024px;
            height: 100%;
            max-height: 600px;
            position: relative;
            display: flex;
            margin-right:-120px;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="app-widget-tile app-widget-tile-primary app-widget-gradient">
                <div class="line">
                    <div class="title">{{translate('projectos')}}</div>
                    <div class="subtitle pull-right text-success"><span class="fa fa-arrow-up"></span></div>
                </div>
                <div class="intval intval-lg">{{$project->all_projects}}</div>
                <div class="line">
                    <div class="subtitle">{{$project->all_projects ==0 ? translate('sem_projecto_em_postaward') : translate('projecto_em_postaward')}}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="app-widget-tile app-widget-tile-primary app-widget-gradient">
                <div class="line">
                    <div class="title">{{translate('propostas')}}</div>
                    <div class="subtitle pull-right text-success"><span class="fa fa-arrow-up"></span></div>
                </div>
                <div class="intval intval-lg">{{$project->propostas}}</div>
                <div class="line">
                    <div class="subtitle">{{translate('propostas_em_postaward')}}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="app-widget-tile app-widget-tile-primary app-widget-gradient">
                <div class="line">
                    <div class="title">{{translate('utilizadores_registados')}}</div>
                    <div class="subtitle pull-right text-success"><span class="fa fa-arrow-up"></span></div>
                </div>
                <div class="intval intval-lg">{{$users->all_users}}</div>
                <div class="line">
                    <div class="subtitle">{{translate('utilizadores_activos')}}: {{$users->active}} </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="app-widget-tile app-widget-tile-primary app-widget-gradient">
                <div class="line">
                    <div class="title">{{translate('artigos')}}</div>
                    <div class="subtitle pull-right text-success"><span class="fa fa-arrow-up"></span></div>
                </div>
                <div class="intval intval-lg">{{$article->article_active}}</div>
                <div class="line">
                    <div class="subtitle">{{translate('artigos_publicados_website')}}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="row">
            <div class="col-md-6">
                <div class="block">

                    <div class="chart-container">

                        <canvas id="projeto_submetido_doughnut" style=""></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="block">

                    <div class="chart-container">

                        <canvas id="pre_award_taxa_de_sucesso" style=""></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            {{-- <div class="app-heading app-heading-small">

                <div class="heading-elements">
                    <button type="button" class="btn btn-default btn-icon-fixed dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="icon-calendar-full"></span> Escolha o periódo.
                    </button>
                    <ul class="dropdown-menu dropdown-form dropdown-left">
                        <li>
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group margin-bottom-10">
                                        <label>De:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><span class="icon-calendar-full"></span></div>
                                            <input type="text" class="form-control bs-datepicker" value="2012-10-10" id="data_inicio">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>para:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><span class="icon-calendar-full"></span></div>
                                            <input type="text" class="form-control bs-datepicker" value="2010-10-11" id="data_final">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <button type="button" id="" onclick="getChartData()" class="btn btn-primary btn-block">Confirmar</button>
                        </li>
                    </ul>
                </div>
            </div> --}}

            <div class="chart-container">
                <canvas id="projeto_submetido_chart"></canvas>
            </div>
        </div>

    </div>

        {{-- <div class="col-md-12">

            <div class="table-responsive">
                <table class="table table-head-light table-striped">
                    <thead>
                        <tr>
                            <th width="100">Ãrea de pesquisa</th>
                            <th width="100">Nome interno</th>
                            <th width="200">PI</th>
                            <th width="150">PI BACK-Up</th>
                            <th width="100">Início do recrutamento</th>
                            <th width="100">Previsão do fim do recrutamento</th>
                            <th width="150">Local de recolha de dados</th>
                            <th width="200">Pop. Alvo: principal intervenção</th>
                            <th width="150">Ponto de situação actual</th>
                            <th width="120"></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div> --}}


    {{-- <div class="row">
        <div class="col-md-6">
            <div class="block">
                <div class="app-heading app-heading-small">
                    <div class="title">
                        <h3>Detalhes do projecto</h3>

                    </div>
                </div>
                <table class="table table-noborder">
                    <tr>
                        <td width="100"><strong></strong></td>
                        <td><span class="sparkline" sparkType="pie" sparkWidth="100" sparkHeight="100" >{{$project->propostas}},{{$project->projects_submitted}},{{$project->project_active}},{{$project->project_rejected}}</span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div> --}}
@endsection

@section("scripts")
<script src="{{asset('assets/js/cism/report/chart_projetos.js')}}"></script>
<script>

    $(document).ready(function(){
        getChartPie();
        getTaxaSucessoPreawardChart();
        $.ajax({
            url: '{{url("admin/dashboard/getContext?id=1")}}',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            async: true,
            success: function (response) {
                drawBarChart(response.x_values, response.y_values, 'projeto_submetido_chart', response.total, '{{translate("postaward_projectos_activos")}}');
            },
            error: function(){

            }
        });

    });



    function getChartData(){
        let data_inicio = document.getElementById('data_inicio').value;
        let data_final = document.getElementById('data_final').value;
        $.ajax({
            url: '{{url("admin/report?id=11")}}&data_inicio='+data_inicio+'&data_final='+data_final,
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            async: true,
            success: function (response) {
                drawBarChart(response.x_values, response.y_values, 'projeto_submetido_chart', response.total, '{{translate("numero_projectos_submetidos")}}');
            },
            error: function(){

            }
        });
    }

    function getChartPie(){
        $.ajax({
            url: '{{url("admin/dashboard/getContext?id=2")}}',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            async: true,
            success: function (response) {
                // console.log(response.y_values);
                drawPieChart(response.x_values, response.y_values, 'projeto_submetido_doughnut', response.total);
            },
            error: function(){

            }
        });
    }
    function getTaxaSucessoPreawardChart(){
        $.ajax({
            url: '{{url("admin/dashboard/getContext?id=3")}}',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            async: true,
            success: function(response){
                console.log(response);
                drawBarChart(response.x_values, response.y_values, 'pre_award_taxa_de_sucesso', response.total, '{{translate("preaward_taxa_sucesso")}}')
            }
        })
    }


</script>
@endsection
