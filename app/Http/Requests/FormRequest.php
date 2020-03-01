<?php

namespace App\Http\Requests;

use Illuminate\Support\Arr;
use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;

/**
 * Class FormRequest
 * @package App\Http\Requests
 */
class FormRequest extends BaseFormRequest
{
    public function getFormData()
    {
        $data = $this->request->all();

        // Удаление лишних данных из формы при сабмите
        $data = Arr::except($data, [
            '_token',
            '_method',
        ]);

        return $data;
    }
}
