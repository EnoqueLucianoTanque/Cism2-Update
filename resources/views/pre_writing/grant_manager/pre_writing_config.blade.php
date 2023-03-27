@extends('layout.template')
@section('page_title', 'Estado do projecto')
@section('user_role', session('role_name'))
@section('user_name', session('user_name'))
@section('content')
    <!-- BASIC EXAMPLE -->
    <div class="block block-condensed">
        <div class="app-heading">
            <div class="title">
                <h2>Gestão do projecto</h2>
                <p>{{$project->p_name}}</p>
            </div>
        </div>
        <div class="block-content">

            <div class="wizard">
                <ul>

                    <li>
                        <a href="#step-1">
                            <span class="stepNumber">1</span>
                            <span class="stepDesc">Pre-Writing<br /><small>Grupo de trabalho</small></span>
                        </a>
                    </li>

                    <li>
                        <a href="#step-2">
                            <span class="stepNumber">2</span>
                            <span class="stepDesc">Early Integration<br /><small>Anexar documentos</small></span>
                        </a>
                    </li>


                    <li>
                        <a href="#step-3">
                            <span class="stepNumber">3</span>
                            <span class="stepDesc">Core development<br /><small>Aprovacao do budget</small></span>
                        </a>
                    </li>


                    <li>
                        <a href="#step-4">
                            <span class="stepNumber">4</span>
                            <span class="stepDesc">Finalization<br /><small>Aprovacao final</small></span>
                        </a>
                    </li>
                </ul>

                <div id="step-1">
                    <form action="" id="post_form_work_group">
                        @csrf
                        <input type="hidden" name="project_id" value="{{base64_encode($project->p_id)}}">
                        <input type="hidden" name="max_index" id="max_index" value="0">
                        <h4 class="text-uppercase text-bold text-rg heading-line-middle">&nbsp;<span>Criar grupo de trabalho</span></h4>
                        <div class="row">
                            <div class="col col-lg-12">
                                <div class="title">
                                    {{-- <div class="title"> --}}
                                        <h3 style="margin-left: 24px">Definir o timeline</h3>
                                    {{-- </div> --}}
                                </div>
                                <div class="row">
                                    <div class="form-group">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="membro_selected" class="col-md-2 control-label">Data início do projecto</label>
                                                <div class="col-md-6">
                                                    <div class="input-group bs-datepicker">
                                                        <input  name="data_inicio" type="text"  id="data_inicio" placeholder="Data de inicio" value="{{empty($project->time_line)?null:$project->time_line->tp_start_at}}" onchange="onchangeDate();" class="form-control" >
                                                        <span class="input-group-addon">
                                                            <span class="icon-calendar-full"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="membro_selected" class="col-md-2 control-label">Data de término</label>
                                                <div class="col-md-6">

                                                    <div class="input-group bs-datepicker">
                                                        <input  name="data_fim" type="text"  id="data_fim" placeholder="Data de termino" value="{{empty($project->time_line)?null:$project->time_line->tp_end_date}}" class="form-control " >
                                                        <span class="input-group-addon">
                                                            <span class="icon-calendar-full"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="title">
                                            <h3 style="margin-left: 30px" >Definir Grupo de trabalho</h3>
                                        </div>

                                        <div class="form-group">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    {{-- <div class="col-md-4"> --}}
                                                        <label class="col-md-2 control-label" for="membro_selected">Membro</label>
                                                        <div class="col-md-6">
                                                            <input list="membro_selected" name="membro_selected"  id="membro_id" placeholder="Membros" class="form-control">
                                                            <datalist class="form-control" id="membro_selected">
                                                                @foreach($investigators as $investigator)
                                                                    <option value="{{$investigator->s_name}}">
                                                                @endforeach
                                                            </datalist>
                                                        </div>
                                                    {{-- </div> --}}
                                                </div>
                                            </div>
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Função</label>
                                                    <div class="col-md-6">

                                                        <select class="select2" id="role_id" name="role" multiple >
                                                            @foreach($role_groups as $role_group)
                                                                <option value="{{$role_group->wgr_id}}">{{$role_group->wgr_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div style="display: flex; justify-content: center; flex-direction: row">
                                        <button class="btn btn-primary btn-icon-fixed" onclick="add_group_member();" type="button" >
                                        <i class="fa fa-user"></i> Adicionar a lista</button>
                                    </div>

                                </div>
                            </div>

                            <div class="col col-md-12">
                                <div class="row col-sm-12">
                                    <table class="table table-striped table-bordered datatable-basic">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Função</th>
                                                {{-- <th>Data de registo</th> --}}
                                            {{-- <th>Ação</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody id="member_table">
                                        @if(!empty($project->work_group_project))
                                            @foreach($project->work_group_project->work_group_member as $index=> $member)
                                                <tr>
                                                    <td>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-12 form-group">
                                                                <input list="membro_selected" name="{{"membro_selected_".$index}}"   value="{{$member->staff->s_name}}" placeholder="Membros" class="form-control" readonly>
                                                                <datalist id="membro_selected">
                                                                    @foreach($investigators as $investigator)
                                                                        <option value="{{$investigator->s_name}}">
                                                                    @endforeach
                                                                </datalist>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-6">
                                                                <select class="select2"  name="{{"role_".$index."[]"}}" multiple disabled>
                                                                    @foreach($role_groups as $role_group)
                                                                        <option value="{{$role_group->wgr_id}}"
                                                                        @foreach($member->member_roles as $role)
                                                                            @if($role->wgr_id==$role_group->wgr_id)
                                                                                {{'selected'}}
                                                                                @endif
                                                                        @endforeach

                                                                        >{{$role_group->wgr_name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    {{-- <td>{{$member->updated_at}}</td> --}}
                                                <td><button type="button" class="btn btn-secondary" onclick="remove_row({{(int)$index}});" style="background-color: #7fad39!important; color:white!important;" data-dismiss="modal"><i class="fa fa-remove" style="color: white"></i></button> </td>
                                                </tr>
                                            @endforeach

                                        @endif

                                        </tbody>
                                    </table>
                                </div>

                        </div>

                    </div>
                  </form>
                </div>
                <div id="step-2">
                    <h4 class="text-uppercase text-bold text-rg heading-line-middle">&nbsp;<span>Anexar o Concept Note</span></h4>
                    <div class="row">
                        <div class="col-md-12">
                            <form
                                action="{{ route('insert.other_document') }}"
                                method="POST" class="form-vertical"
                                enctype="multipart/form-data"
                            >
                                @csrf
                                <div class="form-group" >
                                    <label class="col-md-2 control-label">Tipo de documento</label>
                                    {{-- <div class="col-md-10"> --}}
                                        <select class="select2" name="document_type" data-live-search="true">
                                            @foreach ($document_type as $dt)
                                                <option value="{{ base64_encode($dt->dt_id)}}">{{ $dt->dt_name }}</option>
                                            @endforeach
                                            <span class="help-block">Add key words to options to improve their searchability</span>
                                        </select>
                                    {{-- </div> --}}
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Anexar o documento</label>
                                    <input class="form-control" type="file" accept="file_extension/.docx, .doc, .pdf" placeholder="anexar o documento concept note">
                                </div>

                                <div class="form-group" >
                                    <label class="col-md-2 control-label">Referente ao step</label>
                                    <div class="col-md-10">
                                        <select class="select2" name="project_stage_micro" data-live-search="true">
                                            @foreach ($project_stage_micro as $psm)
                                                <option value="{{ base64_encode($psm->psm_id)}}">{{ $psm->psm_name }}</option>
                                            @endforeach
                                            <span class="help-block">Add key words to options to improve their searchability</span>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Anexar outros documentos</label>
                                    <div class="col-md-10">
                                        <input type="hidden" name="p_id" value="{{base64_encode($project->p_id)}}">
                                        <input class="form-control input-sm" name="document" type="file" accept="file_extension/.docx, .doc, .pdf">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Nome</label>
                                    <div class="col-md-10">
                                        <input class="form-control input-sm" name="document_name" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Descrição</label>
                                    <div class="col-md-10">
                                        <input class="form-control input-sm" name="document_description" type="text">
                                    </div>
                                </div>
                                <div class="text-right">
                                    {{-- <label class="col-md-2 control-label">Anexar outros documentos</label> --}}
                                    {{-- <div class="col text-right"> --}}
                                        <button type="submit" class="btn btn-primary">Adicionar</button>
                                    {{-- </div> --}}
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">

                        </div>

                    </div>
                </div>

                <div id="step-3">
                    <h4 class="text-uppercase text-bold text-rg heading-line-middle">&nbsp;<span>Core development</span></h4>
                    <div class="row">
{{--                        <h3>Aprovacao do Grant Manager</h3>--}}
                        <form action="" id="form_submit_core_development" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="p_id" value="{{base64_encode($project->p_id)}}">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Documento de suporte</label>
                                            <div class="col-md-10">
                                                <input class="form-control input-sm" name="support_document" type="file" accept="file_extension/.docx, .doc, .pdf" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Orçamento Geral</label>
                                            <div class="col-md-10">
                                                <input class="form-control input-sm" name="orcamento_geral" value="{{$project->p_general_budget}}" type="number" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">Adicionar</button>
                                    </div>
                                </div>

                                {{--                            <div class="col text-center">--}}
                                {{--                                <h1 class="title">Projeto ainda não foi aprovado</h1>--}}
                                {{--                            </div>--}}
                            </div>

                        </form>
                    </div>
                </div>



                <div id="step-4">
                    <h4 class="text-uppercase text-bold text-rg heading-line-middle">&nbsp;<span>Detalhes do projecto</span></h4>
                    <div class="row">
                        @if($project->psm_id === 5)
                        <div class="col-md-4">
                            <div class="app-heading app-heading-small app-heading-condensed-horizontal">
                                <div class="title">
                                    <h3>Detalhes do projecto</h3>
                                    <p> Nome: <strong>{{$project->p_name}} </strong> </p>
                                </div>
                            </div>

                            <div class="listing">
                                <div class="listing-item">
                                    <h3>Descrição.</h3>
                                    <p>{{ $project->p_description }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="app-heading app-heading-small app-heading-condensed-horizontal">
                                <div class="title">
                                    <h3>Sobre o autor {{ $project->user_project->staff->s_name }}</h3>
{{--                                    <p>Cargo: <strong>{{$project_author->r_name}}</strong></p>--}}
                                </div>
                            </div>

                            <div class="listing">
                                <div class="listing-item">
{{--                                    <a href="#" class="text-success">Projetos Submetidos</a>--}}
                                        <p class="margin-bottom-0">{{'Previsão de término: '.$project->p_deadline}} </p>
                                        @if(!empty($project->time_line))
                                            <p class="margin-bottom-0">{{'O projecto irá decorrer de '.$project->time_line->tp_start_at.' até '.$project->time_line->tp_end_date}} 1</p>
                                        @endif
                                        <p class="margin-bottom-0 text-muted text-sm"></p>
                                </div>
                            </div>
                        </div>

                        <h4 class="text-uppercase text-bold text-rg heading-line-middle">&nbsp;<span>Documentos Associados</span></h4>

                    <div class="row">
                        @foreach($project->documentsProject as $document)
                            <div class="col-md-4">
                                <div class="app-heading app-heading-small app-heading-condensed-horizontal">
                                    <div class="title">
                                        <h3>{{$document->dp_description}}</h3>
                                        <a href="{{ asset('docs/'.$document->dp_local_path) }}">{{$document->dp_name}}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                        @else
                            <h3>O Pre award manager ainda nao submeteu a aprovacao do projecto</h3>
                        @endif

            </div>

        </div>
    </div>
    <!-- END BASIC EXAMPLE -->
<div class="modal fade" id="add_staff" tabindex="-1" role="dialog" aria-labelledby="modal-default-header">
    <div class="modal-dialog" role="document">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-default-header">Modal title</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('staff.store') }}" class="form-horizontal">
                    @csrf
                    <div class="form-group">
                        <label class="col-md-2 control-label">Nome</label>
                        <div class="col-md-10">
                            <input name="s_name" type="text" class="form-control">
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <label class="col-md-2 control-label">Password</label>
                        <div class="col-md-10">
                            <input type="password" class="form-control">
                        </div>
                    </div> --}}
                    <div class="form-group" style="display: flex; justify-content: center;">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary " >Adicionar</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
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
        function add_group_member(){
            membro_id= $('#membro_id').val();
            role_id= $('#role_id').val();
            var options= '';
            var options_roles= '';
            for (var i =0; i<investigators.length; i++){
                options+=' <option value="'+investigators[i].s_name+'">';
            }
            for (var j =0; j<role_groups.length; j++){
                options_roles+=' <option value="'+role_groups[j].wgr_id+'">'+role_groups[j].wgr_name+'</option>';
            }
            var name_div='       <div class="col-md-12 form-group">'+
                '<input list="membro_selected_'+index+'" name="membro_selected_'+index+'" value="'+membro_id+'" placeholder="Membro" id="membro_'+index+'" class="form-control">'+
                '<datalist id="membro_selected_'+index+'">'+
                options+
                '</datalist>'+
                '</div>';
            var roles_div='    <div class="col-md-12" >'+
                '<select class="bs-select" multiple id="role_id_'+index+'" name="role_'+index+'">'+
                options_roles+
                '</select>'+
                '</div>';
            rows.push('<tr>'+
                '<td>'
                +name_div
                +'</td>'+
                '<td>'+
                roles_div+
                '</td>'+
                '<td>-</td>'+
                '<td>-</td>'+
                '</tr>');
            load_table();
        }

        function load_table(){
            $('#member_table').empty();
            for (var i=0; i<rows.length;i++){
                $('#member_table').append(rows[i]);

            }
        }
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
