<?php

use App\Http\Controllers\Web\IndexController;

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->get('index', [IndexController::class, 'index']);
});
