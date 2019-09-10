<?php

use Models\User;

class UserController
{

    function getUserId($email)
    {
        $query = sprintf("
            SELECT `uid`
            FROM users 
            WHERE `user_email` = '%s'
        ", $email);
        $result = DB::query($query);
        $data = DB::fetch($result);
        if (isset($data[0]['uid']))
            return $data[0]['uid'];
        else
            return false;
    }
}