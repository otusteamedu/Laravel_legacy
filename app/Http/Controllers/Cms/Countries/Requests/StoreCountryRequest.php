<?php
/**
 * Description of StoreCountryRequest.php
 */

namespace App\Http\Controllers\Cms\Countries\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class StoreCountryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:countries,name|max:255',
            'name_eng' => 'required|unique:countries,name_eng|max:255',
        ];
    }

}
