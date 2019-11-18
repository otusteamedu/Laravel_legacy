<?php

namespace Gerfey\BattleNet\Request\GameData\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;

/**
 * Class PvPSeason
 * @package Gerfey\BattleNet\Request\GameData\Warcraft
 */
class PvPSeason extends Request
{
    /**
     * Returns an index of PvP seasons.
     *
     * @return BattleNetResponseInterface
     */
    public function pvpSeasonsIndex(): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/data/wow/pvp-season/index');
    }

    /**
     * Returns a PvP season by ID.
     *
     * @param int $pvpSeasonId
     * @return BattleNetResponseInterface
     */
    public function pvpSeason(int $pvpSeasonId = 27): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/data/wow/pvp-season/' . $pvpSeasonId);
    }

    /**
     * Returns the PvP leaderboard of a specific PvP bracket for a PvP season.
     *
     * @param int $pvpSeasonId
     * @param string $pvpBracket
     * @return BattleNetResponseInterface
     */
    public function pvpLeaderboard(int $pvpSeasonId = 27, string $pvpBracket): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/data/wow/pvp-season/' . $pvpSeasonId . '/pvp-leaderboard/' . $pvpBracket);
    }

    /**
     * Returns an index of PvP leaderboards for a PvP season.
     *
     * @param int $pvpSeasonId
     * @return BattleNetResponseInterface
     */
    public function pvpLeaderboardIndex(int $pvpSeasonId = 27): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/data/wow/pvp-season/' . $pvpSeasonId . '/pvp-leaderboard/index');
    }

    /**
     * Returns an index of PvP rewards for a PvP season.
     *
     * @param int $pvpSeasonId
     * @return BattleNetResponseInterface
     */
    public function pvpRewardsIndex(int $pvpSeasonId = 27): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/data/wow/pvp-season/' . $pvpSeasonId . '/pvp-reward/index');
    }
}