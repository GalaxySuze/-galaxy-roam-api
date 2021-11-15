<?php

use App\Http\Controllers\Web\IndexController;

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group(['prefix' => 'home'], function ($api) {
        $api->get('index', [IndexController::class, 'index']);
        $api->get('more/{categoryId}', [IndexController::class, 'more']);
        $api->get('tag-teams/{tagId}', [IndexController::class, 'tagTeams']);
    });
});
