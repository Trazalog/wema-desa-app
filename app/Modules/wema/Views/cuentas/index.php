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
          <button type="button" class="btn btn-outline-primary btn-block btn-sm"><i class="fa fa-info float-left"></i> Información del Cuentas</button>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1>Cuentas</h1>
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
                <h3 class="card-title">Tabla de cuentas</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                <table id="tabla_cuentas" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Acciones</th>
                    <th>Logo</th>
                    <th>Tipo(s)</th>
                    <th>RFC</th>
                    <th>Nombre Cuenta</th>
                    <th>Tipo Persona</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($listadoEmpresas as $key => $empresa){

                    /* imagen de perfil */
                    if($empresa->imagen){
                      $src = imagePerfil($empresa->imagen, $empresa->nom_imagen); $class = "img-circle elevation-2"; $style = "height: 3rem; width: 3.9rem";}
                    else{ 
                      $src = ""; $class = ""; $style = "";  
                    }
                    (strcmp($empresa->eliminado, 'true') == 0) ? $check= '' : $check = 'checked';

                    echo '<tr data-json=\''.json_encode($empresa).'\'>';

                    echo'<td>
                            <div class="btn-group"> 
                              <i class="fa fa-search" style="cursor: pointer;margin: 3px;" title="Ver Detalles" onclick="verCuenta(this);"></i>
                              <label class="switch">
                                <div class="bootstrap-switch-container float-right" style="width: 15px; margin-left: 24px;" >
                                <input type="checkbox" name="habilitarCuenta" data-bootstrap-switch '.$check.'>
                                </div>
                                <i class="fa fa-users" style="cursor: pointer;margin: 3px;" title="Ver Listado"  onclick="listadoClienteCuenta(this);"></i>
                              </label>
                            </div>
                          </td>
                          <td class="centrar"><img src="'. $src .'" class="'.$class.'" style="'.$style.'"/></td>
                          <td>'.$empresa->empresa.'</td>
                          <td>'.$empresa->id_tributario.'</td>
                          <td>'.$empresa->nombre.'</td>
                          <td>'.$empresa->persona.'</td>
                    </tr>';

                  } ?>              
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

    <!-- MODAL NUEVA CUENTA -->
    <div class="modal fade right" id="list_cuenta_clientes" aria-modal="true" role="dialog">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <div class="col-6"><h5 class="modal-title" id="mdl-title">Lisatdo Clientes</h5></div>
            <div class="col-2">
              <button type="button" class="close"  data-dismiss="modal" aria-label="Close" onclick="limpiaForm('#list_cuenta_clientes')">
                <span aria-hidden="true">×</span>
              </button>
          </div>
          </div><!-- fin modal-header -->

          <div class="modal-body"></div><!-- fin modal-body -->

          <div class="modal-footer ">
            <button type="button" class="btn btn-secondary float-left" data-dismiss="modal" onclick='limpiaForm("#list_cuenta_clientes")'>Cerrar</button>

          </div><!-- fin modal-footer -->          
        
        </div><!-- /.modal-content -->        
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal-dialog -->


    <!-- MODAL NUEVA CUENTA -->
    <div class="modal fade right" id="nueva_cuenta" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
          <div class="modal-header">
                <div class="col-3">
                  <h5 class="modal-title" id="mdl-title">Nueva Cuenta</h5>
                </div>
                <label class="switch" onclick="habilitarCuenta();">
                <div id="btn-habilitarCuenta" class="bootstrap-switch-container" style="width: 126px; margin-left: -42px;" hidden>
                  <input type="checkbox" name="habilitarCuentaEditar" data-bootstrap-switch-editar checked>
                </div>
                </label>
                <div class="col-3" >
                    <button type="button" id="btn-editar" class="btn btn-outline-primary btn-block btn-sm" onclick="habilitaEditarCuenta()" hidden><i class="fa fa-edit"></i> Editar</button>
                </div>
                <div class="col-3" >
                    <button type="button" id="btn-clientes" class="btn btn-outline-primary btn-block btn-sm" hidden><i class="fas fa-inbox" ></i> Clientes</button>
                </div>
                <div class="col-2">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close" onclick="limpiaForm('#nueva_cuenta')">
                  <span aria-hidden="true">×</span>
                </button>
                </div>
              
            </div>
            <div class="modal-body">
            <form id="frm-nuevaCuenta">
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
                                        <p id="empresa_id" style="margin-top: 2px;margin-bottom: -7px; font-style: italic;" hidden></p>
                                        <label>Nombre Cuenta <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                          </div>
                                          <input type="text" class="form-control requerido" id="nombreCuenta" name="nombreCuenta">
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                          <label style="margin-top: 20px">Tipo Cuenta <strong class="text-danger">*</strong>: </label>
                                          <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <select name="tipoCuenta" id="tipoCuenta" class="form-control requerido">
                                              <option value="" selected disabled> - Seleccionar - </option>
                                              <?php 
                                                  foreach ($listadoTipompresas as $key => $pers) {
                                                    echo "<option value='$pers->tabl_id'>$pers->valor</option>";
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
                                          <img id="imagenCuenta" class="profile-user-img img-fluid img-circle" style="height: 100px; width: 100px"  >
                                          <button class="btn btn-sm" style="/*margin-top:-20px;margin-right:150px*/">
                                            <i id="verImagen" class="fas fa-eye"></i>
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
                                          <input type="text" class="form-control requerido" id="rfcCuenta" name="rfcCuenta">
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
                                        <label>Tipo de Persona <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="fas fa-genderless"></i></span>
                                            </div>
                                            <select name="tipoPersona" id="tipoPersona" class="form-control requerido">
                                              <option value="" selected disabled> - Seleccionar - </option>
                                              <?php 
                                                  foreach ($listadoPersonas as $key => $pers) {
                                                    echo "<option value='$pers->tabl_id'>$pers->valor</option>";
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
                                          <input type="text" name="razonSocial" id="razonSocial" class="form-control requerido personaMoral"> 
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
                                          <input type="text" name="representanteLegal" id="representanteLegal" class="form-control requerido personaMoral">  
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
                                          <input type="text" class="form-control requerido personaFisica" id="curp" name="curp">
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
                                          <input type="text" class="form-control requerido personaFisica" id="nombres" name="nombres">
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
                                          <input type="text" class="form-control requerido personaFisica" id="apellidos" name="apellidos">
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

                                    <div class="col-md-4 col_personaFisica"  hidden>
                                      <div class="form-group">
                                        <label>Fecha de Nacimiento <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-birthday-cake"></i></span>
                                          </div>
                                          <input type="date" class="form-control float-left requerido personaFisica" id="fechaNacimiento" name="fechaNacimiento">
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

                                    <div class="col-md-4 col_personaFisica"  hidden>
                                      <div class="form-group">
                                        <label>Ocupacion<strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                                          </div>
                                          <input type="text" class="form-control requerido personaFisica" id="ocupacion" name="ocupacion">
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
                                          <input id="telefono" type="text" class="form-control" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask="" inputmode="text">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label>Correo electrónico <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text">@</span>
                                          </div><input type="text" class="form-control" id="correo" >
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
                                          <input type="text" class="form-control" id="numeroExterior" name="numeroExterior">
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                          <label>Número Interior <strong class="text-danger">*</strong>: </label>
                                          <input type="text" class="form-control" id="numeroInterior" name="numeroInterior">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label>Codigo Postal / Colonia <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-search"></i></span>
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
              <div  class="col-mt-1 col-12 justify-content-center" style="margin-top:-5px">
                <button type="button" class="btn btn-secondary float-left" data-dismiss="modal" onclick='limpiaForm("#nueva_cuenta")'>Cancelar</button>
                <button type="button" class="btn btn-success float-left" id="btn-accion-cuenta" style="margin-left: 5px;" onclick="guardarCuenta()">Crear</button>
              </div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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

  $(function () {
    $("#tabla_cuentas").DataTable({
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
                      text:'<i class="fas fa-file-excel"></i><a class="text-secondary"> Excel </a>',
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
                    {
                      text: '<a class="text-light" data-toggle="modal" data-target="#nueva_cuenta"> Agregar </a>',
                      style: 'margin-left:10px',
                      className: 'btn btn-info btn-sm agregar',

                      action: function ( e, dt, node, config ) {
                        
                      }
                    }
                  ],
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });

  /* oculta/muestra inputs de modal agregar cliente */
  $('#tipoPersona').on("change",function(){
    
    /* botones persona fisica */
    if($('#tipoPersona').val() == 'tipos_personasFisica'){
      
      activaBotonesCuentasFisicos();
    }

    /* botones persona moral */
    if($('#tipoPersona').val() == 'tipos_personasMoral'){
      
      activaBotonesCuentasMoral();
    }

  });

  /* avtiva botones para cliente fisico */
  function activaBotonesCuentasFisicos(){
    //debugger
      /* oculta botones */
      ocultaColumna('#frm-nuevaCuenta', '.col_personaMoral');
      
      /* elimina clase requerido */
      remueveRequerido('#frm-nuevaCuenta' ,'.personaMoral');

      /* muestra botones */
      muestraColumna('#frm-nuevaCuenta', '.col_personaFisica');
   
      /* agrega clase requerido */
      agregaRequerido('#frm-nuevaCuenta','.personaFisica');

  }

  /* activa botones para cuenta  moral */
  function activaBotonesCuentasMoral(){
    //debugger
      /* muestra botones */
      muestraColumna('#frm-nuevaCuenta', '.col_personaMoral');

      /* agrega clase requerido */
      agregaRequerido('#frm-nuevaCuenta','.personaMoral');
 
      /* oculta botones */
      ocultaColumna('#frm-nuevaCuenta', '.col_personaFisica')

      /* remueve clase requerido */
      remueveRequerido('#frm-nuevaCuenta','.personaFisica');
  }

  function ocultaColumnasForm(){
    ocultaColumna('#frm-nuevaCuenta', '.col_personaMoral');
    remueveRequerido('#frm-nuevaCuenta' ,'.personaMoral');
    ocultaColumna('#frm-nuevaCuenta', '.col_personaFisica');
    remueveRequerido('#frm-nuevaCuenta' ,'.personaFisica');
  }

  $("#nueva_cuenta").on("hide.bs.modal", function() {
    ocultaColumnasForm();
    $('#btn-accion-cuenta').attr('onclick', 'guardarCuenta()');
    $('#btn-accion-cuenta').html('Crear');
    $('#mdl-title').html('Nueva Cuenta');
    $('#frm-nuevaCuenta').find('.form-control').prop('disabled', false);
    $('#btn-editar').prop('hidden', true);
    $('#btn-cuenta').prop('hidden', true);
    $('#btn-habilitarCuenta').prop('hidden', true);
    $('#nueva_cuenta #empresa_id').prop('hidden', true);
    $('#imagenCuenta').prop('src', '');
    
    $('#btn-accion-cuenta').show();
    $('#frm-nuevaCuenta')[0].reset();
  });

function guardarCuenta(){
  console.log("guardarCuenta");
  var formData = new FormData($('#frm-nuevaCuenta')[0]);
  
  console.log(formData);
  if(!validaForm('#frm-nuevaCuenta')) return;

  if(!rfcValido($('#curp').val()))return;

  $.ajax({
    type:'POST',
    dataType: 'JSON',
    processData: false,
    contentType: false,
    data:formData,
    url: '<?= base_url()?>/guardarCuenta',
    success: function(resp) {
      if(resp.status){
        notificar(notiSuccess);
        $('#nueva_cuenta').modal('hide');
        $('#frm-nuevaCuenta')[0].reset();
        limpiaForm('#nueva_cuenta');
      }else{
        notificar(notiError);
      }
    },
    error: function(result){
      notificar(notiError);
    },
    complete: function() {
      notificar(notiSuccess);
      $('#nueva_cuenta').modal('hide');
      $('#frm-nuevaCuenta')[0].reset();
      limpiaForm('#nueva_cuenta');
      actualizaTablaPersonas();
    }
  });


}

/* Guarda los datos editados de la cuenta */
function editarCuenta(){

  var formData = new FormData($('#frm-nuevoCuenta')[0]);
  console.log(formData);
  let logo = document.getElementById("imagenCuenta").files;
  if(logo.lenght!= 0){
    let imagenFile = $('#imagenCuenta').prop('files')[0]; 
    formData.append("imagen", imagenFile);
  }

  // debugger;
  formData.append("empr_id",$('#frm-nuevoCuenta #empr_id').val());
  //validacion datos del formulario
  if(!validaForm('#frm-nuevoCuenta')) return;


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
      notificar(notiSuccess);
        $('#nuevo_cueenta').modal('hide');
        $('#frm-nuevoCuenta')[0].reset();
        limpiaForm('#nuevo_cuenta');
    },
    error: () => {
      notificar(notiError);
    },
    complete: function() {
      notificar(notiSuccess);
      //actualizarTablaCuenta();
    }
    });
}


