<?php

namespace App\Http\Controllers\Api\Cms\Films\Requests;

use App\Http\Requests\FormRequest;

class StoreFilmRequest extends FormRequest
{

    public function rules()
    {
        return [
            'title' => 'required|unique:films,title|max:100',
            'slug' => 'required|unique:films,slug|max:100',
            'status'=>'required|integer|min:0|max:1',
            'year'=>'required|integer|min:4',
        ];
    }

}
