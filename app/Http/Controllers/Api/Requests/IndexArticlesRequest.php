<?php

namespace App\Http\Controllers\Api\Requests;


use App\Http\Requests\FormRequest;

class IndexArticlesRequest extends FormRequest
{

    const MIN_PAGE = 1;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'page' => 'required|integer|min:' . self::MIN_PAGE,
        ];
    }

    /**
     * @return array|string|null
     */
    public function getPage()
    {
        return $this->get('page', self::MIN_PAGE);
    }

    public function getFormData()
    {
        $data = parent::getFormData();

        return $data;
    }
}
