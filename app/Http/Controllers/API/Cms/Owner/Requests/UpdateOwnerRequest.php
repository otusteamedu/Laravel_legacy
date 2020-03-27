<?php

namespace App\Http\Controllers\API\Cms\Owner\Requests;

use App\Http\Requests\FormRequest;

class UpdateOwnerRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('id');

        return [
            'title' => 'bail|required|unique:owners,title,' . $id . '|min:' . config('validation.title.min') . '|max:' . config('validation.title.max'),
            'publish' => 'bail|required|integer',
            'description' => 'max:' . config('validation.description.max')
        ];
    }
}
