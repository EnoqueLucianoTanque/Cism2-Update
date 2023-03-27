<div class="modal fade" id="modal-info" tabindex="-1" role="dialog" aria-labelledby="modal-success-header">
    <div class="modal-dialog modal-success" role="document">
        <button type="button" class="submit" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{translate('registar_membro')}}</h4>
            </div>
            <form action="{{route("workgroup.store")}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label">{{translate('nome')}}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="nome_usuario"  required>
                            @error("nome_usuario")
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- {{ dd($wgp_id) }} --}}
                    <input type="hidden" name="wgp_id" value="{{!empty($wgp_id)?$wgp_id->wgp_id:""}}">
                    <input type="hidden" name="p_id" value="{{!empty($project)?base64_encode($project->p_id):""}}">
                    <div class="form-group">
                        <label class="col-md-2 control-label">{{translate('email')}}</label>
                        <div class="col-md-10">
                            <input type="email" class="form-control" name="email" autocomplete="email" required>
                            @error("email")
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">{{translate('senha')}}</label>
                        <div class="col-md-10">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                                <input name="password" type="password" class="form-control" autocomplete="current-password" required>
                            </div>
                            @error("password")
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">{{translate('senha_novamente')}}</label>
                        <div class="col-md-10">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                                <input name="password2" type="password" class="form-control" autocomplete="current-password" required>
                            </div>
                            @error("password2")
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label" for="">{{translate('funcao')}}</label>
                        <div class="col-md-10">
                            <select class="bs-select" name="role__" title="Escolha uma função"required>
                                @foreach ($role_groups as $role)
                                    <option value="{{base64_encode($role->wgr_id)}}">{{$role->wgr_name}}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <button type="button" class="btn btn-link col-md-6" data-dismiss="modal">{{translate('cancelar')}}</button>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success ">{{translate('registar')}}</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div> 

<div class="modal fade" id="modal-update" tabindex="-1" role="dialog" aria-labelledby="modal-success-header">
    <div class="modal-dialog modal-success" role="document">
        <button type="button" class="submit" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Actualizar dados do membro</h4>
            </div>
            <form action="{{route("workgroup.store")}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Nome</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="nome_usuario"  required>
                        </div>
                    </div>
                    <input type="hidden" name="wgp_id" value="{{!empty($wgp_id)?$wgp_id->wgp_id:""}}">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Email</label>
                        <div class="col-md-10">
                            <input type="email" class="form-control" name="email" autocomplete="email" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Senha</label>
                        <div class="col-md-10">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                                <input name="password" type="password" class="form-control" autocomplete="current-password" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Digite novamente</label>
                        <div class="col-md-10">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                                <input name="password2" type="password" class="form-control" autocomplete="current-password" required>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label" for="">Função</label>
                        <div class="col-md-10">
                            <select class="bs-select" name="role__" title="Escolha uma função"required>
                                @foreach ($role_groups as $role)
                                    <option value="{{base64_encode($role->wgr_id)}}">{{$role->wgr_name}}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <button type="button" class="btn btn-link col-md-6" data-dismiss="modal">Cancelar</button>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-info ">Registar</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<div class="modal fade" id="modal-scientific_approval" tabindex="-1" role="dialog" aria-labelledby="modal-success-header">
    <div class="modal-dialog modal-success" role="document">
        <button type="button" class="submit" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{translate('reenviar_protocolo')}}</h4>
            </div>
            <form action="{{route("post_award.resend_protocol")}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label">{{translate('protocolo')}}</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control" accept="file_extension/.docx, .doc, .pdf" name="document_protocol" required>
                        </div>
                    </div>
                    <input type="hidden" name="p_id" value="{{base64_encode($project->p_id)}}">
                    <div class="form-group">
                        <label class="col-md-2 control-label">{{translate('documento_anexado')}}</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control" name="cci_document" required accept="file_extension/.docx, .doc, .pdf">
                        </div>
                    </div>

                    

                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <button type="button" class="btn btn-link col-md-6" data-dismiss="modal">{{translate('cancelar')}}</button>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success">{{translate('submeter ')}}</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- Modal para modar o estado do projeto em relacao a comite externo -->
<div class="modal fade" id="comite_externo" tabindex="-1" role="dialog" aria-labelledby="modal-success-header">
    <div class="modal-dialog modal-success" role="document">
        <button type="button" class="submit" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{translate('submeter_comite_externo')}}</h4>
            </div>
            <form action="{{route('external_committee_approval')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">{{translate('estado_')}}</label>
                        <div class="col-md-9">
                            <select name="estado" id="state" class="form-control" required>
                                <option selected>--{{translate('escolhe_estado')}}--</option>
                                @foreach ($external_state as $e_state)
                                    <option value="{{$e_state->ecs_id}}">{{translate($e_state->ecs_name)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> 
                    <div class="form-group" id="doc_anexado" hidden>
                        <label class="col-md-3 control-label">{{translate('documento_anexado')}}</label>
                        <div class="col-md-9">
                            <input type="file" name="document" class="form-control" accept="file_extension/.docx, .doc, .pdf">
                        </div>
                    </div>
                    <input type="hidden" name="p_id" value="{{base64_encode($project->p_id)}}">
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <button type="button" class="btn btn-link col-md-6" data-dismiss="modal">{{translate('cancelar')}}</button>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success">{{translate('submeter')}}</button>
                        </div>
                    </div>
                </div>
            </form> 

        </div>
    </div>
</div>

<!--end modal-->

<div class="modal fade" id="modal-ethical_approval" tabindex="-1" role="dialog" aria-labelledby="modal-success-header">
    <div class="modal-dialog modal-success" role="document">
        <button type="button" class="submit" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{translate('submeter_novamente_documento_cibs')}}</h4>
            </div>
            <form action="{{route("pi_response_cibs_modal")}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label">{{translate('protocolo')}}</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control" name="protocolo" accept="file_extension/.docx, .doc, .pdf" required>
                        </div>
                    </div>
                    <input type="hidden" name="p_id" value="{{base64_encode($project->p_id)}}">
                    
                    <div class="form-group">
                        <label class="col-md-2 control-label">{{translate('apendice')}}</label>
                        <div class="col-md-10">
                            <input class="form-control input-sm" name="apendice[]" type="file" accept="file_extension/.docx, .doc, .pdf" required>
                        </div>
                    </div>

                    <div class="form-group apendice" style="margin-top: 4px;">
                                    
                    </div>
                    <div class="row">
                        <div class="text-center" style="margin-top:2.5vh;">
                            <button type="button" onclick="new_apendice()" class="btn btn-success"> <span class="fa fa-plus" ></span> {{translate('novo_apendice')}}</button>
                        </div>
                    </div>

                    

                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <button type="button" class="btn btn-link col-md-6" data-dismiss="modal">{{translate('cancelar')}}</button>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary ">{{translate('submeter')}}</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>







