<?php

namespace App\Http\Controllers\Groups\Requests;

class StoreGroupRequest extends GroupRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'group' => ['required', 'integer', 'min:1'],
            'course' => ['required', 'integer', 'min:1'],
            'year' => ['required', 'string', 'max:255'],
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return array_merge(
            [
                'group.required' => __('validation.group_required'),
            ],
            parent::messages()
        );
    }
}
