<?php

namespace Gerfey\BattleNet\Request\Community\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;

/**
 * Class Recipe
 * @package Gerfey\BattleNet\Request\Community\Warcraft
 */
class Recipe extends Request
{
    /**
     * Returns basic recipe information.
     * 
     * @param int $recipeId
     * @return BattleNetResponseInterface
     */
    public function recipe(int $recipeId = 33994): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/recipe/' . $recipeId);
    }
}