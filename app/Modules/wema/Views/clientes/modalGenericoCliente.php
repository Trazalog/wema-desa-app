 <!-- MODAL GENERICO PARA CLIENTES -->
 <div class="modal fade right" id="modalGenerico" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" id='cabeceraModal'>
            <div class="col-2">
                  <h5 class="modal-title" id="mdl-title-cliente"></h5>
                </div>
                <label class="switch" >
                <div id="btn-habilitarCliente" hidden>
                    <input type="checkbox" name="habilitarClienteEditar" data-bootstrap-switch-editar checked>   
                </div>
                </label>
                <div class="col-2" >
                    <button type="button" id="btn-editar-cliente" class="btn btn-outline-primary btn-block btn-sm" onclick="habilitaEditarCliente()" hidden><i class="fa fa-edit"></i> Editar </button>
                </div>
                <div class="col-2" >
                    <a type="button" id="btn-personas" class="btn btn-outline-primary btn-block btn-sm" hidden><i class="fas fa-users"></i> Personas </a>
                </div>
                <div class="col-2" >
                    <button type="button" id="btn-organigrama" class="btn btn-outline-primary btn-block btn-sm" hidden><i class="fas fa-sitemap" ></i> Organigrama </button>
                </div>
                
                <div class="col-2" >
                    <button type="button" id="btn-cuestionario" class="btn btn-outline-primary btn-block btn-sm" hidden><i class="fas fa-clipboard" ></i> Cuestionarios </button>
                </div>
                <div class="col-1">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="limpiaForm('#nuevo_cliente')">
                  <span aria-hidden="true">×</span>
                </button>
                </div>
            </div>
            <div class="modal-body" id="contenidoModal">
            </div>
            <div class="modal-footer ">
              <div class="col-mt-1 col-12 justify-content-center" style="margin-top:-5px">
                <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-info float-right" id='btn-accion-cliente' style="margin-left: 5px;">Crear</button>
              </div>
            </div>
        </div>
    </div>
 </div>
