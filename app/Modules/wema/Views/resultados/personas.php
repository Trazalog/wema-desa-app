
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
			        <li class="completed" ><a><?= isset($listadoPersonas[0]->nombreEmpresa) ? $listadoPersonas[0]->nombreEmpresa : 'Cuenta' ?></a></li>
			        <li class="active"><a><?= isset($listadoPersonas[0]->nombreCliente) ? $listadoPersonas[0]->nombreCliente : 'Cliente' ?></a></li>
		        </ul> 
        
          </div>
           <div class="col-sm-3"></div> 
          <div class="col-sm-2">
          <a class="btn btn-outline-primary btn-block btn-sm" type="button" onclick="modalCliente(<?= (isset($clie_id)) ? $clie_id : '' ?>)" ><i class="fa fa-info float-left"></i> Información del Cliente</a>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1>Resultados: Lista de Personas</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
      <div class="row">
          <div class="col-12">
            <div class="card card-light card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Lista de Personas</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Organigrama</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Áreas</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                    <table id="tabla_personas" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Acciones</th>
                          <th>Imagen</th>
                          <th>CURP</th>
                          <th>Apellidos</th>
                          <th>Nombres</th>
                          <th>Área</th>
                          <th>Puesto</th>
                          <th>Resultado</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          foreach ($listadoPersonas as $key => $persona) {
                            /* imagen de perfil */
                            if($persona->imagen) {
                              $src = imagePerfil($persona->imagen, $persona->nom_imagen); $class = "img-circle elevation-2"; $style = "height: 3rem; width: 3.9rem";
                            }else{ 
                              $src = ""; $class = ""; $style = "";
                            }
                            (strcmp($persona->estado, 'true') == 0) ? $check= 'filaEliminada' : $check = '';
                              echo '<tr class="centrar '.$check.'" data-json=\''.json_encode($persona).'\'>';
                              echo  '<td>
                                      <div class="btn-group"> 
                                        <i class="fa fa-search" style="cursor: pointer;margin: 3px;" title="Ver Detalles" onclick="verPersona(this)"></i>
                                      </div>
                                    </td>
                                    <td class="centrar"><img src="'. $src .'" class="'.$class.'" style="'.$style.'"/></td>
                                    <td>'.$persona->curp.'</td>
                                    <td>'.$persona->apellidos.'</td>
                                    <td>'.$persona->nombres.'</td>
                                    <td>'.(!empty($persona->area) ? $persona->area : '').'</td>
                                    <td>'.(!empty($persona->puesto) ? $persona->puesto : '').'</td>
                                    <td>'.(!empty($persona->resultado) ? $persona->resultado : '').'</td>
                                  </tr>';
                            }?>
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                    <div class="modal-body">
                      <div id="tree"></div>
                    </div>   
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                    <!-- Main content -->
                    <section class="content">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-md-6">
                            
                            
                              <!-- BAR CHART -->
                              <div class="card card-light">
                                <div class="card-header">
                                  <h3 class="card-title">Administración</h3>
                                </div>
                                <div class="card-body">
                                  <div class="chart">
                                    <canvas id="barChart1" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                  </div>
                                </div>
                                <!-- /.card-body -->
                              </div>
                              <!-- /.card -->

                            <!-- BAR CHART -->
                            <!--<div class="card card-light">
                              <div class="card-header">
                                <h3 class="card-title">Producción</h3>
                              </div>
                              <div class="card-body">
                                <div class="chart">
                                  <canvas id="barChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                              </div>-->
                              <!-- /.card-body -->
                            <!--</div>-->
                            <!-- /.card -->

                          </div>
        
                          <div class="col-md-6">

                            <!-- BAR CHART -->
                            <div class="card card-light">
                              <div class="card-header">
                                <h3 class="card-title">RRHH</h3>
                              </div>
                              <div class="card-body">
                                <div class="chart">
                                  <canvas id="barChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                              </div>
                              <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                            <!-- BAR CHART -->
                            <!--<div class="card card-light">
                              <div class="card-header">
                                <h3 class="card-title">Finanzas</h3>                                
                              </div>
                              <div class="card-body">
                                <div class="chart">
                                  <canvas id="barChart4" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>-->
                              <!--</div>-->
                              <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                          </div>
                          <!-- /.col (RIGHT) -->
                        </div>
                        <!-- /.row -->
                      </div><!-- /.container-fluid -->
                    </section>
                    <!-- /.content -->                  
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>  
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
                    
                    <input type="checkbox" name="habilitarPersonaEditar" data-bootstrap-switch-editar checked>
                    
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
              <input id="pers_id" name="pers_id" type="text" hidden>
              <!-- clie_id = 1 es harkodeo -->
              <input id="clie_id" name="clie_id" type="text" value="<?= (isset($clie_id)) ? $clie_id : '1' ?>" hidden>
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
                                            <i id="verImagen" class="fas fa-eye"></i>
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
                                        <input type="text" class="form-control requerido" id="CodigoColonia" name="CodigoColonia" style="width :88%">
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


