<?php
/*
 * $LastChangedDate: 2011-06-06 18:33:13 +0400 (Mon, 06 Jun 2011) $
 * $Revision: 112 $
 * $Author: michael_in_office $
 */
SetDefine("CASHE_TIME");
require_once 'class_base.php';

class Cashe extends Base
{

    var $cache_page = true;

    var $cache_site = true;

    var $table = "ta_menu";

    var $file;

    var $cashe_dir;

    var $file_path;

    var $template_dir = "/";

    function __construct()
    {
        if (BASE_URL == 'www.xxx.ru') {
            $this->cashe_dir = "../../includes/cashe/www.xxx.ru/pages/";
        } else {
            $this->cashe_dir = "../../includes/cashe/www.xxx.ru/pages/";
        }
        $this->GenerateCacheFilePath();
    }

    /**
     * функция поиска и загрузки файла включения
     *
     * @param $filenames
     *
     * @return mixed
     */
    function Load($filenames)
    {
        global $user;
        global $user_price;
        $filecontent = include $filenames;
        return $filecontent;
    }

    /**
     * проверка: можно ли использовать кэш файл
     *
     * @param $id
     * @param $table
     * @param $file
     *
     * @return bool
     */
    function CheckCasheTime($id, $table, $file)
    {
        global $page;
        $filecashe = $this->cashe_dir . $file;

        if ($page->otladka) {
            $page->SetError("Файл кеша - " . $filecashe);
        }

        if (!file_exists($filecashe)) {
            return false;
        }

        if (CheckCashe($id, $table) == N) {
            return false;
        }

        if ($page->info["change_time_unix"]) {
            $filetimecashe = $page->info["change_time_unix"];
            if ($page->otladka) {
                $page->SetError(
                    "Используем дату изменения из info - "
                    . $page->info["change_time_unix"]
                );
            }
        } else {
            $query
                = "SELECT UNIX_TIMESTAMP(change_time) FROM $table WHERE id=$id";
            $rezult = mysql_query($query);
            $row = mysql_fetch_array($rezult);
            $filetimecashe = $row[0];
            if ($page->otladka) {
                $page->SetError(
                    "Используем дату изменения из базы данных - "
                    . $filetimecashe
                );
            }
        }
        $timefilecashe = filemtime($filecashe);

        if ($page->otladka) {
            $page->SetError("Время изменения файла кеша - " . $timefilecashe);
        }
        if ($page->otladka) {
            $page->SetError("Время глобального кеша - " . CASHE_TIME);
        }

        if ($filetimecashe > $timefilecashe || CASHE_TIME > $timefilecashe) {
            return false;
        }
        return true;
    }

    /**
     * @param $id
     * @param $table
     *
     * @return mixed
     */
    function CheckCashe($id, $table)
    {
        global $page;
        if ($page->id == $id && $page->db_table == $table
            && $page->info["cashe"]
        ) {
            return $page->info["cashe"];
        } else {
            $query = "SELECT cashe FROM $table WHERE id="
                . mysql_real_escape_string($id) . "";
            $rezult = mysql_query($query);
            if (is_resource($rezult)) {
                $row = mysql_fetch_array($rezult);
                return $row[0];
            }
        }
    }

    /**
     * функция для вывода некэшируемого файла
     *
     * @param string $filename
     */
    function LoadNC($filename)
    {
        global $user;
        global $user_price;
        global $content_page_ob_start;
        global $page_content;
        global $page_content_cashe;

        $Output = ob_get_contents();
        if ($content_page_ob_start) {
            $page_content .= $Output;
            $page_content_cashe .= $Output;
        } else {
            $GLOBALS["Output"] = $GLOBALS["Output"] . $Output;
            $GLOBALS["OutputNC"] = $GLOBALS["OutputNC"] . $Output;
        }
        ob_end_clean();
        ob_start();
        Load($filename);
        $Output = ob_get_contents();
        ob_end_clean();
        if ($content_page_ob_start) {
            $page_content .= $Output;
            $page_content_cashe .= '<? Load("' . $filename . '"); ?' . '>';
        } else {
            $GLOBALS["Output"] = $GLOBALS["Output"] . $Output;
            $GLOBALS["OutputNC"] = $GLOBALS["OutputNC"] . '<? Load("'
                . $filename . '"); ?' . '>';
        }
        ob_start();
    }

