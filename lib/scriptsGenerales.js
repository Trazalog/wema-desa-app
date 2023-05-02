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
