<?php

namespace Gerfey\BattleNet\Request\GameData\Hearthstone;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;

/**
 * Class Metadata
 * @package Gerfey\BattleNet\Request\GameData\Hearthstone
 */
class Metadata extends Request
{
    /**
     * Returns information about the categorization of cards. Metadata includes the card set, set group (for example, Standard or Year of the Dragon), rarity, class, card type, minion type, and keywords.
     * For more information, see the Hearthstone Guide(https://develop.battle.net/documentation/guides/game-data-apis-hearthstone-guide).
     *
     * @return BattleNetResponseInterface
     */
    public function allMetadata(): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/hearthstone/metadata');
    }

    /**
     * Returns information about just one type of metadata. For more information, see the Hearthstone Guide(https://develop.battle.net/documentation/guides/game-data-apis-hearthstone-guide).
     *
     * @param string $type
     * @return BattleNetResponseInterface
     */
    public function specificMetadata(string $type): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/hearthstone/metadata/' . $type);
    }
}