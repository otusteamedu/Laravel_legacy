<?php

namespace Gerfey\BattleNet\Request\Community\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;

/**
 * Class Boss
 * @package Gerfey\BattleNet\Request\Community\Warcraft
 */
class Boss extends Request
{
    /**
     * Returns a list of all supported bosses. A "boss" in this context should be considered a boss encounter, which may include more than one NPC.
     *
     * @return BattleNetResponseInterface
     */
    public function masterList(): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/boss/');
    }

    /**
     * The boss API provides information about bosses. A "boss" in this context should be considered a boss encounter, which may include more than one NPC.
     *
     * @param int $bossId
     * @return BattleNetResponseInterface
     */
    public function boss(int $bossId = 24723): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/boss/' . $bossId);
    }
}