<!-- Modal Agregar imagen Perfil -->
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
                    }
                  ],
    });

    //---------------
    //- ORGANIGRAMA -
    //---------------
    var  nodos = {};
    var nodes = selects = clientes = options = chart=[];
    delete nodos;

    var clie_id = <?php echo $clie_id; ?>;
    nodos = <?php echo $Cliente[0]->orgb ?>
    //clientes = <?php //echo json_encode($listadoClientes); ?>;
    selects = <?php echo json_encode($listadoPersonas); ?>; 
    console.log(clie_id);
    console.log("Organigrama: "+JSON.stringify(nodos));

    if(nodos.length === 0){

      Swal.fire({
        title: 'Deinición Organigrama',
        text: 'El cliente aun no tiene organigrama asociado/definido',
        icon: 'warning',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar'
      }).then((result) => {
        if (result.isConfirmed) {
        
        }    
      });

    }else{
    
      delete nodes;   
      nodes = JSON.parse(JSON.stringify(nodos)); 
      console.log("nodes: "+ nodes);

      for(var i = 0; i < selects.length; i++){ //Valida que el usuario no este asignado
          var select = selects[i];
          sw = false;
          if(select.clie_id == clie_id){ //Verificamos que sea de la misma empresa
            for(var j = 0; j < nodes.length; j++){
              var node = nodes[j];
              if(node.pers_id){
                if(node.pers_id == select.pers_id){
                  sw = true;
                  break;
                }else{
                  sw = false;
                }                 
              }
              if(!sw){
                var option = {id: select.pers_id, value : select.nombres+" "+select.apellidos+" - [ID:"+select.pers_id+"]", text : select.nombres.toUpperCase()+" "+select.apellidos.toUpperCase()+" - [ID:"+select.pers_id+"]"};
                options.push(option);
                break;
              }   
            }
          }      
        }    

        op_default= {id: -1, disabled: 'true', value : "Seleccione..." , text : "Seleccione..."};
        options.unshift(op_default);
        console.log("Options: "+options.length+"Options Pricipal: "+JSON.stringify(options));

        for (var i = 0; i < nodes.length; i++) {
            var node = nodes[i];
            switch (node.title) {
                case "Administrador":
                    console.log("Administrador");
                    node.tags = ["yellow"];
                    break;
            }
        }

        if(options.length === 0){
          Swal.fire({
            title: 'Clientes Empresa',
            text: 'Esta empresa no tiene ningún empleado asociado',
            icon: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar'
          }).then((result) => {
            if (result.isConfirmed) {
          
            }    
          });
        }else{

          OrgChart.templates.ana.plus = '<circle cx="15" cy="15" r="15" fill="#ffffff" stroke="#aeaeae" stroke-width="1"></circle>'
          + '<text text-anchor="middle" style="font-size: 18px;cursor:pointer;" fill="#757575" x="15" y="22">{collapsed-children-count}</text>';

          var webcallMeIcon = '<svg width="24" height="24" viewBox="0 0 300 400"><g transform="matrix(1,0,0,1,40,40)"><path fill="#5DB1FF" d="M260.423,0H77.431c-5.522,0-10,4.477-10,10v317.854c0,5.522,4.478,10,10,10h182.992c5.522,0,10-4.478,10-10V10 C270.423,4.477,265.945,0,260.423,0z M178.927,302.594c0,5.522-4.478,10-10,10c-5.523,0-10-4.478-10-10v-3.364h20V302.594z M250.423,279.229H87.431V58.624h162.992V279.229z" /><path fill="#5DB1FF" d="M118.5,229.156c4.042,4.044,9.415,6.271,15.132,6.271c5.715,0,11.089-2.227,15.133-6.269l29.664-29.662 c4.09-4.093,6.162-9.442,6.24-14.816c5.601-0.078,10.857-2.283,14.829-6.253l29.66-29.662c4.042-4.043,6.269-9.417,6.269-15.133 c0-5.716-2.227-11.09-6.269-15.13l-9.806-9.806c-4.041-4.043-9.415-6.27-15.132-6.27c-5.716,0-11.09,2.227-15.132,6.269 l-29.663,29.662c-4.092,4.092-6.164,9.443-6.242,14.817c-5.601,0.078-10.857,2.283-14.828,6.252l-29.661,29.662 c-4.042,4.043-6.269,9.418-6.268,15.136c0,5.716,2.227,11.089,6.269,15.129L118.5,229.156z M168.618,147.548l29.662-29.661 c1.587-1.587,3.696-2.461,5.94-2.461c2.243,0,4.353,0.874,5.938,2.461l9.808,9.808c1.586,1.586,2.46,3.694,2.46,5.937 c0,2.244-0.874,4.354-2.462,5.941l-29.658,29.661c-1.588,1.587-3.697,2.46-5.941,2.46c-2.243,0-4.353-0.874-5.938-2.46 l-0.309-0.309l19.598-19.598c2.539-2.539,2.539-6.654,0-9.192c-2.537-2.538-6.654-2.538-9.191,0l-19.599,19.598l-0.308-0.308 C165.344,156.152,165.345,150.823,168.618,147.548z M117.888,198.28l29.66-29.661c1.587-1.586,3.695-2.46,5.939-2.46 c2.242,0,4.349,0.872,5.934,2.455c0.002,0.001,0.004,0.003,0.005,0.005l0.309,0.309l-19.598,19.598 c-2.539,2.538-2.539,6.653,0,9.191c1.269,1.27,2.933,1.904,4.596,1.904s3.327-0.635,4.596-1.904l19.599-19.598l0.309,0.309 c3.273,3.273,3.273,8.603,0,11.877l-29.662,29.66c-1.588,1.588-3.698,2.462-5.941,2.462c-2.243,0-4.352-0.874-5.938-2.462 l-9.807-9.806c-1.586-1.586-2.46-3.694-2.46-5.938C115.426,201.978,116.3,199.868,117.888,198.28z" /></g></svg>';

          OrgChart.templates.itTemplate = Object.assign({}, OrgChart.templates.ana);
          OrgChart.templates.itTemplate.nodeMenuButton = "";
          OrgChart.templates.itTemplate.nodeCircleMenuButton = {
              radius: 18,
              x: 250,
              y: 60,
              color: '#fff',
              stroke: '#aeaeae'
          };

          OrgChart.templates.invisibleGroup.padding = [20, 0, 0, 0];

          OrgChart.SEARCH_PLACEHOLDER = "Busqueda"; // the default value is "Search"

          chart = new OrgChart(document.getElementById("tree"), {
              mouseScrool: OrgChart.action.ctrlZoom,
              template: "ana",
              enableDragDrop: true,
              nodeMouseClick: false,
              enableSearch: false,
              /*menu: {
                  pdfPreview: {
                      text: "Export to PDF",
                      icon: OrgChart.icon.pdf(24, 24, '#7A7A7A'),
                      onClick: preview
                  },
                  csv: { text: "Save as CSV" }
              },*/
              nodeBinding: {
                      field_0: "name",
                      field_1: "title",
                      img_0: "img"
              },  
              editForm: {
                generateElementsFromFields: true,            
                addMore: null,
                addMoreBtn: null,
                addMoreFieldName: null,
                titleBinding: 'name',
                cancelBtn: 'Cancelar',
                saveAndCloseBtn: 'Asignar',
                buttons:  {
                  /*edit: {
                    icon: OrgChart.icon.edit(24,24,'#fff'),
                    text: 'Editar',
                    hideIfEditMode: true,
                    hideIfDetailsMode: false
                  },*/
                  share: {
                    icon: OrgChart.icon.share(24,24,'#fff'),
                    text: 'Compartir'
                  },
                  pdf: {
                    icon: OrgChart.icon.pdf(24,24,'#fff'),
                    text: 'PDF'
                  },
                  remove: {
                    icon: OrgChart.icon.remove(24,24,'#fff'),
                    text: 'Eliminar',
                    hideIfDetailsMode: true
                  }
                },
                elements: [
                  { type: 'select', options: options, label: 'Nombres', binding: 'name'},
                  { type: 'textbox', label: 'Puesto', binding: 'title'},  
                  { type: 'textbox', label: 'Id', binding: 'pers_id', readOnly: true},  
                  { type: 'textbox', label: 'Url Imagen', binding: 'img', btn: 'Upload' },            
                ]
              },
              nodeMenu: {
                details: { 
                  text: "Info. Persona" ,
                  //onClick: detalleNodo
                },
                /*edit: { 
                  text: "Editar",
                  onClick: editarNodo
                }*/
                call: {
                      icon: webcallMeIcon,
                      text: "Ver resultados",
                      onClick: callHandler
                  }
                /*add: { 
                  text: "Agregar",
                  //onClick: agregarNodo
                },*/
                /*remove: { 
                  text: "Eliminar" 
                }*/
              },        
              align: OrgChart.ORIENTATION,
              toolbar: {
                  fullScreen: true,
                  zoom: true,
                  fit: true,
                  expandAll: true
              },
              nodeBinding: {
                  field_0: "name",
                  field_1: "title",
                  img_0: "img"
              },
              tags: {
                  "top-management": {
                      template: "invisibleGroup",
                      subTreeConfig: {
                          orientation: OrgChart.orientation.bottom,
                          collapse: {
                              level: 1
                          }
                      }
                  },
                  "it-team": {
                      subTreeConfig: {
                          layout: OrgChart.mixed,
                          collapse: {
                              level: 1
                          }
                      },
                  },
                  "hr-team": {
                      subTreeConfig: {
                          layout: OrgChart.treeRightOffset,
                          collapse: {
                              level: 1
                          }
                      },
                  },
                  "sales-team": {
                      subTreeConfig: {
                          layout: OrgChart.treeLeftOffset,
                          collapse: {
                              level: 1
                          }
                      },
                  },
                  "ceo-menu": {
                      nodeMenu: {
                          //addSharholder: { text: "Add new sharholder", icon: OrgChart.icon.add(24, 24, "#7A7A7A"), onClick: addSharholder },
                          //addDepartment: { text: "Nueva Area", icon: OrgChart.icon.add(24, 24, "#7A7A7A"), onClick: addArea },
                          //addAssistant: { text: "Add new assitsant", icon: OrgChart.icon.add(24, 24, "#7A7A7A"), onClick: addAssistant },
                          //edit: { text: "Info. Persona" },
                          details: { text: "Info. Persona" },
                          call: {
                              icon: webcallMeIcon,
                              text: "Ver resultados",
                              onClick: callHandler
                          }                          
                      }
                  },
                  "area": {
                      template: "group",
                      nodeMenu: {
                          //addManager: { text: "Nuevo Manager", icon: OrgChart.icon.add(24, 24, "#7A7A7A"), onClick: addManager },
                          //remove: { text: "Eliminar Area" },
                          //edit: { text: "Editar Area" },
                          //nodePdfPreview: { text: "Export department to PDF", icon: OrgChart.icon.pdf(24, 24, "#7A7A7A"), onClick: nodePdfPreview }
                      }
                  }
              },
              clinks: [
                  { from: 11, to: 18 }
              ],
              nodes:nodes
          });

          /*
          Agrega nodo nuevo en blanco.
          */ 
          function agregarNodo(nodeId){

            var node = chart.get(nodeId);      
            //console.log("node: "+ JSON.stringify(node));      
            var data = { pers_id : "", id: ((nodes.length*1)+1), pid: node.id, name: "", title:"", email:"", img: ""};
            chart.addNode(data); //Agrega al tree
            console.log("data: "+ JSON.stringify(data));
            console.log("nodes new: "+ JSON.stringify(nodes));
            if (data.length == 0) {
                this.style.display = "none";
            }
          } 

          function callHandler(nodeId) {
            var nodeData = chart.get(nodeId);
            var employeeName = nodeData["name"];
            window.open('https://webcall.me/' + employeeName, employeeName, 'width=340px, height=670px, top=50px, left=50px');
          }

          chart.nodeCircleMenuUI.on('drop', function (sender, args) {
            chart.addClink(args.from, args.to).draw(OrgChart.action.update);
          });

            chart.on("added", function (sender, id) {
              sender.editUI.show(id);
            });

            chart.on('drop', function (sender, draggedNodeId, droppedNodeId) {
              var draggedNode = sender.getNode(draggedNodeId);
              var droppedNode = sender.getNode(droppedNodeId);

              if (droppedNode.tags.indexOf("area") != -1 && draggedNode.tags.indexOf("area") == -1) {
                  var draggedNodeData = sender.get(draggedNode.id);
                  draggedNodeData.pid = null;
                  draggedNodeData.stpid = droppedNode.id;
                  sender.updateNode(draggedNodeData);
                  return false;
              }
            });


            chart.on('exportstart', function (sender, args) {
              args.styles = document.getElementById('myStyles').outerHTML;
            });

            function preview() {
              OrgChart.pdfPrevUI.show(chart, {
                  format: 'A4'
              });
            }

            function nodePdfPreview(nodeId) {
              OrgChart.pdfPrevUI.show(chart, {
                  format: 'A4',
                  nodeId: nodeId
              });
            }

            function addArea(nodeId) {
              var node = chart.getNode(nodeId);
              var data = { id: OrgChart.randomId(), pid: node.stParent.id, tags: ["area"] };
              chart.addNode(data);
            }

            function addManager(nodeId) {
              chart.addNode({ id: OrgChart.randomId(), stpid: nodeId });
            }

            function editarNodo(nodeId){

            console.log("---Editar nodo---");
            var node = chart.get(nodeId);
            console.log("node: "+ JSON.stringify(node)); 
            console.log("Options Editar: "+JSON.stringify(options));        
            chart.editUI.show(nodeId);    

            chart.draw();
            console.log(chart);
            console.log(chart.config.nodes);

            $('#modalOrganigrama #treeOrg').val('');
            $('#modalOrganigrama #treeOrg').val(JSON.stringify(chart.config.nodes));
            console.log(nodes);

            }      

            $('#treeOrg').val('');//Limpiamos para que reciba el nodes actualizados
            $('#modalOrganigrama #treeOrg').val(JSON.stringify(nodes));
        
        }  
      }


      //-------------
      //- BAR CHART -
      //-------------
      var areaChartData1 = {
        labels  : ['Porcentajes (%)'],
        datasets: [
          {
            label               : 'Desempeño',
            backgroundColor     : 'rgba(60,141,188,0.9)',
            borderColor         : 'rgba(60,141,188,0.8)',
            pointRadius          : false,
            pointColor          : '#3b8bba',
            pointStrokeColor    : 'rgba(60,141,188,1)',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data                : [34]
          },
          {
            label               : 'Areas de Oportunidad',
            backgroundColor     : 'rgba(210, 214, 222, 1)',
            borderColor         : 'rgba(210, 214, 222, 1)',
            pointRadius         : false,
            pointColor          : 'rgba(210, 214, 222, 1)',
            pointStrokeColor    : '#c1c7d1',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data                : [65]
          },
        ]
      }

      var barChartCanvas1 = $('#barChart1').get(0).getContext('2d')
      var barChartData1 = $.extend(true, {}, areaChartData1)
      var temp0 = areaChartData1.datasets[0]
      var temp1 = areaChartData1.datasets[1]
      barChartData1.datasets[0] = temp1
      barChartData1.datasets[1] = temp0

      var barChartOptions1 = {
        responsive              : true,
        maintainAspectRatio     : false,
        datasetFill             : false
      }

      new Chart(barChartCanvas1, {
        type: 'bar',
        data: barChartData1,
        options: barChartOptions1
      });

      var areaChartData2 = {
        labels  : ['Porcentajes (%)'],
        datasets: [
          {
            label               : 'Desempeño',
            backgroundColor     : 'rgba(60,141,188,0.9)',
            borderColor         : 'rgba(60,141,188,0.8)',
            pointRadius          : false,
            pointColor          : '#3b8bba',
            pointStrokeColor    : 'rgba(60,141,188,1)',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data                : [76]
          },
          {
            label               : 'Areas de Oportunidad',
            backgroundColor     : 'rgba(210, 214, 222, 1)',
            borderColor         : 'rgba(210, 214, 222, 1)',
            pointRadius         : false,
            pointColor          : 'rgba(210, 214, 222, 1)',
            pointStrokeColor    : '#c1c7d1',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data                : [29]
          },
        ]
      }

      var barChartCanvas2 = $('#barChart2').get(0).getContext('2d')
      var barChartData2 = $.extend(true, {}, areaChartData2)
      var temp0 = areaChartData2.datasets[0]
      var temp1 = areaChartData2.datasets[1]
      barChartData2.datasets[0] = temp1
      barChartData2.datasets[1] = temp0

      var barChartOptions2 = {
        responsive              : true,
        maintainAspectRatio     : false,
        datasetFill             : false
      }

      new Chart(barChartCanvas2, {
        type: 'bar',
        data: barChartData2,
        options: barChartOptions2
      });


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
    $("#imagenUsuario").removeAttr("src","");
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
    },
    complete: function() {
      notificar(notiSuccess);
      $('#nueva_persona').modal('hide');
      $('#frm-nuevaPersona')[0].reset();
      limpiaForm('#nueva_persona');
      actualizaTablaPersonas();
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

      /*Accion ojo de imagen */
      document.getElementById('verImagen').onclick = function (){
        event.preventDefault();
        var newTab = window.open();
        newTab.document.body.innerHTML = '<img src="'+ codificacion + decodedData +'" >';
        newTab.document.close();
      }
    
      $('#imagenUsuario').attr('src', codificacion + decodedData);
    }
    else{
      $('#imagenUsuario').attr('src', '');
    }

    /* botones cabecera on/off */
    if(json.estado == 'true')
    $("[name='habilitarPersonaEditar']").bootstrapSwitch('state', false ,true);
    else 
    $("[name='habilitarPersonaEditar']").bootstrapSwitch('state', true ,true);
   
}



