<?php

namespace App\Http\Requests\Conversations;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StoreConversation extends FormRequest
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
     * @param  Request  $request
     *
     * @return array
     */
    public function rules(Request $request): array
    {
        $company_id = $request->company_id;
        
        return [
            'text'       => 'required',
            'company_id' => 'required|exists:companies,id',
            'widget_id'  => [
                'required',
                Rule::exists('widgets', 'id')->where('company_id', $company_id)
            ],
            'manager_id' => [
                'required',
                Rule::exists('users', 'id')->where('company_id', $company_id)
            ],
            'lead_id'    => [
                'required',
                Rule::exists('leads', 'id')->where('company_id', $company_id)
            ]
        ];
    }
}
