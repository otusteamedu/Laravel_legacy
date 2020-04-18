<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreNewsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        
        return [
            'title' => 'required|min:6',
            'text' => 'min:10',
            'meta_title'=>'present',
            'meta_description'=>'present',
            //'file_id'=>'integer'
        ];
    }

    public function getFormArray(){
        $result = $this->request->all();
        return $result;
    }
}