    /**
     * функция для вывода некэшируемого кода при нахождении продукта в корзине
     * заказа
     *
     * @param string $id
     * @param string $id
     */
    function LoadNCShopingcart($id, $message)
    {
        global $content_page_ob_start;
        global $page_content;
        global $page_content_cashe;
        global $shopingcart;
        $Output = ob_get_contents();
        if ($content_page_ob_start) {
            $page_content .= $Output;
            $page_content_cashe .= $Output;
        } else {

            $GLOBALS["Output"] = $GLOBALS["Output"] . $Output;
            $GLOBALS["OutputNC"] = $GLOBALS["OutputNC"] . $Output;
        }
        ob_end_clean();
        ob_start();
        if (isset($shopingcart->products_id_in_cart[$id])) {
            echo $message;
        }
        $Output = ob_get_contents();
        ob_end_clean();
        if ($content_page_ob_start) {
            $page_content .= $Output;
            $page_content_cashe .= '<? if(isset($GLOBALS["shopingcart"]->products_id_in_cart["'
                . $id . '"])) echo "' . $message . '"; ?' . '>';
        } else {
            $GLOBALS["Output"] = $GLOBALS["Output"] . $Output;
            $GLOBALS["OutputNC"] = $GLOBALS["OutputNC"]
                . '<? if(isset($GLOBALS["shopingcart"]->products_id_in_cart["'
                . $id . '"])) echo "' . $message . '"; ?' . '>';
        }
        ob_start();
    }

    /**
     * функция для вывода некэшируемой цены
     *
     * @param $model_id
     *
     * @internal param string $filename
     */
    function LoadNCPrice($model_id, $domen = false)
    {
        global $user;
        global $user_price;
        global $content_page_ob_start;
        global $page_content;
        global $page_content_cashe;
        $Output = ob_get_contents();
        if ($content_page_ob_start) {
            $page_content .= $Output;
            $page_content_cashe .= $Output;
        } else {

            $GLOBALS["Output"] = $GLOBALS["Output"] . $Output;
            $GLOBALS["OutputNC"] = $GLOBALS["OutputNC"] . $Output;
        }
        ob_end_clean();
        ob_start();
        $user_price->Shop_Format_price_Razdel($model_id, $domen);
        $Output = ob_get_contents();
        ob_end_clean();
        if ($content_page_ob_start) {
            $page_content .= $Output;
            $page_content_cashe .= '<? $user_price->Shop_Format_price_Razdel('
                . $model_id . '); ?' . '>';
        } else {
            $GLOBALS["Output"] = $GLOBALS["Output"] . $Output;
            $GLOBALS["OutputNC"] = $GLOBALS["OutputNC"]
                . '<? $user_price->Shop_Format_price_Razdel(' . $model_id
                . '); ?' . '>';
        }
        ob_start();
    }

    /**
     * функция для вывода некэшируемой информации о городе для которого стоят
     * цены
     *
     * @internal param string $filename
     */
    function LoadNCPriceCity()
    {
        global $user;
        global $user_price;
        global $content_page_ob_start;
        global $page_content;
        global $page_content_cashe;

        $Output = ob_get_contents();
        if ($content_page_ob_start) {
            $page_content .= $Output;
            $page_content_cashe .= $Output;
        } else {

            $GLOBALS["Output"] = $GLOBALS["Output"] . $Output;
            $GLOBALS["OutputNC"] = $GLOBALS["OutputNC"] . $Output;
        }
        ob_end_clean();
        ob_start();
        $user_price->Shop_Format_price_Razdel_Cityinfo();
        $Output = ob_get_contents();
        ob_end_clean();
        if ($content_page_ob_start) {
            $page_content .= $Output;
            $page_content_cashe .= '<? $user_price->Shop_Format_price_Razdel_Cityinfo(); ?'
                . '>';
        } else {
            $GLOBALS["Output"] = $GLOBALS["Output"] . $Output;
            $GLOBALS["OutputNC"] = $GLOBALS["OutputNC"]
                . '<? $user_price->Shop_Format_price_Razdel_Cityinfo(); ?'
                . '>';
        }
        ob_start();
    }

