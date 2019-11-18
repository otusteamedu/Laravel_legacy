<?php

namespace Gerfey\Tests\Unit\Request\GameData\Hearthstone;

use Gerfey\BattleNet\Http\BattleNetClient;
use Gerfey\BattleNet\Regions\Europe;
use Gerfey\BattleNet\Request\GameData\Hearthstone\Metadata;
use PHPUnit\Framework\TestCase;

class MetadataTest extends TestCase
{
    private $access_token = "";

    public function testAllMetadata()
    {
        $client = new BattleNetClient(new Europe(), $this->access_token);
        $response = new Metadata($client);
        $decks = $response->allMetadata();
        $this->assertSame(200, $decks->getStatusCode());
    }

    public function testSpecificMetadata()
    {
        $client = new BattleNetClient(new Europe(), $this->access_token);
        $response = new Metadata($client);
        $decks = $response->specificMetadata('sets');
        $this->assertSame(200, $decks->getStatusCode());
    }
}
