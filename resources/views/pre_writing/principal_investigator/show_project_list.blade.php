@extends('layout.template')
@section('page_title', translate('proposta_projecto_submetidos'))
{{-- @section('page_title_', 'submissão de propostas de projetos') --}}
@section('page_title_active', translate('lista'))
@section('user_role', session('role_name'))
@section('user_name', session('user_name'))
@section('page_name', 'Pre award')
@section('content')
<div class="row">
    <div class="block block-condensed">
        <div class="app-heading app-heading-small">
            <div class="col-lg-6 title">
                <h5> {{translate('proposta_projecto_submetidos')}}</h5>
            </div>
            <div class="row title" style="float: right; margin-right: 2px">
                <a class="btn btn-primary" href="{{route('pre_writing.register')}}"><span class="fa fa-plus"></span> {{translate('nova_proposta')}}</a>
            </div>
        </div>

        {{-- {{dd($project->count())}} --}}

        <div class="block-content">
            @if ($project->count() > 0)


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
                                <th>{{translate('estado_proposta')}}</th>
                                <th>{{translate('atualizado_ao')}}</th>
                                <th>{{translate('accoes')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($project as $key => $projects)

                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{ (!empty($projects->project_research_area))? $projects->project_research_area->sa_name : translate('nao_definido') }}</td>
                            <td>
                                <p><strong>{{ $projects->p_name }}</strong></p>
                            </td>
                            <td>{{$projects->p_acronym}}</td>
                            {{-- <td>{{$projects->p_consortium}}</td> --}}
                            {{-- <td>{{$projects->p_submitted_at}}</td> --}}
                            <td>{{date('d-m-Y H:i:s', strtotime($projects->p_submitted_at))}}</td>
                            {{-- <td>{{$projects->p_deadline}}</td> --}}
                            <td>{{date('d-m-Y', strtotime($projects->p_deadline))}}</td>
                            <td>{{ number_format($projects->p_budget, 2, '.', ',') . ' '.$projects->p_currency}}</td>
                            <td>
                                @if($projects->p_state == 'Aprovado')
                                    {{ 'Proposta na fase de '. $projects->project_stage_micro->psm_name }}
                                @elseif($projects->p_state == 'Em curso')
                                {{ $projects->project_stage_micro->psm_name }}
                                @else
                                    {{!empty($projects->project_state)?$projects->project_state->project_state->s_description:translate('nao_definido') }}
                                @endif
                            </td>
                            {{-- <td>{{$projects->updated_at }}</td> --}}
                            <td>{{date('d-m-Y H:i:s', strtotime($projects->updated_at))}}</td>
                            <td>
                                {{-- @if(!$projects->p_state == 'Aprovado' || !$projects->p_state == 'Em curso') --}}
                                @if($projects->p_state == 'Em curso' && $projects->psm_id < 2)
                                    <button type="button" class="btn btn-danger delete_project" nome-project="{{ $projects->p_name }}" project-id="{{ base64_encode($projects->p_id) }} " data-toggle="modal" data-target="#modal-danger"><span class="fa fa-trash"></span></button>
                                @endif

                                <input type="hidden" id="project_name" value="{{ $projects->p_name }}">
                                {{-- <button class="btn btn-danger" data-toggle="modal" data-target="#modal-danger"> <span class="fa fa-trash"></span> </button> --}}
                                @if($projects->p_state == 'Aprovado' || $projects->p_state == 'Em curso' && $projects->psm_id > 1)
                                    <a
                                        href="{{route('configs.edit', base64_encode($projects->p_id))}}"
                                        class="btn btn-success"><span class="fa fa-eye"></span>
                                    </a>
                                @endif
                                <a
                                    href="{{route('pre_writing.pi.register', base64_encode($projects->p_id))}}"
                                    class="btn btn-default"><span class="fa fa-info"></span>
                                </a>

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
        <!-- START HEADING -->
        </div>

    </div>

</div>

<!-- MODAL DANGER -->
<div class="modal fade" id="modal-danger" tabindex="-1" role="dialog" aria-labelledby="modal-danger-header">
    <div class="modal-dialog modal-danger" role="document">
        <button type="button" class="submit" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-danger-header">{{translate('apagar_projecto')}}</h4>
            </div>
            <form action="{{ route('investigator.remove_project') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="project_id" value="" id="project_id">
                    <div class="form-group">
                        <div class="col-md-6">
                            <div class="input-group">
                                {{-- <input type="text" id="p_name" class="form-control" value=""> --}}

                            </div>
                        </div>
                        <h3> {{translate('tem_certeza_remove_projeto')}} <strong id="nome_projeto">  </strong> ? </h3>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">{{translate('cancelar')}}</button>
                    <button type="submit" id="btn_remove" class="btn btn-danger ">{{translate('submeter')}}</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- END MODAL DANGER -->
@endsection

@section('scripts')
 <script>

    $(function(){
        $(".delete_project").click(function(e){
            e.preventDefault();
            var id_project = $(this).attr("project-id");
            var nome_project = $(this).attr("nome-project");

            var project_name = $("#project_name").val();
            $("#project_id").val(id_project);
            $("#nome_projeto").text(nome_project);

        });

        $("#btn_remove").click(function(){
            var id_project = $("#p_id").val();
            //id_project.replace();


            // $.ajax({
            //     url: ,
            //     dataType: 'json',
            //     type: 'POST',
            //     //data: formData,
            //     beforeSend: function () {
            //         $('#carregamento').css("display", "block");
            //     },
            //     complete: function () {
            //         $('#carregamento').css("display", "none");
            //     },
            //     error: function () {
            //         swal({
            //             title: "erro",
            //             text: "Houve um erro",
            //             icon: "error",
            //             button: "Confirmar"
            //         });
            //         $('#carregamento').css("display", "none");

            //         return false;
            //     },
            //     success: function (data) {
            //         // alert(data);
            //         if (data.state==200) {
            //             swal({
            //                 title: "Sucesso",
            //                 text: data.message,
            //                 icon: "success",
            //                 button: "Confirmar"
            //             }).then(function () {
            //                 location.reload();
            //             })
            //         } else {
            //             swal({
            //                 title: "Erro!",
            //                 text: data.message,
            //                 icon: "error",
            //                 button: "Confirmar"
            //             });
            //         }
            //         return false;

            //     },
            //     cache: false,
            //     contentType: false,
            //     processData: false
            // });
        });

    });

 </script>
@endsection
