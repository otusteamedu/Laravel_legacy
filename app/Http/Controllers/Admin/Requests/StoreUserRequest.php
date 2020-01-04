<?php

namespace App\Http\Controllers\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreUserRequest
 * @package App\Http\Controllers\Admin\Requests
 */
class StoreUserRequest extends FormRequest
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
            'username' => 'required',
            'email' => 'email',
            'role_id' => 'integer|required',
        ];
    }
}
