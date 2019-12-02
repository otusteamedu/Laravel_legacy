<?php

namespace Gerfey\Tests\Unit\Request\Profile\Warcraft;

use Gerfey\BattleNet\Http\BattleNetClient;
use Gerfey\BattleNet\Regions\Europe;
use Gerfey\BattleNet\Request\Profile\Warcraft\Character;
use PHPUnit\Framework\TestCase;

class CharacterTest extends TestCase
{
    private $access_token = "";

    public function testCharacterProfile()
    {
        $client = new BattleNetClient(new Europe(), $this->access_token);
        $response = new Character($client);
        $characterProfile = $response->characterProfile('Howling Fjord', 'Пуфка');
        $this->assertSame(200, $characterProfile->getStatusCode());
    }
}
