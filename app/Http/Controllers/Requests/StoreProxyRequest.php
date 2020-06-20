<?php
namespace App\Http\Controllers\Requests;

use Auth;
use App\Http\Requests\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class StoreProxyRequest extends FormRequest
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
            'ip' => 'required|regex:/^(?:[0-9]{1,3}\.){3}[0-9]{1,3}$/i',
            'type' => [
                'required',
                Rule::in(['http', 'socks5'])
            ],
            'port' => 'required|integer',
            'login' => 'nullable',
            'password' => 'nullable',
        ];
    }

    protected function formatErrors(Validator $validator)
    {
        return $validator->errors()->all();
    }
}
