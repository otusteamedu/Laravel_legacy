<?php

namespace App\Http\Controllers\API\Cms\Delivery\Requests;

use App\Http\Requests\FormRequest;

class CreateDeliveryRequest extends FormRequest
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
        return [
            'title' => 'bail|required|unique:deliveries,title|min:' . config('validation.title.min') . '|max:' . config('validation.title.max'),
            'alias' => 'bail|required|unique:deliveries,alias|min:' . config('validation.alias.min') . '|max:' . config('validation.alias.max') . '|regex:' . config('validation.alias.pattern'),
            'cost' => 'bail|integer|nullable',
            'order' => 'bail|integer|nullable',
            'publish' => 'bail|required|integer',
            'description' => 'max:' . config('validation.description.max')
        ];
    }
}
