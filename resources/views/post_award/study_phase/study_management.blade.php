@extends('layout.template')
@section('page_title', 'Study Phase')
@section('page_title_', 'Formulário para gestão de estudos')
@section('user_role', session('role_name'))
@section('user_name', session('user_name'))
@section('page_name', 'Study phase')

@section("content")
<div class="row">
    <div class="block block-condensed">
        <div class="app-heading app-heading-small">
            <div class="col-lg-6 title">
                <h5> Lista de Estudos Em curso</h5>
            </div>
        </div>

        <div class="block-content">
            <div class="table-responsive">
                <table class="table table-striped table-bordered datatable-extended">
                    <thead>
                        <th>#</th>
                        <th>Projecto</th>
                        <th>Estudo</th>
                        <th>Data de inicio</th>
                        <th>Data fim</th>
                        <th>Estado</th>
                        <th>Relatório</th>
                    </thead>
                    <tbody>
                        @foreach($tasks as $key => $task)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$task->p_name}}</td>
                                <td>{{$task->t_description}}</td>
                                {{-- <td>{{$task->t_start_date}}</td> --}}
                                <td>{{date('d-m-Y H:i:s', strtotime($task->t_start_date))}}</td>
                                {{-- <td>{{$task->t_due_date}}</td> --}}
                                <td>{{date('d-m-Y H:i:s', strtotime($task->t_due_date))}}</td>
                                @if($task->c_name == "Em progresso")
                                    <td class="bg-success">{{$task->c_name}}</td>
                                @elseif($task->c_name == "Concluído")
                                    <td class="bg-info">{{$task->c_name}}</td>
                                @elseif($task->c_name == "Em revisão")
                                    <td class="bg-primary">{{$task->c_name}}</td>
                                @elseif($task->c_name == "Pendente")
                                    <td class="bg-danger">{{$task->c_name}}</td>
                                @endif
                                <td>
                                    <button
                                        type="button"
                                        class="btn btn-info"
                                        id-task="{{base64_encode($task->t_id)}}"
                                        data-toggle="modal"
                                        data-target="#modal-add-articles"
                                        id="btn_show_modal"
                                        >
                                        <span class="fa fa-plus"></span>
                                    </button>

                                    <a href="{{route('study_phase.show', base64_encode($task->t_id))}}" class="btn btn-info"> <span class="fa fa-eye"></span></a>
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-add-articles" tabindex="-1" role="dialog" aria-labelledby="modal-success-header">
    <div class="modal-dialog modal-success" role="document">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-success-header">Actualizar o estado</h4>
            </div>
            <form action="{{route('study_phase.store')}}" method="POST" id="form_submit" enctype="multipart/form-data">
            <div class="modal-body">
                    @csrf
                    <input type="hidden" name="task_id" value="" id="task_id">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Estado</label>
                        <div class="col-md-10">
                            <select name="estado" id="estado" class="bs-select">
                                <option value="" selected>Escolha o estado do estudo</option>
                                @foreach ($states as $state)
                                    <option value="{{$state->c_id}}">{{$state->c_name}}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="form-group" id="relatorio_estudo" hidden>
                        <label class="col-md-2 control-label">Relatório</label>
                        <div class="col-md-10">
                            <input type="file" name="relatorio" id="" accept="file_extension/.docx, .doc, .pdf" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success" >Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section("scripts")
<script>


    $("#btn_show_modal").on("click", function(e){
        e.preventDefault();
        // alert('Teste');
        var task_id = $(this).attr("id-task");
        $("#task_id").val(task_id);

    });

    $(document).ready(function(){

        $("#estado").on("change", function(){
            // alert("Teste");
            var estado = $(this).val();
            // console.log(estado);
            if(estado == 3 || estado ==4){
                console.log(estado);
                $("#relatorio_estudo").show();
            }else{
                $("#relatorio_estudo").hide();
            }
        });
    });
</script>
@endsection
