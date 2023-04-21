
<?php $this->extend('templates/admin_template') ?>

<?= $this->section('content') ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2"> 
          <div class="col-sm-7">
            <div class="card">
              <div class="card-body">
                <nav style=" font-size:30px" aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a>CONFIANZA Y TECNOLOGIA</a></li>
                    <li class="breadcrumb-item active" aria-current="page">BIMBO S.A de C.V</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
          <!-- 
          <div class="col-sm-4">
          <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <div class="callout callout-info btn-outline-primary">
              <h5>CONFIANZA Y TECNOLOGIA</h5>
              <p>BIMBO S.A de C.V</p>
            </div>
          </div>
</nav> -->
           <div class="col-sm-3"></div> 
          <div class="col-sm-2">
          <button type="button" class="btn btn-outline-primary btn-block btn-sm"><i class="fa fa-info float-left"></i> Información del Cliente</button>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1>Personas</h1>
          </div>
          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Personas</li>
            </ol>
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
                     (strcmp($persona->estado, 'true') == 0) ? $check= '' : $check = 'checked';
                      echo '<tr data-json=\''.json_encode($persona).'\'>';
                      echo'<td>
                              <div class="btn-group"> 
                                <i class="fa fa-search" style="cursor: pointer;margin: 3px;" title="Ver Detalles" onclick="verPersona(this)"></i>
                                <label class="switch"">
                                <div class="bootstrap-switch-container float-right" style="width: 15px; margin-left: 24px;" >
                                  <input type="checkbox" id="habilitarPersona"  name="habilitarPersona" data-bootstrap-switch '.$check.' onclick="habilitarPersona(this)">
                                </div>
                                </label>
                              </div>
                            </td>
                            <td></td>
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
                <div id="btn-habilitarPersona" class="bootstrap-switch-container" style="width: 126px; margin-left: -42px;" hidden>
                    <!-- <span class="bootstrap-switch-handle-on bootstrap-switch-primary" style="width: -42px;"></span> 
                    <span class="bootstrap-switch-label" style="width: 42px;">&nbsp;</span> 
                    <span class="bootstrap-switch-handle-off bootstrap-switch-default" style="width: -42px;"></span> -->
                    <input type="checkbox" name="habilitarPersonaEditar" id="habilitarPersonaEditar" data-bootstrap-switch-editar checked onclick="habilitarPersona()">
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
                        <div class="row" style="margin-top:-7px">
                          <div class="col">
                            <div class="card card-light">
                              <div class="card-header">
                                <h2 class="card-title">Datos Generales</h2>
                              </div><!-- fin card title -->
                               <div class="car-body">
                                <div class="container">
                                  <div class="row">
                                    <div class="col-md-4 ">
                                      <div class="form-group">
                                        <label>Apellidos<strong class="text-danger">*</strong>: </label>
                                        <input type="text" class="form-control" id="apellidos" name="apellidos">
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <label>Nombres <strong class="text-danger">*</strong>: </label>
                                        <input type="text" class="form-control" id="nombres" name="nombres">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                          <div class="form-group icon">
                                            <label>Imagen </label>
                                            <div class="small-box" style="position:initial;">
                                              <div class="icon" >
                                                <i class="fas fa-user" style="right:250px;"></i>
                                                <button class="btn btn-sm float-right" style="margin-top:-20px;margin-right:150px">
                                                  <i href="<?base_url()?>/public/dist/img/user2-160x160.jpg" target="_blank" class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm float-right agregaImagen" style="margin-top:-5px;margin-right:150px">
                                                  <i class="fas fa-upload"></i>
                                                </button>
                                              </div>
                                            </div>
                                            <!-- <div>
                                              style="font-size:20px; right:150px; top:60px; color:black"
                                              <input class="form-control" type="file" id="formFile">
                                            </div> -->
                                          </div>
                                    </div>
                                 
                                    <div class="col-md-4">
                                      <div class="form-group">
                                          <label>CURP<strong class="text-danger">*</strong>: </label>
                                          <input type="text" class="form-control" id="curp" name="curp">
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                          <label>Genero <strong class="text-danger">*</strong>: </label>
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
                                    <div class="col-md-4">
                                    </div>
                                    
                                    <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Fecha de Nacimiento<strong class="text-danger">*</strong>: </label>
                                         <input type="date" class="form-control float-left" id="fechaNacimiento" name="fechaNacimiento"> 
                                      </div>
                                    </div>

                                    <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Pais de nacimiento<strong class="text-danger">*</strong>: </label>
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
                                    <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Estado Civil<strong class="text-danger">*</strong>: </label>
                                          <select name="estadoCivil" id="estadoCivil" class="form-control">
                                            <option value="" selected disabled> - Seleccionar - </option>
                                            <?php 
                                              foreach ($listadoEstadoCivil as $key => $civil) {
                                                echo "<option value='$civil->tabl_id'>$civil->valor</option>";
                                              }
                                            ?>
                                          </select>
                                      </div>
                                    </div>

                                    <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Nacionalidad<strong class="text-danger">*</strong>: </label>
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

                                    <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Escolaridad<strong class="text-danger">*</strong>: </label>
                                          <select name="escolaridad" id="escolaridad" class="form-control">
                                            <option value="" selected disabled> - Seleccionar - </option>
                                            <?php 
                                              foreach ($listadoNivelEducativo as $key => $esco) {
                                                echo "<option value='$esco->tabl_id'>$esco->valor</option>";
                                              }
                                            ?>
                                          </select>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Ocupacion<strong class="text-danger">*</strong>: </label>
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
                            <div class="card card-light" style="margin-bottom: 0rem;">
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
                                            <input type="text" class="form-control" id="calle" name="calle">
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
                                          <input type="text" class="form-control" id="CodigoColonia" name="CodigoColonia">
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
                <button type="button" class="btn btn-secondary float-left" data-dismiss="modal" onclick="limpiaForm('#nueva_persona')" >Cancelar</button>
                <button type="button" class="btn btn-success float-left" id='btn-accion' style="margin-left: 5px;" onclick="guardarPersona()">Crear</button>
              </div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>


      <!-- Modal Agregar adjunto -->
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
                    <input id="inputImagen" name="inputImagen[]" type="file" class="form-control input-md" multiple>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary btnAgregarEditar">Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>


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
                      text:'<i class="fas fa-file-excel"></i><a class="text-light"> Exportar a Excel </a>',
                      className: 'btn btn-success btn-sm'
                    },
                    {
                      extend:"pdf", 
                      text:'<i class="fas fa-file-pdf"></i><a class="text-light"> Exportar a PDF </a>',
                      className: 'btn btn-danger btn-sm'
                    },
                    {
                      extend:"copy",
                      text:'<i class="fas fa-file"></i><a class="text-light"> Copiar </a>',
                      className: 'btn btn-secondary btn-sm'
                    },
                    {
                      extend:"print",
                      text:'<i class="fas fa-print"></i><a class="text-light"> Imprimir </a>',
                      className: 'btn btn-info btn-sm'
                    },
                   /*  {
                      extend:"colvis",
                      text:'<a class="text-light"> Ocultar columnas </a>',
                      className: 'btn btn-dark btn-sm'
                    },  */
                    {
                      text: '<a class="text-light" data-toggle="modal" data-target="#nueva_persona"> Agregar </a>',
                      style: 'margin-left:10px',
                      className: 'btn btn-secondary btn-sm agregar',
                      action: function ( e, dt, node, config ) {
                       // $('#nueva_cuenta').modal('show');
                      }
                    }
                  ],
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });

 
  $("#nueva_persona").on("hide.bs.modal", function() {
    $('#btn-accion').attr('onclick', 'guardarPersona()');
    $('#btn-accion').html('Crear');
    $('#mdl-title').html('Nueva Persona');
    $('#frm-nuevaPersona').find('.form-control').prop('disabled', false);
    $('#btn-editar').prop('hidden', true);
    $('#btn-asociarPosicion').prop('hidden', true);
    $('#btn-habilitarPersona').prop('hidden', true);
    $('#btn-accion').show();
    $('#frm-nuevaPersona')[0].reset();
  }); 

