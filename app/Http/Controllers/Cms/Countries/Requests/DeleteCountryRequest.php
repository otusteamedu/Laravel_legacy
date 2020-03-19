<?php
/**
 * Description of DeleteCountryRequest.php
 */

namespace App\Http\Controllers\Cms\Countries\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class DeleteCountryRequest extends FormRequest
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
