<!-- COMPLETA MODAL GENERICO DE CLIENTES -->
<?php $this->extend('templates/admin_template') ?>
<?= $this->section('content') ?>
<form id="frm-Cliente">
              <input id="clie_id" name="clie_id" type="text" hidden value="<?= $cliente[0]->clie_id ?>">
              <input id="empr_id" name="empr_id" type="text" hidden value="<?= $cliente[0]->empr_id ?>">
                        <div class="row" style="margin-top:-7px">
                          <div class="col">
                            <div class="card card-info">
                              <div class="card-header">
                                <h2 class="card-title">Datos Generales</h2>
                              </div><!-- fin card title -->
                               <div class="car-body">
                                <div class="container">
                                  <div class="row align-items-center mt-3">
                                    <div class="col-md-4 ">
                                      <div class="form-group">
                                        <p id="cliente_id" style="margin-top: -19px;margin-bottom: -7px; font-style: italic;" hidden></p>
                                        <label>Nombre Comercial <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                          </div>
                                          <input type="text" class="form-control requerido" id="nombreComercial" name="nombreComercial" value="<?= $cliente[0]->nombre ?>">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                          <label>Tipo Cliente <strong class="text-danger">*</strong>: </label>
                                          <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <select name="tipoCliente" id="tipoCliente" class="form-control requerido">
                                              <?php 
                                                foreach ($tipoCliente as $key => $cli) {
                                                  ($cliente[0]->ticl_id == $cli->tabl_id) ? $selected = 'selected' : $selected = '';
                                                  echo "<option value='$cli->tabl_id' $selected>$cli->valor</option>";
                                                }
                                              ?> 
                                            </select>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 centrar">
                                      <div class="form-group">
                                        <!-- <label>Imagen </label> -->
                                        <div class="" style="position:initial;">
                                          <!-- <i class="fas fa-user" style="right:250px;"></i> -->
                                          <?php 
                                            if($cliente[0]->nom_imagen) 
                                            {
                                              $src = imagePerfil($cliente[0]->imagen, $cliente[0]->nom_imagen);
                                            }
                                            else{ 
                                              $src = "";  
                                            }
                                          ?>
                                          <img id="logoCliente" src='<?= $src ?>' class="profile-user-img img-fluid img-circle" style="height: 100px; width: 100px" >
                                          <button class="btn btn-sm">
                                            <i id="verImagenCliente" src='' class="fas fa-eye"></i>
                                          </button>
                                          <button class="btn btn-sm agregaLogo" style="/*margin-top:-5px;margin-right:150px*/">
                                            <i class="fas fa-upload"></i>
                                          </button>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label>RFC <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                          </div>
                                          <input type="text" class="form-control requerido" id="rfc" name="rfc" value="<?= $cliente[0]->id_tributario ?>">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                          <label>Nacionalidad <strong class="text-danger">*</strong>: </label>
                                          <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
                                            </div>
                                            <select name="nacionalidad" id="nacionalidad" class="form-control requerido"> 
                                              <?php 
                                              foreach ($listadoPaises as $key => $pa) {
                                                ($cliente[0]->naci_id == $pa->tabl_id) ? $selected = 'selected' : $selected = '';
                                                echo "<option value='$pa->tabl_id' $selected>$pa->valor</option>";
                                              }
                                              ?> 
                                            </select>
                                          </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-4">
                                    </div> -->
                                    
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label>Tipo de Persona <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="fas fa-genderless"></i></span>
                                            </div>
                                            <select name="tipoPersona" id="tipoPersona" class="form-control requerido">
                                              <?php 
                                              foreach ($tipoPersona as $key => $pers) {
                                                ($cliente[0]->tipe_id == $pers->tabl_id) ? $selected = 'selected' : $selected = '';
                                                echo "<option value='$pers->tabl_id' $selected>$pers->valor</option>";
                                              }
                                            ?>
                                            </select>
                                          </div>
                                      </div>
                                    </div>

                                    <!-- inputs persona moral -->
                                    <div class="col-md-8 col_personaMoral" hidden>
                                      <div class="form-group">
                                        <label id="razonSocialLabel">Razón Social <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-wallet"></i></span>
                                          </div>
                                          <input type="text" name="razonSocial" id="razonSocial" class="form-control requerido personaMoral" value="<?= $cliente[0]->razon_social ?>"> 
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-4 col_personaMoral"hidden>
                                      <div class="form-group">
                                        <label>Representante Legal <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-balance-scale"></i></span>
                                          </div>
                                          <input type="text" name="representanteLegal" id="representanteLegal" class="form-control requerido personaMoral" value="<?= $cliente[0]->representante_legal ?>">  
                                        </div>
                                      </div>
                                    </div>
                                    

                                    <!-- inputs persona fisica -->
                                    <div class="col-md-4 col_personaFisica"  hidden>
                                      <div class="form-group">
                                        <label>CURP <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                          </div>
                                          <input type="text" class="form-control requerido personaFisica" id="curp" name="curp" value="<?= $cliente[0]->curp ?>">
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-md-4 col_personaFisica" hidden>
                                      <div class="form-group">
                                        <label>Nombres <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                          </div>
                                          <input type="text" class="form-control requerido personaFisica" id="nombres" name="nombres" value="<?= $cliente[0]->nombres ?>">
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-md-4 col_personaFisica"  hidden>
                                      <div class="form-group">
                                        <label>Apellidos <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                          </div>
                                          <input type="text" class="form-control requerido personaFisica" id="apellidos" name="apellidos" value="<?= $cliente[0]->apellidos ?>">
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-md-4 col_personaFisica"  hidden>
                                        <div class="form-group">
                                          <label>Género <strong class="text-danger">*</strong>: </label>
                                          <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="fas fa-genderless"></i></span>
                                            </div>
                                            <select name="genero" id="genero" class="form-control requerido personaFisica">
                                              <?php 
                                                foreach ($listadoGeneros as $key => $gen) {
                                                ($cliente[0]->gene_id == $gen->tabl_id) ? $selected = 'selected' : $selected = '';
                                                  echo "<option value='$gen->tabl_id' $selected>$gen->valor</option>";
                                                }
                                              ?>
                                            </select>
                                          </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col_personaFisica"  hidden>
                                      <div class="form-group">
                                        <label>Fecha de Nacimiento <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-birthday-cake"></i></span>
                                          </div>
                                          <input type="date" class="form-control float-left requerido personaFisica" id="fechaNacimiento" name="fechaNacimiento" value="<?=  !empty($cliente[0]->fec_nacimiento) ? substr($cliente[0]->fec_nacimiento,0,10) : '' ?>">
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-md-4 col_personaFisica"  hidden>
                                      <div class="form-group">
                                        <label>País de nacimiento <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                          </div>
                                          <select name="paisNacimiento" id="paisNacimiento" class="form-control requerido personaFisica">
                                            <?php 
                                              foreach ($listadoPaises as $key => $pa) {
                                                ($cliente[0]->pana_id == $pa->tabl_id) ? $selected = 'selected' : $selected = '';
                                                echo "<option value='$pa->tabl_id' $selected>$pa->valor</option>";
                                              }
                                            ?>
                                          </select>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-md-4 col_personaFisica"  hidden>
                                      <div class="form-group">
                                        <label>Ocupacion<strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                                          </div>
                                          <input type="text" class="form-control requerido personaFisica" id="ocupacion" name="ocupacion"  value="<?= $cliente[0]->ocupacion ?>"> 
                                        </div>
                                      </div>
                                    </div>
                                    </section>

                                </div><!-- fin content-->
                              </div><!-- fin car-body-->
                            </div><!-- fin card -->
                          </div><!-- fin col-->
                        </div><!-- fin row -->

                        <div class="row">
                          <div class="col">
                            <div class="card card-info" style="margin-bottom: 0rem;">
                              <div class="card-header">
                                <h2 class="card-title">Datos de Contacto</h2>
                              </div><!-- fin card title -->
                               <div class="car-body">
                                <div class="container">
                                  <div class="row mt-3">
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label>Teléfono <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                          </div>
                                          <input id="telefono" type="text" name="telefono" class="form-control requerido"  value="<?= $cliente[0]->telefono ?>">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <label>Correo electrónico <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text">@</span>
                                          </div><input type="text" class="form-control requerido" name="correo" id="correo"  value="<?= $cliente[0]->email ?>">
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                          <div class="form-group">
                                            <label>Calle <strong class="text-danger">*</strong>: </label>
                                            <div class="input-group">
                                              <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-road"></i></span>
                                              </div>
                                              <input type="text" class="form-control requerido" id="calle" name="calle"  value="<?= $cliente[0]->calle ?>">
                                            </div>
                                          </div>
                                    </div>
                                
                                 
                                    <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Número Exterior<strong class="text-danger">*</strong>: </label>
                                          <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="fas fa-list-ol"></i></span>
                                            </div>
                                            <input type="text" class="form-control requerido" id="numeroExterior" name="numeroExterior"  value="<?= $cliente[0]->num_exterior ?>">
                                          </div>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                          <label>Número Interior <strong class="text-danger">*</strong>: </label>
                                          <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="fas fa-list-ol"></i></span>
                                            </div>
                                            <input type="text" class="form-control requerido" id="numeroInterior" name="numeroInterior"  value="<?= $cliente[0]->num_interior?>">
                                          </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label>Codigo Postal / Colonia <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-list-ol"></i></span>
                                          </div>
                                          
                                        <select type="text" class="form-control requerido " id="CodigoColoniaCliente" name="CodigoColoniaCliente" style="width :88%">
                                          <option value="" disabled selected> </option>
                                        </select>
                                      </div>
                                      </div>
                                    </div>
                                    
                                  </div>
    

                                </div><!-- fin content-->

                              </div><!-- fin car-body-->
                            </div><!-- fin card -->
                          </div><!-- fin col-->
                        </div><!-- fin row -->
                </form><!-- fin form -->

