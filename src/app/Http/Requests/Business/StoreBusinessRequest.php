<?php

namespace App\Http\Requests\Business;

use App\Http\Requests\FormRequest;

/**
 * Правила при добавлении записи
 * Class StoreBusinessRequest
 * @package App\Http\Requests\Business
 */
class StoreBusinessRequest extends FormRequest
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
            "name" => 'required|string|max:150',
            "type_id" => 'required|integer',
        ];
    }

    public function getFormData()
    {
        $data = parent::getFromData();
        return $data;
    }
}
