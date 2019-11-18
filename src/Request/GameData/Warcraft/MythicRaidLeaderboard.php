<?php

namespace Gerfey\BattleNet\Request\GameData\Warcraft;

use Gerfey\BattleNet\Request\Request;

class MythicRaidLeaderboard extends Request
{
    /**
     * Returns the leaderboard for a given raid and faction.
     *
     * @param string $raid
     * @param string $faction
     * @return mixed
     */
    public function mythicRaidLeaderboard(string $raid = 'uldir', string $faction = 'alliance')
    {
        return $this->createRequest('GET', '/data/wow/leaderboard/hall-of-fame/' . $raid . '/' . $faction);
    }
}