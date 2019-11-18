<?php

namespace Gerfey\BattleNet\Request\GameData\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;

/**
 * Class PlayableRaces
 * @package Gerfey\BattleNet\Request\GameData\Warcraft
 */
class PlayableRaces extends Request
{
    /**
     * Returns an index of playable races.
     *
     * @return BattleNetResponseInterface
     */
    public function playableRacesIndex(): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/playable-race/index');
    }

    /**
     * Returns a playable race by ID.
     *
     * @param int $playableRaceId
     * @return BattleNetResponseInterface
     */
    public function playableRace(int $playableRaceId = 2): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/playable-race/' . $playableRaceId);
    }
}