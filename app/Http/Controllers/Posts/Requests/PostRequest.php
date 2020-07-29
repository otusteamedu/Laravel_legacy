<?php

namespace App\Http\Controllers\Posts\Requests;

use App\Http\Requests\BaseFormRequest;

class PostRequest extends BaseFormRequest
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
            'number.min' => __('validation.group_min'),
            'number.max' => __('validation.group_max'),
            'course.integer' => __('validation.course_integer'),
            'year.integer' => __('validation.year_integer'),
            'number.required' => __('validation.group_number_required'),
            'number.integer' => __('validation.group_integer'),
            'teacher.max' => __('validation.last_name_max'),
        ];
    }
}
