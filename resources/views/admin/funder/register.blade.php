@extends('layout.template')
@section("user_role", Auth::user()->roles->r_name)
@section("user_name", Auth::user()->staff->s_name)
@section("page_title", translate('financiador'))
@section("page_title_active", translate('gestao_financiador'))
{{-- @section("page_title_",translate('usuario')) --}}

@section('content')
    <div class="row">
        <div class="block block-condensed">
            <div class="app-heading app-heading-small">
                <div class="title">
                    <h5>{{translate('registo_financiador')}}</h5>
                </div>
                {{-- <div class="text-right">
                    <a class="btn btn-success" href="{{route("admin.user_list")}}"><span class="fa fa-arrow-left"></span> {{translate('voltar')}}</a>
                </div> --}}
            </div>

            <div class="block-content">
                <form action='{{route('admin.store')}}' method="POST" class="form-horizontal">
                    @csrf
                    <div class="form-group">
                      <label class="col-md-2 control-label">{{translate('nome_completo')}}</label>
                        <div class="col-md-10">
                          <input name="s_name" type="text" class="form-control" placeholder="{{translate('nome_completo')}}" value="{{old("s_name")}}" required>
                            @error('s_name')
                            <span style="color: red" required> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-2 control-label">{{translate('email')}}</label>
                      <div class="col-md-10">
                        <input name="email" type="email" class="form-control" placeholder="{{translate('email')}}" value="{{old("email")}}" required
                        required>
                        @error('email')
                            <span style="color: red"> {{ $message }}</span>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">{{translate('senha')}}</label>

                            <div class="col-md-10 ">
                                <div class="input-group">

                                    <span class="input-group-addon"><button type="button" class="bg-default" style="border: 0" onclick="showPassword()"><span class="fa fa-eye"> </button> </span>
                                    <input name="password" type="password" class="form-control" id="password" placeholder="{{translate('senha')}}" required>
                                </div>
                                @error('password')
                                    <span style="color: red"> {{ $message }}</span>
                                @enderror
                                {{-- <small> <strong> A senha deve conter 8 caracteres, incluindo maiúsculas, minúsculas, um número e um caractere especial.</strong></small> --}}

                            </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">{{translate('senha_novamente')}}</label>
                            <div class="col-md-10">
                                <div class="input-group">

                                    <span class="input-group-addon"><button type="button" class="bg-default" style="border: 0" onclick="showPassword2()"><span class="fa fa-eye"> </button> </span>
                                    <input name="password_2" type="password" class="form-control" id="password2" placeholder="{{translate('senha_novamente')}}" required>
                                </div>
                                {{-- <input name="password_2" type="password" class="form-control" placeholder="Digite novamente a senha" required> --}}
                                @error('password_2')
                                    <span style="color: red"> {{ $message }}</span>
                                @enderror
                            </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">{{translate('nr_celular')}}</label>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <span class="input-group-addon">+258</span>
                                    <input name="contacto" type="tel" class="form-control" value="{{old("contacto")}}" placeholder="{{translate('nr_celular')}}" required>
                                </div>
                                @error('contacto')
                                    <span style="color: red"> {{ $message }}</span>
                                @enderror
                            </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">{{translate('intituicao')}}</label>
                            <div class="col-md-10">
                                  <select name="nome_instituicao" value="{{old("nome_instituicao")}}" class="bs-select" title="{{translate('instituicao_do_usuario')}}}" required>
                                    @foreach ($orgs as $org)
                                      <option value="{{$org->ui_description}}">{{$org->ui_description}}</option>
                                    @endforeach
                                  </select>
                            </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">{{translate('permissao')}}</label>
                            <div class="col-md-10">
                                  <select name="role" id="" class="bs-select" value="{{old("role")}}" title="{{translate('permissao_usuario')}}" required>
                                    @foreach ($roles as $role)
                                      <option value="{{base64_encode($role->r_id)}}">{{$role->r_description}}</option>
                                    @endforeach
                                  </select>
                                  <small style="color: red">* {{translate('todos_campos_obrigatorios')}}</small>
                            </div>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-12 text-right">
                        <div class="col col-sm-3"></div>
                        <div class="col-sm-3 col-xs-3">
                         <button type="submit" class="btn btn-primary btn-block" id="btn_submit"><span class="fa fa-floppy-o"></span> {{translate('registar')}}</button>
                        </div>
                       <div class="col-md-3 col-xs-3">
                        <button type="reset" class="btn btn-default btn-block">{{translate('cancelar')}}</a>
                       </div>
                       <div class="col col-sm-3"></div>

                      </div>
                    </div>

                </form>


            </div>
        </div>
    </div>


@endsection

@section('scripts')

@endsection
