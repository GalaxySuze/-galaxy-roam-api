<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\AddCategoryRequest;
use App\Http\Requests\Admin\AddTagRequest;
use App\Models\Category;
use App\Models\Tag;
use App\Transformers\CategoryTransformer;
use App\Transformers\TagTransformer;
use Illuminate\Http\Request;

class TagController extends BaseController
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
     * @param AddTagRequest $request
     * @return \Dingo\Api\Http\Response|object
     */
    public function store(AddTagRequest $request)
    {
        $result = Tag::create([
            'tag' => $request->get('tag'),
        ]);
        return $this->response->item($result, new TagTransformer())->setStatusCode(201);
    }

    /**
     * @param $id
     */
    public function show($id)
    {
        //
    }

    /**
     * @param AddTagRequest $request
     * @param $id
     * @return \Dingo\Api\Http\Response
     */
    public function update(AddTagRequest $request, $id)
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
        Tag::where('id', $id)->delete();
        return $this->response->noContent()->setStatusCode(200);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function list(Request $request)
    {
        $tag = $request->get('tag');
        $pageSize = $request->get('pageSize');
        $result = Tag::when(!empty($tag), function ($query) use ($tag) {
            $query->where('tag', 'like', "%$tag%");
        })->orderBy('created_at', 'desc')->paginate($pageSize);

        return $this->response->paginator($result, new TagTransformer());
    }
}
