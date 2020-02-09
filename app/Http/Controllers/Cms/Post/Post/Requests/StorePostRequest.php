<?php

namespace App\Http\Controllers\Cms\Post\Post\Requests;

use Arr;
use Illuminate\Foundation\Http\FormRequest;
use Str;
use Auth;

/**
 * Class StorePostRequest
 * @package App\Http\Controllers\Cms\Post\Requests
 */
class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:100',
            'rubrics' => 'required',
        ];
    }

    public function getFormData(): array
    {
        $data = $this->request->all();

        $data = Arr::except($data, [
            '_token',
        ]);

        $data['slug'] = Str::slug($data['name']);
        $data['user_id'] = Auth::user()->id ?? 1;

        return $data;
    }
}
