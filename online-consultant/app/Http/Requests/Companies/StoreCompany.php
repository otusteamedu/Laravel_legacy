<?php

namespace App\Http\Requests\Companies;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompany extends FormRequest
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
            'name'                    => 'required|unique:companies',
            'email'                   => 'required|email|unique:users',
            'url'                     => 'required|unique:companies',
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
