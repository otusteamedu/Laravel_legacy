<?php

namespace App\Http\Controllers\Admin\Pages\Requests;


use App\Http\Requests\FormRequest;

class UpdatePageRequest extends FormRequest
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
            'title' => 'required',
            'slug' => 'required',
        ];
    }



}
