<?php

namespace App\Http\Controllers\Students\Requests;

use App\Models\Student;
use Closure;

class StoreStudentRequest extends StudentRequest
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
            'group_id.*' => ['required', 'integer', 'min:1'],
            'group_id' => ['required', 'array'],
            'id_number' => [
                'required',
                'integer',
                'min:0',
                /** Проверка уникальности по действующим студенческим номерам */
                function (string $attribute, int $value, Closure $fail): void {
                    if (Student::whereIdNumber($value)->exists()) {
                        $fail(__('validation.id_number_unique'));
                    }
                },
            ],
        ];
    }
}
