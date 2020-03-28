<?php


namespace App\Http\Controllers\Cms\Users\Requests;


use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;


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
            'name' => 'required|max:100',
            'email' => 'required|unique:users,email|max:100',
            'phone' => 'required|unique:users,phone|max:15',
            'password' => 'required',
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
