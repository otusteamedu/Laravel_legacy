<?php

namespace App\Http\Controllers\API\Cms\OrderStatus\Requests;

use App\Http\Requests\FormRequest;

class UpdateRequest extends FormRequest
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
        $id = $this->route('order_status');

        return [
            'title' => 'bail|required|unique:order_statuses,title,' . $id . '|min:' . config('validation.title.min') . '|max:' . config('validation.title.max'),
            'alias' => 'bail|required|unique:order_statuses,alias,' . $id . '|min:' . config('validation.alias.min') . '|max:' . config('validation.alias.max') . '|regex:' . config('validation.alias.pattern'),
            'order' => 'bail|integer|nullable',
            'publish' => 'bail|required|integer',
            'description' => 'max:' . config('validation.description.max'),
        ];
    }
}
