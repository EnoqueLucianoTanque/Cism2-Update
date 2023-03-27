@extends('layout.template')
@section('page_name', translate('proposta_projecto_submetidos'))
@section('page_title_', 'Pre award ')
@section('page_title', translate('start_page')) 
@section('page_title_active', translate('lista_projeto'))
@section('user_role', session('role_name'))
@section('user_name', session('user_name'))
 
@section('content')
<div class="row">
    <div class="block block-condensed">
    <!-- START HEADING -->
        <div class="app-heading app-heading-small">
            <div class="title">
                <h5>{{translate('proposta_projecto_submetidos')}}</h5>

            </div>
        </div>
      <!-- END HEADING -->
        @if($projetos->count() > 0)
        <div class="block-content">
            <table class="table table-striped table-bordered datatable-extended">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{translate('area_pesquisa')}}</th>
                        <th>{{translate('nome')}}</th>
                        <th>{{translate('acronimo')}}</th>
                        <th>{{translate('data_submissao')}}</th>     
                        <th>{{translate('estado_proposta')}}</th>
                        <th>{{translate('accoes')}}</th>                         
                    </tr>
                </thead>
                <tbody>
                  @foreach ($projetos as $obj => $projeto)
                  <tr>
                      <td>
                        {{$obj + 1}}
                      </td>
                      <td>{{ (empty($projeto->project_research_area))? "não definido":$projeto->project_research_area->sa_name}}</td>
                    <td>
                        <p><strong>{{ $projeto->p_name }}</strong></p>
                    </td>
                    <td>{{$projeto->p_acronym}}</td>
                    {{-- <td>{{$projeto->p_submitted_at}}</td> --}}
                    <td>{{date('d-m-Y H:i:s', strtotime($projeto->p_submitted_at))}}</td>
                    <td>{{!empty($projeto->project_state)?translate($projeto->project_state->project_state->s_description):"Não definido"}}</td>

                    
                        <td>
                        <a href="{{route('grant.project_approval', ['id' => base64_encode($projeto->p_id)])}}" class="btn btn-default btn-icon"><span class="fa fa-eye"></span></a>
                        </td>
                    </tr>
                  @endforeach


                </tbody>
            </table>
        </div>

        @else
            <div class="row">
                <div class="col-sm-12">
                    <img
                        src="{{asset('img/ilustrator/no_data.svg')}}"
                        class="img-responsive center-block"
                        height="152px"
                        width="152px"
                        alt="Sample Image"
                    >
                    <p class="text-center"><strong>{{translate('no_record')}}</strong></p>
                </div>
            </div>
        @endif

    </div>

</div>
@endsection
