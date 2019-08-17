<?php
/**
 * Created by PhpStorm.
 * User: Hollow
 * Date: 17.08.2019
 * Time: 14:33
 */

namespace cron\app;


class EmptyBD implements ChekerLeadInfo
{
    public function queryBDrequest($params)
    {
        $db = new BdSQLlite();
        $sql = "SELECT * FROM addLead";
        $resalt = $db->openBD()->query($sql);
        $resaltBDLead = $resalt->fetchArray(SQLITE3_ASSOC);
        $db->openBD()->close();
        return $resaltBDLead;
    }
}