<?php

if(!isset($routes)) {
    log_message('info', '#TRAZA | TRAZ-COMP-FORMULARIOS | Config | Routes | ruta no definida');
    $routes = App\Config\Services::routes(true);
}


/* RUTAS PERSONAS */
$routes->get('/form/obtenerNuevo/(:num)', '\Modules\traz_comp_formularios\Controllers\Form::obtenerNuevo/$1');
$routes->get('/form/obtenerNuevoCuestionario/(:num)', '\Modules\traz_comp_formularios\Controllers\Form::obtenerNuevoCuestionario/$1');
$routes->post('/guardarCuestionario/(:num)/(:num)', '\Modules\traz_comp_formularios\Controllers\Form::guardarCuestionario/$1/$2');