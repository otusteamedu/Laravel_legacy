<?php

use Models\User;

class UserController
{

    function getUserId($email)
    {
        return User::getIdByEmail($email);
    }

    function getUser($uid)
    {
        return User::getUser($uid);
    }
}