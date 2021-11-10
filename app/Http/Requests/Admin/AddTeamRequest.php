<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class AddTeamRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id'      => 'required',
            'tags_id'          => 'nullable',
            'name'             => 'required|unique:teams',
            'desc'             => 'nullable',
            'avatar'           => 'nullable',
            'homepage'         => 'nullable',
            'class_start_date' => 'nullable',
        ];
    }
}
