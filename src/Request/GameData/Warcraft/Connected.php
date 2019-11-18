<?php

namespace Gerfey\BattleNet\Request\GameData\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;
use Gerfey\BattleNet\Traits\Utils;

/**
 * Class Connected
 * @package Gerfey\BattleNet\Request\GameData\Warcraft
 */
class Connected extends Request
{
    /**
     * Returns an index of connected realms.
     *
     * @return BattleNetResponseInterface
     */
    public function connectedRealmsIndex(): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/data/wow/connected-realm/index');
    }

    /**
     * Returns a connected realm by ID.
     *
     * @param int $connectedRealmId
     * @return BattleNetResponseInterface
     */
    public function connectedRealm(int $connectedRealmId = 11): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/data/wow/connected-realm/' . $connectedRealmId);
    }

}