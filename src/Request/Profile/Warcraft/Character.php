<?php

namespace Gerfey\BattleNet\Request\Profile\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;
use Gerfey\BattleNet\Traits\Utils;

class Character extends Request
{
    use Utils;

    /**
     * Returns a profile summary for a character.
     *
     * @param string $realmSlug
     * @param string $characterName
     * @return mixed
     */
    public function characterProfile(string $realmSlug, string $characterName): BattleNetResponseInterface
    {
        $this->setNamespace('profile');
        return $this->createRequest('GET', '/profile/wow/character/' . $this->realmNameToSlug($realmSlug) . '/' . $this->nameToSlug($characterName));
    }

    /**
     * Returns a summary of the achievements a character has completed.
     *
     * @param string $realmSlug
     * @param string $characterName
     * @return mixed
     */
    public function characterAchievements(string $realmSlug, string $characterName): BattleNetResponseInterface
    {
        $this->setNamespace('profile');
        return $this->createRequest('GET', '/profile/wow/character/' . $this->realmNameToSlug($realmSlug) . '/' . $this->nameToSlug($characterName) . '/achievements');
    }

    /**
     * Returns a summary of a character's appearance settings.
     *
     * @param string $realmSlug
     * @param string $characterName
     * @return mixed
     */
    public function characterAppearance(string $realmSlug, string $characterName): BattleNetResponseInterface
    {
        $this->setNamespace('profile');
        return $this->createRequest('GET', '/profile/wow/character/' . $this->realmNameToSlug($realmSlug) . '/' . $this->nameToSlug($characterName) . '/appearance');
    }

    /**
     * Returns a summary of the items equipped by a character.
     *
     * @param string $realmSlug
     * @param string $characterName
     * @return mixed\
     */
    public function characterEquipment(string $realmSlug, string $characterName): BattleNetResponseInterface
    {
        $this->setNamespace('profile');
        return $this->createRequest('GET', '/profile/wow/character/' . $this->realmNameToSlug($realmSlug) . '/' . $this->nameToSlug($characterName) . '/equipment');
    }

    /**
     * Returns a summary of the media assets available for a character (such as an avatar render).
     *
     * @param string $realmSlug
     * @param string $characterName
     * @return mixed
     */
    public function characterMedia(string $realmSlug, string $characterName): BattleNetResponseInterface
    {
        $this->setNamespace('profile');
        return $this->createRequest('GET', '/profile/wow/character/' . $this->realmNameToSlug($realmSlug) . '/' . $this->nameToSlug($characterName) . '/character-media');
    }

    /**
     * Returns a summary of a character's specializations.
     *
     * @param string $realmSlug
     * @param string $characterName
     * @return mixed
     */
    public function characterSpecializations(string $realmSlug, string $characterName): BattleNetResponseInterface
    {
        $this->setNamespace('profile');
        return $this->createRequest('GET', '/profile/wow/character/' . $this->realmNameToSlug($realmSlug) . '/' . $this->nameToSlug($characterName) . '/specializations');
    }

    /**
     * Returns a statistics summary for a character.
     *
     * @param string $realmSlug
     * @param string $characterName
     * @return mixed
     */
    public function characterStatistics(string $realmSlug, string $characterName): BattleNetResponseInterface
    {
        $this->setNamespace('profile');
        return $this->createRequest('GET', '/profile/wow/character/' . $this->realmNameToSlug($realmSlug) . '/' . $this->nameToSlug($characterName) . '/statistics');
    }

    /**
     * Returns a summary of titles a character has obtained.
     *
     * @param string $realmSlug
     * @param string $characterName
     * @return mixed
     */
    public function characterTitles(string $realmSlug, string $characterName): BattleNetResponseInterface
    {
        $this->setNamespace('profile');
        return $this->createRequest('GET', '/profile/wow/character/' . $this->realmNameToSlug($realmSlug) . '/' . $this->nameToSlug($characterName) . '/titles');
    }

    /**
     * Returns the PvP bracket statistics for a character.
     *
     * @param string $realmSlug
     * @param string $characterName
     * @param string $pvpBracket
     * @return mixed
     */
    public function characterPvPBracketStatistics(string $realmSlug, string $characterName, string $pvpBracket = '3v3'): BattleNetResponseInterface
    {
        $this->setNamespace('profile');
        return $this->createRequest('GET', '/profile/wow/character/' . $this->realmNameToSlug($realmSlug) . '/' . $this->nameToSlug($characterName) . '/pvp-bracket/' . $pvpBracket);
    }

    /**
     * Returns a PvP summary for a character.
     *
     * @param string $realmSlug
     * @param string $characterName
     * @return mixed
     */
    public function characterPvP(string $realmSlug, string $characterName): BattleNetResponseInterface
    {
        $this->setNamespace('profile');
        return $this->createRequest('GET', '/profile/wow/character/' . $this->realmNameToSlug($realmSlug) . '/' . $this->nameToSlug($characterName) . '/pvp-summary');
    }

    /**
     * Returns the Mythic Keystone profile index for a character.
     *
     * @param string $realmSlug
     * @param string $characterName
     * @return mixed
     */
    public function mythicKeystoneCharacterProfileIndex(string $realmSlug, string $characterName): BattleNetResponseInterface
    {
        $this->setNamespace('profile');
        return $this->createRequest('GET', '/profile/wow/character/' . $this->realmNameToSlug($realmSlug) . '/' . $this->nameToSlug($characterName) . '/mythic-keystone-profile');
    }

    /**
     * Returns the Mythic Keystone season details for a character.
     * Returns a 404 Not Found for characters that have not yet completed a Mythic Keystone dungeon for the specified season.
     *
     * @param string $realmSlug
     * @param string $characterName
     * @param int $seasonId
     * @return mixed
     */
    public function mythicKeystoneCharacterSeasonDetails(string $realmSlug, string $characterName, int $seasonId = 3): BattleNetResponseInterface
    {
        $this->setNamespace('profile');
        return $this->createRequest('GET', '/profile/wow/character/' . $this->realmNameToSlug($realmSlug) . '/' . $this->nameToSlug($characterName) . '/mythic-keystone-profile/season/' . $seasonId);
    }
}