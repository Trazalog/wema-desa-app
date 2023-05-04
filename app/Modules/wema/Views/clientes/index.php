
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
                
                <table id="tabla_clientes" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Acciones</th>
                    <th>Logo</th>
                    <th>Tipo</th>
                    <th>RFC</th>
                    <th>Nombre Comercial</th>
                    <th>Tipo Persona</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                      foreach($listadoClientes as $key => $clientes){
                        /* imagen de perfil */
                        if($clientes->imagen) 
                        {
                          $src = imagePerfil($clientes->imagen, $clientes->nom_imagen); $class = "img-circle elevation-2"; $style = "height: 3rem; width: 3.9rem";
                        }
                        else{ 
                          $src = ""; $class = ""; $style = "";  
                        }

                        (strcmp($clientes->eliminado, 'true') == 0) ? $check= '' : $check = 'checked';

                        echo '<tr data-json=\''.json_encode($clientes).'\'>';
                        echo'<td>
                                <div class="btn-group"> 
                                  <i class="fa fa-search" style="cursor: pointer;margin: 3px;" title="Ver Detalles" onclick="verCliente(this)"></i>
                                  <i class="fa fa-users" style="cursor: pointer;margin: 3px;" title="Ver personas" ></i>
                                  <label class="switch" id="miLabel">
                                  <div class="bootstrap-switch-container float-right" style="width: 10px; margin-left: 24px;" >
                                    <input type="checkbox" name="habilitarCliente" data-bootstrap-switch '.$check.'>
                                  </div>
                                  </label>
                                </div>
                              </td>
                              <td style="text-align: center"><img src="'. $src .'" class="'.$class.'" style="'.$style.'"/></td>
                              <td>'.$clientes->tipoCliente.'</td>
                              <td>'.$clientes->rfc.'</td>
                              <td>'.$clientes->nombre.'</td>
                              <td>'.$clientes->tipoPersona.'</td>
                      </tr>
                      ';
                      }
                    ?>
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
                    <input type="checkbox" name="habilitarClienteEditar" data-bootstrap-switch-editar checked onclick="habilitarClienteEditar()">   
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
              <input id="clie_id" name="clie_id" type="text" hidden>
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
                                          <input type="text" class="form-control requerido" id="nombreComercial" name="nombreComercial">
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
                                          <img id="logoCliente" class="profile-user-img img-fluid img-circle" style="height: 100px; width: 100px" >
                                          <button class="btn btn-sm" >
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
                                          <input type="text" class="form-control requerido" id="rfc" name="rfc">
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
                                          </div><input type="text" class="form-control requerido" name="correo" id="correo" >
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
    $("#tabla_clientes").DataTable({
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
                    }
                  ],
    })
  });

 /* Abre modal nuevo cliente y habilita/deshabilita botones*/
  $("#nuevo_cliente").on("hide.bs.modal", function() {
    ocultaColumnasForm();
    $('#btn-accion').attr('onclick', 'guardarCliente()');
    $('#btn-accion').html('Crear');
    $('#mdl-title').html('Nuevo Cliente');
    $('#frm-nuevoCliente').find('.form-control').prop('disabled', false);
    $('#nuevo_cliente #cliente_id').prop('hidden', true);
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
      /* oculta botones */
      ocultaColumna('#frm-nuevoCliente', '.col_personaMoral');
      
      /* elimina clase requerido */
      remueveRequerido('#frm-nuevoCliente' ,'.personaMoral');

      /* muestra botones */
      muestraColumna('#frm-nuevoCliente', '.col_personaFisica');
   
      /* agrega clase requerido */
      agregaRequerido('#frm-nuevoCliente','.personaFisica');

  }

  /* activa botones para cliente moral */
  function activaBotonesClientesMoral(){
      /* muestra botones */
      muestraColumna('#frm-nuevoCliente', '.col_personaMoral');

      /* agrega clase requerido */
      agregaRequerido('#frm-nuevoCliente','.personaMoral');
 
      /* oculta botones */
      ocultaColumna('#frm-nuevoCliente', '.col_personaFisica')

      /* remueve clase requerido */
      remueveRequerido('#frm-nuevoCliente','.personaFisica');
  }

  function ocultaColumnasForm(){
    ocultaColumna('#frm-nuevoCliente', '.col_personaMoral');
    remueveRequerido('#frm-nuevoCliente' ,'.personaMoral');
    ocultaColumna('#frm-nuevoCliente', '.col_personaFisica');
    remueveRequerido('#frm-nuevoCliente' ,'.personaFisica');
  }

/* Guarda modal de Clientes */
function guardarCliente(){
  var formData = new FormData($('#frm-nuevoCliente')[0]);

  let logo = document.getElementById("inputLogo").files;
  if(logo.lenght!= 0){
    let imagenFile = $('#inputLogo').prop('files')[0]; 
    formData.append("imagen", imagenFile);
  }

  //validacion datos del formulario
  if(!validaForm('#frm-nuevoCliente')) return;

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
        limpiaForm('#nuevo_cliente');
      }else{
        notificar(notiError);
      }
    },
    error: function(result){
      notificar(notiError);
    },
    complete: function(result){
      notificar(notiSuccess);
      $('#nuevo_cliente').modal('hide');
      $('#frm-nuevoCliente')[0].reset();
      limpiaForm('#nuevo_cliente');
      actualizarTablaCliente();
    }
  });
}


