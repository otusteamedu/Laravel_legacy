<?php


namespace App\Http\Controllers\Cms\Countries\Requests;


class UpdateCountryRequest extends StoreCountryRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

}
