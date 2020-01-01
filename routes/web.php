<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'messages', 'as' => 'messages.'], function () use ($router) {
    $router->post('/', ['uses' => 'MessageController@store', 'as' => 'store']);
    $router->get('/', ['uses' => 'MessageController@index', 'as' => 'index']);
    $router->get('/stream', ['uses' => 'MessageController@stream', 'as' => 'stream']);
});