<!-- Modal Agregar imagen -->
<div class="modal fade" id="modalAgregarLogo">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Agregar</h4>
                <button type="button" class="close" onclick="cerrarModalImagen()" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
            </div>

            <form id="formAgregarLogo" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="idAgregaLogo" name="idAgregaLogo">
                    <input id="inputLogo" type="file" class="form-control input-md">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="cerrarModalImagen()">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="cargaVistaPreviaCliente()" >Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>

$( document ).ready(function() {

    $('#btn-accion-cliente').hide();
    $('#mdl-title-cliente').html('Cliente');
    $('#frm-Cliente').find('.form-control').prop('disabled', true);
    $('#btn-editar-cliente').prop('hidden', false);
    $('#btn-personas').prop('hidden', false);
    $('#btn-organigrama').prop('hidden', false);
    $('#btn-cuestionario').prop('hidden', false);
    $('#btn-habilitarCliente').prop('hidden', true);

    //boton Personas cabecera de modal
    $('#btn-personas').attr('href','<?=  site_url('') ?>getPersonas/'+<?= $cliente[0]->clie_id?>);

    /* botones persona fisica */
    if($('#tipoPersona').val() == 'tipos_personasFisica'){
      activaBotonesClientesFisicos();
    }
    
    /* botones persona moral */
    if($('#tipoPersona').val() == 'tipos_personasMoral'){
      activaBotonesClientesMoral();
    }
});

