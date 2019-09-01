<?php
/**
 * Created by PhpStorm.
 * User: Hollow
 * Date: 16.08.2019
 * Time: 22:23
 */

namespace cron\app;


class Phone implements ChekerLeadInfo
{
    public function queryBDrequest($params)
    {
        $db = new BdSQLlite();
        $params = htmlspecialchars($params);
        $sql = "SELECT id FROM addLead WHERE phone = '$params' AND msage = 'Ok'";
        $resalt = $db->openBD()->query($sql);
        $resaltBDLead = $resalt->fetchArray(SQLITE3_ASSOC);
        $sql = "DELETE FROM addLead WHERE id = '$resaltBDLead[id]'";
        $db->openBD()->query($sql);
        $db->openBD()->close();
    }
}