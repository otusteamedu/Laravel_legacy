<?php


namespace App\Http\Controllers\Cms\Segments\Requests;


use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;


class StoreSegmentRequest extends FormRequest
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
            'name' => 'required|unique:segments,name|max:100',
            'condition' => 'required'
        ];
    }

    public function getFormData()
    {
        $data = $this->request->all();

        $data = Arr::except($data, [
            '_token',
        ]);
        $data['created_user_id'] = Auth::id();

        return $data;
    }

}
