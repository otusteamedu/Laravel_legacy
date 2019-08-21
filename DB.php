<?php

class DB
{

    var $link;

    /**
     * Подключение к базе данных
     */
    function connect() {

        $this->link = @mysqli_connect(HOST, USER, PASSWORD, DATABASE);
        if(!$this->link) {
            die('Внутренняя ошибка сервера, мы работаем над ее решением!');
        }
        self::query("SET NAMES 'utf8'");
        self::query("SET CHARACTER SET 'utf8'");
    }

    /**
     * Запрос к базе данных
     *
     * @param $query - строка запроса
     * @return bool|mysqli_result
     */
    function query($query) {

        return mysqli_query($this->link, $query); // or die("mysql error: " . mysqli_error($this->link));
    }

    /**
     * Запрос и получение данных в массиве
     *
     * @param $query - строка запроса
     * @return array
     */
    function query_fetch($query) {

        return self::fetch(self::query($query));
    }

    /**
     * Множественные запросы к базе данных
     *
     * @param $query - строка запроса
     * @return array
     */
    function multi_query($query) {

        $data = array();
        if (mysqli_multi_query($this->link, $query)) {
            do {
                /* получаем первый результирующий набор */
                if ($result = mysqli_store_result($this->link)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $data[] = $row;
                    }
                    mysqli_free_result($result);
                }
                if(!mysqli_more_results($this->link)) {
                    break;
                }
            } while (mysqli_next_result($this->link));
        }
        return $data;
    }

    /**
     * Получение данных из запроса в массив
     *
     * @param $result
     * @return array
     */
    function fetch($result) {

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
        return $this->link;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    function real_escape($var)
    {
        return mysqli_real_escape_string($this->link, $var);
    }
}