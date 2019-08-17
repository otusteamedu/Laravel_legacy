<?php

class Base
{

    public $error;

    public $message;

    public $log;

    public $showlog = false;

    private $show_mysql_error = false;

    private $signatura_word = "etrtrtrrr";

    private $emails = ["xxx@xxx.ru"];

    public function SetShowLogON()
    {
        $this->showlog = true;
    }

    public function SetError($error)
    {
        $this->error [] = $error;
        //print_r($error);
    }

    public function SetMessage($message)
    {
        $this->message [] = $message;
    }

    public function SetLog($log)
    {
        $this->log [] = $log;
    }

    public function GetError()
    {
        $message = "";
        foreach ($this->error as $k => $mes) {
            $message .= "<p>" . $mes . "</p>";
        }
        return $message;
    }

    public function PrintError()
    {
        if (count($this->error)) {
            echo "<div class=\"error\">" . $this->GetError() . "</div>";
        }
    }

    public function GetMessage()
    {
        $message = "";
        foreach ($this->message as $k => $mes) {
            $message .= "<p>" . $mes . "</p>";
        }
        return $message;
    }

    public function PrintMessage()
    {
        if ($this->message) {
            echo "<div class=\"message\">" . $this->GetMessage() . "</div>";
        }
    }

    public function GetLog()
    {
        $message = "";
        foreach ($this->log as $k => $log) {
            $message .= "<p>" . $log . "</p>";
        }
        return $message;
    }

    public function PrintLog()
    {
        if ($this->log && $this->showlog) {
            echo "<div class=\"message message-log\"><h2>Лог</h2>"
                . $this->GetLog() . "</div>";
        }
    }

    public function Print_R_Pre($perem)
    {
        echo "<pre>";
        print_r($perem);
        echo "</pre>";
    }


    /**
     * Функция обработки сообщений об ошибках при mysql запросе
     *
     * @param $message
     */
    public function Die_Error($message)
    {
        if ($this->GetShowMysqlError()) {
            die($message);
        } else {
            $this->Send404Header();
        }
    }

    public function GetShowMysqlError()
    {
        return $this->show_mysql_error;
    }

    public function SetShowMysqlError($showerror = false)
    {
        $this->show_mysql_error = $showerror;
    }

    /**
     * функция подключения шаблона
     *
     * @param $template string путь к шаблоyу
     * @param $param    array массив данных для шаблона, разворачивается в
     *                  переменные
     */
    public function LoadTmpl($template, $param)
    {
        global $base_protocol;
        extract($param);
        require $template;
    }

