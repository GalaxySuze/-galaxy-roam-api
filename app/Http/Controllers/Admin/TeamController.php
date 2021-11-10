<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\AddTeamRequest;
use App\Http\Requests\Admin\AddUserRequest;
use App\Http\Requests\Admin\EditTeamRequest;
use App\Http\Requests\Admin\EditUserRequest;
use App\Models\Team;
use App\Models\User;
use App\Transformers\TeamTransformer;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;

class TeamController extends BaseController
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
     * @param AddTeamRequest $request
     * @return \Dingo\Api\Http\Response|object
     */
    public function store(AddTeamRequest $request)
    {
        $result = Team::create([
            'category_id'      => $request->get('category_id'),
            'tags_id'          => $request->get('tags_id'),
            'name'             => $request->get('name'),
            'desc'             => $request->get('desc'),
            'avatar'           => $request->get('avatar'),
            'homepage'         => $request->get('homepage'),
            'class_start_date' => $request->get('class_start_date'),
        ]);
        return $this->response->item($result, new TeamTransformer())->setStatusCode(201);
    }

    /**
     * @param $id
     */
    public function show($id)
    {
        //
    }

    /**
     * @param EditTeamRequest $request
     * @param $id
     * @return \Dingo\Api\Http\Response
     */
    public function update(EditTeamRequest $request, $id)
    {
        Team::where('id', $id)
            ->update([
                'category_id'      => $request->get('category_id'),
                'tags_id'          => $request->get('tags_id'),
                'name'             => $request->get('name'),
                'desc'             => $request->get('desc'),
                'avatar'           => $request->get('avatar'),
                'homepage'         => $request->get('homepage'),
                'class_start_date' => $request->get('class_start_date'),
            ]);
        return $this->response->item(Team::find($id), new TeamTransformer());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Team::where('id', $id)->delete();
        return $this->response->noContent()->setStatusCode(200);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function list(Request $request)
    {
        $name = $request->get('name');
        $categoryId = $request->get('category_id');
        $tagsId = $request->get('tags_id');
        $pageSize = $request->get('pageSize');
        $result = Team::when(!empty($name), function ($query) use ($name) {
            $query->where('name', 'like', "%$name%");
        })->when(!empty($categoryId), function ($query) use ($categoryId) {
            $query->where('category_id', $categoryId);
        })->when(!empty($tagsId), function ($query) use ($tagsId) {
            $query->where('tags_id', 'like', "%$tagsId%");
        })->orderBy('created_at', 'desc')->paginate($pageSize);

        return $this->response->paginator($result, new TeamTransformer());
    }
}
