<?php

namespace Gerfey\BattleNet\Request\Community\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;

/**
 * Class Spell
 * @package Gerfey\BattleNet\Request\Community\Warcraft
 */
class Spell extends Request
{
    /**
     * Returns information about spells.
     *
     * @param int $spellId
     * @return BattleNetResponseInterface
     */
    public function spell(int $spellId = 13146): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/spell/' . $spellId);
    }
}