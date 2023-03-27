@extends('layout.template')
@section('page_title', translate('aprovacao_final'))
@section('page_name', translate('start_page'))
@section('page_title_', 'Pre award ')
@section('page_title_active', 'Finalization')
@section('user_role', session('role_name'))
@section('user_name', session('user_name'))

@section('content')

<div class="row">
    <div class="block block-condensed">
        <div class="app-heading">
            <div class="title">
                <h2> {{ translate('gestao_projecto') . $project->p_name}}</h2>
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
                            value="{{empty($project->time_line)? 'Timeline não definida':date_format(date_create($project->time_line->tp_start_at),"m/d/Y")  . ' - ' . date_format(date_create($project->time_line->tp_end_date), "m/d/Y")}}"

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
                                    <th colspan="2" class="text-center"><strong> {{translate('grupo_trabalho')}}</strong></th>
                                </tr>
                                <tr>
                                    <th>{{translate('nome')}}</th>
                                    <th>{{translate('cargo')}}</th>
                                </tr>
                            </thead>
                            <tbody >
                            @if(!empty($project->work_group_project->work_group_member))
                                @foreach ($project->work_group_project->work_group_member as $work_group_member)
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">


        <div class="block block-condensed">
            <div class="app-heading">
                <div class="title">
                    <h3>{{translate('mais_detalhes')}}</h3>
                    {{-- <p>The best categories of all time</p> --}}
                </div>
            </div>
            <div class="block-content">

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
                                <h4 class="text-rg text-bold">{{translate('autor_detalhes')}}<span class="text-muted pull-right"></span></h4>
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
                                        <span class="text-bold">{{translate('data_termino')}}</span><br>
                                        <span class="text-muted text-danger">{{ $project->p_deadline}}</span>
                                    </div>

                                </div>
                            </div>
                            <div class="listing-item listing-item-with-icon">
                                <span class="icon-file-add listing-item-icon text-success"></span>
                                <h4 class="text-rg text-bold"><span class="text-muted pull-right"></span></h4>
                                <div class="list-group list-group-inline margin-bottom-0">
                                    <div class="list-group-item col-md-4 col-sm-4">
                                        <span class="text-bold">{{translate('fonte_projecto')}}</span><br>
                                        <span class="text-muted">{{ $project->p_source}}</span>
                                    </div>
                                    <div class="list-group-item col-md-4 col-sm-4">
                                        <span class="text-bold">{{translate('proposta_financeira')}}</span><br>
                                        <span class="text-muted text-danger">{{ number_format($project->p_budget, 2, '.', ',') . ' '.$project->p_currency }}</span>
                                    </div>
                                    <div class="list-group-item col-md-4 col-sm-4">
                                        <span class="text-bold">{{translate('document_support')}}</span><br>
                                        @if(!empty($project->p_support_document))
                                        <span class="text-muted"><a href="{{ asset('docs/' . $project->p_support_document) }}" class="" target="_blank"><span class="icon-printer"></span></a></span>
                                        @else    
                                        <span class="text-muted text-danger">
                                            {{translate('no_record')}}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="listing-item listing-item-with-icon"> --}}
                                <div class="listing-item listing-item-with-icon">
                                    <span class="icon-file-add listing-item-icon text-success"></span>
                                    <h4 class="text-rg text-bold"><span class="text-muted pull-right"><span class=""></span></span></h4>
                                    <div class="list-group list-group-inline margin-bottom-0">
                                        @if(!empty($project->documentsProject))
                                        @foreach($project->documentsProject as $document)
                                            <div class="list-group-item col-md-6 col-sm-6">
                                                <span class="text-bold">{{translate('tipo_documento')}}: <span class="label label-success label-bordered" >{{translate($document->document_type->dt_name)}}</span> </span><br>
                                                <span class=""><a href="{{ asset('docs/' . $document->dp_local_path) }}" class="" target="_blank"><span class="icon-printer"></span></a> {{$document->dp_name}}</span>
                                            </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            {{-- </div> --}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="block block-condensed">
            @if($project->psm_id == 5)
                <div class="app-heading">
                    <div class="title">
                        <h3> <span class=""> {{translate('proposta_aprovada')}}. </span></h3>
                    </div>
                </div>
                <div class="col">
                    <div class="col-md-2 ">
                        <img src="{{asset('img/ilustrator/submitted.png')}}" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                    </div>
                </div>
            @else
                <div class="app-heading">
                    <div class="title">
                        <h3>{{translate('Final approval form')}}</h3>
                    </div>
                </div>

                <div class="block-content">
                    <form action='{{route('pre_writing.project_approval')}}' method="POST" class="form-horizontal">
                        @csrf
                        <div class="form-group">
                            <label class="col-md-2 control-label">{{translate('opcao')}}</label>
                            <div class="col-md-10">
                            <select class="form-control" name="p_state" id="">
                                <option> {{translate('select_option')}}</option>
                                <option value="Aprovado">{{translate('aprovado')}}</option>
                                <option value="Rejeitado">{{translate('rejeitado')}}</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="project_id" value="{{ base64_encode($project->p_id) }}">
                            <label class="col-md-2 control-label">{{translate('motivo')}}</label>
                            <div class="col-md-10">
                                <textarea name="reasons" class="form-control" rows="5"></textarea>
                                @error('reasons')
                                    <span style="color: red"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4"></div>
                            <div class="col-md-8 text-right">
                                <button type="submit" class="btn btn-primary" id="btn_submit">{{translate('submeter')}}</button>
                            </div>
                        </div>
                  </form>
                </div>
            @endif

        </div>
    </div>


</div>


@endsection
@section('scripts')

<script>
$(document).ready(function(){
    $('#btn_submit').on('click', function() {
        var $this = $(this);
        var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> {{translate("loading")}}';
        if ($(this).html() !== loadingText) {
            $this.data('original-text', $(this).html());
            $this.html(loadingText);
        }
        setTimeout(function() {
            $this.html($this.data('original-text'));
        }, 6500);
    });
});

    $("#orcamento").maskMoney();
</script>

@endsection
