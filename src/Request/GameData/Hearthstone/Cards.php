<?php

namespace Gerfey\BattleNet\Request\GameData\Hearthstone;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;

/**
 * Class Cards
 * @package Gerfey\BattleNet\Request\GameData\Hearthstone
 */
class Cards extends Request
{
    /**
     * Returns a specific card by using detailed search criteria. For more information about the search parameters, see the Hearthstone Guide(https://develop.battle.net/documentation/guides/game-data-apis-hearthstone-guide).
     *
     * @param array $parameters
     * @return BattleNetResponseInterface
     */
    public function cardSearch(array $parameters = []): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/hearthstone/cards', $parameters);
    }

    /**
     * Returns the card with an ID or slug that matches the one you specify. For more information, see the Hearthstone Guide.
     *
     * @param string $idOrSlug
     * @return BattleNetResponseInterface
     */
    public function fetchOneCard(string $idOrSlug): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/hearthstone/cards/' . $idOrSlug);
    }
}