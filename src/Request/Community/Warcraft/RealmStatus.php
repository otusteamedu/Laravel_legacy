<?php

namespace Gerfey\BattleNet\Request\Community\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;

/**
 * Class RealmStatus
 * @package Gerfey\BattleNet\Request\Community\Warcraft
 */
class RealmStatus extends Request
{
    /**
     * The realm status API allows developers to retrieve realm status information. This information is limited to whether or not the realm is up, the type and state of the realm, and the current population.
     * Although this endpoint has no required query string parameters, use the optional realms parameter to limit the realms returned to a specific set of realms.
     *
     * @return BattleNetResponseInterface
     */
    public function realmStatus(): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/realm/status');
    }
}