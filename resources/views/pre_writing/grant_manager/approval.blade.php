@extends('layout.template')
@section('user_role', session('role_name'))
@section('user_name', session('user_name'))
@section('page_title', translate('submissao_financiamento_projecto'))
@section('page_name', translate('start_page'))
@section('page_title_', 'Pre award ')
@section('page_title_active', 'Early Integration')  

@section('content')

@if(!empty($project))

    <div class="row">
        <div class="block block-condensed">
            <div class="app-heading">
                <div class="title">
                    <h2>{{translate('gestao_projecto')}}</h2>
                    <p>{{$project->p_name}}</p>
                </div>
                <div class="text-right">
                    <button onclick="window.history.back();"  class="btn btn-success"><span class="fa fa-arrow-left"></span> {{translate('voltar')}}</button>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block block-condensed">

                <div class="block-content">
                    <div class="form-group">
                        <label class="control-label">{{translate('description')}}</label>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" cols="4" rows="10" disabled>{{$project->p_description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Timeline</label>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="fa fa-calendar"></span>
                            </div>
                            <input
                                readonly
                                type="text"
                                class="form-control daterange"
                                value="  {{ empty($project->time_line)? 'Timeline não definida':date_format(date_create($project->time_line->tp_start_at),"m/d/Y")  . ' - ' . date_format(date_create($project->time_line->tp_end_date), "m/d/Y")}}"
                            >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">{{translate('lista_grupo_trabalho')}}</label>
                    </div>
                    <div class="form-group">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="text-center"><strong> {{ empty($project->work_group_project)?'':$project->work_group_project->wgp_name }}</strong></th>
                                    </tr>
                                    <tr>
                                        <th>{{translate('nome')}}</th>
                                        <th>{{translate('cargo')}}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                     @if(!empty($project->work_group_project->work_group_member))
                                        @foreach($project->work_group_project->work_group_member as $work_group_member)
                                            <tr>
                                                <td>{{$work_group_member->wgm_name}}</td>
                                                <td>
                                                    @foreach ($work_group_member->member_roles as $member_role)
                                                        @foreach ($member_role->member_role as $member)
                                                            <ul>
                                                                <li>{{$member->wgr_name}}</li>
                                                            </ul>

                                                        @endforeach
                                                    @endforeach
                                                </td>
                                            </tr>

                                        @endforeach
                                     @else
                                         <div class="row">
                                             <div class="col-sm-12">
                                                 <img src="{{asset('img/ilustrator/no_data.svg')}}" style="width: 200px;height: 200px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                                 <p class="text-center"><strong>{{translate('grupo_trabalho_nao_definido')}}</strong></p>
                                             </div>
                                         </div>
                                     @endif

