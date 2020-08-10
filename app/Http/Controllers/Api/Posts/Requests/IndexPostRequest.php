<?php

namespace App\Http\Controllers\Api\Posts\Requests;

use App\Http\Requests\BaseFormRequest;
use App\Services\Helpers\Settings;

class IndexPostRequest extends BaseFormRequest
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
            'groups' => ['array', 'min:1'],
            'groups.*' => ['integer', 'exists:groups,id'],
            'published' => ['nullable', 'bool'],
            'limit' => ['integer', 'min:1', 'max:' . Settings::PER_PAGE],
        ];
    }
}
