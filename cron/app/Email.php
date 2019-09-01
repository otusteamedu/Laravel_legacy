<?php
/**
 * Created by PhpStorm.
 * User: Hollow
 * Date: 17.08.2019
 * Time: 14:12
 */

namespace cron\app;


class Email implements ChekerLeadInfo
{
    public function queryBDrequest($params)
    {
        $db = new BdSQLlite();
        $params = htmlspecialchars($params);
        $sql = "SELECT id FROM addLead WHERE email = '$params' AND msage = 'Ok'";
        $resalt = $db->openBD()->query($sql);
        $resaltBDLead = $resalt->fetchArray(SQLITE3_ASSOC);
        $sql = "DELETE FROM addLead WHERE id = '$resaltBDLead[id]'";
        $db->openBD()->query($sql);
        $db->openBD()->close();
    }
}