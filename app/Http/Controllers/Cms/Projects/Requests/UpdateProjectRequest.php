<?php


namespace App\Http\Controllers\Cms\Projects\Requests;


class UpdateProjectRequest extends StoreProjectRequest
{
    /**
     * Determine if the Project is authorized to make this request.
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
            'description' => '',
            'contact_data' => '',
        ];
    }
}
