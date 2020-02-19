<?php

namespace App\Http\Controllers\Products\Request;


use App\Http\Requests\FormRequest;

class ProductsRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_name' => 'required|max:255',
            'wishlist_id' => 'required|numeric',
        ];
    }

    /**
     * @return array
     */

    public function getFormData()
    {
        $data = $this->request->all();

        $data = \Arr::except($data, [
            '_token',
        ]);

        return $data;
    }
}
