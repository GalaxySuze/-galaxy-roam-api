<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends BaseModel
{
    protected $guarded = [
        'created_at', 'updated_at'
    ];

    public static function getData()
    {

    }
}
