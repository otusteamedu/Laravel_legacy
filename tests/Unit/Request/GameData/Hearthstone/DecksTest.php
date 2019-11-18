<?php

namespace Gerfey\Tests\Unit\Request\GameData\Hearthstone;

use Gerfey\BattleNet\Http\BattleNetClient;
use Gerfey\BattleNet\Regions\Europe;
use Gerfey\BattleNet\Request\GameData\Hearthstone\Decks;
use PHPUnit\Framework\TestCase;

class DecksTest extends TestCase
{
    private $access_token = "";

    public function testFetchDeck()
    {
        $client = new BattleNetClient(new Europe(), $this->access_token);
        $response = new Decks($client);
        $decks = $response->fetchDeck('AAECAQcG+wyd8AKS+AKggAOblAPanQMMS6IE/web8wLR9QKD+wKe+wKz/AL1gAOXlAOalAOSnwMA');
        $this->assertSame(200, $decks->getStatusCode());
    }
}
