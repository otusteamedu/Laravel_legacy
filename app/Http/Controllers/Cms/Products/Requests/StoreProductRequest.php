<?php

namespace App\Http\Controllers\Cms\Products\Requests;

use App\Http\Controllers\Cms\CmsFormRequest;

class StoreProductRequest extends CmsFormRequest
{

    public function rules()
    {
        return [
            'price' => 'required',
            'quantity' => 'required',
        ];
    }

}
