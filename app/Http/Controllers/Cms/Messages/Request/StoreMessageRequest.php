<?php


namespace App\Http\Controllers\Cms\Messages\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Auth;

class StoreMessageRequest extends FormRequest
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
            'content' => 'required|max:100',  //unique:divisions,name|
        ];
    }

    public function getFormData()
    {
        $data = $this->request->all();

        $data = Arr::except($data, ['_token',]);
        $data['user_id'] = Auth::id();

        return $data;
    }

}
