<?php

namespace App\Http\Controllers\Cms\User\Group\Requests;

use Arr;
use Illuminate\Foundation\Http\FormRequest;
use Str;

/**
 * Class StoreGroupRequest
 * @package App\Http\Controllers\Cms\User\Group\Requests
 */
class StoreGroupRequest extends FormRequest
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
        ];
    }

    public function getFormData(): array
    {
        $data = $this->request->all();

        $data = Arr::except($data, [
            '_token',
        ]);

        $data['slug'] = Str::slug($data['name']);

        return $data;
    }
}
