<?php

namespace Gerfey\BattleNet\Request\Community\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;

/**
 * Class Mount
 * @package Gerfey\BattleNet\Request\Community\Warcraft
 */
class Mount extends Request
{
    /**
     * Returns a list of all supported mounts.
     *
     * @return BattleNetResponseInterface
     */
    public function masterList(): BattleNetResponseInterface
    {
        return $this->createRequest('GET', ' /wow/mount/');
    }
}