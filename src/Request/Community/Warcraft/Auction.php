<?php

namespace Gerfey\BattleNet\Request\Community\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;

/**
 * Class Auction
 * @package Gerfey\BattleNet\Request\Community\Warcraft
 */
class Auction extends Request
{
    /**
     * This API resource provides a per-realm list of recently generated auction house data dumps.
     *
     * @param string $realm
     * @return BattleNetResponseInterface
     */
    public function auctionDataStatus(string $realm = 'Ревущий Фьорд'): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/auction/data/' . $realm);
    }
}