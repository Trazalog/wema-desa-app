//Notificaciones para el sistema
//Configuracion Notificaciones simples
const notiSuccess = {'icon' : 'success','title':'Éxito', text: 'Solicitud procesada correctamente','btnConfirmar' : true};
const notiError = {'icon' : 'error','title':'Error', text: 'Se produjo un error al procesar la solicitud!','btnConfirmar' : true};
const notiObligatoriedad = {'icon' : 'error','title':'Error','text': 'Complete los campos obligatorios!','btnConfirmar' : true};
const notiErrorRfc = {'icon' : 'error','title':'Error', text: 'RFC incorrecto ','btnConfirmar' : true};

//Alerta para notificaciones
//config es un objeto, usarlo para configurar la notificacion necesaria
//NOTA: si se necesita valdiar campo, usar el ejemplo de "confirmButtonText"
function notificar(config){
    let confirmButtonText = config.confirmButtonText ? config.confirmButtonText : 'OK';
    Swal.fire({
        icon: config.icon,
        title: config.title,
        text: config.text,
        showConfirmButton: config.btnConfirmar,
        confirmButtonText: confirmButtonText,
        timer: config.timer
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if(!config.always){
            if (result.isConfirmed) {
                config.isConfirmed ? config.isConfirmed() : console.log("Aceptado");
            } else if (result.isDenied) {
                config.isDenied ? config.isDenied() : console.log("Cancelado");
            }
        }else{
            config.always ? config.always() : console.log("Cerrado");
        }
    })
    return;
}