/* oculta/muestra inputs de modal agregar cliente */
$('#tipoPersona').on("change",function(){

/* botones persona fisica */
if($('#tipoPersona').val() == 'tipos_personasFisica'){
  activaBotonesClientesFisicos();
}

/* botones persona moral */
if($('#tipoPersona').val() == 'tipos_personasMoral'){
  activaBotonesClientesMoral();
}


});

 /*Accion ojo de imagen */
 document.getElementById('verImagenCliente').onclick = function (){
        event.preventDefault();
        var nom_imagen = '<?= $cliente[0]->nom_imagen ?>';
        var imagen = '<?= $cliente[0]->imagen ?>' 
        if(nom_imagen){
          var codificacion = obtenerExtension(nom_imagen);
          /* decodificacion imagen base64 */
          var decodedData = window.atob(imagen);
          var newTab = window.open();
          newTab.document.body.innerHTML = '<img src="'+ codificacion + decodedData +'" >';
          newTab.document.close();
          $('#logoCliente').attr('src', codificacion + decodedData);
        }else{
          $('#logoCliente').attr('src', '');
        }   
}


/* Carga vista previa de logo cliente */
function cargaVistaPreviaCliente(){
  var input = $('#inputLogo').prop('files');
  if(input && input[0]){
      var reader = new FileReader();

      reader.addEventListener("load", function (e) {
          $('#logoCliente').prop('src', e.target.result);
          $('#logoCliente').hide();
          $('#logoCliente').fadeIn(850);   
      }, false);

      reader.readAsDataURL(input[0]);
  }
  cerrarModalImagen();
}
 
