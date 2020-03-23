<?php

namespace App\Http\Controllers\Web\Admin\Users\Requests;

use App\Http\Requests\FormRequest;


class StoreRoleRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required:users,name',
        ];
    }

    public function getFormData()
    {
        $data = parent::getFormData();

        return $data;
    }
}
