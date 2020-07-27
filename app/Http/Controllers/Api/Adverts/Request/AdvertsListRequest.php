<?php


namespace App\Http\Controllers\Api\Adverts\Request;


use Illuminate\Foundation\Http\FormRequest;

class AdvertsListRequest extends FormRequest
{

    const MAX_PER_PAGE = 10;

    public function rules()
    {
        return [
            'limit' => 'nullable|integer|min:1|max:'.self::MAX_PER_PAGE,
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
