<?php

namespace Gerfey\BattleNet\Request\Community\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;

/**
 * Class Pet
 * @package Gerfey\BattleNet\Request\Community\Warcraft
 */
class Pet extends Request
{
    /**
     * Returns a list of all supported battle and vanity pets.
     *
     * @return BattleNetResponseInterface
     */
    public function masterList(): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/pet/');
    }

    /**
     * Returns data about a individual battle pet ability ID. This resource does not provide ability tooltips.
     *
     * @param int $abilityID
     * @return BattleNetResponseInterface
     */
    public function abilities(int $abilityID = 640): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/pet/ability/' . $abilityID);
    }

    /**
     * Returns data about an individual pet species. Use pets as the field value in a character profile request to get species IDs. Each species also has data about its six abilities.
     *
     * @param int $speciesID
     * @return BattleNetResponseInterface
     */
    public function species(int $speciesID = 258): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/pet/species/' . $speciesID);
    }

    /**
     * Returns detailed information about a given species of pet.
     *
     * @param int $speciesID
     * @param int $level
     * @param int $breedId
     * @param int $qualityId
     * @return BattleNetResponseInterface
     */
    public function stats(int $speciesID = 258, int $level = 1, int $breedId = 3, int $qualityId = 1): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/pet/stats/' . $speciesID, ['level' => $level, 'breedId' => $breedId, 'qualityId' => $qualityId]);
    }
}