function guardarPersona(){

  var formData = new FormData($('#frm-nuevaPersona')[0]);

  if(!validarForm()) return;

  $.ajax({
    type:'POST',
    dataType: 'JSON',
    processData: false,
    contentType: false,
    data:formData,
    url: '<?= base_url()?>/guardarPersona',
    success: function(resp) {
            console.log(resp);
            alert("guardado");
            $('#nueva_persona').modal('hide');
            $('#frm-nuevaPersona')[0].reset();
            limpiaForm('#nueva_persona');
    },
    error: function(result){
      console.log("error");
    } 
    });
}


/* Validacion de formulario */
function validarForm(){ 
  ban=1;
  if(ban){
    /* Datos Generales */
      if($('#apellidos').val() == ''){
         $('#apellidos').addClass('is-invalid');
         ban=0;
      }else{
         $('#apellidos').removeClass('is-invalid');
         $('#apellidos').addClass('is-valid');
      }
    
      if($('#nombres').val() == ''){
         $('#nombres').addClass('is-invalid');
         ban=0;
      }else{
         $('#nombres').removeClass('is-invalid');
         $('#nombres').addClass('is-valid');
      }
    
       if($('#curp').val() == ''){
         $('#curp').addClass('is-invalid');
         ban=0;
      }else{
         $('#curp').removeClass('is-invalid');
         $('#curp').addClass('is-valid');  
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
    
      if($('#estadoCivil').val() == null){
         $('#estadoCivil').addClass('is-invalid');
         ban=0;
      }else{
         $('#estadoCivil').removeClass('is-invalid');
         $('#estadoCivil').addClass('is-valid');
      }
      if($('#nacionalidad').val() == null){
         $('#nacionalidad').addClass('is-invalid');
         ban=0;
      }else{
         $('#nacionalidad').removeClass('is-invalid');
         $('#nacionalidad').addClass('is-valid');
      }
      if($('#escolaridad').val() == null){
         $('#escolaridad').addClass('is-invalid');
         ban=0;
      }else{
         $('#escolaridad').removeClass('is-invalid');
         $('#escolaridad').addClass('is-valid');
      }

      if($('#ocupacion').val() == ''){
         $('#ocupacion').addClass('is-invalid');
         ban=0;
      }else{
         $('#ocupacion').removeClass('is-invalid');
         $('#ocupacion').addClass('is-valid');
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

/* Elimina los estilos de los input correctos-incorrectos */
function limpiaForm(formulario){
  $(formulario).find(".is-valid").removeClass().addClass('form-control');
  $(formulario).find(".is-invalid").removeClass().addClass('form-control');
}

function verPersona(e){
    $('#btn-accion').hide();
    $('#mdl-title').html('Persona');
    $('#frm-nuevaPersona').find('.form-control').prop('disabled', true);
    $('#btn-editar').prop('hidden', false);
    $('#btn-asociarPosicion').prop('hidden', false);
    $('#nueva_persona').modal('show');
    $('#btn-habilitarPersona').prop('hidden', true);

    var tr = $(e).closest('tr');
    var json = $(tr).data('json');
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


    if(json.estado == 'true')
    $("[name='habilitarPersonaEditar']").bootstrapSwitch('state', $('#habilitarPersonaEditar').prop('checked',false));
    /*else
    $(e).closest("tr").find('input[type="checkbox"]').bootstrapSwitch('state', $('#habilitarPersonaEditar').prop('checked',false)); */

   // $("[name='habilitarPersonaEditar']").bootstrapSwitch('state', $('#habilitarPersonaEditar').prop('checked',false));

   /*  if(json.estado == 'false')

   // bootstrap-switch-id-habilitarPersonaEditar bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-on bootstrap-switch-animate
    $("[name='habilitarPersonaEditar']").bootstrapSwitch('state', $('#habilitarPersonaEditar').prop('checked',true));
    else{
     $('.bootstrap-switch-id-habilitarPersonaEditar').removeClass('bootstrap-switch-on').addClass('bootstrap-switch-id-habilitarPersonaEditar bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-animate');
    $("[name='habilitarPersonaEditar']").bootstrapSwitch('state', $('#habilitarPersonaEditar').prop('checked',false));
    }
 */

}

function habilitaEditarPersona(){
  $('#btn-habilitarPersona').prop('hidden', false);
  $('#btn-accion').show();
  $('#btn-accion').html('Modificar');
  $('#btn-accion').attr('onclick', 'editarPersona()');
  $('#frm-nuevaPersona').find('.form-control').prop('disabled', false);
  $('#btn-editar').prop('hidden', true);
  $('#btn-asociarPosicion').prop('hidden', false);
  $('#btn-asociarPosicion').prop('hidden', true);
  //$('#habilitarPersonaEditar').prop('checked', true); 

}

function editarPersona(){

  var formData = new FormData($('#frm-nuevaPersona')[0]);

  formData.append("pers_id",$('#nueva_persona #pers_id').val());
  if(!validarForm()) return;

  $.ajax({
    type:'POST',
    dataType: 'JSON',
    processData: false,
    contentType: false,
    url: '<?= base_url()?>/editarPersona',
    data:formData,
    success: function(resp) {
            Swal.fire({
              icon: 'success',
              title: 'Se edito correctamente!',
              showConfirmButton: false,
              timer: 1500
            });
            $('#nueva_persona').modal('hide');
            $('#frm-nuevaPersona')[0].reset();
            limpiaForm('#nueva_persona');
    },
    complete: function() {
      window.location.reload();
    }
    });
}



/* $("input[data-bootstrap-switch]").each(function(){
    a = $(this).bootstrapSwitch('state', $(this).prop('checked'));
     //console.log(a);
     check = $(this).is(':checked');
     if(check)
     console.log("hola");
     else 
     console.log("no"); 
}); 
 */
$("input[data-bootstrap-switch]").bootstrapSwitch();
$("[name='habilitarPersonaEditar']").bootstrapSwitch(); /* .each(function(){
  $(this).bootstrapSwitch('state', $(this).prop('checked',true));
}); */
 


//abrir modal agregar adjunto
$(document).on("click", ".agregaImagen", function() {
    $('#modalAgregarImagen').modal('show');
  event.preventDefault();
  $( window ).scroll(function() {
  
});
});

//agregar adjunto
$("#formAgregarImagen").submit(function(event) {

 
  event.preventDefault(); 
  $( window ).scroll(function() {
  
});
    $('#modalAgregarImagen').modal('hide');

    if (document.getElementById("inputImagen").files.length == 0) {
      alert('error');
        $('#error').fadeIn('slow');
    } else {
        $('#error').fadeOut('slow'); 
        var formData = new FormData($("#formAgregarImagen")[0]);
        
         $.ajax({
                cache: false,
                contentType: false,
                data: formData,
                dataType: 'json',
                processData: false,
                type: 'POST',
                url: '<?= base_url()?>/guardarPersona',
            })
            .done(function(data) {
              alert("Agregado");
            })
            .error(function(result) {
                console.error(result);
            }); 
    } 
});


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
        $(e).closest("tr").find('input[type="checkbox"]').bootstrapSwitch('state', $('#habilitarPersona').prop('checked',true));
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
      window.location.reload();
        $(e).closest("tr").find('input[type="checkbox"]').bootstrapSwitch('state', $('data-bootstrap-switch').prop('checked',false));
      }
    });
  } 
}

 
</script>

<?= $this->endSection() ?>


