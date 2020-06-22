<?php

namespace App\Http\Controllers\Api\Users\Requests;


use Auth;
use App\Http\Requests\FormRequest;

/**
 * Class StoreUserRequest
 * @package App\Http\Controllers\Api\Users\Requests
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

    public function rules()
    {
        return [
            'email' => 'required|unique:users,email|max:100',
            'phone' => 'required|unique:users,phone|max:30',
            'name' => 'required|max:255',
            'last_name' => 'required|string|max:255',
            'password' => 'required|min:8|confirmed',
            'country_id' => 'required|numeric|max:255',
            'picture_id' => 'numeric|max:255',
            'region' => 'required|string|max:255',
        ];
    }

    public function getFormData()
    {
        $data = parent::getFormData();

        return $data;
    }
}
