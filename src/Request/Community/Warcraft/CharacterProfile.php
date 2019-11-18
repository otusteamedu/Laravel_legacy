<?php

namespace Gerfey\BattleNet\Request\Community\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;

/**
 * Class CharacterProfile
 * @package Gerfey\BattleNet\Request\Community\Warcraft
 */
class CharacterProfile extends Request
{
    /**
     * The Character Profile API is the primary way to access character information. This API can be used to fetch a single character at a time through an HTTP GET request to a URL describing the character profile resource.
     * By default, these requests return a basic dataset, and each request can return zero or more additional fields.
     * To access this API, craft a resource URL pointing to the desired character for which to retrieve information.
     *
     * @param string $realm
     * @param string $characterName
     * @param string $fields
     * @return BattleNetResponseInterface
     */
    public function character(string $realm = 'Ревущий Фьорд', string $characterName = 'Пуфка', string $fields = ''): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/character/' . $realm . '/' . $characterName, ['fields' => $fields]);
    }

    /**
     * Returns a map of achievement data including completion timestamps and criteria information.
     *
     * @param string $realm
     * @param string $characterName
     * @return BattleNetResponseInterface
     */
    public function achievements(string $realm = 'Ревущий Фьорд', string $characterName = 'Пуфка'): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/character/' . $realm . '/' . $characterName, ['fields' => 'achievements']);
    }

    /**
     * Returns a map of a character's appearance settings, such as which face texture they've selected and whether or not a helm is visible.
     *
     * @param string $realm
     * @param string $characterName
     * @return BattleNetResponseInterface
     */
    public function appearance(string $realm = 'Ревущий Фьорд', string $characterName = 'Пуфка'): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/character/' . $realm . '/' . $characterName, ['fields' => 'appearance']);
    }

    /**
     * The character's activity feed.
     *
     * @param string $realm
     * @param string $characterName
     * @return BattleNetResponseInterface
     */
    public function feed(string $realm = 'Ревущий Фьорд', string $characterName = 'Пуфка'): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/character/' . $realm . '/' . $characterName, ['fields' => 'feed']);
    }

    /**
     * A summary of the guild to which the character belongs. If the character does not belong to a guild and this field is requested, this field will not be exposed.
     * When a guild is requested, this resource returns a map with key-value pairs that describe a basic set of guild information. Note that the rank of the character is not included in this block as it describes a guild and not a membership of the guild. To retrieve the character's rank within the guild, make a specific, separate request to the guild profile resource.
     *
     * @param string $realm
     * @param string $characterName
     * @return BattleNetResponseInterface
     */
    public function guild(string $realm = 'Ревущий Фьорд', string $characterName = 'Пуфка'): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/character/' . $realm . '/' . $characterName, ['fields' => 'guild']);
    }

    /**
     * Returns a list of all combat pets the character has obtained.
     *
     * @param string $realm
     * @param string $characterName
     * @return BattleNetResponseInterface
     */
    public function hunterPets(string $realm = 'Ревущий Фьорд', string $characterName = 'Пуфка'): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/character/' . $realm . '/' . $characterName, ['fields' => 'hunterPets']);
    }

    /**
     * Returns a list of items equipped by the character. Use of this field will also include the average item level and average item level equipped for the character.
     * When the items field is used, this resource returns a map structure containing information about the character's equipped items as well as their average item level.
     *
     * @param string $realm
     * @param string $characterName
     * @return BattleNetResponseInterface
     */
    public function items(string $realm = 'Ревущий Фьорд', string $characterName = 'Пуфка'): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/character/' . $realm . '/' . $characterName, ['fields' => 'items']);
    }

    /**
     * Returns a list of all mounts the character has obtained.
     *
     * @param string $realm
     * @param string $characterName
     * @return BattleNetResponseInterface
     */
    public function mounts(string $realm = 'Ревущий Фьорд', string $characterName = 'Пуфка'): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/character/' . $realm . '/' . $characterName, ['fields' => 'mounts']);
    }

    /**
     * Returns a list of the battle pets the character has obtained.
     *
     * @param string $realm
     * @param string $characterName
     * @return BattleNetResponseInterface
     */
    public function pets(string $realm = 'Ревущий Фьорд', string $characterName = 'Пуфка'): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/character/' . $realm . '/' . $characterName, ['fields' => 'pets']);
    }

    /**
     * Data about the character's current battle pet slots.
     * The response contains which slot a pet is in and whether the slot is empty or locked. The response also includes the battlePetId, which is unique for the character and can be used to match a battlePetId in the pets field for the character. The ability list is the list of three active abilities on a pet. If the pet is not high enough level for multiple abilities it will always be the pet's first three abilities.
     *
     * @param string $realm
     * @param string $characterName
     * @return BattleNetResponseInterface
     */
    public function petSlots(string $realm = 'Ревущий Фьорд', string $characterName = 'Пуфка'): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/character/' . $realm . '/' . $characterName, ['fields' => 'petSlots']);
    }

    /**
     * Returns a list of the character's professions. Does not include class professions.
     *
     * @param string $realm
     * @param string $characterName
     * @return BattleNetResponseInterface
     */
    public function professions(string $realm = 'Ревущий Фьорд', string $characterName = 'Пуфка'): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/character/' . $realm . '/' . $characterName, ['fields' => 'professions']);
    }

    /**
     * Returns a list of raids and bosses indicating raid progression and completeness.
     *
     * @param string $realm
     * @param string $characterName
     * @return BattleNetResponseInterface
     */
    public function progression(string $realm = 'Ревущий Фьорд', string $characterName = 'Пуфка'): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/character/' . $realm . '/' . $characterName, ['fields' => 'progression']);
    }

    /**
     * Returns a map of PvP information, including arena team membership and rated battlegrounds information.
     *
     * @param string $realm
     * @param string $characterName
     * @return BattleNetResponseInterface
     */
    public function pvp(string $realm = 'Ревущий Фьорд', string $characterName = 'Пуфка'): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/character/' . $realm . '/' . $characterName, ['fields' => 'pvp']);
    }

    /**
     * Returns a list of quests the character has completed.
     *
     * @param string $realm
     * @param string $characterName
     * @return BattleNetResponseInterface
     */
    public function quests(string $realm = 'Ревущий Фьорд', string $characterName = 'Пуфка'): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/character/' . $realm . '/' . $characterName, ['fields' => 'quests']);
    }

    /**
     * Returns a list of the factions with which the character has an associated reputation.
     *
     * @param string $realm
     * @param string $characterName
     * @return BattleNetResponseInterface
     */
    public function reputation(string $realm = 'Ревущий Фьорд', string $characterName = 'Пуфка'): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/character/' . $realm . '/' . $characterName, ['fields' => 'reputation']);
    }

    /**
     * Returns a map of character statistics.
     *
     * @param string $realm
     * @param string $characterName
     * @return BattleNetResponseInterface
     */
    public function statistics(string $realm = 'Ревущий Фьорд', string $characterName = 'Пуфка'): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/character/' . $realm . '/' . $characterName, ['fields' => 'statistics']);
    }

    /**
     * Returns a map of character attributes and stats.
     *
     * @param string $realm
     * @param string $characterName
     * @return BattleNetResponseInterface
     */
    public function stats(string $realm = 'Ревущий Фьорд', string $characterName = 'Пуфка'): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/character/' . $realm . '/' . $characterName, ['fields' => 'stats']);
    }

    /**
     * Returns a list of the character's talent structures.
     *
     * @param string $realm
     * @param string $characterName
     * @return BattleNetResponseInterface
     */
    public function talents(string $realm = 'Ревущий Фьорд', string $characterName = 'Пуфка'): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/character/' . $realm . '/' . $characterName, ['fields' => 'talents']);
    }

    /**
     * Returns a list of titles the character has obtained, including the currently selected title.
     *
     * @param string $realm
     * @param string $characterName
     * @return BattleNetResponseInterface
     */
    public function titles(string $realm = 'Ревущий Фьорд', string $characterName = 'Пуфка'): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/character/' . $realm . '/' . $characterName, ['fields' => 'titles']);
    }

    /**
     * Raw character audit data that powers the character audit on the game site.
     *
     * @param string $realm
     * @param string $characterName
     * @return BattleNetResponseInterface
     */
    public function audit(string $realm = 'Ревущий Фьорд', string $characterName = 'Пуфка'): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/character/' . $realm . '/' . $characterName, ['fields' => 'audit']);
    }
}