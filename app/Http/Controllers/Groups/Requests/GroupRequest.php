<?php

namespace App\Http\Controllers\Groups\Requests;

use App\Http\Requests\BaseFormRequest;

class GroupRequest extends BaseFormRequest
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
            'course.integer' => __('validation.course_integer'),
            'year.integer' => __('validation.year_integer'),
            'number.required' => __('validation.group_number_required'),
            'number.integer' => __('validation.group_integer'),
        ];
    }
}
