@extends('layout.template')
@section('page_title', 'Study Phase')
@section('page_title_', 'Relatórios adicionados')
@section('user_role', session('role_name'))
@section('user_name', session('user_name'))
@section('page_name', 'Relatorios submetidos')

@section("content")
<div class="row">
    <div class="block block-condensed">
        <div class="app-heading app-heading-small">
            <div class="col-lg-6 title">
                <h5> Lista de relatótios submetidos</h5>
            </div>
        </div>

        <div class="block-content">
            {{-- divv --}}
            <div class="table-responsive">
                <table class="table table-striped table-bordered datatable-extended">
                    <thead>
                        <th>#</th>
                        <th>Estudo</th>
                        <th>Relatório</th>
                        <th>Data de submissão</th>
                        <th>Documento</th>
                    </thead>
                    <tbody>
                        @foreach($reports as $task)
                        @if(!empty($task->files))
                        @foreach($task->files as $key => $reports)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$task->t_name}}</td>
                                <td>{{$reports->f_description}}</td>
                                <td>{{$reports->f_start_date}}</td>
                                <td>
                                    <a href="{{asset('docs').'/'.$reports->f_path}}" target="_blank" rel="noopener noreferrer" class="btn btn-link"> <span class="icon-download" >Baixar</span> </a>
                                </td>

                                </td>
                            </tr>
                        @endforeach
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

