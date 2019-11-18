<?php

namespace Gerfey\BattleNet\Request\GameData\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;

/**
 * Class PlayableClass
 * @package Gerfey\BattleNet\Request\GameData\Warcraft
 */
class PlayableClass extends Request
{
    /**
     * Returns an index of playable classes.
     *
     * @return BattleNetResponseInterface
     */
    public function playableClassesIndex(): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/playable-class/index');
    }

    /**
     * Returns a playable class by ID.
     *
     * @param int $classId
     * @return BattleNetResponseInterface
     */
    public function playableClass(int $classId = 7): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/playable-class/' . $classId);
    }

    /**
     * Returns the PvP talent slots for a playable class by ID.
     *
     * @param int $classId
     * @return BattleNetResponseInterface
     */
    public function pvpTalentSlots(int $classId = 7): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/playable-class/' . $classId . '/pvp-talent-slots');
    }
}