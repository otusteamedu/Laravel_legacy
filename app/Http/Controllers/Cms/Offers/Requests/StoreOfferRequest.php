<?php


namespace App\Http\Controllers\Cms\Offers\Requests;


use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;


class StoreOfferRequest extends FormRequest
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

    public function getFormData()
    {
        $data = $this->request->all();

        $data = Arr::except($data, [
            '_token',
        ]);
        $data['created_offer_id'] = Auth::id();

        return $data;
    }

}
