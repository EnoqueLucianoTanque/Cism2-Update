@extends('layout.template')
@section('page_title', 'Study Phase')
@section('page_title_', translate('actualizar'))
@section('user_role', session('role_name'))
@section('user_name', session('user_name'))
@section('page_name', 'Study phase')

@section("content")
<div class="row">
    <div class="block block-condensed">
        <div class="app-heading app-heading-small">
            <div class="col-lg-6 title">
                <h5> {{translate('projeto_associado')}}</h5>
            </div>
        </div>

        <div class="block-content">
            {{-- {{dd($projects)}} --}}
            @if(count($projects) > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-bordered datatable-extended">
                        <thead>
                            <th>#</th>
                            <th>{{translate('nome')}}</th>
                            <th>{{translate('acronimo')}}</th>
                            <th>PI</th>
                            <th>CO-PI</th>
                            <th>{{translate('objectivos')}}</th>
                            {{-- <th>{{translate('data_inicial')}}</th> --}}
                            <th>{{translate('resultado_preliminares')}}</th>
                            <th>{{translate('local_implementacao')}}</th>
                            <th>{{translate('pop_alvo')}}</th>
                            <th>{{translate('ponto_situacao')}}</th>
                            <th>{{translate('accoes')}}</th>
                        </thead>
                        <tbody>
                            @foreach($projects as $key => $project)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{!empty($project->project)?$project->project->p_name:translate('nao_definido')}}</td>
                                    <td>{{$project->pc_acronym}}</td>
                                    <td>{{$project->pc_pi}}</td>
                                    <td>{{$project->pc_co_pi}}</td>
                                    <td>{{substr($project->pc_objective,0,50)}}</td>
                                    <td>{{substr($project->pc_prelliminary_results,0,50)}}</td>
                                    {{-- <td>{{$project->pc_end_date}}</td> --}}
                                    <td>{{$project->p_data_collection_location}}</td>
                                    <td>{{$project->p_target_population}}</td>
                                    <td>{{$project->p_actual_state}}</td>
                                    <td>
                                        <button
                                            type="button"
                                            {{-- data-href="{{route("post_award.project_charter_update")}}" --}}
                                            class="btn btn-primary"
                                            id-project="{{base64_encode($project->pc_id)}}"
                                            data-toggle="modal"
                                            data-target="#modal-add-articles"
                                            id="btn_show_modal"
                                            {{-- onclick="getId({{base64_encode($project->pc_id)}})" --}}
                                            >
                                            <span class="fa fa-refresh"> </span>
                                            {{translate('actualizar')}}
                                        </button>
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
                            height="152px"
                            width="152px"
                            alt="Sample Image">
                        <p class="text-center">{{translate('no_record')}}</p>
                    </div>
                </div>
            @endif


        </div>
    </div>
</div>


<div class="modal fade" id="modal-add-articles" tabindex="-1" role="dialog" aria-labelledby="modal-success-header">
    <div class="modal-dialog modal-success modal-lg" role="document">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-success-header">{{translate('actualizar')}}</h4>
            </div>
            <form action="{{route("post_award.project_charter_update")}}" method="POST" id="form_update_project"  class="form-horizontal" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="pc_id" id="p_id" value="">

                    <div class="form-group">
                        <label class="col-md-3 control-label"><small style="color: red;">*</small> {{translate('objectivos')}}</label>
                        <div class="col-md-9">
                            <textarea class="form-control" rows="4" name="pc_objective" >{{old("pc_objective")}}</textarea>
                            @error('pc_objective')
                                <span style="color: red"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label"><small style="color: red;">*</small> {{translate('resultado_preliminares')}}</label>
                        <div class="col-md-9">
                            <textarea class="form-control" rows="4" name="pc_prelliminary_results" >{{old("pc_prelliminary_results")}}</textarea>
                            @error('pc_prelliminary_results')
                                <span style="color: red"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 control-label" for="deadline"><small style="color: red;">*</small> {{translate('local_implementacao')}}</label>
                            <div class="col-md-9">
                                <input value="{{ old('p_data_collection_location') }}" type="text"  name="p_data_collection_location" class="form-control" required>
                                @error('p_data_collection_location')
                                    <span style="color: red"> {{ $message }}</span>
                                @enderror
                            </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="deadline"><small style="color: red;">*</small> {{translate('pop_alvo')}}</label>
                            <div class="col-md-9">
                                <input value="{{ old('p_target_population') }}" type="text"  name="p_target_population" class="form-control" required>
                                @error('p_target_population')
                                    <span style="color: red"> {{ $message }}</span>
                                @enderror
                            </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="deadline"><small style="color: red;">*</small> {{translate('ponto_situacao')}}</label>
                            <div class="col-md-9">
                                <input value="{{ old('p_actual_state') }}" type="text" size="20" name="p_actual_state" class="form-control" required>
                                @error('p_actual_state')
                                    <span style="color: red"> {{ $message }}</span>
                                @enderror
                            </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="deadline"><small style="color: red;">*</small> {{translate('documento_descritivo')}}</label>
                        <div class="col-md-9">
                            <input value="{{ old('document') }}" type="file" required accept="file_extension/.docx, .doc, .pdf" name="document" class="form-control">
                            @error('document')
                                <span style="color: red"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">{{translate('fechar')}}</button>
                    {{-- <a class="btn btn-success btn_ok" >{{translate('actualizar')}}</a> --}}
                    <button type="submit" class="btn btn-success" >{{translate('actualizar')}}</button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection

@section("scripts")
<script>
    $('#modal-add-articles').on('show.bs.modal', function(e) {
        $(this).find("#p_id").attr("value", $(e.relatedTarget).attr('id-project'));
    });
    

    
</script>
@endsection