function validarForm(){
  var ban=1;
  if(ban){
    /* Datos Generales */
      if($('#nombreCuenta').val() == ''){
         $('#nombreCuenta').addClass('is-invalid');
         ban=0;
      }else{
         $('#nombreCuenta').removeClass('is-invalid');
         $('#nombreCuenta').addClass('is-valid');
      }
    
      if($('#tipoCuenta').val() == null){
         $('#tipoCuenta').addClass('is-invalid');
         ban=0;
      }else{
         $('#tipoCuenta').removeClass('is-invalid');
         $('#tipoCuenta').addClass('is-valid');
      }
    
       if($('#rfcCuenta').val() == ''){
         $('#rfcCuenta').addClass('is-invalid');
         ban=0;
      }else{
         $('#rfcCuenta').removeClass('is-invalid');
         $('#rfcCuenta').addClass('is-valid');  
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
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'Complete los campos obligatorios!',
    });
  }
  return ban; 
}

/* inicializacion botones on/off  de tabla*/
$("[name='habilitarCuentaEditar']").bootstrapSwitch({
  /* habilitar/deshabilitar personas */
  onSwitchChange:function(e, state){
    var tr = $(e.target).closest('tr');
    var json = $(tr).data('json');
    console.log(state);
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
        deshabilitaCuenta(json.empr_id);
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
        habilitaCuenta(json.empr_id);
      }
      else{
        //vuelve a el estado original y el ultimo paramaetro es para cortar la ejecucion
        $(this).bootstrapSwitch('state', !state ,true);
      }
    });
    } 
  }
});

