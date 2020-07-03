<?php

namespace App\Http\Controllers\Teachers\Requests;

use App\Http\Requests\BaseFormRequest;

class TeacherRequest extends BaseFormRequest
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
     * @return array
     */
    public function messages(): array
    {
        return [
            'last_name.max' => __('validation.last_name_max'),
            'email.max' => __('validation.email_max'),
            'name.max' => __('validation.name_max'),
            'second_name.max' => __('validation.second_name_max'),
            'email.email' => __('validation.email'),
            'email.unique' => __('validation.email_unique'),
        ];
    }
}
