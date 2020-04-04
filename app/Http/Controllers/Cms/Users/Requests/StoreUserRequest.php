<?php
namespace App\Http\Controllers\Cms\Users\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|unique:users,email|max:255',
            'name' => 'required|unique:users,name|max:255',
            'level' => 'required|integer',
        ];
    }

    /**
     * @return array
     */
    public function getFormData()
    {
        $data = $this->request->all();

        $data = Arr::except($data, [
            '_token',
        ]);

        return $data;
    }

}
