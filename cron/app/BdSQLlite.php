<?php

namespace cron\app;

class BdSQLlite
{
    /**
     * @return \SQLite3
     */
    public function openBD()
    {
        if (!file_exists("log.sqlite3")) {
            $db = new \SQLite3('log.sqlite3');
            $sql = "CREATE TABLE addLead(id INTEGER PRIMARY KEY, fname TEXT, email TEXT, phone TEXT, msage TEXT, datetime INTEGER)";
            $db->query($sql);
        } else {
            $db = new \SQLite3('log.sqlite3');
        }
        $db->busyTimeout(5000);
        $db->exec('PRAGMA journal_mode = wal;');
        return $db;
    }

    public function queryBDrequest($params, $type)
    {

        if ($type == 'selectAll') {
            $sql = "SELECT * FROM addLead";
            $resalt = $this->openBD()->query($sql);
            $resaltBDLead = $resalt->fetchArray(SQLITE3_ASSOC);
            $this->openBD()->close();
        } else {
            $params = htmlspecialchars($params);
            $sql = "SELECT id FROM addLead WHERE $type = '$params' AND msage = 'Ok'";
            $resalt = $this->openBD()->query($sql);
            $resaltBDLead = $resalt->fetchArray(SQLITE3_ASSOC);
            $sql = "DELETE FROM addLead WHERE id = '$resaltBDLead[id]'";
            $this->openBD()->query($sql);
            $this->openBD()->close();
        }
        return $resaltBDLead;
    }

}