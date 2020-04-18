<?php
/**
 * Description of StoreCurrencyRequest.php
 */

namespace App\Http\Controllers\Common\Dashboard\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class StoreIncomeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'summ' => 'required|integer',
        ];
    }

}
