@extends('layout.template')
@section('page_title', 'Preparation: '.translate('anexar_documento'))
@section('user_role', session('role_name'))
@section('user_name', session('user_name'))
@section('page_title_active', translate('configuracao_projecto'))
@section('page_name', 'Post award')
@section('content')

    <div class="block block-condensed">
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
                            <span class="stepDesc">{{translate('aprovacoes')}}<br /><small>{{translate('aprovacao_cientifica')}} </small></span>
                        </a>
                    </li>


                    <li>
                        <a href="#step-3">
                            <span class="stepNumber">3</span>
                            <span class="stepDesc">{{translate('aprovacoes')}}<br /><small>{{translate('aprovacao_cci')}}</small></span>
                        </a>
                    </li>
                    <li>
                        <a href="#step-4">
                            <span class="stepNumber">3</span>
                            <span class="stepDesc">{{translate('aprovacoes')}}<br /><small>{{translate('aprovacao_etica')}}</small></span>
                        </a>
                    </li>

                    <li>
                        <a href="#step-5">
                            <span class="stepNumber">4</span>
                            <span class="stepDesc">{{translate('fase_estudo_')}}<br /><small>{{translate('fase_estudo_')}}</small></span>
                        </a>
                    </li>

                    <li>
                        <a href="#step-6">
                            <span class="stepNumber">5</span>
                            <span class="stepDesc">{{translate('fase_final')}}<br /><small>{{translate('aprovacao_final')}}</small></span>
                        </a>
                    </li>
                </ul>

                <div id="step-1">
                    @if($project->project_stage_micro->psm_level<=2)
                        <h4 class="text-uppercase text-bold text-rg heading-line-middle" style="color: #272c40!important;">&nbsp;<span >{{translate('anexar_documento')}}</span></h4>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-6">
                                    <div class="block block-condensed">

                                        <div class="block-content">
                                            {{ Form::open(['route' => empty($consortium)?['post_award_doc.store',]:['post_award_doc.update',base64_encode($consortium->dp_id)], 'class' => 'form-horizontal row', 'id' => 'update_doc_consortium', 'role' => 'form', 'method' => empty($consortium)?'POST':'PUT', 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'enctype' =>"multipart/form-data"]) }}
                                            {{ csrf_field() }}
                                            <input type="hidden" name="project_id" value="{{base64_encode($project->p_id)}}">

                                            <div class="block-content">
                                                <div class="row col-sm-12">
                                                    <div class="col-sm-6" hidden>
                                                        <div class="form-group" >
                                                            <label class="control-label">{{translate('tipo_documento')}}</label>
                                                            <select class="select2" name="document_type" data-live-search="true">
                                                                @foreach ($document_types as $doc_type)
                                                                    <option value="{{ $doc_type->dt_id}}" {{($doc_type->dt_id==6)?'selected':''}}>{{ $doc_type->dt_name }}</option>
                                                                @endforeach
                                                                {{--                                                            <span class="help-block">Add key words to options to improve their searchability</span>--}}
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            @if(!empty($consortium))
                                                                <a href="{{ asset('docs/'.$consortium->dp_local_path) }}">{{$consortium->dp_name}}</a>
                                                            @else
                                                                <label class="control-label">{{translate('consortium_agreement_nao_anexado')}}</label>
                                                            @endif
                                                            <input id="files" class="form-control" onchange="update_data({{'"'."Consortium Agreement" .'"'}},{{'"'.'update_doc_consortium'.'"'}},'Consortium')"  name="document" accept="file_extension/.docx, .doc, .pdf" type="file"/>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row col-sm-12" hidden>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="control-label">{{translate('nome')}}</label>
                                                            <input class="form-control input-sm" value="Consortium Agreement" name="document_name" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="control-label">{{translate('descricao')}}</label>
                                                            <textarea class="form-control input-sm" name="document_description" type="text">{{translate('consortium_agreement')}}</textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-sm-12 text-center" hidden>
                                                    <button class="btn btn-primary btn-icon-fixed" type="submit" style="margin-top: 20px;"><i class="fa fa-plus-circle"></i> {{translate('novo_documento')}}</button>
                                                </div>
                                            </div>
                                            {{ Form::close() }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="block block-condensed">
                                        <div class="block-content">
                                            {{ Form::open(['route' => empty($draft)?['post_award_doc.store',]:['post_award_doc.update',base64_encode($draft->dp_id)], 'class' => 'form-horizontal row', 'id' => 'update_doc_draft', 'role' => 'form', 'method' => empty($draft)?'POST':'PUT', 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'enctype' =>"multipart/form-data"]) }}
                                            {{ csrf_field() }}
                                            <input type="hidden" name="project_id" value="{{base64_encode($project->p_id)}}">

                                            <div class="block-content">
                                                <div class="row col-sm-12">
                                                    <div class="col-sm-6" hidden>
                                                        <div class="form-group" >
                                                            <label class="control-label">Tipo de Documento</label>
                                                            <select class="select2" name="document_type" data-live-search="true">
                                                                @foreach ($document_types as $doc_type)
                                                                    <option value="{{ $doc_type->dt_id}}" {{($doc_type->dt_id==7)?'selected':''}}>{{ $doc_type->dt_name }}</option>
                                                                @endforeach
                                                                {{--                                                            <span class="help-block">Add key words to options to improve their searchability</span>--}}
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            @if(!empty($draft))
                                                                <a href="{{ asset('docs/'.$draft->dp_local_path) }}">{{$draft->dp_name}}</a>
                                                            @else
                                                                <label class="control-label">{{translate('draft_nao_anexado')}}</label>
                                                            @endif
                                                            <input id="files" class="form-control" onchange="update_data({{'"'."Draft" .'"'}},{{'"'.'update_doc_draft'.'"'}},'Draft')" name="document" accept="file_extension/.docx, .doc, .pdf" type="file" placeholder="Anexar O draft"/>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row col-sm-12" hidden>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Nome</label>
                                                            <input class="form-control input-sm" value="Draft protocol" name="document_name" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Descrição</label>
                                                            <textarea class="form-control input-sm" name="document_description" type="text">Draft protocol</textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-sm-12 text-center" hidden>
                                                    <button class="btn btn-primary btn-icon-fixed" type="submit" style="margin-top: 20px;"><i class="fa fa-plus-circle"></i> Novo documento</button>
                                                </div>
                                            </div>
                                            {{ Form::close() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
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
                                            <label class="control-label">{{translate('descricao')}}</label>
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" cols="4" rows="6" disabled>{{$project->p_description}}</textarea>
                                        </div>
                                        {{--                                        <div class="listing margin-bottom-0">--}}
                                        {{--                                            <div class="listing-item listing-item-with-icon">--}}


                                        <div class="list-group list-group-inline">
                                            <div class="list-group-item col-md-4 col-sm-4" style="max-height: 80px; min-height: 80px;">
                                                <span class="text-bold">{{translate("pagina_projecto")}} </span><br>
                                                <span class="text-muted"><a target="_blank" href="{{ $project->p_web_url}}" class="" ><span class="fa fa-chrome"></span> {{ $project->p_name}}</a></span>
                                            </div>
                                            <div class="list-group-item col-md-4 col-sm-4" style="max-height: 80px; min-height: 80px;">
                                                <span class="text-bold">{{translate('data_submissao')}}</span><br>
                                                <span class="text-muted">{{ $project->p_submitted_at}}</span>
                                            </div>
                                            <div class="list-group-item col-md-4 col-sm-4" style="max-height: 80px; min-height: 80px;">
                                                <span class="text-bold">{{translate('data_termino')}}</span><br>
                                                <span class="text-muted text-danger">{{ $project->p_deadline}}</span>
                                            </div>

                                        </div>
                                    </div>

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
                                                            <span class="text-bold">{{translate('financiamento_necessario')}}</span><br>
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
                            {{-- <div class="col-md-3"> --}}
                                <div class="row">
                                <div class="block block-condensed">

                                    @foreach($project->documentsProject as $document)
                                            <div class="col-md-3">

                                                <div class="app-heading">
                                                    <div class="title">
                                                        <strong style="display:inline-block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 20ch;">{{translate($document->dp_description)}}</strong>
                                                    </div>
                                                </div>
                                                <div class="block-content">
                                                    <a style="display:inline-block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 20ch;" href="{{ asset('docs/'.$document->dp_local_path) }}"><span class="icon-download"></span> {{translate('baixar')}}</a>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    {{-- </div> --}}
                            </div>
                            @else
                                <div class="row">
                                    <div class="col-sm-12">
                                        <img src="{{asset('img/ilustrator/no_data.svg')}}" style="width:90px;height:90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                        <p class="text-center"><strong>{{translate('no_record')}}</strong></p>
                                    </div>
                                </div>
                            @endif
                        </div>
                </div>
{{-- {{dd($ur_document)}} --}}
                <div id="step-2">

                    @if($project->project_stage_micro->psm_level==2)
                        @if($project->project_stage_micro->psm_id==9)
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="text-center">
                                        <div class="title">
                                            <h3>{{translate('projecto_validado_unidade_reguladora')}}</h3>
                                            
                                            <a href="{{ asset('docs/' . $ur_document->dp_local_path) }}" target="_blanck"><span class="fa fa-print">{{translate('clique_aqui')}} </span></a><span> {{translate('para_baixar_doc_anexado_ur')}}</span> <br>
                                        </div>

                                    </div>
                                    <div class="col-sm-12" style="margin-top: 20px">
                                        <span>{{translate('submeta_protocolo_para_avaliacao_tecnica_cientifica')}}</span>
                                        <form id="form_protocol_submit" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="p_id" value="{{base64_encode($project->p_id)}}">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">{{translate('protocolo')}}</label>
                                                            <div class="col-md-10">
                                                                <input class="form-control input-sm" name="protocol_document" type="file" accept="file_extension/.docx, .doc, .pdf" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <button id="btn_submit_1" class="btn btn-primary btn-icon-fixed" type="submit"><i class="fa fa-check"></i> {{translate('submeter')}} </button>
                                                    </div>
                                                    <img id="img_submitted"  src="{{asset('assets/css/vendor/tinymce/img/loading-buffering.gif')}}" style="visibility: hidden; width: 5vw;height: 10vh;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">

                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>

                            </div>
                        @elseif($project->psm_id==10)
                            <div class="row">
                                <div class="col-sm-12">
                                    <img src="{{asset('img/ilustrator/rejected.png')}}" style="width:90px;height:90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                    <p class="text-center"><strong> {{translate('projecto_rejeitado_unidade_reguladora')}}</strong></p>
                                </div>
                                <div class="text-center">
                                    {{-- <a href="{{ asset('docs/' . $ur_document->dp_local_path) }}">aprovação de conformidade</a> --}}
                                </div>

                            </div>
                        @else
                            <div class="col-sm-12">
                                <img src="{{asset('img/ilustrator/submitted.png')}}" style="width:90px;height:90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                <p class="text-center"><strong> {{translate('protocolo_submetido_aprovacao')}}</strong></p>
                            </div>
                            <div class="text-center">
                                <a href="{{ asset('docs/' . $ur_document->dp_local_path) }}">{{translate('carta_resposta_unidade_reguladora')}}</a>
                            </div>
                        @endif
                    @else
                        @if($project->project_stage_micro->psm_level<2)
                            <div class="row">
                                <div class="col-sm-12">
                                    <img src="{{asset('img/ilustrator/warning.png')}}" style="width: 90px;height: 90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                    <p class="text-center"><strong> {{translate('o_protocolo_ainda_submetido')}}</strong></p>
                                </div>

                            </div>

                        @else
                            @if( $project->project_stage_micro->psm_level>3)
                                <div class="row">
                                    <div class="col-sm-12">
                                        <img src="{{asset('img/ilustrator/approved.png')}}" style="width: 90px;height: 90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                        <p class="text-center"><strong> O projecto foi aprovado cientificamente</strong></p>
                                    </div>
                                    <div class="text-center">
                                        {{-- {{dd($ur_document)}} --}}
                                        {{-- <a href="{{ asset('docs/' . $ur_document) }}">aprovação de conformidade</a> --}}
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
                                            <button data-toggle="modal"
                                            data-target="#modal-scientific_approval" type="button" class="btn btn-success" style="float: right"> <span class="fa fa-plus"></span> {{translate('submeter_novamente')}}</button>
                                        </div>
                                        <div class="col-sm-12">
                                            @if(!empty($cc_document->dp_local_path))
                                                <img src="{{asset('img/ilustrator/rejected.png')}}" style="width: 90px;height: 90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                                <p class="text-center"><strong> {{translate('projecto_rejeitado')}} <a href="{{ asset('docs/' . $cc_document->dp_local_path) }}" target="_blanck">
                                                    <span class="fa fa-print">{{translate('clique_aqui')}}</span>
                                                </a>
                                                {{translate('para_baixar_doc_anexado_pi_')}}.</strong></p>
                                            @else
                                            <div class="text-center">
                                                <h5 style="color: red; ">{{translate("nenhum_documento_anexado")}}</h5>

                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endif

                        @endif
                    @endif
                </div>
                <div id="step-3">
                    <div class="row">
                        @if($project->project_stage_micro->psm_level === 3)
                            @if($project->psm_id == 11) 
                            @if(!empty($cc_document))
                                <p class="text-center">
                                    <strong>
                                        O Comité Científico Interno aprovou o projeto
                                        <a href="{{ asset('docs/' . $cc_document->dp_local_path) }}" target="_blanck">
                                            <span class="fa fa-print">Clique aqui </span>
                                        </a>
                                         para baixar o documento anexado.
                                    </strong>
                                </p>
                            @endif
                            @endif
                        @elseif ($project->project_stage_micro->psm_level === 2)
                            @if($project->psm_id===22)
                            <div class="col-sm-12">
                                <img src="{{asset('img/ilustrator/submitted.png')}}" style="width:90px;height:90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                <p class="text-center"><strong> {{translate('projeco_submetido_aprovacao_cci')}}</strong></p>
                            </div>
                           
                            @else   
                            @if(!empty($cc_document))
                                <p class="text-center">
                                    <strong>
                                        {{translate('cci_rejeitou')}}
                                        <a href="{{ asset('docs/' . $cc_document->dp_local_path) }}" target="_blanck">
                                            <span class="fa fa-print"> {{translate('clique_aqui')}}</span>
                                        </a>
                                        {{translate('baixar_documento')}}
                                    </strong>
                                </p>
                            @endif

                            @endif
                        @endif

                    </div>
                </div>
                {{-- {{dd($ethical_document)}} --}}
                <div id="step-4">
                    @if($project->project_stage_micro->psm_level== 4)
                        @if($project->psm_id==13)

                        <div class="row">
                            <div class="col-sm-12">
                                <img src="{{asset('img/ilustrator/approved.png')}}" style="width:90px;height:90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                    <p class="text-center"><strong> </strong></p>
                                </div>
                                <div class="col-sm-12 text-center">
                                    <a href="{{ asset('docs/' . $ethical_document->dp_local_path) }}" target="_blanck" class="btn btn-link" style="font-size: 24pt">
                                        <span class="fa fa-print"> {{$ethical_document->dp_name}}</span>
                                    </a>
                                </div>
                            </div>
                        @else   
                            <div class="row">
                                <div class="col-sm-12">
                                    <button data-toggle="modal"
                                        data-target="#modal-ethical_approval" type="button" class="btn btn-success" style="float: right"> <span class="fa fa-refresh"></span> {{translate('submeter_novamente')}}</button>
                                </div>
                                <div class="col-sm-12">
                                    <img src="{{asset('img/ilustrator/rejected.png')}}" style="width:90px;height:90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                    <p class="text-center"><strong> {{translate('projecto_rejeitado')}}</strong></p> 
                                </div>
                                <div class="col-sm-12 text-center">
                                    @if(!empty($ethical_document->dp_local_path))
                                        <a href="{{ asset('docs/' . $ethical_document->dp_local_path) }}" target="_blanck" class="btn btn-link" style="font-size: 24pt">
                                            <span class="fa fa-print"> {{translate('clique_aqui')}}</span>
                                        </a>
                                        {{translate('para_baixar_doc_anexado_pi_')}} <br>
                                    @else
                                        <h5>{{translate("nenhum_documento_anexado")}}</h5>
                                    @endif
                                </div>
                            </div>
                        @endif  
                        

                    @elseif($project->psm_id == 11 && $project->project_stage_micro->psm_level == 3)
                        <div class="row" style="">

                            <div class="text-center">
                                {{translate('cci_aprovou_projecto_')}}
                                    <a href="{{ asset('docs/' . $cc_document->dp_local_path) }}" target="_blanck">
                                        <span class="fa fa-print">{{translate('clique_aqui')}} </span>
                                    </a>
                                     {{translate('para_baixar_doc_anexado_pi_')}} <br>
                                <h5>{{translate('formulario_submissao_cibs')}}</h5>

                            {{ Form::open([ 'class' => 'form-horizontal row', 'id'=>'form_cibs', 'role' => 'form', 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'enctype' =>"multipart/form-data"]) }}
                                @csrf
                                <input type="hidden" name="p_id" value="{{base64_encode($project->p_id)}}">
                                <div class="row">
                                    <label class="col-md-2 control-label">{{translate('protocolo')}}</label>
                                    <div class="col-md-6">
                                        <input class="form-control input-sm" name="protocolo" type="file" accept="file_extension/.docx, .doc, .pdf" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-2 control-label">{{translate('apendice')}}</label>
                                    <div class="col-md-6">
                                        <input class="form-control input-sm" name="apendice[]" type="file" accept="file_extension/.docx, .doc, .pdf" required>
                                    </div>
                                </div>
                                <div class="row apendice" style="margin-top: 4px;">
                                    
                                </div>
                                <div class="row">
                                    <div class="text-center" style="margin-top:2.5vh;">
                                        <button type="button"  onclick="new_apendice()" class="btn btn-success"> <span class="fa fa-plus" ></span> {{translate('novo_apendice')}}</button>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button id="btn_submit_2" class="btn btn-primary btn-icon-fixed" type="submit" style="margin-top: 20px;"><i class="fa fa-check"></i> {{translate('submeter')}} </button>
                                    <img id="img_submitted_2"  src="{{asset('assets/css/vendor/tinymce/img/loading-buffering.gif')}}" style="visibility: hidden; width: 5vw;height: 10vh;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                </div>
                            </form>
                        </div>
                        {{ Form::close() }}
                    </div>
                    {{-- @elseif($project->psm_id== 19) --}}
                    @elseif($project->project_stage_micro->psm_level == 5)
                        <div class="row">
                            <img src="{{asset('img/ilustrator/approved.png')}}" style="width:90px;height:90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                    <p class="text-center"><strong> {{translate('projecto_submetido_para_cibs')}}</strong></p>

                        </div>
                    @endif
                    @if($project->psm_id == 23)
                    <div class="block block-condesend">
                        <div class="app-heading app-heading-small">
                            <div class="title">
                                <h2>{{translate('alterar_estado_projecto')}} <span class="label label-primary label-bordered"></span> </h2>
                                {{-- <h3>Estado actual: <span class="label label-success label-bordered"></span></h3> --}}
                            </div>
                        </div>
                        <div class="text-center">
                            <button data-target="#comite_externo" data-toggle="modal" type="button" class="btn btn-primary" > <span class="fa fas-fresh"> </span>{{translate('submeter_comite_externo')}}</button>
                        </div>
                    </div>
                    @endif
                </div>

                <div id="step-5">
                    <div>
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tabs-7" data-toggle="tab">Gestão de estudos</a></li>
                            <li><a href="#tabs-8" data-toggle="tab">Gestão de Artigos</a></li>
                            <li><a href="#tabs-9" data-toggle="tab">Gestão dos membros</a></li>
                        </ul>
                        <div class="tab-content tab-content-bordered">

                            <div class="tab-pane active" id="tabs-7">
                                <h3 class="font-bold " style="font-size: 18px; color: #016428;"><span class="" style="color: #016428;">(*)</span>Seleccione um estado para ver os estudos em andamento</h3>

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
                                                                    <th colspan="1"  style="text-align: left; width: 8em; font-size: small; color: #5f5f5f;">Agenda de monitoria</th>
                                                                    <th colspan="1"  style="text-align: left; width: 8em; font-size: small; color: #5f5f5f;">Não conformidade</th>
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
                                                                            <th>
                                                                                @if(!empty($task->agenda_monitoria))
                                                                                    <a href="{{asset('docs').'/'.$task->agenda_monitoria->tmp_monitoring_schedule_document_path}}" target="_blank" rel="noopener noreferrer" class="btn btn-link">
                                                                                        <span class="fa fa-print">Agenda de monitoria</span>
                                                                                    </a>
                                                                                @else
                                                                                    A UR ainda não submeteu a agenda de monitoria
                                                                                @endif
                                                                            </th>
                                                                            <th>
                                                                                @if(count($task->task_conformities)>0)
                                                                                <ul>
                                                                                    @foreach($task->task_conformities as $conformity)
                                                                                        <li>{{$conformity->c_description}}</li>
                                                                                    @endforeach
                                                                                </ul>
                                                                                @else
                                                                                    Nenhuma não conformidade foi encotrada
                                                                                @endif
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
                                            {{-- <th>Descrição</th> --}}
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
                                                {{-- <td>
                                                    {{$article->a_description}}
                                                </td> --}}
                                                <td>
                                                    {{$article->updated_at}}
                                                </td>
                                                <td>
                                                    @if(!empty($article->files))
                                                    <ul>
                                                        @foreach($article->files as $file)
                                                            <li><a target="_blank" href="{{asset('docs').'/'.$file->f_path}}" class="btn-link"><span class="icon-download"> {{translate('baixar')}}</span></a></li>
                                                        @endforeach
                                                    </ul>
                                                    @else
                                                        Nenhum ficheiro foi encontrado

                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="tab-pane" id="tabs-9">
                                @if($project->psm_id >= 13 && $project->psm_id < 15)
                                {{-- @if($project->psm_id ==5 ) --}}
                                <div class="block block-condensed">
                                    <div class="row">
                                        <div class="text-center" style="margin-top:20px;">
                                            <button
                                                type="button"
                                                class="btn btn-primary"
                                                data-toggle="modal"
                                                data-target="#modal-info">
                                                <span class="fa fa-plus"></span> Novo membro
                                            </button>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <div class="app-heading app-heading-small">
                                            <div class="title">
                                                <h5>Lista de membros do grupo de trabalho</h5>
                                            </div>
                                            <div class="heading-elements">
                                                <div class="btn-group">
                                                    <button class="btn btn-primary btn-icon-fixed dropdown-toggle" data-toggle="dropdown"><span class="fa fa-bars"></span> Export Data</button>
                                                    <ul class="dropdown-menu dropdown-left">
                                                        <li class="divider"></li>
                                                        <li><a href="#" onClick ="$('#sortable-data').tableExport({type:'excel',escape:'false'});"><img src='{{asset('img/icons/xls.png')}}' width="24"> XLS</a></li>
                                                        <li><a href="#" onClick ="$('#sortable-data').tableExport({type:'csv',escape:'false'});"><img src='{{asset('img/icons/csv.png')}}' width="24"> CSV</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#" onClick ="$('#sortable-data').tableExport({type:'pdf',escape:'false'});"><img src='{{asset('img/icons/pdf.png')}}' width="24"> PDF</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END HEADING -->

                                        <div class="block-content">

                                            <table class="table" id="sortable-data">
                                                <th>Nome</th>
                                                <th>Função</th>
                                                <th>Ação</th>
                                            </thead>

                                            <tbody>
                                                @if(!empty($project->work_group_project_stage_two))
                                                @foreach($project->work_group_project_stage_two->work_group_member as $index=> $member)
                                                    <tr>
                                                        <td>{{$member->staff->s_name}}</td>
                                                        <td>
                                                            {{-- <td>  --}}
                                                                @foreach ($member->member_roles as $member_role)
                                                                    @foreach ($member_role->member_role as $member)
                                                                        <ul>
                                                                            <li>{{$member->wgr_name}}</li>
                                                                        </ul>

                                                                    @endforeach
                                                                @endforeach
                                                        </td>
                                                        <td>
                                                            <button
                                                                data-toggle="modal"
                                                                data-target="#modal-danger"
                                                                {{-- user-name="{{$user->staff->s_name}}"
                                                                user-id="{{base64_encode($user->u_id)}}" --}}
                                                                class="btn btn-danger delete_user">
                                                                <span class="fa fa-user-times"></span>
                                                            </button>
                                                            <button
                                                                data-toggle="modal"
                                                                data-target="#modal-update"
                                                                {{-- user-id="{{base64_encode($user->u_id)}}"
                                                                user-name="{{$user->staff->s_name}}"
                                                                user-email="{{$user->email}}"
                                                                user-role="{{!empty($user->roles)?$user->roles->r_description:"não definido"}}"
                                                                user-contact="{{!empty($user->staff_contacts)?$user->staff_contacts->sc_contact:"nenhum contacto encontrado"}}" --}}
                                                                class="btn btn-info update_role"
                                                                ><span class="fa fa-refresh"></span>
                                                            </button>
                                                            {{-- <button type="button" class="btn btn-secondary" onclick="remove_row({{(int)$index}});" style="background-color: #7fad39!important; color:white!important;" data-dismiss="modal" {{session('role')==1? '':'disabled'}}><i class="fa fa-remove" style="color: white"></i></button> </td> --}}
                                                    </tr>
                                                @endforeach

                                            @endif

                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                @else
                                    <span> {{translate('fase_estudo')}}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div id="step-6">
                    @if($project->project_stage_micro->psm_level>5)
                        @if($project->psm_id==16)
                            <div class="row">
                                <div class="col-sm-12">
                                    <img src="{{asset('img/ilustrator/approved.png')}}" style="width: 100px;height: 100px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                    <p class="text-center"><strong> {{translate('parabens_projecto_concluido')}}</strong></p>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-sm-12">
                                    <img src="{{asset('img/ilustrator/rejected.png')}}" style="width: 100px;height: 100px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                    <p class="text-center"><strong> {{translate('projecto_rejeitado')}}</strong></p>
                                </div>
                                <div class="col-sm-12">
                                    <div class="app-heading">
                                        <div class="title">
                                            <h4>Submeta novamente o Relatório Final para aprovação.</h4>
                                        </div>
                                    </div>
                                    <div class="block-content">
                                        <div class="col-md-8">
                                            <form enctype="multipart/form-data" action="{{route("final_report_pi")}}" id="form_final_report_again" method="POST">
                                                @csrf
                                                <input type="hidden" name="p_id" value="{{base64_encode($project->p_id)}}">
                                                <input type="hidden" name="p_name" value="{{$project->p_name}}">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label">{{translate('adicionar_relatorio')}}</label>
                                                    <div class="col-md-6">
                                                        <input type="file" name="final_report" class="form-control" accept="file_extension/.docx, .doc, .pdf" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                </div>
                                                <div class="col-sm-6" style="float: right;">
                                                    <button type="submit" class="btn btn-primary" id="btn_" >{{translate('submeter')}}</button>

                                                </div>
                                                
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                    @else
                        <div class="row">
                            <div class="app-heading">
                                <div class="title">
                                    <h2>{{translate('conclusao_estudo')}}</h2>
                                </div>
                            </div>
                            <div class="block-content">

                                    <div class="row">
                                        @if($project->psm_id == 15)

                                            <div class="col-md-8">
                                                <form enctype="multipart/form-data" action="{{route("final_report_pi")}}" id="form_final_report" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="p_id" value="{{base64_encode($project->p_id)}}">
                                                    <input type="hidden" name="p_name" value="{{$project->p_name}}">
                                                    <div class="form-group">
                                                        <label for="" class="col-md-4 control-label">{{translate('adicionar_relatorio')}}</label>
                                                        <div class="col-md-6">
                                                            <input type="file" name="final_report" class="form-control" accept="file_extension/.docx, .doc, .pdf" required>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-sm-6" style="float: right;">
                                                        <button type="submit" class="btn btn-primary" id="btn_20" >{{translate('submeter')}}</button>
                                                        <img id="img_submitted_20"  src="{{asset('assets/css/vendor/tinymce/img/loading-buffering.gif')}}" style="visibility: hidden; width: 5vw;height: 10vh;" class="img-responsive center-block d-block mx-auto" alt="Sample Image"> 
                                                    </div>
                                                    {{-- <div>
                                                        <div class="col-sm-12 text-center">
                                                        </div>
                                                    </div> --}}
                                                </form>
                                            </div>
                                        @endif
                                        @if($project->psm_id == 21)
                                            <div class="col-sm-12">
                                                <img src="{{asset('img/ilustrator/warning.png')}}" style="width: 90px;height: 90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                                <p class="text-center"><strong> {{translate('relatorio_final')}}</strong></p>
                                            </div>
                                        @endif
                                    </div>
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
    {{-- @include('./workgroup_modals/crud_workgroup_modals') --}}
    @include('partials.crud_workgroup_modals')





@section('scripts')
    <script>
        let post_award_doc = "{{route('post_award_doc.store')}}";
        let project_stage = parseInt("{{$project->psm_id}}");
        let protocol_submit = "{{route('pi_response')}}";
        let pi_response_cibs = "{{route('pi_response_cibs')}}";
        let success = "{{translate('sucesso')}}";
        let erro = "{{translate('erro')}}";
        let confirm = "{{translate('confirmar')}}";
        $("#form_final_report").submit(function(){
            document.getElementById("img_submitted_20").style.visibility = "visible";
            document.getElementById("btn_20").style.visibility = "hidden";            
        });

        $("#state").change(function (e) { 
            e.preventDefault();
            var state = $(this).val();
            if(state != 1){
                $("#doc_anexado").show();
            }else{
                $("#doc_anexado").hide();
            }
        });

        function form_wizard_selected(project_stage){

            if(project_stage == 5){
                return project_stage - 5
            }
            if(project_stage > 5 && project_stage <= 10){
                return project_stage - (project_stage - 1)
            }
            if(project_stage == 12){
                return project_stage - (project_stage - 1)
            }
            if(project_stage == 13){
                return project_stage - (project_stage - 4)
            }
            if(project_stage == 18){
                return project_stage - (project_stage - 1);
            }
            if(project_stage == 15){
                return project_stage - (project_stage - 5);
            }

            if(project_stage == 19){
                return project_stage - (project_stage - 3)
            }
            if(project_stage == 22){
                // console.log(project_stage - (project_stage - 2));
                return project_stage - (project_stage - 2)
            }
            if(project_stage == 23){
                return project_stage - (project_stage - 3)
            }

            if(project_stage >= 10 && project_stage <= 14){
                return project_stage - (project_stage - 3)
            }
            if(project_stage = 15){
                return project_stage - (project_stage - 4)
            }
            if(project_stage = 16){
                return project_stage - (project_stage - 2)
            }
           else{
                return project_stage - (project_stage - 3);
            }

        }
        // $("#btn_new_apendice").on("click", function(){
        function new_apendice(){
            // alert("Trest");
            var div = '<div class="row" style="margin-left:0;">'
                + '<label class="col-md-2 control-label">{{translate("apendice")}}</label>'
                + '<div class="col-md-6">'
                + '<input class="form-control input-sm" name="apendice[]"'
                + 'type="file" accept="file_extension/.docx, .doc, .pdf"'
                + '>'
                + '</div>'
                + '</div>';
            $(".apendice").append(div);
        }

        $(document).ready(function () {
            if ($(".wizard").length > 0) {

            //check count of steps in each wizard
            $(".wizard > ul").each(function() {
                $(this).addClass("steps_" + $(this).children("li").length);
            });


            // console.log(project_stage);
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
                if (i < form_wizard_selected(project_stage)) {
                    $(n).removeClass("selected").removeClass("disabled").addClass("done");
                }
            });
        })

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
                        title: erro,
                        text: erro,
                        icon: "error",
                        button: confirm
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
                            title: "{{translate('sucesso')}}",
                            text: message,
                            icon: "success",
                            button: confirm
                        }).then(function () {
                            location.reload();
                        })
                    } else {
                        swal({
                            title: "Erro!",
                            text: message,
                            icon: "error",
                            button: confirm
                        });
                    }
                    return false;

                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

        $("#form_protocol_submit").submit(function(e){
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: protocol_submit,
                dataType: 'json',
                type: 'POST',
                data: formData,
                beforeSend: function () {
                    $('#carregamento').css("display", "block");
                    document.getElementById("img_submitted").style.visibility = "visible";
                    document.getElementById("btn_submit_1").style.visibility = "hidden";
                },
                complete: function () {
                    $('#carregamento').css("display", "none");
                    document.getElementById("img_submitted").style.visibility = "hidden";
                    document.getElementById("btn_submit_1").style.visibility = "visible";
                },
                error: function () {
                    swal({
                        title: "erro",
                        text: '{{translate("ocorreu_erro")}}',
                        icon: "error",
                        button: confirm
                    });
                    $('#carregamento').css("display", "none");
                    document.getElementById("img_submitted").style.visibility = "hidden";
                    document.getElementById("btn_submit_1").style.visibility = "visible";
                    return false;
                },
                success: function (data) {
                    message=data.message;
                    if (typeof data.message === 'object' && data.message !== null){
                        message=JSON.stringify(data.message);

                    }
                    if (data.state==200) {
                        swal({
                            title: "{{translate('sucesso')}}",
                            text: message,
                            icon: "success",
                            button: confirm
                        }).then(function () {
                            location.reload();
                        })
                    } else {
                        swal({
                            title: "Erro!",
                            text: message,
                            icon: "error",
                            button: confirm
                        });
                    }
                    return false;

                },
                cache: false,
                contentType: false,
                processData: false
            });
            // alert('submit');
        });

        $("#form_cibs").submit(function(e){
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: pi_response_cibs,
                dataType: 'json',
                type: 'POST',
                data: formData,
                beforeSend: function () {
                    $('#carregamento').css("display", "block");
                    document.getElementById("img_submitted_2").style.visibility = "visible";
                    document.getElementById("btn_submit_2").style.visibility = "hidden";
                },
                complete: function () {
                    $('#carregamento').css("display", "none");
                    document.getElementById("img_submitted_2").style.visibility = "hidden";
                    document.getElementById("btn_submit_2").style.visibility = "visible";
                },
                error: function (response) {
                    // console.log(response);
                    swal({
                        title: '{{translate("erro")}}',
                        text: '{{translate("ocorreu_erro")}}',
                        icon: "error",
                        button: "{{translate('confirmar')}}"
                    });
                    $('#carregamento').css("display", "none");
                    document.getElementById("btn_submit_2").style.visibility = "visible";
                    document.getElementById("img_submitted_2").style.visibility = "hidden";
                    return false;
                },
                success: function (data) {
                    message=data.message;
                    if (typeof data.message === 'object' && data.message !== null){
                        message=JSON.stringify(data.message);

                    }
                    if (data.state==200) {
                        swal({
                            title: "{{translate('sucesso')}}",
                            text: "{{translate('sucesso')}}",
                            icon: "success",
                            button: "{{translate('confirmar')}}"
                        }).then(function () {
                            location.reload();
                        })
                    } else {
                        swal({
                            title: "Erro!",
                            text: message,
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
            // alert('submit');
        })

    </script>
@endsection
