@extends('web.layout.template')
@section('styles')

{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

@endsection

@section('content')
    <div class="page-banner overlay-dark bg-image" style="background-image: url({{asset('web/assets/img/bg_image_1.jpg')}});">
    <div class="banner-section">
      <div class="container text-center wow fadeInUp">
        <nav aria-label="Breadcrumb">
          <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
            <li class="breadcrumb-item"><a href="{{route('cism.home')}}">{{translate('inicio')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{translate('projectos')}}</li>
          </ol>
        </nav>
        <h1 class="font-weight-normal">{{translate('projectos')}}</h1>
      </div> <!-- .container -->
    </div> <!-- .banner-section -->
  </div> <!-- .page-banner -->

  <div class="page-section">
    <div class="container">

      <div class="row justify-content-center">
        <div class="col-lg-12 wow fadeInUp">
            <h1 class="text-center mb-3">{{translate('relatorio_estado_projecto')}} (pre-award/post-award)</h1>

            <div class="m-4">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="nav-item">
                        <a href="#home" class="nav-link active" data-bs-toggle="tab">Post Award</a>
                    </li>
                    <li class="nav-item">
                        <a href="#profile" class="nav-link" data-bs-toggle="tab">Pre Award</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="home">
                        <h4 class="mt-2" style="margin-top: 20px">{{translate('ponto_situacao')}}</h4>
                        <div class="col-lg-12 mt-6">
                            <h1 class="text-center mb-6 wow fadeInUp"></h1>
                            <div class="row justify-content-center">
                                @if(count($projects)>0)
                                <div class="table-responsive">
                                    <table id="pre_award" class="table table-striped datatable-extended" >
                                        <thead>
                                            {{-- <tr> --}}
                                                <th class="th-sm">#</th>
                                            <th class="th-sm">{{translate('area_pesquisa')}}</th>
                                            <th class="th-sm">{{translate('nome_interno')}}</th>
                                            <th class="th-sm">PI</th>
                                            <th class="th-sm">CO-PI</th>
                                            <th class="th-sm">{{translate('inicio_recrutamento')}}</th>
                                            <th class="th-sm">{{translate('previsao_fim_recrutamento')}}</th>
                                            <th class="th-sm">{{translate('local_recolha_dados')}}</th>
                                            <th class="th-sm">{{translate('pop_alvo')}}</th>
                                            <th class="th-sm">{{translate('ponto_situacao')}}</th>
                                            <th class="th-sm">{{translate('accoes')}}</th>
                                            {{-- </tr> --}}
                                        </thead>
                                        <tbody>
                                            @foreach($projects as $key=>$project)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$project->sa_name}}</td>
                                                    <td>{{$project->pc_acronym}}</td>
                                                    <td>{{$project->pc_pi}}</td>
                                                    <td>{{$project->pc_co_pi}}</td>
                                                    {{-- <td>{{$project->pc_start_date}}</td>
                                                    <td>{{$project->pc_end_date}}</td> --}}
                                                    <td>{{date('d-m-Y', strtotime($project->pc_start_date))}}</td>
                                                    <td>{{date('d-m-Y', strtotime($project->pc_end_date))}}</td>
                                                    <td>{{$project->p_data_collection_location}}</td>
                                                    <td>{{$project->p_target_population}}</td>
                                                    <td>{{$project->p_actual_state}}</td>
                                                    <td>
                                                        <a href="{{route('cism.project_details', base64_encode($project->p_id))}}" class="btn btn-link"> <span class="mai-info"></span> {{translate('detalhes')}}</a>
                                                    </td>
                                                </tr>
                                            @endforeach
    
                                        </tbody>
                                    </table>

                                </div>
                                @else   
                                    <p>{{translate("no_record")}}</p>
                                @endif
                            </div>
                        </div>

                    </div>
                    
                    <div class="tab-pane fade" id="profile">
                        <h4 class="mt-2">{{translate('ponto_situacao')}}</h4>
                        <div class="col-lg-12 mt-6">
                            <h1 class="text-center mb-6 wow fadeInUp"></h1>
                            <div class="row justify-content-center">
                                @if(count($projects_pre_award)>0)
                                    <div class="table-responsive">
                                        <table id="post_award" class="table table-striped datatable-extended" >
                                            <thead>
                                                <th class="th-sm">#</th>
                                                <th class="th-sm">{{translate('area_pesquisa')}}</th>
                                                <th class="th-sm">{{translate('acronym')}}</th>
                                                <th class="th-sm">{{translate('nome')}}</th>
                                                <th class="th-sm">{{translate('descricao')}}</th>
                                                <th class="th-sm">{{translate('previsao_inicio')}}</th>
                                                <th class="th-sm">{{translate('previsao_termino')}}</th>
                                                <th class="th-sm">{{translate('estado')}}</th>
                                                <th class="th-sm">{{translate('accoes')}}</th>
                                                
                                            </thead>
                                            <tbody>
                                                @foreach($projects_pre_award as $key => $project)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{!empty($project->project_research_area)?$project->project_research_area->sa_name:translate("nao_definido")}}</td>
                                                        <td>{{$project->p_acronym}}</td>
                                                        <td>{{$project->p_name}}</td>
                                                        <td>{!! substr($project->p_description,0,50)!!}</td>
                                                        {{-- <td>{{$project->p_submitted_at}}</td>
                                                        <td>{{$project->p_deadline}}</td> --}}
                                                        <td>{{date('d-m-Y', strtotime($project->p_submitted_at))}}</td>
                                                        <td>{{date('d-m-Y', strtotime($project->p_deadline))}}</td>
                                                        <td>{{!empty($project->project_stage_micro)?$project->project_stage_micro->psm_name:translate("nao_definido")}}</td>
                                                        <td>
                                                            <a href="{{route('cism.proposal_details', base64_encode($project->p_id))}}" class="btn btn-link"> <span class="fa fa-info"></span> {{translate('detalhes')}}</a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                @else   
                                    <p>{{translate("no_record")}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
             </div>
        </div>
      </div>
    </div>
  </div>


@endsection

@section("scripts")
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function () {
        $('#pre_award').DataTable();
        $('#post_award').DataTable();
    });
</script>
@endsection
