<?php

namespace Gerfey\BattleNet\Request\GameData\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;

/**
 * Class PlayableSpecialization
 * @package Gerfey\BattleNet\Request\GameData\Warcraft
 */
class PlayableSpecialization extends Request
{
    /**
     * Returns an index of playable specializations.
     *
     * @return BattleNetResponseInterface
     */
    public function playableSpecializationsIndex(): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/playable-specialization/index');
    }

    /**
     * Returns a playable specialization by ID.
     *
     * @param int $specId
     * @return BattleNetResponseInterface
     */
    public function playableSpecialization(int $specId = 262): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/playable-specialization/' . $specId);
    }
}