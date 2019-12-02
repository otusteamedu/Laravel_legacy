<?php

namespace Gerfey\BattleNet\Request\Community\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;

/**
 * Class Achievement
 * @package Gerfey\BattleNet\Request\Community\Warcraft
 */
class Achievement extends Request
{
    /**
     * Returns data about an individual achievement.
     *
     * @param int $id
     * @return BattleNetResponseInterface
     */
    public function achievement(int $id = 2144): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/achievement/' . $id);
    }
}