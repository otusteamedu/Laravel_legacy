<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class UpdateNewsRequest extends FormRequest
{

    const NAME_FILE_FIELD = 'file';
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

    public function getFormArray(UploadedFile $requestFile = null){
        $result = $this->request->all();

        if($requestFile){
            $fileName = $requestFile->getClientOriginalName();
            $result = array_merge($result, [self::NAME_FILE_FIELD=>$fileName]);
        }
        
        return $result;
    }
}
