<?php


namespace App\Http\Controllers\Cms\Projects\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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

    public function getFormData()
    {
        $data = $this->request->all();

        $data = Arr::except($data, [
            '_token',
        ]);
        $data['user_id'] = Auth::user()->id;
        $data['created_project_id'] = Auth::id();
        $data['logo_path'] = $this->file('logo_path')->store('uploads', 'public');
        return $data;
    }
}
