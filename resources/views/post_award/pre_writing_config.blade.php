@extends('layout.template')
@section('page_title', translate('configuracao_projecto'))
@section('user_role', session('role_name'))
@section('user_name', session('user_name'))
@section('css')
    <style>

        .float{
            position:fixed;
            width:60px;
            height:60px;
            bottom:40px;
            right:40px;
            background-color:#272c40;
            color:#FFF;
            border-radius:50px;
            text-align:center;
            box-shadow: 2px 2px 3px #999;
        }

        .my-float{
            margin-top:22px;
        }
        option.red {background-color: #cc0000; font-weight: bold; font-size: 12px;}
        option.pink {background-color: #ffcccc;}
        hr {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 0;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection

@section('content')
    <!-- BASIC EXAMPLE -->
    <div class="block block-condensed">
{{--        <div class="app-heading">--}}
{{--            <div class="title">--}}
{{--                <h2>Gestão do projecto</h2>--}}
{{--                <p>{{$project->p_name}}</p>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="col-sm-12 ">
            <a class="btn btn-success btn-icon-fixed" type="button" style="margin-top: 20px; float: right" href="{{route('configs_post_award.index')}}"><i class="fa fa-backward"></i> {{translate('voltar')}}</a>
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
                        <a href="#step-3">
                            <span class="stepNumber">2</span>
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
                        <a href="#step-2">
                            <span class="stepNumber">2</span>
                            <span class="stepDesc">{{translate('fase_estudo_')}}<br /><small>{{translate('fase_estudo_')}}</small></span>

                        </a>
                    </li>
                    <li>
                        <a href="#step-5">
                            <span class="stepNumber">5</span>
                            <span class="stepDesc">{{translate('fase_estudo_')}}<br /><small>{{translate('fase_estudo_')}}</small></span>
                        </a>
                    </li>
                    <li>
                        <a href="#step-6">
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
                                        <label class="control-label">{{translate('descricao')}}</label>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" cols="4" rows="6" disabled>{{$project->p_description}}</textarea>
                                    </div>
                                    {{--                                        <div class="listing margin-bottom-0">--}}
                                    {{--                                            <div class="listing-item listing-item-with-icon">--}}


                                    <div class="list-group list-group-inline">
                                        <div class="list-group-item col-md-4 col-sm-4" style="max-height: 80px; min-height: 80px;">
                                            <span class="text-bold">{{translate('project_page')}}</span><br>
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
                            </div>
                            <div class="block-content">

                            </div>


                        </div>
                        <div class="col-md-6">

                            <div class="row">
                            {{--                                    <div class="col-md-8">--}}

                            <!-- RECENT ACTIVITY -->
                                <div class="block block-condensed">
                                    <div class="app-heading app-heading-small">
                                        <div class="title">
                                            <h2>{{translate('mais_detalhes')}}</h2>
                                        </div>
                                    </div>
                                    {{-- {{dd( $project)}} --}}

                                    <div class="block-divider-text"> </div>
                                    <div class="block-content">
                                        <div class="listing margin-bottom-0">
                                            <div class="listing-item listing-item-with-icon">
                                                <span class="icon-user listing-item-icon"></span>
                                                <h4 class="text-rg text-bold">{{translate('autor_detalhes')}}</h4>
                                                <div class="list-group list-group-inline">
                                                    <div class="list-group-item col-md-6 col-sm-6" style="max-height: 80px; min-height: 80px;">
                                                        <span class="text-bold">{{translate('autor')}}</span><br>
                                                        <span class="text-muted">{{!empty($project->user_project)? $project->user_project->staff->s_name: translate('nao_definido') }}</span>
                                                    </div>
                                                    <div class="list-group-item col-md-6 col-sm-6" style="max-height: 80px; min-height: 80px;">
                                                        <span class="text-bold">{{translate('cargo')}}</span><br>
                                                        <span class="text-muted text-danger">{{!empty($project->user_project)? $project->user_project->roles->r_description:translate('nao_definido')}}</span>

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
                        <div class="row">
                            <div class="block block-condensed">
                                            @foreach($project->documentsProject as $document)
                                            <div class="col-md-3">

                                                <div class="app-heading">
                                                    <div class="title">
                                                        <strong style="display:inline-block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 20ch;">{{$document->dp_description}}</strong>
                                                    </div>
                                                </div>
                                                <div class="block-content">
                                                    <a style="display:inline-block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 20ch;" href="{{ asset('docs/'.$document->dp_local_path) }}"><span class="icon-download"></span> {{translate('baixar')}}</a>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
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
                    <h4 class="text-uppercase text-bold text-rg heading-line-middle">&nbsp;<span>{{translate('configurar')}}</span></h4>
                    <div class="row">
                        <div class="block block-condensed">
                        </div>
                    </div>
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
                                            <img src="{{asset('img/ilustrator/approved.png')}}" style="width: 200px;height: 200px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
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
                <div id="step-6">
                    @if($project->project_stage_micro->psm_level>5)
                        @if($project->project_stage_micro->psm_id==16)
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
                                    <p class="text-center"><strong> {{translate('projecto_rejeitado')}}</strong></p>
                                </div>
                            </div>
                        @endif

                    @else
                        @if(Auth::user()->r_id!=8)
                        <div class="row">
                            <div class="col-sm-12">
                                <img src="{{asset('img/ilustrator/warning.png')}}" style="width: 90px;height: 90px;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                <p class="text-center"><strong> {{translate('estudo_ainda_finalizado')}}</strong></p>
                            </div>
                        </div>
                        @else
                            @if($project->psm_id == 21)
                                <div class="col-sm-12 text-center">
                                    <div class="col-sm-12">
                                        <div class="block block-condensed">
                                            <div class="app-heading">
                                                <div class="title">
                                                    <h2>{{translate('conclusao_estudo')}}</h2>
                                                </div>
                                                <div class="heading-elements">
                                                    <a href="{{asset('docs').'/'.$final_report->dp_local_path}}" class="bg-link" target="_blank" rel="noopener noreferrer"> <span class="icon-download"></span> {{translate('baixar_relatorio')}}</a>
                                                    {{-- <button class="btn btn-link padding-right-0">View Details</button> --}}
                                                </div>
                                            </div>
                                            <div class="block-content">

                                                <form id="form_final" action="{{route("aprovacao_final")}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                                    @csrf
                                                    <input type="hidden" name="p_id" value="{{base64_encode($project->p_id)}}">
                                                    <div class="text-center">
                
                                                        <button id="btn_submit_final" class="btn btn-primary btn-icon-fixed" type="submit" style="margin-top: 20px;"><i class="fa fa-check"></i> {{translate('concluir_estudo')}}</button>

                                                        <img id="img_submitted_final"  src="{{asset('assets/css/vendor/tinymce/img/loading-buffering.gif')}}" style="visibility: hidden; width: 5vw;height: 10vh;" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                            <div class="col-sm-12">
                                <form action="{{route("aprovacao_final")}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                    @csrf
                                    <input type="hidden" name="p_id" value="{{base64_encode($project->p_id)}}">
                                    <div class="text-center">

                                        <button class="btn btn-primary btn-icon-fixed" type="submit" style="margin-top: 20px;"><i class="fa fa-check"></i> {{translate('concluir_estudo')}}</button>
                                    </div>
                                </form>
                            </div>
                            @endif
                        @endif
                    @endif
                </div>
                <div id="step-5">
                    <div>
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tabs-10" data-toggle="tab">{{translate('historico_atualizacao')}}</a></li>
                            <li><a href="#tabs-7" data-toggle="tab">{{translate('nao_conformidade')}}</a></li>
                            <li><a href="#tabs-11" data-toggle="tab">{{translate('agenda_monitoria')}}</a></li>
                            <li><a href="#tabs-8" data-toggle="tab">{{translate('gestao_artigo')}}</a></li>
                            <li><a href="#tabs-9" data-toggle="tab">{{translate('gestao_membro')}}</a></li>
                        </ul>
                        <div class="tab-content tab-content-bordered">

                            <div class="tab-pane active" id="tabs-10">
                                <h3 class="font-bold " style="font-size: 18px; color: #016428;"><span class="" style="color: #016428;">(*)</span>{{translate('historico_atualizacao')}}</h3>
                                <div class="block block-condensed">

                                    <div class="block-content">
                                        @if(count($project_charter_story) > 0)
                                            <div class="table-responsive" style="overflow-x:auto; margin-top: 20px;">
                                                <table class="table table-striped table-bordered datatable-extended">
                                                    <thead>
                                                        <th>#</th>
                                                        <th>{{translate('objectivos')}}</th>
                                                        <th>{{translate('local_implementacao')}}</th>
                                                        <th>{{translate('pop_alvo')}}</th>
                                                        <th>{{translate('ponto_situacao')}}</th>
                                                        <th>{{translate('actualizado_pelo')}}</th>
                                                        <th>{{translate('relatorio')}}</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($project_charter_story as $key => $story)
                                                            <tr>
                                                                <td>{{$key+1}}</td>
                                                                <td>{{substr($story->pc_objective,0,40)}}</td>
                                                                <td>{{$story->p_data_collection_location}}</td>
                                                                <td>{{$story->p_target_population}}</td>
                                                                <td>{{$story->p_actual_state}}</td>
                                                                <td>
                                                                    @foreach ($story->user_stories as $user)
                                                                        {{$user->staff->s_name}}
                                                                        {{-- {{!empty($story->user_stories)?$story->user_stories->staff->s_name:"Não definido"}} --}}
                                                                    @endforeach
                                                                </td>
                                                                {{-- <td>{{!empty($story->user_stories)?$story->user_stories->staff->s_name:"Não definido"}}</td> --}}
                                                                <td>
                                                                    @foreach ($story->study_reports as $report)
                                                                        <a href="{{asset("docs")."/".$report->dpc_path}}" target="_blank" rel="noopener noreferrer" > <span class=""> {{$report->dpc_description}}</span> </a>
                                                                    @endforeach
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        @else

                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-7">
                                <h3 class="font-bold " style="font-size: 18px; color: #016428;"><span class="" style="color: #016428;">(*)</span>{{translate('nao_conformidade')}}</h3>
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
                                                            {{$conformity->c_description}}
                                                            
                                                        </td>
                                                        <td>{{$conformity->s_name}}</td>
                                                        {{-- <td>{{$conformity->created_at}}</td> --}}
                                                        <td>{{date('d-m-Y H:i:s', strtotime($conformity->created_at))}}</td>
                                                        <td>
                                                            @if(count($conformity_report) > 0)
                                                            
                                                                @foreach ($conformity_report as $report)
                                                                    <a href="{{asset("docs").'/'.$report->dp_local_path}}" target="_blank" rel="noopener noreferrer" class="btn btn-link"> <span class="fa fa-download "></span> {{translate('baixar')}}</a>
                                                                @endforeach
                                                            
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
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-8">
                                <div class="row col-sm-12">
                                    {{-- @can("isInvestigator")
                                        
                                    <div class="col-sm-12 text-right" style="padding-bottom: 15px;">
                                        <a class="btn btn-primary" style="border-radius:50px;" onclick="show_modal_add_article(null)"><i class="fa fa-plus"></i> {{translate('artigo')}}</a>
                                    </div>
                                    @endcan --}}
                                    <table class="table table-striped table-bordered datatable-basic">
                                        <thead>
                                        <tr>
                                            <th>{{translate('title')}}</th>
                                            <th>{{translate('data_actualizacao')}}</th>
                                            <th>{{translate('ficheiro')}}</th>
                                            {{-- <th>{{translate('accao')}}</th> --}}
                                            
                                        </tr>
                                        </thead>
                                        {{-- {{dd($project)}} --}}
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
                                                    @if(count($article->files)>0)
                                                    <ul>
                                                        @foreach($article->files as $file)
                                                            <li><a target="_blank" href="{{asset('docs').'/'.$file->f_path}}" class="btn-link"><span class="icon-download"> {{translate('baixar')}}</span></a></li>
                                                        @endforeach
                                                    </ul>
                                                    @else
                                                        {{translate('no_record')}}

                                                    @endif
                                                </td>
                                                
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="tab-pane" id="tabs-9">
                                @if($project->psm_id >= 13)
                                <div class="block block-condensed">
                                    @can("isInvestigator")
                                        
                                    <div class="row">
                                        <div class="text-center" style="margin-top:20px;">
                                            <button
                                                type="button"
                                                class="btn btn-primary"
                                                data-toggle="modal"
                                                data-target="#modal-info">
                                                <span class="fa fa-plus"></span> {{translate('novo_utilizador')}}
                                            </button>
                                        </div>
                                    </div>
                                    @endcan

                                    <div class="table-responsive">
                                        <div class="app-heading app-heading-small">
                                            <div class="title">
                                                <h5>{{translate('lista_membro')}}</h5>
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
                                                <th>{{translate('nome')}}</th>
                                                <th>{{translate('funcao')}}</th>
                                                
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
                                                    </tr>
                                                @endforeach

                                            @endif

                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                @endif
                            </div>                            
                            

                        </div>
                        <div class="tab-pane" id="tabs-11">
                            <div class="block block-condesend">
                                <div class="heading">
                                    <div class="title">
                                        <h3> {{translate('agenda_monitoria_ur')}}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="content">
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
                                                    <a href="{{asset('docs').'/'.$plan->pmp_monitoring_schedule_document_path}}" target="_blank" class="btn btn-link">{{$plan->pmp_monitoring_schedule}} <span class="icon-download" ></span> </a>
                                                </td>
                                            </tr>   
                                                
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @else   
                                <div class="row">
                                    <div class="col-sm-12">
                                        <img src="{{asset('img/ilustrator/warning.png')}}"
                                            class="img-responsive center-block d-block mx-auto"
                                            height="80px"
                                            width="80px"
                                            alt="Sample Image">
                                        <p class="text-center">{{translate('no_record')}}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if(Auth::user()->r_id==1)
                    @if($project->project_stage_micro->psm_level==4)
                    <div class="col-sm-12 text-center">
                        <button 
                            data-toggle="modal"
                            data-target="#modal-success"
                            type="button" 
                            class="btn btn-primary btn-icon-fixed"
                            style="margin-top: 20px;" >
                            {{translate('completar_fase_implementacao')}} 
                            <i class="fa fa-check"></i>
                        </button>
                    </div>
                        @endif
                    @endif
                    {{-- <div class="row" {{Auth::user()->r_id==1? '':'hidden'}}>
                        <a onclick="open_modal_add_task()" class="float">
                            <i class="fa fa-plus my-float"></i>
                        </a>

                    </div> --}}
                </div>

                {{-- {{ dd(Auth::user()->r_id) }} --}}
            </div>

        </div>
    </div>
    <!-- MODAL PRIMARY -->
    <div class="modal fade" id="modal-primary" tabindex="-1" role="dialog" aria-labelledby="modal-primary-header">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>

            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-primary-header">{{translate('adicionar_estudo')}}</h4>
                </div>
                <div class="modal-body">
                    {{ Form::open(['route' => 'task.store', 'class' => 'form-horizontal row', 'id' => 'post_form_tasks', 'role' => 'form', 'method' => 'POST', 'autocomplete' => 'off', 'novalidate' => 'novalidate']) }}
                    {{ csrf_field() }}
                    <input type="hidden" name="limit_tasks" id="limit_tasks" value="0">
                    <input type="hidden" name="project_id" value="{{$project->p_id}}">
                    <div class="row" style="padding: 20px">
                        <div class="block block-condensed">
                            <div class="block-content">
                                <div class="row form-row">
                                    <div class="col-sm-12">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label" for="member[]">{{translate('para')}}</label>
                                                <select class="select2" name="member[]" multiple required>
                                                    @if(!empty($project->work_group_project_stage_two))
                                                        @foreach($project->work_group_project_stage_two->work_group_member as $index=> $member)
                                                            <option value="{{$member->staff->s_id}}">{{$member->staff->s_name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label" for="state">{{translate('estado_')}}</label>
                                                <select class="select2" name="state" required>
                                                    @foreach($project_status as $index=> $state)
                                                        <option value="{{$state->c_id}}" title="{{translate($state->c_description)}}">{{translate($state->c_name)}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class=" col-sm-6">
                                            <div class="form-group" >
                                                <label for="start_date" class="control-label">{{translate('data_inicial')}}</label>
                                                {{ Form::date('start_date', null, ['class' => 'form-control', 'id' => 'start_date', 'autocomplete' => 'off', 'min' => date('Y-m-d')]) }}
                                            </div>
                                        </div>
                                        <div class=" col-sm-6">
                                            <div class="form-group" >
                                                <label for="start_date" class="control-label"> {{translate('data_final')}}</label>
                                                {{ Form::date('due_date', null, ['class' => 'form-control', 'id' => 'due_date', 'autocomplete' => 'off']) }}
                                            </div>
                                        </div>
                                        <div class=" col-sm-4" hidden>
                                            <div class="form-group" >
                                                <label for="start_date" class="control-label">Due Date</label>
                                                {{ Form::date('final_date', null, ['class' => 'form-control', 'id' => 'final_date', 'autocomplete' => 'off']) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class=" col-sm-12">
                                            <div class="form-group" >
                                                <label for="name" class="control-label">{{translate('descricao')}}</label>
                                                {{ Form::textarea('description', null, ['class' => 'form-control', 'id' => 'name','rows'=>3, 'autocomplete' => 'off', 'required' => 'required']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">{{translate('fechar')}}</button>
                        <button type="submit" class="btn btn-primary">{{translate('submeter')}}</button>
                    </div>
                    {{ Form::close() }}
                </div>

            </div>
        </div>
    </div>
  

    <!-- MODAL SUCCESS -->
    <div class="modal fade" id="modal-success" tabindex="-1" role="dialog" aria-labelledby="c-header">                        
        <div class="modal-dialog modal-success" role="document">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>

            <div class="modal-content">
                <div class="modal-header">                        
                    <h4 class="modal-title" id="modal-success-header">{{translate('completar_fase_implementacao')}}?</h4>
                </div>

                {{ Form::open([ 'route' => ['configs_post_award.store'],'class' => 'form-horizontal row', 'id' => 'post_form_finalise_study', 'role' => 'form', 'method' => 'POST', 'enctype' =>"multipart/form-data"]) }}
                <div class="modal-body">
                    <p>{{translate('tem_certeza_deseja_conluir')}}?</p>
                    {{ csrf_field() }}
                    <input type="hidden" name="project_id" value="{{base64_encode($project->p_id)}}">                         
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">{{translate('cancelar')}}</button>
                    {{-- <button type="button" class="btn btn-success">Submit</button> --}}
                    <button class="btn btn-primary btn-icon-fixed"
                                
                        type="submit" style="margin-top: 20px;">{{translate('confirmar')}} <i class="fa fa-check"></i> 
                    </button>
                </div>
                {{ Form::close() }} 
            </div>
        </div>            
    </div>
    <!-- END MODAL SUCCESS -->

    <div class="modal fade" id="modal-info" tabindex="-1" role="dialog" aria-labelledby="modal-success-header">
        <div class="modal-dialog modal-success" role="document">
            <button type="button" class="submit" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>
    
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{translate('registar_membro')}}</h4> 
                </div>
                <form action="{{route("workgroup.store")}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-md-2 control-label">{{translate('nome')}}</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="nome_usuario"  required>
                                @error("nome_usuario")
                                    <span style="color: red">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- {{ dd($wgp_id) }} --}}
                        <input type="hidden" name="wgp_id" value="{{!empty($wgp_id)?$wgp_id->wgp_id:""}}">
                        <input type="hidden" name="p_id" value="{{!empty($project)?base64_encode($project->p_id):""}}">
                        <div class="form-group">
                            <label class="col-md-2 control-label">{{translate('email')}}</label>
                            <div class="col-md-10">
                                <input type="email" class="form-control" name="email" autocomplete="email" required>
                                @error("email")
                                    <span style="color: red">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
    
                        <div class="form-group">
                            <label class="col-md-2 control-label">{{translate('senha')}}</label>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                                    <input name="password" type="password" class="form-control" autocomplete="current-password" required>
                                </div>
                                @error("password")
                                    <span style="color: red">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">{{translate('senha_novamente')}}</label>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                                    <input name="password2" type="password" class="form-control" autocomplete="current-password" required>
                                </div>
                                @error("password2")
                                    <span style="color: red">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
    
    
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="">{{translate('funcao')}}</label>
                            <div class="col-md-10">
                                <select class="bs-select" name="role__" title="{{translate('select_option')}}"required>
                                    @foreach ($role_groups as $role)
                                        <option value="{{base64_encode($role->wgr_id)}}">{{$role->wgr_name}}</option>
                                    @endforeach
                                </select>
    
                            </div>
                        </div>
    
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <button type="button" class="btn btn-link col-md-6" data-dismiss="modal">{{translate('cancelar')}}</button>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success ">{{translate('registar')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
    
            </div>
        </div>
    </div>
    {{-- @include('partials.crud_workgroup_modals') --}}



    <!-- END MODAL PRIMARY -->

@endsection

@section('scripts')

    <script>
        let post_work_group = "{{route('post_award_work_group.store')}}";
        let post_article = "{{route('article_post_award.store')}}";
        let post_award_doc = "{{route('post_award_doc.store')}}";
        {{--let post_finalise_ = "{{route('configs_post_award.store')}}";--}}
        let post_form_tasks = "{{route('task.store')}}";
        let member_list = {!! empty($project->work_group_project_stage_two->work_group_member)?json_encode([]):json_encode($project->work_group_project_stage_two->work_group_member) !!};
        let status_json = {!! json_encode($project_status) !!};
        let tasks = {!! json_encode($project->tasks) !!};
        let statge_stepper = {!! (Auth::user()->r_id==8?5:(empty($project->work_group_project_stage_two->work_group_member)? 3: (count($project->work_group_project_stage_two->work_group_member)>0? 4:3)))  !!};
        var aux=0;
        let status_option="";
        let member_options="";
        var sub_task_array=[];
        let project_stage = parseInt("{{$project->psm_id}}");

        var membro_id,role_id;
        var investigators= {!! $investigators !!};
        var document_type= {!! $document_types !!};
        var role_groups= {!! $role_groups !!};
        var index=parseInt( "{!! empty($project->work_group_project)? 0:count($project->work_group_project->work_group_member) !!}");
        var document_option='';
        var rows=[];
        var status='';
        var message="";
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

        $("#due_date").on("click", function(){
            // console.log()
            endDate();
        });
        function endDate(){
            var start_date = $("#start_date").val();
            console.log(start_date);
            $("#due_date").attr("min", start_date);
        }
        $(document).ready(function() {
            $(".select2").select2();

            $(".select2-limiting").select2({
                maximumSelectionLength: 2
            });
            var pre_rows=document.getElementById("member_table").rows;
            for (var i=0; i<pre_rows.length; i++){
                rows.push(pre_rows[i]);
            }

            $('#carregamento').css("display", "none");
            for (var i=0; i<status_json.length;i++){
                status_option+='<option value="'+status_json[i].c_id+'" title="'+status_json[i].c_description+'">'+status_json[i].c_name+'</option>'
            }
            for (var j=0; j<member_list.length;j++){
                member_options+='<option value="'+member_list[j].staff.s_id+'" title="'+member_list[j].staff.s_name+'">'+member_list[j].staff.s_name+'</option>'
            }
            for(var s=0; s<document_type.length;s++){
                document_option+='<option value="'+document_type[s].dt_id+'">'+document_type[s].dt_name+'</option>';
            }
{{--            @foreach ($document_types as $doc_type)--}}
{{--            <option value="{{ $doc_type->dt_id}}">{{ $doc_type->dt_name }}</option>--}}
{{--            @endforeach--}}
        });
        function onchangeDate() {
            document.getElementById("data_fim").min=document.getElementById("data_inicio").value;
        }
        function add_group_member(){
            membro_id= $('#membro_id').val();
            role_id= $('#role_id').val();
            var options= '';
            var options_roles= '';
            for (var i =0; i<investigators.length; i++){
                options+=' <option value="'+investigators[i].s_name+'">';
            }
            for (var j =0; j<role_groups.length; j++){
                status="";
                for (var s=0;s<role_id.length; s++){
                    if (role_groups[j].wgr_id==role_id[s]){
                        status="selected";
                    }
                }
                options_roles+=' <option value="'+role_groups[j].wgr_id+'" '+status+' >'+role_groups[j].wgr_name+'</option>';
            }
            var name_div='       <div class="col-md-12 form-group">'+
                '<input list="membro_selected_'+index+'" name="membro_selected_'+index+'" value="'+membro_id+'" placeholder="Membro" id="membro_'+index+'" class="form-control">'+
                '<datalist id="membro_selected_'+index+'">'+
                options+
                '</datalist>'+
                '</div>';
            var roles_div='    <div class="col-md-12" >'+
                '<select class="select3" multiple id="role_id_'+index+'" name="role_'+index+'[]">'+
                options_roles+
                '</div></select>'+
                '</div>';
            rows.push('<tr>'+
                '<td><div class="row col-md-12">'
                +name_div
                +'</div></td>'+
                '<td> <div class="row col-md-12">'+
                roles_div+
                '</div></td>'+
                '<td>-</td>'+
                '<td><button type="button" class="btn btn-secondary" onclick="remove_row('+(rows.length-1)+');" style="background-color: #7fad39!important; color:white!important;" data-dismiss="modal"><i class="fa fa-remove" style="color: white"></i></button> </td>'+
                '</tr>');
            load_table();
            index+=1;
            $('#membro_id').val(null);
            $('#role_id').val(null);
            $('#max_index').val(index);
            $('#role_id').trigger('change');
        }
        function load_table(){
            $('#member_table').empty();
            for (var i=0; i<rows.length;i++){
                console.log(rows[i]);

                $('#member_table').append(rows[i]);


            }
            $('.select3').select2();
            // $('select').select2({
            //     theme: 'bootstrap4'
            // });
        }
        function remove_row(index){
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
                            title: '{{translate("sucesso")}}',
                            text: data.message,
                            icon: "success",
                            button:'{{translate("confirmar")}}'
                        }).then(function () {
                            location.reload();
                        })
                    } else {
                        swal({
                            title: "Erro!",
                            text: data.message,
                            icon: "error",
                            button:'{{translate("confirmar")}}'
                        });
                    }
                    return false;

                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
        $("#form_final").submit(function(){
            document.getElementById("img_submitted_final").style.visibility = "visible";
            document.getElementById("btn_submit_final").style.visibility = "hidden";            
        });

        $("form#post_form_award_doc").submit(function(e) {
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
                        button:'{{translate("confirmar")}}'
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
                            title: '{{translate("sucesso")}}',
                            text: message,
                            icon: "success",
                            button:'{{translate("confirmar")}}'
                        }).then(function () {
                            location.reload();
                        })
                    } else {
                        swal({
                            title: "Erro!",
                            text: message,
                            icon: "error",
                            button:'{{translate("confirmar")}}'
                        });
                    }
                    return false;

                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
        function open_modal_add_task(){
            $('#modal-primary').modal({show: true});
        }
        function add_subtask_field(){
            aux= sub_task_array.length+1;
            $('#limit_tasks').val(aux);
            sub_task_array.push('<div class="block block-condensed" > <div class="block-content"><div class="form-row">'+
                '<div class="col-sm-12">'+
                '<div class="col-md-6">'+
                '<div class="form-group">'+
                '<label class="control-label" for="member_'+aux+'[]">Para</label>'+
                '<select class="select3" name="member_'+aux+'[]" multiple required>'+
                member_options+
                '</select>'+
                '</div></div>'+
                '<div class="col-md-6">'+
                '<div class="form-group">'+
                '<label class="control-label" for="state_'+aux+'">Estado</label>'+
                '<select class="select3" name="state_'+aux+'" required>'+
                status_option+
                '</select>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '    <div class="col-sm-12">'+
                '<div class=" col-sm-4">'+
                '<div class="form-group" >'+
                '<label for="start_date_'+aux+'" class="control-label">Start date</label>'+
                '<input type="date" class="form-control" name="start_date_'+aux+'" id="start_date_'+aux+'">'+
                '</div></div>'+
                '<div class=" col-sm-4">'+
                '<div class="form-group" >'+
                '<label for="due_date_'+aux+'" class="control-label">Due Date</label>'+
                '<input type="date" class="form-control" name="due_date_'+aux+'" id="due_date_'+aux+'">'+
                '</div> </div>'+
                '<div class=" col-sm-4">'+
                '<div class="form-group" >'+
                '<label for="final_date_'+aux+'" class="control-label">Due Date</label>'+
                '<input type="date" class="form-control" name="final_date_'+aux+'" id="final_date_'+aux+'">'+
                '</div> </div> </div>'+
                '<div class="form-group col-md-12" >'+
                '<label for="description_'+aux+'" class="col-md-12 control-label">{{translate("descricao")}}</label>'+
                '<div class="col-md-12">'+
                '<textarea class="form-control" id="description_'+aux+'" name="description_'+aux+'" rows="3" required></textarea>'+
                '</div>'+
                '</div>'+

                '</div></div></div>');
            // $('#div_sub_tarefa').empty();
            // for(var i=0; i<sub_task_array.length;i++){
            $('#div_sub_tarefa').append(sub_task_array[sub_task_array.length-1]);

            // }
            $('.select3').select2();
        }
        $("form#post_form_tasks").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: post_form_tasks,
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
                        button:'{{translate("confirmar")}}'
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
                            button:'{{translate("confirmar")}}'
                        }).then(function () {
                            location.reload();
                        })
                    } else {
                        swal({
                            title: "Erro!",
                            text: message,
                            icon: "error",
                            button: '{{translate("confirmar")}}'
                        });
                    }
                    return false;

                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
        $("form#post_form_article").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: post_article,
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
                        button: '{{translate("confirmar")}}'
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
                            button: '{{translate("confirmar")}}'
                        }).then(function () {
                            location.reload();
                        })
                    } else {
                        swal({
                            title: "Erro!",
                            text: message,
                            icon: "error",
                            button: '{{translate("confirmar")}}'
                        });
                    }
                    return false;

                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
        function show_modal_add_article(object){
            if (object!=null){
                $('#articles_task_description').text(object.t_description);
                $('#articles_task_id').val(object.t_id);
                $('#div_task_details_article').show();
            }else{
                $('#div_task_details_article').hide();

            }
            $('#modal-add-articles').modal({show: true});
        }
        function add_document_article() {


                    var index = parseInt($('#limit_articles').val());
                    index = index + 1;
                    console.log($('#limit_articles').val());

                    var document = '    <div class="block block-condensed">' +
                        '<div class="block-content"><div class="row col-sm-12">' +
                        '<div class="col-sm-6">' +
                        '<div class="form-group" >' +
                        '<label class="control-label">{{translate("Descrição")}}</label>' +
                        '<textarea class="form-control" id="description_doc_'+ index + '" name="description_doc_' + index + '" rows="2" required></textarea>' +
                        '</div> </div>' +
                        '<div class="col-sm-6">' +
                        '<div class="form-group">' +
                        '<label class="control-label">{{translate("documento")}}</label>' +
                        '<input id="file_'+index+'" class="form-control" name="document_file_' + index + '" accept="file_extension/.docx, .doc, .pdf" type="file" required/>' +
                        '</div></div> </div></div></div>';

            $('#limit_articles').val(index);
            $('#div_article_files').append(document);
            // $('.select4').select2();
        }
        function add_document(id){
            var index=parseInt($('#limit_docs_'+id).val());
            index=index+1;
            console.log($('#limit_docs_'+id).val());

            var document='    <div class="block block-condensed">'+
                '<div class="block-content"><div class="row col-sm-12">'+
                '<div class="col-sm-6">'+
                '<div class="form-group" >'+
               '<label class="control-label">{{translate("Descrição")}}</label>'+
                '<textarea class="form-control" id="description_doc_'+id+'_'+index+'" name="description_doc_'+id+'_'+index+'" rows="2" required></textarea>'+
        '</div> </div>'+
        '<div class="col-sm-6">'+
        '<div class="form-group">'+
        '<label class="control-label">Documento</label>'+
        '<input id="files" class="form-control" name="document_file_'+id+'_'+index+'" accept="file_extension/.docx, .doc, .pdf" type="file" required/>'+
        '</div></div> </div></div></div>';
            $('#limit_docs_'+id).val(index);
            $('#post_form_tasks_'+id).append(document);
            // $('.select4').select2();
        }
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



    {{--    <script type="text/javascript" src=" {{asset('assets/js/jquery.smartWizard.js')}} "></script>--}}

@endsection
