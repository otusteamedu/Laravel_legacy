<?php

namespace Gerfey\BattleNet\Request\Community\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;

/**
 * Class Profile
 * @package Gerfey\BattleNet\Request\Community\Warcraft
 */
class Profile extends Request
{
    /**
     * This provides data about the current logged in OAuth user's WoW profile.
     *
     * @return BattleNetResponseInterface
     */
    public function oAuthProfile(): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/user/characters');
    }
}