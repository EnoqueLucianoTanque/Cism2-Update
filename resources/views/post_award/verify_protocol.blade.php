@extends('layout.template')
@section('page_title_active', translate('configuracao_projecto'))
@section('user_role', session('role_name'))
@section('user_name', session('user_name'))
@section('content')

    <div class="block block-condensed">
        {{--        <div class="app-heading">--}}
        {{--            <div class="title">--}}
        {{--                <h2>Post Award</h2>--}}
        {{--                <span>Nome do projecto: <strong>{{$projects->p_name}}</strong></span>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        <div class="col-sm-12 ">
            <a class="btn btn-clean btn-icon-fixed" type="button" style="margin-top: 20px; float: right" href="{{route('configs_post_award.index')}}"><i class="fa fa-backward"></i> {{translate('voltar')}}</a>
        </div>
        <div class="block-content">
            <div class="wizard">
                <ul>

                    <li>
                        <a href="#step-1">
                            <span class="stepNumber">1</span>
                            <span class="stepDesc">Post Award<br /><small>{{translate('preparacao')}}</small></span>
                        </a>
                    </li>
                    <li>
                        <a href="#step-2">
                            <span class="stepNumber">2</span>
                            <span class="stepDesc">Post Award<br /><small>{{translate('anexar_protocolo')}}</small></span>
                        </a>
                    </li>
                    <li>
                        <a href="#step-3">
                            <span class="stepNumber">2</span>
                            <span class="stepDesc">{{translate('aprovacoes')}}<br /><small>{{translate('aprovacao_cientifica')}} </small></span>
                        </a>
                    </li>


                    <li>
                        <a href="#step-4">
                            <span class="stepNumber">3</span>
                            <span class="stepDesc">{{translate('aprovacoes')}}<br /><small>{{translate('aprovacao_etica')}}</small></span>
                        </a>
                    </li>

                    <li>
                        <a href="#step-6">
                            <span class="stepNumber">4</span>
                            <span class="stepDesc">{{translate('fase_estudo_')}}<br /><small>{{translate('fase_estudo_')}}</small></span>
                        </a>
                    </li>

                    <li>
                        <a href="#step-5">
                            <span class="stepNumber">6</span>
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
                        @if($project->project_stage_micro->psm_level==1)
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="col-sm-12">
                                        <div class="block block-condensed">
                                            <div class="app-heading">
                                                <div class="title">
                                                    <h2>{{translate('aprovacao_conformidade')}}</h2>
                                                </div>
                                            </div>
                                            <div class="block-content">
                                                {{ Form::open(['route' => ['configs_post_award.update',base64_encode($project->p_id)], 'class' => 'form-horizontal row', 'id' => 'form_reguladora_approval', 'role' => 'form', 'method' =>'PUT', 'autocomplete' => 'off', 'enctype' =>"multipart/form-data"]) }}
                                                {{ csrf_field() }}
                                                <input type="hidden" name="project_id" value="{{base64_encode($project->p_id)}}">
                                                

                                                <div class="block-content">
                                                    <div class="row col-sm-12">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="control-label" for="state">{{translate('opcoes_aprovacao')}}</label>
                                                                <select class="form-control" name="state">
                                                                    <option value=""> --{{translate('select_answer')}} --</option>
                                                                    <option value="Aprovado">{{translate('aprovado')}}</option>
                                                                    <option value="Reprovado">{{translate('reprovar')}}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="control-label" for="document">{{translate('anexar_documento')}}</label>
                                                                <input id="files" class="form-control"  name="document" accept="file_extension/.docx, .doc, .pdf" type="file" placeholder="Anexar O draft" required/>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-sm-12 text-center">
                                                        <button id="btn_submit_1" class="btn btn-primary btn-icon-fixed" type="submit" style="margin-top: 20px;"><i class="fa fa-check"></i> {{translate('submeter')}}</button>
                                                    </div>
                                                    <img id="img_submitted"  src="{{asset('assets/css/vendor/tinymce/img/loading-buffering.gif')}}" style="visibility: hidden; width: 5vw;height: 10vh;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                                </div>
                                                {{ Form::close() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            @if($project->project_stage_micro->psm_level==2)
                                @if($project->project_stage_micro->psm_id==9)
                                <div class="row">
                                    <div class="col-sm-12">
                                        <img src="{{asset('img/ilustrator/approved.png')}}" style="width: 90px;height: 90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                        <p class="text-center"><strong> {{translate('protocolo_anexado')}}</strong></p>
                                    </div>
                                </div>
                                @elseif($project->psm_id==10)
                                <div class="row">
                                    <div class="col-sm-12">
                                        <img src="{{asset('img/ilustrator/rejected.png')}}" style="width: 90px;height: 90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                        <p class="text-center"><strong> {{translate('projecto_rejeitado')}}</strong></p>
                                    </div>
                                </div>
                                @else
                                <div class="row">
                                    <div class="col-sm-12">
                                        <img src="{{asset('img/ilustrator/submitted.png')}}" style="width: 90px;height: 90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                        <p class="text-center"><strong> {{translate('projeco_submetido_aprovacao_cci')}}</strong></p>

                                    </div>
                                </div>
                                @endif
                            @else
                                @if($project->project_stage_micro->psm_level>2)
                                <div class="row">
                                    <div class="col-sm-12">
                                        <img src="{{asset('img/ilustrator/approved.png')}}" style="width: 90px;height: 90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                        <p class="text-center"><strong> O projecto foi aprovado</strong></p>
                                    </div>
                                </div>
                                @else
                                <div class="row">
                                    <div class="col-sm-12">
                                        <img src="{{asset('img/ilustrator/warning.png')}}" style="width: 90px;height: 90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                        <p class="text-center"><strong> O protocolo ainda não foi submetido</strong></p>
                                    </div>
                                </div>
                                @endif
                            @endif
                        @endif
                </div>

                <div id="step-3">
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
{{--                                    <p class="text-center"><strong> O projecto foi reprovado cientificamente</strong></p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            @endif--}}
                        @else
                                @if( $project->project_stage_micro->psm_level>3)
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <img src="{{asset('img/ilustrator/approved.png')}}" style="width: 90px;height: 90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                            <p class="text-center"><strong> O projecto foi aprovado cientificamente</strong></p>
                                        </div>
                                    </div>
                                @else
                                    @if( $project->project_stage_micro->psm_level==3 && $project->project_stage_micro->psm_id==11)
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <img src="{{asset('img/ilustrator/approved.png')}}" style="width: 90px;height: 90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                                <p class="text-center"><strong> O projecto foi aprovado cientificamente</strong></p>
                                            </div>
                                        </div>
                                    @else
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <img src="{{asset('img/ilustrator/approved.png')}}" style="width: 90px;height: 90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                                <p class="text-center"><strong> O projecto foi reprovado cientificamente</strong></p>
                                            </div>
                                        </div>
                                    @endif
                                @endif

                        @endif
                    @endif
                </div>

                <div id="step-4">
                    @if($project->project_stage_micro->psm_level>4)
                        <div class="row">
                            <div class="col-sm-12">
                                <img src="{{asset('img/ilustrator/approved.png')}}" style="width: 90px;height: 90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                <p class="text-center"><strong> O projecto foi Aprovado eticamente</strong></p>
                            </div>
                        </div>
                    @elseif($project->project_stage_micro->psm_level==4)
                        @if($project->project_stage_micro->psm_id==13)
                            <div class="row">
                                <div class="col-sm-12">
                                    <img src="{{asset('img/ilustrator/approved.png')}}" style="width: 90px;height: 90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                    <p class="text-center"><strong> O projecto foi Aprovado eticamente</strong></p>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-sm-12">
                                    <img src="{{asset('img/ilustrator/rejected.png')}}" style="width: 90px;height: 90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                    <p class="text-center"><strong> O projecto foi reprovado eticamente1</strong></p>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="row">
                            <div class="col-sm-12">
                                <img src="{{asset('img/ilustrator/warning.png')}}" style="width: 90px;height: 90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                <p class="text-center"><strong> A aprovação ética ainda não foi submetida</strong></p>
                            </div>
                        </div>
                    @endif
                </div>
                <div id="step-5">
                    @if($project->project_stage_micro->psm_level>5)
                        @if($project->project_stage_micro->psm_level==16)
                            <div class="row">
                                <div class="col-sm-12">
                                    <img src="{{asset('img/ilustrator/approved.png')}}" style="width: 90px;height: 90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                    <p class="text-center"><strong> O projecto foi concluido com sucesso</strong></p>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-sm-12">
                                    <img src="{{asset('img/ilustrator/rejected.png')}}" style="width: 90px;height: 90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                    <p class="text-center"><strong> O projecto foi rejeitado</strong></p>
                                </div>
                            </div>
                        @endif

                    @else
                        <div class="row">
                            <div class="col-sm-12">
                                <img src="{{asset('img/ilustrator/warning.png')}}" style="width: 90px;height: 90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                <p class="text-center"><strong> A aprovação final ainda não foi feita</strong></p>
                            </div>
                        </div>
                    @endif
                </div>
                <div id="step-6">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tabs-1" data-toggle="tab">{{translate('agenda_monitoria')}}</a></li>
                        <li><a href="#tabs-2" data-toggle="tab">{{translate('nao_conformidade')}}</a></li>
                    </ul>
                    <div class="tab-content tab-content-bordered">

                        <div class="tab-pane active" id="tabs-1">
                            <div class="block block-condesend">
                                <div class="app-heading app-heading-small">
                                    <div class="col-lg-6 title">
                                        <h5> {{translate('agenda_monitoria')}}</h5>
                                    </div>
                                </div>
                                <div>
                                    @if(count($monitoring_plan)==0)
                                <div>
                                    <p>{{translate('no_record')}}</p> 
                                </div>
                                @endif
                                </div>
                                <div class="text-center">
                                    <button
                                    type="button"
                                    class="btn btn-primary"
                                    data-toggle="modal"
                                    data-target="#modal-plano-monitoria"
                                    > <span class="fa fa-plus"> </span> {{translate('agenda_monitoria')}}
                                </button>                                            
                                </div> 
                                
                            </div>
                            <div class="block-content">
                                @if(count($monitoring_plan)>0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <th>#</th>
                                            <th>{{translate('data_submissao')}}</th>
                                            <th>{{translate('data_monitoria')}}</th>
                                            <th>{{translate('document')}}</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($monitoring_plan as $key => $plan)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                {{-- <td>{{$plan->created_at}}</td> --}}
                                                <td>{{date('d-m-Y H:i:s', strtotime($plan->created_at))}}</td>
                                                {{-- <td>{{$plan->pmp_monitoring_date}}</td> --}}
                                                <td>{{date('d-m-Y H:i:s', strtotime($plan->pmp_monitoring_date))}}</td>
                                                <td>
                                                    <a href="{{asset('docs').'/'.$plan->pmp_monitoring_schedule_document_path}}" target="_blank" class="btn btn-link">{{translate('agenda_monitoria')}} <span class="icon-download" ></span> </a>
                                                </td>
                                            </tr>   
                                                
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @else   
                                <div class="row">
                                    {{-- <div class="col-sm-12">
                                        <img src="{{asset('img/ilustrator/warning.png')}}"
                                            class="img-responsive center-block d-block mx-auto"
                                            height="80px"
                                            width="80px"
                                            alt="Sample Image">
                                        <p class="text-center">{{translate('no_record')}}</p>
                                    </div> --}}
                                </div>
                                @endif                                
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-2">
                            <div class="row">
                                <div class="block block-condensed">
                                    <div class="app-heading app-heading-small">
                                        <div class="col-lg-6 title">
                                            <h5> {{translate('relatorio_submetido')}}</h5>
                                        </div>
                                    </div>
        
                                    <div class="block-content">
                                        @if(count($project_conformities) > 0)
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered datatable-extended">
                                                <thead>
                                                    <th>#</th>
                                                    <th>{{translate('nao_conformidade')}}</th>
                                                    <th>{{translate('registado_pelo')}}</th>
                                                    <th>{{translate('data_submissao')}}</th>
                                                    <th>{{translate('relatorio')}}</th>
                                                    
                                                </thead>
                                                <tbody>
        
                                                    @foreach($project_conformities as $key => $conformity)
                                                        <tr>
                                                            <td>{{$key+1}}</td>
                                                            <td>
                                                                <ul>
                                                                    <li>{{$conformity->c_description}}</li>
                                                                </ul>
                                                            </td>
                                                            <td>{{$conformity->s_name}}</td>
                                                            {{-- <td>{{$conformity->created_at}}</td> --}}
                                                            <td>{{date('d-m-Y H:i:s', strtotime($conformity->created_at))}}</td>
                                                            <td>
                                                                @if(count($conformity_report) > 0)
                                                                <ul>
                                                                    @foreach ($conformity_report as $report)
                                                                        <li> <a href="{{asset("docs").'/'.$report->dp_local_path}}" target="_blank" rel="noopener noreferrer" class="btn btn-link"> <span class="fa fa-download "></span> </a> </li>
                                                                    @endforeach
                                                                </ul>
                                                                @endif
                                                                
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
        
                                        @else
                                        <div>
                                            <p>{{translate('no_record')}}</p> 
                                        </div>
                                        @endif
                                        <div class="row text-center">
                                            <div class="col-sm-6">
                                                <button
                                                type="button"
                                                class="btn btn-primary"
                                                data-toggle="modal"
                                                data-target="#modal-nao-conformidade"
                                                id="btn_nao_conformidade"
                                                > <span class="fa fa-plus"> </span> {{translate('nao_conformidade')}}
                                            </button>
                                            </div>
                                    </div>
        
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    

                </div>

                {{-- {{ dd(session('role')) }} --}}
            </div>


        </div>

    </div>
    {{-- </div> --}}
    {{-- </div> --}}

    <div class="modal fade" id="modal-plano-monitoria" tabindex="-1" role="dialog" aria-labelledby="modal-success-header">
        <div class="modal-dialog modal-success" role="document">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>

            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-success-header">{{translate('adicionar_plano_monitoria')}}</h4>
                </div>
                <form action="{{route('agenda_monitoria_tarefa.store')}}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                        @csrf
                        <input type="hidden" name="p_id" value="{{base64_encode($project->p_id)}}">
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{translate('data_monitoria')}}</label>
                            <div class="col-md-9">
                                <input type="date" class="form-control" name="data_monitoria" id="data_monitoria" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{translate('agenda_monitoria')}}</label>
                            <div class="col-md-9">
                                <input type="file" name="agenda" id="" accept="file_extension/.docx, .doc, .pdf, .csv,.xlsx,.xls" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">{{translate('fechar')}}</button>
                        <button type="submit" class="btn btn-success"> <span class="fa fa-floppy-o"></span> {{translate('adicionar')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal-nao-conformidade-task" tabindex="-1" role="dialog" aria-labelledby="modal-success-header">
        <div class="modal-dialog modal-success" role="document">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>

            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-success-header">{{translate('adicionar_relatorio_actividade')}}</h4>
                </div>
                <form action="{{route('conformity.store')}}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                        @csrf
                        <input type="hidden" name="p_id" value="" id="p_id">
                        <input type="hidden" name="tasks_id_" value="" id="tasks_id">
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{translate('relatorio_actividade')}}</label>
                            <div class="col-md-9">
                                <input type="file" class="form-control" name="relatorio_atividade" id="" accept="file_extension/.docx, .doc, .pdf, .csv,.xlsx,.xls" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{translate('agenda_monitoria')}}</label>
                            <div class="col-md-9">
                                <select name="conformity[]" class="bs-select" title="Selecione as não conformidades" multiple>
                                    @foreach($conformities as $conformity)
                                        <option value="{{$conformity->c_id}}">{{$conformity->c_description}}</option>
                                    @endforeach
                                </select>
                                {{-- <input type="file" name="agenda" id="" accept="file_extension/.docx, .doc, .pdf, .csv,.xlsx,.xls" class="form-control" required> --}}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">{{translate('fechar')}}</button>
                        <button type="submit" class="btn btn-success"> <span class="fa fa-floppy-o"></span> {{translate('adicionar')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-nao-conformidade" tabindex="-1" role="dialog" aria-labelledby="modal-success-header">
        <div class="modal-dialog modal-success" role="document">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>

            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-success-header">{{translate('adicionar_relatorio_actividade')}}</h4>
                </div>
                <form action="{{route('conformity_project.store')}}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                        @csrf
                        <input type="hidden" name="p_id" value="{{base64_encode($project->p_id)}}">
                        {{-- <input type="hidden" name="tasks_id_" value="" id="tasks_id"> --}}
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{translate('relatorio_actividade')}}</label>
                            <div class="col-md-9">
                                <input type="file" class="form-control" name="relatorio_atividade" id="" accept="file_extension/.docx, .doc, .pdf, .csv,.xlsx,.xls" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{translate('nao_conformidade')}}</label>
                            <div class="col-md-9">
                                <select name="conformity[]" class="bs-select" title="{{translate('selecione_nao_conformidade')}}" multiple>
                                    @foreach($conformities as $conformity)
                                        <option value="{{$conformity->c_id}}">{{$conformity->c_description}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">{{translate('fechar')}}</button>
                        <button type="submit" class="btn btn-success"> <span class="fa fa-floppy-o"></span> {{translate('adicionar')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        let post_award_doc = "{{route('post_award_doc.store')}}";
        let project_stage = parseInt("{{$project->psm_id}}");

        function form_wizard_selected(project_stage){
            // let temp = 0;
            // console.log( project_stage);
            if(project_stage == 5){
                // console.log(project_stage - 5);
                return project_stage - 4
            }
            if(project_stage > 5 && project_stage <= 10){
                // console.log( project_stage -= 4);
                return project_stage - (project_stage - 1)
            }
            if(project_stage == 18){
                return project_stage - (project_stage - 1);
            }
            else if(project_stage == 13){
                return project_stage - (project_stage - 4)
            }
            else if(project_stage >= 10 && project_stage <= 14){
                return project_stage - (project_stage - 3)
            }
            else if(project_stage = 15){
                return project_stage - (project_stage - 4)
            }
            else if(project_stage = 16){
                return project_stage - (project_stage - 2)
            }
           else{
                return project_stage - (project_stage - 3);
            }

        }
        $("#form_reguladora_approval").submit(function(e){
            document.getElementById("img_submitted").style.visibility = "visible";
            document.getElementById("btn_submit_1").style.visibility = "hidden";
        });  

        $("#btn_show_modal").on("click", function(e){
            e.preventDefault();
            // alert('Teste');
            var task_id = $(this).attr("id-task");
            var start_date = $(this).attr("start-date");
            $("#task_id").val(task_id);
            $("#data_monitoria").attr("min", start_date);

        });
        $("#btn_nao_conformidade").on("click", function(e){
            e.preventDefault();
            // alert('Teste');
            var p_id = $(this).attr("p-id");
            var t_id = $(this).attr("id-tasks");
            $("#p_id").val(p_id);
            $("#tasks_id").val(t_id);
        });

        $("form#post_form_award_doc_draft").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: post_award_doc,
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
                    message=data.message;
                    if (typeof data.message === 'object' && data.message !== null){
                        message=JSON.stringify(data.message);

                    }
                    if (data.state==200) {
                        swal({
                            title: "Sucesso",
                            text: message,
                            icon: "success",
                            button: "Confirmar"
                        }).then(function () {
                            location.reload();
                        })
                    } else {
                        swal({
                            title: "Erro!",
                            text: message,
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
        $(document).ready(function() {

            if ($(".wizard").length > 0) {

                //check count of steps in each wizard
                $(".wizard > ul").each(function() {
                    $(this).addClass("steps_" + $(this).children("li").length);
                });


                $(".wizard").smartWizard({
                    // This part (using for wizard validation) of code can be removed FROM
                    selected: form_wizard_selected(project_stage),
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
                                obj.parents(".wizard").find(".actionBar .btn-success").css("display",
                                    "block");
                            }
                        }

                        app.spy();

                        return true;
                    }, // ./end

                });


            }

            $.each($('.wizard  ul a'), function(i, n) {
                if (i < form_wizard_selected(project_stage)) {
                    // console.log(project_stage);
                    $(n).removeClass("selected").removeClass("disabled").addClass("done");
                }
            });

        });
    </script>
@endsection
