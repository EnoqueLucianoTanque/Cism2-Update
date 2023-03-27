@extends('layout.template')
@section('page_title', translate('detalhe_proposta'))
@section('page_title_', translate('proposta_submetida'))
@section('user_role', session('role_name'))
@section('user_name', session('user_name')) 
@section('page_name', 'Pre-award')

@section('content')
@if($project->count() > 0)

    <div class="row">
        <div class="block block-condensed">
            <div class="app-heading">
                <div class="text-right">
                    <button onclick="window.history.back();"  class="btn btn-success"><span class="fa fa-arrow-left"></span> {{translate('voltar')}}</button>
                </div>
            </div>
        </div>
        <div class="col-md-6">

            <!-- START PROJECT DETAILS -->
            <div class="block block-condensed">
                <div class="app-heading">
                    <div class="title">
                        <h1> {{translate('nome')}}: <strong>{{$project->p_name}} </strong> </h1>
                    </div>
                </div>

                <div class="block-content">
                    <div class="form-group">
                        <label class="control-label">{{translate('description')}}</label>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" cols="4" rows="10" disabled>{{$project->p_description}}</textarea>
                    </div>
                </div>
            </div>
            <!-- END TRAFFIC SOURCES -->

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
                                @if(!empty($collaborator))
                                    <div class="list-group-item col-md-4 col-sm-4">
                                        <span class="text-bold">{{translate('cism_collaborator')}}</span><br>
                                        <span class="text-muted text-danger">{{!empty($collaborator->cism_collaborator)?$collaborator->cism_collaborator->staff->s_name:translate('no_record')}}</span>
                                    </div>
                                @endif
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
                                    <span class="text-muted text-danger">{{ number_format($project->p_budget, 2, '.', ',') . ' '. $project->p_currency}}</span>
                                </div>
                                <div class="list-group-item col-md-4 col-sm-4">
                                    <span class="text-bold">{{translate('document_support')}}</span><br>
                                    <span class="text-muted"><a href="{{ asset('docs/' . $project->p_support_document) }}" class="" target="_blank"><span class="icon-download text">{{translate('documento')}}</span></a></span>
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
                                    <span class="text-bold">{{translate('project_page')}}</span><br>
                                    <span class="text-muted"><a target="_blank" href="{{ $project->p_web_url}}" class="" ><span class="fa fa-chrome"></span>{{ $project->p_name}}</a></span>
                                </div>
                                <div class="list-group-item col-md-4 col-sm-4">
                                    <span class="text-bold">{{translate('data_submissao')}}</span><br>
                                    <span class="text-muted">{{ $project->p_submitted_at}}</span>
                                </div>
                                <div class="list-group-item col-md-4 col-sm-4">
                                    <span class="text-bold">{{translate('data_termino')}}</span><br>
                                    <span class="text-muted text-danger">{{ $project->p_deadline}}</</span>
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
                                    <span class="text-muted">{{translate($project->p_consortium)}}</span><br>
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
            <div class="block-divider-text"><span class="fa fa-bookmark-o"></span></div>
                <div class="block-content">
                    @if ( $project->p_state == "Em curso" && $project->psm_id > 1)
                                <div class="app-heading">
                                    <h3>{{translate('proposta_aprovada')}}</h3>
                                </div>
                                <div class="col">
                                    <div class="col-md-2 ">
                                        <img src="{{asset('img/ilustrator/submitted.png')}}" class="img-responsive center-block d-block mx-auto" alt="Sample Image">
                                    </div>
                                </div>

                            @else
                            <div class="app-heading">
                                <div class="title">
                                    <h3>{{translate('submission_form')}}</h3>
                                   
                                </div>
                            </div>
                            <div class="block-content">
                                <form action='{{route('pre_writing.second_scientific_approval')}}' method="POST" class="form-horizontal">
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">{{translate('projecto')}}</label>
                                        <div class="col-md-8">
                                            <select class="form-control" name="p_state" id="" {{($project->p_state == "Rejeitado"||$project->p_state == "Aprovado" )? 'disabled':''}}>
                                                <option value="">{{translate('select_answer')}} </option>
                                                <option value="Aprovado" {{$project->p_state == "Aprovado"? 'selected':''}}>{{translate('aprovado')}}</option>
                                                <option value="Rejeitado" {{$project->p_state == "Rejeitado"? 'selected':''}}>{{translate('rejeitado')}}</option>
                                            </select>
                                        </div>
                                        @error('p_state')
                                            <span style="color: red"> {{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <input type="hidden" name="project_id" value="{{ base64_encode($project->p_id) }}">
                                        <label class="col-md-4 control-label">{{translate('motivo')}}</label>
                                        <div class="col-md-8">
                                            <textarea name="reasons" rows="10"type="text" placeholder="opcional" {{($project->p_state == "Rejeitado"||$project->p_state == "Aprovado")? 'disabled':''}} class="form-control"></textarea>
                                            @error('reasons')
                                                <span style="color: red"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-8 text-right">
                                            <button
                                                type="submit"
                                                id="btn_submit"
                                                class="btn btn-primary" {{($project->p_state == "Reprovado"||$project->p_state == "Aprovado" )? 'disabled':''}}
                                            >{{translate('submission_resposta')}}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @endif
                </div>
            </div>
            <!-- END RECENT -->


        </div>

        <div class="col-md-6"> 
            @if (isset($video))
            @if(!empty($video))
            {{-- <div class="col-md-6"> --}}
                    <!-- START PROJECT DETAILS WITH VIDEO -->
                    <div class="block block-condensed">
                        <div class="app-heading">
                            <div class="title">
                                <h3>{{translate('descricao_video')}}</h3>
                            </div>
                        </div>

                        <div class="block-content">
                            <video width="100%" height="300vh" controls>
                                <source src="{{!empty($video)? asset('video/'.$video->pv_video_path):""}}" type="{{"video/".$video->pv_mime_type}}">
                                {{-- <source src="mov_bbb.ogg" type="video/ogg"> --}}
                                Your browser does not support HTML video.
                            </video>
                            <p>{{!empty($video)?$video->pv_title:translate('no_record')}}</p>
                        </div>
                    </div>
                    <!-- END TRAFFIC SOURCES -->
                {{-- </div> --}}
                @else
                <div class="block-content">
                    <h5>{{translate('no_record')}}</h5>
                </div>
                @endif
                @endif

        </div>
        <div class="col-md-6">
            <div class="app-heading app-heading-small">
                <div class="title">
                    <h5>{{translate('lista_resposta')}}</h5>
                </div>
            </div>
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
                                </tr>
                            @endforeach
                            <tr></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

        {{-- <div class="row">

            <div class="col-md-6">
                <!-- START PAGE CONTAINER -->


                        <div class="block block-condensed">


                        </div>

                <!-- END PAGE CONTAINER -->


            </div>

        </div> --}}


    {{-- </div> --}}
@endif

@endsection
@section('scripts')
<script>
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
    });
</script>
@endsection

