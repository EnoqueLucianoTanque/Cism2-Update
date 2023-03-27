@extends('layout.template')
@section('page_title', 'Lista de projectos')
@section('page_title_', 'Projeto submetidos para aprovação')
@section('user_role', session('role_name'))
@section('user_name', session('user_name'))
@section('page_name', 'Projetos')
@section('content')
<div class="row">
    <div class="block block-condensed">
        <div class="app-heading app-heading-small">
            <div class="col-lg-6 title">
                <h5> Projectos Submetidos</h5>
            </div>
            <div class="col-lg-6 title text-right">
                <a class="btn btn-primary" href="{{route('pre_writing.register')}}">Novo projeto</a>
            </div>
        </div>
        {{-- {{ dd($project) }} --}}
        
        <!-- END HEADING -->
{{-- @if($project->count() > 0) --}}
        <div class="table-responsive">
            <table class="table table-striped table-bordered datatable-extended">
                <thead>
                    <tr>
{{--                        <th>#</th>--}}
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Data de Submissão</th>
                        <th>Previsão de término</th>
                        <th>Orçamento</th>
                        <th>Estado</th>
                        <th>Acções</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($project as $projects)
                  {{-- @foreach ($projects->project_submitted as $state) --}}
                  <tr>
{{--                      <td>--}}

{{--                      </td>--}}
                      <td>
                          <p><strong>{{ $projects->p_name }}</strong></p>
                      </td>
                      <td>{{$projects->p_description}}</td>
                      {{-- <td>{{$projects->p_submitted_at}}</td> --}}
                      <td>{{date('d-m-Y H:i:s', strtotime($projeto->p_submitted_at))}}</td>
                      <td>{{$projects->p_deadline}}</td>
                      <td>{{$projects->p_budget}}</td>
                      <td>
                          <select class="bs-select" name="user_1" disabled>
                              <option selected="1">{{$projects->p_state}}</option>
                          </select>
                      </td>
                      <td>
                          @if($projects->p_state == 'Aprovado')
                            <a
                                href="{{route('configs.edit', base64_encode($projects->p_id))}}"
                                class="btn btn-default btn-icon"><span class="fa fa-eye"></span>
                            </a>
                          @endif
                          @if($projects->p_state == 'Aprovado')
                            <a
                                href="{{route('configs_post_award.edit', base64_encode($projects->p_id))}}"
                                class="btn btn-default btn-icon"><span class="fa fa-gears"></span>
                            </a>
                          @endif
                          {{-- <button class="btn btn-default btn-icon"><span class="fa fa-times"></span></button> --}}
                      </td>
                  </tr>
                  {{-- @endforeach --}}
                  @endforeach

                </tbody>
            </table>
        </div>
      <!-- START HEADING -->

  {{-- @else
  <div><h5>Nenhum projecto foi submetido</h5></div>
  @endif --}}

    </div>

</div>
@endsection
