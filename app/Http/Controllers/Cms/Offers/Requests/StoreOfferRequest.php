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

        $image = $this->file('teaser_image');
        $input['teaser_image'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/uploads');

        $image->move($destinationPath, $input['teaser_image']);

        // make db entry of that image
        $image = new \App\Models\Image;
        $image->org_path = 'uploads' . DIRECTORY_SEPARATOR . $input['teaser_image'];

        $image->save();

        // defer the processing of the image thumbnails
        ProcessImageThumbnails::dispatch($image);

        return $data;
    }

    /**
     * Upload Image
     *
     * @param  Request  $request
     * @return Response
     */
    public function upload(Request $request)
    {
        // upload image
        $this->validate($request, [
            'demo_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $image = $request->file('demo_image');
        $input['demo_image'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $input['demo_image']);

        // make db entry of that image
        $image = new Image;
        $image->org_path = 'images' . DIRECTORY_SEPARATOR . $input['demo_image'];
        $image->save();

        // defer the processing of the image thumbnails
        ProcessImageThumbnails::dispatch($image);

        return Redirect::to('image/index')->with('message', 'Image uploaded successfully!');
    }
}
