<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseFormRequest extends FormRequest
{
    /**
     * @return array
     */
    public function getFormData(): array
    {
        $data = $this->request->all();

        return $data;
    }
}
