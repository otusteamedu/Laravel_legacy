<?php

class DB
{

    protected static $link;
    protected static $instance = null;

    final private function __construct() {}
    final private function __clone() {}

    /**
     * Подключение к базе данных
     */
    public static function instance() {

        if (self::$instance == null) {

            self::$link = @mysqli_connect(HOST, USER, PASSWORD, DATABASE);
            if (!self::$link) {
                die('Внутренняя ошибка сервера, мы работаем над ее решением!');
            }

            self::query("SET NAMES 'utf8'");
            self::query("SET CHARACTER SET 'utf8'");
        }
        return self::$instance;

    }

    /**
     * Запрос к базе данных
     *
     * @param $query - строка запроса
     * @return bool|mysqli_result
     */
    public static function query($query) {

        return mysqli_query(self::$link, $query); // or die("mysql error: " . mysqli_error($this->link));
    }

    /**
     * Запрос и получение данных в массиве
     *
     * @param $query - строка запроса
     * @return array
     */
    public static function query_fetch($query) {

        return self::fetch(self::query($query));
    }

    /**
     * Множественные запросы к базе данных
     *
     * @param $query - строка запроса
     * @return array
     */
    public static function multi_query($query) {

        $data = array();
        if (mysqli_multi_query(self::$link, $query)) {
            do {
                /* получаем первый результирующий набор */
                if ($result = mysqli_store_result(self::$link)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $data[] = $row;
                    }
                    mysqli_free_result($result);
                }
                if(!mysqli_more_results(self::$link)) {
                    break;
                }
            } while (mysqli_next_result(self::$link));
        }
        return $data;
    }

    /**
     * Получение данных из запроса в массив
     *
     * @param $result
     * @return array
     */
    public static function fetch($result) {

        $data = array();
        while($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return self::$link;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link)
    {
        self::$link = $link;
    }

    function real_escape($var)
    {
        return mysqli_real_escape_string(self::$link, $var);
    }
}