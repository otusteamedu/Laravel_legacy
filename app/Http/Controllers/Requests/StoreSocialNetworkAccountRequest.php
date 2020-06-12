<?php
namespace App\Http\Controllers\Requests;

use App\Http\Requests\FormRequest;
use Illuminate\Validation\Validator;

class StoreSocialNetworkAccountRequest extends FormRequest
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
            'login' => 'nullable',
            'password' => 'nullable',
            'proxy_id' => 'exists:App\Models\Planner\PlannerSocialNetworkAccount,id',
        ];
    }

    protected function formatErrors(Validator $validator)
    {
        return $validator->errors()->all();
    }
}
