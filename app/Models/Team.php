<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends BaseModel
{
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * @return mixed
     */
    public static function getData()
    {
        $data = Team::paginate(1);
        return $data;
    }
}
