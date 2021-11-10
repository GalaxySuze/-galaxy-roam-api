<?php


namespace App\Enum;


class StatusCode
{
    const CODE_200 = 200; // 请求成功
    const CODE_201 = 201; // 创建成功
    const CODE_204 = 204; // 删除成功
    const CODE_400 = 400; // 请求的地址不存在或者包含不支持的参数
    const CODE_401 = 401; // 未授权
    const CODE_403 = 403; // 被禁止访问
    const CODE_404 = 404; // 请求的资源不存在
    const CODE_422 = 422; // [POST/PUT/PATCH] 当创建一个对象时，发生一个验证错误
    const CODE_500 = 500; // 内部错误
}
