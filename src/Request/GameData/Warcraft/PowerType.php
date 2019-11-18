<?php

namespace Gerfey\BattleNet\Request\GameData\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;

/**
 * Class PowerType
 * @package Gerfey\BattleNet\Request\GameData\Warcraft
 */
class PowerType extends Request
{
    /**
     * Returns an index of power types.
     *
     * @return BattleNetResponseInterface
     */
    public function powerTypesIndex(): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/power-type/index');
    }

    /**
     * Returns a power type by ID.
     *
     * @param int $powerTypeId
     * @return BattleNetResponseInterface
     */
    public function powerTypes(int $powerTypeId = 0): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/power-type/' . $powerTypeId);
    }
}