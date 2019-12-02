<?php

namespace Gerfey\BattleNet\Request\GameData\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;
use Gerfey\BattleNet\Traits\Utils;

/**
 * Class Realm
 * @package Gerfey\BattleNet\Request\GameData\Warcraft
 */
class Realm extends Request
{
    use Utils;

    /**
     * Returns an index of realms.
     *
     * @return BattleNetResponseInterface
     */
    public function realmIndex(): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/data/wow/realm/index');
    }

    /**
     * Returns a single realm by slug or ID.
     *
     * @param string $realmSlug
     * @return BattleNetResponseInterface
     */
    public function realm(string $realmSlug): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/data/wow/realm/' . $this->realmNameToSlug($realmSlug));
    }
}