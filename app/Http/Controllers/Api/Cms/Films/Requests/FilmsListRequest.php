<?php
namespace App\Http\Controllers\Api\Cms\Films\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilmsListRequest extends FormRequest
{

    const MAX_PER_PAGE = 25;

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