    /**
     * функция для вывода некэшируемой информации о городе для которого стоят
     * цены на странице заказа продукции
     *
     * @internal param string $filename
     */
    function LoadNCPriceCityZakaz()
    {
        global $user;
        global $user_price;
        global $content_page_ob_start;
        global $page_content;
        global $page_content_cashe;

        $Output = ob_get_contents();
        if ($content_page_ob_start) {
            $page_content .= $Output;
            $page_content_cashe .= $Output;
        } else {

            $GLOBALS["Output"] = $GLOBALS["Output"] . $Output;
            $GLOBALS["OutputNC"] = $GLOBALS["OutputNC"] . $Output;
        }
        ob_end_clean();
        ob_start();
        $user_price->Shop_Format_price_Razdel_Cityinfo_zakaz();
        $Output = ob_get_contents();
        ob_end_clean();
        if ($content_page_ob_start) {
            $page_content .= $Output;
            $page_content_cashe .= '<? $user_price->Shop_Format_price_Razdel_Cityinfo_zakaz(); ?'
                . '>';
        } else {
            $GLOBALS["Output"] = $GLOBALS["Output"] . $Output;
            $GLOBALS["OutputNC"] = $GLOBALS["OutputNC"]
                . '<? $user_price->Shop_Format_price_Razdel_Cityinfo_zakaz(); ?'
                . '>';
        }
        ob_start();
    }

    /**
     * функция для извлечения кэшированного содержимого
     *
     * @param        $id
     * @param string $wherefield
     * @param string $field
     * @param string $table
     *
     * @return bool|string
     */
    function Cash_Get($id, $wherefield = "id_menu", $field = "url",
        $table = "ta_menu_cashe"
    ) {

        if ($this->cache_site) {
            if ($field == "url" && isset($GLOBALS["menucashe"]["url"]["$id"])) {

                return $GLOBALS["menucashe"]["url"][$id];
            } else {

                $cashe_guery = "SELECT " . $field . " FROM " . $table
                    . " WHERE " . $wherefield . " = '" . $id . "'";

                $GLOBALS["allquery"][] = $cashe_guery;
                $rezult = mysql_query($cashe_guery);
                if (mysql_num_rows($rezult)) {

                    $res = mysql_result($rezult, 0);
                    if ($field == "url") {
                        $GLOBALS["menucashe"]["url"][$id] = $res;
                    }
                    if ($res != "") {
                        return $res;
                    }
                }
            }
        } else {
            return false;
        }
    }

    /**
     * функция для апдейта кэшированного содержимого
     *
     * @param        $id
     * @param        $output
     * @param string $wherefield
     * @param string $field
     * @param string $table
     */
    function Cash_Update($id, $output, $wherefield = "id", $field = "url",
        $table = "ta_menu_cashe"
    ) {

        if ($this->cache_site) {
            $cashe_guery = "UPDATE  " . $table . " SET " . $field . "='"
                . $output . "' WHERE " . $wherefield . "='" . $id . "'";
            //echo $cashe_guery;
            $rezult = mysql_query($cashe_guery) or die(
            $this->Die_Error(
                "errorCash_Update"
            )
            );
        }
    }

    /**
     * функция для вставки кэшированного содержимого
     *
     * @param        $id
     * @param        $output
     * @param string $wherefield
     * @param string $field
     * @param string $table
     */
    function Cash_Insert($id, $output, $wherefield = "id_menu", $field = "url",
        $table = "ta_menu_cashe"
    ) {

        if ($this->cache_site) {
            $cashe_guery = "INSERT  " . $table . " SET " . $field . "='"
                . $output . "', " . $wherefield . "='" . $id . "'";
            //echo $cashe_guery;
            $rezult = mysql_query($cashe_guery) or die(
            $this->Die_Error(
                "errorCash_Insert " . $cashe_guery . mysql_error()
            )
            );
        }
    }


    /**
     * @param        $block_template
     * @param        $id
     * @param string $wherefield
     * @param string $field
     * @param string $table
     *
     * @return bool|string
     */
    function LoadCasheBlock($block_template, $id, $wherefield = "id",
        $field = "url", $table = "ta_menu_cashe"
    ) {
        global $page;
        global $user;
        if ($content = $this->Cash_Get($id, $wherefield, $field)) {
            return $content;
        } else {
            ob_start();
            include("$block_template");
            $content = ob_get_contents();
            ob_end_clean();
            $this->Cash_Insert($id, addslashes($content), $wherefield, $field);
            return $content;
        }
    }

