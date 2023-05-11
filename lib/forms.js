//Scripts generales para los formularios del sistema.
//Por favor incluir una descripcion de que hace la función.
//Por favor

//Script para validar los campos de un formulario
//NOTA: Paa que valide el campo es necesario que se le agregue la clase requerido 
function validaForm(selectorForm){
    let ban = true;
    $(selectorForm).find('.requerido').each(function (){
        if($(this).val() === '' || $(this).val() === null){
            ban = false;
            $(this).addClass('is-invalid');
        }else{
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');
        }
    });
    if(!ban){
        notificar(notiObligatoriedad);
    }
    return ban;
}

//Script para limpiar las clases de validación(correctos-incorrectos) sobre el formulario
//
function limpiaForm(formulario){
    $(formulario).find(".is-valid").removeClass().addClass('form-control');
    $(formulario).find(".is-invalid").removeClass().addClass('form-control');
}

function detectarForm() {
	$(".frm-open").click(function () {
		// if (isModalOpen()) return;

		// obtenerForm(this.dataset.info);

		$(this).load(
			frmUrl + "/obtener/" + this.dataset.info,
			function () {
				// $(".frm-select").select2();
			}
		);
	});

    $(".frm-new-modal").click(function () {
		nuevoForm(this.dataset.form);
	});

	$(".frm-new").each(function () {
		$(this).load(
			frmUrl + "/obtenerNuevo/" + this.dataset.form,
			function () {
				// $(".frm-select").select2();
			}
		);
	});
}

//Funcion para guardar el formulario dinamico con promesas y retornando el info_id generado
//
async function frmGuardarConPromesa(e) {
    var form = $(e).closest("form").attr("id");
	var info = $(e).closest("form").data("info");

	var nuevo = info == "";
	if (nuevo) info = $(e).closest("form").data("form");
    var formData = new FormData($("#" + form)[0]);

    //Preparo Informacion Checkboxs
	var checkbox = $("#" + form).find("input[type=checkbox]");
	$.each(checkbox, function (key, val) {
		if (!formData.has($(val).attr("name"))) {
			formData.append($(val).attr("name"), "");
		}
	});

	//Preparo Informacion Files
	var files = $("#" + form + ' input[type="file"]');
	files.each(function () {
		if (conexion()) {
			if (this.value != null && this.value != "")
				formData.append(this.name, this.value);
		} else {
			formData.delete(this.name);
		}
	});
    let guardadoFormDinamico = new Promise((resolve,reject) => {
        $.ajax({
            type: "POST",
            dataType: "JSON",
            cache: false,
            contentType: false,
            processData: false,
            url:
                "index.php/" + frmUrl + "Form/guardar/" + info + (nuevo ? "/true" : ""),
            data: formData,
            success: function (rsp) {
                if(_isset(rsp.info_id)){
                    resolve(rsp.info_id);
                }else{
                    reject("Ocurrió un error al gurdar el formulario dinámico");
                }  
            },
            error: function (rsp) {
                Swal.fire('Oops...','No se guardo formulario dinámico','error');
                reject("Ocurrió un error al gurdar el formulario dinámico");
            }
        });
    });
    return await guardadoFormDinamico;
}


//Script para eliminar clase requerido para validacion a cada input
//NOTA:es necesario agregar a cada input la misma clase 
//recibe id formulario y la clase de los input a eliminar la clase requerido
function remueveRequerido(selectorForm , clase){
    $(selectorForm).find(clase).each(function (){
            $(this).removeClass('requerido');
    });
}

//Script para agregar clase requerido para validacion a cada input
//NOTA es necesario agregar a cada input la misma clase 
//recibe id formulario y la clase de los input a agregar la clase requerido
function agregaRequerido(selectorForm , clase){
    $(selectorForm).find(clase).each(function (){
            $(this).addClass('requerido');
    });
}

//Script para mostrar columnas de inputs en un formulario
//NOTA es necesario definir a cada columna la misma clase ej: class="col-md-4 col_personaMoral" 
//recibe id formulario y la clase de la columna a mostrar
function muestraColumna(selectorForm , clase){
    $(selectorForm).find(clase).each(function (){
            $(this).prop('hidden', false);
    });
}

//Script para ocultar columnas de inputs en un formulario
//NOTA es necesario definir a cada columna la misma clase ej: class="col-md-4 col_personaMoral" 
//recibe id formulario y la clase de la columna a ocultar 
function ocultaColumna(selectorForm , clase){
    $(selectorForm).find(clase).each(function (){
            $(this).prop('hidden', true);
    });
}
