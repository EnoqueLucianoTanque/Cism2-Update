@extends("layout.template")
@section('page_name', 'Menu')
@section('page_title_', translate('gestao_utilizador'))
@section('page_title', translate('lista_financiador'))
@section('page_title_active', translate('lista_financiador'))
@section('user_role', session('role_name'))
@section('user_name', session('user_name'))

@section('content')
@if ($errors->any())
<div class="clearfix"></div> 
<div class="clearfix"></div> 
<div class="alert alert-danger" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
@endforeach
</div>
        
@endif
<div class="row">
    <div class="block block-condensed">
    <!-- START HEADING -->
        <div class="app-heading app-heading-small">
            <div class="title">
                <h5>{{translate('lista_financiador')}}</h5>
            </div>
            <div class=" text-right">
                
                <button
                    data-toggle="modal"
                    data-target="#modal-primary"
                    class="btn btn-primary">
                <span class="fa fa-floppy-o"> </span>
                {{translate('novo_financiador')}}
            </button>                
            </div>
        </div>
        <!-- END HEADING -->
        @if(count($funders) > 0)
            <div class="block-content">
                <div class="table-responsive">

                    <table class="table table-striped table-bordered datatable-extended">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{translate('nome_financiador')}}</th>
                                <th>{{translate('data_registo')}}</th>
                                <th>{{translate('estado')}}</th>
                                <th>{{translate('accoes')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($funders as $key => $funder)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$funder->f_name}}</td>
                                    <td>{{$funder->created_at}}</td>
                                    <td>
                                        @if ($funder->f_state == 1)
                                            {{translate('activo')}}
                                        @else   
                                            {{translate('inactivo')}}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($funder->f_state == 0)
                                            <a
                                                href="#"
                                                data-href="{{route("funder.changeFunderState", base64_encode($funder->f_id))}}" 
                                                data-toggle="modal" 
                                                data-target="#modal-info"
                                                class="btn btn-info"
                                                
                                                ><span class="fa fa-undo"></span>
                                            </a>
                                        @else
                                            <a
                                                data-href="{{route("funder.changeFunderState", base64_encode($funder->f_id))}}"
                                                data-toggle="modal"
                                                data-target="#modal-danger"
                                                class="btn btn-danger active_user"
                                                > <span class="fa fa-user-times"></span>
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
                        height="75px"
                        width="75px"
                    >
                    <p class="text-center"> <strong> {{translate('no_record')}}</strong></p>
                </div>
            </div>
        @endif 

    </div>

</div>
<!-- START MODAL DANGER -->
<div class="modal fade" id="modal-danger" tabindex="-1" role="dialog" aria-labelledby="modal-danger-header">
    <div class="modal-dialog modal-danger" role="document">
        <button type="button" class="submit" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-danger-header">{{translate('desabilitar_financiador')}}</h4>
            </div>
            <div class="modal-body">
                <h3> {{translate('tem_certeza_activar_financiador')}} <strong id="funder_name"> </strong>  </h3>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <button type="button" class="btn btn-link col-md-6" data-dismiss="modal">{{translate('cancelar')}}</button>
                    <div class="col-md-6">
                        <a class="btn btn-danger btn-ok">{{translate('confirmar')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL DANGER -->

<!-- START MODAL INFO -->
<div class="modal fade" id="modal-info" tabindex="-1" role="dialog" aria-labelledby="modal-info-header">
    <div class="modal-dialog modal-info" role="document">
        <button type="button" class="submit" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-info-header">{{translate('activar_financiador')}}</h4>
            </div>
            <div class="modal-body">
                <h3> {{translate('tem_certeza_financiador')}} <strong id="nome_user2"> </strong> ? </h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">{{translate('cancelar')}}</button>
                <a class="btn btn-info btn-ok">{{translate('confirmar')}}</a>
            </div>
        </div>
    </div>
</div>

<!-- END MODAL INFO -->

<div class="modal fade" id="modal-primary" tabindex="-1" role="dialog" aria-labelledby="modal-success-header">
    <div class="modal-dialog modal-success" role="document">
        <button type="button" class="submit" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-success-header">{{translate('novo_financiador')}}</h4>
            </div>
            <form action="{{route("funder.store")}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">{{translate('nome_financiador')}}</label>
                        <div class="col-md-9">
                            <input placeholder="{{translate('nome_financiador')}}" type="text" class="form-control" name="nome"  value="" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <button type="button" class="btn btn-link col-md-6" data-dismiss="modal">{{translate('cancelar')}}</button>
                        <div class="col-md-6">
                            <button type="submit" id="btn_remove" class="btn btn-success ">{{translate('registar')}}</button>
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
    $('#modal-info').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

    $(function(){
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

        $(".delete_user").click(function(){
            var funder_id = $(this).attr("funder-id");
            var nome= $(this).attr("f_name");
            $("#user_id2").val(funder_id);
            $("#funder_name").text(nome);
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



