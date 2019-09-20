<?php

namespace Models\User;

use DB;

class User
{

    public static function getIdByEmail($email)
    {
        $query = sprintf("
            SELECT `uid`
            FROM users 
            WHERE `user_email` = '%s'
        ", $email);
        $result = DB::query($query);
        $data = DB::fetch($result);
        return $data[0]['uid'];
    }

    function getUser($uid)
    {
        $query = sprintf("
            SELECT *
            FROM users 
            WHERE `uid` = '%s'
        ", $uid);
        $result = DB::query($query);
        $data = DB::fetch($result);
        return $data[0];
    }
}