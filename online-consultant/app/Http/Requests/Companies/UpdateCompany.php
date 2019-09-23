<?php

namespace App\Http\Requests\Companies;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCompany extends FormRequest
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
        $company_id = $this->route()->parameter('company');
        
        return [
            'name'                    => [
                'required',
                Rule::unique('companies')->ignore($company_id)
            ],
            'email'                   => [
                'required',
                'email',
                Rule::unique('companies', 'email')->ignore($company_id)
            ],
            'url'                     => [
                'required',
                Rule::unique('companies')->ignore($company_id)
            ],
            'address.country'         => 'required',
            'address.city'            => 'required',
            'address.postcode'        => 'required|max:6',
            'address.street'          => 'required',
            'address.building_number' => 'required'
        ];
    }
    
    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => __('admin.companies.fields.name')
        ];
    }
}
