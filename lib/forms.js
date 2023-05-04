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
