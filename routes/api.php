<?php

use App\Http\Controllers\Web\IndexController;

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group(['prefix' => 'home'], function ($api) {
        $api->get('draw-class', [IndexController::class, 'drawClass']);
        $api->get('site-nav', [IndexController::class, 'SiteNav']);
        $api->get('more/{categoryId}', [IndexController::class, 'more']);
        $api->get('tag-teams/{tagId}', [IndexController::class, 'tagTeams']);
    });
});
