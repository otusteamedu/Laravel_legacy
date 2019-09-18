<?php

namespace App\Http\Requests;

use App\Models\Workout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class WorkoutUpdateFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // @todo Авторизация (?)
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request, Workout $workout)
    {
        // @todo Дублирует код WorkoutStoreFormRequest
        // @todo Валидировать составной unique
        return [
            'user_id' => [
                'required',
                'exists:users,id',
            ],
            'name' => [
                'required',
                'max:255',
            ],
            'distance' => [
                'required',
                'integer',
                'between:1,999999',
            ],
            'started_at' => [
                'required',
                'date',
                'before:now',
            ],
            'duration' => [
                'required',
                'integer',
                'between:1,999999',
                // @todo Валидировать (started_at + duration < now)
            ],
            'location_id' => [
                'nullable',
                'exists:locations,id',
            ],
        ];
    }
}
