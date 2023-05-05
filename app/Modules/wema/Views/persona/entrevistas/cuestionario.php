<?php $this->extend('templates/admin_template') ?>
<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Cuestionario</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="bs-stepper">
                            <div class="bs-stepper-header" role="tablist">
                                <!-- your steps here -->
                                <?php foreach ($cuestionario->preguntas as $key => $pregunta) {
                                        echo    '<div class="step" data-target="#pregunta-'.$key.'">';
                                        echo    '<button type="button" class="step-trigger" role="tab" aria-controls="pregunta-'.$key.'" id="pregunta-'.$key.'-trigger">';
                                        echo        '<span class="bs-stepper-circle">'.$key.'</span>';
                                        echo        '<span class="bs-stepper-label">'.$pregunta->titulo.'</span>';
                                        echo    '</button>';
                                        echo    '</div>';
                                        echo    ($key !== count($cuestionario->preguntas) - 1) ? '<div class="line"></div>' : '';
                                    }
                                ?>
                            </div>
                            <div class="bs-stepper-content">
                                <form id="frm-entrevista">
                                    <input id="pers_id" name="pers_id" type="text" disabled hidden>
                                    <!-- your steps content here -->
                                    <?php foreach ($cuestionario->preguntas as $key => $pregunta) {
                                            echo    '<div id="pregunta-'.$key.'" class="content" role="tabpanel" aria-labelledby="pregunta-'.$key.'-trigger">';
                                            echo        '<div class="form-group">';
                                            echo            '<div style="position: relative; overflow: hidden; padding-top: 56.25%;">';
                                            echo                '<iframe src="'.$pregunta->video.'" loading="lazy" title="Synthesia video player - Your AI video" allow="encrypted-media; fullscreen;" style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; border: none; padding: 0; margin: 0; overflow:hidden;"></iframe>';
                                            echo                '<audio id="pregunta-'.$key.'-audio-">Your browser does not support the audio element.</audio>';
                                            echo            '</div>';
                                            echo        '</div>';
                                            echo    '</div>';
                                        }
                                    ?>
                                </form>
                            </div>
                        </div>
                        <!-- /.bs-tepper -->
                        <div class="col-md-12 centrar">
                            <div class="form-group">
                                <button id="btn-anterior" class="btn btn-primary">Anterior</button><button id="btn-siguiente" class="btn btn-primary">Siguiente</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col-md-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /section -->
<script>
$(document).ready(function () {
    //Inicializo STEPPER
    var stepperConstruct = new Stepper($('.bs-stepper')[0]);
    //Defino la instancia para moverme sobre el form
    // var stepper = new Stepper(document.querySelector('.bs-stepper'));
    document.getElementById('btn-anterior').onclick = stepper.previous();
    document.getElementById('btn-siguiente').onclick = stepper.next();
});
</script>
<?= $this->endSection() ?>