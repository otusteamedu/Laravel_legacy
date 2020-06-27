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
            'number' => ['required', 'integer', 'min:1'],
            'course_id' => ['required', 'integer', 'min:1'],
            'education_year_id' => ['required', 'string', 'max:255'],
        ];
    }
}
