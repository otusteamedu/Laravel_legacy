<?php

namespace App\Http\Controllers\Cms\Categories\Requests;

use App\Http\Controllers\Cms\CmsFormRequest;

class StoreCategoryRequest extends CmsFormRequest
{

    public function rules()
    {
        return [
            //'data_ru_name' => 'required',
            'url' => 'required',
        ];
    }

}
