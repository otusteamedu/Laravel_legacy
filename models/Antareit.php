<?php

namespace Models\Antareit;
use DB;

class Antareit
{

    function checkEmail($email)
    {
        $query = sprintf("
            SELECT `uid`, `user_email` 
            FROM users 
            WHERE `user_email` = '%s'
        ", $email);
        $result = DB::query($query);
        if($result) {
            $emails = DB::fetch($result);
            if (isset($emails[0]['user_email']) and $emails[0]['user_email'] == $email)
                return true;
            else
                return false;
        }
        else
            return false;
    }

    function loginUser($udata)
    {
        $query = "
        
            SELECT * FROM users
            WHERE
                user_email = '" . $udata['user_email'] . "'
                AND user_password = '" . md5($udata['user_password']) . "'
        ";
        if ($result = DB::query($query)) {
            $user_data = DB::fetch($result);
            return $user_data[0];
        } else
            return false;
    }

    function generatePassword($number)
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

    function updateUserPassword($uid, $new_password)
    {
        $query = "
            UPDATE users 
            SET user_password = '" . md5($new_password) . "'
            WHERE uid = '" . $uid . "'
        ";
        DB::query($query);
    }

    function saveUserData($data)
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

    function getUserData($uid)
    {
        $query = "
            SELECT * FROM `user_data`
            WHERE `uid` = '{$uid}'
        ";
        $data = DB::query_fetch($query);
        return $data[0];
    }

    function restorePassword($key)
    {
        $query = "
                SELECT * FROM users
                WHERE CONCAT(MD5(uid), md5(user_email)) = '" . $key . "'
            ";
        $result = DB::query($query);
        $data = DB::fetch($result);

        $newpassword = self::generatePassword(6);

        self::updateUserPassword($data[0]['uid'], $newpassword);
        return array('email' => $data[0]['user_email'], 'password' => $newpassword);
    }

    function registerUser($udata)
    {
        global $config_points;
        $mail = new Mail();

        if (!self::checkEmail($udata['user_email'])) {
            $query = "SET @id=UUID_SHORT();";
            $query .= "
                INSERT INTO `users`
                (
                    `uid`,
                    `social_uid`,
                    `user_name`,
                    `user_email`,
                    `user_password`,
                    `user_verification`,
                    `user_points`,
                    `social_network`,	
                    `social_profile`,
                    `original_city`
                )
                VALUES
                (
                    @id,
                    '" . ((!empty($udata['social_id'])) ? $udata['social_id'] : '') . "',
                    '" . $udata['user_name'] . "',
                    '" . $udata['user_email'] . "',
                    '" . md5($udata['user_password']) . "',
                    '" . $udata['verified_email'] . "',
                    '0',
                    '" . $udata['social_network'] . "',	
                    '" . $udata['social_profile'] . "',
                    '" . $udata['original_city'] . "'
                );";
            $query .= "SELECT @id;";
            $uid = self::multi_query($query);
            $udata['uid'] = $uid[0]['@id'];
            $mail->sendRegistrationCompleteEmail($udata['user_email'], $udata['user_password']);
            self::addUserPoints($udata['uid'], 'registration', '', '', '', $config_points['registration']['points']);
            return $udata['uid'];
        } else
            return false;
    }

    function validateEmail($validation_code)
    {
        $query = "
            UPDATE users
            SET user_verification = '1' 
            WHERE CONCAT(MD5(uid), md5(user_email)) = '" . self::real_escape($validation_code) . "'
        ";
        if($result = DB::query($query)) {

            $query = "
                SELECT * FROM users
                WHERE CONCAT(MD5(uid), md5(user_email)) = '" . $validation_code . "'
            ";
            $result = DB::query($query);
            $data = DB::fetch($result);
            return $data[0];
        } else
            return false;
    }

    function checkShare($fid)
    {
        $query = "
            SELECT * FROM user_points 
            WHERE 
                uid = '" . $_SESSION['antareit']['uid'] . "'
                AND action = 'share'
                AND entity = 'fid'
                AND entity_id = '" . $fid . "'
        ";
        if(!DB::query_fetch($query))
            return true;
        else
            return false;
    }

    function addUserPoints($uid, $action = 'registration', $action_target = '',  $entity = '',  $entity_id = '', $points = 0)
    {
        $query = "
        INSERT INTO `user_points` 
        (
            `uid`,
            `action`, 
            `action_target`, 
            `entity`, 
            `entity_id`, 
            `points`,
            `timestamp` 
        )
        VALUES ( 
            '" . intval($uid) . "',
            '" . $action . "',
            '" . $action_target . "',
            '" . $entity . "',
            '" . $entity_id . "',
            '" . intval($points) . "',
            NOW()
        )";
        DB::query($query);

        $query = "
        UPDATE `users`
        SET 
            `user_points` = `user_points` + " . intval($points) . "
        WHERE
            `uid` = '" . intval($uid) . "'";
        DB::query($query);
    }

    function addFinished($data)
    {
        $query = "
            INSERT INTO `finished_matches`
            (
                `fmid`,
                `mid`,
                `fid`,
                `uid`,
                `points_added`
            )
            VALUES (
                NULL,
                {$data['mid']},
                {$data['fid']},
                {$data['uid']},
                {$data['points_added']}
            )
        ";
        DB::query($query);

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

    function getUserRaitings($stage)
    {
        global $config_points;
        $query = "
            SELECT 
                users.uid,
                users.user_name,
                users.user_email,
                users.user_points,
                users.reg_date,
                user_points.action,
                user_points.entity,
                user_points.entity_id,
                user_points.points,
                matches.stage,
                sum(user_points.points) as points_sum
            FROM users
            INNER JOIN user_points ON user_points.uid = users.uid AND user_points.action IN ('share', 'forecast')
            INNER JOIN user_forecasts ON user_forecasts.fid = user_points.entity_id
            INNER JOIN matches ON matches.mid = user_forecasts.mid AND matches.stage = '" . $stage . "'
            WHERE 
                users.user_points > 0
                AND users.user_verification = 1
            GROUP BY users.uid
            ORDER BY 
                points_sum DESC,
                users.uid
        ";
        $data = DB::query_fetch($query);

        foreach ($data as &$user_data) {

            $query = "
                SELECT
                    MIN(match_date) as min_date,
                    MAX(match_date) as max_date
                FROM matches
                WHERE stage = '" . $stage . "'
                
            ";
            $stage_date = DB::query_fetch($query);

            if((
                    $stage == 'g1'
                    AND $user_data['reg_date'] < $stage_date[0]['max_date']
                ) OR (
                    $user_data['reg_date'] > $stage_date[0]['min_date']
                    AND $user_data['reg_date'] < $stage_date[0]['max_date']
                )) {
                $user_data['points_sum'] = $user_data['points_sum'] + $config_points['registration']['points'];
            }
        }

        return $data;
    }

    function countUsers()
    {
        $query = "SELECT count(uid) as count_users FROM `users` WHERE user_verification = '1'";
        $data = DB::query_fetch($query);
        return $data[0]['count_users'];
    }

    function declination($num, $postfixes)
    {
        $num = $num % 100;
        if ($num > 19) {
            $num = $num % 10;
        }
        switch ($num) {
            case 1:
                return $postfixes[0];
            case 2:
            case 3:
            case 4:
                return $postfixes[1];
            default:
                return $postfixes[2];
        }
    }
}