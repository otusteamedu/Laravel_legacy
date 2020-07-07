<?php

namespace App\Http\Controllers\Groups\Requests;

class IndexGroupRequest extends GroupRequest
{
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
            'teacher' => ['nullable', 'string', 'max:255'],
        ];
    }
}
