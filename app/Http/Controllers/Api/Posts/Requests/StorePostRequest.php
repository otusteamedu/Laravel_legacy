<?php

namespace App\Http\Controllers\Api\Posts\Requests;

use App\Http\Requests\BaseFormRequest;

class StorePostRequest extends BaseFormRequest
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
            'groups' => ['required', 'array', 'min:1', 'exists:groups,id'],
            'groups.*' => ['integer'],
        ];
    }
}
