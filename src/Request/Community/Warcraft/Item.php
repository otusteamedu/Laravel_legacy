<?php

namespace Gerfey\BattleNet\Request\Community\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;

/**
 * Class Item
 * @package Gerfey\BattleNet\Request\Community\Warcraft
 */
class Item extends Request
{
    /**
     * The item API provides detailed item information, including item set information.
     *
     * @param int $itemId
     * @return BattleNetResponseInterface
     */
    public function item(int $itemId = 18803): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/item/' . $itemId);
    }

    /**
     * The item API provides detailed item information, including item set information.
     *
     * @param int $setId
     * @return BattleNetResponseInterface
     */
    public function itemSet(int $setId = 1060): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/item/set/' . $setId);
    }
}