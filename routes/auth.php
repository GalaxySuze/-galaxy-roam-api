<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['middleware' => 'api.throttle', 'limit' => 60, 'expires' => 1], function ($api) {
    $api->group(['prefix' => 'auth'], function ($api) {

        $api->post('register', [RegisterController::class, 'register']);
        $api->post('login', [AuthController::class, 'login']);

        // 登录后才能访问的路由
        $api->group(['middleware' => 'api.auth'], function ($api) {
            $api->post('logout', [AuthController::class, 'logout']);
            $api->post('refresh', [AuthController::class, 'refresh']);
        });
    });
});
