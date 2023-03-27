@extends('layout.template')
@section('content')
    <!-- BASIC EXAMPLE -->
      <div class="block">
        <div class="app-heading app-heading-small">
          <div class="title">
            <h2>Formulario de registo</h2>
            <p>Registar-se como o Investigador principal</p>
          </div>
        </div>
      </div>
<form action='{{route('user.store')}}' method="POST" class="form-horizontal">
  @csrf
  <div class="form-group">
    <label class="col-md-2 control-label">Nome Completo</label>
      <div class="col-md-10">
        <input name="s_name" type="text" class="form-control">
      </div>
  </div>
  <div class="form-group">
    <label class="col-md-2 control-label">E-mail</label>
    <div class="col-md-10">
      <input name="email" type="email" class="form-control">
    </div>
  </div>
  {{-- <div class="form-group">
    <label class="col-md-2 control-label">Anexar documento de suporte</label>
    <div class="col-md-10">
      <input name="documento_suporte" type="file" class="form-control">
    </div>
  </div> --}}


            <div class="form-group">
                <label class="col-md-2 control-label">Senha</label>
                    <div class="col-md-10">
                        <input name="password" type="password" class="form-control">
                    </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Digite novamente</label>
                    <div class="col-md-10">
                        <input name="password_2" type="password" class="form-control" placeholder="Digite de novo a senha">
                    </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Contacto</label>
                    <div class="col-md-10">
                        <input name="contacto" type="text" class="form-control">
                    </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <div class="col col-sm-3"></div>
                <div class="col-sm-3 col-xs-3">
                 <button type="submit" onclick="swal({title: 'Info', text: 'Sucesso', timer: 5000, showConfirmButton: false});" class="btn btn-success btn-block">Registar</button>
                </div>
               <div class="col-md-3 col-xs-3">
                <a href="{{route('auth')}}" class="btn btn-danger btn-block">Voltar ao login</a>
               </div>
               <div class="col col-sm-3"></div>
              </div>
            </div>
        </form>
@endsection
