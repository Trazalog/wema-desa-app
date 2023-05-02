//Notificaciones para el sistema
//Configuracion Notificaciones simples
const notiSuccess = {'icon' : 'success','title':'Éxito', text: 'Solicitud procesada correctamente','btnConfirmar' : true};
const notiError = {'icon' : 'error','title':'Error', text: 'Se produjo un error al procesar la solicitud!','btnConfirmar' : true};
const notiObligatoriedad = {'icon' : 'error','title':'Error','text': 'Complete los campos obligatorios!','btnConfirmar' : true};

//Alerta para notificaciones
//config es un objeto, usarlo para configurar la notificacion necesaria
function notificar(config){
    Swal.fire({
        icon: config.icon,
        title: config.title,
        text: config.text,
        showConfirmButton: config.btnConfirmar,
        timer: config.timer
    });
    return;
}
