<?php

namespace App\Http\Controllers\Teachers\Requests;

use App\Models\User;

class UpdateTeacherRequest extends TeacherRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'last_name' => ['string', 'max:255'],
            'name' => ['string', 'max:255'],
            'second_name' => ['nullable', 'string', 'max:255'],
            'subject_id.*' => ['integer', 'min:1'],
            'subject_id' => ['array'],
            'email' => [
                'email',
                'max:255',
                'unique:' . User::class . ',email,' . $this->teacher->id,
            ],
        ];
    }
}
