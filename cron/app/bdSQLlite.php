<?php

namespace cron\app;

class bdSQLlite
{
    /**
     * @return \SQLite3
     */
    public function openBD()
    {
        //проверим существует ли БД
        //если БД нет то создадим её и таблицу в ней msages
        if (!file_exists("log.sqlite3")) {
            $db = new \SQLite3('log.sqlite3');
            $sql = "CREATE TABLE sendEmail(id INTEGER PRIMARY KEY, fname TEXT, email TEXT, msage TEXT, datetime INTEGER)";
            $db->query($sql);
            $sql = "CREATE TABLE addLead(id INTEGER PRIMARY KEY, fname TEXT, email TEXT, phone TEXT, msage TEXT, datetime INTEGER)";
            $db->query($sql);
            $sql = "CREATE TABLE createUserMoodle(id INTEGER PRIMARY KEY, fname TEXT, email TEXT, msage TEXT, datetime INTEGER)";
            $db->query($sql);
        } else {
            //если бд есть то просто подключ. к ней
            $db = new \SQLite3('log.sqlite3');
        }

        return $db;
    }

}