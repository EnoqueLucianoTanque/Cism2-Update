@extends('layout.template')
@section('page_title', translate('revisao_cientifica'))
@section('user_role', session('role_name'))
@section('user_name', session('user_name'))
@section('page_title', 'Aprovação Científica')
@section('page_title_', 'Post Award')
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
                    <h4 class="text-uppercase text-bold text-rg heading-line-middle" style="color: #272c40!important;">&nbsp;<span >Detalhes do projecto</span></h4>
                    <div class="row col-sm-12 col-md-12">
                        <div class="col-md-6">

                            <!-- START PROJECT DETAILS -->
                            <div class="block block-condensed">
                                <div class="app-heading">
                                    <div class="title">
                                        <strong> Nome: </strong><span>{{$project->p_name}} </span>
                                    </div>
                                </div>

                                <div class="block-content">
                                    <div class="form-group">
                                        <label class="control-label">Descrição</label>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" cols="4" rows="6" disabled>{{$project->p_description}}</textarea>
                                    </div>
                                    {{--                                        <div class="listing margin-bottom-0">--}}
                                    {{--                                            <div class="listing-item listing-item-with-icon">--}}


                                    <div class="list-group list-group-inline">
                                        <div class="list-group-item col-md-4 col-sm-4" style="max-height: 80px; min-height: 80px;">
                                            <span class="text-bold">Página do projecto </span><br>
                                            <span class="text-muted"><a target="_blank" href="{{ $project->p_web_url}}" class="" ><span class="fa fa-chrome"></span> {{ $project->p_name}}</a></span>
                                        </div>
                                        <div class="list-group-item col-md-4 col-sm-4" style="max-height: 80px; min-height: 80px;">
                                            <span class="text-bold">Data de submissão</span><br>
                                            <span class="text-muted">{{ $project->p_submitted_at}}</span>
                                        </div>
                                        <div class="list-group-item col-md-4 col-sm-4" style="max-height: 80px; min-height: 80px;">
                                            <span class="text-bold">Previsão de término</span><br>
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
                                            <h2>Mais detalhes do projeto</h2>
                                        </div>
                                    </div>

                                    <div class="block-divider-text"> </div>
                                    <div class="block-content">
                                        <div class="listing margin-bottom-0">
                                            <div class="listing-item listing-item-with-icon">
                                                <span class="icon-user listing-item-icon"></span>
                                                <h4 class="text-rg text-bold">Detalhes do autor</h4>
                                                <div class="list-group list-group-inline">
                                                    <div class="list-group-item col-md-6 col-sm-6" style="max-height: 80px; min-height: 80px;">
                                                        <span class="text-bold">Autor</span><br>
                                                        <span class="text-muted">{{ $project->user_project->staff->s_name }}</span>
                                                    </div>
                                                    <div class="list-group-item col-md-6 col-sm-6" style="max-height: 80px; min-height: 80px;">
                                                        <span class="text-bold">Cargo</span><br>
                                                        <span class="text-muted text-danger">{{$project->user_project->roles->r_description}}</span>

                                                    </div>

                                                </div>
                                            </div>
                                            <div class="listing-item listing-item-with-icon">
                                                <span class="icon-file-add listing-item-icon text-success"></span>
                                                <h4 class="text-rg text-bold"></h4>
                                                <div class="list-group list-group-inline margin-bottom-0" style="max-height: 80px; min-height: 80px;">
                                                    <div class="list-group-item col-md-6 col-sm-6" style="max-height: 80px; min-height: 80px;">
                                                        <span class="text-bold">Fonte do projecto</span><br>
                                                        <span class="text-muted">{{ $project->p_source}}</span>
                                                    </div>
                                                    <div class="list-group-item col-md-6 col-sm-6" style="max-height: 80px; min-height: 80px;">
                                                        <span class="text-bold">Financiamento necessário</span><br>
                                                        <span class="text-muted text-danger">{{ number_format($project->p_budget, 2, '.', ',') . ' Mtn'}}</span>
                                                    </div>
                                                    {{--                                                            <div class="list-group-item col-md-4 col-sm-4">--}}
                                                    {{--                                                                <span class="text-bold">Documento de suporte</span><br>--}}
                                                    {{--                                                                <span class="text-muted"><a href="{{ asset('docs/' . $project->p_support_document) }}" class="" target="_blank"><span class="icon-download"></span></a></span>--}}
                                                    {{--                                                            </div>--}}
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
                    <h4 class="text-uppercase text-bold text-rg heading-line-middle">&nbsp;<span>Documentos Associados</span></h4>
                    <div class="row">
                        @if(count($project->documentsProject)>0)
                            @foreach($project->documentsProject as $document)
                                <div class="col-md-4">
                                    {{-- <div class="block block-condensed"> --}}
                                        <div class="app-heading">
                                            <div class="title">
                                                <strong style="display:inline-block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 50ch;">{{translate( $document->dp_description)}}</strong>
                                            </div>
                                        </div>
                                        <div class="block-content">
                                            <a style="display:inline-block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 50ch;" href="{{ asset('docs/'.$document->dp_local_path) }}"><span class="icon-download">{{translate('baixar')}}</span></a>
                                        </div>
                                    {{-- </div> --}}
                                </div>
                            @endforeach
                        @else
                            <div class="row">
                                <div class="col-sm-12">
                                    <img src="{{asset('img/ilustrator/no_data.svg')}}" style="width:90px;height:90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                    <p class="text-center"><strong>Do momento nenhum projeto encontra-se nesta fase</strong></p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div id="step-2">
                   
                    @if($project->project_stage_micro->psm_level==2)
                        @if($project->psm_id==18)
                            <h4 class="text-uppercase text-bold text-rg heading-line-middle" style="color: #272c40!important;">&nbsp;<span >{{translate('aprovacao_cci')}}</span></h4>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="col-sm-12">
                                        <div class="block block-condensed">
                                            <div class="app-heading">
                                                <div class="title">
                                                    <h2>{{translate('aprovacao_cci')}}</h2>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <a href="{{ asset('docs/' . $pi_protocol_document->dp_local_path) }}" target="_blanck"><span class="fa fa-print">{{translate('clique_aqui')}}</span></a><span> {{translate('para_baixar_doc_anexado_pi')}}</span>
                                            </div>
                                            <div class="block-content">
                                                {{ Form::open(['route' => ['aprovacao_científica',base64_encode($project->p_id)], 'class' => 'form-horizontal row', 'id' => 'form_cci_approval', 'role' => 'form', 'method' =>'POST', 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'enctype' =>"multipart/form-data"]) }}
                                                {{ csrf_field() }}
                                                <input type="hidden" name="project_id" value="{{base64_encode($project->p_id)}}">

                                                <div class="block-content">
                                                    <div class="row col-sm-12">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="control-label">{{translate('opcoes_aprovacao')}}</label>
                                                                <select class="form-control" name="state" id="" required>
                                                                    <option value=""> --{{translate('select_answer')}} --</option>
                                                                    <option value="Aprovado">{{translate('aprovado')}}</option>
                                                                    <option value="Reprovado">{{translate('reprovado_revisao')}}</option>
                                                                    
                                                                </select>
                                                                @error("state")
                                                                    <span style="color: red;">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="control-label">{{translate('anexar_protocolo')}}</label>
                                                                <input id="files" class="form-control"  name="document" accept="file_extension/.docx, .doc, .pdf" type="file" placeholder="{{translate('anexar_protocolo')}}" required>
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
                        @elseif($project->psm_id == 22)
                            <div class="row">
                                <div class="block block-condesend">
                                    <div class="row">
                                        @if(count($document_for_cci)>0)
                                        <div class="title">
                                            <h3>{{translate('documento_anexado')}}</h3>
                                        </div>
                                        @foreach($document_for_cci as $document)
                                        <div class="col-md-3">
    
                                            <div class="app-heading">
                                                <div class="title">
                                                    <strong style="display:inline-block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 20ch;">{{$document->dp_name}}</strong>
                                                </div>
                                            </div>
                                            <div class="block-content">
                                                <a style="display:inline-block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 20ch;" href="{{ asset('docs/'.$document->dp_local_path) }}"><span class="icon-download"></span> {{translate('baixar')}}</a>
                                            </div>
                                        </div>                                            
                                        @endforeach
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            {{ Form::open(['route' => ['aprovacao_científica',base64_encode($project->p_id)], 'class' => 'form-horizontal row', 'id' => 'form_reguladora_approval', 'role' => 'form', 'method' =>'POST', 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'enctype' =>"multipart/form-data"]) }}
                                                {{ csrf_field() }}
                                                <input type="hidden" name="project_id" value="{{base64_encode($project->p_id)}}">

                                                <div class="block-content">
                                                    <div class="row col-sm-12">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="control-label">{{translate('opcoes_aprovacao')}}</label>
                                                                <select class="form-control" name="state" id="">
                                                                    <option value=""> --{{translate('select_answer')}} --</option>
                                                                    <option value="Aprovado">{{translate('aprovado')}}</option>
                                                                    <option value="Aprovado">{{translate('reprovado_revisao')}}</option>
                                                                    
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="control-label">{{translate('anexar_protocolo')}}</label>
                                                                <input id="files" class="form-control"  name="document" accept="file_extension/.docx, .doc, .pdf" type="file" placeholder="Anexar O draft"/>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 text-center">
                                                        <button id="btn_submit_2" class="btn btn-primary btn-icon-fixed" type="submit" style="margin-top: 20px;"><i class="fa fa-check"></i> {{translate('submeter')}}</button>
                                                    </div>
                                                    <img id="img_submitted_1"  src="{{asset('assets/css/vendor/tinymce/img/loading-buffering.gif')}}" style="visibility: hidden; width: 5vw;height: 10vh;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                                </div>
                                                {{ Form::close() }}
                                        </div>
                                    </div>

                                </div>
                            </div>
                            {{-- <h1>Teste</h1> --}}
                        @endif
                        @elseif($project->project_stage_micro->psm_level<2)
                            <div class="row">
                                <div class="col-sm-12">
                                    <img src="{{asset('img/ilustrator/warning.png')}}" style="width:90px;height:90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                    <p class="text-center"><strong> O protocolo ainda não foi submetido</strong></p>
                                </div>
                            </div>
                            @endif
                        @if($project->project_stage_micro->psm_level == 2 && $project->psm_id == 10)
                            <div class="row">
                                <div class="col-sm-12">
                                    <img src="{{asset('img/ilustrator/rejected.png')}}" style="width:90px;height:90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                    <p class="text-center"><strong> O projecto foi rejeitado pela unidade reguladora</strong></p>
                                </div>
                            </div>
                        @endif
                    {{-- @elseif() --}}

                    {{-- @endif --}}
                        @if($project->project_stage_micro->psm_level>2 && $project->project_stage_micro->psm_id==12)
                            <div class="row">
                                <div class="col-sm-12">
                                    <img src="{{asset('img/ilustrator/rejected.png')}}" style="width:90px;height:90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                    <p class="text-center"><strong> {{translate('projecto_rejeitado')}}</strong></p>
                                </div>
                            </div>
                        @endif
                        @if($project->project_stage_micro->psm_level==3 && $project->psm_id ==11)
                            <div class="row">
                                <div class="col-sm-12">
                                    <img src="{{asset('img/ilustrator/approved.png')}}" style="width:90px;height:90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                    <p class="text-center"><strong> {{translate('projecto_aprovado')}}</strong></p>
                                </div>
                            </div>
                        @endif
                    {{-- @endif --}}
                </div>
                <div id="step-3">
                    {{-- @if($project->project_stage_micro->psm_level>=4 && $project->psm_id == 11)
                        <div class="row">
                            <div class="col-sm-12">
                                <img src="{{asset('img/ilustrator/approved.png')}}" style="width:90px;height:90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                <p class="text-center"><strong> O projecto foi Aprovado eticamente</strong></p>
                            </div>
                        </div> --}}
                    @if($project->project_stage_micro->psm_level==4)
                        @if($project->project_stage_micro->psm_id==13)
                            <div class="row">
                                <div class="col-sm-12">
                                    <img src="{{asset('img/ilustrator/approved.png')}}" style="width:90px;height:90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                    <p class="text-center"><strong> {{translate('projecto_aprovado')}}</strong></p>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-sm-12">
                                    <img src="{{asset('img/ilustrator/rejected.png')}}" style="width:90px;height:90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                    <p class="text-center"><strong> {{translate('projecto_rejeitado')}}</strong></p>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="row">
                            <div class="col-sm-12">
                                <img src="{{asset('img/ilustrator/approved.png')}}" style="width:90px;height:90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                <p class="text-center"><strong> {{translate('projecto_aprovado')}}</strong></p>
                            </div>
                        </div>
                    @endif
                </div>
                <div id="step-4">
                    <div class="row">
                        <div class="col-sm-12">
                            <img src="{{asset('img/ilustrator/warning.png')}}" style="width:80px;height:80px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                            {{-- <p class="text-center"><strong> {{translate('projecto_rejeitado')}}</strong></p> --}}
                        </div>
                    </div>

                </div>
                <div id="step-5">
                    @if($project->project_stage_micro->psm_level>5)
                        @if($project->psm_id==16)
                            <div class="row">
                                <div class="col-sm-12">
                                    <img src="{{asset('img/ilustrator/approved.png')}}" style="width:90px;height:90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                    <p class="text-center"><strong>{{translate('projecto_concluido_sucesso')}}</strong></p>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-sm-12">
                                    <img src="{{asset('img/ilustrator/rejected.png')}}" style="width:90px;height:90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                    <p class="text-center"><strong> {{translate('projecto_rejeitado')}}</strong></p>
                                </div>
                            </div>
                        @endif

                    @elseif ($project->psm_id == 13)

                        <div class="row">
                            <div class="block-condesend">
                                <div class="block-content">
                                    <div class="text-center">
                                        
                                        <a 
                    href="{{route("article.create", base64_encode($project->p_id))}}"
                                            class="btn btn-primary"
                                            >
                                            <span class="fa fa-plus"></span> {{translate('adicionar_artigo')}}
                                        </a>
                                    </div>
                                    @if(count($articles) > 0)
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered datatable-extended">
                                            <thead>
                                                <th>#</th>
                                                <th>{{translate('projecto')}}</th>
                                                <th>{{translate('area_pesquisa')}}</th>
                                                <th>{{translate('title')}}</th>
                                                <th>Link</th>
                                                <th>{{translate('document')}}</th>
                                                <th>{{translate('data_registo')}}</th>

                                            </thead>
                                            <tbody>
                                                @foreach($articles as $key => $article)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{$project->p_name}}</td>
                                                        <td>{{$article->category->sa_name}}</td>
                                                        <td>{{$article->a_title}}</td>
                                                        <td>{{$article->a_link}}</td>
                                                        <td>
                                                            <a href="{{asset("articles/docs").'/' .$article->a_document_path}}"> {{$article->a_title}}</a>
                                                        </td>
                                                        {{-- <td>{{$article->a_start_date}}</td> --}}
                                                        <td>{{date('d-m-Y H:i:s', strtotime($article->a_start_date))}}</td>
                                                        
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    @else
                                    <div class="text-center" style="margin-top: 20px;">
                                        <span style="color: #016428">{{translate('no_record')}}</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @else   
                    <div class="row">
                        <div class="col-sm-12">
                            <img src="{{asset('img/ilustrator/warning.png')}}" style="width:90px;height:90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                            <p class="text-center"><strong> {{translate('projeco_submetido_aprovacao_cibs')}} CIBS</strong></p>
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
    {{-- <div class="modal fade" id="modal_links" tabindex="-1" role="dialog" aria-labelledby="modal-info-header">
        <div class="modal-dialog modal-primary" role="document">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>

            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-primary-header">Adicionar links</h4>
                </div>
                <form action="{{route("cc_links.store")}}" method="POST" enctype="multipart/form-data">
                <div class="modal-body" id="modal_links">
                    @csrf
                    <input type="hidden" name="p_id" value="{{base64_encode($project->p_id)}}">
                    {{-- <div class="form-group">
                        <label class="col-md-3 control-label">Nome</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nome_link" placeholder="insira nome do link">
                        </div>
                    </div> --}}
                    {{-- <div class="form-group">
                        <label class="col-md-3 control-label">Descrição do link</label>
                        <div class="col-md-9">
                            <textarea name="details" id="" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nome da revista</label>
                        <div class="col-md-9">
                            <input type="text" name="magazine_name" class="form-control" placeholder="insira o nome da revista de revisão de pares" required>
                        </div>
                    </div>
                    <div class="form-group" >
                        <label class="col-md-3 control-label">Link</label>
                        <div class="col-md-9">
                            <input type="url" name="link[]" class="form-control" placeholder="insira o link" required>
                        </div>
                    </div>
                    <div class="link">

                    </div>
                    <div class="text-center" style="margin-top: 12px;">
                        <button type="button" onclick="add_new_link()" class="btn-primary"> <span class="fa fa-plus"></span> </button>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-info"> <span class="fa fa-floppy-o"></span> Adicionar</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}

    <div class="modal fade" id="modal-danger" tabindex="-1" role="dialog" aria-labelledby="modal-danger-header">
        <div class="modal-dialog modal-danger" role="document">
            <button type="button" class="submit" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>
    
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-danger-header">desativar artigo</h4>
                </div>
                <form action="{{ route("article.article_desative") }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="article_id" value="" id="article_id">
                        <div class="form-group">
                            <div class="col-md-6">
                                <div class="input-group">
                                    {{-- <input type="text" id="p_name" class="form-control" value=""> --}}
    
                                </div>
                            </div>
                            <h3> Tem certeza que deseja desactivar o artigo<strong id="nome_projeto">  </strong> ? </h3>
                        </div>
    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="btn_remove" class="btn btn-danger ">Confirmar</button>
                    </div>
                </form>
    
            </div>
        </div>
    </div>
    <!-- END MODAL DANGER -->
@endsection
@section('scripts')
    <script>
        let project_stage = parseInt("{{$project->psm_id}}");
        function form_wizard_selected(project_stage){
            // let temp = 0;
            // console.log( project_stage);
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

            if(project_stage == 19){
                return project_stage - (project_stage - 2)
            }
            if(project_stage == 22){
                // console.log(project_stage - (project_stage - 2));
                return project_stage - (project_stage - 1)
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
        function add_new_link(){
            // e.preventDefault();

            var div = '<div class="form-group">'
                    +'<label class="col-md-3 control-label">Mais</label>'
                    + '<div class="col-md-9"> <input type="url" name="link[]" class="form-control" placeholder="insira o link" required> </div>'
                    +'</div>';
                    // console.log(div);
            $(".link").append(div);
        }
        $("#form_cci_approval").submit(function(e){
            // e.preventDefault();
            document.getElementById("img_submitted").style.visibility = "visible";
            document.getElementById("btn_submit_1").style.visibility = "hidden";
        }); 
        $("#form_reguladora_approval").submit(function(e){
            // e.preventDefault();
            document.getElementById("img_submitted_1").style.visibility = "visible";
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

        });
    </script>
@endsection
