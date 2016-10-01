<?php

$this->app->post('register', 'ApiArchitect\Compass\Http\Controllers\User\UserController@register');

resource('user','ApiArchitect\Compass\Http\Controllers\User\UserController');
