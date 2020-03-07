<?php

namespace App\Http\Controllers\Web\Admin\Articles\Requests;


use Auth;
use App\Http\Requests\FormRequest;

/**
 * Class StoreArticleRequest
 * @package App\Http\Controllers\Web\Admin\Articles\Requests
 */
class StoreArticleRequest extends FormRequest
{
    /**
     * Determine if the article is authorized to make this request.
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
            'name' => 'required|unique:articles,name|max:100',
            'description' => 'required|max:30000',
        ];
    }

    public function getFormData()
    {
        $data = parent::getFormData();
        $data['created_article_id'] = Auth::id();

        return $data;
    }
}
