<?php

abstract class Component
{
    protected $path,            // массив разбора адреса
        $lang,            // массив языковых настроек
        $info,            // массив информации о странице
        $pattern,        // шаблон страницы
        $table,            // таблица класса
        $content,        // контент страницы
        $zagolovok,        // заголовок страницы
        $ajax,            // запрос страница статика 0 / ajax 1
        $db,            // ссылка на базу данных
        $path_tpl,        // путь к шаблонам компонентов
        $template,        // щаблоны использующиеся на странице
        $files_path,    // путь к файлам на сервере
        $objs = array();            // массив встроенных объектов

    public function __construct($arr_path, $arr_lang, $arr_info, $db)
    {
        clearstatcache();
        $this->path = $arr_path;
        $this->lang = $arr_lang;
        $this->info = $arr_info;
        $this->db = $db;
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND !empty($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $this->ajax = true;
        } else $this->ajax = false;
        $this->path_tpl = ITCMS_TEMPLATE . '/' . $this->lang['alias'] . '/modules/' . strtolower(get_class($this)) . '/';
        $this->files_path = $_SERVER['DOCUMENT_ROOT'] . '/assets';
    }

    /***
     * инициализируем класс
     ***/
    abstract public function init();

    /***
     * отдаем контент страницы
     ***/
    public function getContent()
    {
        return preg_replace('/\/?assets/', '', $this->content);
    }

    /***
     * отдаем шаблон
     ***/
    public function getPattern()
    {
        return $this->pattern;
    }

    /***
     * получаем шаблон страницы
     ***/
    protected function setPattern($id)
    {
        if (!$id) {
            return '';
        }

        $q = "SELECT `pattern_id` FROM `it_gl_structure` WHERE `id` = $id";
        $this->db->setQuery($q);
        $this->pattern = $this->db->loadResult();
    }

    /***
     * отдаем заголовок
     ***/
    public function getZagolovok()
    {
        return $this->zagolovok;
    }

    /***
     * отдаем информацию
     ***/
    public function getInfo()
    {
        return $this->info;
    }

    /***
     * подключаем шаблон для вывода компонентов
     ***/
    protected function set_template($tmpl)
    {
        if (is_file($this->path_tpl . $tmpl . '.php')) {
            include $this->path_tpl . $tmpl . '.php';
        } else {
            return false;
        }
        $this->template = $TEMPLATE;
        return true;
    }

    /***
     * проверка статуса страницы
     ***/
    protected function check_http_status($url)
    {
        $user_agent = 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0)';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $page = curl_exec($ch);

        $error = curl_errno($ch);
        if (!empty($error))
            return $error;
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $httpcode;
    }

    /***
     * отчиска текста
     ***/
    protected function clear_txt($str)
    {
        $str = preg_replace("/(<[ap][^>]*><\/[^>]*>)/e", "", $str);
        $rep = array(
            "'&(lt|#60);'i",
            "'&(gt|#62);'i",
            "'&(#39);'i",
            "'\''i",
            "'\"'i",
            "'\"'"
        );
        $srep = array(
            "",
            "",
            "",
            "",
            "",
            "",
        );
        $str = preg_replace($rep, $srep, $str);
        return $str;
    }

    /***
     * построение постраничной навигации
     * $count - общее количество записей
     * $limit - количество элеметов на странице
     ***/
    protected function bild_navigation($count, $limit)
    {
        $list = $nav_str = $nav_strt = '';
        $links_limit = 10;
        $pages = ceil($count / $limit);
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $next = '';

        $start = $page > 1 ? ($page - 1) * $limit : 0;
        $start = $start > 0 ? $start : 0;

        $end = (($start + $limit) < $count) ? $start + $limit : $count;

        if ($pages > 1) {
            if ($page != $pages) {
                $next = Template::parse_variable($this->template['next'], array(
                    'n' => ($page + 1) > $pages ? $pages : $page + 1,
                    'nm' => ($page + 1) > $pages ? $pages : $page + 1
                ));
            } else {
                $next = '';
            }
        }
        $nav = new StdClass();
        $nav->position = $start;
        $nav->current_limit = $end;
        $nav->next = $next;
        return $nav;
    }

    /***
     * отдает имя файла с префиксом
     ***/
    protected function Img_name($file_name, $id_new = '', $pref_img = '')
    {
        $img_temp = strtolower($file_name);
        $ext = substr($img_temp, strpos($img_temp, '.') + 1);
        $img_temp = substr($img_temp, 0, strpos($img_temp, '.'));
        if (!empty($id_new)) $id_new = '_' . $id_new;
        if (empty($pref_img)) $img_temp = $img_temp . $id_new . '.' . $ext;
        else $img_temp = $img_temp . $id_new . '_' . $pref_img . '.' . $ext;
        return $img_temp;
    }

    /***
     * модификация контента
     ***/
    protected function modifyContent(&$content)
    {
        $content = preg_replace("!<p>(%(.*?)%)<\/p>!si", '\\1', $content);
        preg_match_all('/%(.*)_(.+)\((.*)\)%/', $content, $components, PREG_SET_ORDER);
        if (count($components)) {
            while (list($key, $obj) = each($components)) {
                if (!isset($this->objs[$obj[1]])) {
                    if (is_file(ITCMS_CORE . '/modules/' . $obj[1] . '.inc.php')) {
                        require_once ITCMS_CORE . '/modules/' . $obj[1] . '.inc.php';
                        $this->objs[$obj[1]] = new $obj[1]($this->path, $this->lang, $this->info, $this->db);
                        $this->objs[$obj[1]]->init();
                    } else {
                        continue;
                    }
                }
                $obj_content = $this->objs[$obj[1]]->$obj[2]($obj[3]);
                $content = Template::parse_variable($content, array(
                    trim($obj[0], '%') => $obj_content
                ));
            }
        }
    }

    /***
     * проверка email
     ***/
    protected function email_check($email)
    {
        $patt = "/^([\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+\.)*[\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+@((((([a-z0-9]{1}[a-z0-9\-]{0,62}[a-z0-9]{1})|[a-z])\.)+[a-z]{2,6})|(\d{1,3}\.){3}\d{1,3}(\:\d{1,5})?)$/i";
        if (!preg_match($patt, trim($email))) {
            return false;
        } else {
            return true;
        }
    }
}