<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends BaseController
{
    /**
     * @param RegisterRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        User::create([
            'username' => $request->get('username'),
            'password' => bcrypt($request->get('password')),
            'email'    => $request->get('email'),
        ]);

        return $this->response->created();
    }
}
