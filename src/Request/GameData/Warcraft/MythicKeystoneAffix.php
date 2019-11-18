<?php

namespace Gerfey\BattleNet\Request\GameData\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;

/**
 * Class MythicKeystoneAffix
 * @package Gerfey\BattleNet\Request\GameData\Warcraft
 */
class MythicKeystoneAffix extends Request
{
    /**
     * Returns a index of mythic keystone affixes.
     *
     * @return BattleNetResponseInterface
     */
    public function mythicKeystoneAffixesIndex(): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/keystone-affix/index');
    }

    /**
     * Returns a mythic keystone affix by ID.
     *
     * @param int $keystoneAffixId
     * @return BattleNetResponseInterface
     */
    public function mythicKeystoneAffix(int $keystoneAffixId = 1): BattleNetResponseInterface
    {
        $this->setNamespace('static');
        return $this->createRequest('GET', '/data/wow/keystone-affix/' . $keystoneAffixId);
    }
}