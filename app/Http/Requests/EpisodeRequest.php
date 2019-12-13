<?php

namespace App\Http\Requests;

use App\Models\Podcast;
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

    /**
     * Проверим доступ к выбранному в выпадающем списке подкасту
     *
     * @return bool
     */
    public function authorize()
    {
        $podcastId = $this->get('podcast_id');
        // Пользователь что-то выбирает в выпадающем списке подкастов (выбирает подкаст для данного эпизода)
        // это должен быть существующий подкаст
        // и у пользователя должен быть доступ к этому подкасту
        $podcast = Podcast::find($podcastId);
        return $podcast && $this->user()->can('access', $podcast);
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
