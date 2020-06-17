<?php

namespace App\Http\Controllers\Api\Events\Requests;


use Auth;
use App\Http\Requests\FormRequest;

/**
 * Class StoreEventRequest
 * @package App\Http\Controllers\Api\Events\Requests
 */
class StoreEventRequest extends FormRequest
{
    /**
     * Determine if the event is authorized to make this request.
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
            'country_id' => 'exists:App\Models\Country,id',
            'region' => 'required',
            'locality' => 'required',
            'lat' => 'required',
            'long' => 'required',
            'author_id' => 'exists:App\Models\User,id',
            'type_id' => 'exists:App\Models\EventType,id',
            'description' => 'required',
        ];
    }

    public function getFormData()
    {
        $data = parent::getFormData();

        return $data;
    }
}
