<?php

$this->app->post('auth/register', 'ApiArchitect\Compass\Http\Controllers\User\UserController@register');

$this->app->group(['middleware' => 'jwt.auth'], function ($app){
    resource('user','ApiArchitect\Compass\Http\Controllers\User\UserController');
});

$this->app->post('auth/check/username', 'ApiArchitect\Compass\Http\Controllers\User\UserController@checkUniqueUserName');
$this->app->post('auth/check/email', 'ApiArchitect\Compass\Http\Controllers\User\UserController@checkUniqueEmail');