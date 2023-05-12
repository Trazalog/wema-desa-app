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
                                            echo        '<div style="width:70%; margin-left: auto;margin-right: auto;" class="form-group">';
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
                                <!-- <button id="btn-anterior" class="btn btn-primary">Anterior</button> -->
                                <button id="btn-siguiente" class="btn btn-primary">Siguiente</button>
                            </div>
                        </div>
                        <div id="formEntrevista" class="frm-new" data-form="3"></div>
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
var gumStream; 						//stream from getUserMedia()
var rec; 							//Recorder.js object
var input; 							//MediaStreamAudioSourceNode we'll be recording
var formData = new FormData();      //Formulario a enviar con el cuestionario
var comienzo;                       //Variable de estado para controlar tiempo de grabacion
var duracion;                       //Variable de estado para controlar tiempo de grabacion
var fin;                            //Variable de estado para controlar tiempo de grabacion
var stepper;
var stepperConstruct;
var indiceCuestionario = <?= count($cuestionario->preguntas); ?>;
// shim for AudioContext when it's not avb. 
var AudioContext = window.AudioContext || window.webkitAudioContext;
var audioContext //audio context to help us record
$(document).ready(function () {
    //Inicializo STEPPER
    stepperConstruct = new Stepper($('.bs-stepper')[0]);
    //Defino la instancia para moverme sobre el form
    stepper = new Stepper(document.querySelector('.bs-stepper'));
    // document.getElementById('btn-anterior').onclick = stepper.previous();
    document.getElementById('btn-siguiente').onclick = stepper.next();
    $("#btn-siguiente").on('click', function () {
        console.log("avanzando");
        stepper.next();
    });
    detectarForm();
    $(document).on('keydown', startRecording).on('keyup', stopRecording);
});

function startRecording(e) {
    console.log(e.keyCode);
    if(e.keyCode != 32) return;
    e.preventDefault();
    if (!comienzo) {
      comienzo = new Date().getTime(); // Set the keydown timestamp
      checkear = setInterval(checkearTiempo, 500); // Check every second
    }else{
        return;
    }
	console.log("Comienza Grabacion!");
    // comienzo = new Date().getTime();
    var constraints = {audio: true};

	navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
		console.log("getUserMedia() success, stream created, initializing Recorder.js ...");
		/*
			create an audio context after getUserMedia is called
			sampleRate might change after getUserMedia is called, like it does on macOS when recording through AirPods
			the sampleRate defaults to the one set in your OS for your playback device
		*/
		audioContext = new AudioContext();
		/*  assign to gumStream for later use  */
		gumStream = stream;
		
		/* use the stream */
		input = audioContext.createMediaStreamSource(stream);

		/* 
			Create the Recorder object and configure to record mono sound (1 channel)
			Recording 2 channels  will double the file size
		*/
		rec = new Recorder(input,{
          numChannels: 1,
          sampleRate: 11025
        });

		//start the recording process
		rec.record()
		console.log("Recording started");

	}).catch(function(err) {
        console.log(err);
	});
}

function stopRecording(e) {
    if(e.keyCode === 32){
        clearInterval(checkear); // Clear the interval
        fin = new Date().getTime();
        var media = fin - comienzo;
        comienzo = null; // Reset the keydown timestamp
        console.log("Finaliza Grabación!");
        if(media < 7000){
            config = {'icon' : 'warning','title':'Advertencia', text: 'La respuesta debe durar mas de 7 segundos','btnConfirmar' : true};
            notificar(config);
            return;
        }else{
            console.log("Duracion correcta");
        }
    }else{
        return;
    }
	//tell the recorder to stop the recording
	rec.stop();
	//stop microphone access
	gumStream.getAudioTracks()[0].stop();
	//create the wav blob and pass it on to createDownloadLink
	// rec.exportWAV(createDownloadLink);
    rec.exportWAV(function(blob) {
        // var url = URL.createObjectURL(blob);
        // var link = document.createElement('a');
        // link.href = url;
        // link.download = 'recorded-audio.wav';
        // link.click();
        
        var filename = new Date().toISOString();
        formData.append("audio[]",blob, filename);
        var confCorrecta = {'icon' : 'success','title':'Éxito', text: 'Solicitud procesada correctamente','btnConfirmar' : true};
        notificar(confCorrecta);
        if(stepper._currentIndex === indiceCuestionario - 1){
            Swal.fire({
                title: 'Gracias',
                text: "Entrevista realizada satifactoriamente!",
                icon: 'success',
                confirmButtonColor: '#28a745',
                confirmButtonText: 'Hecho'
                }).then((result) => {
                    sendAudios();
                })
        }else{
            $("#btn-siguiente").click();
        }
        // console.log("Pegue el aaaaudio");
    });
}

function sendAudios(){
    console.log("Enviando audios!");
    form_id = $("#formEntrevista").attr('data-form');
    $.ajax({
        type:'POST',
        dataType: 'JSON',
        processData: false,
        contentType: false,
        data:formData,
        url: '<?= base_url()?>/guardarCuestionario/'+form_id,
        success: function(resp) {
            if(resp.status){
                var confi = {'icon' : 'success','title':'Éxito', text: 'Se guardó el cuestionario correctamente','btnConfirmar' : true};
                notificar(confi);
            }else{
                notificar(notiError);
            }
        },
        error: function(result){
            notificar(notiError);
        }
    });
}
function checkearTiempo(){
    var fin = new Date().getTime();
    var duracion = fin - comienzo; // Calculate the time held in milliseconds

    if (duracion >= 7000) {
        // The key was held down for at least 7 seconds
        console.log('Key held down for at least 7 seconds!');
        clearInterval(checkear); // Clear the interval after validation
    }
}
</script>
<?= $this->endSection() ?>