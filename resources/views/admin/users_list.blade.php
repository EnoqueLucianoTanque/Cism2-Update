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
            <div class=" text-right">
                <a class="btn btn-primary" href="{{route("admin.register")}}"><span class="fa fa-plus"></span> {{translate('registo_novo_usuario')}}</a>
            </div>
        </div>
        <!-- END HEADING -->
        @if(!empty($users))
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
                                    @if($user->state==1)
                                        <td> <label class="label label-info" >{{translate('activo')}}</label> </td>
                                    @else
                                    <td> <label class="label label-danger" >{{translate('inactivo')}}</label> </td>
                                    @endif
                                    <td>
                                        @if ($user->state == 1)
                                            <a 
                                            href="#"
                                            data-href="{{route("admin.user_remove", base64_encode($user->u_id))}}"
                                            data-toggle="modal"
                                            data-target="#modal-danger"
                                            class="btn btn-danger delete_user">
                                            <span class="fa fa-user-times"></span>
                                        </a>                                        
                                        <button
                                            data-toggle="modal"
                                            data-target="#modal-info"
                                            user-id="{{base64_encode($user->u_id)}}"
                                            user-name="{{!empty($user->staff)?$user->staff->s_name:""}}"
                                            user-email="{{$user->email}}"
                                            user-role="{{!empty($user->roles)?$user->roles->r_description:translate('nao_definido')}}"
                                            user-contact="{{!empty($user->staff_contacts)?$user->staff_contacts->sc_contact:translate('nenhum_contacto_encontrado')}}"
                                            class="btn btn-info update_role"
                                            ><span class="fa fa-refresh"></span></button>
                                        @else
                                        <a 
                                            href="#"
                                            data-href="{{route("admin.user_remove", base64_encode($user->u_id))}}"
                                            data-toggle="modal"
                                            data-target="#modal-warning"
                                            class="btn btn-warning active_user">
                                            <span class="fa fa-undo"></span>
                                        </a>  
                                            {{-- <button
                                            data-toggle="modal"
                                            data-target="#modal-warning"
                                            user-name="{{!empty($user->staff)?$user->staff->s_name:""}}"
                                            user-id="{{base64_encode($user->u_id)}}"
                                            class="btn btn-warning active_user">
                                            <span class="fa fa-undo"></span>
                                        </button> --}}
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
                    <p class="text-center"> <strong> {{translate('nenhum_usuario_encontrado')}}</strong></p>
                </div>
            </div>
        @endif

    </div>

</div>

<div class="modal fade" id="modal-danger" tabindex="-1" role="dialog" aria-labelledby="modal-danger-header">
    <div class="modal-dialog modal-danger" role="document">
        <button type="button" class="submit" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-danger-header">{{translate('desabilitar_usuario')}}</h4>
            </div>
            <div class="modal-body">
                <h3>{{translate('tem_certeza_desabilitar_usuario')}}</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">{{translate('cancelar')}}</button>
                <a class="btn btn-danger btn-ok">{{translate('confirmar')}}</a>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modal-warning" tabindex="-1" role="dialog" aria-labelledby="modal-success-header">
    <div class="modal-dialog modal-success" role="document">
        <button type="button" class="submit" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-danger-header">{{translate('activar_utilizador')}}</h4>
            </div>
            <div class="modal-body">
                <h3> {{translate('tem_certeza_activar_usuario')}} <strong id="nome_user2"> </strong> ? </h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">{{translate('cancelar')}}</button>
                <a class="btn btn-success btn-ok">{{translate('confirmar')}}</a>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modal-info" tabindex="-1" role="dialog" aria-labelledby="modal-success-header">
    <div class="modal-dialog modal-success" role="document">
        <button type="button" class="submit" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-danger-header">{{translate('actualizar_usuario')}}</h4>
            </div>
            <form action="{{route("admin.user_update_role")}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label">{{translate('nome_completo')}}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="nome_usuario" id="nome_usuario" value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">{{translate('email')}}</label>
                        <div class="col-md-10">
                            <input type="email" class="form-control" name="email" id="user_email" value="" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">{{translate('nr_celular')}}</label>
                        <div class="col-md-10">
                            <div class="input-group">
                                <span class="input-group-addon">+258</span>
                                <input name="contacto" type="tel" class="form-control" placeholder="número de celular." id="user_contact" required>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="user_id" value="" id="user_id">
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="">{{translate('permissao')}}</label>
                        <div class="col-md-10">
                            <select class="bs-select" name="roles" title="Escolha a nova permisssão"required>
                                @foreach ($roles as $role)
                                    <option value="{{base64_encode($role->r_id)}}">{{$role->r_description}}</option>
                                @endforeach
                            </select>
                            <small style="color: red">{{translate('permissao_actual')}} <strong id="role_name"> </strong>.</small>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <button type="button" class="btn btn-link col-md-6" data-dismiss="modal">{{translate('cancelar')}}</button>
                        <div class="col-md-6">
                            <button type="submit" id="btn_remove" class="btn btn-success ">{{translate('actualizar')}}</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- END MODAL DANGER -->
@endsection

@section('scripts')
 <script>
     $('#modal-danger').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
     $('#modal-warning').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

        $(".update_role").click(function(e){
            e.preventDefault();
            var id_user = $(this).attr("user-id");
            var nome_usuario = $(this).attr("user-name");
            var email = $(this).attr("user-email");
            var contact = $(this).attr("user-contact");
            var user_role = $(this).attr("user-role");

            $("#user_id").val(id_user);
            $("#nome_usuario").val(nome_usuario);
            $("#user_email").val(email);
            $("#user_contact").val(contact);
            $("#role_name").text(user_role);

        });
    $(function(){

        $(".delete_user").click(function(){
            var id_user = $(this).attr("user-id");
            var nome= $(this).attr("user-name");
            $("#user_id2").val(id_user);
            $("#nome_user").text(nome);
        });

        $(".active_user").click(function(){
            var id_user = $(this).attr("user-id");
            var nome= $(this).attr("user-name");
            $("#user_id3").val(id_user);
            $("#nome_user2").text(nome);
        });

});

</script>
@endsection



