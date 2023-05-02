
<?php $this->extend('templates/admin_template') ?>

<?= $this->section('content') ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2"> 
          <div class="col-sm-7">
             <ul class="breadcrumb">
             <!-- <button type="button" class="completed"><i class="fa fa-folder"></i></button> -->
			        <li class="completed" ><a><i class="fa fa-folder-open"></i></a></li>
			        <li class="completed" ><a>CONFIANZA Y TECNOLOGIA</a></li>
			        <li class="active"><a>BIMBO S.A de C.V.</a></li>
		        </ul> 
        
          </div>
           <div class="col-sm-3"></div> 
          <div class="col-sm-2">
          <button type="button" class="btn btn-outline-primary btn-block btn-sm"><i class="fa fa-info float-left"></i> Información del Cliente</button>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1>Personas</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tabla de Personas</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                <table id="tabla_personas" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Acciones</th>
                    <th>Imagen</th>
                    <th>CURP</th>
                    <th>Apellidos</th>
                    <th>Nombres</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($listadoPersonas as $key => $persona) {
                      /* imagen de perfil */
                      if($persona->imagen) 
                      {$src = imagePerfil($persona->imagen, $persona->nom_imagen); $class = "img-circle elevation-2"; $style = "height: 3rem; width: 3.9rem";}
                      else{ $src = ""; $class = ""; $style = "";  }
                     (strcmp($persona->estado, 'true') == 0) ? $check= '' : $check = 'checked';
                      echo '<tr data-json=\''.json_encode($persona).'\'>';
                      echo'<td>
                              <div class="btn-group"> 
                                <i class="fa fa-search" style="cursor: pointer;margin: 3px;" title="Ver Detalles" onclick="verPersona(this)"></i>
                                <label class="switch" id="miLabel">
                                <div class="bootstrap-switch-container float-right" style="width: 15px; margin-left: 24px;" >
                                  <input type="checkbox" id="habilitarPersona"  name="habilitarPersona" data-bootstrap-switch '.$check.'>
                                </div>
                                </label>
                              </div>
                            </td>
                            <td class="centrar"><img src="'. $src .'" class="'.$class.'" style="'.$style.'"/></td>
                            <td>'.$persona->curp.'</td>
                            <td>'.$persona->apellidos.'</td>
                            <td>'.$persona->nombres.'</td>
                    </tr>
                    ';
                    }?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->


    <!-- MODAL NUEVA PERSONA -->
    <div class="modal fade right" id="nueva_persona" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
                <div class="col-3">
                  <h5 class="modal-title" id="mdl-title">Nueva Persona</h5>
                </div>
                <label class="switch">
                <div id="btn-habilitarPersona" hidden>
                    
                    <input type="checkbox" name="habilitarPersonaEditar" id="habilitarPersonaEditar" data-bootstrap-switch-editar checked onclick="habilitarPersonaEditar()">
                    
                </div>
                </label>
                <div class="col-3" >
                    <button type="button" id="btn-editar" class="btn btn-outline-primary btn-block btn-sm" onclick="habilitaEditarPersona()" hidden><i class="fa fa-edit"></i> Editar</button>
                </div>
                <div class="col-3" >
                    <button type="button" id="btn-asociarPosicion" class="btn btn-outline-primary btn-block btn-sm" hidden><i class="fas fa-inbox" ></i> Asociar posición</button>
                </div>
                <div class="col-2">
                <button type="button" class="close" onclick="limpiaForm('#nueva_persona')" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
                </div>
              
            </div>

            <div class="modal-body">
            <form id="frm-nuevaPersona">
              <input id="pers_id" name="pers_id" type="text" disabled hidden>
              <input id="clie_id" name="clie_id" type="text" hidden value="3">
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
                                        <p id="persona_id" style="margin-top: -19px;margin-bottom: -7px; font-style: italic;" hidden></p>
                                        <label>Apellidos <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                          </div>
                                          <input type="text" class="form-control requerido" id="apellidos" name="apellidos">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label>Nombres <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                          </div>
                                          <input type="text" class="form-control requerido" id="nombres" name="nombres">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-4 centrar">
                                      <div class="form-group">
                                        <!-- <label>Imagen </label> -->
                                        <div class="" style="position:initial;">
                                          <!-- <i class="fas fa-user" style="right:250px;"></i> -->
                                          <img id="imagenUsuario" class="profile-user-img img-fluid img-circle" style="height: 100px; width: 100px"  >
                                          <button class="btn btn-sm" style="/*margin-top:-20px;margin-right:150px*/">
                                            <a id="verImagen" target="_blank" class="fas fa-eye"></a>
                                          </button>
                                          <button class="btn btn-sm agregaImagen" style="/*margin-top:-5px;margin-right:150px*/">
                                            <i class="fas fa-upload"></i>
                                          </button>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label>CURP <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                          </div>
                                          <input type="text" class="form-control requerido" id="curp" name="curp">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                          <label>Género <strong class="text-danger">*</strong>: </label>
                                          <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="fas fa-genderless"></i></span>
                                            </div>
                                            <select name="genero" id="genero" class="form-control requerido">
                                              <option value="" selected disabled> - Seleccionar - </option>
                                              <?php 
                                                foreach ($listadoGeneros as $key => $gen) {
                                                  echo "<option value='$gen->tabl_id'>$gen->valor</option>";
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
                                        <label>Fecha de Nacimiento <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-birthday-cake"></i></span>
                                          </div>
                                          <input type="date" class="form-control float-left requerido" id="fechaNacimiento" name="fechaNacimiento">
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label>País de nacimiento <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                          </div>
                                          <select name="paisNacimiento" id="paisNacimiento" class="form-control requerido">
                                            <option value="" selected disabled> - Seleccionar - </option>
                                            <?php 
                                              foreach ($listadoPaises as $key => $pa) {
                                                echo "<option value='$pa->tabl_id'>$pa->valor</option>";
                                              }
                                            ?>
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label>Estado Civil <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-ring"></i></span>
                                          </div>
                                          <select name="estadoCivil" id="estadoCivil" class="form-control requerido">
                                            <option value="" selected disabled> - Seleccionar - </option>
                                            <?php 
                                              foreach ($listadoEstadoCivil as $key => $civil) {
                                                echo "<option value='$civil->tabl_id'>$civil->valor</option>";
                                              }
                                            ?>
                                          </select>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label>Nacionalidad<strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
                                          </div>
                                          <select name="nacionalidad" id="nacionalidad" class="form-control requerido">
                                            <option value="" selected disabled> - Seleccionar - </option>
                                            <?php 
                                              foreach ($listadoPaises as $key => $pa) {
                                                echo "<option value='$pa->tabl_id'>$pa->valor</option>";
                                              }
                                            ?>
                                          </select>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label>Escolaridad<strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                                          </div>
                                          <select name="escolaridad" id="escolaridad" class="form-control requerido">
                                            <option value="" selected disabled> - Seleccionar - </option>
                                            <?php 
                                              foreach ($listadoNivelEducativo as $key => $esco) {
                                                echo "<option value='$esco->tabl_id'>$esco->valor</option>";
                                              }
                                            ?>
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label>Ocupacion<strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                                          </div>
                                          <input type="text" class="form-control requerido" id="ocupacion" name="ocupacion">
                                        </div>
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
                                  <div class="row mt-3">
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label>Teléfono <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                          </div>
                                          <input id="telefono" type="text" name="telefono" class="form-control requerido">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <label>Correo electrónico <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text">@</span>
                                          </div>
                                          <input type="text" class="form-control requerido" name="correo" id="correo" >
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
                                              <input type="text" class="form-control requerido" id="calle" name="calle">
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
                                            <input type="text" class="form-control requerido" id="numeroExterior" name="numeroExterior">
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
                                            <input type="text" class="form-control requerido" id="numeroInterior" name="numeroInterior">
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
                                        <input type="text" class="form-control requerido" id="CodigoColonia" name="CodigoColonia">
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
            </div><!-- fin modal-body -->
            <div class="modal-footer ">
              <div class="col-mt-1 col-12 justify-content-center" style="margin-top:-5px">
                <button type="button" class="btn btn-secondary float-right" data-dismiss="modal" onclick="limpiaForm('#nueva_persona')" >Cancelar</button>
                <button type="button" class="btn btn-info float-right" id='btn-accion' style="margin-left: 5px;" onclick="guardarPersona()">Crear</button>
              </div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>


      <!-- Modal Agregar imagen -->
<div class="modal fade" id="modalAgregarImagen">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Agregar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
            </div>

            <form id="formAgregarImagen" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="idAgregaImagen" name="idAgregaImagen">
                    <input id="inputImagen" name="inputImagen" type="file" class="form-control input-md">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="cargaVistaPrevia()">Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
/* definicion de datatablet */
  $(function () {
    $("#tabla_personas").DataTable({
      dom: 'lfBtip', //orden de los elementos del datatable
      'initComplete': function (settings, json) {
        //estilos botones iniciales
        var btns = $('.dt-buttons');
        $('.dt-buttons').css('display','block');
        $('.dt-buttons').css('margin-top','-30px');
        $('.dt-buttons').removeClass('btn-group');
      },
      "responsive": true,"lengthChange": true, "autoWidth": false,
      "buttons":  [
                    {
                      extend:"excel",
                      text:'<i class="fas fa-file-excel "></i><a class="text-secondary"> Excel </a>',
                      className: 'btn btn-default btn-sm'
                    },
                    {
                      extend:"pdf", 
                      text:'<i class="fas fa-file-pdf"></i><a class="text-secondary"> PDF </a>',
                      className: 'btn btn-default btn-sm'
                    },
                    {
                      extend:"copy",
                      text:'<i class="fas fa-file"></i><a class="text-secondary"> Copiar </a>',
                      className: 'btn btn-default btn-sm'
                    },
                    {
                      extend:"print",
                      text:'<i class="fas fa-print"></i><a class="text-secondary"> Imprimir </a>',
                      className: 'btn btn-default btn-sm'
                    },
                   /*  {
                      extend:"colvis",
                      text:'<a class="text-light"> Ocultar columnas </a>',
                      className: 'btn btn-dark btn-sm'
                    },  */
                    {
                      text: '<a class="text-light" data-toggle="modal" data-target="#nueva_persona"> Agregar </a>',
                      style: 'margin-left:10px',
                      className: 'btn btn-info btn-sm agregar',
                      /* action: function ( e, dt, node, config ) {
                        $('#nueva_cuenta').modal('show');
                      } */
                    }
                  ],
    })/* .buttons().container().appendTo('#tabla_personas .col-md-6:eq(0)'); */
  });

 /* Abre modal nueva persona y habilita/deshabilita botones*/
  $("#nueva_persona").on("hide.bs.modal", function() {
    $('#btn-accion').attr('onclick', 'guardarPersona()');
    $('#btn-accion').html('Crear');
    $('#mdl-title').html('Nueva Persona');
    $('#frm-nuevaPersona').find('.form-control').prop('disabled', false);
    $('#btn-editar').prop('hidden', true);
    $('#btn-asociarPosicion').prop('hidden', true);
    $('#btn-habilitarPersona').prop('hidden', true);
    $('#btn-accion').show();
    $('#persona_id').prop('hidden', true);
    $('#frm-nuevaPersona')[0].reset();
    $("imagenUsuario").removeAttr("src","");
  }); 


/* Guarda modal de persona */
function guardarPersona(){
  var formData = new FormData($('#frm-nuevaPersona')[0]);

  let imagen = document.getElementById("inputImagen").files;
  if(imagen.lenght!= 0){
    let imagenFile = $('#inputImagen').prop('files')[0]; 
    formData.append("imagen", imagenFile);
  }

  //validacion datos del formulario
  if(!validaForm('#frm-nuevaPersona')) return;
  $.ajax({
    type:'POST',
    dataType: 'JSON',
    processData: false,
    contentType: false,
    data:formData,
    url: '<?= base_url()?>/guardarPersona',
    success: function(resp) {
      if(resp.status){
        notificar(notiSuccess);
        $('#nueva_persona').modal('hide');
        $('#frm-nuevaPersona')[0].reset();
        limpiaForm('#nueva_persona');
      }else{
        notificar(notiError);
      }
    },
    error: function(result){
      notificar(notiError);
    }
  });
}

/* Permite ver los datos de cada persona */
function verPersona(e){
    $('#btn-accion').hide();
    $('#mdl-title').html('Persona');
    $('#frm-nuevaPersona').find('.form-control').prop('disabled', true);
    $('#btn-editar').prop('hidden', false);
    $('#btn-asociarPosicion').prop('hidden', false);
    $('#nueva_persona').modal('show');
    $('#btn-habilitarPersona').prop('hidden', true);
    $('#persona_id').prop('hidden', false);

    var tr = $(e).closest('tr');
    var json = $(tr).data('json');
    $('#nueva_persona #pers_id').val(json.pers_id);
    $('#nueva_persona #apellidos').val(json.apellidos);
    $('#nueva_persona #nombres').val(json.nombres);
    $('#nueva_persona #curp').val(json.curp);
    $('#nueva_persona #pers_id').val(json.pers_id);
    $('#nueva_persona #genero').val(json.gene_id);
    $('#nueva_persona #telefono').val(json.telefono);
    $('#nueva_persona #correo').val(json.email);
    $('#nueva_persona #numeroExterior').val(json.num_exterior);
    $('#nueva_persona #numeroInterior').val(json.num_interior);
    $('#nueva_persona #ocupacion').val(json.ocupacion);
    $('#nueva_persona #calle').val(json.calle);
    $('#nueva_persona #CodigoColonia').val(json.cod_postal);
    $('#nueva_persona #escolaridad').val(json.educ_id);
    $('#nueva_persona #estadoCivil').val(json.esci_id);
    $('#nueva_persona #nacionalidad').val(json.naci_id);
    $('#nueva_persona #paisNacimiento').val(json.pana_id);
    $('#nueva_persona #fechaNacimiento').val(json.fec_nacimiento.slice(0,10));
    $('#nueva_persona #persona_id').text( "(id: " + json.pers_id + ")");
    if(json.nom_imagen){
      var codificacion = obtenerExtension(json.nom_imagen);

      /* decodificacion imagen base64 */
      var decodedData = window.atob(json.imagen);

      $('#verImagen').attr('href', codificacion + decodedData);

      $('#imagenUsuario').attr('src', codificacion + decodedData);
    }
    else{
      $('#verImagen').attr('href', '');

      $('#imagenUsuario').attr('src', '');
    }

    if(json.estado == 'true')
    {
      $('#habilitarPersonaEditar').prop('checked',false).change();
    }
    else{
     $('#habilitarPersonaEditar').prop('checked',true).change();
    }
    
}

/*boton que habilita editar los datos de una persona en el modal */
function habilitaEditarPersona(){
  $('#btn-habilitarPersona').prop('hidden', false);
  $('#btn-accion').show();
  $('#btn-accion').html('Modificar');
  $('#btn-accion').attr('onclick', 'editarPersona()');
  $('#frm-nuevaPersona').find('.form-control').prop('disabled', false);
  $('#btn-editar').prop('hidden', true);
  $('#btn-asociarPosicion').prop('hidden', false);
  $('#btn-asociarPosicion').prop('hidden', true);

}

/* Guarda los datos editados de la persona */
function editarPersona(){

  var formData = new FormData($('#frm-nuevaPersona')[0]);
  let imagen = document.getElementById("inputImagen").files;
  if($('#inputImagen')[0].files.length !== 0 ){
    let imagenFile = $('#inputImagen').prop('files')[0]; 
    formData.append("imagen", imagenFile);
  }

  formData.append("pers_id",$('#nueva_persona #pers_id').val());
  
  //validacion datos del formulario
  if(!validaForm('#frm-nuevaPersona')) return;
  $.ajax({
    type:'POST',
    dataType: 'JSON',
    processData: false,
    contentType: false,
    url: '<?= base_url()?>/editarPersona',
    data:formData,
    success: function(resp) {
      debugger;
      if(resp.status){
        notificar(notiSuccess);
        $('#nueva_persona').modal('hide');
        $('#frm-nuevaPersona')[0].reset();
        limpiaForm('#nueva_persona');
      }else{
        notificar(notiError);
      }
    },
    error: () => {
      debugger;
      notificar(notiError);
    },
    complete: function() {
      debugger;
      // notificar(notiSuccess);
      $('#nueva_persona').modal('hide');
      $('#frm-nuevaPersona')[0].reset();
      limpiaForm('#nueva_persona');
      actualizaTablaPersonas();
      // window.location.reload();
    }
    });
}

 /* inicializacion botones on/off */
$("input[data-bootstrap-switch]").bootstrapSwitch({
  onSwitchChange:function(e, state){
    var tr = $(e.target).closest('tr');
    var json = $(tr).data('json');
    console.log(json);
    habilitarPersona(json, e.target);   
  }
});


$("[name='habilitarPersonaEditar']").bootstrapSwitch();

/* abrir modal agregar imagen */
$(document).on("click", ".agregaImagen", function() {
  $('#modalAgregarImagen').modal('show');
  event.preventDefault();
  $("#nueva_persona").css('overflow-y', 'auto');//habilita el scroll de nuevo
});

/* permite habilitar o deshabilitar una persona */
function habilitarPersona(json, tag){
  event.preventDefault();  
  var pers_id = json.pers_id;
  check = json.estado;
  if(check == 'false'){
      Swal.fire({
        title: '¿Está seguro?',
        text: 'Si deshabilita a la Persona, la misma no aparecerá en algunos reportes o indicadores, y no podrá responder cuestionarios',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, deshabilitar!'
      }).then((result) => {
      if (result.isConfirmed) {
        $.get('<?= base_url()?>/eliminarPersona/' + pers_id, function (data){
          Swal.fire(
              'Deshabilitado!',
              'El usuario fue deshabilitado.',
              'success'
            );
        })
      }
      else{
        $(tag).closest("tr").find('input[type="checkbox"]').prop('checked',true).change();
      }
    });    
  }
  else{
    Swal.fire({
        title: 'Habilitar usuario?',
        text: "Ten en cuenta que se habilitaras el usuario",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, habilitar!'
      }).then((result) => {
      if (result.isConfirmed) {
        $.get('<?= base_url()?>/habilitarPersona/' + pers_id, function (data){
          Swal.fire(
            'Habilitado!',
            'El usuario fue habilitado.',
            'success'
          );
        })
      }
      else{
        $(tag).closest("tr").find('input[type="checkbox"]').prop('checked',false).change();
      }
    });
  } 
}
function cargaVistaPrevia(){
  var input = $('#inputImagen').prop('files');
  if(input && input[0]){
      var reader = new FileReader();

      reader.addEventListener("load", function (e) {
          $('#imagenUsuario').prop('src', e.target.result);
          $('#imagenUsuario').hide();
          $('#imagenUsuario').fadeIn(850);   
      }, false);

      reader.readAsDataURL(input[0]);
  }
}
 
/* habilitar/deshabilitar persona desde modal ver persona */
function habilitarPersonaEditar(){
  var pers_id = $('#pers_id').val();
  if(!$('#habilitarPersonaEditar').prop('checked'))
  {
    Swal.fire({
        title: 'Habilitar usuario?',
        text: "Ten en cuenta que se habilitaras el usuario",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, habilitar!'
      }).then((result) => {
      if (result.isConfirmed) {
        $.get('<?= base_url()?>/habilitarPersona/' + pers_id, function (data){
          Swal.fire(
            'Habilitado!',
            'El usuario fue habilitado.',
            'success'
          );
        })
        $('#habilitarPersonaEditar').prop('checked',true).change();
      }
      else{
        $('#habilitarPersonaEditar').prop('checked',false).change();
      }
    });
  }
  else{
    Swal.fire({
        title: '¿Está seguro?',
        text: 'Si deshabilita a la Persona, la misma no aparecerá en algunos reportes o indicadores, y no podrá responder cuestionarios',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, deshabilitar!'
      }).then((result) => {
      if (result.isConfirmed) {
        $.get('<?= base_url()?>/eliminarPersona/' + pers_id, function (data){
          Swal.fire(
            'Deshabilitado!',
            'El usuario fue deshabilitado.',
            'success'
          );
        })
        $('#habilitarPersonaEditar').prop('checked',false).change();
      }
      else{
        $('#habilitarPersonaEditar').prop('checked',true).change();
      }
    });
  }
}

/* actualiza tabla personas */
function actualizaTablaPersonas(){
  $.ajax({
        type: 'POST',
        cache: false,
        dataType: "json",
        url: "<?= base_url()?>/getPersonas",
  success:function(data){

    tabla = $('#tabla_personas').DataTable();
    tabla.clear().draw();

    $.each(data, function (i, value) {

    //activar o desactivar checked
    if(value.estado == 'true'){
      check= '';
    }
    else {
      check = 'checked';
    }

    //estilos imagen perfil
    if(value.imagen){
            var ext = obtenerExtension(value.nom_imagen);
            /* decodificacion imagen base64 */
            var decodedData = window.atob(value.imagen);
            var src = ext + decodedData;
            clase="img-circle elevation-2" ;
            estilo="height: 3rem; width: 3.9rem";
          }
          else{
            src= '';
            estilo='';
            clase='';
          }

      fila="<tr data-json= '"+ JSON.stringify(value) +"'>" +
          '<td>'+
            '<div class="btn-group"> '+
            '<i class="fa fa-search" style="cursor: pointer;margin: 3px;" title="Ver Detalles" onclick="verPersona(this)"></i>'+
             '<label class="switch" id="miLabel">'+
             '<div class="bootstrap-switch-container float-right" style="width: 15px; margin-left: 24px;" >'+
               '<input type="checkbox" id="habilitarPersona"  name="habilitarPersona" data-bootstrap-switch onclick="habilitarPersona(this)" '+ check +'>'+
             '</div>'+
             '</label>'+
            '</div>'+
          '</td>'+
            
          '<td class="centrar"><img src="'+ src +'" class="'+clase+'" style="'+estilo+'"/></td>'+

          '<td>'+ value.curp +'</td>'+
          '<td>'+ value.apellidos +'</td>'+
          '<td>'+ value.nombres +'</td>'+
          '</tr>';
          tabla.row.add($(fila)).draw();
    });
        //inicio de checkbox-switch  
        $("input[data-bootstrap-switch]").bootstrapSwitch();
      
  }   
  });
}
</script>

<?= $this->endSection() ?>


