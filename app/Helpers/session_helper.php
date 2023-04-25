<?php

/**
 * Helper para funciones sobre datos de usuario y variables de sesión.
 * Mantener la estructura del mismo
*/

/**
* Devuelve empr_id desde la variable de usuario
* @param
* @return int empr_id
*/
if(!function_exists('empresa')){

    function empresa(){
        // $ci =& get_instance();
        // $empr_id  = $ci->session->userdata('empr_id');
        //HARCODE hasta que haya datos de sesión
        $empr_id = 3;
        return  $empr_id;
    }
}

/**
* Devuelve nick coincidente en DNATO y BPM
* @param
* @return string $usernick
*/
if(!function_exists('userNick')){

    function userNick(){
        // $ci =& get_instance();
        // $usernick  = $ci->session->userdata('usernick');
        //HARCODE hasta que haya datos de sesión
        $usernick = 'user_app_harcode';
        return  $usernick;
    }
}