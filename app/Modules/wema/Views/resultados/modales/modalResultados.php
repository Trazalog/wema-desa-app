 <!-- MODAL RESULTADOS EVALUACION -->
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
                <div class="col-2">
                    <button type="button" id="btn-organigrama" class="btn btn-outline-primary btn-block btn-sm pull-right"><i class="fas fa-sitemap" ></i> Ver Resultados </button>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" style="margin-top:-7px">
                    <div class="col">
                        <div class="card card-info">
                            <div class="card-header">
                                <h2 class="card-title">Datos Generales</h2>
                            </div>
                            <!-- /. card title -->
                            <div class="car-body">
                                <div class="container">
                                    <div class="row align-items-center mt-3">
                                        <div class="col-md-4 centrar">
                                            <div class="form-group">
                                                <!-- <label>Imagen </label> -->
                                                <div class="" style="position:initial;">
                                                    <!-- <i class="fas fa-user" style="right:250px;"></i> -->
                                                    <img id="imagenUsuario" class="profile-user-img img-fluid img-circle" style="height: 100px; width: 100px"  >
                                                    <button class="btn btn-sm" style="/*margin-top:-20px;margin-right:150px*/">
                                                        <i id="verImagen" class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- imagen -->
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
                                        <!-- apellidos -->
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
                                        <!-- nombres -->
                                    </div>
                                    <!-- /. row -->
                                    <div class="row align-items-center mt-3">
                                        <div class="col-md-4 ">
                                        </div>
                                        <div class="col-md-4 ">
                                            <div class="form-group">
                                                <p id="persona_id" style="margin-top: -19px;margin-bottom: -7px; font-style: italic;" hidden></p>
                                                <label>Evaluador <strong class="text-danger">*</strong>: </label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control requerido" id="evaluador" name="evaluador">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Evaluador -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Puesto <strong class="text-danger">*</strong>: </label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control requerido" id="puesto" name="puesto">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Puesto -->
                                    </div>
                                    <!-- /. row -->
                                </div>
                                <!-- /. container -->
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card .card-info -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h2 class="card-title">Hard Skills</h2>
                            </div>
                            <!-- /. card title -->
                            <div class="car-body">
                                <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 764px;" width="764" height="250" class="chartjs-render-monitor"></canvas>
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
                                <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 764px;" width="764" height="250" class="chartjs-render-monitor"></canvas>
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
                                <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 764px;" width="764" height="250" class="chartjs-render-monitor"></canvas>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card .card-info -->
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
