<?php
/**
 * Description of StoreCountryRequest.php
 */

namespace App\Http\Controllers\Cms\Countries\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class UpdateCountryRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules()
    {
        $id = $this->request->get('id', 0);
        return [
            'name' => 'required|unique:countries,name,' . $id . '|max:255',
            'name_eng' => 'required|unique:countries,name_eng,' . $id . '|max:255',
        ];
    }

}
