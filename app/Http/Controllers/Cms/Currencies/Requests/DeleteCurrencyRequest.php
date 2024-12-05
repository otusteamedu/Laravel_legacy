<?php
/**
 * Description of DeleteCurrencyRequest.php
 */

namespace App\Http\Controllers\Cms\Currencies\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class DeleteCurrencyRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|numeric',
        ];
    }

}
