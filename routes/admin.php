<?php

use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\UserController;

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['middleware' => 'api.auth'], function ($api) {
    $api->group(['prefix' => 'admin'], function ($api) {

        // 获取菜单
        $api->get('menu/data', [MenuController::class, 'getMenusData']);

        // 获取用户列表
        $api->get('user/list', [UserController::class, 'list']);
        // 更新用户状态
        $api->put('user/{id}/state/{type}', [UserController::class, 'updateUserState']);

        $api->resource('menu', MenuController::class, ['only' => ['index', 'show']]);
        $api->resource('user', UserController::class);
    });
});
