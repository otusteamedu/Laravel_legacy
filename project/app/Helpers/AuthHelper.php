<?php
/**
 * Класс для работы с авторизацией (т.к авторизация должна быть сделана через задницу(требования), стандартными способами
 *  как реализовать не нашел)
 *
 */
namespace App\Helpers;

use App\Models\Client;
use SimpleXMLElement;

class AuthHelper
{
    /**
     * Проверяет, есть ли пользователь, данные которого лежат в xml элементе
     *
     * @param $authElement SimpleXMLElement
     * @return bool
     */
    public static function checkAuth(SimpleXMLElement $authElement)
    {
        $login = (string) $authElement->attributes()->login;
        $password = (string) $authElement->attributes()->pass;
        $isClientExist = Client::where('login', $login)
            ->where('pass', $password)
            ->count();
        return $isClientExist ? true : false;
    }
}