/* activa botones para cliente fisico */
function activaBotonesClientesFisicos(){
  /* oculta botones */
  ocultaColumna('#frm-Cliente', '.col_personaMoral');
  
  /* elimina clase requerido */
  remueveRequerido('#frm-Cliente' ,'.personaMoral');

  /* muestra botones */
  muestraColumna('#frm-Cliente', '.col_personaFisica');

  /* agrega clase requerido */
  agregaRequerido('#frm-Cliente','.personaFisica');

}

/* activa botones para cliente moral */
function activaBotonesClientesMoral(){
  /* muestra botones */
  muestraColumna('#frm-Cliente', '.col_personaMoral');

  /* agrega clase requerido */
  agregaRequerido('#frm-Cliente','.personaMoral');

  /* oculta botones */
  ocultaColumna('#frm-Cliente', '.col_personaFisica')

  /* remueve clase requerido */
  remueveRequerido('#frm-Cliente','.personaFisica');
}

/* oculta todas las columanas pertenecientes a persona moral y fisicas */
function ocultaColumnasForm(){
ocultaColumna('#frm-Cliente', '.col_personaMoral');
remueveRequerido('#frm-Cliente' ,'.personaMoral');
ocultaColumna('#frm-Cliente', '.col_personaFisica');
remueveRequerido('#frm-Cliente' ,'.personaFisica');
}

/*boton que habilita editar los datos de una persona en el modal */
function habilitaEditarCliente(){

$('#btn-editar-cliente').prop('hidden', true);
$('#btn-personas').prop('hidden', true);
$('#btn-organigrama').prop('hidden', true);
$('#btn-cuestionario').prop('hidden', true); 
$('#btn-habilitarCliente').prop('hidden', false);
$('#btn-accion-cliente').show();
$('#btn-accion-cliente').html('Modificar');
$('#btn-accion-cliente').attr('onclick', 'editarCliente()');
$('#frm-Cliente').find('.form-control').prop('disabled', false);

} 


/* Guarda los datos editados de la persona */
function editarCliente(){

var formData = new FormData($('#frm-Cliente')[0]);

let logo = document.getElementById("inputLogo").files;
if(logo.lenght!= 0){
  let imagenFile = $('#inputLogo').prop('files')[0]; 
  formData.append("imagen", imagenFile);
}

formData.append("clie_id",$('#frm-Cliente #clie_id').val());

/* le pego a CodigoColonia el #CodigoColoniaCliente para reutilizar el editar de cliente */
formData.append("CodigoColonia",$('#CodigoColoniaCliente').val());

//validacion datos del formulario
if(!validaForm('#frm-Cliente')) return;

//valida rfc sea correcto
if(!rfcValido($('#rfc').val())){
  $('#rfc').addClass('is-invalid');
  return};

$.ajax({
  type:'POST',
  dataType: 'JSON',
  processData: false,
  contentType: false,
  url: '<?= base_url()?>/editarCliente',
  data:formData,
  success: function(resp) {
    notificar(notiSuccess);
      $('#nuevo_cliente').modal('hide');
      $('#frm-Cliente')[0].reset();
      limpiaForm('#nuevo_cliente');
  },
  error: () => {
    notificar(notiError);
  },
  complete: function() {
    notificar(notiSuccess);
    $('#modalGenerico').modal('hide');
  }
  });
}


/* inicializacion botones on/off */
$("[name='habilitarClienteEditar']").bootstrapSwitch({
/* habilitar/deshabilitar personas desde modal editar persona*/
 onSwitchChange:function(e, state){
  var clie_id = $('#clie_id').val();
  if(!state){
    Swal.fire({
      title: '¿Está seguro?',
      text: 'Si deshabilita al cliente, el mismo no aparecerá en algunos reportes o indicadores, y no podrá asignar cuestionarios a sus Personas asociadas',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, deshabilitar!'
    }).then((result) => {
    if (result.isConfirmed) {
      deshabilitaCliente(clie_id);
    }
    else{
      //vuelve a el estado original y el ultimo paramaetro es para cortar la ejecucion
      $(this).bootstrapSwitch('state', !state ,true);
    }
    })
  }
  else{
    Swal.fire({
      title: 'Habilitar cliente?',
      text: "Ten en cuenta que se habilitaras el cliente",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, habilitar!'
    }).then((result) => {
    if (result.isConfirmed) {
      habilitaCliente(clie_id);
    }
    else{
      //vuelve a el estado original y el ultimo paramaetro es para cortar la ejecucion
      $(this).bootstrapSwitch('state', !state ,true);
    }
  });
  } 
}
});