    /**
     *
     * Обновляет дату изменения страницы
     *
     * @param unknown_type $id
     */
    public function UpdateChangeInfoPage($id)
    {
        global $user;
        if (!$id) {
            $this->SetError("Не задан id страницы");
        } else {
            $query
                = "UPDATE
			 ta_menu
			SET
				change_time = NOW()
			 	" . ($user->name ? ", change_name = '" . $user->name . "'"
                    : "") . "
			WHERE
			  id = '{$id}'";
            $rez = mysql_query($query) or die (
                "Error in UpdateChangeInfoPage: " . $query . " " . mysql_error()
            );
            if ($rez) {
                $this->SetMessage(
                    "Изменена дата изменения страницы с id " . $id
                );
            }
            return $rez;
        }
    }

    function CP1251toUTF8($str)
    { // (C) SiMM, $table from http://ru.wikipedia.org/wiki/CP1251

        static $table = ["\xA8" => "\xD0\x81", // Ё
                         "\xB8" => "\xD1\x91", // ё
                         // украинские символы
                         "\xA1" => "\xD0\x8E", // Ў (У)
                         "\xA2" => "\xD1\x9E", // ў (у)
                         "\xAA" => "\xD0\x84", // Є (Э)
                         "\xAF" => "\xD0\x87", // Ї (I..)
                         "\xB2" => "\xD0\x86", // I (I)
                         "\xB3" => "\xD1\x96", // i (i)
                         "\xBA" => "\xD1\x94", // є (э)
                         "\xBF" => "\xD1\x97", // ї (i..)
                         // чувашские символы
                         "\x8C" => "\xD3\x90", // &#1232; (A)
                         "\x8D" => "\xD3\x96", // &#1238; (E)
                         "\x8E" => "\xD2\xAA", // &#1194; (С)
                         "\x8F" => "\xD3\xB2", // &#1266; (У)
                         "\x9C" => "\xD3\x91", // &#1233; (а)
                         "\x9D" => "\xD3\x97", // &#1239; (е)
                         "\x9E" => "\xD2\xAB", // &#1195; (с)
                         "\x9F" => "\xD3\xB3", // &#1267; (у)
        ];
        return preg_replace(
            '#[\x80-\xFF]#se',
            ' "$0" >= "\xF0" ? "\xD1".chr(ord("$0")-0x70) :
                       ("$0" >= "\xC0" ? "\xD0".chr(ord("$0")-0x30) :
                        (isset($table["$0"]) ? $table["$0"] : "")
                       )',
            $str
        );

        return $str;
    }

    function correctString($string, $mode = "en->ru")
    {
        $LangEn
            = 'qwertyuiop[]asdfghjkl;\'zxcvbnm,./QWERTYUIOP{}ASDFGHJKL:"ZXCVBNM<>?';
        $LangRu
            = 'йцукенгшщзхъфывапролджэячсмитьбю.ЙЦУКЕНГШЩЗХЪФЫВАПРОЛДЖЭЯЧСМИТЬБЮ,';
        // "en->ru" -> C английскогон на русский // "ru->en" -> С русского на английский
        switch ($mode) {
            case "en->ru":
                $str = strtr($string, $LangEn, $LangRu);
                break;
            case "ru->en":
                $str = strtr($string, $LangRu, $LangEn);
                break;
        }
        return $str;
    }

    public function Send404Header($url404 = "404.phtml")
    {
        global $base_protocol;

        header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
        include $this->RemoveStartSlash($url404);

        //		header ( 'Refresh: 0; url='.$base_protocol.'://'. $_SERVER['HTTP_HOST']."/".$this->RemoveStartSlash($url404) );
        exit ();
    }

    public function Send301Header($url)
    {
        global $base_protocol;
        //echo $url;
        header($_SERVER['SERVER_PROTOCOL'] . ' 301 Moved Permanently');
        header(
            'Location: ' . $base_protocol . "://" . $_SERVER['HTTP_HOST'] . "/"
            . $this->RemoveStartSlash($url)
        );
        exit ();
    }

    /**
     * Возвращает массив ДОБАВОЧНЫХ разделов в которых находится продукция
     *
     */
    public function SearchOutLink($html)
    {

        $vnut = [];
        $vnech = [];
        $url = BASE_URL;
        $allowed_domen = [
            'zakupki.mos.ru',
        ];
        $emails = ["xxx@xxx.ru"];
        $allowed_domen_query = implode("|", $allowed_domen);
        preg_match_all(
            '|<a [^<>]*href=[\'"]([^\'"]+)[\'"][^<>]*>|', $html, $matches
        );
        foreach ($matches[1] as $val) {
            if (!preg_match("~^[^=]+://~", $val)
                || preg_match(
                    "~^[^://]+://(www\.)?" . $url . "~i", $val
                )
            ) {
                $vnut[] = $val;
            } elseif (preg_match("/(" . $allowed_domen_query . ")/", $val)) {
                $vnut[] = $val;
            } else {
                $vnech[] = $val;
            }
        }
        if (count($vnech)) {
            //require_once "/functions/sendmail.phtml";
            $topic = "Неразрешенная ссылка на сайте " . date("d-m-Y H:i:s");
            $msg = "На сайте " . BASE_URL
                . " зафиксирована неразрешенная ссылка<br>";
            $msg .= "<br><b>Ссылки:</b>" . "<br>";
            foreach ($vnech as $k => $v) {
                $msg .= $v . "<br>";
            }
            $msg .= "<b>Адрес страницы:</b> http://" . BASE_URL
                . $_SERVER["REQUEST_URI"] . "<br>";
            $msg .= "<b>Время:</b> " . date("d-m-Y H:i:s") . "<br>";

            if (!SendMail($emails, $topic, $msg, 'html')) {
                //echo "Почта не отправлена";
            } else {
                //echo $msg;
                //echo "Почта отправлена";
            };
        }
        return $vnech;
    }

    /*
     * Замена GET параметров
     * пример: $url = '/article.php?view=flat&page=3&mode=1#note_1';
     * echo replaceGetParameter($url, 'page', 4); // выведет '/article.php?view=flat&page=4&mode=1#note_1'
     */
    public function replaceGetParameter($url, $varname, $value)
    {
        if (is_array($varname)) {
            foreach ($varname as $i => $n) {
                $v = (is_array($value))
                    ? (isset($value[$i]) ? $value[$i] : null)
                    : $value;
                $url = sgp($url, $n, $v);
            }
            return $url;
        }

        preg_match('/^([^?]+)(\?.*?)?(#.*)?$/', $url, $matches);
        $gp = (isset($matches[2])) ? $matches[2] : ''; // GET-parameters
        if (!$gp) {
            return $url;
        }

        $pattern = "/([?&])$varname=.*?(?=&|#|\z)/";
        if (preg_match($pattern, $gp)) {
            $substitution = ($value !== '') ? "\${1}$varname=" . preg_quote(
                    $value
                ) : '';
            $newgp = preg_replace(
                $pattern, $substitution, $gp
            ); // new GET-parameters
            $newgp = preg_replace('/^&/', '?', $newgp);
        } else {
            $s = ($gp) ? '&' : '?';
            $newgp = $gp . $s . $varname . '=' . $value;
        }

        $anchor = (isset($matches[3])) ? $matches[3] : '';
        $newurl = $matches[1] . $newgp . $anchor;
        return $newurl;
    }

    // Удаление GET параметров из URL
    public function removeGetParameters($url)
    {
        return preg_replace('/^([^?]+)(\?.*?)?(#.*)?$/', '$1$3', $url);
    }



    /**
     * Функция для обратного вызова через array_walk вместо array_map, т.к.
     * array_map при вызове trim заменяет удаляет подмассивы...
     *
     * @param $value
     */
    public static function trim(&$value)
    {

        $value = trim($value);
    }

    public function RemoveStartSlash($url)
    {
        $erg = "[^([\/]+)([\w\s\d\-\_\<\>\/\.]*)$]";
        return preg_replace($erg, "\\2", $url);
    }


    /**
     * @param $string
     * Только для выборочной проверки входящих параметров!
     */
    public function CheckInjection($string)
    {
        $badops = ["UNION",
                   "OUTFILE",
                   "FROM",
                   "CREATE",
                   "SELECT",
                   "WHERE",
                   "SHUTDOWN",
                   "UPDATE",
                   "DELETE",
                   "CHANGE",
                   "MODIFY",
                   "RENAME",
                   "RELOAD",
                   "ALTER",
                   "GRANT",
                   "DROP",
                   "INSERT",
                   "CONCAT",
                   //			"AND",
                   "cmd",
                   "exec",
                   //			 "\([^>]*\"?[^)]*\)",
                   "<[^>]*body*\"?[^>]*>",
                   "<[^>]*script*\"?[^>]*>",
                   "<[^>]*xscript*\"?[^>]*>",
                   "<[^>]*object*\"?[^>]*>",
                   "<[^>]*iframe*\"?[^>]*>",
                   "<[^>]*img*\"?[^>]*>",
                   "<[^>]*frame*\"?[^>]*>",
                   "<[^>]*applet*\"?[^>]*>",
                   "<[^>]*meta*\"?[^>]*>",
                   "<[^>]*style*\"?[^>]*>",
                   "<[^>]*form*\"?[^>]*>",
                   "<[^>]*div*\"?[^>]*>",
        ];

        for ($i = 0; $i < sizeof($badops); $i++) {
            if (is_string($string)
                && preg_match(
                    '/' . $badops[$i] . '/i', $string
                )
            ) {
                $badcount = 1;
                $errors_inj[] = $badops[$i] . ": " . $string;
            }
        }

        if (count($errors_inj)) {
            $this->Send404Header();
        }
    }

    public function ClearStringForDB($string, $notag = false)
    {
        if ($notag) {
            $string = strip_tags($string);
        }
        $string = htmlspecialchars($string);
        $string = mysql_real_escape_string($string);
        return $string;
    }

    public function ClearStringForSearch($text)
    {
        $quotes = ["\x27", "\x22", "\x60", "\t", "\n", "\r", "*", "%", "<", ">",
                   "?", "!"];
        $goodquotes = ["-", "+", "#"];
        $repquotes = ["\-", "\+", "\#"];
        $text = trim(strip_tags($text));
        $text = str_replace($quotes, '', $text);
        $text = str_replace($goodquotes, $repquotes, $text);
        $text = ereg_replace(" +", " ", $text);
        return $text;
    }

    public function ClearStringForCanonical($text)
    {
        $quotes = ["\x27", "\x22", "\x60", "\t", "\n", "\r", "*", "%", "<", ">",
                   "!"];
        $goodquotes = ["+", "#"];
        $repquotes = ["\+", "\#"];
        $text = trim(strip_tags($text));
        $text = str_replace($quotes, '', $text);
        $text = str_replace($goodquotes, $repquotes, $text);
        return $text;
    }

    public function captchaVerification()
    {
        if (isset($_POST['g-recaptcha-response'])
            OR empty($_POST['g-recaptcha-response'])
        ) {
            $url = 'https://www.google.com/recaptcha/api/siteverify';
            $params = [
                'secret' => 'xxxxxxxxx',
                'response' => $_POST['g-recaptcha-response'],
                'remoteip' => $_SERVER['REMOTE_ADDR'],
            ];

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $response = curl_exec($ch);
            if (!empty($response)) {
                $decoded_response = json_decode($response);
            }

            if (!isset($decoded_response) OR !$decoded_response->success) {
                return false;
            }
            return true;
        }
        return false;
    }


    /*
     * Код для установки в куки идентификатора
     */
    public function GetSignatura($code = "")
    {
        if (isset($_SESSION["signature"])) {
            return $_SESSION["signature"];
        } elseif (isset($_COOKIE["signature"])) {
            $_SESSION["signature"] = $_COOKIE["signature"];
            return $_SESSION["signature"];
        } else {
            $_SESSION["signature"] = $this->SetSignatura($code);
            return $_SESSION["signature"];
        }
    }


    public function MakeSignatura($code)
    {
        return md5(
            serialize($code) . microtime() . mt_rand() . $this->signatura_word
        );
    }


    public function SetSignatura($code = "")
    {
        $signature = $this->MakeSignatura($code);
        setcookie(
            "signature", $signature, time() + 10 * 360 * 24 * 60 * 60, "/"
        );
        return $signature;
    }

    /**
     * Готовит массив для использования в функции Implode
     *
     * @param        $arr
     * @param string $key
     * @param array  $ret
     */
    public function PrepareArrForImplode($arr, $key = "", $ret = [])
    {
        foreach ($arr as $k => $v) {
            if ($key != "") {
                $ret[] = $v[$key];
            } else {
                $ret[] = $k;
            }
        }
        return $ret;
    }
}