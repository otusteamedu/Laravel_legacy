<?php

namespace App\Http\Controllers\Groups\Requests;

class UpdateGroupRequest extends GroupRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'number' => ['integer', 'min:1'],
            'course_id' => ['integer', 'min:1'],
            'education_year_id' => ['string', 'max:255'],
        ];
    }
}
