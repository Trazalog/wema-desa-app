<?php

if(!isset($routes)) {
     $routes = App\Config\Services::routes(true);
 }


 /* RUTAS PERSONAS */
 $routes->get('/persona', '\Modules\wema\Controllers\Persona::index');
 $routes->post('/guardarPersona', '\Modules\wema\Controllers\Persona::guardarPersona');
 $routes->post('/editarPersona', '\Modules\wema\Controllers\Persona::editarPersona');
 $routes->post('/editarAreaPosicion', '\Modules\wema\Controllers\Persona::editarAreaPosicion');
 $routes->get('/eliminarPersona/(:num)', '\Modules\wema\Controllers\Persona::eliminarPersona/$1');
 $routes->get('/habilitarPersona/(:num)', '\Modules\wema\Controllers\Persona::habilitarPersona/$1');
 $routes->post('/getPersonas', '\Modules\wema\Controllers\Persona::getPersonas');
 $routes->get('/persona/cargarListadoEntrevistados', '\Modules\wema\Controllers\Persona::cargarListadoEntrevistados');
 $routes->get('/persona/initCuestionario/id/(:num)', '\Modules\wema\Controllers\Persona::initCuestionario/$1');
 $routes->get('/persona/entrevista', '\Modules\wema\Controllers\Persona::cargarEntrevista');
 $routes->get('/vincularCuestionario/(:num)/(:num)', '\Modules\wema\Controllers\Persona::vincularCuestionario/$1/$2');
 $routes->get('/evaluarCuestionario/info_id/(:num)', '\Modules\wema\Controllers\Persona::evaluarCuestionario/$1');
 $routes->get('/modalCliente/(:num)', '\Modules\wema\Controllers\Persona::modalCliente/$1');
 $routes->post('/personasCliente/(:num)', '\Modules\wema\Controllers\Persona::getPersonasxIdClientes/$1');



/* RUTAS CUENTAS */
$routes->get('/cuenta', '\Modules\wema\Controllers\Cuenta::index');
$routes->post('/getCuentas', '\Modules\wema\Controllers\Cuenta::getEmpresas');
$routes->post('/guardarCuenta', '\Modules\wema\Controllers\Cuenta::guardarCuenta');
$routes->post('/editarCuenta', '\Modules\wema\Controllers\Cuenta::editarCuenta');
$routes->get('/eliminarCuenta/(:num)', '\Modules\wema\Controllers\Cuenta::eliminarCuenta/$1');
$routes->get('/habilitarCuenta/(:num)', '\Modules\wema\Controllers\Cuenta::habilitarCuenta/$1');
$routes->get('/getClientes/(:num)', '\Modules\wema\Controllers\Cuenta::getClientes/$1');


/* RUTAS CLIENTE */
$routes->get('/cliente', '\Modules\wema\Controllers\Cliente::index');
$routes->post('/guardarCliente', '\Modules\wema\Controllers\Cliente::guardarCliente');
$routes->post('/editarOrganigrama', '\Modules\wema\Controllers\Cliente::editarOrganigrama');
$routes->post('/getClientes', '\Modules\wema\Controllers\Cliente::getClientes');
$routes->post('/editarCliente', '\Modules\wema\Controllers\Cliente::editarCliente');
$routes->get('/eliminarCliente/(:num)', '\Modules\wema\Controllers\Cliente::eliminarCliente/$1');
$routes->get('/habilitarCliente/(:num)', '\Modules\wema\Controllers\Cliente::habilitarCliente/$1');
$routes->get('/getPersonas/(:num)', '\Modules\wema\Controllers\Cliente::getPersonas/$1');
$routes->get('/modalCuenta/(:num)', '\Modules\wema\Controllers\Cliente::modalCuenta/$1');
$routes->post('/clientesEmpresa/(:num)', '\Modules\wema\Controllers\Cliente::getClientesXIdEmpresa/$1');

/* RUTAS GENERALES (COREDataService)*/
$routes->get('/ubicaciones', '\Modules\wema\Controllers\General::getUbicaciones');

/* RUTAS RESULTADOS */
$routes->get('/resultado', '\Modules\wema\Controllers\Resultado::index');
$routes->get('/resultado/clientes/(:num)', '\Modules\wema\Controllers\Resultado::clientes/$1');
$routes->get('/resultado/personas/(:num)', '\Modules\wema\Controllers\Resultado::personas/$1');
