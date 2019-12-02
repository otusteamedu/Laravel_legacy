<?php

namespace Gerfey\BattleNet\Request\GameData\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;

/**
 * Class MythicKeystoneDungeon
 * @package Gerfey\BattleNet\Request\GameData\Warcraft
 */
class MythicKeystoneDungeon extends Request
{
    /**
     * Returns an index of Mythic Keystone dungeons.
     *
     * @return BattleNetResponseInterface
     */
    public function mythicKeystoneDungeonsIndex(): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/data/wow/mythic-keystone/dungeon/index');
    }

    /**
     * Returns a Mythic Keystone dungeon by ID.
     *
     * @param int $dungeonId
     * @return BattleNetResponseInterface
     */
    public function mythicKeystoneDungeon(int $dungeonId = 353): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/data/wow/mythic-keystone/dungeon/' . $dungeonId);
    }

    /**
     * Returns an index of links to other documents related to Mythic Keystone dungeons.
     *
     * @return BattleNetResponseInterface
     */
    public function mythicKeystoneIndex(): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/data/wow/mythic-keystone/index');
    }

    /**
     * Returns an index of Mythic Keystone periods.
     *
     * @return BattleNetResponseInterface
     */
    public function mythicKeystonePeriodsIndex(): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/data/wow/mythic-keystone/period/index');
    }

    /**
     * Returns a Mythic Keystone period by ID.
     *
     * @param int $periodId
     * @return BattleNetResponseInterface
     */
    public function  mythicKeystonePeriod(int $periodId = 641): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/data/wow/mythic-keystone/period/' . $periodId);
    }

    /**
     * Returns an index of Mythic Keystone seasons.
     *
     * @return BattleNetResponseInterface
     */
    public function mythicKeystoneSeasonsIndex(): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/data/wow/mythic-keystone/season/index');
    }

    /**
     * Returns a Mythic Keystone season by ID.
     *
     * @param int $seasonId
     * @return BattleNetResponseInterface
     */
    public function  mythicKeystoneSeason(int $seasonId = 1): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/data/wow/mythic-keystone/season/' . $seasonId);
    }
}