/* Permite ver los datos de cada persona */
function verCliente(e){

    var tr = $(e).closest('tr');
    var json = $(tr).data('json'); 

    $('#btn-accion').hide();
    $('#mdl-title').html('Cliente');
    $('#frm-nuevoCliente').find('.form-control').prop('disabled', true);
    $('#btn-editar').prop('hidden', false);
    $('#btn-personas').prop('hidden', false);
    $('#btn-organigrama').prop('hidden', false);
    $('#btn-cuestionario').prop('hidden', false); 
    $('#nuevo_cliente #cliente_id').prop('hidden', false);

    /* datos generales */
    $('#nuevo_cliente #clie_id').val(json.clie_id);
    $('#nuevo_cliente #cliente_id').text( "(id: " + json.clie_id + ")");
    $('#nuevo_cliente #nombreComercial').val(json.nombre);
    $('#nuevo_cliente #tipoCliente').val(json.ticl_id);
    $('#nuevo_cliente #rfc').val(json.rfc);
    $('#nuevo_cliente #nacionalidad').val(json.naci_id);
    $('#nuevo_cliente #tipoPersona').val(json.tipe_id);

    /* datos contacto */
    $('#nuevo_cliente #telefono').val(json.telefono);
    $('#nuevo_cliente #correo').val(json.email);
    $('#nuevo_cliente #calle').val(json.calle);
    $('#nuevo_cliente #numeroExterior').val(json.num_exterior);
    $('#nuevo_cliente #numeroInterior').val(json.num_interior);
    $('#nuevo_cliente #CodigoColonia').val(json.cod_postal);


    if(json.tipe_id == 'tipos_personasMoral'){
      activaBotonesClientesMoral();
      $('#nuevo_cliente #razonSocial').val(json.razon_social);
      $('#nuevo_cliente #representanteLegal').val(json.representante_legal);
    }

    if(json.tipe_id == 'tipos_personasFisica'){
     activaBotonesClientesFisicos();
     $('#nuevo_cliente #curp').val(json.curp);
     $('#nuevo_cliente #nombres').val(json.nombres);
     $('#nuevo_cliente #apellidos').val(json.apellidos);
     $('#nuevo_cliente #genero').val(json.gene_id);
     $('#nuevo_cliente #fechaNacimiento').val(json.fec_nacimiento.slice(0,10));
     $('#nuevo_cliente #paisNacimiento').val(json.pana_id);
     $('#nuevo_cliente #ocupacion').val(json.ocupacion);
    }

    $('#nuevo_cliente').modal('show');
    $('#btn-habilitarPersona').prop('hidden', true); 


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
    
      $('#logoCliente').attr('src', codificacion + decodedData);
    }
    else{
      $('#logoCliente').attr('src', '');
    }

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

  var formData = new FormData($('#frm-nuevoCliente')[0]);

  let logo = document.getElementById("inputLogo").files;
  if(logo.lenght!= 0){
    let imagenFile = $('#inputLogo').prop('files')[0]; 
    formData.append("imagen", imagenFile);
  }

 // debugger;
  formData.append("clie_id",$('#frm-nuevoCliente #clie_id').val());
  //validacion datos del formulario
  if(!validaForm('#frm-nuevoCliente')) return;

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
        $('#frm-nuevoCliente')[0].reset();
        limpiaForm('#nuevo_cliente');
    },
    error: () => {
      notificar(notiError);
    },
    complete: function() {
      notificar(notiSuccess);
      actualizarTablaCliente();
    }
    });
}

/* inicializacion botones on/off */
$("[name='habilitarCliente']").bootstrapSwitch({
  onSwitchChange:function(e, state){
  var tr = $(e.target).closest('tr');
  var json = $(tr).data('json');

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
      deshabilitaCliente(json.clie_id);
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
      habilitaCliente(json.clie_id);
    }
    else{
      //vuelve a el estado original y el ultimo paramaetro es para cortar la ejecucion
      $(this).bootstrapSwitch('state', !state ,true);
    }
  });
  } 
}
});

$("[name='habilitarClienteEditar']").bootstrapSwitch();


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
  $("#nuevo_cliente").css('overflow-y', 'auto');//habilita el scroll de nuevo
});


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
 
/* Actualiza la tabla sin recargar */
function actualizarTablaCliente(){
  $.ajax({
        type: 'POST',
        cache: false,
        dataType: "json",
        url: "<?= base_url()?>/getClientes",
  success:function(data){

    tabla = $('#tabla_clientes').DataTable();
    tabla.clear().draw();

    $.each(data, function (i, value) {

    //activar o desactivar checked
    if(value.eliminado == 'true'){
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
            '<i class="fa fa-search" style="cursor: pointer;margin: 3px;" title="Ver Detalles" onclick="verCliente(this)"></i>'+
            '<i class="fa fa-users" style="cursor: pointer;margin: 3px;" title="Ver personas" ></i>' +
             '<label class="switch" id="miLabel">'+
             '<div class="bootstrap-switch-container float-right" style="width: 15px; margin-left: 24px;" >'+
               '<input type="checkbox" name="habilitarCliente" data-bootstrap-switch '+ check +'>'+
             '</div>'+
             '</label>'+
            '</div>'+
          '</td>'+
            
          '<td class="centrar"><img src="'+ src +'" class="'+clase+'" style="'+estilo+'"/></td>'+

          '<td>'+ value.tipoCliente +'</td>'+
          '<td>'+ value.rfc +'</td>'+
          '<td>'+ value.nombre +'</td>'+
          '<td>'+ value.tipoPersona +'</td>'+
          '</tr>';
          tabla.row.add($(fila)).draw();
    });
         /* inicializacion botones on/off */
      $("[name='habilitarCliente']").bootstrapSwitch({
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
            debugger;
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
  
      
  }   
  });
}
</script>

<?= $this->endSection() ?>





