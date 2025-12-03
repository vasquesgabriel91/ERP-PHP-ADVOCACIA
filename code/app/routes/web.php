<?php

use App\Core\Router;    

$router = new Router();

$router->get('/user', 'App\Controllers\ClienteController@index')->name('user.index');

$router->post('/user', 'App\Controllers\ClienteController@store')->name('user.store');
