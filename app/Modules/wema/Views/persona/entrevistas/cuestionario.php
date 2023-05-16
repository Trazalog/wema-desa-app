<?php $this->extend('templates/admin_template') ?>
<?= $this->section('content') ?>
<style>
    #formEntrevista .frm-save{
        display: none;
    }
    .bs-stepper-header{
        overflow: auto;
    }
</style>
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
                                    $indice = ++$key;
                                        echo    '<div class="step" data-target="#pregunta-'.$indice.'">';
                                        echo    '<button type="button" class="step-trigger" role="tab" aria-controls="pregunta-'.$indice.'" id="pregunta-'.$indice.'-trigger">';
                                        echo        '<span class="bs-stepper-circle">'.$indice.'</span>';
                                        echo        '<span class="bs-stepper-label">'.$pregunta->titulo.'</span>';
                                        echo    '</button>';
                                        echo    '</div>';
                                        echo    ($indice !== count($cuestionario->preguntas)) ? '<div class="line"></div>' : '';
                                    }
                                ?>
                            </div>
                            <div class="bs-stepper-content mt-2">
                                <form id="frm-entrevista">
                                    <input id="pers_id" name="pers_id" type="text" disabled hidden>
                                    <!-- your steps content here -->
                                    <?php foreach ($cuestionario->preguntas as $key => $pregunta) {
                                            $indice = ++$key;
                                            echo    '<div id="pregunta-'.$indice.'" class="content" role="tabpanel" aria-labelledby="pregunta-'.$indice.'-trigger">';
                                            echo        '<div class="card card-info">';
                                            echo            '<div class="card-header">';
                                            echo                '<h3 class="card-title">'.$pregunta->pregunta.'</h3>';
                                            echo            '</div>';
                                            echo            '<div class="car-body">';
                                            echo                '<div class="container">';
                                            echo                    '<div class="row align-items-center mt-3">';
                                            echo                        '<div class="col-md-12">';
                                            echo                            '<p>'.$pregunta->descripcion.'</p>';
                                            echo                        '</div>';
                                            echo                    '</div>';
                                            echo                 '</div>';
                                            echo             '</div>';
                                            echo            '<div class="card-footer text-muted text-right">';
                                            echo                '<small class="text-muted"><em>Pulse la barra espaciadora para comenzar su respuesta.</em></small>';
                                            echo            '</div>';
                                            echo        '</div>';
                                            echo    '</div>';
                                        }
                                    ?>
                                </form>
                            </div>
                            <div id="waveform"></div>
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
<!-- MODAL BIENVENIDA  -->
<!-- MODAL GENERICO PARA CLIENTES -->
<div class="modal fade right" id="modalBienvenida" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" id='modalHeader'>
                <h3>Bienvenido al cuestionario</h3>
            </div>
            <div class="modal-body" id="modalBody">
                <h4>TÉRMINOS Y CONDICIONES</h4>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi non justo in enim gravida consequat. Vivamus tristique ultrices lectus, vitae dapibus neque feugiat nec. Aliquam in nibh ut justo facilisis dictum. Vivamus at eros vel odio feugiat tristique id nec neque. Aenean lobortis eros vel arcu vulputate blandit. Nunc luctus lacus eget ante rhoncus vehicula. Sed eleifend lacinia accumsan. Morbi interdum id augue in lobortis. Pellentesque efficitur ante tortor, eu tincidunt ligula faucibus ut. Etiam urna metus, vehicula in nibh nec, ultricies laoreet dui. Sed sagittis risus quam, eu faucibus neque sollicitudin a.
                </p>
                <p>
                    Quisque vehicula accumsan ante, ac consequat lorem convallis tempor. Maecenas non sollicitudin ex. Aliquam condimentum nisi sapien. Phasellus massa elit, porta et justo vitae, scelerisque varius massa. Etiam maximus elit posuere enim volutpat, eget facilisis massa sagittis. Suspendisse tincidunt mi non neque dictum rhoncus. Etiam nec sapien in metus tempus imperdiet id at arcu. Donec pellentesque lorem nec porttitor gravida. Vestibulum vitae nulla quis purus ornare pretium et vitae ante. Donec varius, nunc vel mattis congue, ligula neque feugiat lectus, vitae suscipit enim neque non arcu. Donec dui ex, maximus sit amet nulla vehicula, dignissim sollicitudin neque.
                </p>
                <p>
                    Donec pulvinar vulputate tincidunt. Donec ut laoreet dui. Vivamus porttitor varius metus sed bibendum. In imperdiet nisi eu dui accumsan congue. Curabitur posuere efficitur enim commodo tristique. Ut vel enim varius, rutrum ligula sit amet, dapibus massa. In hac habitasse platea dictumst. Duis eget tellus nec nibh ultricies commodo nec eu orci. Praesent enim eros, porta a turpis a, euismod cursus est. Nullam pretium nunc mauris, ut vehicula ex mollis sit amet. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut laoreet sit amet lectus at lacinia. Sed auctor, ligula eu ultrices gravida, ex urna ornare odio, at laoreet nulla nunc vel quam. Quisque sagittis justo sed velit fringilla, sed faucibus eros luctus.
                </p>
                <p>
                    Nullam et placerat dui, quis blandit neque. Donec sit amet lorem sit amet quam rutrum dapibus nec eu velit. Praesent in gravida felis. Nunc lacus tellus, laoreet sit amet placerat a, faucibus vitae nibh. Suspendisse laoreet faucibus urna in ullamcorper. Sed pellentesque, magna nec elementum dapibus, purus nibh ornare dolor, a cursus sapien elit eget turpis. Etiam sed rhoncus magna. Vivamus nec tellus nec sapien aliquet facilisis. Quisque risus diam, aliquam vitae velit fermentum, aliquam hendrerit sem. Cras interdum augue semper vulputate luctus. Mauris sagittis arcu at blandit molestie. Nulla ut semper neque. Duis maximus hendrerit ligula, ac venenatis mi commodo non.
                </p>
                <p>
                    Integer quis justo in sapien feugiat tincidunt a nec mauris. Sed sem ligula, faucibus et congue id, rhoncus quis justo. Curabitur tincidunt dolor eu est vehicula viverra. Fusce nisi quam, lacinia quis rhoncus ut, efficitur nec sapien. Nunc dolor metus, placerat vel tempus in, iaculis id ante. Integer fermentum mi sed nibh suscipit euismod. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam condimentum porttitor metus, et maximus orci elementum in. Proin ut dignissim lectus. Mauris vel pharetra justo. Praesent commodo leo tincidunt, finibus ipsum vitae, feugiat mi.</p>
                </p>
            </div>
            <div class="modal-footer ">
                <div class="col-mt-1 col-12 justify-content-center" style="margin-top:-5px">
                    <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Comenzar</button>
                </div>
            </div>
        </div>
    </div>
 </div>

