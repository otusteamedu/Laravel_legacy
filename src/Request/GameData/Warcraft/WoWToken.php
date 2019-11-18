<?php

namespace Gerfey\BattleNet\Request\GameData\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;

/**
 * Class WoWToken
 * @package Gerfey\BattleNet\Request\GameData\Warcraft
 */
class WoWToken extends Request
{
    /**
     * Returns the WoW Token index.
     *
     * @return BattleNetResponseInterface
     */
    public function tokenIndex(): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/data/wow/token/index');
    }
}