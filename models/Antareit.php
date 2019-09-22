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

    public static function declination($num, $postfixes)
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