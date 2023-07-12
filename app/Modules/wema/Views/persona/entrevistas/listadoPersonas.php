<?php $this->extend('templates/admin_template') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2"> 
      <div class="col-sm-7">
          <!-- <ul class="breadcrumb">
            <li class="completed" ><a><i class="fa fa-folder-open"></i></a></li>
            <li class="completed" ><a>CONFIANZA Y TECNOLOGIA</a></li>
            <li class="active"><a>BIMBO S.A de C.V.</a></li>
          </ul> -->
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
                            <a href="'. site_url('persona/initCuestionario/id/'.$persona->pers_id) .'"><i class="far fa-comments" style="cursor: pointer;margin: 3px; color: black;" title="Entrevistar"></i></a>';
                  echo '<img style="cursor: pointer; margin-left: 3px" src="'.base_url("icons/lookup-icon.png").'" width="18" height="20" onclick="verModalResultados(this)" title="Ver Evaluaciones">';
                  //echo (!empty($persona->evaluaciones->evaluacion)) ? '<a href="'. site_url('/evaluarCuestionario/info_id/'.$persona->evaluaciones->evaluacion[0]->info_id) .'"><i class="fa fa-user-check" style="cursor: pointer;margin: 3px;" title="Evaluar Entrevista"></i></a>' : '';
                  echo    '</div>
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
  //URL del proyecto para evaluar cuestionarios
  link = "<?= site_url('/evaluarCuestionario/info_id/') ?>";
  //Inicializo datatable
  $('#tabla_personas').DataTable({
    columnDefs: [
      { width: 35, targets: 0 }
    ],
  });
  //Renderizo el contenido para ordenarlo
  $('#modalResultados').on('shown.bs.modal', function() {
      $('.grid').masonry({
        columnWidth: '.grid-item',
        itemSelector: '.grid-item',
        percentPosition: true
      });
    });
});
//
//Bloque Sript Modal Resultados
//
function verModalResultados(tag){
  datos = $(tag).closest('tr').data('json');
  //Clear campos
  $("hardSkillResult").val('');
  $("hardSkillFecha").val('');

  //Completo campos
  if(datos){
    $('#persIdModalResultado').prop('hidden', false);
    $('#persIdModalResultado').text( "(id: " + datos.pers_id + ")");
    $("#modalResultados [name='hardSkillResult']").val(datos.hard_skill);
    $("#modalResultados [name='hardSkillFecha']").val(datos.soft_skill);
    $("#modalResultados [name='nombres']").val(datos.nombres);
    $("#modalResultados [name='apellidos']").val(datos.apellidos);
    //Obtengo las evaluaciones realizadas
    $.ajax({
        type: 'GET',
        dataType: "JSON",
        processData: false,
        contentType: false,
        url: "<?= base_url()?>/resultado/evaluaciones/persona/" + datos.pers_id,
        success:function(data){
          console.log(data);
          tabla = $('#tablaResultadosModal').DataTable();
          tabla.clear().draw();

          $.each(data, function (i, value) {
            fila="<tr data-json= '"+ JSON.stringify(value) +"'>" +
                '<td class="centrar">'+
                  '<div class="btn-group"> '+
                    '<i class="fa fa-search" style="cursor: pointer;margin: 3px;" title="Ver Detalles" onclick="verDetalleEvaluacion(this)"></i>'+
                    '<i class="fa fa-user-check" style="cursor: pointer;margin: 3px;" title="Evaluar Entrevista" onclick="evaluarEntrevista('+value.info_id+')"></i>'+
                  '</div>'+
                '</td>'+
                '<td>'+ value.fec_alta +'</td>'+
                '<td>'+ value.apellidos_eval + " " + value.nombres_eval +'</td>'+
                '<td>'+'</td>'+
                '<td>'+ value.area +'</td>'+
                '<td>'+ value.posicion +'</td>'+
                '</tr>';
                tabla.row.add($(fila)).draw();
            });
          //Relleno los campos con la info de la ultima evaluacion
          $("#modalResultados [name='evaluador']").val(data[0].nombres_eval + " " + data[0].apellidos_eval);
          $("#modalResultados [name='puesto']").val(data[0].posicion_eval ? data[0].posicion_eval : '');
          $("#modalResultados #hardSkillResult").val(data[0].hard_skill ? data[0].hard_skill + "%" : '');
          $("#modalResultados #hardSkillFecha").val(data[0].fec_hard ? moment(data[0].fec_hard).format("YYYY-MM-DD") : '');
          $("#modalResultados #softSkillResult").val(data[0].soft_skill ? data[0].soft_skill + "%" : '');
          $("#modalResultados #softSkillFecha").val(data[0].fec_soft ? moment(data[0].fec_soft).format("YYYY-MM-DD") : '');
          //Genero el Bar Chart
          generarBarChart([{"pers_id": 20, "valor2": Math.floor(Math.random() * 100), "valor3" : 100},{"pers_id": 20, "valor2": Math.floor(Math.random() * 100), "valor3" : 100}]);
        },
        error: (data) =>{
          notificar(notiError);
        }
    });
    //Creo el link para ver imagen en nueva pestaña
    if(datos.nom_imagen){
      var codificacion = obtenerExtension(datos.nom_imagen);

      /* decodificacion imagen base64 */
      var decodedData = window.atob(datos.imagen);

      /*Accion ojo de imagen */
      document.getElementById('verImagenModalResultado').onclick = function (){
        event.preventDefault();
        var newTab = window.open();
        newTab.document.body.innerHTML = '<img src="'+ codificacion + decodedData +'" >';
        newTab.document.close();
      }
    
      $('#imagenUsuarioModalResultado').attr('src', codificacion + decodedData);
    }else{
      $('#imagenUsuarioModalResultado').attr('src', '');
    }
  }
  //Muestro modal
  $('#modalResultados').modal('show');
}
function generarBarChart(datos){
  var areaChartData = {
    labels  : [],
    datasets: [
      {
        label               : 'Áreas de oportunidad',
        // backgroundColor     : 'rgba(60,141,188,0.9)',
        backgroundColor     : 'Green',
        borderColor         : 'rgba(60,141,188,0.8)',
        pointRadius          : false,
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : [datos[0].valor2, datos[0].valor3]
      },
      {
        label               : 'Desempeño',
        backgroundColor     : 'rgba(210, 214, 222, 1)',
        borderColor         : 'rgba(210, 214, 222, 1)',
        pointRadius         : false,
        pointColor          : 'rgba(210, 214, 222, 1)',
        pointStrokeColor    : '#c1c7d1',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data                : [datos[1].valor2, datos[1].valor3]
      },
    ]
  }
  //-------------
  //- BAR CHART -
  //-------------
  var barChartCanvas = $('#barChart').get(0).getContext('2d')
  var barChartData = $.extend(true, {}, areaChartData)
  var temp0 = areaChartData.datasets[0]
  var temp1 = areaChartData.datasets[1]
  barChartData.datasets[0] = temp1
  barChartData.datasets[1] = temp0

  var barChartOptions = {
    responsive              : true,
    maintainAspectRatio     : false,
    datasetFill             : false
  }

  new Chart(barChartCanvas, {
    type: 'bar',
    data: barChartData,
    options: barChartOptions
  })
}
function evaluarEntrevista(info_id){
  $.get('<?= base_url()?>/evaluarCuestionario/info_id/' + info_id, function (data){
    notificar({'icon' : 'success','title':'Éxito', text: 'Se proceso la evaluación correctamente','btnConfirmar' : true});
  })
}
//
//Fin Bloque Script Modal Resultados
//
</script>
<?= $this->endSection() ?>