
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
		        </ul> 
        
          </div>
           <div class="col-sm-3"></div> 
          <div class="col-sm-2">
          <button type="button" class="btn btn-outline-primary btn-block btn-sm"><i class="fa fa-info float-left"></i> Información de la cuenta</button>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1>Clientes</h1>
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
                <h3 class="card-title">Tabla de Clientes</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                <table id="tabla_personas" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Acciones</th>
                    <th>Logo</th>
                    <th>Tipo</th>
                    <th>RFC</th>
                    <th>Nombre Cliente</th>
                    <th>Tipo Persona</th>
                  </tr>
                  </thead>
                  <tbody>
                    <td><div class="btn-group"> 
                                <i class="fa fa-search" style="cursor: pointer;margin: 3px;" title="Ver Detalles" onclick="verCliente(this)"></i>
                                <i class="fa fa-users" style="cursor: pointer;margin: 3px;" title="Ver personas" ></i>
                                <label class="switch" id="miLabel">
                                  <div class="bootstrap-switch-container float-right" style="width: 10px; margin-left: 20px;" >
                                    <input type="checkbox" id="habilitarPersona"  name="habilitarPersona" data-bootstrap-switch>
                                  </div>
                                </label>
                              </div>
                      </td>
                  <td>
                    <img src="<?= base_url()?>/public/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image" style="height: auto; width: 2.1rem;">
                    </td>
                    <td>Alianza</td>
                    <td> 45231254565615</td>
                    <td>Confianza y Tecnologia</td>
                    <td>Moral</td>
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
    <div class="modal fade right" id="nuevo_cliente" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
                <div class="col-2">
                  <h5 class="modal-title" id="mdl-title">Nuevo Cliente</h5>
                </div>
                <label class="switch" >
                <div id="btn-habilitarCliente" hidden>
                    <input type="checkbox" name="habilitarPersonaEditar" id="habilitarPersonaEditar" data-bootstrap-switch-editar checked onclick="habilitarClienteEditar()">   
                </div>
                </label>
                <div class="col-2" >
                    <button type="button" id="btn-editar" class="btn btn-outline-primary btn-block btn-sm" onclick="habilitaEditarCliente()" hidden><i class="fa fa-edit"></i> Editar </button>
                </div>
                <div class="col-2" >
                    <button type="button" id="btn-personas" class="btn btn-outline-primary btn-block btn-sm" hidden><i class="fas fa-users"></i> Personas </button>
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

            <div class="modal-body">
            <form id="frm-nuevoCliente">
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
                                        <p id="cliente_id" style="margin-top: -19px;margin-bottom: -7px; font-style: italic;" hidden></p>
                                        <label>Nombre Comercial <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                          </div>
                                          <input type="text" class="form-control" id="nombreComercial" name="nombreComercial">
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
                                            <select name="tipoCliente" id="tipoCliente" class="form-control">
                                              <option value="" selected disabled> - Seleccionar - </option>
                                              <?php 
                                                foreach ($tipoCliente as $key => $cli) {
                                                  echo "<option value='$cli->tabl_id'>$cli->valor</option>";
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
                                          <img id="logoCliente" class="profile-user-img img-fluid img-circle" src="<?=base_url()?>/public/dist/img/user2-160x160.jpg"/>
                                          <button class="btn btn-sm" style="/*margin-top:-20px;margin-right:150px*/">
                                            <i href="<?base_url()?>/public/dist/img/user2-160x160.jpg" target="_blank" class="fas fa-eye"></i>
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
                                          <input type="text" class="form-control" id="rfc" name="rfc">
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
                                            <select name="nacionalidad" id="nacionalidad" class="form-control">
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
                                    <!-- <div class="col-md-4">
                                    </div> -->
                                    
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label>Tipo de Persona <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="fas fa-genderless"></i></span>
                                            </div>
                                            <select name="tipoPersona" id="tipoPersona" class="form-control">
                                              <option value="" selected disabled> - Seleccionar - </option>
                                              <?php 
                                              foreach ($tipoPersona as $key => $pers) {
                                                echo "<option value='$pers->tabl_id'>$pers->valor</option>";
                                              }
                                            ?>
                                            </select>
                                          </div>
                                      </div>
                                    </div>

                                    <!-- inputs persona moral -->
                                    <div class="col-md-8" id="col_razon" hidden>
                                      <div class="form-group">
                                        <label id="razonSocialLabel">Razón Social <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-wallet"></i></span>
                                          </div>
                                          <input type="text" name="razonSocial" id="razonSocial" class="form-control"> 
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-4" id="col_representante" hidden>
                                      <div class="form-group">
                                        <label>Representante Legal <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-balance-scale"></i></span>
                                          </div>
                                          <input type="text" name="representanteLegal" id="representanteLegal" class="form-control">  
                                       
                                        </div>
                                      </div>
                                    </div>


                                    <!-- inputs persona fisica -->
                                  
                                    <div class="col-md-4" id="col_curp" hidden>
                                      <div class="form-group">
                                        <label>CURP <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                          </div>
                                          <input type="text" class="form-control" id="curp" name="curp">
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-md-4" id="col_nombres" hidden>
                                      <div class="form-group">
                                        <label>Nombres <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                          </div>
                                          <input type="text" class="form-control" id="nombres" name="nombres">
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-md-4" id="col_apellidos"  hidden>
                                      <div class="form-group">
                                        <label>Apellidos <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                          </div>
                                          <input type="text" class="form-control" id="apellidos" name="apellidos">
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-md-4" id="col_genero"  hidden>
                                        <div class="form-group">
                                          <label>Género <strong class="text-danger">*</strong>: </label>
                                          <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="fas fa-genderless"></i></span>
                                            </div>
                                            <select name="genero" id="genero" class="form-control">
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

                                    <div class="col-md-4" id="col_fechaNacimiento"  hidden>
                                      <div class="form-group">
                                        <label>Fecha de Nacimiento <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-birthday-cake"></i></span>
                                          </div>
                                          <input type="date" class="form-control float-left" id="fechaNacimiento" name="fechaNacimiento">
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-md-4" id="col_paisNacimiento"  hidden>
                                      <div class="form-group">
                                        <label>País de nacimiento <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                          </div>
                                          <select name="paisNacimiento" id="paisNacimiento" class="form-control">
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

                                    <div class="col-md-4" id="col_ocupacion" hidden>
                                      <div class="form-group">
                                        <label>Ocupacion<strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                                          </div>
                                          <input type="text" class="form-control" id="ocupacion" name="ocupacion">
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
                                          <input id="telefono" type="text" name="telefono" class="form-control">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <label>Correo electrónico <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text">@</span>
                                          </div><input type="text" class="form-control" name="correo" id="correo" >
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
                                              <input type="text" class="form-control" id="calle" name="calle">
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
                                            <input type="text" class="form-control" id="numeroExterior" name="numeroExterior">
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
                                            <input type="text" class="form-control" id="numeroInterior" name="numeroInterior">
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
                                        <input type="text" class="form-control" id="CodigoColonia" name="CodigoColonia">
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
                <button type="button" class="btn btn-secondary float-right" data-dismiss="modal" onclick="limpiaForm('#nuevo_cliente')" >Cancelar</button>
                <button type="button" class="btn btn-info float-right" id='btn-accion' style="margin-left: 5px;" onclick="guardarCliente()">Crear</button>
              </div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
  </div>

      <!-- Modal Agregar imagen -->
<div class="modal fade" id="modalAgregarLogo">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Agregar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
            </div>

            <form id="formAgregarLogo" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="idAgregaLogo" name="idAgregaLogo">
                    <input id="inputLogo" name="inputImagen" type="file" class="form-control input-md" onclick="cargaVistaPrevia(this)">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Agregar</button>
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
                      text: '<a class="text-light" data-toggle="modal" data-target="#nuevo_cliente"> Agregar </a>',
                      style: 'margin-left:10px',
                      className: 'btn btn-info btn-sm agregar',
                      /* action: function ( e, dt, node, config ) {
                        $('#nueva_cuenta').modal('show');
                      } */
                    }
                  ],
    })
  });

 /* Abre modal nuevo cliente y habilita/deshabilita botones*/
  $("#nuevo_cliente").on("hide.bs.modal", function() {
    $('#btn-accion').attr('onclick', 'guardarCliente()');
    $('#btn-accion').html('Crear');
    $('#mdl-title').html('Nuevo Cliente');
    $('#frm-nuevoCliente').find('.form-control').prop('disabled', false);
    $('#btn-editar').prop('hidden', true);
    $('#btn-personas').prop('hidden', true);
    $('#btn-organigrama').prop('hidden', true);
    $('#btn-cuestionario').prop('hidden', true);
    $('#btn-habilitarCliente').prop('hidden', true);
    $('#btn-accion').show();
    $('#frm-nuevoCliente')[0].reset();


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

  /* oculta/muestra inputs de modal agregar cliente */
  $('#miLabel').on("change",function(){
    alert('holaa')
  });
  

  /* avtiva botones para cliente fisico */
  function activaBotonesClientesFisicos(){
      $('#col_razon').prop('hidden', true);
      $('#col_representante').prop('hidden', true);

      $('#col_curp').prop('hidden', false);
      $('#col_nombres').prop('hidden', false);
      $('#col_apellidos').prop('hidden', false);
      $('#col_genero').prop('hidden', false);
      $('#col_fechaNacimiento').prop('hidden', false);
      $('#col_paisNacimiento').prop('hidden', false);
      $('#col_ocupacion').prop('hidden', false);
  }

  /* activa botones para cliente moral */
  function activaBotonesClientesMoral(){
      $('#col_razon').prop('hidden', false);
      $('#col_representante').prop('hidden', false);

      $('#col_curp').prop('hidden', true);
      $('#col_nombres').prop('hidden', true);
      $('#col_apellidos').prop('hidden', true);
      $('#col_genero').prop('hidden', true);
      $('#col_fechaNacimiento').prop('hidden', true);
      $('#col_paisNacimiento').prop('hidden', true);
      $('#col_ocupacion').prop('hidden', true);
  }

/* Guarda modal de Clientes */
function guardarCliente(){
  var formData = new FormData($('#frm-nuevoCliente')[0]);

  let logo = document.getElementById("inputLogo").files;
  if(logo.lenght!= 0){
    //let imagen = $('#inputImagen').prop('files')[0]; 
    formData.append("logo", logo);
  }

  //validacion datos del formulario
  if(!validarForm()) return;

  $.ajax({
    type:'POST',
    dataType: 'JSON',
    processData: false,
    contentType: false,
    data:formData,
    url: '<?= base_url()?>/guardarCliente',
    success: function(resp) {
      if(resp.status){
        notificar(notiSuccess);
        $('#nuevo_cliente').modal('hide');
        $('#frm-nuevoCliente')[0].reset();
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


/* Validacion de formulario */
function validarForm(){ 
  ban=1;
  if(ban){
    /* Datos Generales */

      if($('#nombreComercial').val() == ''){
         $('#nombreComercial').addClass('is-invalid');
         ban=0;
      }else{
         $('#nombreComercial').removeClass('is-invalid');
         $('#nombreComercial').addClass('is-valid');
      }

      if($('#tipoCliente').val() == null){
         $('#tipoCliente').addClass('is-invalid');
         ban=0;
      }else{
         $('#tipoCliente').removeClass('is-invalid');
         $('#tipoCliente').addClass('is-valid');
      }

      if($('#rfc').val() == ''){
         $('#rfc').addClass('is-invalid');
         ban=0;
      }else{
         $('#rfc').removeClass('is-invalid');
         $('#rfc').addClass('is-valid');
      }

      if($('#nacionalidad').val() == null){
         $('#nacionalidad').addClass('is-invalid');
         ban=0;
      }else{
         $('#nacionalidad').removeClass('is-invalid');
         $('#nacionalidad').addClass('is-valid');
      }

      if($('#tipoPersona').val() == null){
         $('#tipoPersona').addClass('is-invalid');
         ban=0;
      }else{
         $('#tipoPersona').removeClass('is-invalid');
         $('#tipoPersona').addClass('is-valid');
      }

      /* validacion inputs persona moral */
      if($('#tipoPersona').val() == 'tipos_personasMoral'){

        if($('#razonSocial').val() == ''){
          $('#razonSocial').addClass('is-invalid');
          ban=0;
        }else{
          $('#razonSocial').removeClass('is-invalid');
          $('#razonSocial').addClass('is-valid');
        }

        if($('#representanteLegal').val() == ''){
          $('#representanteLegal').addClass('is-invalid');
          ban=0;
        }else{
          $('#representanteLegal').removeClass('is-invalid');
          $('#representanteLegal').addClass('is-valid');
        }

      }

      /* validacion inputs persona fisica */
      if($('#tipoPersona').val() == 'tipos_personasFisica'){

        if($('#curp').val() == ''){
           $('#curp').addClass('is-invalid');
           ban=0;
        }else{
           $('#curp').removeClass('is-invalid');
           $('#curp').addClass('is-valid');  
        } 

        if($('#nombres').val() == ''){
           $('#nombres').addClass('is-invalid');
           ban=0;
        }else{
           $('#nombres').removeClass('is-invalid');
           $('#nombres').addClass('is-valid');
        }

        if($('#apellidos').val() == ''){
           $('#apellidos').addClass('is-invalid');
           ban=0;
        }else{
           $('#apellidos').removeClass('is-invalid');
           $('#apellidos').addClass('is-valid');
        }

        if($('#genero').val() == null){
           $('#genero').addClass('is-invalid');
           ban=0;
        }else{
           $('#genero').removeClass('is-invalid');
           $('#genero').addClass('is-valid');
        } 

        if($('#fechaNacimiento').val() == ''){
           $('#fechaNacimiento').addClass('is-invalid');
           ban=0;
        }else{
           $('#fechaNacimiento').removeClass('is-invalid');
           $('#fechaNacimiento').addClass('is-valid');
        }

        if($('#paisNacimiento').val() == null){
           $('#paisNacimiento').addClass('is-invalid');
           ban=0;
        }else{
           $('#paisNacimiento').removeClass('is-invalid');
           $('#paisNacimiento').addClass('is-valid');
        }

        if($('#ocupacion').val() == ''){
           $('#ocupacion').addClass('is-invalid');
           ban=0;
        }else{
           $('#ocupacion').removeClass('is-invalid');
           $('#ocupacion').addClass('is-valid');
        }

      }

      /* Datos de Contacto */
      if($('#telefono').val() == ''){
         $('#telefono').addClass('is-invalid');
         ban=0;
      }else{
         $('#telefono').removeClass('is-invalid');
         $('#telefono').addClass('is-valid');
      }

      if($('#correo').val() == ''){
         $('#correo').addClass('is-invalid');
         ban=0;
      }else{
         $('#correo').removeClass('is-invalid');
         $('#correo').addClass('is-valid');
      }

      if($('#calle').val() == ''){
         $('#calle').addClass('is-invalid');
         ban=0;
      }else{
         $('#calle').removeClass('is-invalid');
         $('#calle').addClass('is-valid');
      }

      if($('#numeroExterior').val() == ''){
         $('#numeroExterior').addClass('is-invalid');
         ban=0;
      }else{
         $('#numeroExterior').removeClass('is-invalid');
         $('#numeroExterior').addClass('is-valid');
      }

      if($('#numeroInterior').val() == ''){
         $('#numeroInterior').addClass('is-invalid');
         ban=0;
      }else{
         $('#numeroInterior').removeClass('is-invalid');
         $('#numeroInterior').addClass('is-valid');
      }

      if($('#CodigoColonia').val() == ''){
         $('#CodigoColonia').addClass('is-invalid');
         ban=0;
      }else{
         $('#CodigoColonia').removeClass('is-invalid');
         $('#CodigoColonia').addClass('is-valid');
      }
}

  if(!ban){
    notificar(notiObligatoriedad);
  }
  return ban; 
  
}

/* Elimina los estilos de los input correctos-incorrectos */
function limpiaForm(formulario){
  $(formulario).find(".is-valid").removeClass().addClass('form-control');
  $(formulario).find(".is-invalid").removeClass().addClass('form-control');

  /* oculto todos los botones */
      $('#col_razon').prop('hidden', true);
      $('#col_representante').prop('hidden', true);
      $('#col_curp').prop('hidden', true);
      $('#col_nombres').prop('hidden', true);
      $('#col_apellidos').prop('hidden', true);
      $('#col_genero').prop('hidden', true);
      $('#col_fechaNacimiento').prop('hidden', true);
      $('#col_paisNacimiento').prop('hidden', true);
      $('#col_ocupacion').prop('hidden', true);
}

/* Permite ver los datos de cada persona */
function verCliente(e){

   /*  var tr = $(e).closest('tr');
    var json = $(tr).data('json'); */


    $('#btn-accion').hide();
    $('#mdl-title').html('Cliente');
    $('#frm-nuevoCliente').find('.form-control').prop('disabled', true);
    $('#btn-editar').prop('hidden', false);
    $('#btn-personas').prop('hidden', false);
    $('#btn-organigrama').prop('hidden', false);
    $('#btn-cuestionario').prop('hidden', false); 

    var tipe_id='tipos_personasFisica';

    if(tipe_id == 'tipos_personasMoral'){
      activaBotonesClientesMoral();
    }

    if(tipe_id == 'tipos_personasFisica'){
     activaBotonesClientesFisicos();
    }

    $('#nuevo_cliente').modal('show');
    $('#btn-habilitarPersona').prop('hidden', true); 

  /*   var tr = $(e).closest('tr');
    var json = $(tr).data('json');
    $('#nueva_persona #pers_id').val(json.pers_id);


    if(json.estado == 'true')
    {
      $('#habilitarPersonaEditar').prop('checked',false).change();
    }
    else{
     $('#habilitarPersonaEditar').prop('checked',true).change();
    } */
    
}

/*boton que habilita editar los datos de una persona en el modal */
function habilitaEditarCliente(){

  $('#btn-editar').prop('hidden', true);
  $('#btn-personas').prop('hidden', true);
  $('#btn-organigrama').prop('hidden', true);
  $('#btn-cuestionario').prop('hidden', true); 

  $('#btn-habilitarCliente').prop('hidden', false);
  $('#btn-accion').show();
  $('#btn-accion').html('Modificar');
  $('#btn-accion').attr('onclick', 'editarCliente()');
  $('#frm-nuevoCliente').find('.form-control').prop('disabled', false);
  $('#btn-editar').prop('hidden', true);

}

/* Guarda los datos editados de la persona */
function editarCliente(){

  var formData = new FormData($('#frm-nuevaPersona')[0]);

  let imagen = document.getElementById("inputImagen").files;
  if(imagen.lenght!= 0){
    //img = $('#inputImagen').prop('files')[0];
    formData.append("imagen", imagen);
  }

 // debugger;
  formData.append("pers_id",$('#nueva_persona #pers_id').val());
  
  //validacion datos del formulario
  if(!validarForm()) return;

  $.ajax({
    type:'POST',
    dataType: 'JSON',
    processData: false,
    contentType: false,
    url: '<?= base_url()?>/editarPersona',
    data:formData,
    success: function(resp) {
      notificar(notiSuccess);
      $('#nueva_persona').modal('hide');
      $('#frm-nuevaPersona')[0].reset();
      limpiaForm('#nueva_persona');
    },
    error: () => {
      notificar(notiError);
    },
    complete: function() {
      notificar(notiSuccess);
      window.location.reload();
    }
    });
}

 /* inicializacion botones on/off */
$("input[data-bootstrap-switch]").bootstrapSwitch();
$("[name='habilitarPersonaEditar']").bootstrapSwitch();

/* abrir modal agregar imagen */
$(document).on("click", ".agregaLogo", function() {
  $('#modalAgregarLogo').modal('show');
  event.preventDefault();
  $("#nuevo_cliente").css('overflow-y', 'auto');//habilita el scroll de nuevo
});

/* permite habilitar o deshabilitar una persona */
function habilitarPersona(e){  
  var tr = $(e).closest('tr');
  var json = $(tr).data('json');
  var pers_id = json.pers_id;
  //debugger;
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
        $(e).closest("tr").find('input[type="checkbox"]').prop('checked',true).change();
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
        $(e).closest("tr").find('input[type="checkbox"]').prop('checked',false).change();
      }
    });
  } 
}
function cargaVistaPrevia(input){
  if(input.files && input.files[0]){
      // var idImagen = $(input).attr('id');
      var reader = new FileReader();

      reader.addEventListener("load", function (e) {
          $('#logoCliente').css('background-image', 'url('+e.target.result +')');
          $('#logoCliente').hide();
          $('#logoCliente').fadeIn(850);   
      }, false);

      reader.readAsDataURL(input.files[0]);
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
</script>

<?= $this->endSection() ?>





