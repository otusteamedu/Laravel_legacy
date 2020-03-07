<?php

namespace App\Http\Controllers\Web\Admin\News\Requests;


use Auth;
use App\Http\Requests\FormRequest;

/**
 * Class StoreNewsRequest
 * @package App\Http\Controllers\Web\Admin\News\Requests
 */
class StoreNewsRequest extends FormRequest
{
    /**
     * Determine if the news is authorized to make this request.
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
            'name' => 'required|unique:news,name|max:100',
            'description' => 'required|max:60000',
        ];
    }

    public function getFormData()
    {
        $data = parent::getFormData();
        $data['created_news_id'] = Auth::id();

        return $data;
    }
}
