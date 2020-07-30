<?php
/**
 * Description of CountriesListRequest.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Http\Controllers\Api\Countries\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CountriesListRequest extends FormRequest
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