{{--                                    @endforeach--}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
                    <!-- START PAGE CONTAINER -->
                    {{-- <div class="container container-boxed"> --}}

                        <div class="row">
                            {{-- <div class="col-md-8"> --}}

                                <!-- RECENT ACTIVITY -->
                                <div class="block block-condensed">
                                    <div class="app-heading app-heading-small">
                                        <div class="title">
                                            <h2>{{translate('mais_detalhes')}}</h2>
                                        </div>
                                    </div>

                                    <div class="block-divider-text"> </div>
                                    <div class="block-content">
                                        <div class="listing margin-bottom-0">
                                            <div class="listing-item listing-item-with-icon">
                                                <span class="icon-user listing-item-icon"></span>
                                                <h4 class="text-rg text-bold">{{translate('autor_detalhes')}}<span class="text-muted pull-right"> <span class="icon"></span></span></h4>
                                                <div class="list-group list-group-inline">
                                                    <div class="list-group-item col-md-4 col-sm-4">
                                                        <span class="text-bold">{{translate('autor')}}</span><br>
                                                        <span class="text-muted">{{ $project->user_project->staff->s_name }}</span>
                                                    </div>
                                                    <div class="list-group-item col-md-4 col-sm-4">
                                                        <span class="text-bold">{{translate('data_submissao')}}</span><br>
                                                        <span class="text-muted">{{ $project->p_submitted_at}}</span>
                                                    </div>
                                                    <div class="list-group-item col-md-4 col-sm-4">
                                                        <span class="text-bold">{{translate('data_aprovacao')}}</span><br>
                                                        <span class="text-muted text-danger">{{ !empty($data_aprovacao)?$data_aprovacao->updated_at:""}}</span> 
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="listing-item listing-item-with-icon">
                                                <span class="icon-file-add listing-item-icon text-success"></span>
                                                <h4 class="text-rg text-bold"><span class="text-muted pull-right"><span class=""></span></span></h4>
                                                <div class="list-group list-group-inline margin-bottom-0">
                                                    <div class="list-group-item col-md-4 col-sm-4">
                                                        <span class="text-bold">{{translate('proposta_financeira')}}</span><br>
                                                        <span class="text-muted">{{ $project->p_source}}</span>
                                                    </div>
                                                    <div class="list-group-item col-md-4 col-sm-4">
                                                        <span class="text-bold">{{translate('financiamento_necessario')}}</span><br>
                                                        <span class="text-muted text-danger">{{ number_format($project->p_budget, 2, '.', ',') . ' '.$project->p_currency}}</span>
                                                    </div>
                                                    <div class="list-group-item col-md-4 col-sm-4">
                                                        <span class="text-bold">{{translate('document_support')}}</span><br>
                                                        <span class="text-muted"><a href="{{ asset('docs/' . $project->p_support_document) }}" class="" target="_blank"><span class="icon-download">doc.</span></a></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="listing-item listing-item-with-icon">
                                                <span class="icon-file-add listing-item-icon text-success"></span>
                                                <h4 class="text-rg text-bold"><span class="text-muted pull-right"><span class=""></span></span></h4>
                                                <div class="list-group list-group-inline margin-bottom-0">
                                                    @if(!empty($project->documentsProject))
                                                    @foreach($project->documentsProject as $document)
                                                        <div class="list-group-item col-md-6 col-sm-6">
                                                            <span class="text-bold">{{translate('tipo_documento')}}: <span class="label label-success label-bordered" >{{$document->document_type->dt_name}}</span> </span><br>
                                                            <span class=""><a href="{{ asset('docs/' . $document->dp_local_path) }}" class="" target="_blank"><span class="icon-printer"></span></a> {{$document->dp_name}}</span>
                                                        </div>
                                                    @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END RECENT -->

                                <div class="block block-condensed">
                                    @if($project->psm_id == 4 || $project->psm_id == 5)
                                        <div class="app-heading">
                                            <div class="title">
                                                <h3> <span class="icon-thumbs-up"> {{ translate("proposta_preparacao_interna") }} </span> </h3>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="col-md-2 ">
                                                <img src="{{asset('img/ilustrator/submitted.png')}}" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                                {{-- <p class="text-center">Nenhum projeto foi submetido.</p> --}}
                                            </div>
                                        </div>
                                    @else
                                        <div class="app-heading">
                                            <div class="title">
                                                <h3>{{translate('proposta_financeira')}}</h3>
                                            </div>
                                        </div>

                                        <div class="block-content">
                                            <form action="" id="form_submit_core_development" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="p_id" value="{{base64_encode($project->p_id)}}">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">{{translate('document_support')}}</label>
                                                        <div class="col-md-8">
                                                            <input class="form-control input-sm" name="support_document" type="file" accept="file_extension/.docx, .doc, .pdf" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">{{translate('orcamento_geral')}}</label>
                                                        <div class="col-md-6">
                                                            <input class="form-control input-sm" style="text-align: right" id="orcamento" name="orcamento_geral" value="{{$project->p_general_budget}}" type="text" required>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label for="" class="label-control">{{$project->p_currency}}</label>
                                                        </div>
                                                    </div>
                                                    <div class="text-right">
                                                        <button type="submit" class="btn btn-primary" id="btn_submit">{{translate('adicionar')}}</button>
                                                    </div>

                                                </div>

                                            </form>
                                        </div>
                                    @endif

                                </div>

                            {{-- </div> --}}
                        </div>

                    {{-- </div> --}}
                    <!-- END PAGE CONTAINER -->
        </div>
    </div>


    @endif

    @endsection
@section('scripts')

<script>
    $("#orcamento").maskMoney();
</script>
<script>
    let post_form_submit_core_development = "{{route('configs_manager.store')}}";

    var membro_id,role_id;
    var investigators= {!! $investigators !!};
    var role_groups= {!! $role_groups !!};
    var index=parseInt( "{!! empty($project->work_group_project)? 0:count($project->work_group_project->work_group_member) !!}");

    var rows=[];
    var status='';
    $(document).ready(function() {

        $('#btn_submit').on('click', function() {
            var $this = $(this);
            // $(this).prop('disabled', true);
            var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> {{translate("loading")}} ';
            if ($(this).html() !== loadingText) {
                $this.data('original-text', $(this).html());
                $this.html(loadingText);
                }
                setTimeout(function() {
                $this.html($this.data('original-text'));
            }, 7200);
        });

        $(".select2").select2();

        $(".select2-limiting").select2({ 
            maximumSelectionLength: 2
        });
        var pre_rows=document.getElementById("member_table").rows;
        for (var i=0; i<pre_rows.length; i++){
            rows.push(pre_rows[i]);
        }
        // console.log(document.getElementById("member_table").rows[0])
        $('#carregamento').css("display", "none");
    });
    function onchangeDate() {
        document.getElementById("data_fim").min=document.getElementById("data_inicio").value;
    }
    function remove_row(index){
        rows.splice(index, 1);
        load_table();
    }

    var investigators= {!! $investigators !!};
    var role_groups= {!! $role_groups !!};
    var index=0;
    var rows=[];

    const button = document.querySelector('input');

    button.addEventListener('click', disableButton);

    function disableButton() {
        button.disabled = true;
        button.value = 'Disabled';
        window.setTimeout(function() {
            button.disabled = false;
            button.value = 'Enabled';
        }, 2000);
    }
    $("form#form_submit_core_development").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: post_form_submit_core_development,
            dataType: 'json',
            type: 'POST',
            data: formData,
            beforeSend: function () {
                $("#btn_submit").prop('disabled', true);
                $('#carregamento').css("display", "block");
            },
            complete: function () {
                $('#carregamento').css("display", "none");
            },
            error: function () {
                swal({
                    title: "erro",
                    text: "{{translate('erro')}}",
                    icon: "error",
                    button: "{{translate('confirmar')}}"
                });
                $('#carregamento').css("display", "none");

                return false;
            },
            success: function (data) {
                // alert(data);
                if (data.state==200) {
                    swal({
                        title: "{{translate('sucesso')}}",
                        text: '{{translate("financiamento_proposta_aprovada")}}',
                        icon: "success",
                        button: "{{translate('confirmar')}}"
                    }).then(function () {
                        location.reload();
                    })
                } else {
                    swal({
                        title: "Erro!",
                        text: '{{translate("erro")}}',
                        icon: "error",
                        button: "{{translate('confirmar')}}"
                    });
                }
                return false;

            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
</script>



{{--    <script type="text/javascript" src=" {{asset('assets/js/jquery.smartWizard.js')}} "></script>--}}

@endsection
@section('scripts')
<script>
    let post_form_submit_core_development = "{{route('configs_manager.store')}}";

    var membro_id,role_id;
    var investigators= {!! $investigators !!};
    var role_groups= {!! $role_groups !!};
    var index=parseInt( "{!! empty($project->work_group_project)? 0:count($project->work_group_project->work_group_member) !!}");

    var rows=[];
    var status='';
    $(document).ready(function() {
        $(".select2").select2();

        $(".select2-limiting").select2({
            maximumSelectionLength: 2
        });
        var pre_rows=document.getElementById("member_table").rows;
        for (var i=0; i<pre_rows.length; i++){
            rows.push(pre_rows[i]);
        }
        // console.log(document.getElementById("member_table").rows[0])
        $('#carregamento').css("display", "none");
    });
    function onchangeDate() {
        document.getElementById("data_fim").min=document.getElementById("data_inicio").value;
    }
    function remove_row(index){
        rows.splice(index, 1);
        load_table();
    }

    var investigators= {!! $investigators !!};
    var role_groups= {!! $role_groups !!};
    var index=0;
    var rows=[];
    
    const button = document.querySelector('input');

    button.addEventListener('click', disableButton);

    function disableButton() {
        button.disabled = true;
        button.value = 'Disabled';
        window.setTimeout(function() {
            button.disabled = false;
            button.value = 'Enabled';
        }, 2000);
    }
    $("form#form_submit_core_development").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: post_form_submit_core_development,
            dataType: 'json',
            type: 'POST',
            data: formData,
            beforeSend: function () {
                $('#carregamento').css("display", "block");
            },
            complete: function () {
                $('#carregamento').css("display", "none");
            },
            error: function () {
                swal({
                    title: "erro",
                    text: "Houve um erro",
                    icon: "error",
                    button: "Confirmar"
                });
                $('#carregamento').css("display", "none");

                return false;
            },
            success: function (data) {
                // alert(data);
                if (data.state==200) {
                    swal({
                        title: "Sucesso",
                        text: data.message,
                        icon: "success",
                        button: "Confirmar"
                    }).then(function () {

                    })
                } else {
                    swal({
                        title: "Erro!",
                        text: data.message,
                        icon: "error",
                        button: "Confirmar"
                    });
                }
                return false;

            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
</script>



{{--    <script type="text/javascript" src=" {{asset('assets/js/jquery.smartWizard.js')}} "></script>--}}

@endsection


