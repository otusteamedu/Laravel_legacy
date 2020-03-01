<?php

namespace App\Http\Controllers\Web\Admin\Users\Requests;


use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

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
        ];
    }

    public function getFormData()
    {
        $data = $this->request->all();

        $data = Arr::except($data, [
            '_token',
        ]);
        $data['created_user_id'] = Auth::id();

        return $data;
    }

}
