<?php

//namespace Auth;

use Models\User;


class Auth
{

    private $user;

    function __construct(
        User $user
    )
    {
        $this->user = $user;
    }

    function checkLogin()
    {
        if (!isset($_SESSION['antareit']['uid']))
            return false;
        else
            return true;
    }

    function loginUser($udata)
    {
        return $this->user->loginUser($udata['login'], $udata['password']);
    }

    public static function generatePassword($number)
    {
        $arr = array('a','b','c','d','e','f',
            'g','h','i','j','k','l',
            'm','n','o','p','r','s',
            't','u','v','x','y','z',
            'A','B','C','D','E','F',
            'G','H','I','J','K','L',
            'M','N','O','P','R','S',
            'T','U','V','X','Y','Z',
            '1','2','3','4','5','6',
            '7','8','9','0','!');
        $pass = "";
        for($i = 0; $i < $number; $i++)
        {
            $index = rand(0, count($arr) - 1);
            $pass .= $arr[$index];
        }
        return $pass;
    }

}