<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\AddSiteTeamRequest;
use App\Http\Requests\Admin\AddTeamRequest;
use App\Http\Requests\Admin\EditSiteRequest;
use App\Http\Requests\Admin\EditTeamRequest;
use App\Models\Category;
use App\Models\Site;
use App\Models\Tag;
use App\Models\Team;
use App\Transformers\SiteTransformer;
use App\Transformers\TeamTransformer;
use Illuminate\Http\Request;

class SiteController extends BaseController
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
    public function store(AddSiteTeamRequest $request)
    {
        $result = Site::create([
            'category_id' => $request->get('category_id'),
            'tags_id'     => $request->get('tags_id'),
            'name'        => $request->get('name'),
            'desc'        => $request->get('desc'),
            'thumb'       => $request->get('thumb'),
            'url'         => $request->get('url'),
        ]);
        return $this->response->item($result, new SiteTransformer())->setStatusCode(201);
    }

    /**
     * @param $id
     * @return \Dingo\Api\Http\Response
     */
    public function show($id)
    {
        $result = Site::find($id);
        return $this->response->item($result, new SiteTransformer());
    }

    /**
     * @param EditSiteRequest $request
     * @param $id
     * @return \Dingo\Api\Http\Response
     */
    public function update(EditSiteRequest $request, $id)
    {
        $tags_id = implode(',', $request->get('tags_id'));
        Site::where('id', $id)
            ->update([
                'category_id' => $request->get('category_id'),
                'tags_id'     => $tags_id,
                'name'        => $request->get('name'),
                'desc'        => $request->get('desc'),
                'thumb'       => $request->get('thumb'),
                'url'         => $request->get('url'),
            ]);
        return $this->response->item(Site::find($id), new SiteTransformer());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Site::where('id', $id)->delete();
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
        $result = Site::leftJoin('categories', 'categories.id', '=', 'sites.category_id')
            ->when(!empty($name), function ($query) use ($name) {
                $query->where('categories.name', 'like', "%$name%");
            })->when(!empty($categoryId), function ($query) use ($categoryId) {
                $query->where('sites.category_id', $categoryId);
            })->when(!empty($tagsId), function ($query) use ($tagsId) {
                $query->whereRaw("FIND_IN_SET('$tagsId', sites.tags_id)");
            })->orderBy('sites.created_at', 'desc')
            ->select([
                'sites.*',
                'categories.title as category_name'
            ])->paginate($pageSize);

        return $this->response->paginator($result, new SiteTransformer());
    }

    /**
     * @return \Dingo\Api\Http\Response
     */
    public function getFormInitData()
    {
        $categoryData = Category::where('type', Category::TYPE_SITE)->get(['id', 'title'])->toArray();
        $tagData = Tag::get(['id', 'tag'])->toArray();
        $result = [
            'category' => $categoryData,
            'tag'      => $tagData,
        ];
        return $this->response->array($result);
    }
}
