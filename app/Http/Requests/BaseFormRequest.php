<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class BaseFormRequest extends FormRequest
{
    /**
     * @return array
     */
    public function getFormData(): array
    {
        $data = $this->request->all();

        $data = Arr::except($data, [
            '_method',
            '_token',
            'api_token',
        ]);

        return $data;
    }
}
