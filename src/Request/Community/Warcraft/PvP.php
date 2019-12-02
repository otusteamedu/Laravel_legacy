<?php

namespace Gerfey\BattleNet\Request\Community\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;

/**
 * Class PvP
 * @package Gerfey\BattleNet\Request\Community\Warcraft
 */
class PvP extends Request
{
    /**
     * The Leaderboard API endpoint provides leaderboard information for the 2v2, 3v3, 5v5, and Rated Battleground leaderboards.
     *
     * @param string $bracket
     * @return BattleNetResponseInterface
     */
    public function leaderboard(string $bracket = '3v3'): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/leaderboard/' . $bracket);
    }
}