@extends('layout.template')
@section('user_role', session('role_name'))
@section('user_name', session('user_name'))
@section('page_title', translate('lista_projeto'))
@section('page_title_', translate('projectos'))
@section('page_title_active', 'Post award')
@section('content')
<div class="row">
<div class="block block-condensed">
    <div class="app-heading app-heading-small">
        <div class="title">
            <h5>{{translate('lista_projeto')}}</h5>

        </div>
    </div>
      <!-- END HEADING -->
      <div class="block-content">
          @if(count($projects) > 0)
          <div class="table-responsive">

            <table class="table table-striped table-bordered datatable-extended">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{translate('nome')}}</th>
                        <th>{{translate('acronimo')}}</th>
                        <th>{{translate('pi')}}</th>
                        <th>{{translate('co_pi')}}</th>
                        <th>{{translate('data_inicial')}}</th>
                        <th>{{translate('data_final')}}</th>
                        <th>{{translate('pop_alvo')}}</th>
                        <th>{{translate('local_recolha_dados')}}</th>
                        <th>{{translate('financiamento')}}</th>
                        <th>{{translate('accoes')}}</th>
                    </tr>
                </thead>                                                                                                              
                <tbody>
                  @foreach ($projects as  $key => $project)
                  <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$project->p_name}}</td>
                      <td>{{!empty($project->project_charter)?$project->project_charter->pc_acronym:translate("nao_definido")}}</td>
                      <td>{{!empty($project->project_charter)?$project->project_charter->pc_pi:translate("nao_definido")}}</td>
                      <td>{{!empty($project->project_charter)?$project->project_charter->pc_co_pi:translate("nao_definido")}}</td>
                      <td>{{!empty($project->project_charter)?$project->project_charter->pc_start_date:translate("nao_definido")}}</td>
                      <td>{{!empty($project->project_charter)?$project->project_charter->pc_end_date:translate("nao_definido")}}</td>
                      <td>{{!empty($project->project_charter)?$project->project_charter->p_target_population:translate("nao_definido")}}</td>
                      <td>{{!empty($project->project_charter)?$project->project_charter->p_data_collection_location:translate("nao_definido")}}</td>
                      <td>{{ number_format($project->p_general_budget, 2, '.', ',') . ' '.$project->p_currency}}</td>
                    <td>
                            @switch(Auth::user()->r_id)


                            @case(1)
                            @if($project->psm_id>=4)
                                <a
                                    href="{{route('configs_post_award.show', base64_encode($project->p_id))}}" 
                                    class="btn btn-default btn-icon"><span class="fa fa-eye"></span>
                                </a>
                                @else
                                <a
                                    href="{{route('configs_post_award.edit', base64_encode($project->p_id))}}"
                                    class="btn btn-default btn-icon"><span class="fa fa-gears"></span>
                                </a>


                            @endif
                            @break
                            @case(7)
                                <a
                                    href="{{route('configs_post_award.edit', base64_encode($project->p_id))}}"
                                    class="btn btn-default btn-icon"><span class="fa fa-gears"></span>
                                </a>
                            @break
                            @case(8)
                                <a
                                    href="{{route('configs_post_award.edit', base64_encode($project->p_id))}}"
                                    class="btn btn-default btn-icon"><span class="fa fa-gears"></span>
                                </a>
                            @break
                            @case(6)
                            <a
                                href="{{route('aprovacao_etica_show_details', base64_encode($project->p_id))}}"
                                class="btn btn-default btn-icon"><span class="fa fa-gears"></span>
                            </a>
                            @break
                            @case(5)
                            <a
                                href="{{route('aprovacao_científica_show_details', base64_encode($project->p_id))}}"
                                class="btn btn-default btn-icon"><span class="fa fa-gears"></span>
                            </a>
                            @break
                            @case(4)
                            <a
                                href="{{route('unidade_reguladora_show_details', base64_encode($project->p_id))}}"
                                class="btn btn-default btn-icon"><span class="fa fa-gears"></span>
                            </a>
                            @break
                            @default
                        @endswitch

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


  </div>                          <!-- START HEADING -->


</div>
@endsection
