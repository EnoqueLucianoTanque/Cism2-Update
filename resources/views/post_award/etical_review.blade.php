@extends('layout.template')
@section('page_title', translate('revisao_etica'))
@section('page_title', 'Ethical Review')
@section('page_title_', translate('aprovacao_etica'))
@section('user_role', session('role_name'))
@section('user_name', session('user_name'))
@section('content')

    <div class="block block-condensed">
        <div class="col-sm-12 ">
            <a class="btn btn-clean btn-icon-fixed" type="button" style="margin-top: 20px; float: right" href="{{route('configs_post_award.index')}}"><i class="fa fa-backward"></i> {{translate('voltar')}}</a>
        </div>
        <div class="app-heading">
            <div class="title">
                <h2>{{translate('revisao_etica')}}</h2>
                <span>{{translate('nome')}}: <strong>{{$projects->p_name}}</strong></span>
            </div>
        </div>
        <div class="block-content">
            <div class="wizard">
                <ul>

                    <li>
                        <a href="#step-1">
                            <span class="stepNumber">1</span>
                            <span class="stepDesc">Post Award<br /><small>{{translate('detalhes_projecto')}}</small></span>
                        </a>
                    </li>

                    <li>
                        <a href="#step-2">
                            <span class="stepNumber">2</span>
                            <span class="stepDesc">{{translate('aprovacoes')}}<br /><small>{{translate('aprovacao_cci')}}</small></span>
                        </a>
                    </li>


                    <li>
                        <a href="#step-3">
                            <span class="stepNumber">3</span>
                            <span class="stepDesc">{{translate('aprovacoes')}}<br /><small>{{translate('aprovacao_etica')}}</small></span>
                        </a>
                    </li>

                    <li>
                        <a href="#step-4">
                            <span class="stepNumber">4</span>
                            <span class="stepDesc">{{translate('fase_estudo_')}}<br /><small>{{translate('fase_estudo_')}}</small></span>
                        </a>
                    </li>
                    <li>
                        <a href="#step-5">
                            <span class="stepNumber">5</span>
                            <span class="stepDesc">{{translate('fase_final')}}<br /><small>{{translate('aprovacao_final')}}</small></span>
                        </a>
                    </li>
                </ul>

                <div id="step-1">
                    <h4 class="text-uppercase text-bold text-rg heading-line-middle" style="color: #272c40!important;">&nbsp;<span >{{translate('detalhes_projecto')}}</span></h4>
                    <div class="row col-sm-12 col-md-12">
                        <div class="col-md-6">

                            <!-- START PROJECT DETAILS -->
                            <div class="block block-condensed">
                                <div class="app-heading">
                                    <div class="title">
                                        <strong> {{translate('nome')}}: </strong><span>{{$project->p_name}} </span>
                                    </div>
                                </div>

                                <div class="block-content">
                                    <div class="form-group">
                                        <label class="control-label">{{translate('nome')}}</label>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" cols="4" rows="6" disabled>{{$project->p_description}}</textarea>
                                    </div>
                                    {{--                                        <div class="listing margin-bottom-0">--}}
                                    {{--                                            <div class="listing-item listing-item-with-icon">--}}


                                    <div class="list-group list-group-inline">
                                        <div class="list-group-item col-md-4 col-sm-4" style="max-height: 80px; min-height: 80px;">
                                            <span class="text-bold">{{translate('pagina_projecto')}}</span><br>
                                            <span class="text-muted"><a target="_blank" href="{{ $project->p_web_url}}" class="" ><span class="fa fa-chrome"></span> {{ $project->p_name}}</a></span>
                                        </div>
                                        <div class="list-group-item col-md-4 col-sm-4" style="max-height: 80px; min-height: 80px;">
                                            <span class="text-bold">{{translate('data_submissao')}}</span><br>
                                            <span class="text-muted">{{ $project->p_submitted_at}}</span>
                                        </div>
                                        <div class="list-group-item col-md-4 col-sm-4" style="max-height: 80px; min-height: 80px;">
                                            <span class="text-bold">{{translate('previsao_termino')}}</span><br>
                                            <span class="text-muted text-danger">{{ $project->p_deadline}}</span>
                                        </div>

                                    </div>
                                </div>

                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                            </div>
                            <div class="block-content">

                            </div>


                        </div>
                        <div class="col-md-6">
                            <!-- START PAGE CONTAINER -->
                            {{--                            <div class="container container-boxed">--}}

                            <div class="row">
                            {{--                                    <div class="col-md-8">--}}

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
                                                <h4 class="text-rg text-bold">{{translate('autor_detalhes')}}</h4>
                                                <div class="list-group list-group-inline">
                                                    <div class="list-group-item col-md-6 col-sm-6" style="max-height: 80px; min-height: 80px;">
                                                        <span class="text-bold">{{translate('autor')}}</span><br>
                                                        <span class="text-muted">{{ $project->user_project->staff->s_name }}</span>
                                                    </div>
                                                    <div class="list-group-item col-md-6 col-sm-6" style="max-height: 80px; min-height: 80px;">
                                                        <span class="text-bold">{{translate('cargo')}}</span><br>
                                                        <span class="text-muted text-danger">{{$project->user_project->roles->r_description}}</span>

                                                    </div>

                                                </div>
                                            </div>
                                            <div class="listing-item listing-item-with-icon">
                                                <span class="icon-file-add listing-item-icon text-success"></span>
                                                <h4 class="text-rg text-bold"></h4>
                                                <div class="list-group list-group-inline margin-bottom-0" style="max-height: 80px; min-height: 80px;">
                                                    <div class="list-group-item col-md-6 col-sm-6" style="max-height: 80px; min-height: 80px;">
                                                        <span class="text-bold">{{translate('fonte_projecto')}}</span><br>
                                                        <span class="text-muted">{{ $project->p_source}}</span>
                                                    </div>
                                                    <div class="list-group-item col-md-6 col-sm-6" style="max-height: 80px; min-height: 80px;">
                                                        <span class="text-bold">{{translate('proposta_financeira')}}</span><br>
                                                        <span class="text-muted text-danger">{{ number_format($project->p_budget, 2, '.', ',') . ' Mtn'}}</span>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END RECENT -->

                                {{--                                    </div>--}}
                            </div>

                        {{--                            </div>--}}
                        <!-- END PAGE CONTAINER -->


                        </div>


                    </div>
                    <h4 class="text-uppercase text-bold text-rg heading-line-middle">&nbsp;<span>{{translate('documentos_associados')}}</span></h4>
                    <div class="row">
                        @if(count($project->documentsProject)>0)
                            @foreach($project->documentsProject as $document)
                                <div class="col-md-4">
                                    <div class="block block-condensed">
                                        <div class="app-heading">
                                            <div class="title">
                                                <strong style="display:inline-block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 50ch;">{{$document->dp_description}}</strong>
                                            </div>
                                        </div>
                                        <div class="block-content">
                                            <a style="display:inline-block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 50ch;" href="{{ asset('docs/'.$document->dp_local_path) }}">{{$document->dp_name}}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="row">
                                <div class="col-sm-12">
                                    <img src="{{asset('img/ilustrator/no_data.svg')}}" style="width: 90px;height: 90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                    <p class="text-center"><strong>{{translate('no_record')}}</strong></p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div id="step-2">
                    @if($project->project_stage_micro->psm_level==2)
                        @if($project->project_stage_micro->psm_id==9)
                            <div class="row">
                                <div class="col-sm-12">
                                    <img src="{{asset('img/ilustrator/warning.png')}}" style="width: 90px;height: 90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                    <p class="text-center"><strong> A aprovação científica ainda não foi submetida</strong></p>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-sm-12">
                                    <img src="{{asset('img/ilustrator/rejected.png')}}" style="width: 90px;height: 90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                    <p class="text-center"><strong> O projecto foi rejeitado pela unidade reguladora</strong></p>
                                </div>
                            </div>
                        @endif
                    @else
                        @if($project->project_stage_micro->psm_level<2)
                            <div class="row">
                                <div class="col-sm-12">
                                    <img src="{{asset('img/ilustrator/warning.png')}}" style="width: 90px;height: 90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                    <p class="text-center"><strong> O protocolo ainda não foi submetido</strong></p>
                                </div>
                            </div>
                            {{--                        @elseif($project->project_stage_micro->psm_level>2)--}}
                            {{--                            @if( $project->project_stage_micro->psm_id==12)--}}
                            {{--                            <div class="row">--}}
                            {{--                                <div class="col-sm-12">--}}
                            {{--                                    <img src="{{asset('img/ilustrator/rejected.png')}}" style="width: 90px;height: 90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">--}}
                            {{--                                    <p class="text-center"><strong> {{translate('projecto_rejeitado')}}</strong></p>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                            @endif--}}
                        @else
                            @if( $project->project_stage_micro->psm_level>3)
                                <div class="row">
                                    <div class="col-sm-12">
                                        <img src="{{asset('img/ilustrator/approved.png')}}" style="width: 90px;height: 90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                        <p class="text-center"><strong>{{translate('projecto_aprovado')}}</strong></p>
                                    </div>
                                </div>
                            @else
                                @if( $project->project_stage_micro->psm_level==3 && $project->project_stage_micro->psm_id==11)
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <img src="{{asset('img/ilustrator/approved.png')}}" style="width: 90px;height: 90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                            <p class="text-center"><strong>{{translate('proposta_aprovada')}}</strong></p>
                                        </div>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <img src="{{asset('img/ilustrator/approved.png')}}" style="width: 90px;height: 90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                            <p class="text-center"><strong> {{translate('projecto_rejeitado')}}</strong></p>
                                        </div>
                                    </div>
                                @endif
                            @endif

                        @endif
                    @endif
                </div>
                <div id="step-3">
                    <h4 class="text-uppercase text-bold text-rg heading-line-middle" style="color: #272c40!important;">&nbsp;<span >{{translate('revisao_etica')}}</span></h4>
                    <div class="row">
                        {{--                <div class="col-sm-12">--}}
                        @if($project->project_stage_micro->psm_level == 5 && $project->psm_id == 19 )
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="block block-condensed">
                                        <div class="app-heading">
                                            <div class="title">
                                                <h2>{{translate('revisao_etica')}}</h2>
                                            </div>
                                        </div>
                                        <div class="row" style="margin: 20px 35px;">
                                            <h5 style="margin-right: -300px;">{{translate('documento_anexado')}}</h5>
                                            <div class="row">

                                                @foreach($ethical_review as $document)
                                                    <div class="col-sm-3">
                                                        <span class="text-bold">{{!empty($document->dp_name)?translate($document->dp_name): translate('protocolo') }}</span><br>
                                                        <span class="text-muted"><a href="{{ asset('docs/' . $document->dp_local_path) }}" target="_blanck"><span class="icon-download">{{translate('baixar')}}</span> </a></span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        {{-- {{ dd($ethical_review) }} --}}
                                    <div>

                                            {{ Form::open(['route' => ['aprovacao_etica',base64_encode($project->p_id)], 'class' => 'form-horizontal row', 'id' => 'form_ethical_approval', 'role' => 'form', 'method' =>'POST', 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'enctype' =>"multipart/form-data"]) }}
                                            {{ csrf_field() }}
                                            <input type="hidden" name="project_id" value="{{base64_encode($project->p_id)}}">

                                            <div class="block-content">
                                                <div class="row col-sm-12">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">{{translate('opcoes_aprovacao')}}</label>
                                                            <div class="col-md-6">
                                                                <select class="form-control" name="state" id="">
                                                                    <option selected> --{{translate('select_answer')}} --</option>
                                                                    <option value="Aprovado">{{translate('aprovado')}}</option>
                                                                    <option value="Reprovado">{{translate('reprovado_revisao')}}</option>
                                                                    
                                                                </select>
                                                                @error('state')
                                                                    <span style="color: red;">{{$message}}</span>
                                                                @enderror
                                                            </div>

                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">{{translate('carta_resposta')}}</label>
                                                            <div class="col-md-6">
                                                                <input class="form-control input-sm" name="carta_resposta" type="file" accept="file_extension/.docx, .doc, .pdf" required>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-sm-12 text-center">
                                                    <button id="btn_submit_2" class="btn btn-primary btn-icon-fixed" type="submit" style="margin-top: 20px;"><i class="fa fa-check"></i> {{translate('submeter')}}</button>
                                                </div>
                                                <img id="img_submitted_2"  src="{{asset('assets/css/vendor/tinymce/img/loading-buffering.gif')}}" style="visibility: hidden; width: 5vw;height: 10vh;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                            </div>
                                            {{ Form::close() }}
                                        </div>
                                    </div>
                                </div>
                                {{--                    </div>--}}
                            </div>
                        @else
                            <div class="row">
                                <div class="col-sm-12">
                                    <img src="{{asset('img/ilustrator/warning.png')}}" style="width: 90px;height: 90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                    <p class="text-center"><strong> {{translate('projecto_ainda_submetido_aprovacao')}}</strong></p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div id="step-4">
                    <div>
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tabs-7" data-toggle="tab">Gestão de Estudos</a></li>
                            <li><a href="#tabs-8" data-toggle="tab">Gestão de Artigos</a></li>
                        </ul>
                        <div class="tab-content tab-content-bordered">

                            <div class="tab-pane active" id="tabs-7">
                                <h3 class="font-bold " style="font-size: 18px; color: #016428;"><span class="" style="color: #016428;">(*)</span>Seleccione um estado para ver as Estudos</h3>

                                <div class="col-sm-12 text-center">

                                    <ul class="nav nav-pills mb-4 " id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" style="background-color: #016428; width: 150px; color: #ffffff;" id="pills-all-tab" data-toggle="pill" href="{{'#tab_all'}}" role="tab" aria-controls="pills-all" aria-selected="true">Todas</a>
                                        </li>
                                        @foreach($project_status as $status)
                                            @switch($status->c_id)

                                                @case(1)

                                                <li class="nav-item">
                                                    <a class="nav-link active" style="background-color: #8e9caf; width: 150px; color: #0c0c0c;" id="pills-home-tab" data-toggle="pill" href="{{'#tab_'.$status->c_id}}" role="tab" aria-controls="pills-home" aria-selected="false">{{$status->c_name.'('.$status_count[$status->c_id].')'}}</a>
                                                </li>

                                                @break
                                                @case(2)
                                                <li class="nav-item">
                                                    <a class="nav-link" id="{{'pills-profile-tab-'.$status->c_id}}" style="background-color: rgb(46, 205, 111); width: 150px; color: #ffffff;" data-toggle="pill" href="{{'#tab_'.$status->c_id}}" role="tab" aria-controls="{{'pills-profile-tab-'.$status->c_id}}" aria-selected="false">{{$status->c_name.'('.$status_count[$status->c_id].')'}}</a>
                                                </li>

                                                @break
                                                @case(3)
                                                <li class="nav-item">
                                                    <a class="nav-link" id="{{'pills-profile-tab-'.$status->c_id}}" style="background-color: rgb(4, 169, 244); width: 150px; color: #ffffff;" data-toggle="pill" href="{{'#tab_'.$status->c_id}}" role="tab" aria-controls="{{'pills-profile-tab-'.$status->c_id}}" aria-selected="false">{{$status->c_name.'('.$status_count[$status->c_id].')'}}</a>
                                                </li>

                                                @break
                                                @case(4)
                                                <li class="nav-item">
                                                    <a class="nav-link" id="{{'pills-profile-tab-'.$status->c_id}}" style="background-color: rgb(168, 117, 255); width: 150px; color: #ffffff;" data-toggle="pill" href="#{{'#tab_'.$status->c_id}}" role="tab" aria-controls="{{'pills-profile-tab-'.$status->c_id}}" aria-selected="false">{{$status->c_name.'('.$status_count[$status->c_id].')'}}</a>
                                                </li>

                                                @break
                                                @default
                                            @endswitch
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane active" id="{{'tab_all'}}" role="tabpanel" aria-labelledby="pills-all-tab">
                                        <div class="block block-condensed">

                                            <div class="block-content">
                                                <div class="body table-responsive" style="overflow-x:auto;">
                                                    <table class="table " style="border: none;" >
                                                        <thead>
                                                        <tr>
                                                            <th colspan="1" style="text-align: left; width: 8em; font-size: small; color: #5f5f5f;">Estado</th>
                                                            <th colspan="1" style="text-align: left; width: 8em; font-size: small; color: #5f5f5f;">Estudos</th>
                                                            <th colspan="1" style="text-align: left; width: 8em; font-size: small; color: #5f5f5f;">Membros</th>
                                                            <th colspan="1"  style="text-align: left; width: 8em; font-size: small; color: #5f5f5f;">Data início</th>
                                                            <th colspan="1"  style="text-align: left; width: 8em; font-size: small; color: #5f5f5f;">Data fim</th>
                                                            <th colspan="1"  style="text-align: left; width: 8em; font-size: small; color: #5f5f5f;">Artigo</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($project->tasks as $task)
                                                            {{--                                            <div class="row" style="padding: 20px">--}}
                                                            {{--                                                <div class="block block-condensed">--}}
                                                            {{--                                                    <div class="block-content">--}}
                                                            <tr id="row" >
                                                                <th style="

                                                                @switch($task->t_state)

                                                                @case(1)
                                                                    background-color: #8e9caf; width: 2%; color: #0c0c0c;
                                                                @break
                                                                @case(2)
                                                                    background-color: rgb(46, 205, 111); color: #ffffff; width: 2%;
                                                                @break
                                                                @case(3)
                                                                    background-color: rgb(4, 169, 244); color: #ffffff; width: 2%;
                                                                @break
                                                                @case(4)
                                                                    background-color: rgb(168, 117, 255);  color: #ffffff; width: 2%;
                                                                @break

                                                                @default

                                                                @endswitch
                                                                    " >

                                                                </th>
                                                                <th style="text-align: left; width: 50%">
                                                                    <a class="" >{{$task->t_description}}</a>
                                                                </th>

                                                                <th style="text-align: left; width: 25%">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <select class="select2" name="member[]" multiple required disabled>
                                                                                @if(!empty($project->work_group_project_stage_two))
                                                                                    @foreach($project->work_group_project_stage_two->work_group_member as $index=> $member)
                                                                                        <option value="{{$member->staff->s_id}}"
                                                                                                @foreach($task->members as $mb)
                                                                                                @if($mb->s_id==$member->staff->s_id)
                                                                                                selected
                                                                                            @endif
                                                                                            @endforeach
                                                                                        >{{$member->staff->s_name}}</option>
                                                                                    @endforeach
                                                                                @endif
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </th>
                                                                <th style="text-align: left; width: 10%">
                                                                    <div class="form-check">
                                                                        {{--                                                                        <input type="text" readonly>--}}
                                                                        {{ Form::date('start_date', $task->t_start_date, ['class' => 'form-control','readonly'=>'true', 'id' => 'start_date', 'autocomplete' => 'off']) }}
                                                                    </div>
                                                                </th>
                                                                <th style="text-align: left; width: 10%">
                                                                    <div class="form-check">
                                                                        {{ Form::date('due_date', $task->t_due_date, ['class' => 'form-control', 'id' => 'due_date','readonly'=>'true', 'autocomplete' => 'off']) }}

                                                                    </div>
                                                                </th>
                                                                <th style="text-align: left; width: 3%">
                                                                    <a class="" onclick="show_modal_add_article({{$task}})" disabled="true"><i class="fa fa-plus"></i></a>
                                                                </th>
                                                            </tr>
                                                        @endforeach

                                                        </tbody>
                                                    </table>
                                                    <hr/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @foreach($project_status as $status)
                                        @switch($status->c_id)
                                            @case(1)
                                            <div class="tab-pane" id="{{'tab_'.$status->c_id}}" role="tabpanel" aria-labelledby="{{'pills-profile-tab-'.$status->c_id}}">
                                                <div class="block block-condensed">

                                                    <div class="block-content">
                                                        <div class="body table-responsive" style="overflow-x:auto;">
                                                            <table class="table " style="border: none;" >
                                                                <thead>
                                                                <tr>
                                                                    <th colspan="1" style="text-align: left; width: 8em; font-size: small; color: #5f5f5f;">Estado</th>
                                                                    <th colspan="1" style="text-align: left; width: 8em; font-size: small; color: #5f5f5f;">Estudos</th>
                                                                    <th colspan="1" style="text-align: left; width: 8em; font-size: small; color: #5f5f5f;">Membros</th>
                                                                    <th colspan="1"  style="text-align: left; width: 8em; font-size: small; color: #5f5f5f;">Data início</th>
                                                                    <th colspan="1"  style="text-align: left; width: 8em; font-size: small; color: #5f5f5f;">Data fim</th>
                                                                    <th colspan="1"  style="text-align: left; width: 8em; font-size: small; color: #5f5f5f;">Artigo</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($project->tasks as $task)
                                                                    @if($task->t_state==$status->c_id)
                                                                        {{--                                            <div class="row" style="padding: 20px">--}}
                                                                        {{--                                                <div class="block block-condensed">--}}
                                                                        {{--                                                    <div class="block-content">--}}
                                                                        <tr id="row" >
                                                                            <th style="background-color: #8e9caf; width: 2%; color: #0c0c0c;" >

                                                                            </th>
                                                                            <th style="text-align: left; width: 50%">
                                                                                <a class="" >{{$task->t_description}}</a>
                                                                            </th>

                                                                            <th style="text-align: left; width: 25%">
                                                                                <div class="col-sm-12">
                                                                                    <div class="form-group">
                                                                                        <select class="select2" name="member[]" multiple required disabled>
                                                                                            @if(!empty($project->work_group_project_stage_two))
                                                                                                @foreach($project->work_group_project_stage_two->work_group_member as $index=> $member)
                                                                                                    <option value="{{$member->staff->s_id}}"
                                                                                                            @foreach($task->members as $mb)
                                                                                                            @if($mb->s_id==$member->staff->s_id)
                                                                                                            selected
                                                                                                        @endif
                                                                                                        @endforeach
                                                                                                    >{{$member->staff->s_name}}</option>
                                                                                                @endforeach
                                                                                            @endif
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </th>
                                                                            <th style="text-align: left; width: 10%">
                                                                                <div class="form-check">
                                                                                    {{--                                                                        <input type="text" readonly>--}}
                                                                                    {{ Form::date('start_date', $task->t_start_date, ['class' => 'form-control','readonly'=>'true', 'id' => 'start_date', 'autocomplete' => 'off']) }}
                                                                                </div>
                                                                            </th>
                                                                            <th style="text-align: left; width: 10%">
                                                                                <div class="form-check">
                                                                                    {{ Form::date('due_date', $task->t_due_date, ['class' => 'form-control', 'id' => 'due_date','readonly'=>'true', 'autocomplete' => 'off']) }}

                                                                                </div>
                                                                            </th>
                                                                            <th style="text-align: left; width: 3%">
                                                                                <a class="" onclick="show_modal_add_article({{$task}})" disabled="true"><i class="fa fa-plus"></i></a>
                                                                            </th>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach

                                                                </tbody>
                                                            </table>
                                                            <hr/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            @break
                                            @case(2)
                                            <div class="tab-pane " id="{{'tab_'.$status->c_id}}" role="tabpanel" aria-labelledby="{{'pills-profile-tab-'.$status->c_id}}">
                                                <div class="block block-condensed">

                                                    <div class="block-content">
                                                        <div class="body table-responsive" style="overflow-x:auto;">
                                                            <table class="table " style="border: none;" >
                                                                <thead>
                                                                <tr>
                                                                    <th colspan="1" style="text-align: left; width: 8em; font-size: small; color: #5f5f5f;">Estado</th>
                                                                    <th colspan="1" style="text-align: left; width: 8em; font-size: small; color: #5f5f5f;">Estudos</th>
                                                                    <th colspan="1" style="text-align: left; width: 8em; font-size: small; color: #5f5f5f;">Membros</th>
                                                                    <th colspan="1"  style="text-align: left; width: 8em; font-size: small; color: #5f5f5f;">Data início</th>
                                                                    <th colspan="1"  style="text-align: left; width: 8em; font-size: small; color: #5f5f5f;">Data fim</th>
                                                                    <th colspan="1"  style="text-align: left; width: 8em; font-size: small; color: #5f5f5f;">Artigo</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($project->tasks as $task)
                                                                    @if($task->t_state==$status->c_id)
                                                                        {{--                                            <div class="row" style="padding: 20px">--}}
                                                                        {{--                                                <div class="block block-condensed">--}}
                                                                        {{--                                                    <div class="block-content">--}}
                                                                        <tr id="row" >
                                                                            <th style="background-color: rgb(46, 205, 111); color: #ffffff; width: 2%;" >

                                                                            </th>
                                                                            <th style="text-align: left; width: 50%">
                                                                                <a class="" >{{$task->t_description}}</a>
                                                                            </th>

                                                                            <th style="text-align: left; width: 25%">
                                                                                <div class="col-sm-12">
                                                                                    <div class="form-group">
                                                                                        <select class="select2" name="member[]" multiple required disabled>
                                                                                            @if(!empty($project->work_group_project_stage_two))
                                                                                                @foreach($project->work_group_project_stage_two->work_group_member as $index=> $member)
                                                                                                    <option value="{{$member->staff->s_id}}"
                                                                                                            @foreach($task->members as $mb)
                                                                                                            @if($mb->s_id==$member->staff->s_id)
                                                                                                            selected
                                                                                                        @endif
                                                                                                        @endforeach
                                                                                                    >{{$member->staff->s_name}}</option>
                                                                                                @endforeach
                                                                                            @endif
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </th>
                                                                            <th style="text-align: left; width: 10%">
                                                                                <div class="form-check">
                                                                                    {{--                                                                        <input type="text" readonly>--}}
                                                                                    {{ Form::date('start_date', $task->t_start_date, ['class' => 'form-control','readonly'=>'true', 'id' => 'start_date', 'autocomplete' => 'off']) }}
                                                                                </div>
                                                                            </th>
                                                                            <th style="text-align: left; width: 10%">
                                                                                <div class="form-check">
                                                                                    {{ Form::date('due_date', $task->t_due_date, ['class' => 'form-control', 'id' => 'due_date','readonly'=>'true', 'autocomplete' => 'off']) }}

                                                                                </div>
                                                                            </th>
                                                                            <th style="text-align: left; width: 3%">
                                                                                <a class="" onclick="show_modal_add_article({{$task}})" disabled="true"><i class="fa fa-plus"></i></a>
                                                                            </th>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach

                                                                </tbody>
                                                            </table>
                                                            <hr/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            @break
                                            @case(3)
                                            <div class="tab-pane" id="{{'tab_'.$status->c_id}}" role="tabpanel" aria-labelledby="{{'pills-profile-tab-'.$status->c_id}}">
                                                <div class="block block-condensed">

                                                    <div class="block-content">
                                                        <div class="body table-responsive" style="overflow-x:auto;">
                                                            <table class="table " style="border: none;" >
                                                                <thead>
                                                                <tr>
                                                                    <th colspan="1" style="text-align: left; width: 8em; font-size: small; color: #5f5f5f;">Estado</th>
                                                                    <th colspan="1" style="text-align: left; width: 8em; font-size: small; color: #5f5f5f;">Estudos</th>
                                                                    <th colspan="1" style="text-align: left; width: 8em; font-size: small; color: #5f5f5f;">Membros</th>
                                                                    <th colspan="1"  style="text-align: left; width: 8em; font-size: small; color: #5f5f5f;">Data início</th>
                                                                    <th colspan="1"  style="text-align: left; width: 8em; font-size: small; color: #5f5f5f;">Data fim</th>
                                                                    <th colspan="1"  style="text-align: left; width: 8em; font-size: small; color: #5f5f5f;">Artigo</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($project->tasks as $task)
                                                                    @if($task->t_state==$status->c_id)
                                                                        {{--                                            <div class="row" style="padding: 20px">--}}
                                                                        {{--                                                <div class="block block-condensed">--}}
                                                                        {{--                                                    <div class="block-content">--}}
                                                                        <tr id="row" >
                                                                            <th style="background-color: rgb(4, 169, 244); color: #ffffff; width: 2%;" >

                                                                            </th>
                                                                            <th style="text-align: left; width: 50%">
                                                                                <a class="" >{{$task->t_description}}</a>
                                                                            </th>

                                                                            <th style="text-align: left; width: 25%">
                                                                                <div class="col-sm-12">
                                                                                    <div class="form-group">
                                                                                        <select class="select2" name="member[]" multiple required disabled>
                                                                                            @if(!empty($project->work_group_project_stage_two))
                                                                                                @foreach($project->work_group_project_stage_two->work_group_member as $index=> $member)
                                                                                                    <option value="{{$member->staff->s_id}}"
                                                                                                            @foreach($task->members as $mb)
                                                                                                            @if($mb->s_id==$member->staff->s_id)
                                                                                                            selected
                                                                                                        @endif
                                                                                                        @endforeach
                                                                                                    >{{$member->staff->s_name}}</option>
                                                                                                @endforeach
                                                                                            @endif
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </th>
                                                                            <th style="text-align: left; width: 10%">
                                                                                <div class="form-check">
                                                                                    {{--                                                                        <input type="text" readonly>--}}
                                                                                    {{ Form::date('start_date', $task->t_start_date, ['class' => 'form-control','readonly'=>'true', 'id' => 'start_date', 'autocomplete' => 'off']) }}
                                                                                </div>
                                                                            </th>
                                                                            <th style="text-align: left; width: 10%">
                                                                                <div class="form-check">
                                                                                    {{ Form::date('due_date', $task->t_due_date, ['class' => 'form-control', 'id' => 'due_date','readonly'=>'true', 'autocomplete' => 'off']) }}

                                                                                </div>
                                                                            </th>
                                                                            <th style="text-align: left; width: 3%">
                                                                                <a class="" onclick="show_modal_add_article({{$task}})" disabled="true"><i class="fa fa-plus"></i></a>
                                                                            </th>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach

                                                                </tbody>
                                                            </table>
                                                            <hr/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            @break
                                            @case(4)
                                            <div class="tab-pane " id="{{'tab_'.$status->c_id}}" role="tabpanel" aria-labelledby="{{'pills-profile-tab-'.$status->c_id}}">
                                                <div class="block block-condensed">
                                                    <div class="block-content">
                                                        <div class="body table-responsive" style="overflow-x:auto;">
                                                            <table class="table " style="border: none;" >
                                                                <thead>
                                                                <tr>
                                                                    <th colspan="1" style="text-align: left; width: 8em; font-size: small; color: #5f5f5f;">Estado</th>
                                                                    <th colspan="1" style="text-align: left; width: 8em; font-size: small; color: #5f5f5f;">Estudos</th>
                                                                    <th colspan="1" style="text-align: left; width: 8em; font-size: small; color: #5f5f5f;">Membros</th>
                                                                    <th colspan="1"  style="text-align: left; width: 8em; font-size: small; color: #5f5f5f;">Data início</th>
                                                                    <th colspan="1"  style="text-align: left; width: 8em; font-size: small; color: #5f5f5f;">Data fim</th>
                                                                    <th colspan="1"  style="text-align: left; width: 8em; font-size: small; color: #5f5f5f;">Artigo</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($project->tasks as $task)
                                                                    @if($task->t_state==$status->c_id)
                                                                        {{--                                            <div class="row" style="padding: 20px">--}}
                                                                        {{--                                                <div class="block block-condensed">--}}
                                                                        {{--                                                    <div class="block-content">--}}
                                                                        <tr id="row" >
                                                                            <th style="background-color: rgb(168, 117, 255);  color: #ffffff; width: 2%;" >

                                                                            </th>
                                                                            <th style="text-align: left; width: 50%">
                                                                                <a class="" >{{$task->t_description}}</a>
                                                                            </th>

                                                                            <th style="text-align: left; width: 25%">
                                                                                <div class="col-sm-12">
                                                                                    <div class="form-group">
                                                                                        <select class="select2" name="member[]" multiple required disabled>
                                                                                            @if(!empty($project->work_group_project_stage_two))
                                                                                                @foreach($project->work_group_project_stage_two->work_group_member as $index=> $member)
                                                                                                    <option value="{{$member->staff->s_id}}"
                                                                                                            @foreach($task->members as $mb)
                                                                                                            @if($mb->s_id==$member->staff->s_id)
                                                                                                            selected
                                                                                                        @endif
                                                                                                        @endforeach
                                                                                                    >{{$member->staff->s_name}}</option>
                                                                                                @endforeach
                                                                                            @endif
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </th>
                                                                            <th style="text-align: left; width: 10%">
                                                                                <div class="form-check">
                                                                                    {{--                                                                        <input type="text" readonly>--}}
                                                                                    {{ Form::date('start_date', $task->t_start_date, ['class' => 'form-control','readonly'=>'true', 'id' => 'start_date', 'autocomplete' => 'off']) }}
                                                                                </div>
                                                                            </th>
                                                                            <th style="text-align: left; width: 10%">
                                                                                <div class="form-check">
                                                                                    {{ Form::date('due_date', $task->t_due_date, ['class' => 'form-control', 'id' => 'due_date','readonly'=>'true', 'autocomplete' => 'off']) }}

                                                                                </div>
                                                                            </th>
                                                                            <th style="text-align: left; width: 3%">
                                                                                <a class="" onclick="show_modal_add_article({{$task}})" disabled="true"><i class="fa fa-plus"></i></a>
                                                                            </th>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach

                                                                </tbody>
                                                            </table>
                                                            <hr/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            @break
                                            @default
                                        @endswitch
                                    @endforeach

                                </div>

                            </div>
                            <div class="tab-pane" id="tabs-8">
                                <div class="row col-sm-12">
                                    <table class="table table-striped table-bordered datatable-basic">
                                        <thead>
                                        <tr>
                                            <th>Título</th>
                                            <th>Descrição</th>
                                            <th>Data de actualização</th>
                                            <th>Ficheiros</th>
                                            {{--                                            <th>Ação</th>--}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($project->articles as $article)
                                            <tr>
                                                <td>
                                                    {{$article->a_title}}
                                                </td>
                                                <td>
                                                    {{$article->a_description}}
                                                </td>
                                                {{-- <td> --}}
                                                    {{-- {{$article->updated_at}} --}}
                                                    <td>{{date('d-m-Y H:i:s', strtotime($article->updated_at))}}</td>
                                                {{-- </td> --}}
                                                <td>
                                                    <a
                                                        class="btn btn-default btn-icon"><span class="fa fa-eye"> Ver</span>
                                                    </a>
                                                </td>
                                                {{--                                                <td>--}}
                                                {{--                                                    <a--}}
                                                {{--                                                        class="btn btn-default btn-icon"><span class="fa fa-pencil"></span>--}}
                                                {{--                                                    </a>--}}
                                                {{--                                                    <a--}}
                                                {{--                                                        class="btn btn-default btn-icon"><span class="fa fa-trash"></span>--}}
                                                {{--                                                    </a>--}}
                                                {{--                                                </td>--}}
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div id="step-5">
                    @if($project->project_stage_micro->psm_level>5)
                        @if($project->project_stage_micro->psm_level==16)
                            <div class="row">
                                <div class="col-sm-12">
                                    <img src="{{asset('img/ilustrator/approved.png')}}" style="width: 90px;height: 90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                    <p class="text-center"><strong> {{translate('projecto_concluido_sucesso')}}</strong></p>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-sm-12">
                                    <img src="{{asset('img/ilustrator/rejected.png')}}" style="width: 90px;height: 90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                    <p class="text-center"><strong>{{translate('projecto_rejeitado')}}</strong></p>
                                </div>
                            </div>
                        @endif

                    @else
                        <div class="row">
                            <div class="col-sm-12">
                                <img src="{{asset('img/ilustrator/warning.png')}}" style="width: 90px;height: 90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                <p class="text-center"><strong> {{translate('aprovacao_final_ainda_feita')}}</strong></p>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- {{ dd(session('role')) }} --}}
            </div>


        </div>

    </div>
    {{-- </div> --}}
    {{-- </div> --}}

@endsection
@section('scripts')
    <script>


        $("#form_ethical_approval").submit(function (e) { 
            // e.preventDefault();
            document.getElementById("img_submitted_2").style.visibility = "visible";
            document.getElementById("btn_submit_2").style.visibility = "hidden"; 
        });

        $(document).ready(function() {

            if ($(".wizard").length > 0) {

                //check count of steps in each wizard
                $(".wizard > ul").each(function() {
                    $(this).addClass("steps_" + $(this).children("li").length);
                });


                $(".wizard").smartWizard({
                    // This part (using for wizard validation) of code can be removed FROM
                    selected: 2,
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
                if (i < project_stage) {
                    console.log(project_stage);
                    $(n).removeClass("selected").removeClass("disabled").addClass("done");
                }
            });

        });
    </script>
@endsection
