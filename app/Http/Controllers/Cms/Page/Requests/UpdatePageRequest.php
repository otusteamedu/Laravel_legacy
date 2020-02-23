<?php

namespace App\Http\Controllers\Cms\Page\Requests;

use Arr;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdatePageRequest
 * @package App\Http\Controllers\Cms\Page\Requests
 */
class UpdatePageRequest extends FormRequest
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
            'name' => 'required|max:100'
        ];
    }

    /**
     * @return array
     */
    public function getFormData()
    {
        $data = $this->request->all();

        $data = Arr::except($data, [
            '_token', '_method',
        ]);

        return $data;
    }
}
