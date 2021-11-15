<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Models\Site;
use App\Models\Team;
use Dingo\Api\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditSiteRequest extends BaseRequest
{
    /**
     * @param Request $request
     * @return array
     */
    public function rules(Request $request)
    {
        $siteModel = Site::find($request->get('id'));
        return [
            'category_id' => 'required',
            'tags_id'     => 'nullable',
            'name'        => [
                'required',
                Rule::unique('teams')->ignore($siteModel),
            ],
            'desc'        => 'nullable',
            'thumb'       => 'nullable',
            'url'         => 'required',
        ];
    }
}
