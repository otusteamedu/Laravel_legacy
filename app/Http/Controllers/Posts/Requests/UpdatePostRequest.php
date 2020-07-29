<?php

namespace App\Http\Controllers\Posts\Requests;

class UpdatePostRequest extends PostRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'nullable', 'string', 'min:1'],
            'body' => ['required', 'nullable', 'string', 'min:1'],
            'groups' => ['required', 'array', 'min:1'],
            'groups.*' => ['integer'],
        ];
    }
}
