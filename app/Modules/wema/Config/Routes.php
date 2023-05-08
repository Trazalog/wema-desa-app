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
 $routes->get('/persona/entrevista', '\Modules\wema\Controllers\Persona::cargarEntrevista');



/* RUTAS CUENTAS */
$routes->get('/cuenta', '\Modules\wema\Controllers\Cuenta::index');
$routes->post('/getCuentas', '\Modules\wema\Controllers\Persona::getPersonas');
/*$routes->post('/guardarCuenta', '\Modules\wema\Controllers\Persona::guardarCuenta');
$routes->post('/editarCuenta', '\Modules\wema\Controllers\Persona::editarCuenta');
$routes->get('/eliminarCuenta/(:num)', '\Modules\wema\Controllers\Persona::eliminarCuenta/$1');
$routes->get('/habilitarCuenta/(:num)', '\Modules\wema\Controllers\Persona::habilitarCuenta/$1');*/


/* RUTAS CLIENTE */
$routes->get('/cliente', '\Modules\wema\Controllers\Cliente::index');
$routes->post('/guardarCliente', '\Modules\wema\Controllers\Cliente::guardarCliente');
$routes->post('/getClientes', '\Modules\wema\Controllers\Cliente::getClientes');
$routes->post('/editarCliente', '\Modules\wema\Controllers\Cliente::editarCliente');
$routes->get('/eliminarCliente/(:num)', '\Modules\wema\Controllers\Cliente::eliminarCliente/$1');
$routes->get('/habilitarCliente/(:num)', '\Modules\wema\Controllers\Cliente::habilitarCliente/$1');


// $routes->get('/filemanager/(:any)', 'Modules\Filemanager\Controllers\Filemanager::index');