/* funcion para deshabilitar una persona */
function deshabilitaCliente(clie_id){
  $.get('<?= base_url()?>/eliminarCliente/' + clie_id, function (data){
          Swal.fire(
              'Deshabilitado!',
              'El cliente fue deshabilitado.',
              'success'
        );
  })
}


/* funcion para habilitar una persona */
function habilitaCliente(clie_id){
  $.get('<?= base_url()?>/habilitarCliente/' + clie_id, function (data){
          Swal.fire(
            'Habilitado!',
            'El cliente fue habilitado.',
            'success'
          );
  })
}


/* abrir modal agregar imagen */
$(document).on("click", ".agregaLogo", function() {
  $('#modalAgregarLogo').modal('show');
  event.preventDefault();
  $("#modalGenerico").css('overflow-y', 'auto');//habilita el scroll de nuevo
});


//funcion para cerrar el modal de agregar imagen para que no cierre todos los modales
function cerrarModalImagen(){
  $('#modalAgregarLogo').modal('hide');
}


/* busqueda de nombre ubicacion/colonia */
$( document ).ready(function() {
  $.ajax({
        url:'<?= base_url()?>/ubicaciones',
        data: {"patron": <?= $cliente[0]->cod_postal ?>} ,
        success: function(data){

          data1 = JSON.parse(data);
          if(data1.length){
           
            text=data1[0].camino;
            opcion = {'id': <?= $cliente[0]->cod_postal ?>, 'text': text};

            CodOpc = new Option(text, <?= $cliente[0]->cod_postal ?>, true, true);

            $('#CodigoColoniaCliente').append(CodOpc).trigger('change');
          }
          else{
            CodOpc = new Option('', '', true, true);
            $('#CodigoColoniaCliente').append(CodOpc).trigger('change');
          }
        },
      });
});


/* actualiza valor de colonia*/
$('#CodigoColoniaCliente').on('select2:select', function (e) {
    var data = e.params.data;
    debugger;
    $("#CodigoColoniaCliente").val(data.id);
}); 

/* buscador codigo postal/colonia  */
$('#CodigoColoniaCliente').select2({
  ajax:{
    url: "<?= base_url()?>/ubicaciones/",
    datatype: 'json',
    delay: 250,
    data: function (params){
      return {
        patron: params.term,
        page:params.page
      };
    },
    processResults: function (data, params) {
                params.page = params.page || 1;
                data1= JSON.parse(data);
                var results = [];
                $.each(data1, function(i, obj) {
                    results.push({
                        id: obj.valor2,
                        text: obj.camino,
                        valor: obj.valor
                    });
                });
                return {
                    results: results,
                    pagination: {
                        more: (params.page * 30) < results.length
                    }
                };
            }
  },
  languaje:"es",
  placeholder:"Buscar...",
  minimumInputLength: 3,
  maximumInputLength: 8,
  dropdownCssClass: "ubicaciones",
  templateResult: function (ubicacion) {

  if (ubicacion.loading) {
      return "Buscando...";
  }

  var $container = $(
      "<div class='select2-result-repository clearfix'>" +
      "<div class='select2-result-repository__meta'><small>" +
          "<small><strong><div class='select2-result-repository__title'></div></strong></small>" +  
      "</div>" +
      "</div>"
  );
 
  $container.find(".select2-result-repository__title").text(ubicacion.text);  
  return $container;
  },
  templateSelection: function (ubicacion) {
    return ubicacion.text;
  },
  language: {
            noResults: function() {
                return '<option>No hay coincidencias</option>';
            },
            inputTooShort: function () {
                return 'Ingrese 3 o mas dígitos para comenzar la búsqueda'; 
            },
            inputTooLong: function () {
                return 'Hasta 8 dígitos permitidos'; 
            }
        },
        escapeMarkup: function(markup) {
            return markup;
        }, 
});

</script>



