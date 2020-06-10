<?php

namespace App\Http\Controllers\Admin\Requests;


use App\Http\Requests\FormRequest;

class UpdateArticleRequest extends StoreArticleRequest
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

    public function getFormData()
    {
        $data = parent::getFormData();
        unset($data['user_id']);

        return $data;
    }
}
