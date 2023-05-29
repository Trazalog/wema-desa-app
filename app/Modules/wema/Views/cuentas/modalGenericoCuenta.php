 <!-- MODAL GENERICO PARA CUENTAS -->
 <div class="modal fade right" id="modalGenericoCuenta" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" id='cabeceraModal'>
            <div class="col-3">
                  <h5 class="modal-title" id="mdl-title-cuenta">Nueva Cuenta</h5>
                </div>
                <label class="switch" >
                <div id="btn-habilitarCuenta" class="bootstrap-switch-container" style="width: 126px; margin-left: -42px;" hidden>
                  <input type="checkbox" name="habilitarCuentaEditar" data-bootstrap-switch-editar checked>
                </div>
                </label>
                <div class="col-3" >
                    <button type="button" id="btn-editar-cuenta" class="btn btn-outline-primary btn-block btn-sm" onclick="habilitaEditarCuenta()" hidden><i class="fa fa-edit"></i> Editar</button>
                </div>
                <div class="col-3" >
                    <a type="button" id="btn-clientes-cuenta" class="btn btn-outline-primary btn-block btn-sm" hidden><i class="fas fa-inbox" ></i> Clientes</a>
                </div>
                <div class="col-2">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close" onclick="limpiaForm('#nueva_cuenta')">
                  <span aria-hidden="true">×</span>
                </button>
                </div>
            </div>
            <div class="modal-body" id="contenidoModal">
            </div>
            <div class="modal-footer ">
              <div class="col-mt-1 col-12 justify-content-center" style="margin-top:-5px">
                <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-info float-right" id='btn-accion-cuenta' style="margin-left: 5px;">Crear</button>
              </div>
            </div>
        </div>
    </div>
 </div>
