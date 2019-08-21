<?php

class Matches extends Antareit
{

    function addTeam($team_tag, $team_name)
    {
        $query = "
            INSERT INTO teams (
                `tid`,
                `team_name`,
                `team_tag`,
                `team_flag`
            ) VALUES (
                NULL,
                '$team_name',
                '$team_tag',
                '$team_tag'
            )
        ";
        self::query($query);
    }

    function addMatch($stage, $team1, $team2, $date)
    {
        $query = "
            INSERT INTO matches (
                `mid`,
                `stage`,
                `team1`,
                `team2`,
                `match_date`
            ) VALUES (
                NULL,
                '$stage',
                '$team1',
                '$team2',
                '$date'
            )
        ";
        self::query($query);
    }

    function getFinishedNotPointedMatches()
    {
        $query = "
            SELECT matches.*, team1.`team_name` as team1_name, team2.`team_name` as team2_name
            FROM matches 
            LEFT JOIN teams as team1 ON matches.team1 = team1.`team_tag`
            LEFT JOIN teams as team2 ON matches.team2 = team2.`team_tag`
            WHERE finished = '1' AND pointed = '0'
        ";
        $result = self::query($query);
        $data = self::fetch($result);
        return $data;
    }

    function getMatches($stage='')
    {
        $query = "
            SELECT matches.*, team1.`team_name` as team1_name, team2.`team_name` as team2_name
            FROM matches 
            LEFT JOIN teams as team1 ON matches.team1 = team1.`team_tag`
            LEFT JOIN teams as team2 ON matches.team2 = team2.`team_tag`
        ";
        if(!empty($stage))
            $query .= "
                WHERE matches.`stage` = '$stage'
            ";
        $query .= "
                ORDER BY matches.`match_date`
            ";
        $result = self::query($query);
        $data = self::fetch($result);
        return $data;
    }

    function getMatch($mid='')
    {
        $query = "
            SELECT 
              matches.*, 
              team1.`team_name` as team1_name, team2.`team_name` as team2_name,
              team1.`team_tag` as team1_tag, team2.`team_tag` as team2_tag
            FROM matches 
            LEFT JOIN teams as team1 ON matches.team1 = team1.`team_tag`
            LEFT JOIN teams as team2 ON matches.team2 = team2.`team_tag`
        ";
        $query .= "
            WHERE matches.`mid` = '$mid'
        ";
        $result = self::query($query);
        $data = self::fetch($result);
        return $data[0];
    }

    function addMatchResults($mid, $team1_goals, $team2_goals)
    {
        $query = "
            UPDATE matches SET
                `team1_goals` = '$team1_goals',
                `team2_goals` = '$team2_goals',
                `finished` = 1
            WHERE `mid` = '$mid' AND `finished` = 0
        ";
        self::query($query);
    }

    function addUserForecast($mid, $uid, $team1_goals, $team2_goals)
    {
        $winner = "team2";
        if($team1_goals > $team2_goals)
            $winner = "team1";
        if($team1_goals == $team2_goals)
            $winner = "draw";
        $query = "
            INSERT INTO user_forecasts (
                `fid`,
                `uid`,
                `mid`,
                `fcast1_goals`,
                `fcast2_goals`,
                `fcast_winner`
            ) VALUES (
                NULL,
                '$uid',
                '$mid',
                '$team1_goals',
                '$team2_goals',
                '$winner'
            )
        ";
        self::query($query);

        $query = "SELECT fid FROM user_forecasts WHERE mid = '" . $mid . "' AND uid = '" . $uid . "'";
        return self::query_fetch($query);
    }

    function getUserForecasts($uid, $mid = '')
    {
        $query = "
            SELECT user_forecasts.* 
            FROM user_forecasts 
            LEFT JOIN matches ON matches.mid = user_forecasts.mid
            WHERE
                user_forecasts.`uid` = '$uid'
        ";
        if(!empty($mid))
            $query .= "
                AND user_forecasts.`mid` = '$mid'
            ";
        $query .= "
                ORDER BY matches.`match_date`
            ";
        $result = self::query($query);
        $data = self::fetch($result);
        return $data;
    }

    function getForecast($fid)
    {
        $query = "
            SELECT 
                user_forecasts.*, 
                team1.team_name as team1_name, 
                team2.team_name as team2_name, 
                team1.team_tag as team1_tag, 
                team2.team_tag as team2_tag, 
                matches.match_date,
                users.* 
            FROM user_forecasts 
            LEFT JOIN matches ON matches.mid = user_forecasts.mid
            LEFT JOIN teams as team1 ON team1.team_tag = matches.team1
            LEFT JOIN teams as team2 ON team2.team_tag = matches.team2
            LEFT JOIN users ON users.uid = user_forecasts.uid
            WHERE
                user_forecasts.`fid` = '$fid'
        ";
        $result = self::query($query);
        $data = self::fetch($result);
        return $data;
    }

    function checkUserForecast($uid, $mid)
    {
        $query = "
            SELECT user_forecasts.*, users.* 
            FROM user_forecasts 
            LEFT JOIN matches ON matches.mid = user_forecasts.mid
            LEFT JOIN users ON users.uid = user_forecasts.uid
            WHERE
                user_forecasts.`uid` = '$uid'
                AND user_forecasts.`mid` = '$mid'
        ";
        $result = self::query($query);
        $data = self::fetch($result);
        return $data;
    }

    function dateFormat($mysqlFormat)
    {
        $time = strtotime($mysqlFormat);
        $date = date("d.m H:i", $time);
        return str_replace(" ", "<br>", $date);
    }

    function getMatchForecasts($mid)
    {
        $query = "
                SELECT * FROM user_forecasts
                WHERE mid = '" . $mid . "'
        ";
        $result = self::query($query);
        $data = self::fetch($result);
        return $data;
    }

    function getMatchForecastsStat($mid)
    {
        $query = "
            SELECT (
                SELECT count(mid) FROM user_forecasts
                WHERE mid = '" . $mid . "'
            ) as plays, 
            (
                SELECT count(fcast_winner) FROM user_forecasts
                WHERE mid = '" . $mid . "' AND fcast_winner = 'team1'
            ) as team1_wins,
            (
                SELECT count(fcast_winner) FROM user_forecasts
                WHERE mid = '" . $mid . "' AND fcast_winner = 'team2'
            ) as team2_wins,
            (
                SELECT count(fcast_winner) FROM user_forecasts
                WHERE mid = '" . $mid . "' AND fcast_winner = 'draw'
            ) as draws
        ";
        $result = self::query($query);
        $data = self::fetch($result);
        return $data[0];
    }
}