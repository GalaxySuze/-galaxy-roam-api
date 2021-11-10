<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\AddCategoryRequest;
use App\Http\Requests\Admin\AddUserRequest;
use App\Http\Requests\Admin\EditUserRequest;
use App\Models\Category;
use App\Models\User;
use App\Transformers\CategoryTransformer;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;

class CategoryController extends BaseController
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
     * @param AddCategoryRequest $request
     * @return \Dingo\Api\Http\Response|object
     */
    public function store(AddCategoryRequest $request)
    {
        $result = Category::create([
            'title' => $request->get('title'),
        ]);
        return $this->response->item($result, new CategoryTransformer())->setStatusCode(201);
    }

    /**
     * @param $id
     */
    public function show($id)
    {
        //
    }

    /**
     * @param AddCategoryRequest $request
     * @param $id
     * @return \Dingo\Api\Http\Response
     */
    public function update(AddCategoryRequest $request, $id)
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
        Category::where('id', $id)->delete();
        return $this->response->noContent()->setStatusCode(200);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function list(Request $request)
    {
        $title = $request->get('title');
        $pageSize = $request->get('pageSize');
        $result = Category::when(!empty($title), function ($query) use ($title) {
            $query->where('title', 'like', "%$title%");
        })->orderBy('created_at', 'desc')->paginate($pageSize);

        return $this->response->paginator($result, new CategoryTransformer());
    }
}
