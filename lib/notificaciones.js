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
//Funcion para obtener la extesion
//Funcion para obtener la extension del archivo codificado
function obtenerExtension(nom_archivo){
    var ext = nom_archivo.split('.');
        switch(ext.pop().toLowerCase()){
            case 'jpg': ext = 'data:image/jpg;base64,';break;
            case 'png': ext = 'data:image/png;base64,';break;
            case 'jpeg': ext = 'data:image/jpeg;base64,';break;
            case 'jfif': ext = 'data:image/jpeg;base64,';break;
            case 'pjpeg': ext = 'data:image/pjpeg;base64,';break;
            case 'wbmp': ext = 'data:image/vnd.wap.wbmp;base64,';break;
            case 'webp': ext = 'data:image/webp;base64,';break;
            case 'pdf': ext = 'data:application/pdf;base64,';break;
            case 'doc': ext = 'data:application/msword;base64,';break;
            case 'xls': ext = 'data:application/vnd.ms-excel;base64,';break;
            case 'docx': ext = 'data:application/vnd.openxmlformats-officedocument.wordprocessingml.document;base64,';break;
            case 'txt': ext = 'data:text/plain;base64,';break;
            case 'csv': ext = 'data:text/csv;base64,';break;
            default: ext = "";
        }
    return ext;
}