/* inicializacion botones on/off  de tabla*/
$("[name='habilitarCuenta']").bootstrapSwitch({
  /* habilitar/deshabilitar personas */
   onSwitchChange:function(e, state){
    var tr = $(e.target).closest('tr');
    var json = $(tr).data('json');
    console.log(state);
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
        deshabilitaCuenta(json.empr_id);
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
        habilitaCuenta(json.empr_id);
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
  console.log(empr_id);
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
  console.log(empr_id);
  $.get('<?= base_url()?>/habilitarCuenta/' + empr_id, function (data){
          Swal.fire(
            'Habilitado!',
            'La cuenta fue habilitada.',
            'success'
          );
  })
}

function verCuenta(e){
    $('#btn-accion-cuenta').hide();
    $('#mdl-title').html('Cuenta');
    $('#btn-editar').prop('hidden', false);
    $('#btn-clientes').prop('hidden', false);
    $('#btn-habilitarCuenta').prop('hidden', true);
    $('#frm-nuevaCuenta').find('.form-control').prop('disabled', true);
    $('#nueva_cuenta #empresa_id').prop('hidden', false);
    $('#nueva_cuenta').modal('show');

    var tr = $(e).closest('tr');
    var json = $(tr).data('json');
    $('#nueva_cuenta #empr_id').val(json.empr_id);
    $('#nueva_cuenta #empresa_id').text( "(id: " + json.empr_id + ")");
    $('#nueva_cuenta #nombreCuenta').val(json.nombre);
    $('#nueva_cuenta #rfcCuenta').val(json.id_tributario);
    $('#nueva_cuenta #razonSocial').val(json.razon_social);
    $('#nueva_cuenta #representanteLegal').val(json.representante_legal);
    $('#nueva_cuenta #representanteLegal').val(json.representante_legal);
    $('#nueva_cuenta #telefono').val(json.num_telefono);
    $('#nueva_cuenta #correo').val(json.email);
    $('#nueva_cuenta #calle').val(json.calle);
    $('#nueva_cuenta #numeroExterior').val(json.num_exterior);
    $('#nueva_cuenta #numeroInterior').val(json.num_interior);
    $('#nueva_cuenta #tipoPersona').val(json.tipe_id);
    $('#nueva_cuenta #nacionalidad').val(json.ubic_id);
    $('#nueva_cuenta #tipoCuenta').val(json.tiem_id);
    $('#nueva_cuenta #CodigoColonia').val(json.cod_postal);

    if(json.tipe_id == 'tipos_personasMoral'){
      activaBotonesCuentasMoral();
      $('#nueva_cuenta #razonSocial').val(json.razon_social);
      $('#nueva_cuenta #representanteLegal').val(json.representante_legal);
    }

    if(json.tipe_id == 'tipos_personasFisica'){
     activaBotonesCuentasFisicos();
     $('#nueva_cuenta #curp').val(json.id_persona);
     $('#nueva_cuenta #nombres').val(json.nombres);
     $('#nueva_cuenta #apellidos').val(json.apellidos);
     $('#nueva_cuenta #genero').val(json.gene_id);
     $('#nueva_cuenta #fechaNacimiento').val(json.fec_nacimiento.slice(0,10));
     $('#nueva_cuenta #paisNacimiento').val(json.naci_id);
     $('#nueva_cuenta #ocupacion').val(json.ocupacion);
    }


    if(json.nom_imagen){
      var codificacion = obtenerExtension(json.nom_imagen);

      /* decodificacion imagen base64 */
      var decodedData = window.atob(json.imagen);

      /*Accion ojo de imagen */
      document.getElementById('verImagen').onclick = function (){
        event.preventDefault();
        var newTab = window.open();
        newTab.document.body.innerHTML = '<img src="'+ codificacion + decodedData +'" >';
        newTab.document.close();
      }
    
      $('#imagenCuenta').attr('src', codificacion + decodedData);
    }
    else{
      $('#imagenCuenta').attr('src', '');
    }

    /* botones cabecera on/off */
    if(json.eliminado == 'true')
    $("[name='habilitarCuentaEditar']").bootstrapSwitch('state', false ,true);
    else 
    $("[name='habilitarCuentaEditar']").bootstrapSwitch('state', true ,true);
}

/* abrir modal agregar imagen */
$(document).on("click", ".agregaLogo", function() {
  $('#modalAgregarLogo').modal('show');
  event.preventDefault();
  $("#nuevo_cliente").css('overflow-y', 'auto');//habilita el scroll de nuevo
});


function listadoClienteCuenta(e){
  
    $('#list_cuenta_clientes').modal('show');
}

function habilitaEditarCuenta(e){
   console.log("habilitaEditarCuenta");
    $('#btn-habilitarCuenta').prop('hidden', false);
    $('#btn-accion-cuenta').show();
    $('#btn-accion-cuenta').html('Modificar');
    $('#btn-accion-cuenta').attr('onclick', 'editarCuenta()');
    $('#frm-nuevaCuenta').find('.form-control').prop('disabled', false);
    $('#btn-editar').prop('hidden', true);
    $('#btn-clientes').prop('hidden', false);
    $('#btn-clientes').prop('hidden', true);
}

/* Elimina los estilos de los input correctos-incorrectos */
function limpiaForm(formulario){
  $(formulario).find(".is-valid").removeClass().addClass('form-control');
  $(formulario).find(".is-invalid").removeClass().addClass('form-control');
}


</script>



<?= $this->endSection() ?>


