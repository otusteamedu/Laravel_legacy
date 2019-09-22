<?php

namespace Models;

use Auth;
use DB;

class User
{

    public static function saveUserData($data)
    {
        $query = "
            INSERT INTO `user_data` (
                `uid`,
                `user_phone`,
                `user_address`,
                `user_comment`
            ) VALUES (
                {$data['uid']},
                '{$data['user_phone']}',
                '{$data['user_address']}',
                '{$data['user_comment']}'
            ) ON DUPLICATE KEY UPDATE 
                `user_phone` = '{$data['user_phone']}',
                `user_address` = '{$data['user_address']}',
                `user_comment` = '{$data['user_comment']}'
        ";
        return DB::query($query);
    }

    public static function loginUser($userLogin, $userPassword)
    {
        $query = "
        
            SELECT * FROM users
            WHERE
                user_email = '" . $userLogin . "'
                AND user_password = '" . md5($userPassword) . "'
        ";
        if ($result = DB::query($query)) {
            $user_data = DB::fetch($result);
            return $user_data[0];
        }
        return false;
    }

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

    public static function getUser($uid)
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

    public static function updateUserPassword($userId, $password)
    {
        $query = "
            UPDATE users 
            SET user_password = '" . md5($password) . "'
            WHERE uid = '" . $userId . "'
        ";
        DB::query($query);
    }

    public static function restoreUserPassword($key)
    {
        $query = "
                SELECT * FROM users
                WHERE CONCAT(MD5(uid), md5(user_email)) = '" . $key . "'
            ";
        $result = DB::query($query);
        $data = DB::fetch($result);

        $newPassword = Auth::generatePassword(6);

        self::updateUserPassword($data[0]['uid'], $newPassword);
        return array('email' => $data[0]['user_email'], 'password' => $newPassword);
    }

    public static function countUsers()
    {
        $query = "SELECT count(uid) as count_users FROM `users` WHERE user_verification = '1'";
        $data = DB::query_fetch($query);
        return $data[0]['count_users'];
    }

    function getUserPoints($uid)
    {
        $query = "SELECT * FROM `users` WHERE `uid` = '" . $uid . "'";
        $data = DB::query_fetch($query);
        if(isset($data[0]))
            return $data[0]['user_points'];
        else
            return false;
    }

    function getUserPointsHistory($uid)
    {
        $query = "SELECT * FROM `user_points` WHERE `uid` = '" . $uid . "'";
        $data = DB::query_fetch($query);
        return $data;
    }

    function getUsers()
    {
        $query = "SELECT * FROM `users` WHERE `user_points` > 0 AND `user_verification` = 1 ORDER BY `user_points` DESC, `uid`";
        $data = DB::query_fetch($query);
        return $data;
    }


}