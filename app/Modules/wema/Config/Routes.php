<?php

if(!isset($routes)) {
     $routes = App\Config\Services::routes(true);
 }
 $routes->get('/persona', '\Modules\wema\Controllers\Persona::index');
 $routes->post('/guardarPersona', '\Modules\wema\Controllers\Persona::guardar');
 $routes->post('/editarPersona', '\Modules\wema\Controllers\Persona::editarPersona');

// $routes->get('/filemanager/(:any)', 'Modules\Filemanager\Controllers\Filemanager::index');