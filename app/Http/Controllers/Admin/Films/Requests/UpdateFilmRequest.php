<?php

namespace App\Http\Controllers\Admin\Films\Requests;


use App\Http\Requests\FormRequest;

class UpdateFilmRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|unique:films,title|max:100',
            'slug' => 'required|unique:films,slug|max:100',
        ];
    }



}
