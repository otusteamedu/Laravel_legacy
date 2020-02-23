<?php

namespace App\Http\Controllers\Cms\User\User\Requests;

use Arr;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateGroupRequest
 * @package App\Http\Controllers\Cms\User\Group\Requests
 */
class UpdateUserRequest extends FormRequest
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

    /**
     * @return array
     */
    public function getFormData(): array
    {
        $data = $this->request->all();

        $data = Arr::except($data, [
            '_token', '_method',
        ]);

        return $data;
    }
}
