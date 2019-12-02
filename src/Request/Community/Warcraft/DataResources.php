<?php

namespace Gerfey\BattleNet\Request\Community\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;

/**
 * Class DataResources
 * @package Gerfey\BattleNet\Request\Community\Warcraft
 */
class DataResources extends Request
{
    /**
     * Returns a list of battlegroups for the specified region. Note the trailing / on this request path.
     *
     * @return BattleNetResponseInterface
     */
    public function battlegroups(): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/data/battlegroups/');
    }

    /**
     * Returns a list of races and their associated faction, name, unique ID, and skin.
     *
     * @return BattleNetResponseInterface
     */
    public function characterRaces(): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/data/character/races');
    }

    /**
     * Returns a list of character classes.
     *
     * @return BattleNetResponseInterface
     */
    public function characterClasses(): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/data/character/classes');
    }

    /**
     * Returns a list of all achievements that characters can earn as well as the category structure and hierarchy.
     *
     * @return BattleNetResponseInterface
     */
    public function characterAchievements(): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/data/character/achievements');
    }

    /**
     * The guild rewards data API provides a list of all guild rewards.
     *
     * @return BattleNetResponseInterface
     */
    public function guildRewards(): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/data/guild/rewards');
    }

    /**
     * Returns a list of all guild perks.
     *
     * @return BattleNetResponseInterface
     */
    public function guildPerks(): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/data/guild/perks');
    }

    /**
     * Returns a list of all guild achievements as well as the category structure and hierarchy.
     *
     * @return BattleNetResponseInterface
     */
    public function guildAchievements(): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/data/guild/achievements');
    }

    /**
     * Returns a list of item classes.
     *
     * @return BattleNetResponseInterface
     */
    public function itemClasses(): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/data/item/classes');
    }

    /**
     * Returns a list of talents, specs, and glyphs for each class.
     *
     * @return BattleNetResponseInterface
     */
    public function talents(): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/data/talents');
    }

    /**
     * Returns a list of the different battle pet types, including what they are strong and weak against.
     *
     * @return BattleNetResponseInterface
     */
    public function types(): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/data/pet/types');
    }
}