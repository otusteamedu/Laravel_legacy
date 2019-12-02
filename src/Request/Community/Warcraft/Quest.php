<?php

namespace Gerfey\BattleNet\Request\Community\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;

/**
 * Class Quest
 * @package Gerfey\BattleNet\Request\Community\Warcraft
 */
class Quest extends Request
{
    /**
     * Returns metadata for a specified quest.
     *
     * @param int $questId
     * @return BattleNetResponseInterface
     */
    public function quest(int $questId = 13146): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/quest/' . $questId);
    }
}