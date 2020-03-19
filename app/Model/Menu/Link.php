<?php

namespace App\Model\Menu;

use App\Model\BaseModel;

/**
 * Class Link
 * @package App\Model\Link
 *
 * Ссылка меню
 *
 * @property int $id Идентификатор
 * @property string $route_name Имя роута
 * @property string $name Наименование пункта
 * @property string $type Тип
 * @property boolean $disabled Флаг выключенного пункта
 * @method static paginate(int $int)
 * @method static find(array|int $id)
 */
class Link extends BaseModel
{
    /** @var bool Не имеет полей created_at и updated_at */
    public $timestamps = false;

    /** @var string[] Поля которые можно заполнять для массовой вставки */
    protected $fillable = ['route_name', 'name', 'type', 'disabled'];
}
