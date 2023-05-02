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