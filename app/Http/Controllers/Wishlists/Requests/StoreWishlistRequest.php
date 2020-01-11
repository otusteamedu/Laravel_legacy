<?php

namespace App\Http\Controllers\Wishlists\Requests;

use App\Http\Requests\FormRequest;
use Auth;


class StoreWishlistRequest extends FormRequest
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
     * @return array
     */

    public function rules()
    {
        return [
            'name' => 'required'
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

        $data['user_id'] = Auth::id();

        return $data;
    }
}