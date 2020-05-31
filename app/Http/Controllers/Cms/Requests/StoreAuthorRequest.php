<?php
namespace App\Http\Controllers\Cms\Requests;

use Auth;
use App\Http\Requests\FormRequest;
use Illuminate\Validation\Validator;
use Illuminate\Support\Arr;

class StoreAuthorRequest extends FormRequest
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
            'name' => 'required|max:100',
            'photo' => 'nullable|image'
        ];
    }

    protected function formatErrors(Validator $validator)
    {
        return $validator->errors()->all();
    }
}
