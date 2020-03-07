<?php

namespace App\Http\Controllers\Web\Admin\Articles\Requests;


use Auth;
use App\Http\Requests\FormRequest;

/**
 * Class UpdateArticleRequest
 * @package App\Http\Controllers\Web\Admin\Articles\Requests
 */
class UpdateArticleRequest extends FormRequest
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
            'name' => 'required|unique:articles,name,' . $this->article->id . '|max:100',
            'description' => 'required|max:30000',
        ];
    }

    public function getFormData()
    {
        $data = parent::getFormData();
        $data['updated_article_id'] = Auth::id(); //@ToDo добавить поле updated_article_id в миграцию

        return $data;
    }
}
