<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\AddUserRequest;
use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * @param AddUserRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function store(AddUserRequest $request)
    {
        $result = User::create([
            'username' => $request->get('username'),
            'email'    => $request->get('email'),
            'avatar'   => $request->get('avatar'),
            'password' => bcrypt($request->get('username')),
        ]);
        return $this->response->item($result, new UserTransformer())->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function list(Request $request)
    {
        $email = $request->get('email');
        $username = $request->get('username');
        $pageSize = $request->get('pageSize');
        $result = User::when(!empty($email), function ($query) use ($email) {
            $query->where('email', 'like', "%$email%");
        })->when(!empty($username), function ($query) use ($username) {
            $query->where('username', 'like', "%$username%");
        })->orderBy('created_at', 'desc')->paginate($pageSize);

        return $this->response->paginator($result, new UserTransformer());
    }

    /**
     * @param $id
     * @param $type
     * @return \Dingo\Api\Http\Response|void
     */
    public function updateUserState($id, $type)
    {
        $userInfo = User::find($id);
        if (!$userInfo) {
            return $this->response->errorNotFound('未查询到该用户信息!');
        }
        $userInfo->state = (int)$type;
        $userInfo->save();
        return $this->response->item($userInfo, new UserTransformer());
    }
}
