@extends("layout.template")
@section('page_name', 'Menu')
@section('page_title_', translate('gestao_utilizador'))
@section('page_title', translate('lista_usuarios'))
@section('page_title_active', translate('lista_usuarios'))
@section('user_role', session('role_name'))
@section('user_name', session('user_name'))

@section('content')
<div class="row">
    <div class="block block-condensed">
    <!-- START HEADING -->
        <div class="app-heading app-heading-small">
            <div class="title">
                <h5>{{translate('lista_usuarios')}}</h5>
            </div>
        </div>
        <!-- END HEADING -->
        @if(count($users) > 0)
        {{-- {{ dd($users[0]->staff_contacts->sc_contact) }} --}}
            <div class="block-content">
                <div class="table-responsive">

                    <table class="table table-striped table-bordered datatable-extended">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{translate('nome_completo')}}</th>
                                <th>{{translate('email')}}</th>
                                <th>{{translate('nr_celular')}}</th>
                                <th>{{translate('intituicao')}}</th>
                                <th>{{translate('permissao')}}</th>
                                <th>{{translate('estado')}}</th>
                                <th>{{translate('accoes')}}</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index =>$user)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{!empty($user->staff)?$user->staff->s_name:translate('nao_definido')}}</td>
                                    <td id="{{'user'.$index}}">{{$user->email}}</td>
                                    <td>{{!empty($user->staff_contacts)?$user->staff_contacts->sc_contact:translate('nenhum_contacto_encontrado')}}</td>
                                    <td>{{!empty($user->user_external_institution)?$user->user_external_institution->ui_description:translate('nao_definido')}}</td>
                                    {{-- <td>{{!empty($user)?$user->roles->r_description:"não definido"}}</td> --}}
                                    <td>{{!empty($user->roles)?$user->roles->r_description:translate('nao_definido')}}</td>
                                    
                                    <td> <label class="label label-danger" >{{translate('bloqueado')}}</label> </td>
                                    
                                    <td>
                                        {{-- <a href="#" data-href="delete.php?id=23" data-toggle="modal" data-target="#modal-info">Delete record #23</a> --}}
                                        <a
                                            href="#"
                                            data-href="{{route('unlock_user',base64_encode($user->u_id))}}" 
                                            data-toggle="modal" 
                                            data-target="#modal-info"
                                            class="btn btn-info"
                                            > <span class="fa fa-unlock-alt"></span> {{translate('desbloquear')}}
                                        </a>
                                        
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
                    <p class="text-center"> <strong> {{translate('nenhum_usuario_encontrado')}}</strong></p>
                </div>
            </div>
        @endif

    </div>
 
</div>


<!-- START MODAL INFO -->
<div class="modal fade" id="modal-info" tabindex="-1" role="dialog" aria-labelledby="modal-info-header">
    <div class="modal-dialog modal-info" role="document">
        <button type="button" class="submit" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-info-header">{{translate('desbloquear_usuario')}}</h4>
            </div>
            <div class="modal-body">
                <p>{{translate("tem_certeza_deseja_desbloquear")}}</p>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <button type="button" class="btn btn-link col-md-6" data-dismiss="modal">{{translate('cancelar')}}</button>
                    <div class="col-md-6">
                        <a class="btn btn-info btn-ok">{{translate('confirmar')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL INFO -->
@endsection

@section('scripts')
 <script>
     $('#modal-info').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });


</script>
@endsection



