<?php
namespace App\Http\Controllers\Cms\Users\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class UpdateUserRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules()
    {
        $id = $this->request->get('id', 0);
        return [
            'email' => 'required|unique:users,email,' . $id . '|max:255',
            'name' => 'required|unique:users,name,' . $id . '|max:255',
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
