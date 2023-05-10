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
 $routes->post('/getPersonas', '\Modules\wema\Controllers\Persona::getPersonas');
 $routes->get('/persona/cargarListadoEntrevistados', '\Modules\wema\Controllers\Persona::cargarListadoEntrevistados');
 $routes->get('/persona/initCuestionario/id/(:num)', '\Modules\wema\Controllers\Persona::initCuestionario/$1');



/* RUTAS CUENTAS */
$routes->get('/cuenta', '\Modules\wema\Controllers\Cuenta::index');



/* RUTAS CLIENTE */
$routes->get('/cliente', '\Modules\wema\Controllers\Cliente::index');
$routes->post('/guardarCliente', '\Modules\wema\Controllers\Cliente::guardarCliente');
$routes->post('/getClientes', '\Modules\wema\Controllers\Cliente::getClientes');
$routes->post('/editarCliente', '\Modules\wema\Controllers\Cliente::editarCliente');
$routes->get('/eliminarCliente/(:num)', '\Modules\wema\Controllers\Cliente::eliminarCliente/$1');
$routes->get('/habilitarCliente/(:num)', '\Modules\wema\Controllers\Cliente::habilitarCliente/$1');


// $routes->get('/filemanager/(:any)', 'Modules\Filemanager\Controllers\Filemanager::index');