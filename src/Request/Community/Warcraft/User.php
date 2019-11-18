<?php

namespace Gerfey\BattleNet\Request\Community\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;

/**
 * Class User
 * @package Gerfey\BattleNet\Request\Community\Warcraft
 */
class User extends Request
{
    /**
     * Returns a list of characters for an account.
     *
     * @return BattleNetResponseInterface
     */
    public function characters(): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/user/characters');
    }
}