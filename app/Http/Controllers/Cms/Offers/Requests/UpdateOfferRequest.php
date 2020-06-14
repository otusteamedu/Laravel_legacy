<?php


namespace App\Http\Controllers\Cms\Offers\Requests;


class UpdateOfferRequest extends StoreOfferRequest
{
    /**
     * Determine if the Offer is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:100',
            'description' => '',
            'teaser_image' => '',
            'expiration_date' => '',
            'lat' => '',
            'lon' => '',
        ];
    }

}
