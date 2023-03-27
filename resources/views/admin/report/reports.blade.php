@extends('layout.template')
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
@section('scripts_head')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"> </script>
@endsection
@section('page_title', translate('relatorio'))
{{-- @section('page_name', 'Pre Award') --}}
@section('page_title_', 'App')
@section('page_title_active', translate('relatorio'))
@section('user_role', session('role_name'))
@section('user_name', session('user_name'))

@section('content')
<div class="block block-condensed" > 
    <!-- START HEADING -->
    <div class="app-heading app-heading-small">
        <div class="title">
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="btn-group"> 
                    <select name="report_id" id="report_id" class="bs-select" title="{{translate('tipo_relatorio')}}">
                        <option value="1">{{translate('evolucao_projetos_activos')}}</option>
                        <option value="2">{{translate('producao_cientifica_area')}}</option>
                        <option value="3"><strong>PRE-AWARD:</strong>  {{translate('taxa_sucesso_propostas')}}</option>
                        <option value="4">{{translate('resultado_monitoria')}}</option>
                        <option value="5">{{translate('producao_cientifica_area_artigo')}}</option>
                        <option value="6">{{translate('relatorio_implementacao_estudo')}}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <label for="" class="col-md-4 control-label">{{translate('data_inicial_')}}</label>
                <div class="col-md-8">
                    <input type="date" class="form-control" value="" id="start_date">
                </div>
            </div>
            <div class="col-md-4">
                <label for="" class="col-md-4 control-label">{{translate('data_final')}}</label>
                <div class="col-md-8">
                    <input type="date" class="form-control" value="" id="final_date">
                </div>
            </div>

        </div>
        <div class="col-sm-12 text-center" style="margin-top: 24px;">
            <button class="btn btn-primary btn-rounded"  id="btn_buscar">{{translate('buscar')}}</button>
        </div>
    </div>

    <!-- END HEADING -->
    <div class="block-content" style="height: 700px;">
        <div class="row" id="report-1" hidden>
            <div class="col-md-5">
                <div class="block">

                    <div class="chart-container">

                        <canvas id="evolucao_projeto_activo" style=""></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="block">
                    <div class="chart-container">
                        <div class="table-responsive">
                            <table id="evolucao_projeto_activo_tabela" class="table table-striped dataTable-extended">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{translate('area_pesquisa')}}</th>
                                        <th>{{translate('nome_interno')}}</th>
                                        <th>{{translate('acronym')}}</th>
                                        <th>{{translate('ponto_situacao')}}</th>
                                        <th>{{translate("detalhes")}}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="text-center" id="btn_export_table">
                        <a class="btn btn-success" href="#" onClick ="$('#evolucao_projeto_activo_tabela').tableExport({type:'excel',escape:'false'});"><img src='{{asset('img/icons/xls.png')}}' width="24"> {{translate('exportar')}}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="report-2" hidden>
            <div class="col-md-6">
                <div class="block">

                    <div class="chart-container">

                        <canvas id="producao_cientifica" style=""></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="block">
                    <div class="chart-container">
                        <div class="table-responsive">
                            <table id="producao_cientifica_tabela" class="table table-striped dataTable-extended">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{translate('area_pesquisa')}}</th>
                                        <th>{{translate('acronym')}}</th>
                                        <th>PI</th>
                                        <th>{{translate('ponto_situacao')}}</th>
                                        <th>{{translate('detalhes')}}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="text-center" id="btn_export_table">
                        <a class="btn btn-success" href="#" onClick ="$('#producao_cientifica_tabela').tableExport({type:'excel',escape:'false'});"><img src='{{asset('img/icons/xls.png')}}' width="24"> {{translate('exportar')}}</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="block">

                    <div class="chart-container">

                        <canvas id="producao_cientifica_pie_chart" style=""></canvas>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="row" id="report-3" hidden>
            <div class="col-md-5">
                <div class="block">

                    <div class="chart-container">

                        <canvas id="taxa_sucesso_proposta" style=""></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="block">
                    <div class="chart-container">
                        <div class="table-responsive">
                            <table id="taxa_sucesso_proposta_tabela" class="table table-striped dataTable-extended">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{translate('area_pesquisa')}}</th>
                                        <th>{{translate('acronym')}}</th>
                                        <th>PI</th>
                                        <th>{{translate('estado_aprovacao')}}</th> 
                                        <th>{{translate('detalhes')}}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="text-center" id="btn_export_table">
                        <a class="btn btn-success" href="#" onClick ="$('#taxa_sucesso_proposta_tabela').tableExport({type:'excel',escape:'false'});"><img src='{{asset('img/icons/xls.png')}}' width="24"> {{translate('exportar')}}</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row"  id="report-4" hidden>
            <div class="row">
                <div class="col-md-6">
                    <div class="block">
    
                        <div class="chart-container">
                            <canvas id="resultado_monitoria_pie_chart" style=""></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="block">
                        <div class="chart-container">
                            <canvas id="monitoria_estudo_chart_bar" style=""></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="block">
                    <div class="chart-container">
                        <div class="table-responsive">
                            <table id="resultado_monitoria_tbl" class="table table-striped dataTable-extended">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{translate('area_pesquisa')}}</th>
                                        <th>{{translate('acronym')}}</th>
                                        <th>{{translate('nome')}}</th>
                                        <th>PI</th>
                                        <th>{{translate('nao_conformidade')}}</th> 
                                        {{-- <th>{{translate('detalhes')}}</th> --}}
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="text-center" id="btn_export_table">
                        <a class="btn btn-success" href="#" onClick ="$('#resultado_monitoria_tbl').tableExport({type:'excel',escape:'false'});"><img src='{{asset('img/icons/xls.png')}}' width="24"> {{translate('exportar')}}</a>
                    </div>
                </div>            
            </div>
        </div>
        <div class="row"  id="report-5" hidden>
            <div class="row">
                <div class="col-md-6">
                    <div class="block">
                        <div class="chart-container">
                            <canvas id="artigos_chart_bar" style=""></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="block">
                        <div class="table-responsive">
                            <table id="tbl_producao_cientifica" class="table table-striped dataTable-extended">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{translate('autores')}}</th>
                                        <th>{{translate('ano')}}</th>
                                        <th>{{translate('total')}}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row"  id="report-6" hidden>
            <div class="col-sm-12">
                <div class="block-content">
                    <div class="table-responsive">
                        <table id="tbl_projecto_estudo" class="table table-striped dataTable-extended">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{translate('nome')}}</th>
                                    <th>{{translate('acronimo')}}</th>
                                    <th>{{translate('pi')}}</th>
                                    <th>{{translate('resultado_preliminares')}}</th>
                                    <th>{{translate('pop_alvo')}}</th>
                                    <th>{{translate('objectivos')}}</th>
                                    <th>{{translate('financiamento')}}</th>
                                    <th>{{translate('baixar_relatorio')}}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    {{-- <div class="chart-container"> --}}
                    
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section("scripts")
<script src="{{asset('assets/js/cism/report/chart_projetos.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
<script>
    var nr_projectos_activos = '{{translate("numero_projecto_activo")}}';

    function closeAllDiv(){
        $("#report-1").hide();
        $("#report-2").hide();
        $("#report-3").hide();
        $("#report-4").hide();
        $("#report-5").hide();
        $("#report-6").hide();
        $('#taxa_sucesso_proposta_tabela').DataTable().clear().destroy();
        $('#producao_cientifica_tabela').DataTable().clear().destroy();
        $('#evolucao_projeto_activo_tabela').DataTable().clear().destroy();
        $('#resultado_monitoria_tbl').DataTable().clear().destroy();
        $('#tbl_producao_cientifica').DataTable().clear().destroy();
        $('#tbl_artigos').DataTable().clear().destroy();
        $('#tbl_projecto_estudo').DataTable().clear().destroy();
    }

    function producaoCientificaArtigos(id, data_inicio, data_final){
        closeAllDiv();
        $("#report-5").show();
        $.ajax({
            url: '{{url("reports/get")}}?id='+id+'&data_inicio='+data_inicio+'&data_final='+data_final,
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            async: true,
            success: function (response) {
                // console.log(response.article[0].autor);
                
                $('#tbl_producao_cientifica').dataTable({
                    "data": response.article_data,
                    "columns": [
                        {"data": "index"},
                        {"data": "ca_name"},
                        {"data": "ano"},
                        {"data": "total"}
                    ]
                });
                drawBarChart(response.x_values, response.y_values, 'artigos_chart_bar', response.total, "{{translate('producao_cientifica_area_artigo')}}");
            },
            error: function(){
                swal({
                title: '{{translate("alerta")}}',
                text: '{{translate("ocorreu_erro")}}',
                icon: "warning",
                button: '{{translate("confirmar")}}'
            });
            }
        });
    }
    function producaoCientifica(id, data_inicio, data_final){
        closeAllDiv();
        $("#report-2").show();
        $.ajax({
            url: '{{url("reports/get")}}?id='+id+'&data_inicio='+data_inicio+'&data_final='+data_final,
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            async: true,
            success: function (response) {
                
                $('#producao_cientifica_tabela').dataTable({
                    "data": response.data_table,
                    "columns": [
                        {"data": "index"},
                        {"data": "sa_name"},
                        {"data": "pc_acronym"},
                        {"data": "pc_pi"},
                        {"data": "p_actual_state"},
                        {
                            "data": "p_id",
                            "render": function(data){
                                data = '<a href="{{url("web/project/details/")}}'+'/'+data+'" target="_blanck">{{translate("detalhes")}}</a>';
                                return data;
                            }
                        },
                    ],
                    "language": {
                       "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese.json"
                    }
                });
                drawBarChart(response.x_values, response.y_values, 'producao_cientifica', response.total, 'Produção científica por área')
                drawPieChart(response.x_values, response.y_values, 'producao_cientifica_pie_chart', response.total, 'Produção científica por área')
            },
            error: function(){
                alert("ocorreu um erro!!!");
            }
        });
    }

    function evolucaoProjetoAtivo(id, data_inicio, data_final){
        closeAllDiv();
        $("#report-1").show();
        
        $.ajax({
            url: '{{url("reports/get")}}?id='+id+'&data_inicio='+data_inicio+'&data_final='+data_final,
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            async: true,

            success: function (response) {
                $('#evolucao_projeto_activo_tabela').dataTable({
                    "data": response.data,
                    "columns": [
                        {"data": "index"},
                        {"data": "area_pesquisa"},
                        {"data": "p_name"},
                        {"data": "pc_acronym"},
                        {"data": "p_actual_state"},
                        {
                            "data": "p_id",
                            "render": function(data){
                                data = '<a href="{{url("web/project/details/")}}'+'/'+data+'" target="_blanck">{{translate("detalhes")}}</a>';
                                return data;
                            }
                        },
                    ],
                    "language": {
                       "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese.json"
                    }
                });
                drawPieChart(response.x_values, response.y_values, 'evolucao_projeto_activo', response.total, nr_projectos_activos);
            },
            error: function(e){
                swal({
                    title: '{{translate("ocorreu_erro")}}',
                    text: e,
                    icon: "error",
                    button: '{{translate("confirmar")}}'
            });
            }
        });
    }

    function taxaSucessoPropostas(id, data_inicio, data_final){
        closeAllDiv();
        $("#report-3").show();
        $.ajax({
            url: '{{url("reports/get")}}?id='+id+'&data_inicio='+data_inicio+'&data_final='+data_final,
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            async: true,
            success: function (response) {
                $('#taxa_sucesso_proposta_tabela').dataTable({
                    "data": response.data_table,
                    "columns": [
                        {"data": "index"},
                        {"data": "sa_name"},
                        {"data": "p_name"},
                        {"data": "pi"},
                        {"data": "state"},
                        {
                            "data": "p_id",
                            "render": function(data){
                                data = '<a href="{{url("web/proposal/details/")}}'+'/'+data+'" target="_blanck">{{translate("baixar")}}</a>';
                                return data;
                            }
                        },
                    ],
                    "language": {
                       "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese.json"
                    }
                });
                drawBarChart(response.x_values, response.y_values, 'taxa_sucesso_proposta', response.total, '{{translate("taxa_sucesso_propostas_submetidas")}}');
            },
            error: function(){

            }
        });
    }
    function resultadosMonitoria(id, data_inicio, data_final){
        closeAllDiv();
        $("#report-4").show();
        $.ajax({
            url: '{{url("reports/get")}}?id='+id+'&data_inicio='+data_inicio+'&data_final='+data_final,
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            async: true,
            success: function (response) {
                // console.log(response);
                $('#resultado_monitoria_tbl').dataTable({
                    "data": response.data_table,
                    "columns": [
                        {"data": "index"},
                        {"data": "sa_name"},
                        {"data": "acronimo"},
                        {"data": "p_name"},
                        // {"data": "pc_acronym"},
                        {"data": "pi"},
                        {"data": "c_name"},
                        
                    ],
                    "language": {
                       "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese.json"
                    }
                });

                drawPieChart(response.x_values, response.y_values, 'resultado_monitoria_pie_chart', response.total, '{{translate("resultado_monitoria")}}');
                drawBarChart(response.x_values, response.y_values, 'monitoria_estudo_chart_bar', response.total, '{{translate("resultado_monitoria")}}');
            },
            error: function(){

            }
        });
    }
    
    
    function pontoSituacaoImplementacaoEstudo (id, data_inicio, data_final){
        closeAllDiv();
         
        $.ajax({
            url: '{{url("reports/get")}}?id='+id+'&data_inicio='+data_inicio+'&data_final='+data_final,
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            async: true,
            success: function (response) {
                // console.log(response.result.status);
                if(response.result.status){
                    $("#report-6").show();
                    $('#tbl_projecto_estudo').dataTable({
                        "data": response.data,
                        "columns": [
                            {"data": "index"},
                            {"data": "nome"},
                            {"data": "acronimo"},
                            {"data": "pi"},
                            {"data": "resultado_preliminares"},
                            {"data": "pop_alvo"},
                            {"data": "objectivo"},
                            {"data": "financiamento"},
                            {
                                "data": "pc_id",
                                "render": function(data){
                                    data = '<a href="{{url("reports/study-implementation/report")}}'+'/'+data+'" >{{translate("baixar")}}</a>';
                                    return data;
                                }
                            }
                            
                        ]
                    });
                }else{
                    swal({
                    title: '{{translate("alerta")}}',
                    text: response.result.msg,
                    button: "Ok",
                    icon: '{{translate("warning")}}'
                });
                }
            },
            error: function(){
                swal({
                    title: '{{translate("erro")}}',
                    text: '{{translate("ocorreu_erro")}}',
                    button: '{{translate("confirmar")}}',
                    icon: '{{translate("warning")}}'
                });
            }
        });
    }


    // function buscar_relatorio(e){
    $("#btn_buscar").on("click", function(){
        var id = $("#report_id").val();
        let data_inicio = document.getElementById('start_date').value;
        let data_final = document.getElementById('final_date').value;
        if(data_final == "" || data_inicio==""){
            swal({
                title: '{{translate("alerta")}}',
                text: '{{translate("insira_datas")}}',
                icon: "warning",
                button: '{{translate("confirmar")}}'
            });
        }else{
            switch (id) {
                case "1":
                    evolucaoProjetoAtivo(id, data_inicio, data_final);
                break;
                case "2":
                    producaoCientifica(id, data_inicio, data_final);
                break;
    
                case "3":
                    taxaSucessoPropostas(id, data_inicio, data_final)
                break;
                case "4":
                    resultadosMonitoria(id, data_inicio, data_final)
                break;
                case "5":
                    producaoCientificaArtigos(id, data_inicio, data_final)
                break;
                case "6":
                    pontoSituacaoImplementacaoEstudo(id, data_inicio, data_final)
                break;
                default:
                    swal({
                        title: '{{translate("alerta")}}',
                        text: "{{translate('escolha_tipo_relatorio')}}",
                        icon: "warning",
                        button: '{{translate("confirmar")}}'
                    });                  
            }
        }

    });

    // }

</script>
@endsection



