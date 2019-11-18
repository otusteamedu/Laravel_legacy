<?php

namespace Gerfey\BattleNet\Request\GameData\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;

/**
 * Class Region
 * @package Gerfey\BattleNet\Request\GameData\Warcraft
 */
class Region extends Request
{
    /**
     * Returns an index of regions.
     *
     * @return BattleNetResponseInterface
     */
    public function regionIndex(): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/data/wow/region/index');
    }

    /**
     * Returns a region by ID.
     *
     * @param int $regionId
     * @return BattleNetResponseInterface
     */
    public function region(int $regionId): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/data/wow/region/' . $regionId);
    }
}