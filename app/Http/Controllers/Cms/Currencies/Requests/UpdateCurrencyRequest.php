<?php
/**
 * Description of UpdateCurrencyRequest.php
 */

namespace App\Http\Controllers\Cms\Currencies\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class UpdateCurrencyRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules()
    {
        $id = $this->request->get('id', 0);
        return [
            'code' => 'required|unique:currencies,code,' . $id . '|max:255',
        ];
    }

}
