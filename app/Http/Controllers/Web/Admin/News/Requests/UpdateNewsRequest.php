<?php

namespace App\Http\Controllers\Web\Admin\News\Requests;


use Auth;
use App\Http\Requests\FormRequest;

/**
 * Class UpdateNewsRequest
 * @package App\Http\Controllers\Web\Admin\News\Requests
 */
class UpdateNewsRequest extends FormRequest
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
            'name' => 'required|unique:news,name,' . $this->news->id . '|max:100',
            'description' => 'required|max:60000',
        ];
    }

    public function getFormData()
    {
        $data = parent::getFormData();
        $data['updated_news_id'] = Auth::id(); //@ToDo добавить поле updated_news_id в миграцию

        return $data;
    }
}
