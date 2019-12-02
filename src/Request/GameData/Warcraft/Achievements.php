<?php

namespace Gerfey\BattleNet\Request\GameData\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;
use Gerfey\BattleNet\Traits\Utils;

/**
 * Class Achievements
 * @package Gerfey\BattleNet\Request\GameData\Warcraft
 */
class Achievements extends Request
{
    /**
     * Returns an index of achievement categories.
     *
     * @return BattleNetResponseInterface
     */
    public function achievementCategoriesIndex(): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/achievement-category/index');
    }

    /**
     * Returns an achievement category by ID.
     *
     * @param int $achievementCategoryId
     * @return BattleNetResponseInterface
     */
    public function achievementCategory(int $achievementCategoryId = 81): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/achievement-category/' . $achievementCategoryId);
    }

    /**
     * Returns an index of achievements.
     *
     * @return BattleNetResponseInterface
     */
    public function achievementIndex(): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/achievement/index');
    }

    /**
     * Returns an achievement by ID.
     *
     * @param int $achievementId
     * @return BattleNetResponseInterface
     */
    public function achievement(int $achievementId = 6): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/achievement/' . $achievementId);
    }

    /**
     * Returns media for an achievement by ID.
     *
     * @param int $achievementId
     * @return BattleNetResponseInterface
     */
    public function achievementMedia(int $achievementId = 6): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/media/achievement/' . $achievementId);
    }
}