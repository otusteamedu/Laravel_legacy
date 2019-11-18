<?php

namespace Gerfey\BattleNet\Request\Community\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;

/**
 * Class Zone
 * @package Gerfey\BattleNet\Request\Community\Warcraft
 */
class Zone extends Request
{
    /**
     * Returns a list of all supported zones and their bosses. A "zone" in this context should be considered a dungeon or a raid, not a world zone. A "boss" in this context should be considered a boss encounter, which may include more than one NPC.
     *
     * @return BattleNetResponseInterface
     */
    public function masterList(): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/zone/');
    }

    /**
     * Returns information about zones.
     *
     * @param int $zoneid
     * @return BattleNetResponseInterface
     */
    public function zone(int $zoneid = 4131): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/zone/' . $zoneid);
    }
}