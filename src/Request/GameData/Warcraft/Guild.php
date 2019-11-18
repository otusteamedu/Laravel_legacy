<?php

namespace Gerfey\BattleNet\Request\GameData\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;
use Gerfey\BattleNet\Traits\Utils;

/**
 * Class Guild
 * @package Gerfey\BattleNet\Request\GameData\Warcraft
 */
class Guild extends Request
{
    use Utils;

    /**
     * Returns a single guild by its name and realm.
     *
     * @param string $realmSlug
     * @param string $nameSlug
     * @return BattleNetResponseInterface
     */
    public function guild(string $realmSlug, string $nameSlug): BattleNetResponseInterface
    {
        $this->setNamespace('profile');
        return $this->createRequest('GET', '/data/wow/guild/' . $this->realmNameToSlug($realmSlug) . '/' . $this->nameToSlug($nameSlug));
    }

    /**
     * Returns a single guild's achievements by name and realm.
     *
     * @param string $realmSlug
     * @param string $nameSlug
     * @return BattleNetResponseInterface
     */
    public function guildAchievements(string $realmSlug, string $nameSlug): BattleNetResponseInterface
    {
        $this->setNamespace('profile');
        return $this->createRequest('GET', '/data/wow/guild/' . $this->realmNameToSlug($realmSlug) . '/' . $this->nameToSlug($nameSlug) . '/achievements');
    }

    /**
     * Returns a single guild's roster by its name and realm.
     *
     * @param string $realmSlug
     * @param string $nameSlug
     * @return BattleNetResponseInterface
     */
    public function guildRoster(string $realmSlug, string $nameSlug): BattleNetResponseInterface
    {
        $this->setNamespace('profile');
        return $this->createRequest('GET', '/data/wow/guild/' . $this->realmNameToSlug($realmSlug) . '/' . $this->nameToSlug($nameSlug) . '/roster');
    }
}