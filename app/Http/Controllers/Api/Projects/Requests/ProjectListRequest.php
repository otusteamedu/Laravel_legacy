<?php

namespace App\Http\Controllers\Api\Projects\Requests;

use App\Http\Requests\FormRequest;

class ProjectListRequest extends FormRequest
{

    const MAX_PER_PAGE = 20;

    public function rules()
    {
        return [
            'limit' => 'nullable|integer|min:1|max:' . self::MAX_PER_PAGE,
            'offset' => 'nullable|integer|min:0',
        ];
    }

    public function getLimit(): int
    {
        return $this->request->get('limit', self::MAX_PER_PAGE);
    }

    public function getOffset(): int
    {
        return $this->request->get('offset', 0);
    }

}
