<?php

$api = app('Dingo\Api\Routing\Router');

// JWT Protected routes
$api->version('v1', ['middleware' => 'api.auth', 'providers' => 'jwt'], function ($api) {
    $api->get('/index', 'App\Http\Controllers\BackendController@index');
});

// Publicly accessible routes
$api->version('v1', [], function ($api) {

    $api->group(['name' => 'Authenticate'], function ($api) {
        $api->post('/authenticate', 'ApiArchitect\Auth\Http\Controllers\Auth\AuthenticateController@backend');
    });

    $api->group(['name' => 'User'], function ($api)
    {
        $api->group(['middleware' => 'api.auth', 'providers' => 'jwt'], function ($api) {
            $api->resource('/user', 'ApiArchitect\Compass\Http\Controllers\User\UserController');
        });
        $api->post('/user/register', 'ApiArchitect\Compass\Http\Controllers\User\UserController@register');
    });
});
