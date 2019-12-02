<?php

namespace Gerfey\BattleNet\Request\Community\Warcraft;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Request\Request;

/**
 * Class GuildProfile
 * @package Gerfey\BattleNet\Request\Community\Warcraft
 */
class GuildProfile extends Request
{
    /**
     * The guild profile API is the primary way to access guild information. This API can fetch a single guild at a time through an HTTP GET request to a URL describing the guild profile resource. By default, these requests return a basic dataset and each request can retrieve zero or more additional fields.
     * Although this endpoint has no required query string parameters, requests can optionally pass the fields query string parameter to indicate that one or more of the optional datasets is to be retrieved. Those additional fields are listed in the method titled "Optional Fields".
     *
     * @param string $realm
     * @param string $guildName
     * @param string $fields
     * @return BattleNetResponseInterface
     */
    public function guild(string $realm = 'Ревущий Фьорд', string $guildName = 'Вольные', string $fields = 'achievements,challenge'): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/guild/' . $realm . '/' . $guildName, ['fields' => $fields]);
    }

    /**
     * Returns a list of characters that are members of the guild. When the members list is requested, a list of character objects is returned. Each object in the returned members list contains a character block as well as a rank field.
     *
     * @param string $realm
     * @param string $guildName
     * @return BattleNetResponseInterface
     */
    public function members(string $realm = 'Ревущий Фьорд', string $guildName = 'Вольные'): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/guild/' . $realm . '/' . $guildName, ['fields' => 'members']);
    }

    /**
     * A set of data structures that describe the achievements earned by the guild. When requesting achievement data, several sets of data will be returned.
     *
     * @param string $realm
     * @param string $guildName
     * @return BattleNetResponseInterface
     */
    public function achievements(string $realm = 'Ревущий Фьорд', string $guildName = 'Вольные'): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/guild/' . $realm . '/' . $guildName, ['fields' => 'achievements']);
    }

    /**
     * A set of data structures that describe the guild's news feed. When the news feed is requested, this resource returns a list of news objects. Each one has a type, a timestamp, and some other data depending on the type: itemId, an achievement object, and so on.
     *
     * @param string $realm
     * @param string $guildName
     * @return BattleNetResponseInterface
     */
    public function news(string $realm = 'Ревущий Фьорд', string $guildName = 'Вольные'): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/guild/' . $realm . '/' . $guildName, ['fields' => 'news']);
    }

    /**
     * The top three challenge mode guild run times for each challenge mode map.
     *
     * @param string $realm
     * @param string $guildName
     * @return BattleNetResponseInterface
     */
    public function challenge(string $realm = 'Ревущий Фьорд', string $guildName = 'Вольные'): BattleNetResponseInterface
    {
        return $this->createRequest('GET', '/wow/guild/' . $realm . '/' . $guildName, ['fields' => 'challenge']);
    }
}