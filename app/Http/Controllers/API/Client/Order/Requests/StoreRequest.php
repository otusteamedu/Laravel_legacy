<?php

namespace App\Http\Controllers\API\Client\Order\Requests;

use App\Http\Requests\FormRequest;

class StoreRequest extends FormRequest
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
            'user_id' => 'bail|integer|exists:users,id|nullable',
            'items' => 'bail|required|json',
            'delivery' => 'bail|required|json',
            'customer' => 'bail|required|json',
            'comment' => 'string|nullable|max:' . config('validation.text.max')
        ];
    }
}
