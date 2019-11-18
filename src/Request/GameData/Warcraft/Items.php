<?php

namespace Gerfey\BattleNet\Request\GameData\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;

/**
 * Class Items
 * @package Gerfey\BattleNet\Request\GameData\Warcraft
 */
class Items extends Request
{
    /**
     * Returns an index of azerite essences.
     *
     * @return BattleNetResponseInterface
     */
    public function azeriteEssencesIndex(): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/azerite-essence/index');
    }

    /**
     * Returns an azerite essence by ID.
     *
     * @param int $azeriteEssenceId
     * @return BattleNetResponseInterface
     */
    public function azeriteEssence(int $azeriteEssenceId = 2): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/azerite-essence/' . $azeriteEssenceId);
    }

    /**
     * Returns an index of item classes.
     *
     * @return BattleNetResponseInterface
     */
    public function itemClassesIndex(): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/item-class/index');
    }

    /**
     * Returns an item class by ID.
     *
     * @param int $itemClassId
     * @return BattleNetResponseInterface
     */
    public function itemClass(int $itemClassId = 0): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/item-class/' . $itemClassId);
    }

    /**
     * Returns an item subclass by ID.
     *
     * @param int $itemClassId
     * @param int $itemSubclassId
     * @return BattleNetResponseInterface
     */
    public function itemSubclass(int $itemClassId = 0, int $itemSubclassId = 0): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/item-class/' . $itemClassId . '/item-subclass/' . $itemSubclassId);
    }

    /**
     * Returns an item by ID.
     *
     * @param int $itemId
     * @return BattleNetResponseInterface
     */
    public function item(int $itemId = 19019): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/item/' . $itemId);
    }

    /**
     * Returns media for an item by ID.
     *
     * @param int $itemId
     * @return BattleNetResponseInterface
     */
    public function itemMedia(int $itemId = 19019): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/media/item/' . $itemId);
    }
}