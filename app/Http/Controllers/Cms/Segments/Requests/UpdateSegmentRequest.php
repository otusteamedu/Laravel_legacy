<?php


namespace App\Http\Controllers\Cms\Segments\Requests;


class UpdateSegmentRequest extends StoreSegmentRequest
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
}
