@extends('layout.template')
@section("css")
<style>
    html, .chart-view, .area-cientifica{
        width: 100%;
        height: 450px;
        margin: 0;
        padding: 0;
    }
    .area-cientifica{
        height: 700px;
        margin: 0;
    }
</style> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
@endsection
@section('scripts_head')
<meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection

@section('page_title', translate('relatorios'))
@section('title_description', translate('ponto_situacao_projectos'))
{{-- @section('page_name', 'Pre Award') --}}
@section('page_title_', 'App')
@section('page_title_active', translate('relatorios'))
@section('user_role', session('role_name'))
@section('user_name', session('user_name'))

@section('content')
<div class="block block-condensed" >
    <!-- START HEADING -->
    <div class="app-heading app-heading-small">
        <div class="title">
            {{-- <h5>Relatórios</h5> --}}
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="btn-group">
                    <select name="report_id" id="configuration_id" class="bs-select" title="{{translate('tipo_configuracao')}}">
                        <option value="1">{{translate('numero_tentativas_login')}}</option>
                        <option value="2">{{translate('recipient')}}</option>
                        <option value="3">{{translate('intituicao')}}</option>
                        <option value="4">{{translate('autores_cism')}}</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- END HEADING -->
    <div class="block-content" style="height: 700px;">
        <div class="block block-condesend chart-view" id="first_configuration" hidden>

                <form action="{{route("configuration.login")}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="row">
                     <div class="col-md-6">
                         <div class="input-group">
                             <span class="input-group-addon">{{translate("tempo_espera")}}</span>
                             <input type="number" value="{{\App\Models\Configuration::getConfigurationType('decayMinutes')}}" id="decay_minutes" name="decay_minutes" class="form-control" placeholder="{{translate('digite_nr_tempo_espera')}}">
                         </div>
                     </div>
                     <div class="col-md-6">
                         <div class="input-group">
                            <span class="input-group-addon">{{translate('tentativa_autenticacao')}}</span>
                             <input id="login_attemps" name="login_attemps" type="number" value="{{\App\Models\Configuration::getConfigurationType('maxAttempts')}}" class="form-control" placeholder="{{translate('digite_nr_max_attemps')}}">
     
                             <span class="input-group-btn">
                                 <button class="btn btn-primary" type="submit">{{translate('actualizar')}}</button>
                             </span>
                         </div>
                     </div>
                    </div>
                </form>

        </div>

        <div class="block" id="div_registo_recipient" hidden>
            <div class="app-heading app-heading-small">                                
                <div class="title">
                    <h2>{{translate("registo_recipient")}}</h2>
                    {{-- <p>Place one add-on or button on either side of an input.</p> --}}
                </div>     
                <div class=" text-right">
                
                    <button
                        data-toggle="modal"
                        data-target="#modal-info"
                        class="btn btn-primary">
                    <span class="fa fa-floppy-o"> </span>
                    {{translate('registo_recipient')}}
                </button>                
                </div>                           
            </div>
            <div class="block-content">
                @if(count($recipients) > 0)
                <div class="block-content">
                    <div class="col-md-8">

                    </div>
                    <div class="table-responsive">
    
                        <table class="table table-striped table-bordered datatable-extended">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{translate('nome')}}</th>
                                    <th>{{translate('data_registo')}}</th>
                                    <th>{{translate('accoes')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recipients as $key => $recipient)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$recipient->r_name}}</td>
                                        <td>{{$recipient->created_at}}</td>
                                        <td>
                                            @if ($recipient->r_state == 1)
                                                <a 
                                                    href="#"
                                                    data-href="{{route('recipient.alter_state', base64_encode($recipient->r_id))}}"
                                                    data-toggle="modal"
                                                    data-target="#confirm-update-recipient"
                                                    class="btn btn-danger"
                                                    >
                                                    <span class="fa fa-user-times" ></span>
                                                </a>
                                            @else
                                                <a 
                                                    href="#"
                                                    data-href="{{route('recipient.alter_state', base64_encode($recipient->r_id))}}"
                                                    data-toggle="modal"
                                                    data-target="#modal-confirm-activate"
                                                    class="btn btn-success"
                                                    >
                                                    <span class="fa fa-undo"></span>
                                                </a>
                                            
                                            @endif                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
    
            @else
                <div class="row">
                    <div class="col-sm-12">
                        <img src="{{asset('img/ilustrator/no_data.svg')}}"
                            class="img-responsive center-block d-block mx-auto"
                            height="75px"
                            width="75px"
                        >
                        <p class="text-center"> <strong> {{translate('no_record')}}</strong></p>
                    </div>
                </div>
            @endif                
            </div>
        </div>


        <div class="block" id="div_registo_organization" hidden>
            <div class="app-heading app-heading-small">                                
                <div class="title">
                    <h2>{{translate("nova_instituicao")}}</h2>
                    {{-- <p>Place one add-on or button on either side of an input.</p> --}}
                </div>     
                <div class=" text-right">
                
                    <button
                        data-toggle="modal"
                        data-target="#modal-new-organization"
                        class="btn btn-primary">
                    <span class="fa fa-floppy-o"> </span>
                    {{translate('nova_instituicao')}}
                </button>                
                </div>                           
            </div>
            <div class="block-content">
                @if(count($organizations) > 0)
                <div class="block-content">
                    <div class="col-md-8">

                    </div>
                    <div class="table-responsive">
    
                        <table class="table table-striped table-bordered datatable-extended">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{translate('nome')}}</th>
                                    <th>{{translate('estado')}}</th>
                                    <th>{{translate('data_registo')}}</th>
                                    <th>{{translate('accoes')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($organizations as $key => $organization)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$organization->ui_description}}</td>
                                        <td>
                                            @if($organization->ui_state == 1)
                                            <label class="label label-info" >{{translate('activo')}}</label>
                                            @else   
                                            <label class="label label-warning" >{{translate('inactivo')}}</label>
                                            @endif
                                        </td>
                                        <td>{{$organization->created_at}}</td>
                                        <td>
                                            @if ($organization->ui_state == 1)
                                                <a 
                                                    href="#"
                                                    data-href="{{route('user_organization.alter_state', base64_encode($organization->ui_id))}}"
                                                    data-toggle="modal"
                                                    data-target="#confirm-update-organization"
                                                    class="btn btn-danger"
                                                    >
                                                    <span class="fa fa-user-times" ></span>
                                                </a>
                                            @else
                                                <a 
                                                    href="#"
                                                    data-href="{{route('user_organization.alter_state', base64_encode($organization->ui_id))}}"
                                                    data-toggle="modal"
                                                    data-target="#confirm-update-organization"
                                                    class="btn btn-success"
                                                    >
                                                    <span class="fa fa-undo"></span>
                                                </a>
                                            
                                            @endif                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
    
            @else
                <div class="row">
                    <div class="col-sm-12">
                        <img src="{{asset('img/ilustrator/no_data.svg')}}"
                            class="img-responsive center-block d-block mx-auto"
                            height="75px"
                            width="75px"
                        >
                        <p class="text-center"> <strong> {{translate('no_record')}}</strong></p>
                    </div>
                </div>
            @endif                
            </div>
        </div>


        <div class="block" id="div_registo_autor_cism" hidden>
            <div class="app-heading app-heading-small">                                
                <div class="title">
                    <h2>{{translate("novo_autor")}}</h2>
                    {{-- <p>Place one add-on or button on either side of an input.</p> --}}
                </div>     
                <div class=" text-right">
                
                    <button
                        data-toggle="modal"
                        data-target="#modal-new-autor_cism"
                        class="btn btn-primary">
                    <span class="fa fa-floppy-o"> </span>
                    {{translate('novo_autor')}}
                </button>                
                </div>                           
            </div>
            <div class="block-content">
                @if(count($cism_authors) > 0)
                <div class="block-content">
                    <div class="col-md-8">

                    </div>
                    <div class="table-responsive">
    
                        <table class="table table-striped table-bordered datatable-extended">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{translate('nome')}}</th>
                                    <th>{{translate('estado')}}</th>
                                    <th>{{translate('data_registo')}}</th>
                                    <th>{{translate('accoes')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cism_authors as $key => $author)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$author->ca_name}}</td>
                                        <td>
                                            @if($author->ca_state == 1)
                                            <label class="label label-info" >{{translate('activo')}}</label>
                                            @else   
                                            <label class="label label-warning" >{{translate('inactivo')}}</label>
                                            @endif
                                        </td>
                                        <td>{{$author->created_at}}</td>
                                        <td>
                                            @if ($author->ca_state == 1)
                                                <a 
                                                    href="#"
                                                    data-href="{{route('configuration.cism_update', base64_encode($author->ca_id))}}"
                                                    data-toggle="modal"
                                                    data-target="#confirm-update-author"
                                                    class="btn btn-danger"
                                                    >
                                                    <span class="fa fa-user-times" ></span>
                                                </a>
                                            @else
                                                <a 
                                                    href="#"
                                                    data-href="{{route('configuration.cism_update', base64_encode($author->ca_id))}}"
                                                    data-toggle="modal"
                                                    data-target="#confirm-update-author"
                                                    class="btn btn-success"
                                                    >
                                                    <span class="fa fa-undo"></span>
                                                </a>
                                            
                                            @endif                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
    
            @else
                <div class="row">
                    <div class="col-sm-12">
                        <img src="{{asset('img/ilustrator/no_data.svg')}}"
                            class="img-responsive center-block d-block mx-auto"
                            height="75px"
                            width="75px"
                        >
                        <p class="text-center"> <strong> {{translate('no_record')}}</strong></p>
                    </div>
                </div>
            @endif                
            </div>
        </div>

    </div>

</div>
@include('admin.config.modals');

@endsection

@section("scripts")
<script type="text/javascript">
    function closeAllDiv(){
        $("#first_configuration").hide();
        $("#div_registo_recipient").hide();
        $("#div_registo_organization").hide();
        $("#div_registo_autor_cism").hide();
    }

    $('#confirm-update-recipient').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
    $('#modal-confirm-activate').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
    $('#confirm-update-organization').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
    $('#confirm-update-author').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

    $("#configuration_id").on("change", function(){
        var id = $(this).val();
        closeAllDiv();
        switch(id){
            case "1":
                $("#first_configuration").show();
            break;
            case "2":
                $("#div_registo_recipient").show();
            break;
            case "3":
                $("#div_registo_organization").show();
            break;
            case "4":
                $("#div_registo_autor_cism").show();
            break;
        }
    });

</script>
@endsection



