<?php

namespace App\Http\Controllers\Posts\Requests;

class IndexPostRequest extends PostRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => ['nullable', 'string', 'min:1'],
            'groups' => ['array'],
            'groups.*' => ['integer'],
            'published' => ['nullable', 'bool'],
        ];
    }
}