<!-- FIN MODAL BIENVENIDA  -->
<script>
var gumStream; 						//stream from getUserMedia()
var rec; 							//Recorder.js object
var input; 							//MediaStreamAudioSourceNode we'll be recording
var formData = new FormData();      //Formulario a enviar con el cuestionario
var comienzo;                       //Variable de estado para controlar tiempo de grabacion
var duracion;                       //Variable de estado para controlar tiempo de grabacion
var fin;                            //Variable de estado para controlar tiempo de grabacion
var stepper;                        //Instancia variable plugin Stepper
var stepperConstruct;               //Contructor inicializacion stepper
var indiceCuestionario = <?= count($cuestionario->preguntas); ?>;
var wavesurfer;                     //Instancia para visualizacion de ingreso de auido
var utterance;                      //Instancia para lectura de texto
var synth = window.speechSynthesis; //Instancia API voces
// shim for AudioContext when it's not avb. 
var AudioContext = window.AudioContext || window.webkitAudioContext;
var audioContext //audio context to help us record
$(document).ready(function () {
    //Inicializo STEPPER
    stepperConstruct = new Stepper($('.bs-stepper')[0]);
    //Defino la instancia para moverme sobre el form
    stepper = new Stepper(document.querySelector('.bs-stepper'));
    //Vinculo evento para moverme por el formulario
    $("#btn-siguiente").on('click', function () {
        console.log("avanzando");
        stepper.next();
    });
    detectarForm();
    $(document).on('keydown', startRecording).on('keyup', stopRecording);
    // wavesurfer = WaveSurfer.create({
    //     // Use the id or class-name of the element you created, as a selector
    //     container: '#waveform',
    //     // The color can be either a simple CSS color or a Canvas gradient
    //     waveColor: 'grey',
    //     progressColor: 'hsla(200, 100%, 30%, 0.5)',
    //     cursorColor: '#fff',
    //     // This parameter makes the waveform look like SoundCloud's player
    //     barWidth: 3,
    //     plugins: [
    //         WaveSurfer.microphone.create()
    //     ]
    // });
    // Inicializo la APi de lectura de texto nativa
    voices = synth.getVoices();
    utterance = new SpeechSynthesisUtterance("Bienvenido al cuestionario");
    utterance.voice = voices[7];
    $("#modalBienvenida").modal("show");
    //Comienzo lectura del cuestionario
    $("#modalBienvenida").on('hide.bs.modal', function(){
        var iniciarCuestionario = () => {
            synth.speak(utterance)
        };
        notificar({'icon' : 'info','title':'Entrevista', text: 'Cuando se encuentre listo presione el botón para dar inicio a la entrevista',"confirmButtonText":"Iniciar",'btnConfirmar' : true,"always": iniciarCuestionario});
    });
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
    //Inicializo el wavesurfer
    wavesurfer.microphone.start();
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
    //Limpio el wavesurfer
    wavesurfer.microphone.stop();
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