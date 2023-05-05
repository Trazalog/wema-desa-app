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
                <th>CURP</th>
                <th>Apellidos</th>
                <th>Nombres</th>
              </tr>
              </thead>
              <tbody>
                <?php foreach ($listadoPersonas as $key => $persona) {
                  echo  '<tr data-json=\''.json_encode($persona).'\'>';
                  echo  '<td class="centrar">
                          <div class="btn-group">
                            <a  href="'. site_url('persona/initCuestionario/id/'.$persona->pers_id) .'"><i class="fa fa-comments" style="cursor: pointer;margin: 3px;" title="Entrevistar"></i></a>
                          </div>
                        </td>
                        <td>'.$persona->curp.'</td>
                        <td>'.$persona->apellidos.'</td>
                        <td>'.$persona->nombres.'</td>
                      </tr>';
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
<script>
$(document).ready(function () {
  //Inicializo datatable
  $('#tabla_personas').DataTable({
    columnDefs: [
      { width: 35, targets: 0 }
    ],
  });
});
</script>
<?= $this->endSection() ?>