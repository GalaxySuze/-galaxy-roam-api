<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\AddTeamRequest;
use App\Http\Requests\Admin\AddUserRequest;
use App\Http\Requests\Admin\EditTeamRequest;
use App\Http\Requests\Admin\EditUserRequest;
use App\Models\Category;
use App\Models\Tag;
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
     * @return \Dingo\Api\Http\Response
     */
    public function show($id)
    {
        $result = Team::find($id);
        return $this->response->item($result, new TeamTransformer());
    }

    /**
     * @param EditTeamRequest $request
     * @param $id
     * @return \Dingo\Api\Http\Response
     */
    public function update(EditTeamRequest $request, $id)
    {
        $tags_id = implode(',', $request->get('tags_id'));
        Team::where('id', $id)
            ->update([
                'category_id'      => $request->get('category_id'),
                'tags_id'          => $tags_id,
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
        $result = Team::leftJoin('categories', 'categories.id', '=', 'teams.category_id')
            ->when(!empty($name), function ($query) use ($name) {
                $query->where('teams.name', 'like', "%$name%");
            })->when(!empty($categoryId), function ($query) use ($categoryId) {
                $query->where('teams.category_id', $categoryId);
            })->when(!empty($tagsId), function ($query) use ($tagsId) {
                $query->whereRaw("FIND_IN_SET('$tagsId', teams.tags_id)");
            })->orderBy('teams.created_at', 'desc')
            ->select([
                'teams.*',
                'categories.title as category_name'
            ])->paginate($pageSize);

        return $this->response->paginator($result, new TeamTransformer());
    }

    /**
     * @return \Dingo\Api\Http\Response
     */
    public function getFormInitData()
    {
        $categoryData = Category::where('type', Category::TYPE_TEAM)->get(['id', 'title'])->toArray();
        $tagData = Tag::get(['id', 'tag'])->toArray();
        $result = [
            'category' => $categoryData,
            'tag'      => $tagData,
        ];
        return $this->response->array($result);
    }
}
