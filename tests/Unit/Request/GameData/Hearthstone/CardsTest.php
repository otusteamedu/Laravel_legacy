<?php

namespace Gerfey\Tests\Unit\Request\GameData\Hearthstone;

use Gerfey\BattleNet\Http\BattleNetClient;
use Gerfey\BattleNet\Regions\Europe;
use Gerfey\BattleNet\Request\GameData\Hearthstone\Cards;
use PHPUnit\Framework\TestCase;

class CardsTest extends TestCase
{
    private $access_token = "";

    public function testCardSearch()
    {
        $client = new BattleNetClient(new Europe(), $this->access_token);
        $response = new Cards($client);
        $cards = $response->cardSearch(['set' => 'rise-of-shadows', 'class' => 'mage']);
        $this->assertSame(200, $cards->getStatusCode());
    }

    public function testFetchOneCard()
    {
        $client = new BattleNetClient(new Europe(), $this->access_token);
        $response = new Cards($client);
        $cards = $response->fetchOneCard('52119-arch-villain-rafaam');
        $this->assertSame(200, $cards->getStatusCode());
    }
}
