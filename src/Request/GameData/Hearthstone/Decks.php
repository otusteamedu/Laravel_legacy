<?php

namespace Gerfey\BattleNet\Request\GameData\Hearthstone;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;

/**
 * Class Decks
 * @package Gerfey\BattleNet\Request\GameData\Hearthstone
 */
class Decks extends Request
{
    /**
     * Finds a deck by its deck code. For more information, see the Hearthstone Guide(https://develop.battle.net/documentation/guides/game-data-apis-hearthstone-guide).
     *
     * @param string $deckCode
     * @return BattleNetResponseInterface
     */
    public function fetchDeck(string $deckCode): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/hearthstone/deck/' . $deckCode);
    }
}