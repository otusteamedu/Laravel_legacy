<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EpisodeRequest extends FormRequest
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
            'podcast_id' => 'required|integer',
        ];
    }

    protected function prepareForValidation()
    {
        // Приводим числовые параметры к int или null, если было пусто (или не вадиное число)
        $season = (int)$this->get('season') ?: null;
        $no = (int)$this->get('no') ?: null;

        $this->merge([
            'season' => $season,
            'no' => $no,
        ]);
    }
}
