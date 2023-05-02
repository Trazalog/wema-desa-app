<?php


function imagePerfil($img64,$imgName){

    $image = '';

    if(isset($img64) && isset($imgName)){   
        $rec = base64_decode($img64);       
        $ext = obtenerExtension($imgName);
        $image = "$ext$rec";
    }
    /*log_message('debug','#TRAZA | IMAGEN SESION | imageAdmin()  >> '.$imgName. ' :: '.$img64.' :: '.$image);*/

    return $image;
}


//Funcion para obtener la extension del archivo codificado
function obtenerExtension($archivo){
    $ext = explode('.',$archivo);
        switch(strtolower(array_pop($ext))){
            case 'jpg': $ext = 'data:image/jpg;base64,';break;
            case 'png': $ext = 'data:image/png;base64,';break;
            case 'jpeg': $ext = 'data:image/jpeg;base64,';break;
            case 'jfif': $ext = 'data:image/jpeg;base64,';break;
            case 'pjpeg': $ext = 'data:image/pjpeg;base64,';break;
            case 'wbmp': $ext = 'data:image/vnd.wap.wbmp;base64,';break;
            case 'webp': $ext = 'data:image/webp;base64,';break;
            case 'pdf': $ext = 'data:application/pdf;base64,';break;
            case 'doc': $ext = 'data:application/msword;base64,';break;
            case 'xls': $ext = 'data:application/vnd.ms-excel;base64,';break;
            case 'docx': $ext = 'data:application/vnd.openxmlformats-officedocument.wordprocessingml.document;base64,';break;
            case 'txt': $ext = 'data:text/plain;base64,';break;
            case 'csv': $ext = 'data:text/csv;base64,';break;
            default: $ext = "";
        }
    return $ext;
}