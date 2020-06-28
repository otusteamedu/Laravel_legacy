<?php

namespace App\Http\Controllers\Students\Requests;

use App\Http\Requests\BaseFormRequest;

class StudentRequest extends BaseFormRequest
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
            'group.integer' => __('validation.group_integer'),
            'course.integer' => __('validation.course_integer'),
            'id_number.integer' => __('validation.id_number_integer'),
            'last_name.max' => __('validation.last_name_max'),
            'name.max' => __('validation.name_max'),
            'second_name.max' => __('validation.second_name_max'),
            'last_name.required' => __('validation.last_name_required'),
            'name.required' => __('validation.name_required'),
            'group_id.required' => __('validation.group_number_required'),
            'id_number.required' => __('validation.id_number_required'),
        ];
    }
}
