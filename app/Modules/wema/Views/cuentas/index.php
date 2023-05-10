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
                  <?php foreach ($listadoCuentas as $key => $persona){

                    /* imagen de perfil */
                    if($persona->imagen){
                      $src = imagePerfil($persona->imagen, $persona->nom_imagen); $class = "img-circle elevation-2"; $style = "height: 3rem; width: 3.9rem";}
                    else{ 
                      $src = ""; $class = ""; $style = "";  
                    }
                    (strcmp($persona->estado, 'true') == 0) ? $check= '' : $check = 'checked';
                    
                    echo '<tr data-json=\''.json_encode($persona).'\'>';
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
                          <td>'.$persona->curp.'</td>
                          <td>'.$persona->apellidos.'</td>
                          <td>'.$persona->nombres.'</td>
                          <td>'.$persona->nombres.'</td>
                    </tr>';
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
                        <div class="row">
                          <div class="col">
                            <div class="card card-info">
                              <div class="card-header">
                                <h2 class="card-title">Datos Generales</h2>
                              </div><!-- fin card title -->
                               <div class="car-body">
                                <div class="container">
                                  <div class="row">
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label>Nombre Cuenta <strong class="text-danger">*</strong>: </label>
                                        <input type="text" class="form-control" id="nombreCuenta" name="nombreCuenta">
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <label>Tipo Cuenta <strong class="text-danger">*</strong>: </label>
                                          <select name="tipoCuenta" id="tipoCuenta" class="form-control">
                                            <option value="" selected disabled> - Seleccionar - </option>
                                          </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                    <div class="form-group icon">
                                            <label>Logo </label>
                                            <div class="small-box" style="position:initial;">
                                              <div class="icon" >
                                                <i class="fas fa-file" style="right:250px;"></i>
                                                <button class="btn btn-sm float-right" style="margin-top:-20px;margin-right:150px">
                                                  <i href="<?base_url()?>/public/dist/img/user2-160x160.jpg" target="_blank" class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm float-right agregaImagen" style="margin-top:-5px;margin-right:150px">
                                                  <i class="fas fa-upload"></i>
                                                </button>
                                              </div>
                                            </div>
                                          </div>
                                    </div>
                                
                                 
                                    <div class="col-md-4">
                                      <div class="form-group">
                                          <label>RFC<strong class="text-danger">*</strong>: </label>
                                          <input type="text" class="form-control" id="rfcCuenta" name="rfcCuenta">
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                          <label>Nacionalidad <strong class="text-danger">*</strong>: </label>
                                          <select name="tipoCuenta" id="nacionalidad" class="form-control">
                                            <option value="" selected disabled> - Seleccionar - </option>
                                          </select>
                                        </div>
                                    </div>
                                  
                                  
                                    <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Tipo de Persona<strong class="text-danger">*</strong>: </label>
                                          <select name="tipoPersona"  id="tipoPersona" class="form-control">
                                            <option value="" selected disabled> - Seleccionar - </option>
                                          </select>
                                      </div>
                                    </div>
                                
                                  
                                    <div class="col-md-8">
                                      <div class="form-group">
                                          <label>Razón Social<strong class="text-danger">*</strong>: </label>
                                          <input type="text" class="form-control" id="razonSocial" name="razonSocial">
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Representante Legal<strong class="text-danger">*</strong>: </label>
                                          <input type="text" class="form-control" id="representanteLegal" name="representanteLegal">
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
                                      <label>Calle <strong class="text-danger">*</strong>: </label>
                                      <div class="form-group">                                            
                                        <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fas fa-road"></i></span>
                                        </div>
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


  $("#nueva_cuenta").on("hide.bs.modal", function() {
    $('#btn-accion-cuenta').attr('onclick', 'guardarPersona()');
    $('#btn-accion-cuenta').html('Crear');
    $('#mdl-title').html('Nueva Cuenta');
    $('#frm-nuevaCuenta').find('.form-control').prop('disabled', false);
    $('#btn-editar').prop('hidden', true);
    $('#btn-cuenta').prop('hidden', true);
    $('#btn-habilitarCuenta').prop('hidden', true);
    $('#btn-accion-cuenta').show();
    $('#frm-nuevaCuenta')[0].reset();
  });

function guardarCuenta(){
  console.log("guardarCuenta");
  var formData = new FormData($('#frm-nuevaCuenta')[0]);
  
  console.log(formData);
  if(!validaForm('#frm-nuevaCuenta')) return;

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
        title: '¿Esta seguro que desea habilitar la cuenta?',
        text: "Ten en cuenta que se habilitaras la cuenta",
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

/* inicializacion botones on/off  de tabla*/
$("[name='habilitarCuenta']").bootstrapSwitch({
  /* habilitar/deshabilitar personas */
   onSwitchChange:function(e, state){
    var tr = $(e.target).closest('tr');
    var json = $(tr).data('json');
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
        title: '¿Esta seguro que desea habilitar la cuenta?',
        text: "Ten en cuenta que se habilitaras la cuenta",
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

function verCuenta(e){
    $('#btn-accion-cuenta').hide();
    $('#mdl-title').html('Cuenta');
    $('#btn-editar').prop('hidden', false);
    $('#btn-clientes').prop('hidden', false);
    $('#btn-habilitarCuenta').prop('hidden', true);
    $('#frm-nuevaCuenta').find('.form-control').prop('disabled', true);
    $('#nueva_cuenta').modal('show');
}

function listadoClienteCuenta(e){
  
    $('#list_cuenta_clientes').modal('show');
}

function habilitaEditarCuenta(e){
  console.log("habilitaEditarCuenta");
    $('#btn-habilitarCuenta').prop('hidden', false);
    $('#btn-accion-cuenta').show();
    $('#btn-accion-cuenta').html('Modificar');
    $('#btn-accion-cuenta').attr('onclick', 'editarCuentta()');
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


