<?php

use App\Http\Controllers\Admin\SiteController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\TeamController;
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

        // 获取分类列表
        $api->get('category/list', [CategoryController::class, 'list']);
        //获取分类数据
        $api->get('category/data', [CategoryController::class, 'getCategoryData']);

        // 获取标签列表
        $api->get('tag/list', [TagController::class, 'list']);
        //获取标签数据
        $api->get('tag/data', [TagController::class, 'getTagData']);

        // 获取机构列表
        $api->get('team/list', [TeamController::class, 'list']);
        $api->get('team/form-init-data', [TeamController::class, 'getFormInitData']);

        // 获取站点列表
        $api->get('site/list', [SiteController::class, 'list']);
        $api->get('site/form-init-data', [SiteController::class, 'getFormInitData']);

        $api->resource('menu', MenuController::class, ['only' => ['store', 'update', 'destroy']]);
        $api->resource('user', UserController::class, ['only' => ['store', 'update', 'destroy']]);
        $api->resource('category', CategoryController::class, ['only' => ['store', 'destroy']]);
        $api->resource('tag', TagController::class, ['only' => ['store', 'destroy']]);
        $api->resource('team', TeamController::class, ['only' => ['store', 'update', 'destroy', 'show']]);
        $api->resource('site', SiteController::class, ['only' => ['store', 'update', 'destroy', 'show']]);
    });
});
