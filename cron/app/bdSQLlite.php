<?php

namespace cron\app;

class bdSQLlite
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

}