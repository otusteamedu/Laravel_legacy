<?php

namespace App\Http\Controllers\Web\Admin\Events\Requests;


use Auth;
use App\Http\Requests\FormRequest;

/**
 * Class StoreEventRequest
 * @package App\Http\Controllers\Web\Admin\Events\Requests
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
            'type_id' => 'required',
            'description' => 'required',
        ];
    }

    public function getFormData()
    {
        $data = parent::getFormData();
        $data['created_event_id'] = Auth::id(); // @ToDo: добавить в мирграцию поле с id создателя

        return $data;
    }
}
