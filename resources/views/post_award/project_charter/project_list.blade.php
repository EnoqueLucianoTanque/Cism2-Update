@extends('layout.template')
@section('page_title', 'Project Charter')
@section('page_title_', 'Projetos aprovados para o financiamento')
{{-- @section('page_title_active', 'Lista') --}}
@section('user_role', session('role_name'))
@section('user_name', session('user_name'))
@section('page_name', 'Post award')
@section('content')
<div class="row">
    <div class="block block-condensed">
        <div class="app-heading app-heading-small">
            <div class="col-lg-6 title">
                <h5>Atualização dos Projetos aprovados para a fase de preparação</h5>
            </div>
            <div class="row title" style="float: right; margin-right: 2px">
                <button onclick="window.history.back();" class="btn btn-success"> <span class="fa fa-arrow-left"></span> voltar</button>
            </div>
        </div>

        <div class="block-content">
            @if (!empty($projects))
            <div class="table-responsive">
                <table class="table table-striped table-bordered datatable-extended">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{translate('area_pesquisa')}}</th>
                            <th>{{translate('nome')}}</th>
                            <th>{{translate('acronimo')}}</th>
                            <th>{{translate('data_submissao')}}</th>
                            <th>{{translate('previsao_termino')}}</th>
                            <th>{{translate('proposta_financeira')}}</th>
                            <th>{{translate('estado')}}</th>
                            <th>{{translate('accoes')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $key => $project)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$project->sa_name}}</td>
                                <td>{{$project->p_name}}</td>
                                <td>{{$project->p_acronym}}</td>
                                {{-- <td>{{$project->p_submitted_at}}</td> --}}
                                <td>{{date('d-m-Y H:i:s', strtotime($projeto->p_submitted_at))}}</td>
                                <td>{{$project->p_deadline}}</td>
                                <td>{{ number_format($project->p_budget, 2, '.', ',') . ' '.$project->p_currency}}</td>
                                <td>{{$project->s_description}}</td>
                                <td>
                                    <a href="{{route('post_award.project_charter_create', base64_encode($project->p_id))}}">{{translate('actualizar')}}</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            @else
            <div class="row">
                <div class="col-sm-12">
                    <img src="{{asset('img/ilustrator/no_data.svg')}}"
                        class="img-responsive center-block d-block mx-auto"
                        height="90px"
                        width="90px"
                        alt="Sample Image">
                    <p class="text-center">{{translate('no_record')}}</p>
                </div>
            </div>

            @endif

            {{-- @if ($project->count() > 0) --}}




        <!-- START HEADING -->
        </div>

    </div>

</div>

@endsection
