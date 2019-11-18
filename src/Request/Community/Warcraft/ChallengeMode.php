<?php

namespace Gerfey\BattleNet\Request\Community\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;

/**
 * Class ChallengeMode
 * @package Gerfey\BattleNet\Request\Community\Warcraft
 */
class ChallengeMode extends Request
{
    /**
     * The request returns data for all nine challenge mode maps (currently). The map field includes the current medal times for each dungeon.
     * Each ladder provides data about each character that was part of each run. The character data includes the current cached specialization of the character while the member field includes the specialization of the character during the challenge mode run.
     *
     * @param string $realm
     * @return BattleNetResponseInterface
     */
    public function realmLeaderboard(string $realm = 'Ревущий Фьорд'): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/challenge/' . $realm);
    }

    /**
     * The region leaderboard has the exact same data format as the realm leaderboards except there is no realm field.
     * Instead, the response has the top 100 results gathered for each map for all of the available realm leaderboards in a region.
     *
     * @return BattleNetResponseInterface
     */
    public function regionLeaderboard(): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/challenge/region');
    }
}