    /**
     * Функция очистки кэша страницы
     *
     * @param $page_id
     */
    function ClearPageCache($page_id)
    {

        if (!empty($page_id)) {
            $guery = "UPDATE ta_menu SET change_time = '" . date('Y-m-d H:i:s')
                . "' WHERE id='" . mysql_real_escape_string($page_id) . "'";
            mysql_query($guery) or die(
            $this->Die_Error(
                "error ClearPageCache " . $guery . mysql_error()
            )
            );

            if (file_exists($this->GenerateCacheFilename())) {
                unlink($this->GenerateCacheFilename());
            }
        }
    }

    /**
     * Генерация имени файла кэша
     *
     * @return string
     */
    function GenerateCacheFilename()
    {
        $erg = "[^(.*)(\?yclid\=?)([\d]*)]";
        $url = preg_replace($erg, "\\1", $_SERVER['REQUEST_URI']);
        //$this->SetError($GLOBALS['REQUEST_URI']);
        $this->SetError("url-" . $url);
        return md5(BASE_URL . $url) . "_cashe.php";
    }

    /**
     * Генерация пути файла кэша
     *
     * @return string
     */
    function GenerateCacheFilePath()
    {
        if (!$this->file) {
            $this->file = $this->GenerateCacheFilename();
        }
        $this->file_path = $this->cashe_dir . $this->file;
        return $this->file_path;
    }

    /**
     * Функция проверякт можно ли использовать кеш
     */
    function UseCashe($allow = true)
    {
        global $page;
        if ($this->CheckCasheTime($page->id, $page->db_table, $this->file)
            && $this->cache_site
            && $allow
        ) {
            return true;
        }
    }

    /**
     * Загружает файл кеша
     *
     * @return string
     */
    function LoadFileCashe()
    {
        ob_start();
        include($this->GenerateCacheFilePath());//если можем, то используем его
        $Output = ob_get_contents();
        ob_end_clean();
        return $Output;
    }

    function TemplatePath($template)
    {
        return $_SERVER["DOCUMENT_ROOT"] . $this->template_dir . $template;
    }

    function SaveCashe($OutputNC)
    {
        global $page;
        if ($this->CheckCashe($page->id, $this->table) != "N"
            && $this->cache_site
        ) {

            if (!$handle = fopen($this->GenerateCacheFilePath(), 'w')) {
                $this->SetError("Cannot open file ({$this->file_path})");
            } else {
                //echo "Write";
            }
            // Write $Output to our opened file.
            if (!fwrite($handle, $OutputNC)) {
                $this->SetError(
                    "Cannot write to file ({$this->file_path})" . __DIR__
                );
            } else {
                $query
                    = "INSERT INTO ta_cashe (cashe_id, cashe_url, cashe_file, cashe_timestamp) VALUES (
                NULL, '" . mysql_real_escape_string($_SERVER['REQUEST_URI'])
                    . "', '" . mysql_real_escape_string($this->file) . "', '"
                    . time() . "'
            )";
                //  echo $query;
                mysql_query($query) or die(mysql_error());
            }
            //   print "Success, wrote ($Output) to file ($cashindex)";
            fclose($handle);
        }
        $this->CleanOutofDateFiles();
    }

    /**
     * Очистка файлов с диска старше 2-х недель
     */
    function CleanOutofDateFiles()
    {
        $outofdateFiles = [];
        $query = "SELECT * FROM ta_cashe WHERE cashe_timestamp < '" . (time()
                - 86400 * 3) . "'";
        $result = mysql_query($query);
        while ($row = mysql_fetch_assoc($result)) {
            $outofdateFiles[] = $row;
        }
        //  $this->Print_R_Pre($outofdateFiles);
        if (is_array($outofdateFiles)) {
            foreach ($outofdateFiles as $file) {
                $fileName = $this->cashe_dir . $file['cashe_file'];
                if (file_exists($fileName)) {
                    unlink($fileName);
                }
                $query = "DELETE FROM ta_cashe WHERE cashe_id = '"
                    . mysql_real_escape_string($file['cashe_id']) . "'";
                mysql_query($query);
            }
        }
    }

}