<?php

namespace App\Http\Controllers\Students\Requests;

class IndexStudentRequest extends StudentRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'last_name' => ['nullable', 'string', 'max:255'],
            'course' => ['nullable', 'integer', 'min:1'],
            'group' => ['nullable', 'integer', 'min:1'],
            'id_number' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
