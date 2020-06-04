<?php

namespace App\Http\Requests;


use Carbon\Carbon;

class StoreUserRequest extends UpdateUserRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:100',
            'password' => 'required|min:6|confirmed',
        ];
    }

    public function getFormData()
    {
        $data = parent::getFormData();

        $data['created_at'] = Carbon::create()->subDay();
        $data['balance'] = 0;

        return $data;
    }
}
