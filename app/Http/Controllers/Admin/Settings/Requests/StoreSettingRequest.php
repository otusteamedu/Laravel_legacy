<?php

namespace App\Http\Controllers\Admin\Settings\Requests;

use App\Http\Requests\BaseFormRequest;
use App\Services\Settings\SettingService;
use Closure;

class StoreSettingRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'key' => [
                'required',
                'string',
                function (string $attribute, $value, Closure $fail): void {
                    if (in_array($value, SettingService::availableSettings())) {
                        $value . ' not found';
                    }
                },
            ],
            'value' => ['required', 'string'],
            'serialized' => ['bool'],
        ];
    }
}
