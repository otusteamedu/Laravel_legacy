<?php

namespace Gerfey\BattleNet\Request\GameData\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;

/**
 * Class Mounts
 * @package Gerfey\BattleNet\Request\GameData\Warcraft
 */
class Mounts extends Request
{
    /**
     * Returns an index of mounts.
     *
     * @return BattleNetResponseInterface
     */
    public function mountsIndex(): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/mount/index');
    }

    /**
     * Returns a mount by ID.
     *
     * @param int $mountId
     * @return BattleNetResponseInterface
     */
    public function mount(int $mountId = 6): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/mount/' . $mountId);
    }
}