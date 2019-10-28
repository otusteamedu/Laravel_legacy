<?php

namespace App\Http\Requests\Leads;

use Illuminate\Foundation\Http\FormRequest;

class StoreLead extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'            => 'required',
            'email'           => 'required|email|unique:leads',
            'company_id'      => 'required|exists:companies,id',
            'created_user_id' => 'required|exists:users,id',
        ];
    }
}
