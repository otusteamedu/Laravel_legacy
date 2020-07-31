<?php

namespace App\Http\Requests\Procedure;

use App\Http\Requests\FormRequest;

class StoreProcedureRequest extends FormRequest
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
            "business_id" => 'required|integer',
            "worker_id" => 'required|integer',
            "duration" => 'required|integer',
            "price" => 'required|numeric',
            "people_count" => 'required|numeric',
        ];
    }

    public function getFormData()
    {
        $data = parent::getFromData();

        return $data;
    }
}
