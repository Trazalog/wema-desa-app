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


/* script forms */
function formToJson(formData) {
	var object = {};

	formData.forEach((value, key) => {
		if (!object.hasOwnProperty(key)) {
			object[key] = value;
			return;
		}

		if (!Array.isArray(object[key])) {
			object[key] = [object[key]];
		}

		object[key].push(value);
	});

	return JSON.stringify(object);
}

function formToObject(formData) {
	return JSON.parse(formToJson(formData));
}


//Función para validar un RFC
// Devuelve false si es inválido
function rfcValido(rfc, aceptarGenerico = true) {
    debugger;
    _rfc_pattern_pm = "^(([A-ZÑ&]{3})([0-9]{2})([0][13578]|[1][02])(([0][1-9]|[12][\\d])|[3][01])([A-Z0-9]{3}))|" +
             "(([A-ZÑ&]{3})([0-9]{2})([0][13456789]|[1][012])(([0][1-9]|[12][\\d])|[3][0])([A-Z0-9]{3}))|" +
             "(([A-ZÑ&]{3})([02468][048]|[13579][26])[0][2]([0][1-9]|[12][\\d])([A-Z0-9]{3}))|" +
             "(([A-ZÑ&]{3})([0-9]{2})[0][2]([0][1-9]|[1][0-9]|[2][0-8])([A-Z0-9]{3}))$";
    _rfc_pattern_pf = "^(([A-ZÑ&]{4})([0-9]{2})([0][13578]|[1][02])(([0][1-9]|[12][\\d])|[3][01])([A-Z0-9]{3}))|" +
                  "(([A-ZÑ&]{4})([0-9]{2})([0][13456789]|[1][012])(([0][1-9]|[12][\\d])|[3][0])([A-Z0-9]{3}))|" +
                  "(([A-ZÑ&]{4})([02468][048]|[13579][26])[0][2]([0][1-9]|[12][\\d])([A-Z0-9]{3}))|" +
                  "(([A-ZÑ&]{4})([0-9]{2})[0][2]([0][1-9]|[1][0-9]|[2][0-8])([A-Z0-9]{3}))$";

    if(rfc.match(_rfc_pattern_pm) || rfc.match(_rfc_pattern_pf)){
        return aceptarGenerico;
    }
    else{
        notificar(notiErrorRfc);
        return false;
    }       
}

