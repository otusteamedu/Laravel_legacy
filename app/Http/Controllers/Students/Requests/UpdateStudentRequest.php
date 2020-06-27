<?php

namespace App\Http\Controllers\Students\Requests;

use App\Models\Student;
use Closure;

class UpdateStudentRequest extends StudentRequest
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
            'group_id.*' => ['integer', 'min:1'],
            'id_number' => [
                'integer',
                'min:0',
                /** Проверка уникальности по действующим студенческим номерам */
                function (string $attribute, int $value, Closure $fail): void {
                    if (Student::whereIdNumber($value)
                        ->where('id', '!=', $this->route()->student->id)
                        ->exists()) {
                        $fail(__('validation.id_number_unique'));
                    }
                },
            ],
        ];
    }
}
