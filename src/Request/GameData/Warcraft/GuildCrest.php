<?php

namespace Gerfey\BattleNet\Request\GameData\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;

/**
 * Class GuildCrest
 * @package Gerfey\BattleNet\Request\GameData\Warcraft
 */
class GuildCrest extends Request
{
    /**
     * Returns an index of guild crest media.
     *
     * @return BattleNetResponseInterface
     */
    public function guildCrestComponentsIndex(): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/guild-crest/index');
    }

    /**
     * Returns media for a guild crest border by ID.
     *
     * @param int $borderId
     * @return BattleNetResponseInterface
     */
    public function guildCrestBorderMedia(int $borderId = 0): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/media/guild-crest/border/' . $borderId);
    }

    /**
     * Returns media for a guild crest emblem by ID.
     *
     * @param int $emblemId
     * @return BattleNetResponseInterface
     */
    public function guildCrestEmblemMedia(int $emblemId = 0): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/media/guild-crest/emblem/' . $emblemId);
    }
}