/* inicializacion botones on/off */
 $("[name='habilitarPersonaEditar']").bootstrapSwitch({
/* habilitar/deshabilitar personas desde modal editar persona*/
 onSwitchChange:function(e, state){
  var pers_id = $('#pers_id').val();
  if(!state){
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
      debugger;
      deshabilitaPersona(pers_id);
    }
    else{
      //vuelve a el estado original y el ultimo paramaetro es para cortar la ejecucion
      $(this).bootstrapSwitch('state', !state ,true);
    }
    })
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
      habilitaPersona(pers_id);
    }
    else{
      //vuelve a el estado original y el ultimo paramaetro es para cortar la ejecucion
      $(this).bootstrapSwitch('state', !state ,true);
    }
  });
  } 
}
});

   
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
    }
    });
}

/* inicializacion botones on/off  de tabla*/
$("[name='habilitarPersona']").bootstrapSwitch({
  /* habilitar/deshabilitar personas */
   onSwitchChange:function(e, state){
    var tr = $(e.target).closest('tr');
    var json = $(tr).data('json');
    if(!state){
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
        deshabilitaPersona(json.pers_id);
      }
      else{
        //vuelve a el estado original y el ultimo paramaetro es para cortar la ejecucion
        $(this).bootstrapSwitch('state', !state ,true);
      }
      })
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
        habilitaPersona(json.pers_id);
      }
      else{
        //vuelve a el estado original y el ultimo paramaetro es para cortar la ejecucion
        $(this).bootstrapSwitch('state', !state ,true);
      }
    });
    } 
  }
});

