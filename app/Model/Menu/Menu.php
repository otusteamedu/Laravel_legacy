<?php

namespace App\Model\Menu;

use App\Model\BaseModel;

/**
 * Class Menu
 * @package App\Model\Menu
 *
 * Меню
 *
 * @property int $id Идентификатор
 * @property string $route_name Имя роута
 * @property string $name Наименование пункта
 * @property boolean $disabled Флаг выключенного пункта
 */
class Menu extends BaseModel
{
    /** @var bool Не имеет полей created_at и updated_at */
    public $timestamps = false;
}
