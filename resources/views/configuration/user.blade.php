@extends("layout.template")
@section('user_role', session('role_name'))
@section('user_name', session('user_name'))
@section('page_title', translate('detalhe_utilizador'))
@section('page_name', 'Menu')
@section('page_title_', translate('configuracoes'))
@section('page_title_active', translate('detalhe_utilizador'))

@section('content')
<div class="row">
    <div class="col-md-11">
<!-- PROFILE CARD -->
        <div class="block block-condensed">
            <div class="block-heading margin-bottom-0">

                <div class="app-heading app-heading-small">
                    <div class="contact contact-rounded contact-bordered contact-lg margin-bottom-0">
                        <img src="{{asset("assets/images/user/no-image.png")}}">
                        <div class="contact-container">
                            <a href="#">{{!empty($user->staff)?$user->staff->s_name:""}}</a>
                            <span>{{ !empty($user->roles)?$user->roles->r_description:"" }}</span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="block-content row-table-holder">

                <div class="row row-table">
                    <div class="col-md-4 col-xs-12">
                        <span class="text-bolder text-uppercase text-sm">{{translate('nome')}}:</span>
                        <p>{{$user->email}}</p>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <span class="text-bolder text-uppercase text-sm">{{translate('nr_celular')}}:</span>
                        <p>{{!empty($user->staff_contacts)?$user->staff_contacts->sc_contact:translate('nao_definido')}}</p>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <span class="text-bolder text-uppercase text-sm">{{translate('intituicao')}}:</span>
                        <p>{{!empty($user->user_external_institution)?$user->user_external_institution->ui_description:""}}</p>
                    </div>
                </div>


                <div class="row row-table">
                    <div class="col-xs-12">
                        
                        <button class="btn btn-danger btn-icon-fixed pull-right" id="btn_edit_form" style="display: none;"><span class="icon-pencil"></span> {{translate('editar')}}</button>
                    </div>
                </div>
            </div>
        </div>
<!-- END PROFILE CARD -->
<!-- BASIC INPUTS -->
<div class="block" id="form_edit_user" style="display: block;">

    <div class="app-heading app-heading-small">
        <div class="title">
            <h2>{{translate('editar')}}</h2>
        </div>
    </div>
 
    <form class="form-horizontal"  enctype="multipart/form-data" id="" method="POST" action="{{route("configuration.user_update")}}">
        @csrf
        <div class="form-group">

            <label class="col-md-2 control-label"><small style="color: red" >*</small> {{translate('nome')}}</label>
            <div class="col-md-10">
                <div class="input-group">
                    <span class="input-group-addon"><span class="fa fa-user"></span></span>
                    <input type="text" class="form-control" value="{{!empty($user->staff)?$user->staff->s_name:""}}" name="nome" required>
                </div>
                @error('nome')
                    <span style="color: red"> {{ $message }}</span>
                @enderror
            </div>

        </div>
        <div class="form-group">
            <label class="col-md-2 control-label"><small style="color: red" >*</small> {{translate('email')}}</label>
            <div class="col-md-10">
                <div class="input-group">
                    <span class="input-group-addon"><span class="fa fa-envelope"></span></span>
                    <input type="email" class="form-control"  value="{{$user->email}}" name="email" required>
                </div>
                @error('email')
                    <span style="color: red"> {{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label"><small style="color: red" >*</small>  {{translate('nr_celular')}}</label>
            <div class="col-md-10">
                <div class="input-group">
                    <span class="input-group-addon">+258</span>
                    <input name="contacto" type="tel" class="form-control" value="{{!empty($user->staff_contacts)?$user->staff_contacts->sc_contact:translate('nao_definido')}}" placeholder="{{translate('numero_celular')}}." required>
                </div>
                @error('contacto')
                    <span style="color: red"> {{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group" hidden>
            <label class="col-md-2 control-label"><small style="color: red" >*</small> Nova senha</label>
            <div class="col-md-10">
                <div class="input-group">
                    <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                    <input type="password" class="form-control" name="password"  autocomplete="on">
                </div>
                @error('password')
                    <span style="color: red"> {{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group" hidden>
            <label class="col-md-2 control-label"> <small style="color: red" >*</small> Digite novamente</label>
            <div class="col-md-10">
                <div class="input-group">
                    <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                    <input type="password" class="form-control"  autocomplete="on" name="password2">
                </div>
                @error('password2')
                    <span style="color: red"> {{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12 text-right">
              <div class="col col-sm-3"></div>
              <div class="col-md-3 col-xs-3">
                <button type="button" class="btn btn-default" id="btn_cancel"> <span class="fa fa-remove"></span> {{translate('cancelar')}}</a>
               </div>
              <div class="col-sm-3 col-xs-3">
                <button class="btn btn-info" type="submit" id="btn_submit"> <span class="fa fa-refresh"></span> {{translate('actualizar')}} </button>
              </div>

             <div class="col col-sm-3"></div>

            </div>
          </div>

    </form>

</div>
<!-- END BASIC INPUTS -->
    </div>
</div>


@endsection

@section("scripts")

    <script>
        let update_user_route = '{{route("configuration.user_update")}}';
        $("#btn_edit_form").on('click', function(){
            $("#form_edit_user").show();
            this.style.display = 'none';
        });

        $('#btn_submit').on('click', function() {
            var $this = $(this);
            var loadingText = '<span class="fa fa-spinner"></span>';
            if ($(this).html() !== loadingText) {
                $this.data('original-text', $(this).html());
                $this.html(loadingText);
                }
                setTimeout(function() {
                $this.html($this.data('original-text'));
            }, 5500);
        });

        $("#btn_cancel").on('click', function(){
            $("#form_edit_user").hide();
            $("#btn_edit_form").show();
        });
        $("form#update_user_form").submit(function(e){
            e.preventDefault();
            var formData = new FormData(this);
            // console.log(formData.nome);
            $.ajax({
                url: update_user_route,
                dataType: 'json',
                type: 'POST',
                data: formData,
                beforeSend: function () {
                    $('#carregamento').css("display", "block");
                },
                complete: function () {
                    $('#carregamento').css("display", "none");
                },
                error: function () {
                    swal({
                        title: "erro",
                        text: "Houve um erro",
                        icon: "error",
                        button: "Confirmar"
                    });
                    $('#carregamento').css("display", "none");

                    return false;
                },
                success: function (data) {
                    message=data.message;
                    if (typeof data.message === 'object' && data.message !== null){
                        message=JSON.stringify(data.message);

                    }
                    if (data.state==200) {
                        swal({
                            title: "Sucesso",
                            text: message,
                            icon: "success",
                            button: "Confirmar"
                        }).then(function () {
                            location.reload();
                        })
                    } else {
                        swal({
                            title: "Erro!",
                            text: message,
                            icon: "error",
                            button: "Confirmar"
                        });
                    }
                    return false;

                },
                cache: false,
                contentType: false,
                processData: false
            });
        })

    </script>
@endsection


{{-- <td>{{$user->id}}</td>
                    <td>{{!empty($user->staff)?$user->staff->s_name:""}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{!empty($user->staff_contacts)?$user->staff_contacts->sc_contact:""}}</td>
                    <td>{{!empty($user->user_external_institution)?$user->user_external_institution->ui_description:""}}</td>
                    <td>{{ !empty($user->roles)?$user->roles->r_description:"" }}</td> --}}
