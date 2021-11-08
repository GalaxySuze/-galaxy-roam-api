<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function index()
    {
        $data = Team::getData();
        return $this->response->array($data->toArray());
    }
}
