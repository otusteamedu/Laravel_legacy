<?php

namespace Gerfey\BattleNet\Request\GameData\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;

/**
 * Class Title
 * @package Gerfey\BattleNet\Request\GameData\Warcraft
 */
class Title extends Request
{
    /**
     * Returns an index of titles.
     *
     * @return BattleNetResponseInterface
     */
    public function titleIndex(): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/title/index');
    }

    /**
     * Returns a title by ID.
     *
     * @param int $titleId
     * @return BattleNetResponseInterface
     */
    public function title(int $titleId = 1): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/title/' . $titleId);
    }
}