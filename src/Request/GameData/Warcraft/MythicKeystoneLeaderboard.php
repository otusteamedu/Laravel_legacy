<?php

namespace Gerfey\BattleNet\Request\GameData\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;

/**
 * Class MythicKeystoneLeaderboard
 * @package Gerfey\BattleNet\Request\GameData\Warcraft
 */
class MythicKeystoneLeaderboard extends Request
{
    /**
     * Returns an index of Mythic Keystone Leaderboard dungeon instances for a connected realm.
     *
     * @param int $connectedRealmId
     * @return BattleNetResponseInterface
     */
    public function mythicKeystoneLeaderboardsIndex(int $connectedRealmId = 11): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/data/wow/connected-realm/' . $connectedRealmId . '/mythic-leaderboard/index');
    }

    /**
     * Returns a weekly Mythic Keystone Leaderboard by period.
     *
     * @param int $connectedRealmId
     * @param int $dungeonId
     * @param int $period
     * @return BattleNetResponseInterface
     */
    public function mythicKeystoneLeaderboard(int $connectedRealmId = 11, int $dungeonId = 197, int $period = 641): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/data/wow/connected-realm/' . $connectedRealmId . '/mythic-leaderboard/' . $dungeonId . '/period/' . $period);
    }
}