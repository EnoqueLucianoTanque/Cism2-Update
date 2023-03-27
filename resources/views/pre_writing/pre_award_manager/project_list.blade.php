@extends('layout.template')
@section('page_name', translate('proposta_projecto_submetidos'))
@section('page_title_', 'Pre award ')
@section('page_title', translate('start_page')) 
{{-- @section('page_title_active', 'Lista de propostas de projetos') --}}
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
@if(count($projetos) > 0)
<div class="block-content">
    <div class="table-responsive">
        <table class="table table-striped table-bordered datatable-extended">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{translate('area_pesquisa')}}</th>
                    <th>{{translate('nome')}}</th>
                    <th>{{translate('acronimo')}}</th>
                    <th>{{translate('data_submissao')}}</th>
                    <th>{{translate('data_termino')}}</th>
                    <th>{{translate('proposta_financeira')}}</th>
                    <th>{{translate('consortium_regime')}}</th>
                    <th>{{translate('atualizado_ao')}}</th>
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
                <td>{{ (!empty($projeto->project_research_area))? $projeto->project_research_area->sa_name : "não definido" }}</td>
                <td>
                    <p><strong>{{ $projeto->p_name }}</strong></p>
                </td>
                <td>{{ $projeto->p_acronym }}</td>
                {{-- <td>{{Str::substr($projeto->p_description, 0, 255) }}</td> --}}
                <td>{{$projeto->p_submitted_at}}</td>
                <td>{{$projeto->p_deadline}}</td>
                <td>{{ number_format($projeto->p_budget, 2, '.', ',') . ' '.$projeto->p_currency}}</td>
                <td>{{translate($projeto->p_consortium)}}</td>
                <td>{{$projeto->updated_at}}</td>
                  @if($projeto->p_state === 'Em curso' && $projeto->psm_id == 1)
                      <td class="bg-success">
                          {{translate('proposta_submetida')}}
                      </td>
                    @elseif($projeto->p_state === 'Em curso' && $projeto->psm_id > 1)
                    <td>
                        {{ $projeto->project_stage_micro->psm_name }}
                    </td>
                  @elseif ($projeto->p_state === 'Rejeitado')
                      <td class="bg-danger">
                          {{translate($projeto->p_state)}}
                      </td>
                  @else
                      <td class="bg-warning">
                          {{translate("proposta_preparacao_interna")}}
                      </td>
                  @endif
                <td>
                    {{-- @if(Auth::user()->can("scientific_director") && $projeto->psm_id == 0) --}}
                    @if(session('role') == 12 && $projeto->psm_id == 0)
                        <a href="{{route('scientific_director.approval', ['id' => base64_encode($projeto->p_id)])}}" class="btn btn-default btn-icon"><span class="fa fa-eye"></span></a>         
                        
                    @elseif (Auth::user()->can("pre_award_manager"))
                        <a href="{{route('pam.project_detail', ['id' => base64_encode($projeto->p_id)])}}" class="btn btn-default btn-icon"><span class="fa fa-eye"></span></a>
                    @endif
                    @if($projeto->psm_id == 4 && $projeto->p_state == "Em curso")
    
                        <a
                            href="{{route('pam.project_approval', base64_encode($projeto->p_id))}}"
                            class="btn btn-default btn-icon"><span class="fa fa-pencil"></span>
                        </a>
                    @endif
                </td>
            </tr>
              @endforeach
            </tbody>
        </table>
    </div>
</div>

  @else
    <div class="row">
        <div class="col-sm-12">
            <img src="{{asset('img/ilustrator/no_data.svg')}}"
                class="img-responsive center-block d-block mx-auto"
                height="152px"
                width="152px"
            >
            <p class="text-center"> <strong> {{translate('no_record')}}</strong></p>
        </div>
    </div>
  @endif

                      </div>

</div>
@endsection
