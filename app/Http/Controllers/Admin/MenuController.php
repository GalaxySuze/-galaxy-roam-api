<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends BaseController
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
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @return \Dingo\Api\Http\Response
     */
    public function getMenusData()
    {
        $menusData = Menu::get([
            'id',
            'parent_id',
            'title',
            'icon',
            'url',
        ])->toArray();
        return $this->response->array(
            $this->getTree($menusData, 0)
        );
    }

    /**
     * @param $data
     * @param $parentId
     * @return array
     */
    public function getTree($data, $parentId): array
    {
        $list = [];
        foreach ($data as $v) {
            if ($v['parent_id'] == $parentId) {
                $v['children'] = $this->getTree($data, $v['id']);
                $list[] = $v;
            }
        }
        return $list;
    }
}