/* abrir modal agregar imagen */
$(document).on("click", ".agregaImagen", function() {
  $('#modalAgregarImagen').modal('show');
  event.preventDefault();
  $("#nueva_persona").css('overflow-y', 'auto');//habilita el scroll de nuevo
});

/* funcion para deshabilitar una persona */
function deshabilitaPersona(pers_id){
  debugger;
  $.get('<?= base_url()?>/eliminarPersona/' + pers_id, function (data){
          Swal.fire(
              'Deshabilitado!',
              'El usuario fue deshabilitado.',
              'success'
        );
  })
}

/* funcion para habilitar una persona */
function habilitaPersona(pers_id){
  $.get('<?= base_url()?>/habilitarPersona/' + pers_id, function (data){
          Swal.fire(
            'Habilitado!',
            'El usuario fue habilitado.',
            'success'
          );
  })
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


 
/* actualiza tabla personas */
function actualizaTablaPersonas(){
  clie_id ="<?= isset($clie_id) ? $clie_id : '1'  ?>";
  $.ajax({
        type: 'POST',
        cache: false,
        dataType: "json",
        url: "<?= base_url()?>/personasCliente/" + clie_id,
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
               '<input type="checkbox" name="habilitarPersona" data-bootstrap-switch '+ check +'>'+
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
        
    /* inicializacion botones on/off */
      $("[name='habilitarPersona']").bootstrapSwitch({
      
      /* habilitacion/deshabilitacion de personas */
       onSwitchChange:function(e, state){
        var tr = $(e.target).closest('tr');
        var json = $(tr).data('json');
        if(!state){
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
            deshabilitaPersona(json.pers_id);
          }
          else{
            //vuelve a el estado original y el ultimo paramaetro es para cortar la ejecucion
            $(this).bootstrapSwitch('state', !state ,true);
          }
          })
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
            habilitaPersona(json.pers_id);
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

function modalCliente(clie_id){
//debugger;
/* harcodeo para poder acceder desde navegacion */
  if(clie_id == undefined){
    var clie_id = '7';
  }

  $.get('<?= base_url()?>/modalCliente/' + clie_id, function (data){
    $("#contenidoModal").html(data);
    $('#modalGenerico').modal('show');
  });
}


/* buscador codigo postal/colonia  */
$('#CodigoColonia').select2({
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
                        id: obj.tabl_id,
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
      "<div class='select2-result-repository__meta'>" +
          "<div class='select2-result-repository__title'></div>" +
          "<div class='select2-result-repository__description'></div>" +
      "</div>" +
      "</div>"
  );

  $container.find(".select2-result-repository__title").text(ubicacion.id);
  $container.find(".select2-result-repository__description").text(ubicacion.text);

  return $container;
  },
  templateSelection: function (ubicacion) {
    return ubicacion.id || ubicacion.text;
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

<?= $this->endSection() ?>


