<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('api')->post('/login', function (Request $request) {
    return [
        'data' => [

        ],
        'meta' => [
            "msg"    => "登录成功",
            "status" => 200
        ]
    ];
});

Route::namespace('api')->get('/menus', function (Request $request) {
    return [
        'data' => [
            ['id'       => 101,
             'authName' => '用户管理',
             'path'     => null,
             'children' => [
                 [
                     "id"       => 104,
                     "authName" => "用户列表",
                     "path"     => 'users',
                     "children" => []
                 ]
             ]
            ],
            ['id'       => 102,
             'authName' => '文章管理',
             'path'     => null,
             'children' => [
                 [
                     "id"       => 105,
                     "authName" => "文章列表",
                     "path"     => 'rules',
                     "children" => []
                 ]
             ]
            ],
        ],
        'meta' => [
            "msg"    => "获取菜单列表成功",
            "status" => 200
        ]
    ];
});

Route::namespace('api')->get('/users', function (Request $request) {
    return [
        'data' => [
            'totalpage' => 4,
            'pagenum'   => 1,
            'path'      => null,
            'users'     => [
                [
                    "id"          => 1,
                    "username"    => "tige",
                    "mobile"      => "1412412414",
                    "type"        => 1,
                    "email"       => "tige112@163.com",
                    "create_time" => "2017-11-09T20:36:26.000Z",
                    "mg_state"    => true,
                    "role_name"   => "炒鸡管理员"
                ],
                [
                    "id"          => 2,
                    "username"    => "aaa",
                    "mobile"      => "18616358651",
                    "type"        => 2,
                    "email"       => "333@163.com",
                    "create_time" => "2017-11-09T20:36:26.000Z",
                    "mg_state"    => false,
                    "role_name"   => "酱油"
                ],
                [
                    "id"          => 3,
                    "username"    => "bbbb",
                    "mobile"      => "34315135315",
                    "type"        => 3,
                    "email"       => "222@163.com",
                    "create_time" => "2017-11-09T20:36:26.000Z",
                    "mg_state"    => false,
                    "role_name"   => "aaaaaaa"
                ],
                [
                    "id"          => 4,
                    "username"    => "cccc",
                    "mobile"      => "14141414141",
                    "type"        => 1,
                    "email"       => "111@163.com",
                    "create_time" => "2017-11-09T20:36:26.000Z",
                    "mg_state"    => true,
                    "role_name"   => "酱油"
                ],
            ]
        ],
        'meta' => [
            "msg"    => "获取成功",
            "status" => 200
        ]
    ];
});

Route::namespace('api')->put('/users/{uid}/state/{type}', function ($uid, $type) {
    return [
        'data' => [
            "id"       => 566,
            "rid"      => 30,
            "username" => "admin",
            "mobile"   => "123456",
            "email"    => "bb@itcast.com",
            "mg_state" => $type
        ],
        'meta' => [
            "msg"    => "设置状态成功",
            "status" => 200
        ]
    ];
});

Route::namespace('api')->post('/users', function (Request $request) {
    return [
        'data' => [
            "id"          => 28,
            "username"    => "tige1200",
            "mobile"      => "test",
            "type"        => 1,
            "openid"      => "",
            "email"       => "test@test.com",
            "create_time" => "2017-11-10T03:47:13.533Z",
            "modify_time" => null,
            "is_delete"   => false,
            "is_active"   => false
        ],
        'meta' => [
            "msg"    => "用户创建成功",
            "status" => 201
        ]
    ];
});

Route::namespace('api')->get('/users/{uid}', function ($uid) {
    return [
        'data' => [
            "id"       => 503,
            "username" => "admin3",
            "role_id"  => 0,
            "mobile"   => "00000",
            "email"    => "new@new.com"
        ],
        'meta' => [
            "msg"    => "查询成功",
            "status" => 200
        ]
    ];
});
Route::namespace('api')->put('/users/{uid}', function ($uid, Request $request) {
//    dd($uid, $request->all());
    return [
        'data' => [
            "id"       => 503,
            "username" => "admin3",
            "role_id"  => 0,
            "mobile"   => "00000",
            "email"    => "new@new.com"
        ],
        'meta' => [
            "msg"    => "更新成功",
            "status" => 200
        ]
    ];
});
Route::namespace('api')->delete('/users/{uid}', function ($uid, Request $request) {
    return [
        'data' => null,
        'meta' => [
            "msg"    => "删除成功",
            "status" => 200
        ]
    ];
});
