<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

/**
 * Class LinkRequest
 * @package App\Http\Requests\System\Menu
 *
 * Реквест создания ссылки
 */
class BaseRequest extends FormRequest
{
    /**
     * Возвращает данные
     * @return array данные
     */
    public function getData(): array {
        $data = $this->request->all();
        $data = Arr::except($data, '_token');
        return $data;
    }
}
