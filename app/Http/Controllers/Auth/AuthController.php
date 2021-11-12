<?php

namespace App\Http\Controllers\Auth;

use App\Enum\StatusCode;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;

class AuthController extends BaseController
{
    /**
     * @param Request $request
     * @return \Dingo\Api\Http\Response|void
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (!$token = auth('api')->attempt($credentials)) {
            return $this->response->errorUnauthorized('邮箱或密码错误');
        }
        return $this->respondWithToken($token);
    }

    /**
     * @return \Dingo\Api\Http\Response
     */
    public function logout()
    {
        auth('api')->logout();

        return $this->response->noContent();
    }

    /**
     * @return \Dingo\Api\Http\Response
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * @param $token
     * @return \Dingo\Api\Http\Response
     */
    protected function respondWithToken($token)
    {
        return $this->response->array([
            'user'     => auth('api')->user(),
            'access_token' => 'bearer ' . $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('api')->factory()->getTTL() * 60000000
        ]);
    }
}
