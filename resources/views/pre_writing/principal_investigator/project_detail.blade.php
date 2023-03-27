@extends('layout.template')
@section('page_title', translate('detalhe_proposta'))
@section('page_title_', translate('proposta_submetida'))
@section('page_title_active', !empty($project_author)?$project_author->s_name:translate('nao_definido'))
@section('user_role', session('role_name'))
@section('user_name', session('user_name'))
@section('page_name', 'Pre-award')

@section('content')
@if(!empty($project)) 

<div class="row">
    {{-- <div class="app-heading"> --}}
        <div class="row" style="float: right; margin-right: 14px; margin-bottom: 10px;">
            <button onclick="window.history.back();"  class="btn btn-success"><span class="fa fa-arrow-left"></span> {{translate('voltar')}}</button>
        </div>
    {{-- </div> --}}
</div>
    <div class="row">
        <div class="col-md-6">
            <div class="row"> 
                <div class="col">
                    <!-- START PROJECT DETAILS -->
                    <div class="block block-condensed">
                        <div class="app-heading">
                            <div class="title">
                                <h1> {{translate('nome')}}: <strong>{{$project->p_name}} </strong> </h1>
                            </div>
                        </div>

                        <div class="block-content">
                            <div class="form-group">
                                <label class="control-label">{{translate('descricao')}}</label>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" cols="4" rows="10" disabled>{{$project->p_description}}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- END TRAFFIC SOURCES -->
                </div>
            </div>
        </div>

        <div class="col-md-6">
                <!-- START PROJECT DETAILS WITH VIDEO -->
                <div class="block block-condensed">
                    @if(!empty($video))
                        <div class="app-heading">
                            <div class="title">
                                <h3>{{translate('descricao_video')}}</h3>
                            </div>
                        </div>

                        <div class="block-content">
                            <video width="100%" height="300vh" controls>
                                <source src="{{!empty($video)? asset('video/'.$video->pv_video_path):""}}" type="{{"video/".$video->pv_mime_type}}">
                                {{-- <source src="mov_bbb.ogg" type="video/ogg">
                                Your browser does not support HTML video. --}}
                            </video>
                            <p>{{!empty($video)?$video->pv_title:translate('no_record')}}</p>
                        </div>
                    @else
                    <div class="block-content">
                        <div class="text-center">
                            <h5>{{translate('nenhum_video_encontrado')}}</h5>
                        </div>
                    </div>
                    @endif
                </div>
                <!-- END TRAFFIC SOURCES -->
            </div>

    </div>
    <div class="row">
                    <div class="col-md-6">

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
                                        <h4 class="text-rg text-bold">{{translate('autor_detalhes')}}<span class="text-muted pull-right"></span></h4>
                                        <div class="list-group list-group-inline">
                                            <div class="list-group-item col-md-4 col-sm-4">
                                                <span class="text-bold">{{translate('autor')}}</span><br>
                                                <span class="text-muted">{{ $project_author->s_name }}</span>
                                            </div>
                                            <div class="list-group-item col-md-4 col-sm-4">
                                                <span class="text-bold">{{translate('cargo')}}</span><br>
                                                <span class="text-muted text-danger">{{$project_author->r_description}}</</span>

                                            </div>

                                            <div class="list-group-item col-md-4 col-sm-4">
                                                @if(!empty($collaborator))
                                                    <span class="text-bold">{{translate('cism_collaborator')}}</span><br>
                                                    <span class="text-muted text-danger">{{!empty($collaborator->cism_collaborator)?$collaborator->cism_collaborator->staff->s_name:translate('nao_definido')}}</span>
                                                
                                                @else
                                                <span class="text-muted text-danger">{{translate('no_record')}}</span>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <div class="listing-item listing-item-with-icon">
                                        <span class="icon-file-add listing-item-icon text-success"></span>
                                        <h4 class="text-rg text-bold"><span class="text-muted pull-right"></span></h4>
                                        <div class="list-group list-group-inline margin-bottom-0">
                                            <div class="list-group-item col-md-4 col-sm-4">
                                                <span class="text-bold">{{translate('proposal_source')}}</span><br>
                                                <span class="text-muted">{{ $project->p_source}}</span>
                                            </div>
                                            <div class="list-group-item col-md-4 col-sm-4">
                                                <span class="text-bold">{{translate('proposta_financeira')}}</span><br>
                                                <span class="text-muted text-danger">{{ number_format($project->p_budget, 2, '.', ',') . $project->p_currency}}</span>
                                            </div>
                                            <div class="list-group-item col-md-4 col-sm-4">
                                                <span class="text-bold">{{translate('document_support')}}</span><br>
                                                @if(!empty($project->p_support_document))
                                                <span class="text-muted"><a href="{{ asset('docs/' . $project->p_support_document) }}" class="" target="_blank">{{$project->p_name}}<span class="icon-download"></span></a></span>
                                                @else   
                                                <span class="text-muted text-danger">
                                                    {{translate('no_record')}}
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="block-divider-text"><span class="fa fa-bookmark-o"></span></div>
                            <div class="block-content">
                                <div class="listing margin-bottom-0">
                                    <div class="listing-item listing-item-with-icon">


                                        <div class="list-group list-group-inline">
                                            <div class="list-group-item col-md-4 col-sm-4">
                                                <span class="text-bold">{{translate('project_page')}} </span><br>
                                                @if(!empty($project->p_web_url))
                                                <span class="text-muted"><a target="_blank" href="{{ $project->p_web_url}}" class="" ><span class="fa fa-chrome"></span>{{ $project->p_name}}</a></span>
                                                @else   
                                                <span class="text-muted text-danger">
                                                    {{translate('no_record')}}
                                                </span>
                                                @endif
                                            </div>
                                            <div class="list-group-item col-md-4 col-sm-4">
                                                <span class="text-bold">{{translate('data_submissao')}}</span><br>
                                                <span class="text-muted">{{ $project->p_submitted_at}}</span>
                                            </div>
                                            <div class="list-group-item col-md-4 col-sm-4">
                                                <span class="text-bold">{{translate('data_aprovacao')}}</span><br>
                                                <span class="text-muted text-danger">{{!empty($data_aprovacao)?$data_aprovacao->updated_at:translate('ainda_foi_aprovado')}}</</span>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            @if($project->p_consortium == 'sim')
                                <div class="block-divider-text"><span class="fa fa-bookmark-o"></span></div>
                                <div class="block-content">
                                    <div class="listing margin-bottom-0">
                                        <div class="listing-item listing-item-with-icon">


                                            <div class="list-group list-group-inline">
                                                <div class="list-group-item col-md-4 col-sm-4">
                                                    <span class="text-bold">{{translate('consortium_regime')}}</span><br>
                                                    <span class="text-muted text-danger">{{translate($project->p_consortium)}}</</span>
                                                </div>
                                                
                                                @foreach($member_consortium as $member)
                                                @foreach($member->consortiumMemberProject as $role)
                                                    <div class="list-group-item col-md-4 col-sm-4">
                                                        <span class="text-bold">{{$role->cmr_description}}</span><br>
                                                        <span class="text-muted">{{ $member->cmp_name}}</span>
                                                    </div>
                                                @endforeach
                                                @endforeach
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endif
                        </div>
                        <!-- END RECENT -->
                </div>
        <div class="col-md-6">
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <th>{{translate('quiz')}}</th>
                            <th>{{translate('answer')}}</th>
                        </thead>
                        <tbody>
                            @foreach ($answers as $answer)
                                <tr>
                                    <td>{{translate($answer->pq_description)}}</td>
                                    <td>{{translate($answer->pa_answer)}}</td>
                                    {{-- <td>{{$answer->pa_answer}}</td> --}}
                                </tr>
                            @endforeach
                            <tr></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
            <!-- END PAGE CONTAINER -->
    </div>
@endif

@endsection

