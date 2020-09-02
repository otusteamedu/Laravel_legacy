<?php

namespace App\Http\Controllers\Api\Cms\Films\Requests;


use App\Http\Requests\FormRequest;

class UpdateFilmRequest extends FormRequest
{

    public function rules()
    {
        return [
            'title' => 'required',
            'slug' => 'required',
        ];
    }



}
