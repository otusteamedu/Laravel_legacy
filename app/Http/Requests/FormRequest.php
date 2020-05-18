<?php


namespace App\Http\Requests;

use Illuminate\Support\Arr;
use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;

class FormRequest extends BaseFormRequest
{
    protected function getValidatorInstance()
    {
        $data = $this->all();

        $data = Arr::except($data, [
            '_token',
        ]);

        $this->getInputSource()->replace($data);

        return parent::getValidatorInstance();
    }


    public function getFormData()
    {
        return $this->request->all();

    }

}
