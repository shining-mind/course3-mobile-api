<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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
    return response()->json(['version' => $router->app->version()]);
});

$router->group(['prefix' => 'users', 'namespace' => 'Users'], function () use ($router) {
    $router->post('/', 'Controller@create');
    $router->get('search', 'Controller@search');
});

$router->group(['namespace' => 'Auth', 'prefix' => 'auth'], function () use ($router) {
    $router->post('token', 'Controller@login');
    $router->delete('token', 'Controller@logout');
    $router->get('me', 'Controller@me');
});

$router->group(['prefix' => 'teams', 'namespace' => 'Teams'], function () use ($router) {
    $router->get('/', 'Controller@list');
});
