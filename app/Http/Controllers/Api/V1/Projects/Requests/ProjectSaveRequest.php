<?php

namespace App\Http\Controllers\Api\V1\Projects\Requests;

use App\Http\Requests\FormRequest;

class ProjectSaveRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }

}
