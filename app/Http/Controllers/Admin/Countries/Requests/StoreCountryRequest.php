<?php
namespace App\Http\Controllers\Admin\Countries\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class StoreCountryRequest extends FormRequest
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
            'name' => 'required|unique:countries,name|max:100',
        ];
    }

    /**
     * @return array
     */
    public function getFormData()
    {
        $data = $this->request->all();

        $data = Arr::except($data, [
            '_token',
        ]);
        $data['created_by_user_id'] = Auth::id();

        return $data;
    }

}