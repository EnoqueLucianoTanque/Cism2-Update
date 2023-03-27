@extends('layout.template')
@section('page_title', translate('configuracao_proposta'))
@section('user_role', session('role_name'))
@section('user_name', session('user_name'))
@section('page_title', 'Proposta de projeto')
@section('page_title_', 'Pre award')
@section('page_title_active', translate('configuracao_pre_award'))

@section('content')
    <!-- BASIC EXAMPLE -->
    <div class="block block-condensed">
        <div class="app-heading">
            <div class="title">
                <h2>{{translate('etapa_projeto')}}</h2>
                <p>{{ $project->p_name }}</p>
            </div>
        </div>
        <div class="block-content">

            <div class="wizard">
                <ul>

                    <li>
                        <a href="#step-1">
                            <span class="stepNumber">1</span>
                            <span class="stepDesc">Pre-Writing<br /><small>{{translate('grupo_trabalho')}}</small></span>
                        </a>
                    </li>

                    <li>
                        <a href="#step-2">
                            <span class="stepNumber">2</span>
                            <span class="stepDesc">Early Integration<br /><small>{{translate('anexar_documento')}}</small></span>
                        </a>
                    </li>


                    <li>
                        <a href="#step-3">
                            <span class="stepNumber">3</span>
                            <span class="stepDesc">Core development<br /><small>{{translate('aprovacao_financiamento')}}</small></span>
                        </a>
                    </li>


                    <li>
                        <a href="#step-4">
                            <span class="stepNumber">4</span>
                            <span class="stepDesc">Finalization<br /><small>{{translate('aprovacao_final')}}</small></span>
                        </a>
                    </li>
                </ul>

                <div id="step-1">
                    <form action="" id="post_form_work_group">
                        @csrf
                        <input type="hidden" name="project_id" value="{{ base64_encode($project->p_id) }}">
                        <input type="hidden" name="max_index" id="max_index" value="0">
                        <h4 class="text-uppercase text-bold text-rg heading-line-middle">&nbsp;<span>{{translate('criar_grupo_trabalho')}}</span></h4>
                        <div class="row">
                            <div class="col col-md-12">
                                <div class="app-heading app-heading-small">
                                    <div class="title">
                                        <h5>Timeline </h5>
                                    </div>
                                </div>
                                <div class="row col-sm-12">
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            {{-- <div class="col-md-12 form-group"> --}}
                                            <label for="membro_selected">{{translate('previsao_inicio')}}</label>

                                            
                                            <input name="data_inicio" type="date" id="data_inicio"
                                                value="{{ empty($project->time_line) ? $project->p_end_date : $project->time_line->tp_start_at }}"
                                                min="{{$project->p_end_date}}"
                                                onchange="onchangeDate();" placeholder="{{translate('previsao_inicio')}}" class="form-control" required>
                                            {{-- </div> --}}
                                        </div>

                                        <div class="col-md-6">
                                            <label for="membro_selected">{{translate('data_termino')}}</label>
                                            
                                            <input name="data_fim" type="date" id="data_fim" placeholder="{{translate('data_termino')}}"
                                                value="{{ empty($project->time_line) ? $project->p_deadline : $project->time_line->tp_end_date }}"
                                                min="{{$project->p_deadline}}"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($project->psm_id <= 3)
                            <div class="col col-md-12">
                                <div class="row col-sm-12">
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label for="membro_selected">{{translate('membro')}}</label>
                                            <input list="membro_selected" name="membro_selected" id="membro_id"
                                                placeholder="{{translate('membro')}}" class="form-control">
                                            <datalist id="membro_selected">
                                                @foreach ($investigators as $investigator)
                                                    <option value="{{ $investigator->s_name }}">
                                                @endforeach
                                            </datalist>
                                        </div>
                                        <div class="col-md-6">
                                            <label>{{translate('cargo')}}</label>
                                            <select class="select2" id="role_id" name="role" multiple>
                                                @foreach ($role_groups as $role_group)
                                                    <option value="{{ $role_group->wgr_id }}">
                                                        {{ $role_group->wgr_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                            <div class="col-md-4">
                                                <button class="btn btn-primary btn-icon-fixed" onclick="add_group_member();"
                                                    type="button" style="margin-top: 20px;">
                                                    <i class="fa fa-user"></i> {{translate('adicionar_lista')}}</button>
                                            </div>

                                    </div>
                                </div>
                            </div>
                            @endif


                            <div class="col col-md-12">
                                <div class="row col-sm-12">
                                    <table class="table table-striped table-bordered datatable-basic">
                                        <thead>
                                            <tr>
                                                <th>{{translate('nome')}}</th>
                                                <th>{{translate('cargo')}}</th>
                                                <th>{{translate('data_registo')}}</th>
                                                <th>{{translate('accoes')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody id="member_table">
                                            @if (!empty($project->work_group_project))
                                                @foreach ($project->work_group_project->work_group_member as $index => $member)
                                                    <tr>
                                                        <td>
                                                            <div class="row col-md-12">
                                                                <div class="col-md-12 form-group">
                                                                    <input list="membro_selected"
                                                                        name="{{ 'membro_selected_' . $index }}"
                                                                        value="{{ $member->staff->s_name }}"
                                                                        placeholder="{{translate('membro')}}" class="form-control"
                                                                        readonly>
                                                                    <datalist id="membro_selected">
                                                                        @foreach ($investigators as $investigator)
                                                                            <option value="{{ $investigator->s_name }}">
                                                                        @endforeach
                                                                    </datalist>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="row col-md-12">
                                                                <div class="col-md-6">
                                                                    <select class="select2"
                                                                        name="{{ 'role_' . $index . '[]' }}" multiple
                                                                        disabled>
                                                                        @foreach ($role_groups as $role_group)
                                                                            <option value="{{ $role_group->wgr_id }}"
                                                                                @foreach ($member->member_roles as $role)
                                                                                @if ($role->wgr_id == $role_group->wgr_id)
                                                                                    {{ 'selected' }}
                                                                                @endif
                                                                        @endforeach

                                                                        >{{ $role_group->wgr_name }}</option>
                                                @endforeach
                                                </select>
                                </div>
                            </div>

                            </td>
                            <td>{{ $member->updated_at }}</td>
                            <td>

                                @if ($project->psm_id <= 3)
                                    <button type="button" class="btn btn-secondary" onclick="remove_row({{ (int) $index }});"
                                    style="background-color: #7fad39!important; color:white!important;"
                                    data-dismiss="modal"><i class="fa fa-remove" style="color: white"></i></button>
                                @endif
                            </td>

                            @endforeach

                            @endif

                            </tbody>
                            </table>
                        </div>

                        <div class="col-sm-12 text-right">
                            <button class="btn btn-primary btn-icon-fixed" type="submit" style="margin-top: 20px;" id="btn_submit_form" disabled><i
                                    class="fa fa-save"></i> {{translate('submeter')}}</button>
                        </div>
                </div>

            </div>
            </form>
        </div>

        <div id="step-2">
            @if ($project->psm_id <= 2)
                <h4 class="text-uppercase text-bold text-rg heading-line-middle">&nbsp;<span>{{translate('anexar_concept_note')}}</span>
                </h4>
                <div class="row">

                    <div class="col-md-12">
                        <form action="{{ route('insert.other_document') }}" method="POST" class="form-vertical"
                            enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="document_type" value="2">
                            <div class="form-group">
                                <label class="col-md-2 control-label">{{translate('anexar_documento')}}</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="file" accept="file_extension/.docx, .doc, .pdf"
                                        placeholder="{{translate('anexar_concept_note')}}" name="doc_concept_note" value="{{old("doc_concept_note")}}">
                                </div>
                                @error('doc_concept_note')
                                    <span style="color: red"> {{ $message }}</span>
                                @enderror
                            </div>

                        
                            <div class="form-group">
                                <label class="col-md-2 control-label">{{translate('anexar_outro_documento')}}</label>
                                <div class="col-md-10">
                                    <input type="hidden" name="p_id" value="{{ base64_encode($project->p_id) }}">
                                    <input class="form-control input-sm" name="document" type="file" value="{{old("document")}}"
                                        accept="file_extension/.docx, .doc, .pdf">
                                </div>
                                @error('document')
                                    <span style="color: red"> {{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">{{translate('document_description')}}</label>
                                <div class="col-md-10">
                                    <input class="form-control input-sm" name="document_description" type="text" >
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary" id="btn_submit">{{translate('adicionar')}}</button>
                            </div>
                        </form>
                    </div>

                </div>
            @else
                <div class="row">
                    <div class="block block-condensed">
                        <div class="app-heading app-heading-small">
                            <div class="title">
                                <h2>{{translate('documento_anexado')}}</h2>
                            </div>

                        </div>
                        <div class="block-content margin-bottom-0">
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>{{translate('tipo_documento')}}</th>
                                                <th>{{translate('descricao')}}</th>
                                                <th>{{translate('baixar')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($project->documentsProject as $documents)
                                                <tr>
                                                    <td>{{ translate($documents->document_type->dt_name) }}</td>
                                                    <td>{{ translate($documents->dp_description) }}</td>
                                                    <td> <a href="{{ asset('docs/' . $documents->dp_local_path) }}"
                                                            target="_blanck">{{ $documents->dp_description }} <span
                                                                class="icon-printer"></span></a> </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>

            <div id="step-3">
                <h4 class="text-uppercase text-bold text-rg heading-line-middle">&nbsp;<span>Core development</span></h4>
                <div class="row">
                    @if ($project->psm_id === 4 || $project->psm_id === 5)
                        <div class="block-content">
                            <div class="listing margin-bottom-0">
                                <div class="listing-item listing-item-with-icon">
                                    <span class=" listing-item-icon"></span>
                                    <h4 class="text-rg text-bold">{{translate('orcamento_aprovado_grant_manager')}}<span
                                            class="text-muted pull-right">  </span></h4>
                                    <div class="list-group list-group-inline">
                                        <div class="list-group-item col-md-4 col-sm-4">
                                            <span class="text-bold">{{translate('proposta_orcamental_grant')}}</span><br>
                                            <span
                                                class="text-muted">{{ number_format($project->p_general_budget, 2, '.', ',') . ' '.$project->p_currency }}</span>
                                        </div>
                                        <div class="list-group-item col-md-4 col-sm-4">
                                            <span class="text-bold">{{translate('financiamento_necessario')}}</span><br>
                                            <span
                                                class="text-muted text-danger">{{ number_format($project->p_budget, 2, '.', ',') . ' '.$project->p_currency }}</span>
                                        </div>
                                        {{-- {{dd($project)}} --}}
                                        @foreach ($project->documentsProject as $documento_suporte)
                                        @if($documento_suporte->psm_id == 3 )
                                            <div class="list-group-item col-md-4 col-sm-4">
                                                <span class="text-bold">{{translate('document_support')}}</span><br>
                                                <span> <a href="{{ asset('docs/'.$documento_suporte->dp_local_path ) }}" target="_blanck"> {{$documento_suporte->dp_description}}</a> </span>
                                            </div>
                                            @endif
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>

                    @else
                        <div class="block-content">
                            <div class="text-center">
                                <img src="{{ asset('img/ilustrator/no_data2.png') }}" class="rounded"
                                    alt="Sample Image" height="128px" height="128px">
                                <h3>{{translate('grant_manager_submeteu')}} </h3>
                                {{-- <p class="text-center">Nenhum projeto foi submetido.</p> --}}
                            </div>
                        </div>
                    @endif

                </div>
            </div>

            <div id="step-4">
                <h4 class="text-uppercase text-bold text-rg heading-line-middle">&nbsp;<span>{{translate('detalhe_proposta')}}</span></h4>
                <div class="block block-content">
                    @if($project->p_state === 'Rejeitado')
                    <div class="text-center">
                        <div class="text-center">
                            <img src="{{ asset('img/ilustrator/rejected.png') }}" class="rounded" alt="Sample Image"
                                height="90px" height="90px">
                                <label for="" class="label-control">{{translate('razoes')}} </label>
                                <textarea name="" id="" cols="30" class="form-control" rows="10" disabled>{{$project->p_reasons}}</textarea>
                            {{-- <p class="text-center">Nenhum projeto foi submetido.</p> --}}
                        </div>
                    </div>
                    @elseif ($project->psm_id == 5 || $project->p_state == "Aprovado")
                        <div class="app-heading app-heading-large">
                            <div class="title">
                                <h2>{{translate('proposta_aprovada_pre_award')}}</h2>
                                <p><a href="{{route("configuration.project_state", ['p_id'=>base64_encode($project->p_id), 'psm_id'=>base64_encode($project->psm_id)])}}"><span class="label label-success label-bordered">{{translate('clique_aqui')}}</span></a> {{translate('para_alterar_estado')}}</p> 
                            </div>
                        </div>
                        <div class="block-content margin-bottom-0">
                            <div class="row">
                                <div class="text-center">
                                    <img src="{{ asset('img/ilustrator/approved.png') }}" class="rounded" alt="Sample Image"
                                        height="90px" height="90px">
                                        <p>{{translate('proposta_aprovada')}}</p>
                                </div>

                            </div>
                        </div>

                    @else
                        <div class="text-center">
                            <img src="{{ asset('img/ilustrator/warning.png') }}" class="rounded" alt="Sample Image"
                                height="90px" height="90px">
                            <h3>{{translate('pre_award_manager_ainda_resposta')}}</h3>
                            {{-- <p class="text-center">Nenhum projeto foi submetido.</p> --}}
                        </div>
                    @endif
                </div>

            </div>

        </div>
    </div>
    <!-- END BASIC EXAMPLE -->
    <div class="modal fade" id="add_staff" tabindex="-1" role="dialog" aria-labelledby="modal-default-header">
        <div class="modal-dialog" role="document">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"
                    class="icon-cross"></span></button>

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
                        
                        <div class="form-group" style="display: flex; justify-content: center;">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary ">Adicionar</button>
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

        let post_form_submit_core_development = "{{ route('configs_manager.store') }}";
        let post_form_submit_timeline = "{{ route('configs.store') }}";
        let project_stage = parseInt("{{$project->psm_id}}");

        var membro_id, role_id;
        var investigators = {!! $investigators !!};
        var role_groups = {!! $role_groups !!};
        var index = parseInt("{!! empty($project->work_group_project) ? 0 : count($project->work_group_project->work_group_member) !!}");

        var rows = [];
        var status = '';
        // $(window).on("load", function(){
        //     console.log('Teste');    
        // });




        $(document).ready(function() {

            $('#btn_submit').on('click', function() {
                var $this = $(this);
                var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> {{translate("loading")}}';
                if ($(this).html() !== loadingText) {
                $this.data('original-text', $(this).html());
                $this.html(loadingText);
                }
                setTimeout(function() {
                $this.html($this.data('original-text'));
                }, 5500);
            });

            if ($(".wizard").length > 0) {

                //check count of steps in each wizard
                $(".wizard > ul").each(function() {
                    $(this).addClass("steps_" + $(this).children("li").length);
                });


                // console.log(project_stage);
                $(".wizard").smartWizard({
                    // This part (using for wizard validation) of code can be removed FROM
                    selected: project_stage-2,
                    onLeaveStep: function(obj) {
                        var wizard = obj.parents(".wizard");

                        if (wizard.hasClass("wizard-validation")) {

                            var valid = true;

                            $('input,textarea', $(obj.attr("href"))).each(function(i, v) {
                                valid = validate.element(v) && valid;
                            });

                            if (!valid) {
                                wizard.find(".stepContainer").removeAttr("style");
                                validate.focusInvalid();
                                return false;
                            }
                        }

                        app.spy();

                        return true;
                    }, // <-- TO
                    //this is important part of wizard init
                    onShowStep: function(obj) {
                        var wizard = obj.parents(".wizard");

                        if (wizard.hasClass("show-submit")) {

                            var step_num = obj.attr('rel');
                            var step_max = obj.parents(".anchor").find("li").length;

                            if (step_num == step_max) {
                                obj.parents(".wizard").find(".actionBar .btn-primary").css("display",
                                    "block");
                            }
                        }

                        app.spy();

                        return true;
                    }, // ./end

                });


            }

            $.each($('.wizard  ul a'), function(i, n) {
                    if (i < project_stage-2) {
                        console.log(project_stage);
                        $(n).removeClass("selected").removeClass("disabled").addClass("done");
                    }
                });

            $(".select2").select2();

            $(".select2-limiting").select2({
                maximumSelectionLength: 2
            });
            var pre_rows = document.getElementById("member_table").rows;
            for (var i = 0; i < pre_rows.length; i++) {
                rows.push(pre_rows[i]);
            }
            // console.log(document.getElementById("member_table").rows[0])
            $('#carregamento').css("display", "none");
        });

        function onchangeDate() {
            document.getElementById("data_fim").min = document.getElementById("data_inicio").value;
        }

        function remove_row(index) {
            rows.splice(index, 1);
            load_table();
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


        function load_table() {
            $('#member_table').empty();
            for (var i = 0; i < rows.length; i++) {
                $('#member_table').append(rows[i]);

            }
            $('.select3').select2();
        }


        function add_group_member() {
            $("#btn_submit_form").prop("disabled", false);
            membro_id = $('#membro_id').val();
            role_id = $('#role_id').val();
            console.log(role_id);
            var options = '';
            var options_roles = '';
            for (var i = 0; i < investigators.length; i++) {
                options += ' <option value="' + investigators[i].s_name + '">';
            }
            for (var j = 0; j < role_groups.length; j++) {
                status = "";
                for (var s = 0; s < role_id.length; s++) {
                    if (role_groups[j].wgr_id == role_id[s]) {
                        status = "selected";
                    }
                }
                options_roles += ' <option value="' + role_groups[j].wgr_id + '" ' + status + ' >' + role_groups[j]
                    .wgr_name + '</option>';
            }
            var name_div = '       <div class="col-md-12 form-group">' +
                '<input list="membro_selected_' + index + '" name="membro_selected_' + index + '" value="' + membro_id +
                '" placeholder="Membro" id="membro_' + index + '" class="form-control">' +
                '<datalist id="membro_selected_' + index + '">' +
                options +
                '</datalist>' +
                '</div>';
            var roles_div = '    <div class="col-md-12" >' +
                '<select class="select3" multiple id="role_id_' + index + '" name="role_' + index + '[]">' +
                options_roles +
                '</div></select>' +
                '</div>';
            rows.push('<tr>' +
                '<td><div class="row col-md-12">' +
                name_div +
                '</div></td>' +
                '<td> <div class="row col-md-12">' +
                roles_div +
                '</div></td>' +
                '<td>-</td>' +
                '<td><button type="button" class="btn btn-secondary" onclick="remove_row(' + (rows.length - 1) +
                ');" style="background-color: #7fad39!important; color:white!important;" data-dismiss="modal"><i class="fa fa-remove" style="color: white"></i></button> </td>' +
                '</tr>');
            load_table();
            index += 1;
            $('#membro_id').val(null);
            $('#role_id').val(null);
            $('#max_index').val(index);
            $('#role_id').trigger('change');
        }
        $("form#form_submit_core_development").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: post_form_submit_core_development,
                dataType: 'json',
                type: 'POST',
                data: formData,
                beforeSend: function() {
                    $('#carregamento').css("display", "block");
                },
                complete: function() {
                    $('#carregamento').css("display", "none");
                },
                error: function() {
                    swal({
                        title: "erro",
                        text: "{{translate('houve_erro')}}",
                        icon: "error",
                        button: "{{translate('confirmar')}}"
                    });
                    $('#carregamento').css("display", "none");

                    return false;
                },
                success: function(data) {
                    // alert(data);
                    if (data.state == 200) {
                        swal({
                            title: "{{translate('sucesso')}}",
                            text: data.message,
                            icon: "success",
                            button: "{{translate('confirmar')}}"
                        }).then(function() {

                        })
                    } else {
                        swal({
                            title: "Erro!",
                            text: data.message,
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
        $("form#post_form_work_group").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: post_form_submit_timeline,
                dataType: 'json',
                type: 'POST',
                data: formData,
                beforeSend: function() {
                    $('#carregamento').css("display", "block");
                },
                complete: function() {
                    $('#carregamento').css("display", "none");
                },
                error: function() {
                    swal({
                        title: "erro",
                        text: "{{translate('houve_erro')}}",
                        icon: "error",
                        button: "{{translate('confirmar')}}"
                    });
                    $('#carregamento').css("display", "none");

                    return false;
                },
                success: function(data) {
                    // alert(data);
                    if (data.state == 200) {
                        swal({
                            title: "{{translate('sucesso')}}",
                            text: data.message,
                            icon: "success",
                            button: "{{translate('confirmar')}}"
                        }).then(function() {
                            location.reload();
                        })
                    } else {
                        swal({
                            title: "Erro!",
                            text: data.message,
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
        $("form#post_form_work_group").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: post_work_group,
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
                        text: "{{translate('houve_erro')}}",
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
                            text: "{{translate('actualizado_sucesso')}}",
                            icon: "success",
                            button: "{{translate('confirmar')}}"
                        }).then(function () {
                            location.reload();
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




@endsection
