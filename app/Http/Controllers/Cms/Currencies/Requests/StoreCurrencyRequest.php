<?php
/**
 * Description of StoreCurrencyRequest.php
 */

namespace App\Http\Controllers\Cms\Currencies\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class StoreCurrencyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => 'required|unique:currencies,code|max:255',
        ];
    }

}
