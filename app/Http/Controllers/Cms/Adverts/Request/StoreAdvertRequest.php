<?php


namespace App\Http\Controllers\Cms\Adverts\Request;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class StoreAdvertRequest extends FormRequest
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

    public function rules()
    {
        return [
            'title' => 'required|max:100',  //unique:divisions,name|
            'town_id' => 'required',
            'division_id' => 'required',
            'price' => 'required',
        ];
    }

    public function getFormData()
    {
        $data = $this->request->all();

        $data = Arr::except($data, ['_token',]);
        $data['user_id'] = Auth::id();
        $data['img'] = 'img/default.jpg';
        return $data;
    }

}
