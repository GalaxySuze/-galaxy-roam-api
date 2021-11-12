<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Models\Team;
use Dingo\Api\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditTeamRequest extends BaseRequest
{
    /**
     * @param Request $request
     * @return array
     */
    public function rules(Request $request)
    {
        $teamModel = Team::find($request->get('id'));
        return [
            'category_id'      => 'required',
            'tags_id'          => 'nullable',
            'name'             => [
                'required',
                Rule::unique('teams')->ignore($teamModel),
            ],
            'desc'             => 'nullable',
            'avatar'           => 'nullable',
            'homepage'         => 'nullable',
            'class_start_date' => 'nullable',
        ];
    }
}
