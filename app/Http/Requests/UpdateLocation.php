<?php

namespace App\Http\Requests;

use App\Models\Location;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class UpdateLocation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // TODO
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request, Location $location)
    {
        return [
            'user_id' => [
                'required',
                'gt:0',
                'exists:users,id',
            ],
            'name' => [
                'required',
                'max:255',
                // TODO Валидировать составной unique
            ],
            'distance' => [
                'required',
                'integer',
                'between:1,999999',
            ],
        ];
    }
}
