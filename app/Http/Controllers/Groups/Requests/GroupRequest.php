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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'group' => ['nullable', 'integer', 'min:1'],
            'course' => ['nullable', 'integer', 'min:1'],
            'year' => ['nullable', 'string', 'max:255'],
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'group.integer' => __('validation.group_integer'),
            'course.integer' => __('validation.course_integer'),
            'year.integer' => __('validation.year_integer'),
        ];
    }
}
