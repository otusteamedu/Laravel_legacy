<?php

namespace Gerfey\BattleNet\Request\GameData\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;

/**
 * Class PvPTier
 * @package Gerfey\BattleNet\Request\GameData\Warcraft
 */
class PvPTier extends Request
{
    /**
     * Returns an index of PvP tiers.
     *
     * @return BattleNetResponseInterface
     */
    public function pvpTiersIndex(): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/pvp-tier/index');
    }

    /**
     * Returns a PvP tier by ID.
     *
     * @param int $pvpTierId
     * @return BattleNetResponseInterface
     */
    public function pvpTier(int $pvpTierId = 1): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/pvp-tier/' . $pvpTierId);
    }

    /**
     * Returns media for a PvP tier by ID.
     *
     * @param int $pvpTierId
     * @return BattleNetResponseInterface
     */
    public function pvpTierMedia(int $pvpTierId = 1): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/media/pvp-tier/' . $pvpTierId);
    }
}