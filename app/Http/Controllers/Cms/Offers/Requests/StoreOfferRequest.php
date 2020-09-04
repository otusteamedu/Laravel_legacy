<?php


namespace App\Http\Controllers\Cms\Offers\Requests;


use App\Jobs\ProcessImageThumbnails;
use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Intervention\Image\Image;


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

    /**
     * Upload Image
     *
     * @param Request $httpRequest
     * @return array
     */
        public function getFormData()
    {
        $data = $this->request->all();

        $data = Arr::except($data, [
            '_token',
        ]);
        $data['created_offer_id'] = Auth::id();
        $data['user_id'] = Auth::user()->id;
        if (!is_null($this->file('teaser_image')))
            $data['teaser_image'] = $this->file('teaser_image')->store('uploads', 'public');

        return $data;
    }
}
