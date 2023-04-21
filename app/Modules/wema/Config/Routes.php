<?php

if(!isset($routes)) {
     $routes = App\Config\Services::routes(true);
 }


 /* RUTAS PERSONAS */
 $routes->get('/persona', '\Modules\wema\Controllers\Persona::index');
 $routes->post('/guardarPersona', '\Modules\wema\Controllers\Persona::guardarPersona');
 $routes->post('/editarPersona', '\Modules\wema\Controllers\Persona::editarPersona');
 $routes->get('/eliminarPersona/(:num)', '\Modules\wema\Controllers\Persona::eliminarPersona/$1');
 $routes->get('/habilitarPersona/(:num)', '\Modules\wema\Controllers\Persona::habilitarPersona/$1');


/* RUTAS CUENTAS */
$routes->get('/cuenta', '\Modules\wema\Controllers\Cuenta::index');

// $routes->get('/filemanager/(:any)', 'Modules\Filemanager\Controllers\Filemanager::index');