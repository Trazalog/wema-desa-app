 <!-- MODAL RESULTADOS EVALUACION -->
 <style>
    #modalResultados ul li a.active{
        color: white !important;
    }
</style>
 <div class="modal fade right" id="modalResultados" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-2" >
                    <h5 class="modal-title">Resultados Persona</h5>
                </div>
                <div class="col-2">
                    <a type="button" id="btn-personas" class="btn btn-outline-primary btn-block btn-sm pull-right"><i class="fas fa-users"></i> Exportar </a>
                </div>
                <!-- <div class="col-2">
                    <button type="button" id="btn-organigrama" class="btn btn-outline-primary btn-block btn-sm pull-right"><i class="fas fa-sitemap" ></i> Ver Resultados </button>
                </div> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                <div class="row" style="margin-top:-7px">
                    <div class="col">
                        <div class="card card-light">
                            <div class="card-header d-flex p-0">
                                <h2 class="card-title p-3">Datos Generales</h2>
                                <ul style="color: white" class="nav nav-pills ml-auto p-2">
                                    <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Resumen</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Resultados</a></li>
                                </ul>
                            </div>
                            <!-- /. card title -->
                            <div class="car-body">
                                <!-- <div class="row align-items-start mt-3">
                                    <div class="col-md-12"> -->
                                        <div class="grid">
                                            <!-- <div class="grid-sizer"></div> -->
                                            <div class="grid-item">
                                        <!-- <div class="col-md-4 centrar mr-0"> -->
                                            <!-- <div class="form-group"> -->
                                                <p id="persIdModalResultado" style="margin-top: -19px;margin-bottom: -7px; font-style: italic;" hidden></p>
                                                <div class="" style="position:initial;">
                                                    <!-- <i class="fas fa-user" style="right:250px;"></i> -->
                                                    <img id="imagenUsuarioModalResultado" class="profile-user-img img-fluid img-circle" style="height: 100px; width: 100px"  >
                                                    <button class="btn btn-sm" style="/*margin-top:-20px;margin-right:150px*/">
                                                        <i id="verImagenModalResultado" class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                            <!-- </div> -->
                                        </div>
                                        <!-- imagen -->
                                        <div class="grid-item">
                                            <!-- <div class="col-md-4"> -->
                                                <!-- <div class="form-group"> -->
                                                    <label>Apellidos: </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control requerido" name="apellidos" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- apellidos -->
                                        <div class="grid-item">
                                            <!-- <div class="col-md-4"> -->
                                                <!-- <div class="form-group"> -->
                                                    <label>Nombres: </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control requerido" name="nombres" readonly>
                                                    </div>
                                                <!-- </div> -->
                                            </div>
                                        <!-- nombres -->
                                        <div class="grid-item">
                                        <!-- <div class="col-md-3"> -->
                                            <!-- <div class="form-group"> -->
                                                <p id="persona_id" style="margin-top: -19px;margin-bottom: -7px; font-style: italic;" hidden></p>
                                                <label>Evaluador: </label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-comment"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control requerido" name="evaluador" readonly>
                                                </div>
                                            <!-- </div> -->
                                        </div>
                                        <!-- Evaluador -->
                                        <div class="grid-item">
                                        <!-- <div class="col-md-3"> -->
                                            <!-- <div class="form-group"> -->
                                                <label>Puesto: </label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control requerido" name="puesto" readonly>
                                                </div>
                                            <!-- </div> -->
                                        </div>
                                        <!-- Puesto -->
                                        <div class="grid-item">
                                        <!-- <div class="col-md-3"> -->
                                            <!-- <div class="form-group"> -->
                                                <canvas id="barChart" class="chartjs-render-monitor"></canvas>
                                            <!-- </div> -->
                                        </div>
                                        <!-- chart -->

                                        <!-- <div class="col-md-12">
                                            <hr>
                                        </div> -->
                                    <!-- </div> -->
                                </div>
                                <!-- /. row align-items-start mt-3 -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        <div class="row skillSection mt-3 mb-0">
                                            <div class="card-group">
                                                <div class="col-md-4">
                                                    <div class="card card-primary">
                                                        <div class="card-header">
                                                            <h2 class="card-title">Hard Skills</h2>
                                                        </div>
                                                        <!-- /. card title -->
                                                        <div class="car-body">
                                                            <div class="row ml-2">
                                                                <div class="col-md-5 mt-3">
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i class="fas fa-poll"></i></span>
                                                                            </div>
                                                                            <input type="text" class="form-control requerido" id="hardSkillResult" name="hardSkillResult" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="form-group">
                                                                        <label>Fecha Evaluación:</label>
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                                            </div>
                                                                            <input type="date" class="form-control requerido" id="hardSkillFecha" name="hardSkillFecha" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- /.row -->
                                                        </div>
                                                        <!-- /.card-body -->
                                                    </div>
                                                    <!-- /.card .card-info -->
                                                </div>
                                                <!-- /. col -->
                                                <div class="col-md-4">
                                                    <div class="card card-pink">
                                                        <div class="card-header">
                                                            <h2 class="card-title">Soft Skills</h2>
                                                        </div>
                                                        <!-- /. card title -->
                                                        <div class="car-body">
                                                            <div class="row ml-2">
                                                                <div class="col-md-5 mt-3">
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i class="fas fa-poll"></i></span>
                                                                            </div>
                                                                            <input type="text" class="form-control requerido" id="hardSkillResult" name="hardSkillResult" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="form-group">
                                                                        <label>Fecha Evaluación:</label>
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                                            </div>
                                                                            <input type="date" class="form-control requerido" id="hardSkillFecha" name="hardSkillFecha" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>                            
                                                        </div>
                                                        <!-- /.card-body -->
                                                    </div>
                                                    <!-- /.card .card-info -->
                                                </div>
                                                <!-- /. col -->
                                                <div class="col-md-4">
                                                    <div class="card card-teal">
                                                        <div class="card-header">
                                                            <h2 class="card-title">Ethic Skills</h2>
                                                        </div>
                                                        <!-- /. card title -->
                                                        <div class="car-body">
                                                            <div class="row ml-2">
                                                                <div class="col-md-5 mt-3">
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i class="fas fa-poll"></i></span>
                                                                            </div>
                                                                            <input type="text" class="form-control requerido" id="hardSkillResult" name="hardSkillResult" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="form-group">
                                                                        <label>Fecha Evaluación:</label>
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                                            </div>
                                                                            <input type="date" class="form-control requerido" id="hardSkillFecha" name="hardSkillFecha" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- /.card-body -->
                                                    </div>
                                                    <!-- /.card .card-teal -->
                                                </div>
                                                <!-- /. col-md-4 -->
                                            </div>
                                            <!-- /. card-group -->
                                        </div>
                                        <!-- /. row skillSection -->
                                    </div>
                                    <!-- /#tab_1 -->
                                    <div class="tab-pane" id="tab_2">
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <div class="card card-info">
                                                    <div class="card-header">
                                                        <h2 class="card-title">Histórico Evaluaciones</h2>
                                                    </div>
                                                    <!-- /. card title -->
                                                    <div class="car-body">
                                                        <table id="tablaResultadosModal" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>Acciones</th>
                                                                    <th>Fecha y Hora</th>
                                                                    <th>Evaluador</th>
                                                                    <th>Cuestionario</th>
                                                                    <th>Área</th>
                                                                    <th>Puesto</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                                <!-- /.card -->
                                            </div>
                                            <!-- /.col-md-12 -->
                                        </div>
                                        <!-- /.row align-items-start mt-3 -->
                                    </div>
                                    <!-- /#tab_2 -->
                                </div>
                                <!-- /.tab-content -->
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card .card-light -->
                    </div>
                    <!-- /. col -->
                </div>
                <!-- /. row -->
            </div>
            <!-- /.modal-body -->
            <div class="modal-footer ">
                <div class="col-mt-1 col-12 justify-content-center" style="margin-top:-5px">
                    <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>