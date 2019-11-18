<?php

namespace Gerfey\BattleNet\Request\GameData\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;
use Gerfey\BattleNet\Traits\Utils;

/**
 * Class Creatures
 * @package Gerfey\BattleNet\Request\GameData\Warcraft
 */
class Creatures extends Request
{
    /**
     * Returns an index of creature families.
     *
     * @return BattleNetResponseInterface
     */
    public function creatureFamiliesIndex(): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/creature-family/index');
    }

    /**
     * Returns a creature family by ID.
     *
     * @param int $creatureFamilyId
     * @return BattleNetResponseInterface
     */
    public function creatureFamilie(int $creatureFamilyId = 1): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/creature-family/' . $creatureFamilyId);
    }

    /**
     * Returns an index of creature types.
     *
     * @return BattleNetResponseInterface
     */
    public function creatureTypesIndex(): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/creature-type/index');
    }

    /**
     * Returns a creature type by ID.
     *
     * @param int $creatureTypeId
     * @return BattleNetResponseInterface
     */
    public function creatureType(int $creatureTypeId = 1): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/creature-type/' . $creatureTypeId);
    }

    /**
     * Returns a creature by ID.
     *
     * @param int $creatureId
     * @return BattleNetResponseInterface
     */
    public function creature(int $creatureId = 42722): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/creature/' . $creatureId);
    }

    /**
     * Returns media for a creature display by ID.
     *
     * @param int $creatureDisplayId
     * @return BattleNetResponseInterface
     */
    public function creatureDisplayMedia(int $creatureDisplayId = 30221): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/media/creature-display/' . $creatureDisplayId);
    }

    /**
     * Returns media for a creature family by ID.
     *
     * @param int $creatureFamilyId
     * @return BattleNetResponseInterface
     */
    public function creatureFamilyMedia(int $creatureFamilyId = 1): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/media/creature-family/' . $creatureFamilyId);
    }
}