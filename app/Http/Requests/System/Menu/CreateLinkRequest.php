<?php

namespace App\Http\Requests\System\Menu;

use App\Http\Requests\BaseRequest;

/**
 * Class CreateLinkRequest
 * @package App\Http\Requests\System\Menu
 *
 * Реквест создания ссылки
 */
class CreateLinkRequest extends BaseRequest
{
    /**
     * Правила проверки входных данных
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'route_name' => 'required|max:255',
            'name' => 'required|max:255',
            'type' => 'required|max:255',
            'disabled' => 'boolean',
        ];
    }

    /**
     * Атрибуты
     *
     * @return array|string[]
     */
    public function attributes()
    {
        return [
            'type' => '"Тип меню"',
            'name' => '"Название"',
            'route_name' => '"Название маршрута"',
            'disabled' => '"Флаг выключенного пункта"',
        ];
    }
}

