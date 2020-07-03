<?php

namespace App\Http\Controllers\Teachers\Requests;

use App\Models\User;

class StoreTeacherRequest extends TeacherRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'last_name' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'second_name' => ['nullable', 'string', 'max:255'],
            'subject_id.*' => ['integer', 'min:1'],
            'subject_id' => ['array'],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:' . User::class,
            ],
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return array_merge(
            [
                'last_name.required' => __('validation.last_name_required'),
                'name.required' => __('validation.name_required'),
            ],
            parent::messages()
        );
    }
}
