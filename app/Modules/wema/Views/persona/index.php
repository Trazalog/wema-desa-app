<?php $this->extend('templates/admin_template') ?>

<?= $this->section('content') ?>

<!-- <style>
   .modal.fade:not(.in).right .modal-dialog {
    -webkit-transform: translate3d(45%, 0, 0);
    transform: translate3d(45%, 0, 0);
} 
</style> -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cuentas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Cuentas</li>
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
                  <tr>
                    <td>Trident</td>
                    <td>Internet
                      Explorer 4.0
                    </td>
                    <td>Win 95+</td>
                    <td> 4</td>
                    <td>X</td>
                    <td>X</td>
                  </tr>
                 
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
    <div class="modal fade right" id="nueva_cuenta" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Nueva Cuenta</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
            <form id="frm-nueva_cuenta">
                        <div class="row">
                          <div class="col">
                            <div class="card card-light">
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
                                          <select name="tipoCuenta" class="form-control">
                                            <option value="" selected disabled> - Seleccionar - </option>
                                          </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                          <div class="form-group">
                                            <label>Logo </label>
                                            <input class="form-control" type="file" id="formFile">
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
                                          <select name="tipoCuenta" class="form-control">
                                            <option value="" selected disabled> - Seleccionar - </option>
                                          </select>
                                        </div>
                                    </div>
                                  
                                  
                                    <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Tipo de Persona<strong class="text-danger">*</strong>: </label>
                                          <input type="text" class="form-control" id="tipoPersona" name="tipoPersona">
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
                            <div class="card card-light">
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
              <div class="col-12 justify-content-center">
                <button type="button" class="btn btn-secondary float-left" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success float-left" style="margin-left: 5px;" onclick="guardarCuenta()">Crear</button>
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
                      text: '<a class="text-light" data-toggle="modal" data-target="#nueva_cuenta"> Agregar </a>',
                      style: 'margin-left:10px',
                      className: 'btn btn-secondary agregar',
                      action: function ( e, dt, node, config ) {
                        
                      }
                    }
                  ],
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });


  $("#nueva_cuenta").on("hide.bs.modal", function() {

  });

function guardarCuenta(){
  //alert("hola");
  var formData = new FormData($('#frm-nueva_cuenta')[0]);
  
  console.log(formData);
  if(!validarForm()) return;


}

function validarForm(){
  var ban = ($('#nombreCuenta').val() == '')
  
  if(ban){
    $('#nombreCuenta').addClass('is-invalid');
  }else{
    $('#nombreCuenta').removeClass('is-invalid');
    $('#nombreCuenta').addClass('is-valid');
  }
  return ban;
  
}
</script>

<?= $this->endSection() ?>


