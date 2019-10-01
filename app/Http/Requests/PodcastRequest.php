<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PodcastRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }

    protected function prepareForValidation()
    {
        // Приводим числовые параметры к int или null, если было пусто (или не вадиное число)
        $categoryItunesId = (int)$this->get('category_itunes_id') ?: null;

        $this->merge([
            'category_itunes_id' => $categoryItunesId,
        ]);
    }
}
