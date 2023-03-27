<!-- STORE -->
<div class="modal fade" id="modal-info" tabindex="-1" role="dialog" aria-labelledby="modal-success-header">
    <div class="modal-dialog modal-success" role="document">
        <button type="button" class="submit" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-success-header">{{translate('novo_recipient')}}</h4>
            </div>
            <form action="{{route("recipients.store")}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">{{translate('nome')}}</label>
                        <div class="col-md-9">
                            <input placeholder="{{translate('nome')}}" type="text" class="form-control" name="r_name"  value="" required>
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
<!-- AUTHOR REGISTER -->
<div class="modal fade" id="modal-new-autor_cism" tabindex="-1" role="dialog" aria-labelledby="modal-success-header">
    <div class="modal-dialog modal-success" role="document">
        <button type="button" class="submit" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-success-header">{{translate('novo_autor')}}</h4>
            </div>
            <form action="{{route("configuration.cism_store")}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">{{translate('nome')}}</label>
                        <div class="col-md-9">
                            <input placeholder="{{translate('nome')}}" type="text" class="form-control" name="ca_name" required>
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

<!-- END STORE -->

<div class="modal fade" id="modal-new-organization" tabindex="-1" role="dialog" aria-labelledby="modal-success-header">
    <div class="modal-dialog modal-success" role="document">
        <button type="button" class="submit" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-success-header">{{translate('nova_instituicao')}}</h4>
            </div>
            <form action="{{route("user_organization.store")}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">{{translate('descricao')}}</label>
                        <div class="col-md-9">
                            <input placeholder="{{translate('descricao')}}" type="text" class="form-control" name="ui_name"  value="" required>
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
<!-- END STORE -->
<!-- START UPDATE STATE-->
<div class="modal fade" id="confirm-update-recipient" tabindex="-1" role="dialog" aria-labelledby="modal-danger-header">
    <div class="modal-dialog modal-danger" role="document">
        <button type="button" class="submit" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-danger-header">{{translate('desabilitar_recipient')}}</h4>
            </div>
            <div class="modal-body">
                <h3>{{translate('tem_certeza_desactivar_recipient')}}</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">{{translate('cancelar')}}</button>
                <a class="btn btn-danger btn-ok">{{translate('confirmar')}}</a>
            </div>
        </div>
    </div>
</div>
<!-- END UPDATE STATE -->

<!-- DESABILITAR -->
<div class="modal fade" id="confirm-update-recipient" tabindex="-1" role="dialog" aria-labelledby="modal-danger-header">
    <div class="modal-dialog modal-danger" role="document">
        <button type="button" class="submit" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-danger-header">{{translate('desabilitar_recipient')}}</h4>
            </div>
            <div class="modal-body">
                <h3>{{translate('tem_certeza_desactivar_recipient')}}</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">{{translate('cancelar')}}</button>
                <a class="btn btn-danger btn-ok">{{translate('confirmar')}}</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-update-organization" tabindex="-1" role="dialog" aria-labelledby="modal-success-header">
    <div class="modal-dialog modal-success" role="document">
        <button type="button" class="submit" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-success-header">{{translate('alterar_estado')}}</h4>
            </div>
            <div class="modal-body">
                <h3>{{translate('tem_certeza_alterar_estado')}}</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">{{translate('cancelar')}}</button>
                <a class="btn btn-success btn-ok">{{translate('confirmar')}}</a>
            </div>
        </div>
    </div>
</div>

<!-- ACTIVAR -->
<div class="modal fade" id="modal-confirm-activate" tabindex="-1" role="dialog" aria-labelledby="modal-success-header">
    <div class="modal-dialog modal-success" role="document">
        <button type="button" class="submit" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-success-header">{{translate('activar_recipient')}}</h4>
            </div>
            <div class="modal-body">
                <h3>{{translate('tem_certeza_activar_recipient')}}</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">{{translate('cancelar')}}</button>
                <a class="btn btn-success btn-ok">{{translate('confirmar')}}</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-update-author" tabindex="-1" role="dialog" aria-labelledby="modal-success-header">
    <div class="modal-dialog modal-success" role="document">
        <button type="button" class="submit" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-success-header">{{translate('activar_recipient')}}</h4>
            </div>
            <div class="modal-body">
                <h3>{{translate('tem_certeza_actualizar_autor')}}</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">{{translate('cancelar')}}</button>
                <a class="btn btn-success btn-ok">{{translate('confirmar')}}</a>
            </div>
        </div>
    </div>
</div>


