<!-- COMPLETA MODAL GENERICO DE CUENTAS -->
<?php $this->extend('templates/admin_template') ?>
<?= $this->section('content') ?>
<form id="frm-Cuenta">
                        <input id="empr_id" name="empr_id" type="text" hidden>
                        <div class="row">
                          <div class="col">
                            <div class="card card-info">
                              <div class="card-header">
                                <h2 class="card-title">Datos Generales</h2>
                              </div><!-- fin card title -->
                               <div class="car-body">
                                <div class="container">
                                  <div class="row">

                                    <div class="col-md-4 ">
                                      <div class="form-group">
                                        <p id="empresa_id" style="margin-top: 2px;margin-bottom: -7px; font-style: italic;" hidden><?= $empresa[0]->empr_id ?></p>
                                        <label id="n_cuenta" style="margin-top: 20px">Nombre Cuenta <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                          </div>
                                          <input type="text" class="form-control requerido" id="nombreCuenta" name="nombreCuenta" value="<?= $empresa[0]->nombre ?>">
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                          <label id="t_cuenta" style="margin-top: 20px">Tipo Cuenta <strong class="text-danger">*</strong>: </label>
                                          <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <select name="tipoCuenta" id="tipoCuenta" class="form-control requerido">
                                              <?php 
                                                  foreach ($listadoTipompresas as $key => $tipoEmpresa) {
                                                    ($empresa[0]->tiem_id == $tipoEmpresa->tabl_id) ? $selected = 'selected' : $selected = '';
                                                    echo "<option value='$tipoEmpresa->tabl_id'  $selected>$tipoEmpresa->valor</option>";
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
                                            if($empresa[0]->nom_imagen) 
                                            {
                                              $src = imagePerfil($empresa[0]->imagen, $empresa[0]->nom_imagen);
                                            }
                                            else{ 
                                              $src = "";  
                                            }
                                          ?>
                                          <img id="imagenCuenta" src='<?= $src ?>' class="profile-user-img img-fluid img-circle" style="height: 100px; width: 100px"  >
                                          <button class="btn btn-sm" style="/*margin-top:-20px;margin-right:150px*/">
                                            <i id="verImagenCuenta" class="fas fa-eye"></i>
                                          </button>
                                          <button class="btn btn-sm agregaLogoCuenta" style="/*margin-top:-5px;margin-right:150px*/">
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
                                          <input type="text" class="form-control requerido" id="rfcCuenta" name="rfcCuenta" value="<?= $empresa[0]->id_tributario ?>">
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
                                                ($empresa[0]->ubic_id == $pa->tabl_id) ? $selected = 'selected' : $selected = '';
                                                echo "<option value='$pa->tabl_id'  $selected>$pa->valor</option>";
                                              }
                                            ?>
                                          </select>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label>Tipo de Persona <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="fas fa-genderless"></i></span>
                                            </div>
                                            <select name="tipoPersonaCuenta" id="tipoPersonaCuenta" class="form-control requerido">
                                              <?php 
                                                  foreach ($listadoPersonas as $key => $pers) {
                                                    ($empresa[0]->tipe_id == $pers->tabl_id) ? $selected = 'selected' : $selected = '';
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
                                          <input type="text" name="razonSocial" id="razonSocial" class="form-control requerido personaMoral" value="<?= $empresa[0]->razon_social ?>"> 
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
                                          <input type="text" name="representanteLegal" id="representanteLegal" class="form-control requerido personaMoral" value="<?= $empresa[0]->representante_legal ?>">  
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
                                          <input type="text" class="form-control requerido personaFisica" id="curp" name="curp" value="<?= $empresa[0]->id_persona ?>">
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
                                          <input type="text" class="form-control requerido personaFisica" id="nombres" name="nombres" value="<?= $empresa[0]->nombres ?>">
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
                                          <input type="text" class="form-control requerido personaFisica" id="apellidos" name="apellidos" value="<?= $empresa[0]->apellidos ?>">
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
                                                    ($empresa[0]->gene_id == $gen->tabl_id) ? $selected = 'selected' : $selected = '';
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
                                          <input type="date" class="form-control float-left requerido personaFisica" id="fechaNacimiento" name="fechaNacimiento" value="<?= substr($empresa[0]->fec_nacimiento,0,10)?>">
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
                                                ($empresa[0]->naci_id == $pa->tabl_id) ? $selected = 'selected' : $selected = '';
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
                                          <input type="text" class="form-control requerido personaFisica" id="ocupacion" name="ocupacion" value="<?= $empresa[0]->ocupacion ?>">
                                        </div>
                                      </div>
                                    </div>
                                  

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
                                  <div class="row">
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label>Teléfono <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                          </div>
                                          <input id="telefono" name="telefono" type="text" class="form-control requerido" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask="" inputmode="text" value="<?= $empresa[0]->num_telefono ?>">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label>Correo electrónico <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text">@</span>
                                          </div><input type="text" class="form-control requerido" id="correo" name="correo" value="<?= $empresa[0]->email ?>">
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
                                          <input type="text" class="form-control requerido" id="calle" name="calle" value="<?= $empresa[0]->calle ?>">
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
                                            <input type="text" class="form-control requerido" id="numeroExterior" name="numeroExterior" value="<?= $empresa[0]->num_exterior ?>">
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
                                            <input type="text" class="form-control requerido" id="numeroInterior" name="numeroInterior" value="<?= $empresa[0]->num_interior ?>">
                                          </div>
                                           
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label>Codigo Postal / Colonia <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                                          </div>
                                          <input type="text" class="form-control requerido" id="CodigoColonia" name="CodigoColonia" value="<?= $empresa[0]->cod_postal ?>">
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
   <div class="modal fade" id="modalAgregarLogoCuenta">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Agregar</h4>
                      <button type="button" class="close" onclick="cerrarModalImagen()"  aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                  </div>

                  <form id="formAgregarLogoCuenta" enctype="multipart/form-data">
                      <div class="modal-body">
                          <input type="hidden" id="idAgregaLogoCuenta" name="idAgregaLogoCuenta">
                          <input id="inputLogoCuenta"  type="file" class="form-control input-md" >
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" onclick="cerrarModalImagen()" >Cancelar</button>
                          <button type="button" class="btn btn-primary" onclick="cargaVistaPreviaCuenta()"  >Agregar</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
<script>  

    $( document ).ready(function() {


    $('#btn-accion-cuenta').hide();
    $('#mdl-title-cuenta').html('Cuenta');
    $('#btn-editar-cuenta').prop('hidden', false);
    $('#btn-clientes-cuenta').prop('hidden', false);
    $('#btn-habilitarCuenta').prop('hidden', true);
    $('#frm-Cuenta').find('.form-control').prop('disabled', true);
    $('#modalGenericoCuenta #empresa_id').prop('hidden', false);
    $('#modalGenericoCuenta #n_cuenta').css("margin-top","0px");
    $('#btn-clientes-cuenta').attr('href','<?=  site_url('') ?>getClientes/'+ <?= $empresa[0]->empr_id ?>);
        /* botones persona fisica */
        if($('#tipoPersonaCuenta').val() == 'tipos_personasFisica'){
        activaBotonesCuentasFisicos();
        }

        /* botones persona moral */
        if($('#tipoPersonaCuenta').val() == 'tipos_personasMoral'){
          activaBotonesCuentasMoral();
        }
    });

    /* oculta/muestra inputs de modal agregar cliente */
    $('#tipoPersonaCuenta').on("change",function(){
    
    /* botones persona fisica */
    if($('#tipoPersonaCuenta').val() == 'tipos_personasFisica'){
      
      activaBotonesCuentasFisicos();
    }

    /* botones persona moral */
    if($('#tipoPersonaCuenta').val() == 'tipos_personasMoral'){
      
      activaBotonesCuentasMoral();
    }

    });


    /* avtiva botones para cliente fisico */
  function activaBotonesCuentasFisicos(){
      /* oculta botones */
      ocultaColumna('#frm-Cuenta', '.col_personaMoral');
      
      /* elimina clase requerido */
      remueveRequerido('#frm-Cuenta' ,'.personaMoral');

      /* muestra botones */
      muestraColumna('#frm-Cuenta', '.col_personaFisica');
   
      /* agrega clase requerido */
      agregaRequerido('#frm-Cuenta','.personaFisica');

  }

  /* activa botones para cuenta  moral */
  function activaBotonesCuentasMoral(){
      /* muestra botones */
      muestraColumna('#frm-Cuenta', '.col_personaMoral');

      /* agrega clase requerido */
      agregaRequerido('#frm-Cuenta','.personaMoral');
 
      /* oculta botones */
      ocultaColumna('#frm-Cuenta', '.col_personaFisica')

      /* remueve clase requerido */
      remueveRequerido('#frm-Cuenta','.personaFisica');
  }

  function ocultaColumnasForm(){
    ocultaColumna('#frm-Cuenta', '.col_personaMoral');
    remueveRequerido('#frm-Cuenta' ,'.personaMoral');
    ocultaColumna('#frm-Cuenta', '.col_personaFisica');
    remueveRequerido('#frm-Cuenta' ,'.personaFisica');
  }

/* habilita la edicion de la cienta */
  function habilitaEditarCuenta(e){
    $('#btn-habilitarCuenta').prop('hidden', false);
    $('#btn-accion-cuenta').show();
    $('#btn-accion-cuenta').html('Modificar');
    $('#btn-accion-cuenta').attr('onclick', 'editarCuenta()');
    $('#frm-Cuenta').find('.form-control').prop('disabled', false);
    $('#btn-editar-cuenta').prop('hidden', true);
    $('#btn-clientes').prop('hidden', false);
    $('#btn-clientes').prop('hidden', true);
}

/* inicializacion botones on/off  de tabla*/
$("[name='habilitarCuentaEditar']").bootstrapSwitch({
  /* habilitar/deshabilitar personas */
  onSwitchChange:function(e, state){
    var empr_id = "<?= $empresa[0]->empr_id ?>";
    if(!state){
      Swal.fire({
        title: '¿Esta seguro que desea deshabilitar la cuenta?',
        text: 'Si continua, ningun usuario de la cuenta podra ingresar al sistema, y sus datos desaparecerán de algunos reportes e indicadores',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, deshabilitar!'
      }).then((result) => {
      if (result.isConfirmed) {
        deshabilitaCuenta(empr_id);
      }
      else{
        //vuelve a el estado original y el ultimo paramaetro es para cortar la ejecucion
        $(this).bootstrapSwitch('state', !state ,true);
      }
      })
    }
    else{
      Swal.fire({
        title: '¿Esta seguro que desea habilitar la cuenta?',
        text: "Ten en cuenta que se habilitaras la cuenta",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, habilitar!'
      }).then((result) => {
      if (result.isConfirmed) {
        habilitaCuenta(empr_id);
      }
      else{
        //vuelve a el estado original y el ultimo paramaetro es para cortar la ejecucion
        $(this).bootstrapSwitch('state', !state ,true);
      }
    });
    } 
  }
});


/* funcion para deshabilitar una cuenta */
function deshabilitaCuenta(empr_id){
  $.get('<?= base_url()?>/eliminarCuenta/' + empr_id, function (data){
          Swal.fire(
              'Deshabilitado!',
              'la cuenta fue deshabilitada.',
              'success'
        );
  })
}

/* funcion para habilitar una cuenta */
function habilitaCuenta(empr_id){
  $.get('<?= base_url()?>/habilitarCuenta/' + empr_id, function (data){
          Swal.fire(
            'Habilitado!',
            'La cuenta fue habilitada.',
            'success'
          );
  })
}

 /*Accion ojo de imagen */
 document.getElementById('verImagenCuenta').onclick = function (){
        event.preventDefault();
        var nom_imagen = '<?= $empresa[0]->nom_imagen ?>';
        var imagen = '<?= $empresa[0]->imagen ?>' 
        if(nom_imagen){
          var codificacion = obtenerExtension(nom_imagen);
          /* decodificacion imagen base64 */
          var decodedData = window.atob(imagen);
          var newTab = window.open();
          newTab.document.body.innerHTML = '<img src="'+ codificacion + decodedData +'" >';
          newTab.document.close();
          $('#imagenCuenta').attr('src', codificacion + decodedData);
        }else{
          $('#imagenCuenta').attr('src', '');
        }   
}


//funcion para cerrar el modal de agregar imagen para que no cierre todos los modales
function cerrarModalImagen(){
  $('#modalAgregarLogoCuenta').modal('hide');
}


/* Carga vista previa de logo cliente */
function cargaVistaPreviaCuenta(){

    var input = $('#inputLogoCuenta').prop('files');

    if(input && input[0]){
    
      var reader = new FileReader();

      reader.addEventListener("load", function (e) {
          $('#imagenCuenta').css('background-image', 'url('+e.target.result +')');
          $('#imagenCuenta').hide();
          $('#imagenCuenta').fadeIn(850);   
      }, false);
        $('#imagenCuenta').attr('src', '');
      reader.readAsDataURL(input[0]);
    }
    cerrarModalImagen();
}

/* Guarda los datos editados de la cuenta */
function editarCuenta(){

var formData = new FormData($('#frm-Cuenta')[0]);
let logo = document.getElementById("inputLogoCuenta").files;
if($('#inputLogoCuenta')[0].files.length !== 0){
  let imagenFile = $('#inputLogoCuenta').prop('files')[0]; 
  formData.append("imagen", imagenFile);
}

//debugger;
formData.append("empr_id",<?= $empresa[0]->empr_id ?>);
/* le pego a tipoPersona el #tipoPersonaCuenta para reutilizar el editar de cuentas */
formData.append("tipoPersona",$('#tipoPersonaCuenta').val());

//validacion datos del formulario
if(!validaForm('#frm-Cuenta')) return;


if(!rfcValido($('#rfcCuenta').val())){
  $('#rfcCuenta').addClass('is-invalid');
  return};

$.ajax({
  type:'POST',
  dataType: 'JSON',
  processData: false,
  contentType: false,
  url: '<?= base_url()?>/editarCuenta',
  data:formData,
  success: function(resp) {
    if(resp['status']){
      notificar(notiSuccess);
      $('#modalGenericoCuenta').modal('hide');
      
    }
    else{
    notificar(notiError);
    }
  },
  error: () => {
    notificar(notiError);
  }
  });
}


/* abrir modal agregar imagen */
$(document).on("click", ".agregaLogoCuenta", function() {
  $('#modalAgregarLogoCuenta').modal('show');
  event.preventDefault();
  $("#modalGenericoCuenta").css('overflow-y', 'auto');//habilita el scroll de nuevo
});


</script>