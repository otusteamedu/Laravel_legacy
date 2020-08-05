<?php

namespace App\Http\Requests\Procedure;

use App\Http\Requests\FormRequest;

/**
 * Правила при добавлении процедуры
 * Class StoreProcedureRequest
 * @package App\Http\Requests\Procedure
 */
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
            "duration" => 'required|integer|max:127',
            "price" => 'required|numeric',
            "people_count" => 'required|integer|max:127',
        ];
    }

    public function getFormData()
    {
        $data = parent::getFromData();

        return $data;
    }
}
