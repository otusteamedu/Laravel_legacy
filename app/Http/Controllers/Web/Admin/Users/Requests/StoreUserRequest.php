<?php

namespace App\Http\Controllers\Web\Admin\Users\Requests;


use Auth;
use App\Http\Requests\FormRequest;

/**
 * Class StoreUserRequest
 * @package App\Http\Controllers\Web\Admin\Users\Requests
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
            'name' => 'required:users,name',
            'password' => 'required:users,password',
        ];
    }

    public function getFormData()
    {
        $data = parent::getFormData();
        $data['created_user_id'] = Auth::id();

        return $data;
    }
}
