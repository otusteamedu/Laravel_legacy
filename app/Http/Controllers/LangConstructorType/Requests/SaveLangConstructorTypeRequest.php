<?php


namespace App\Http\Controllers\LangConstructorType\Requests;

use App\Http\Requests\FormRequest;


class SaveLangConstructorTypeRequest extends FormRequest
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
            'name' => 'required|string',
            'code' => 'required|string|regex:/^[a-zA-Z0-9\-\_]+$/u|unique:construction_types|max:255',
            'description' => 'required|string'
        ];
    }

    public function getFormData()
    {
        $data = $this->request->all();
        $data['created_account_id'] = auth()->user()->account->id;

        return $data;
    }

}
