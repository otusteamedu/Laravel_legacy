<?

class Catalog extends Component
{
    private $elepic_path = 'files/img/cat_elements/';
    private $secpic_path = 'files/img/cat_sections/';
    private $path_auto = 'files/img/cat_gal/';
    private $doc_path = 'files/documents/';
    private $inst_path = 'files/instructions/';
    private $color_path = 'files/img/colors/';
    private $galery_id;
    private $PageTitle;
    private $LangPrefix;
    private $Path;
    private $Img_Extensions = array('jpeg', 'jpg', 'gif', 'png');
    private $template;
    private $section;
    private $params;
    private $base;
    private $mass_list = array(15, 30, 45);
    private $order = array(
        'pricea' => 'по цене, по возрастанию',
        'priced' => 'по цене, по убыванию',
        'releva' => 'по популярности',
    );
    private $MaxLevel = 0;
    private $root = array();
    private $ids = array();
    private $count_process = 0;
    public $content;
    public $keywords = '';
    public $description = '';

    public function init()
    {
        clearstatcache();
        global $db;
        $this->base = $db;
        $path = ITCMS_TEMPLATE . '/' . $this->lang['alias'] . '/modules/catalog/';
        $q = "SELECT path FROM it_gl_structure WHERE moduls_id = 51 AND lang_id = " . $this->lang['current'] . " AND enabled = 1 AND id = " . $this->info['id'];
        $this->base->setQuery($q);
        $path_ct = $this->base->loadResult();
        $path_ct = preg_quote($path_ct, "/");

        if (preg_match('/ajax/', $this->info["full_path"])) {
            $tmpl = "sections";
            if (is_file($path . $tmpl . '.php')) {
                include $path . $tmpl . '.php';
                $this->set_template($TEMPLATE);
            } else {
                return false;
            }
            $this->ajax();
            exit;
        } else {
            $par = $this->findPar();
            if (!isset($this->section)) {
                $this->p404 = 1;
                return '';
            }
            if ($this->section->parent_id != 0) {
                switch ($this->section->type_page) {
                    case 1:
                        $tmpl = "sections";
                        if (is_file($path . $tmpl . '.php')) {
                            include $path . $tmpl . '.php';
                        } else {
                            return false;
                        }
                        $this->set_template($TEMPLATE);
                        $this->info['t_page'] = 'catalog_list';
                        $this->showSection();
                        break;
                    case 2:
                        $tmpl = "elements";
                        if (is_file($path . $tmpl . '.php')) {
                            include $path . $tmpl . '.php';
                        } else {
                            return false;
                        }
                        $this->set_template($TEMPLATE);
                        $this->info['t_page'] = 'catalog_item';
                        $this->showElement();
                        break;
                }
            } elseif ($this->section->parent_id == 0) {
                $tmpl = "sections";
                if (is_file($path . $tmpl . '.php')) {
                    include $path . $tmpl . '.php';
                } else {
                    return false;
                }
                $this->set_template($TEMPLATE);
                $this->info['t_page'] = 'catalog_list';
                $this->showMainCat();
            } else {
                $this->p404 = 1;
            }
            $this->ids = $this->root = array();
        }
    }

    public function actionlist()
    {
        $q = "SELECT * FROM it_tovar WHERE enabled = 1 AND discount_price != '0'";
        $res = mysql_query($q);
        if (mysql_num_rows($res) > 0) {
            clearstatcache();
            global $db;
            $this->base = $db;
            $path = ITCMS_TEMPLATE . '/' . $this->lang['alias'] . '/modules/catalog/';
            $tmpl = "actions";
            if (is_file($path . $tmpl . '.php')) {
                include $path . $tmpl . '.php';
            } else {
                return false;
            }
            $this->set_template($TEMPLATE);
            $par = $ele = array();

            while ($r = mysql_fetch_assoc($res)) {
                $ele[] = $r;
                $par[] = $r['sid'];
            }

            $par = array_unique($par);
            $par = implode(',', $par);
            $sql = "SELECT id, parent_id, alias FROM it_st_catalog WHERE enabled = 1 AND id IN ({$par})";
            $res2 = mysql_query($sql);
            $par = $section = array();
            while ($r = mysql_fetch_assoc($res2)) {
                $section[$r['id']] = $r;
                $par[] = $r['parent_id'];
            }
            mysql_free_result($res2);

            $par = implode(',', $par);
            do {
                $sql = "SELECT id, parent_id, alias FROM it_st_catalog WHERE enabled = 1 AND id IN ({$par})";
                $par = array();
                $ress = mysql_query($sql);
                while ($row = mysql_fetch_assoc($ress)) {
                    foreach ($section as $key => $val) {
                        if ($val['parent_id'] == $row['id']) {
                            $section[$key]['parent_id'] = $row['parent_id'];
                            $section[$key]['alias'] = $row['alias'] . '/' . $section[$key]['alias'];
                        }
                    }
                    $par[] = $row['parent_id'];
                }
                $par = array_unique($par);
                $par = implode(',', $par);
            } while (mysql_num_rows($ress) != 0);
            mysql_free_result($ress);

            $col = 3;

            $col = $col > count($ele) ? count($ele) : $col;

            $elements = array();
            while ($col > 0) {
                $index = mt_rand(0, (count($ele) - 1));
                $elements[] = $ele[$index];
                unset($ele[$index]);
                $ele = array_merge($ele, array());
                $col--;
            }
            unset($ele);
            $block = '';
            foreach ($elements as $key => $item) {
                if ($item['image'] != '') {
                    $file = $this->Img_name($item["image"], 'sm');
                    if (is_file($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->elepic_path . $file)) {
                        $size = getimagesize($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->elepic_path . $file);
                        $file = "/" . $this->elepic_path . $file;
                    } else {
                        //$file = '';
                        $file = '/i/no-image-s.png';
                        $size = getimagesize($_SERVER['DOCUMENT_ROOT'] . "/assets" . $file);
                    }
                } else {
                    $file = '/i/no-image-s.png';
                    $size = getimagesize($_SERVER['DOCUMENT_ROOT'] . "/assets" . $file);
                }
                $shild = '';
                if ($item['new_item']) {
                    $shild = Template::parse_variable($this->template['shild'], array('class' => 'new'));
                } elseif ($item['hit']) {
                    $shild = Template::parse_variable($this->template['shild'], array('class' => 'hit'));
                }

                switch ($key) {
                    case 0:
                        $class = "first";
                        break;
                    case 2:
                        $class = "last";
                        break;
                    default:
                        $class = "";
                        break;
                }

                $block .= Template::parse_variable($this->template['item'], array(
                    'link' => '/' . $section[$item['sid']]['alias'] . '/' . $item['alias'] . '/',
                    'name' => $item['name'],
                    'img_block' => $file != '' ? Template::parse_variable($this->template['item_img'], array('src' => $file, 'name' => $item['name'], 'size' => $size[3])) : '',
                    'price' => number_format($item['discount_price'], 0, ',', ' '),
                    'unit' => $item['unit'] != '' ? '/' . $item['unit'] : '',
                    'shild' => $shild,
                    'class' => $class,
                    'old_price' => $item['discount_price'] != '0' ? Template::parse_variable($this->template['price'], array('price' => number_format($item['price'], 0, ',', ' '), 'unit' => $item['unit'] != '' ? '/' . $item['unit'] : '')) : '',
                    'sale' => $item['sale'] != 0 ? Template::parse_variable($this->template['sale'], array('sale' => $item['sale'])) : '',
                ));
            }
            if ($block != '') {
                $block = Template::parse_variable($this->template['block'], array(
                    'list' => $block,
                    'link' => '/akcii/'
                ));
            }
            return $block;
        } else {
            return '';
        }
    }

    private function actionShow()
    {
        $q = "SELECT * FROM it_tovar WHERE enabled = 1 AND discount_price != '0'";
        $res = mysql_query($q);
        if (mysql_num_rows($res) > 0) {
            clearstatcache();
            global $db;
            $this->base = $db;
            $path = ITCMS_TEMPLATE . '/' . $this->lang['alias'] . '/modules/catalog/';
            $tmpl = "actions";
            if (is_file($path . $tmpl . '.php')) {
                include $path . $tmpl . '.php';
            } else {
                return false;
            }
            $this->set_template($TEMPLATE);
            $par = $ele = $items = array();

            while ($r = mysql_fetch_assoc($res)) {
                $items[$r["id"]] = $r;
                $par[] = $r['sid'];
                $price[$r['id']] = $r['discount_price'] != 0 ? $r['discount_price'] : $r['price'];
                $sort[$r['id']] = $r['sort'];
            }

            $order = isset($_COOKIE['torder']) ? $_COOKIE['torder'] : 'releva';

            switch ($order) {
                case 'pricea':
                    asort($price);
                    reset($price);
                    foreach ($price as $key => $val) {
                        $ele[] = $items[$key];
                    }
                    break;
                case 'priced':
                    arsort($price);
                    reset($price);
                    foreach ($price as $key => $val) {
                        $ele[] = $items[$key];
                    }
                    break;
                case 'releva':
                    arsort($sort);
                    reset($sort);
                    foreach ($sort as $key => $val) {
                        $ele[] = $items[$key];
                    }
                    break;
            }
            unset($items);

            $par = array_unique($par);
            $par = implode(',', $par);
            $sql = "SELECT id, parent_id, alias FROM it_st_catalog WHERE enabled = 1 AND id IN ({$par})";
            $res2 = mysql_query($sql);
            $par = $section = array();
            while ($r = mysql_fetch_assoc($res2)) {
                $section[$r['id']] = $r;
                $par[] = $r['parent_id'];
            }
            mysql_free_result($res2);

            $par = implode(',', $par);
            do {
                $sql = "SELECT id, parent_id, alias FROM it_st_catalog WHERE enabled = 1 AND id IN ({$par})";
                $par = array();
                $ress = mysql_query($sql);
                while ($row = mysql_fetch_assoc($ress)) {
                    foreach ($section as $key => $val) {
                        if ($val['parent_id'] == $row['id']) {
                            $section[$key]['parent_id'] = $row['parent_id'];
                            $section[$key]['alias'] = $row['alias'] . '/' . $section[$key]['alias'];
                        }
                    }
                    $par[] = $row['parent_id'];
                }
                $par = array_unique($par);
                $par = implode(',', $par);
            } while (mysql_num_rows($ress) != 0);
            mysql_free_result($ress);


            $block = '';
            $i = 0;
            foreach ($ele as $key => $item) {
                $i++;
                if ($item['image'] != '') {
                    $file = $this->Img_name($item["image"], 'sm');
                    if (is_file($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->elepic_path . $file)) {
                        $size = getimagesize($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->elepic_path . $file);
                        $file = "/" . $this->elepic_path . $file;
                    } else {
                        $file = '/i/no-image-s.png';
                        $size = getimagesize($_SERVER['DOCUMENT_ROOT'] . "/assets" . $file);
                    }
                } else {
                    $file = '/i/no-image-s.png';
                    $size = getimagesize($_SERVER['DOCUMENT_ROOT'] . "/assets" . $file);
                }
                $shild = '';
                if ($item['new_item']) {
                    $shild = Template::parse_variable($this->template['shild'], array('class' => 'new'));
                } elseif ($item['hit']) {
                    $shild = Template::parse_variable($this->template['shild'], array('class' => 'hit'));
                }

                if ($i % 3 == 0) {
                    $class = "last";
                } elseif (($i - 1) % 3 == 0) {
                    $class = "first";
                } else {
                    $class = "";
                }

                $block .= Template::parse_variable($this->template['item'], array(
                    'link' => '/' . $section[$item['sid']]['alias'] . '/' . $item['alias'] . '/',
                    'name' => $item['name'],
                    'img_block' => $file != '' ? Template::parse_variable($this->template['item_img'], array('src' => $file, 'name' => $item['name'], 'size' => $size[3])) : '',
                    'price' => number_format($item['discount_price'], 0, ',', ' '),
                    'unit' => $item['unit'] != '' ? '/' . $item['unit'] : '',
                    'shild' => $shild,
                    'class' => $class,
                    'old_price' => $item['discount_price'] != '0' ? Template::parse_variable($this->template['price'], array('price' => number_format($item['price'], 0, ',', ' '), 'unit' => $item['unit'] != '' ? '/' . $item['unit'] : '')) : '',
                    'sale' => $item['sale'] != 0 ? Template::parse_variable($this->template['sale'], array('sale' => $item['sale'])) : '',
                ));
            }

            $sort_block = '';
            if (!$this->ajax) {
                $sel = isset($_COOKIE['torder']) ? $_COOKIE['torder'] : 'releva';
                foreach ($this->order as $key => $val) {
                    $sort_block .= Template::parse_variable($this->template['line_sort'], array(
                        'val' => $key,
                        'name' => $val,
                        'sel' => $sel == $key ? ' selected' : ''
                    ));
                }

                $sort_block = Template::parse_variable($this->template['block_sort'], array(
                    'list' => $sort_block,
                    'val' => $sel,
                    'name' => $this->order[$sel],
                    'count' => '' //$params['count_block'],
                ));
                $this->content .= $sort_block;
            }
            if ($block != '') {
                $this->content .= Template::parse_variable($this->template['block_page'], array(
                    'list' => $block,
                    'link' => '/akcii/',
                ));
            }
            if ($this->ajax) {
                echo $this->content;
                exit;
            }
        }
    }

    private function findPar()
    {
        $par = array();

        if ($this->lang['current'] != $this->lang['default']) {
            unset($this->path[0]);
            $this->path = array_merge($this->path, array());
        }
        $c = count($this->path);
        $i = $id = 0;
        $q = "SELECT id, name, name_en, parent_id, alias FROM it_st_catalog WHERE enabled = 1 AND name != '' ORDER BY `sort`, name, parent_id, id";
        $res = mysql_query($q);
        while ($r = mysql_fetch_assoc($res)) {
            $par[$r['id']] = array(
                'name' => $r['name'],
                'name_en' => $r['name_en'],
                'alias' => $r['alias'],
                'parent' => $r['parent_id'] == 0 ? null : $r['parent_id'],
            );
        }
        mysql_free_result($res);

        $root = array();
        $all = $par;

        foreach ($all as $id => $item) {
            $parent = $item['parent'];
            if ($parent) {
                $all[$parent]['childs'][$id] = &$all[$id];
            } else {
                $root[$id] = &$all[$id];
            }
        }
        unset($all, $par);
        $this->treeTsl($root);
        unset($root);
        if (!isset($this->section)) {
            $q = "SELECT id, name, sid as parent_id, alias FROM it_tovar WHERE enabled = 1 AND alias = '" . $this->path[count($this->path) - 1] . "' Limit 1";

            $this->base->setQuery($q);
            $this->base->loadObject($this->section);
            if ($this->section) {
                if (isset($this->root[$this->section->parent_id])) {
                    $path = $this->path;
                    unset($path[count($path) - 1]);
                    $path = implode('/', $path);
                    if ($this->root[$this->section->parent_id]['alias'] == $path) {
                        $this->section->type_page = 2;
                    } else {
                        unset($this->section);
                    }
                } else {
                    unset($this->section);
                }
            }
        }
    }

    private function treeTsl($root, $alias = '', $level = 0)
    {
        $level++;
        $ids = array();
        foreach ($root as $id => $tree) {
            $sec = array();
            $tree['alias'] = $alias != '' ? $alias . '/' . $tree['alias'] : $tree['alias'];
            $root[$id]['alias'] = $tree['alias'];
            $sec[] = $id;
            if ($this->info['full_path'] == $tree['alias']) {
                $this->section = new StdClass();
                $this->section->id = $id;
                $this->section->name = $tree['name'];
                $this->section->parent_id = $tree['parent'];
                $this->section->alias = $tree['alias'];
                $this->section->level = $level;
                $this->section->type_page = 1;
            }
            if (isset($tree['childs'])) {
                $vl = $this->treeTsl($tree['childs'], $tree['alias'], $level);
                $root[$id]['childs'] = $vl['root'];
                $sec = array_merge($sec, $vl['ids']);
            }
            $this->MaxLevel = $this->MaxLevel > $level ? $this->MaxLevel : $level;
            $this->root[$id] = $root[$id];
            $this->ids[$id] = $sec;
            $ids = array_merge($ids, $sec);
        }

        return array(
            'root' => $root,
            'ids' => $ids
        );
    }

    public function vrec()
    {
        if (isset($_COOKIE['tovars'])) {
            $path = ITCMS_TEMPLATE . '/' . $this->lang['alias'] . '/modules/catalog/';
            $tmpl = "rectv";
            if (is_file($path . $tmpl . '.php')) {
                include $path . $tmpl . '.php';
            } else {
                return '';
            }
            $this->set_template($TEMPLATE);

            $tovars = unserialize(stripcslashes($_COOKIE['tovars']));
            $pid = implode(',', $tovars);
            $sql = "SELECT T1.sid, T2.id, T2.name, T2.image, T2.alias, T2.price, T3.name as brand_name, GROUP_CONCAT(T4.quant SEPARATOR ',') as quant FROM it_link_sttv T1 INNER JOIN it_tovar T2 ON T2.id = T1.tid LEFT JOIN it_brand T3 ON T3.id = T2.brand LEFT JOIN  it_link_tvsk T4 ON T4.tid = T1.tid WHERE T1.tid IN ({$pid}) AND T2.enabled = 1 GROUP BY T1.tid";
            $res = mysql_query($sql);
            $par = $ele = array();
            while ($r = mysql_fetch_assoc($res)) {
                $ele[] = $r;
                $par[] = $r['sid'];
            }
            mysql_free_result($res);

            $par = array_unique($par);

            if (count($par) > 0) {
                $par = implode(',', $par);

                $sql = "SELECT id, name, tovar_name, parent_id, alias FROM it_st_catalog WHERE enabled = 1 AND id IN ({$par})";
                $res = mysql_query($sql);
                $par = $section = array();
                while ($r = mysql_fetch_assoc($res)) {
                    $section[$r['id']] = $r;
                    $par[] = $r['parent_id'];
                }
                mysql_free_result($res);

                $par = implode(',', $par);
                do {
                    $sql = "SELECT id, parent_id, alias FROM it_st_catalog WHERE enabled = 1 AND id IN ({$par})";
                    $par = array();
                    $res = mysql_query($sql);
                    while ($row = mysql_fetch_assoc($res)) {
                        foreach ($section as $key => $val) {
                            if ($val['parent_id'] == $row['id']) {
                                $section[$key]['parent_id'] = $row['parent_id'];
                                $section[$key]['alias'] = $row['alias'] . '/' . $section[$key]['alias'];
                            }
                        }
                        $par[] = $row['parent_id'];
                    }
                    $par = array_unique($par);
                    $par = implode(',', $par);
                } while (mysql_num_rows($res) != 0);
                mysql_free_result($res);

                $line = '';
                foreach ($ele as $element) {
                    if ($element['image'] != '') {
                        $file = $this->Img_name($element["image"], 'g');
                        if (is_file($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->elepic_path . $file)) {
                            $size = getimagesize($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->elepic_path . $file);
                            $file = "/" . $this->elepic_path . $file;
                        } else {
                            $file = '/i/169_80.jpg';
                            $size = getimagesize($_SERVER['DOCUMENT_ROOT'] . "/assets" . $file);
                        }
                    } else {
                        $file = '/i/169_80.jpg';
                        $size = getimagesize($_SERVER['DOCUMENT_ROOT'] . "/assets" . $file);
                    }


                    $line .= Template::parse_variable($this->template['item'], array(
                        'link' => '/' . $section[$element['sid']]['alias'] . '/' . $element['alias'] . '/',
                        'name' => $section[$element['sid']]['tovar_name'] . ' ' . $element['name'] . ' ' . $element['brand_name'],
                        'src' => $file,
                        'size' => $size[3],
                        'price' => number_format($element['price'], 0, ',', ' '),
                        'id' => $element['id'],
                        'cart_act' => $element['quant'] != '' ? Template::parse_variable($this->template['cart_act'], array(
                            'id' => $element['id'],
                        )) : ''
                    ));
                }
                if ($line != '') {
                    return Template::parse_variable($this->template['block'], array(
                        'line' => $line
                    ));
                } else {
                    return '';
                }
            }
        } else {
            return '';
        }
    }

    private function topItems($col = 1)
    {
        $line = array();
        $q = "SELECT T1.sid, T2.id, T2.name, T2.image, T2.alias, T2.price, T3.name as brand_name, GROUP_CONCAT(T4.quant SEPARATOR ',') as quant FROM it_link_sttv T1 INNER JOIN it_tovar T2 ON T2.id = T1.tid LEFT JOIN it_brand T3 ON T3.id = T2.brand LEFT JOIN it_link_tvsk T4 ON T4.tid = T1.tid WHERE T2.`top` = 1 AND T2.enabled = 1 GROUP BY T1.tid";
        $res = mysql_query($q);
        if (mysql_num_rows($res) > 0) {
            $rows = $ids = array();
            while ($r = mysql_fetch_assoc($res)) {
                $rows[] = $r;
                $ids[] = $r['sid'];
            }

            $col = $col > count($rows) ? count($rows) : $col;

            $elements = array();
            while ($col > 0) {
                $index = mt_rand(0, (count($rows) - 1));
                $elements[] = $rows[$index];
                unset($rows[$index]);
                $rows = array_merge($rows, array());
                $col--;
            }
            unset($rows);

            $ids = array_unique($ids);
            $ids = implode(',', $ids);
            $sql = "SELECT id, name, tovar_name, parent_id, alias FROM it_st_catalog WHERE enabled = 1 AND id IN ({$ids})";
            $res2 = mysql_query($sql);
            $par = $section = array();
            while ($r = mysql_fetch_assoc($res2)) {
                $section[$r['id']] = $r;
                $par[] = $r['parent_id'];
            }
            mysql_free_result($res2);

            $par = implode(',', $par);
            do {
                $sql = "SELECT id, parent_id, alias FROM it_st_catalog WHERE enabled = 1 AND id IN ({$par})";
                $par = array();
                $ress = mysql_query($sql);
                while ($row = mysql_fetch_assoc($ress)) {
                    foreach ($section as $key => $val) {
                        if ($val['parent_id'] == $row['id']) {
                            $section[$key]['parent_id'] = $row['parent_id'];
                            $section[$key]['alias'] = $row['alias'] . '/' . $section[$key]['alias'];
                        }
                    }
                    $par[] = $row['parent_id'];
                }
                $par = array_unique($par);
                $par = implode(',', $par);
            } while (mysql_num_rows($ress) != 0);
            mysql_free_result($ress);

            foreach ($elements as $element) {
                if ($element['image'] != '') {
                    $file = $this->Img_name($element["image"], 'sm');
                    if (is_file($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->elepic_path . $file)) {
                        $size = getimagesize($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->elepic_path . $file);
                        $file = "/" . $this->elepic_path . $file;
                    } else {
                        $file = '/i/206_132.jpg';
                        $size = getimagesize($_SERVER['DOCUMENT_ROOT'] . "/assets" . $file);
                    }
                } else {
                    $file = '/i/206_132.jpg';
                    $size = getimagesize($_SERVER['DOCUMENT_ROOT'] . "/assets" . $file);
                }

                //$section[$element['sid']]['name'].' '.
                $line[] = Template::parse_variable($this->template['itemct'], array(
                    'link' => '/' . $section[$element['sid']]['alias'] . '/' . $element['alias'] . '/',
                    'name' => $element['name'] . ' ' . $element['brand_name'],
                    'sname' => $section[$element['sid']]['name'],
                    'slink' => '/' . $section[$element['sid']]['alias'] . '/',
                    'src' => $file,
                    'size' => $size[3],
                    'price' => number_format($element['price'], 0, ',', ' '),
                    'id' => $element['id'],
                ));
            }
        }
        mysql_free_result($res);
        return $line;
    }

    public function liders()
    {
        $path = ITCMS_TEMPLATE . '/' . $this->lang['alias'] . '/modules/catalog/';
        $tmpl = "rectv";
        if (is_file($path . $tmpl . '.php')) {
            include $path . $tmpl . '.php';
        } else {
            return '';
        }
        $this->set_template($TEMPLATE);

        $line = '';
        $q = "SELECT T1.sid, T2.id, T2.name, T2.image, T2.alias, T2.price, T3.name as brand_name, GROUP_CONCAT(T4.quant SEPARATOR ',') as quant FROM it_link_sttv T1 INNER JOIN it_tovar T2 ON T2.id = T1.tid LEFT JOIN it_brand T3 ON T3.id = T2.brand LEFT JOIN it_link_tvsk T4 ON T4.tid = T1.tid WHERE T2.`lider` = 1 AND T2.enabled = 1 GROUP BY T1.tid";
        $res = mysql_query($q);
        if (mysql_num_rows($res) > 0) {
            $elements = $ids = array();
            while ($r = mysql_fetch_assoc($res)) {
                $elements[] = $r;
                $ids[] = $r['sid'];
            }

            $ids = array_unique($ids);
            $ids = implode(',', $ids);
            $sql = "SELECT id, name, tovar_name, parent_id, alias FROM it_st_catalog WHERE enabled = 1 AND id IN ({$ids})";
            $res2 = mysql_query($sql);
            $par = $section = array();
            while ($r = mysql_fetch_assoc($res2)) {
                $section[$r['id']] = $r;
                $par[] = $r['parent_id'];
            }
            mysql_free_result($res2);

            $par = implode(',', $par);
            do {
                $sql = "SELECT id, parent_id, alias FROM it_st_catalog WHERE enabled = 1 AND id IN ({$par})";
                $par = array();
                $ress = mysql_query($sql);
                while ($row = mysql_fetch_assoc($ress)) {
                    foreach ($section as $key => $val) {
                        if ($val['parent_id'] == $row['id']) {
                            $section[$key]['parent_id'] = $row['parent_id'];
                            $section[$key]['alias'] = $row['alias'] . '/' . $section[$key]['alias'];
                        }
                    }
                    $par[] = $row['parent_id'];
                }
                $par = array_unique($par);
                $par = implode(',', $par);
            } while (mysql_num_rows($ress) != 0);
            mysql_free_result($ress);

            foreach ($elements as $element) {
                if ($element['image'] != '') {
                    $file = $this->Img_name($element["image"], 'g');
                    if (is_file($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->elepic_path . $file)) {
                        $size = getimagesize($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->elepic_path . $file);
                        $file = "/" . $this->elepic_path . $file;
                    } else {
                        $file = '/i/169_80.jpg';
                        $size = getimagesize($_SERVER['DOCUMENT_ROOT'] . "/assets" . $file);
                    }
                } else {
                    $file = '/i/169_80.jpg';
                    $size = getimagesize($_SERVER['DOCUMENT_ROOT'] . "/assets" . $file);
                }


                $line .= Template::parse_variable($this->template['item'], array(
                    'link' => '/' . $section[$element['sid']]['alias'] . '/' . $element['alias'] . '/',
                    'name' => $section[$element['sid']]['tovar_name'] . ' ' . $element['name'] . ' ' . $element['brand_name'],
                    'src' => $file,
                    'size' => $size[3],
                    'price' => number_format($element['price'], 0, ',', ' '),
                    'id' => $element['id'],
                    'cart_act' => $element['quant'] != '' ? Template::parse_variable($this->template['cart_act'], array(
                        'id' => $element['id'],
                    )) : ''
                ));

                if ($line != '') {
                    $line = Template::parse_variable($this->template['block_nw'], array(
                        'line' => $line
                    ));
                }
            }
        }
        mysql_free_result($res);
        return $line;
    }

    public function novitly()
    {
        $path = ITCMS_TEMPLATE . '/' . $this->lang['alias'] . '/modules/catalog/';
        $tmpl = "rectv";
        if (is_file($path . $tmpl . '.php')) {
            include $path . $tmpl . '.php';
        } else {
            return '';
        }
        $this->set_template($TEMPLATE);

        $line = '';
        $q = "SELECT T1.sid, T2.id, T2.name, T2.image, T2.alias, T2.price, T3.name as brand_name, GROUP_CONCAT(T4.quant SEPARATOR ',') as quant FROM it_link_sttv T1 INNER JOIN it_tovar T2 ON T2.id = T1.tid LEFT JOIN it_brand T3 ON T3.id = T2.brand LEFT JOIN it_link_tvsk T4 ON T4.tid = T1.tid WHERE T2.`new_item` = 1 AND T2.enabled = 1 GROUP BY T1.tid";
        $res = mysql_query($q);
        if (mysql_num_rows($res) > 0) {
            $elements = $ids = array();
            while ($r = mysql_fetch_assoc($res)) {
                $elements[] = $r;
                $ids[] = $r['sid'];
            }

            $ids = array_unique($ids);
            $ids = implode(',', $ids);
            $sql = "SELECT id, name, tovar_name, parent_id, alias FROM it_st_catalog WHERE enabled = 1 AND id IN ({$ids})";
            $res2 = mysql_query($sql);
            $par = $section = array();
            while ($r = mysql_fetch_assoc($res2)) {
                $section[$r['id']] = $r;
                $par[] = $r['parent_id'];
            }
            mysql_free_result($res2);

            $par = implode(',', $par);
            do {
                $sql = "SELECT id, parent_id, alias FROM it_st_catalog WHERE enabled = 1 AND id IN ({$par})";
                $par = array();
                $ress = mysql_query($sql);
                while ($row = mysql_fetch_assoc($ress)) {
                    foreach ($section as $key => $val) {
                        if ($val['parent_id'] == $row['id']) {
                            $section[$key]['parent_id'] = $row['parent_id'];
                            $section[$key]['alias'] = $row['alias'] . '/' . $section[$key]['alias'];
                        }
                    }
                    $par[] = $row['parent_id'];
                }
                $par = array_unique($par);
                $par = implode(',', $par);
            } while (mysql_num_rows($ress) != 0);
            mysql_free_result($ress);

            foreach ($elements as $element) {
                if ($element['image'] != '') {
                    $file = $this->Img_name($element["image"], 'g');
                    if (is_file($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->elepic_path . $file)) {
                        $size = getimagesize($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->elepic_path . $file);
                        $file = "/" . $this->elepic_path . $file;
                    } else {
                        $file = '/i/169_80.jpg';
                        $size = getimagesize($_SERVER['DOCUMENT_ROOT'] . "/assets" . $file);
                    }
                } else {
                    $file = '/i/169_80.jpg';
                    $size = getimagesize($_SERVER['DOCUMENT_ROOT'] . "/assets" . $file);
                }


                $line .= Template::parse_variable($this->template['item'], array(
                    'link' => '/' . $section[$element['sid']]['alias'] . '/' . $element['alias'] . '/',
                    'name' => $section[$element['sid']]['tovar_name'] . ' ' . $element['name'] . ' ' . $element['brand_name'],
                    'src' => $file,
                    'size' => $size[3],
                    'price' => number_format($element['price'], 0, ',', ' '),
                    'id' => $element['id'],
                    'cart_act' => $element['quant'] != '' ? Template::parse_variable($this->template['cart_act'], array(
                        'id' => $element['id'],
                    )) : ''
                ));

                if ($line != '') {
                    $line = Template::parse_variable($this->template['block_nw'], array(
                        'line' => $line
                    ));
                }
            }
        }
        mysql_free_result($res);
        return $line;
    }

    public function spectv()
    {
        $path = ITCMS_TEMPLATE . '/' . $this->lang['alias'] . '/modules/catalog/';
        $tmpl = "rectv";
        if (is_file($path . $tmpl . '.php')) {
            include $path . $tmpl . '.php';
        } else {
            return '';
        }
        $this->set_template($TEMPLATE);

        $line = '';
        $q = "SELECT T1.sid, T2.id, T2.name, T2.image, T2.alias, T2.price, T3.name as brand_name, GROUP_CONCAT(T4.quant SEPARATOR ',') as quant FROM it_link_sttv T1 INNER JOIN it_tovar T2 ON T2.id = T1.tid LEFT JOIN it_brand T3 ON T3.id = T2.brand LEFT JOIN it_link_tvsk T4 ON T4.tid = T1.tid WHERE T2.`action` = 1 AND T2.enabled = 1 GROUP BY T1.tid";
        $res = mysql_query($q);
        if (mysql_num_rows($res) > 0) {
            $elements = $ids = array();
            while ($r = mysql_fetch_assoc($res)) {
                $elements[] = $r;
                $ids[] = $r['sid'];
            }

            $ids = array_unique($ids);
            $ids = implode(',', $ids);
            $sql = "SELECT id, name, tovar_name, parent_id, alias FROM it_st_catalog WHERE enabled = 1 AND id IN ({$ids})";
            $res2 = mysql_query($sql);
            $par = $section = array();
            while ($r = mysql_fetch_assoc($res2)) {
                $section[$r['id']] = $r;
                $par[] = $r['parent_id'];
            }
            mysql_free_result($res2);

            $par = implode(',', $par);
            do {
                $sql = "SELECT id, parent_id, alias FROM it_st_catalog WHERE enabled = 1 AND id IN ({$par})";
                $par = array();
                $ress = mysql_query($sql);
                while ($row = mysql_fetch_assoc($ress)) {
                    foreach ($section as $key => $val) {
                        if ($val['parent_id'] == $row['id']) {
                            $section[$key]['parent_id'] = $row['parent_id'];
                            $section[$key]['alias'] = $row['alias'] . '/' . $section[$key]['alias'];
                        }
                    }
                    $par[] = $row['parent_id'];
                }
                $par = array_unique($par);
                $par = implode(',', $par);
            } while (mysql_num_rows($ress) != 0);
            mysql_free_result($ress);

            foreach ($elements as $element) {
                if ($element['image'] != '') {
                    $file = $this->Img_name($element["image"], 'g');
                    if (is_file($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->elepic_path . $file)) {
                        $size = getimagesize($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->elepic_path . $file);
                        $file = "/" . $this->elepic_path . $file;
                    } else {
                        $file = '/i/169_80.jpg';
                        $size = getimagesize($_SERVER['DOCUMENT_ROOT'] . "/assets" . $file);
                    }
                } else {
                    $file = '/i/169_80.jpg';
                    $size = getimagesize($_SERVER['DOCUMENT_ROOT'] . "/assets" . $file);
                }


                $line .= Template::parse_variable($this->template['item'], array(
                    'link' => '/' . $section[$element['sid']]['alias'] . '/' . $element['alias'] . '/',
                    'name' => $section[$element['sid']]['tovar_name'] . ' ' . $element['name'] . ' ' . $element['brand_name'],
                    'src' => $file,
                    'size' => $size[3],
                    'price' => number_format($element['price'], 0, ',', ' '),
                    'id' => $element['id'],
                    'cart_act' => $element['quant'] != '' ? Template::parse_variable($this->template['cart_act'], array(
                        'id' => $element['id'],
                    )) : ''
                ));

                if ($line != '') {
                    $line = Template::parse_variable($this->template['block_nw'], array(
                        'line' => $line
                    ));
                }
            }
        }
        mysql_free_result($res);
        return $line;
    }

    public function filters()
    {
        $path = ITCMS_TEMPLATE . '/' . $this->lang['alias'] . '/modules/catalog/';
        $tmpl = "fill";
        if (is_file($path . $tmpl . '.php')) {
            include $path . $tmpl . '.php';
        } else {
            return '';
        }
        $this->set_template($TEMPLATE);
        $fill_list = '';
        if (isset($this->info['sec_id'])) {
            $cat[] = $this->info['sec_id'];
            $ids[] = $this->info['sec_id'];
            do {
                $par = implode(',', $cat);
                $sql = "
						SELECT T1.id, T1.parent_id FROM it_st_catalog T1
						WHERE T1.name != '' AND T1.enabled = 1 AND T1.lang_id = " . $this->lang['current'] . " AND T1.parent_id IN ({$par})";
                $res = mysql_query($sql);
                $cat = array();
                while ($row = mysql_fetch_assoc($res)) {
                    $cat[] = $row['id'];
                    $ids[] = $row['id'];
                    //здесь делаем что-то полезное, сохраняющее рез-ты выборки
                }
                if ((count($cat) == 0)) {
                    break;
                }
                //$parents = array_merge($parents,$parent);
            } while (mysql_num_rows($res) != 0);
            mysql_free_result($res);

            $ids = implode(',', $ids);
            $q = "SELECT * FROM it_sid_prop WHERE sid IN ({$ids})";//.$this->info['sec_id'];
            $res = mysql_query($q);
            $property = array();
            //$flag = false;
            $count = mysql_num_rows($res);
            while ($r = mysql_fetch_assoc($res)) {
                if ($r['prop_id'] != '') {
                    $r['prop_id'] = unserialize($r['prop_id']);
                    $props = implode(',', array_keys($r['prop_id']));
                    $q = "SELECT * FROM it_prop_list WHERE id IN ({$props}) AND type != 1";
                    $resp = mysql_query($q);
                    while ($rp = mysql_fetch_assoc($resp)) {
                        if (!isset($property[$rp['id']])) {
                            $property[$rp['id']] = $rp;
                            $property[$rp['id']]['cont'] = 1;
                        } else {
                            $property[$rp['id']]['cont'] = $property[$rp['id']]['cont'] + 1;
                        }
                    }
                    mysql_free_result($resp);
                }
            }
            mysql_free_result($res);

            if (count($property) > 0) {
                $props = implode(',', array_keys($property));
                $q = "SELECT * FROM it_prop_values WHERE prop_id IN ({$props})";
                $resp = mysql_query($q);
                while ($rp = mysql_fetch_assoc($resp)) {
                    $property[$rp['prop_id']]['val'][] = $rp;
                }
                mysql_free_result($resp);

                foreach ($property as $prop) {
                    if ($prop['cont'] == $count) {
                        $prop_list = '';
                        foreach ($prop['val'] as $vl) {
                            $prop_list .= Template::parse_variable($this->template['prop_val'], array(
                                'id' => $prop['id'],
                                'val' => $vl['id'],
                                'name' => $vl['value']
                            ));
                        }
                        if ($prop_list != '') {
                            $fill_list .= Template::parse_variable($this->template['prop_line'], array(
                                'name' => $prop['name'],
                                'line' => $prop_list,
                                'class' => ''
                            ));
                        }
                    }
                }
            }
            $q = "SELECT DISTINCT T2.`brand` FROM it_link_sttv T1 INNER JOIN `it_tovar` T2 ON T2.`id` = T1.`tid` AND T2.`enabled` = 1 WHERE T1.`sid` IN ({$ids})";
            $res = mysql_query($q);
            if (mysql_num_rows($res) > 0) {
                $brand = array();
                while ($r = mysql_fetch_assoc($res)) {
                    $brand[] = $r['brand'];
                }
                if (count($brand) > 0) {
                    $brand = implode(',', $brand);
                    $q = "SELECT id, name FROM `it_brand` WHERE id IN ({$brand}) AND enabled = 1";
                    $bres = mysql_query($q);
                    $brands = '';
                    $sel = '';
                    if (isset($_SESSION['brand'])) {
                        $sel = $_SESSION['brand'];
                        unset($_SESSION['brand']);
                    }
                    while ($r = mysql_fetch_assoc($bres)) {
                        $brands .= Template::parse_variable($this->template['prop_val_simple'], array(
                            'prop_n' => 'brand',
                            'val' => $r['id'],
                            'name' => $r['name'],
                            'sel' => $sel == $r['id'] ? ' class="checked"' : '',
                            'sel2' => $sel == $r['id'] ? ' checked' : ''
                        ));
                    }
                    mysql_free_result($bres);
                    if ($brands != '') {
                        $fill_list .= Template::parse_variable($this->template['prop_line'], array(
                            'name' => 'Производители',
                            'line' => $brands,
                            'class' => $sel ? ' act' : ''
                        ));
                    }
                }
            }
            mysql_free_result($res);
            $q = "SELECT MIN(T2.`price`) as `mini`, MAX(T2.`price`) as `maxi` FROM it_link_sttv T1 INNER JOIN `it_tovar` T2 ON T2.`id` = T1.`tid` AND T2.`enabled` = 1 WHERE T1.`sid` IN ({$ids})";
            $res = mysql_query($q);
            if ($r = mysql_fetch_assoc($res)) {
                $fill_list .= Template::parse_variable($this->template['price_line'], array(
                    'name' => 'Цена',
                    'min' => (int)$r['mini'],
                    'max' => (int)$r['maxi']
                ));
            }

            $q = "SELECT id, name FROM it_sklad WHERE enabled = 1";
            $res = mysql_query($q);
            if (mysql_num_rows($res) > 0) {
                $sklad = '';
                while ($r = mysql_fetch_assoc($res)) {
                    $sklad .= Template::parse_variable($this->template['prop_val_simple'], array(
                        'prop_n' => 'sklad',
                        'val' => $r['id'],
                        'name' => $r['name'],
                        'sel' => '',
                        'sel2' => ''
                    ));
                }
                if ($sklad != '') {
                    $fill_list .= Template::parse_variable($this->template['prop_line'], array(
                        'name' => 'Магазины',
                        'line' => $sklad,
                        'class' => ''
                    ));
                }
            }

            return Template::parse_variable($this->template['prop_block'], array(
                'fill_block' => $fill_list,
                'sid' => $this->info['sec_id']
            ));
        }
    }

    public function spec_tv($param)
    {
        $path = ITCMS_TEMPLATE . '/' . $this->lang['alias'] . '/modules/catalog/';
        $tmpl = $param["TEMPLATE"] != "" ? $param["TEMPLATE"] : "sections";
        if (is_file($path . $tmpl . '.php')) {
            include $path . $tmpl . '.php';
        } else {
            return '';
        }
        $this->set_template($TEMPLATE);

        $q = "SELECT T1.item, T1.price, T1.vprice, T1.anons, T2.name, T2.alias, T2.id FROM it_catalog_sections T1 LEFT JOIN it_st_catalog T2 on T2.id = T1.pid WHERE T1.price != 0 AND T2.enabled = 1 LIMIT 1";
        $res = mysql_query($q);
        if ($item = mysql_fetch_assoc($res)) {
            $q = "SELECT T2.image, T1.id FROM it_st_catalog T1 LEFT JOIN it_catalog_elements T2 ON T2.pid = T1.id WHERE T1.parent_id = " . $item['id'] . " AND T1.enabled = 1 LIMIT 1";
            $res = mysql_query($q);
            $r = mysql_fetch_assoc($res);
            $q = "SELECT T2.width, T2.height FROM it_catalog_tovar_size T1 LEFT JOIN it_catalog_size T2 ON T2.id = T1.size_id WHERE T1.tovar_id = '" . $item['id'] . "' ORDER BY T2.width, T2.height LIMIT 1";
            $size = mysql_fetch_assoc(mysql_query($q));

            $sq = $size['width'] * $size['height'];
            $file = $this->Img_name($r["image"], 'sm');

            $this_price = ceil($item['price'] * $sq);
            $this_price = $this_price == 0 ? ceil($item['price'] * $size['width']) : $this_price;
            $old_price = $item['vprice'] != 0 ? ceil($item['vprice'] * $sq) : ceil($price * $sq);
            $old_price = $old_price == 0 ? ($item['vprice'] != 0 ? ceil($item['vprice'] * $size['width']) : ceil($price * $size['width'])) : $old_price;
            if (is_file($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->elepic_path . $file)) {
                $size_f = getimagesize($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->elepic_path . $file);
                $file = "/" . $this->elepic_path . $file;
                return Template::parse_variable($this->template['spec_line'], array(
                    'anons' => $item['anons'],
                    'name' => trim($item['name']),
                    'link' => '/' . $item['alias'] . '/',
                    'item' => $item['item'],
                    'image' => $file,
                    'size' => $size_f[3],
                    'new_price' => $this_price,
                    'old_price' => $old_price,
                ));
            } else {
                return Template::parse_variable($this->template['spec_line_nim'], array(
                    'anons' => $item['anons'],
                    'name' => trim($item['name']),
                    'link' => '/' . $item['alias'] . '/',
                    'item' => $item['item'],
                    'new_price' => $this_price,
                    'old_price' => $old_price,
                ));
            }
        }
    }

    public function new_tv($param)
    {
        $path = ITCMS_TEMPLATE . '/' . $this->lang['alias'] . '/modules/catalog/';
        $tmpl = "slide";//$param["TEMPLATE"] != "" ? $param["TEMPLATE"] : "slide";
        if (is_file($path . $tmpl . '.php')) {
            include $path . $tmpl . '.php';
        } else {
            return '';
        }
        $this->set_template($TEMPLATE);

        $q = "SELECT T1.*, T2.name, T2.alias FROM it_catalog_elements T1 LEFT JOIN it_st_catalog T2 on T2.id = T1.pid WHERE T1.new_item != 0 AND T1.quant > 0 AND T2.enabled = 1";
        $res = mysql_query($q);
        $rows = array();
        while ($item = mysql_fetch_assoc($res)) {
            $rows[] = $item;
        }

        $elements = array();
        for ($i = 0; $i < 6; $i++) {
            if (count($rows)) {
                $index = mt_rand(0, count($rows) - 1);
                if ($rows[$index]['image']) {
                    $elements[] = $rows[$index];
                    unset($rows[$index]);
                    $rows = array_merge($rows, array());
                }
            }
        }

        $line = '';

        foreach ($elements as $item) {
            $file = $this->Img_name($item['image'], 'sm');
            if (is_file($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->elepic_path . $file)) {
                $size = getimagesize($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->elepic_path . $file);
                $file = "/" . $this->elepic_path . $file;
                $line .= Template::parse_variable($this->template['item'], array(
                    'name' => $item['name'],
                    'price' => number_format($item['price'], 0, ',', ' '),
                    'img' => $file,
                    'link' => '/' . $item['alias'] . '/',
                    'size' => $size[3]
                ));
            }
        }
        if ($line != '') {
            return Template::parse_variable($this->template['block'], array(
                'line' => $line
            ));
        } else {
            return '';
        }
    }

    public function main_section()
    {
        $path = ITCMS_TEMPLATE . '/' . $this->lang['alias'] . '/modules/catalog/';
        $tmpl = "section";
        if (is_file($path . $tmpl . '.php')) {
            include $path . $tmpl . '.php';
        } else {
            return false;
        }
        $this->set_template($TEMPLATE);

        $sections = $this->GetStructure(1, 2);
        $output = '';
        if (count($sections) > 0) {
            foreach ($sections as $sec) {
                $children = '';
                if (isset($sec['childs'])) {
                    foreach ($sec['childs'] as $it) {
                        $children .= Template::parse_variable($this->template['section_line_child'], array(
                            'name' => $it['name'],
                            'alias' => '/' . $it['alias'] . '/'
                        ));
                    }

                    $children = Template::parse_variable($this->template['section_block_child'], array(
                        'lines' => $children
                    ));
                }
                $file = $this->Img_name($sec["image"], 's');
                if (is_file($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->secpic_path . $file)) {
                    $output .= Template::parse_variable($this->template['section_line'], array(
                        'name' => $sec['name'],
                        'alias' => '/' . $sec['alias'] . '/',
                        'image' => "/" . $this->secpic_path . $file,
                        'childs' => $children
                    ));
                } else {
                    $output .= Template::parse_variable($this->template['section_line_nim'], array(
                        'name' => $sec['name'],
                        'alias' => '/' . $sec['alias'] . '/',
                        'childs' => $children
                    ));
                }
            }
            if ($output != '') {
                return Template::parse_variable($this->template['section_block'], array(
                    'line' => $output
                ));
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    public function small_list()
    {
        $path = ITCMS_TEMPLATE . '/' . $this->lang['alias'] . '/modules/catalog/';
        $tmpl = "small";
        if (is_file($path . $tmpl . '.php')) {
            include $path . $tmpl . '.php';
        } else {
            return false;
        }

        $this->set_template($TEMPLATE);

        $sections = $this->GetStructure(1, 2);
        $output_line = $this->smallTree($sections);

        $output = '';
        if ($output_line != '') {
            $output = Template::parse_variable($this->template['section_list'], array(
                'list' => $output_line,
                'page' => ''
            ));
        }
        return $output;
    }

    private function StatusParent($id = 0)
    {
        $satus = 1;
        $q = "SELECT parent_id, enabled FROM it_st_catalog WHERE id = $id Limit 1";
        $res = mysql_query($q);
        if ($row = mysql_fetch_assoc($res)) {
            $satus = $row['enabled'];
            if ($satus && $row['parent_id'] != 0) {
                $satus = $this->StatusParent($row['parent_id']);
            }
            return $satus;
        } else {
            return $satus;
        }
    }

    private function smallTree($tree, $level = 1)
    {
        $output = "";
        if ($level > 1) {
            $output .= Template::parse_variable($this->template['open_child'], array());
        }
        $i = 0;
        $vs = count($tree);
        foreach ($tree as $val) {
            switch ($level) {
                case 1:
                    $i++;
                    $file = $this->Img_name($val["image"], 's');
                    if (is_file($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->secpic_path . $file)) {
                        $size = getimagesize($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->secpic_path . $file);
                        $file = "/" . $this->secpic_path . $file;
                        $output .= Template::parse_variable($this->template['sec_veiw'], array(
                            'img' => $file,
                            'size' => $size[3],
                            'link' => "/" . $val["alias"] . "/",
                            'name' => htmlentities(html_entity_decode($val["name"], ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8'),
                        ));
                    } else {
                        $output .= Template::parse_variable($this->template['sec_veiw_ni'], array(
                            'link' => "/" . $val["alias"] . "/",
                            'name' => htmlentities(html_entity_decode($val["name"], ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8'),
                        ));
                    }
                    break;
                case 2:
                    $i++;
                    $output .= Template::parse_variable($this->template['sec_child'], array(
                        'link' => "/" . $val["alias"] . "/",
                        'name' => $val["name"],
                    ));
                    if ($i < $vs) $output .= Template::parse_variable($this->template['sepatator'], array());
                    break;
            }
            if (isset($val['childs'])) {
                $output .= $this->smallTree($val['childs'], $level + 1);
            }
            if ($level < 2) {
                $output .= Template::parse_variable($this->template['close_child'], array());
                if ($i % 3 == 0) {
                    $output .= Template::parse_variable($this->template['clear'], array());
                }
            }
        }
        if ($level > 1) {
            $output .= Template::parse_variable($this->template['close_childs'], array());
        }
        return $output;
    }

    public function cat_slide($param)
    {
        global $db;
        $path = ITCMS_TEMPLATE . '/' . $this->lang['alias'] . '/modules/catalog/';
        $tmpl = $param["TEMPLATE"] != "" ? $param["TEMPLATE"] : "slide";
        if (is_file($path . $tmpl . '.php')) {
            include $path . $tmpl . '.php';
        } else {
            return '';
        }
        $this->set_template($TEMPLATE);
        $q = "
			SELECT T1.name, T1.alias, T2.pid, T2.anons, T2.image, T2.price
			FROM it_st_catalog T1
			LEFT JOIN it_catalog_elements T2 ON T2.pid = T1.id
			WHERE
				T1.enabled = 1
				AND T1.show_in_menu = 1
				AND T1.type_page = 2
			ORDER BY name
		";

        $db->setQuery($q);
        $rows = $db->loadObjectList();

        $line = 7;
        $line = $line > count($rows) ? count($rows) : $line;

        $elements = array();
        while ($line > 0) {
            $index = mt_rand(0, (count($rows) - 1));
            $elements[] = $rows[$index];
            unset($rows[$index]);
            $rows = array_merge($rows, array());
            $line--;
        }

        unset($rows);

        if (count($elements) > 0) {
            $block = $ele_line = '';
            foreach ($elements as $row) {
                $file = $this->Img_name($row->image, 's');
                if (is_file($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->elepic_path . $file)) {
                    $size = getimagesize($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->elepic_path . $file);
                    $file = "/" . $this->elepic_path . $file;

                    $ele_line .= Template::parse_variable($this->template['item'], array(
                        'name' => htmlentities($row->name, ENT_QUOTES, 'UTF-8'),
                        'link' => "/" . $row->alias . "/",
                        'img_link' => $file,
                        'anons' => $row->anons,
                        'price' => number_format($row->price, 0, ',', ' '),
                        'size' => $size[3],
                    ));
                }
            }
            if ($ele_line != '') {
                $block .= Template::parse_variable($TEMPLATE['block'], array(
                    'list' => $ele_line,
                ));
            }
            unset($ele_line);
            return $block;
        } else {
            return '';
        }
    }

    private function set_template($tmp)
    {
        return $this->template = $tmp;
    }

    private function showNovelty()
    {
        $this->title = $this->zagolovok = 'Автомобили в наличии';
        $this->info['gallery'] = '';

        $q = "SELECT T1.*, T2.name, T2.alias FROM it_catalog_elements T1 LEFT JOIN it_st_catalog T2 on T2.id = T1.pid WHERE T1.now_item != 0 AND T2.enabled = 1";
        $res = mysql_query($q);
        $child_p = array();
        while ($item = mysql_fetch_assoc($res)) {
            $child_p[] = $item;
        }

        if (count($child_p)) {
            $params = $this->bild_navigation(count($child_p));

            $i = $params['start'];
            if ($params['nav_str'] == '') {
                $params['end'] = count($child_p);
            }

            $ele_line = '';
            while ($i < $params['end']) {

                $prop = '';
                if ($child_p[$i]['axels'] != '') {
                    $prop .= Template::parse_variable($this->template['item_prop'], array(
                        'name' => 'Колесная формула',
                        'val' => $child_p[$i]['axels']
                    ));
                }
                if ($child_p[$i]['type'] != '') {
                    $prop .= Template::parse_variable($this->template['item_prop'], array(
                        'name' => 'Тип',
                        'val' => $child_p[$i]['type']
                    ));
                }
                if ($child_p[$i]['engine'] != '') {
                    $prop .= Template::parse_variable($this->template['item_prop'], array(
                        'name' => 'Двигатель',
                        'val' => $child_p[$i]['engine']
                    ));
                }
                if ($child_p[$i]['transmission'] != '') {
                    $prop .= Template::parse_variable($this->template['item_prop'], array(
                        'name' => 'Трансмиссия',
                        'val' => $child_p[$i]['transmission']
                    ));
                }
                if ($child_p[$i]['cabin'] != '') {
                    $prop .= Template::parse_variable($this->template['item_prop'], array(
                        'name' => 'Кабина',
                        'val' => $child_p[$i]['cabin']
                    ));
                }
                if ($child_p[$i]['fuel_tanks'] != '') {
                    $prop .= Template::parse_variable($this->template['item_prop'], array(
                        'name' => 'Топливные баки',
                        'val' => $child_p[$i]['fuel_tanks']
                    ));
                }
                if ($child_p[$i]['tires'] != '') {
                    $prop .= Template::parse_variable($this->template['item_prop'], array(
                        'name' => 'Шины',
                        'val' => $child_p[$i]['tires']
                    ));
                }
                if ($prop != '') {
                    $prop = Template::parse_variable($this->template['item_prop_block'], array(
                        'line' => $prop
                    ));
                }

                $img_name = $this->Img_name($child_p[$i]['image'], 'sm');
                if (is_file($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->elepic_path . $img_name)) {
                    $size = getimagesize($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->elepic_path . $img_name);
                    $file = "/" . $this->elepic_path . $img_name;
                    $ele_line .= Template::parse_variable($this->template['item_now'], array(
                        'link' => "/" . $child_p[$i]["alias"] . "/",
                        'name' => htmlentities($child_p[$i]['name'], ENT_QUOTES, 'UTF-8'),
                        'src' => $file,
                        'prop' => $prop,
                        'bu' => '',
                        'last' => $i == $params['end'] - 1 ? ' last' : '',
                    ));

                } else {
                    $ele_line .= Template::parse_variable($this->template['item_now_nim'], array(
                        'link' => "/" . $child_p[$i]["alias"] . "/",
                        'name' => htmlentities($child_p[$i]['name'], ENT_QUOTES, 'UTF-8'),
                        'prop' => $prop,
                        'bu' => '',
                        'last' => $i == $params['end'] - 1 ? ' last' : '',
                    ));
                }
                $i++;
            }

            if ($ele_line != '') {
                $this->content .= Template::parse_variable($this->template['block_list'], array(
                    /*'filter'	=> '',*/
                    'list' => $ele_line,
                    'nav_str' => $params['nav_str']
                ));
            }
        }
        //$this->content = $line;
        //}
    }

    private function MakeNav($sid)
    {
        $q = "
			SELECT *
				FROM it_st_catalog
				WHERE
					id = $sid
					&& type_page = 1
					&& lang_id = 1
			";

        $res_s = mysql_query($q) or die(mysql_error());
        if ($sec = mysql_fetch_array($res_s)) {
            if ($sec["parent_id"] != 0) {
                $this->par[] = $sec["id"];
                $this->MakeNav($sec["parent_id"]);
            }
        }
    }

    private function showSection()
    {
        $sec_content = null;
        $q = "SELECT T1.*, T2.keywords, T2.description
			FROM it_st_catalog T1
			LEFT JOIN it_index T2 ON T2.path = '" . $this->info["full_path"] . "' AND T2.item_id = T1.id
			WHERE
				T1.id = " . $this->section->id . "
		";
        $this->info['sec_id'] = $this->section->id;
        $this->base->setQuery($q);
        $this->base->loadObject($sec_content);
        $this->title = $sec_content->title;
        $this->zagolovok = $sec_content->zagolovok != '' ? $sec_content->zagolovok : $this->section->name;

        $this->keywords = $sec_content->keywords;
        $this->description = $sec_content->description;
        $this->info["is_modul"] = 1;

        $child_p = $this->GetStructureEle($this->section->id, 0, 10);
        $nchild = $this->DpSections($this->section->id);
        $child_p = array_merge_recursive($child_p, $nchild);
        $sort_block = $fiters = $block = '';
        $ele_line = '';
        if (count($child_p)) {
            $params = $this->bild_navigation(count($child_p));

            $i = $params['start'];
            if ($params['nav_str'] == '') {
                $params['end'] = count($child_p);
            }

            $c = 0;

            $q = "SELECT * FROM it_color WHERE 1";
            $cs = mysql_query($q);
            $colors = array();
            while ($rs = mysql_fetch_assoc($cs)) {
                $colors[$rs['id']] = $rs;
            }

            while ($i < $params['end']) {
                $c++;
                $color_block = '';
                if ($child_p[$i]['colors'] != '') {
                    $child_p[$i]['colors'] = unserialize(stripcslashes($child_p[$i]['colors']));
                    foreach ($child_p[$i]['colors'] as $v) {
                        if (isset($colors[$v])) {
                            if ($colors[$v]['image'] != '' && is_file($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->color_path . '/' . $colors[$v]['image'])) {
                                $back = 'background:url(/' . $this->color_path . '/' . $colors[$v]["image"] . ') center center no-repeat; background-size: 18px 18px;';
                            } else {
                                $back = 'background:#' . $colors[$v]["hex"] . '; ';
                            }
                            $color_block .= Template::parse_variable($this->template['color_line'], array(
                                'back' => $back,
                                'id' => $colors[$v]['id'],
                                'name' => $this->lang['current'] == 1 ? $colors[$v]['name'] : $colors[$v]['name_en'],
                                'border' => $colors[$v]['hex'] === 'ffffff' ? ' borderln' : '',
                                'tid' => $child_p[$i]['id']
                            ));
                        }
                    }
                    $color_block = Template::parse_variable($this->template['color_block'], array(
                        'color_line' => $color_block
                    ));
                }
                if ($child_p[$i]['image'] != '') {
                    $file = $this->Img_name($child_p[$i]["image"], 'm');
                    if (is_file($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->elepic_path . $file)) {
                        $size = getimagesize($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->elepic_path . $file);
                        $file = "/" . $this->elepic_path . $file;
                    } else {
                        $file = '/i/no-image-s.png';
                        $size = getimagesize($_SERVER['DOCUMENT_ROOT'] . "/assets" . $file);
                    }
                } else {
                    $file = '/i/no-image-s.png';
                    $size = getimagesize($_SERVER['DOCUMENT_ROOT'] . "/assets" . $file);
                }
                $shild = '';
                if ($child_p[$i]['new_item']) {
                    $shild = ' catalog-item-new';
                } elseif ($child_p[$i]['sale']) {
                    $shild = ' catalog-item-sale';
                }
                $price = $child_p[$i]['discount_price'] ? number_format($child_p[$i]['discount_price'], 0, ',', ' ') : number_format($child_p[$i]['price'], 0, ',', ' ');
                $ele_line .= Template::parse_variable($this->template['item'], array(
                    'link' => $this->lang['url_prefix'] . adds_to_path($child_p[$i]['alias']),
                    'name' => $this->lang['current'] == 1 ? $child_p[$i]['name'] : $child_p[$i]['name_en'],
                    'image' => $file != '' ? Template::parse_variable($this->template['image'], array(
                        'src' => $file,
                        'name' => $this->lang['current'] == 1 ? htmlentities(html_entity_decode(strip_tags($child_p[$i]['name']), ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8') : htmlentities(html_entity_decode(strip_tags($child_p[$i]['name_en']), ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8'),
                        'size' => '')) : '',
                    'price' => $price != '0' && $child_p[$i]['quantity'] !== '0' ? Template::parse_variable($this->template['price'], array('price' => $price, 'class' => '')) : '',
                    'old_price' => $child_p[$i]['discount_price'] && $child_p[$i]['quantity'] !== '0' ? Template::parse_variable($this->template['price'], array('price' => number_format($child_p[$i]['price'], 0, ',', ' '), 'class' => ' class="price-old"')) : '',
                    'none' => $child_p[$i]['quantity'] === '0' ? Template::parse_variable($this->template['none'], array()) : '',
                    'shild' => $shild,
                    'adult' => $child_p[$i]['adult'] ? ' adult' : '',
                    'color' => $color_block,
                    'id' => $child_p[$i]['id']
                ));
                $i++;
            }
        }
        if (!$this->ajax) {
            $this->content .= Template::parse_variable($this->template['block'], array(
                'line' => $ele_line,
                'nav' => isset($params['next']) ? $params['next'] : '',
            ));
        } else {
            $ret_block = array(
                'content' => $ele_line,
                'nav' => $params['next']
            );
            $ret_block = json_encode($ret_block);
            echo $ret_block;
            exit;
        }
    }

    private function getmicrotime()
    {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }

    private function bild_navigation($positions)
    {
        $prefix = './';
        $url = $_SERVER['QUERY_STRING'];
        parse_str($url, $arr_query);

        $list = $nav_str = $nav_strt = '';
        $links_limit = 10;
        $count = 21;

        $pages = ceil($positions / $count);
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $all = 0;
        $next = '';
        if ($page != "view_all") {
            $start = $page > 1 ? ($page - 1) * $count : 0;
            $start = $start > 0 ? $start : 0;

            $end = (($start + $count) < $positions) ? $start + $count : $positions;

            if ($page <= $links_limit / 2 && $page <= $pages - ($links_limit / 2)) {
                $p_start = 1;
                $p_end = $page + ($links_limit / 2);
            } elseif ($page <= $links_limit / 2 && $page > $pages - ($links_limit / 2)) {
                $p_start = 1;
                $p_end = $pages;
            } elseif ($page >= $links_limit / 2 && $page <= $pages - ($links_limit / 2)) {
                $p_start = $page - ($links_limit / 2);
                $p_end = $page + ($links_limit / 2);
            } elseif ($page >= $links_limit / 2 && $page > $pages - ($links_limit / 2)) {
                $p_start = $page - ($links_limit / 2);
                $p_end = $pages;
            }

            if ($pages > 1) {
                $arr_query['page'] = ($page - 1) < 1 ? 1 : $page - 1;
                $url = $this->url_bildt($arr_query);

                if ($page != 1) {
                    $list .= Template::parse_variable($this->template['prev'], array(
                        'link' => $prefix . '?' . $url,
                        'n' => $arr_query['page'],
                        'nm' => $arr_query['page']
                    ));
                } else {
                    $list .= Template::parse_variable($this->template['prev_act'], array());
                }

                if ($page - ($links_limit / 2) > 1) {
                    $arr_query['page'] = 1;
                    $url = $this->url_bildt($arr_query);
                    $list .= Template::parse_variable($this->template['page_n'], array(
                        'link' => $prefix,
                        'n' => 1
                    ));
                    if (($page - ($links_limit / 2) > 2)) {
                        $arr_query['page'] = ($page - ($links_limit / 2)) - 1;

                        $url = $this->url_bildt($arr_query);
                        $list .= Template::parse_variable($this->template['page_n'], array(
                            'link' => $prefix . '?' . $url,
                            'n' => '...'
                        ));
                    }
                }

                for ($i = $p_start; $i <= $p_end; $i++) {
                    if ($i != $page) {
                        $arr_query['page'] = $i;
                        $url = $this->url_bildt($arr_query);
                        $list .= Template::parse_variable($this->template['page_n'], array(
                            'link' => $prefix . '?' . $url,
                            'n' => $i,
                            'nm' => $i
                        ));
                    } else {
                        $list .= Template::parse_variable($this->template['page_nact'], array(
                            'n' => $i,
                            'nm' => $i
                        ));
                    }
                }

                if ($page + ($links_limit / 2) < $pages) {
                    if ($page + ($links_limit / 2) < $pages - 1) {
                        $arr_query['page'] = $page + ($links_limit / 2) + 1;//$rew_f;
                        $url = $this->url_bildt($arr_query);
                        $list .= Template::parse_variable($this->template['page_n'], array(
                            'link' => $prefix . '?' . $url,
                            'n' => '...',
                            'nm' => $arr_query['page']
                        ));
                    }
                    $arr_query['page'] = $pages;
                    $url = $this->url_bildt($arr_query);
                    $list .= Template::parse_variable($this->template['page_n'], array(
                        'link' => $prefix . '?' . $url,
                        'n' => $pages,
                        'nm' => $arr_query['page']
                    ));
                }

                $arr_query['page'] = ($page + 1) > $pages ? $pages : $page + 1;
                $url = $this->url_bildt($arr_query);

                if ($page != $pages) {
                    $next = Template::parse_variable($this->template['next'], array(
                        'link' => $prefix . '?' . $url,
                        'n' => $arr_query['page'],
                        'nm' => $arr_query['page']
                    ));
                } else {
                    $next = '';
                }
                $arr_query['page'] = 'view_all';
                $nav_str .= Template::parse_variable($this->template['page_block'], array(
                    'list' => $list,
                    'linkall' => $arr_query['page'],//$prefix.'?'.$this->url_bildt($arr_query),
                    'nameall' => 'Показать все'
                ));
                $nav_strt .= Template::parse_variable($this->template['page_blockt'], array(
                    'list' => $list,
                    'linkall' => $arr_query['page'],
                    'nameall' => 'Показать все'
                ));
            }
        } else {
            $start = 0;
            $end = 0;
            $nav_str .= Template::parse_variable($this->template['page_block'], array(
                'list' => '',
                'linkall' => '1',
                'nameall' => 'По страницам'
            ));
            $nav_strt .= Template::parse_variable($this->template['page_blockt'], array(
                'list' => '',
                'linkall' => '1',
                'nameall' => 'По страницам'
            ));
            $all = 1;
        }

        return array(
            'start' => $start,
            'end' => $end,
            'nav_str' => $nav_str,
            'nav_strt' => $nav_strt,
            'next' => $next,
            //'count_block'	=>	$count_block,
            'all' => $all
        );
    }

    private function url_bildt($arr_url)
    {
        $url = '';
        $i = 1;
        foreach ($arr_url as $k => $value) {
            $url .= $k . '=' . rawurlencode($value);
            $url .= ($i != sizeof($arr_url)) ? '&' : '';
            $i++;
        }
        return $url;
    }

    private function Img_name($file_name, $id_new = '', $pref_img = '')
    {
        $img_temp = strtolower($file_name);
        $ext = substr($img_temp, strpos($img_temp, '.') + 1);
        $img_temp = substr($img_temp, 0, strpos($img_temp, '.'));
        if (!empty($id_new)) $id_new = '_' . $id_new;
        if (empty($pref_img)) $img_temp = $img_temp . $id_new . '.' . $ext;
        else $img_temp = $img_temp . $id_new . '_' . $pref_img . '.' . $ext;
        return $img_temp;
    }

    private function GetChildSec()
    {
        $childs = array();
        $q = "SELECT T1.alias, T1.name, T2.*
					FROM it_st_catalog T1
					LEFT JOIN it_catalog_sections T2 ON T2.pid = T1.id
					WHERE
						T1.parent_id = " . $this->section->id . "
						AND T1.lang_id = " . $this->lang["current"] . "
						AND T1.enabled = 1
						AND T1.type_page = 1
					ORDER BY T1.sort
			";
        $res = mysql_query($q) or die(mysql_error());
        while ($r = mysql_fetch_array($res)) {
            $childs[] = $r;
        }
        return $childs;
    }

    private function DpSections($sid)
    {
        $q = "SELECT `tid` FROM `it_tovar_catalog` WHERE `sid` = " . $sid;
        $res = mysql_query($q);
        $ids = array();
        while ($r = mysql_fetch_assoc($res)) {
            $ids[] = $r['tid'];
        }
        mysql_free_result($res);

        if (count($ids) == 0) {
            return array();
        }
        $ids = implode(',', $ids);
        //join prop price размер/цена
        $q = "SELECT t.*, IF(MIN(pp.price) > 0 AND NOT t.discount_price, MIN(pp.price), t.price) as price FROM it_tovar t 
        LEFT JOIN it_prop_price pp ON t.id = pp.tovar_id AND pp.price > 0 AND pp.prop_id = 1
        WHERE t.id IN ({$ids}) AND t.enabled=1 GROUP BY t.id ORDER BY `t`.`sort` DESC";
        //$q = "SELECT * FROM it_tovar WHERE id IN ({$ids}) AND enabled = 1 ORDER BY `sort` DESC";
        $tvr = mysql_query($q);
        $par = $prod = array();
        while ($sib = mysql_fetch_assoc($tvr)) {
            $prod[$sib['id']] = $sib;
            $par[] = $sib['sid'];
        }
        mysql_free_result($tvr);
        if (count($par)) {
            $par = array_unique($par);
            $par = implode(',', $par);
            $sql = "SELECT id, parent_id, alias FROM it_st_catalog WHERE enabled = 1 AND id IN ({$par})";
            $res2 = mysql_query($sql);
            $par = $section = array();
            while ($r = mysql_fetch_assoc($res2)) {
                $section[$r['id']] = $r;
                $par[] = $r['parent_id'];
            }
            mysql_free_result($res2);

            $par = implode(',', $par);
            do {
                $sql = "SELECT id, parent_id, alias FROM it_st_catalog WHERE enabled = 1 AND id IN ({$par})";
                $par = array();
                $ress = mysql_query($sql);
                while ($row = mysql_fetch_assoc($ress)) {
                    foreach ($section as $key => $val) {
                        if ($val['parent_id'] == $row['id']) {
                            $section[$key]['parent_id'] = $row['parent_id'];
                            $section[$key]['alias'] = $row['alias'] . '/' . $section[$key]['alias'];
                        }
                    }
                    $par[] = $row['parent_id'];
                }
                $par = array_unique($par);
                $par = implode(',', $par);
            } while (mysql_num_rows($ress) != 0);
            mysql_free_result($ress);

            while (list($id, $item) = each($prod)) {
                $prod[$id]['alias'] = $section[$item['sid']]['alias'] . '/' . $item['alias'];
            }
        }
        $prod = array_merge($prod, array());
        return $prod;
    }

    private function GetStructureEle($id = 1, $level = 0, $deptch = 10, $promo = 0)
    {
        $ids = $this->ids[$id];
        $output = array();
        if (count($ids) > 0) {
            $pid = implode(',', $ids);
            $order = 'releva';//isset($_COOKIE['torder']) ? $_COOKIE['torder'] : ;
            //join prop price размер/цена
            $sql = "SELECT t.*, IF(MIN(pp.price) > 0 AND NOT t.discount_price, MIN(pp.price), t.price) as price 
            FROM it_tovar t LEFT JOIN it_prop_price pp ON t.id = pp.tovar_id AND pp.price > 0 AND pp.prop_id = 1 
            WHERE t.sid IN ({$pid}) AND t.enabled=1 GROUP BY t.id";
            $res = mysql_query($sql);
            $items = $sort = $price = array();
            while ($row = mysql_fetch_assoc($res)) {
                $row['alias'] = $this->root[$row['sid']]['alias'] . '/' . $row['alias'];
                $items[$row['id']] = $row;
                if ($promo) {
                    $sort[$row['id']] = $row['promo'] == 1 ? $row['promosort'] * 1000 : $row['sort'];
                } else {
                    $sort[$row['id']] = $row['sort'];
                }
            }
            mysql_free_result($res);
            arsort($sort);
            reset($sort);
            foreach ($sort as $key => $val) {
                $output[] = $items[$key];
            }
            unset($items);
        }
        return $output;
    }

    private function GetStructure($id = 1, $deptch = 4)
    {
        $parents = array($id);
        $ele = array();
        $level = 0;
        do {
            $par = implode(',', $parents);
            $sql = "
					SELECT T1.id, T1.parent_id, T1.name, T1.alias, T1.show_in_menu FROM it_st_catalog T1
					WHERE T1.name != '' AND T1.enabled = 1 AND T1.lang_id = " . $this->lang['current'] . " AND T1.parent_id IN ({$par}) ORDER BY T1.parent_id ASC, T1.sort ASC, T1.id ASC";
            $res = mysql_query($sql);
            $parents = array();
            while ($row = mysql_fetch_assoc($res)) {
                $parents[] = $row['id'];
                $ele[$row['id']] = array(
                    'name' => $row['name'],
                    'alias' => isset($ele[$row['parent_id']]) ? $ele[$row['parent_id']]['alias'] . '/' . $row['alias'] : ($row['parent_id'] == 1 ? 'catalog/' . $row['alias'] : $row['alias']),
                    'parent' => ($row['parent_id'] == 0) || ($row['parent_id'] == $id) ? null : $row['parent_id'],
                    'menu' => $row['show_in_menu'],
                    'level' => $level
                );
                //здесь делаем что-то полезное, сохраняющее рез-ты выборки
            }
            $level++;
            if ($level == $deptch) {
                break;
            }
            //$parents = array_merge($parents,$parent);
        } while (mysql_num_rows($res) != 0);

        $root = array();

        $all = $ele;

        foreach ($all as $id => $item) {
            $parent = $item['parent'];
            if ($parent)
                $all[$parent]['childs'][$id] = &$all[$id];
            else
                $root[$id] = &$all[$id];
        }
        //удаляем, ибо по ссылкам можем ненароком закосячить построенную структуру
        unset($all);
        unset($ele);
        return $root;
    }

    private function GetChildEle($page_navigation = null)
    {
        $childs = array();
        if ($this->section->id != 1) {
            $q = "SELECT T1.alias, T1.name, T2.*
						FROM it_st_catalog T1
						LEFT JOIN it_catalog_elements T2 ON T2.pid = T1.id
						WHERE
							parent_id = " . $this->section->id . "
							AND lang_id = " . $this->lang["current"] . "
							AND enabled = 1
							AND type_page = 2
						ORDER BY sort
				";
        } else {
            $q = "SELECT T1.alias, T1.name, T2.*
						FROM it_st_catalog T1
						LEFT JOIN it_catalog_elements T2 ON T2.pid = T1.id
						WHERE
							lang_id = " . $this->lang["current"] . "
							AND enabled = 1
							AND type_page = 2
				";
            //ORDER BY T1.parent_id ASC, T1.sort ASC
            if ($page_navigation != null) {
                $q .= "LIMIT " . $page_navigation->position . ", " . $page_navigation->current_limit;
            }
        }
        $res = mysql_query($q) or die(mysql_error());
        while ($r = mysql_fetch_array($res)) {
            $childs[] = $r;
        }
        return $childs;
    }

    public function maincat()
    {
        $path = ITCMS_TEMPLATE . '/' . $this->lang['alias'] . '/modules/catalog/';

        $tmpl = "sections";
        if (is_file($path . $tmpl . '.php')) {
            include $path . $tmpl . '.php';
        } else {
            return false;
        }
        $this->set_template($TEMPLATE);

        $news_cont = '';
        if (is_file(ITCMS_CORE . '/modules/news.inc.php')) {
            include_once ITCMS_CORE . '/modules/news.inc.php';
            $news = new News($this->path, $this->lang, $this->info);
            $news_cont = $news->show_block(array('LENTA' => 1, 'LIMIT' => 1, 'TEMPLATE' => 'news_block', 'IMG_ISSET' => 1, 'prefics' => '_sm'));
            //$block .= $news_cont;
        }

        $items = $this->topItems(2);

        return Template::parse_variable($this->template['blockct'], array(
            'news_cont' => $news_cont,
            'item1' => $items[0],
            'item2' => $items[1]
        ));
    }

    private function showMainCat()
    {
        clearstatcache();
        $sec_content = null;
        $q = "SELECT T1.*, T3.keywords, T3.description FROM it_pg_content T1 LEFT JOIN it_gl_structure T2 ON T1.p_id=T2.id LEFT JOIN it_index T3 ON T3.path = T2.path AND T3.item_id = T1.p_id  WHERE T1.p_id = " . $this->info['id'] . " AND T2.path = '" . $this->info['full_path'] . "'";

        $this->base->setQuery($q);
        $this->base->query();
        $this->base->loadObject($sec_content);
        $this->title = $sec_content->title;
        $this->zagolovok = $sec_content->zagolovok != '' ? $sec_content->zagolovok : $this->section->name;

        $this->keywords = $sec_content->keywords;
        $this->description = $sec_content->description;
        $this->info['sec_id'] = $this->section->id;

        $child_p = $this->GetStructureEle($this->section->id, 0, 10, 1);
        if (count($child_p)) {
            $params = $this->bild_navigation(count($child_p));
            $i = $params['start'];
            if ($params['nav_str'] == '') {
                $params['end'] = count($child_p);
            }
            $ele_line = '';
            $c = 0;
            $q = "SELECT * FROM it_color WHERE 1";
            $cs = mysql_query($q);
            $colors = array();
            while ($rs = mysql_fetch_assoc($cs)) {
                $colors[$rs['id']] = $rs;
            }
            while ($i < $params['end']) {
                $c++;
                $color_block = '';
                if ($child_p[$i]['colors'] != '') {
                    $child_p[$i]['colors'] = unserialize(stripcslashes($child_p[$i]['colors']));
                    foreach ($child_p[$i]['colors'] as $v) {
                        if (isset($colors[$v])) {
                            if ($colors[$v]['image'] != '' && is_file($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->color_path . '/' . $colors[$v]['image'])) {
                                $back = 'background:url(/' . $this->color_path . '/' . $colors[$v]["image"] . ') center center no-repeat; background-size: 18px 18px;';
                            } else {
                                $back = 'background:#' . $colors[$v]["hex"] . '; ';
                            }
                            $color_block .= Template::parse_variable($this->template['color_line'], array(
                                'back' => $back,
                                'id' => $colors[$v]['id'],
                                'name' => $this->lang['current'] == 1 ? $colors[$v]['name'] : $colors[$v]['name_en'],
                                'border' => $colors[$v]['hex'] === 'ffffff' ? ' borderln' : '',
                                'tid' => $child_p[$i]['id']
                            ));
                        }
                    }
                    $color_block = Template::parse_variable($this->template['color_block'], array(
                        'color_line' => $color_block
                    ));
                }

                if ($child_p[$i]['image'] != '') {
                    $file = $this->Img_name($child_p[$i]["image"], 'm');
                    if (is_file($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->elepic_path . $file)) {
                        $size = getimagesize($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->elepic_path . $file);
                        $file = "/" . $this->elepic_path . $file;
                    } else {
                        $file = '/i/no-image-s.png';
                        $size = getimagesize($_SERVER['DOCUMENT_ROOT'] . "/assets" . $file);
                    }
                } else {
                    $file = '/i/no-image-s.png';
                    $size = getimagesize($_SERVER['DOCUMENT_ROOT'] . "/assets" . $file);
                }
                $shild = '';
                if ($child_p[$i]['new_item']) {
                    $shild = ' catalog-item-new';//Template::parse_variable($this->template['shild'], array('class' => 'new'));
                } elseif ($child_p[$i]['sale']) {
                    $shild = ' catalog-item-sale';//Template::parse_variable($this->template['shild'], array('class' => 'hit'));
                }
                $price = $child_p[$i]['discount_price'] ? number_format($child_p[$i]['discount_price'], 0, ',', ' ') : number_format($child_p[$i]['price'], 0, ',', ' ');

                $ele_line .= Template::parse_variable($this->template['item'], array(
                    'link' => $this->lang['url_prefix'] . adds_to_path($child_p[$i]['alias']),
                    'name' => $this->lang['current'] == 1 ? $child_p[$i]['name'] : $child_p[$i]['name_en'],
                    'image' => $file != '' ? Template::parse_variable($this->template['image'], array(
                        'src' => $file,
                        'name' => $this->lang['current'] == 1 ? htmlentities(html_entity_decode(strip_tags($child_p[$i]['name']), ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8') : htmlentities(html_entity_decode(strip_tags($child_p[$i]['name_en']), ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8'),
                        'size' => '')) : '',
                    'price' => $price != '0' && $child_p[$i]['quantity'] !== '0' ? Template::parse_variable($this->template['price'], array('price' => $price, 'class' => '')) : '',
                    'old_price' => $child_p[$i]['discount_price'] && $child_p[$i]['quantity'] !== '0' ? Template::parse_variable($this->template['price'], array('price' => number_format($child_p[$i]['price'], 0, ',', ' '), 'class' => ' class="price-old"')) : '',
                    'none' => $child_p[$i]['quantity'] === '0' ? Template::parse_variable($this->template['none'], array()) : '',
                    'shild' => $shild,
                    'adult' => $child_p[$i]['adult'] ? ' adult' : '',
                    'color' => $color_block,
                    'id' => $child_p[$i]['id']
                ));

                $i++;
            }


            if (!$this->ajax) {

                $this->content .= Template::parse_variable($this->template['block'], array(
                    'line' => $ele_line,
                    'nav' => $params['next'],
                ));
            } else {
                $ret_block = array(
                    'content' => $ele_line,
                    'nav' => $params['next']
                );
                $ret_block = json_encode($ret_block);
                echo $ret_block;
                exit;
            }
        }
    }

    private function printSection($root, $level = 1)
    {
        $output = '';
        foreach ($root as $key => $sec) {
            $child = '';
            if (isset($sec['childs'])) {
                $child = $this->printSection($sec['childs'], $level + 1);
            }
            if ($level == 1) {
                $output .= Template::parse_variable($this->template['sectionl'], array(
                    'child' => $child
                ));
            } else {
                $output .= Template::parse_variable($this->template['section_line2_nim'], array(
                    'name' => $sec['name'],
                    'alias' => '/' . $sec['alias'] . '/',
                    'class' => 'level_' . ($level),
                    'child' => $child
                ));
            }
        }
        return $output;
    }

    private function GetFilter()
    {
        $output = '';
        $sel = isset($_SESSION['fill']['brand']) ? $_SESSION['fill']['brand'] : '';
        $q = "SELECT `name`,`id` FROM `it_brand` WHERE `enabled` = 1 ORDER BY `sort`";
        $res = mysql_query($q);
        while ($r = mysql_fetch_assoc($res)) {
            $output .= Template::parse_variable($this->template['fill_brand'], array(
                'name' => $r['name'],
                'id' => $r['id'],
                'activ' => $r['id'] == $sel ? ' class="active"' : ''
            ));
        }
        mysql_free_result($res);
        if ($output != '') {
            $output = Template::parse_variable($this->template['list_brand'], array(
                'list' => $output
            ));
        }

        return $output;
    }

    private function printTree($tree, $level = 1)
    {
        $output = "";
        $output .= Template::parse_variable($this->template['open_child'], array());
        $i = 0;
        foreach ($tree as $val) {
            $output .= Template::parse_variable($this->template['sec_veiw'], array(
                'link' => "/" . $val["alias"] . "/",
                'name' => htmlentities(html_entity_decode($val["name"], ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8'),
            ));

            if (isset($val['childs'])) {
                $output .= $this->printTree($val['childs'], $level + 1);
            }

            $output .= Template::parse_variable($this->template['close_childs'], array());
        }
        $output .= Template::parse_variable($this->template['close_child'], array());
        return $output;
    }

    private function showElement()
    {
        $this->info['shele'] = 1;
        $ele_content = $company = null;
        //join prop price размер/цена
        $q = "SELECT T1.*, T2.keywords, T2.description, IF(pp.price > 0, pp.price, T1.price) as price, COUNT(pp.prop_value) as size_count
			FROM it_tovar T1
			LEFT JOIN it_index T2 ON T2.module_id = 51 AND T2.type_page = 2 AND T2.item_id = T1.id
			LEFT JOIN it_tovar_prop tp ON tp.tid = T1.id AND tp.prid = 1
			LEFT JOIN it_prop_values pv ON pv.id = tp.value
            LEFT JOIN it_prop_price pp ON pp.price > 0 AND pv.id = pp.prop_value AND pp.tovar_id = T1.id
			WHERE
				T1.id = " . $this->section->id . "
			GROUP BY pv.id  LIMIT 1
		";


        $this->base->setQuery($q);
        $this->base->loadObject($ele_content);
        if (!$ele_content) {
            $this->p404 = 1;
            return '';
        }
        $this->info["is_modul"] = 1;
        $this->info['sid'] = $ele_content->sid;
        $this->title = $ele_content->title;
        $this->zagolovok = $ele_content->zagolovok != '' ? $ele_content->zagolovok : $this->section->name;
        $this->keywords = $ele_content->keywords;
        $this->description = $ele_content->description;

        $ele_content->quantity = $ele_content->quantity != NULL ? (int)$ele_content->quantity : '';


        $prop = '';
        $order = array();
        $q = "SELECT * FROM `it_sid_prop` WHERE sid=" . $ele_content->sid;
        $resp = mysql_query($q);
        if ($rp = mysql_fetch_assoc($resp)) {
            if ($rp['prop_id'] != '') {
                $rp['prop_id'] = unserialize($rp['prop_id']);
                $rp['sort_id'] = $rp['sort_id'] != '' ? unserialize($rp['sort_id']) : array();
                if (count($rp['sort_id'])) {
                    asort($rp['sort_id']);
                    reset($rp['sort_id']);
                    $rp['prop_id'] = $rp['sort_id'];
                }
                $order = $rp['prop_id'];
            }
        }
        //ORDER BY T3.value
        $q = "SELECT GROUP_CONCAT(CONCAT(T3.value,',',T3.id) SEPARATOR '; ') as vl,
					GROUP_CONCAT(CONCAT(T3.value_en,',',T3.id) SEPARATOR '; ') as vl_en,
					 GROUP_CONCAT(T1.value SEPARATOR '; ') main_vl,
					 GROUP_CONCAT(T1.value_en SEPARATOR '; ') main_vl_en,
					 T1.prid, T2.name, T2.name_en
				FROM it_tovar_prop T1
				LEFT JOIN it_prop_list T2
					ON T2.id = T1.prid
				LEFT JOIN it_prop_values T3
					ON T3.id = T1.value
					AND T3.prop_id = T1.prid
				WHERE tid = " . $this->section->id . "
				GROUP BY T1.prid";

        $pres = mysql_query($q);
        $stovat = false;

        while ($p = mysql_fetch_assoc($pres)) {
            $order[$p['prid']] = $p;
        }
        $sostav = $size = $rost = '';
        mysql_free_result($pres);

        $props_tv = '';
        foreach ($order as $p) {
            if (!empty($p['vl'])) {
                if (1 == $p['prid'] || 5 == $p['prid'] || 8 == $p['prid']) { // размеры
                    $options = '';
                    $vl = $this->lang['current'] == 1 ? $p['vl'] : $p['vl_en'];
                    $vl = explode('; ', $vl);
                    $sz = array();
                    foreach ($vl as $size) {
                        $size = explode(',', $size);
                        $sz[$size[1]] = $size[0];
                    }
                    if (1 == $p['prid']) {
                        ksort($sz);
                    } else {
                        asort($sz);
                    }
                    reset($sz);
                    $_first_value = true;
                    foreach ($sz as $z => $svl) {
                        //$size = explode(',', $size);
                        $options .= Template::parse_variable($this->template[(8 == $p['prid'] ? 'rost' : 'size') . ($_first_value ? '_active' : '')], array(
                            'value' => $svl,
                            'id' => $z,
                        ));
                        if ($_first_value) {
                            $_first_value = !$_first_value;
                        }
                    }
                    if (!empty($options)) {
                        if (8 == $p['prid']) {
                            $rost = Template::parse_variable($this->template['rosts'], array(
                                'line' => $options
                            ));
                        } else {
                            $size = Template::parse_variable($this->template['sizes'], array(
                                'line' => $options
                            ));
                        }
                    }
                } else {
                    $vl = $this->lang['current'] == 1 ? $p['vl'] : $p['vl_en'];
                    $vl = explode('; ', $vl);
                    $vals = array();
                    foreach ($vl as $si) {
                        $si = explode(',', $si);
                        $vals[$si[1]] = $si[0];
                    }
                    asort($vals);
                    reset($vals);
                    $vals = implode(', ', $vals);

                    $props_tv .= Template::parse_variable($this->template['vline'], array(
                        'name' => $this->lang['current'] == 1 ? $p['name'] : $p['name_en'],
                        'val' => '<p>' . $vals . '</p>'
                    ));
                }
            } elseif (!empty($p['main_vl'])) {
                if (2 == $p['prid']) { // размеры
                    $sostav = Template::parse_variable($this->template['vline'], array(
                        'name' => $this->lang['current'] == 1 ? $p['name'] : $p['name_en'],
                        'val' => $this->lang['current'] == 1 ? $p['main_vl'] : $p['main_vl_en']
                    ));
                } else {
                    if (strpos($p['main_vl'], '<') === false) {
                        $p['main_vl'] = '<p>' . $p['main_vl'] . '</p>';
                        $p['main_vl_en'] = '<p>' . $p['main_vl_en'] . '</p>';
                    }
                    $props_tv .= Template::parse_variable($this->template['vline'], array(
                        'name' => $this->lang['current'] == 1 ? $p['name'] : $p['name_en'],
                        'val' => $this->lang['current'] == 1 ? $p['main_vl'] : $p['main_vl_en']
                    ));
                }
            }
        }

        $ele_line = '';
        if ($ele_content->collections != '') {
            $ele_content->collections = unserialize($ele_content->collections);
            $ids = implode(',', array_keys($ele_content->collections));
            $q = "SELECT * FROM it_tovar WHERE id IN ({$ids}) AND enabled = 1 ORDER BY `sort` DESC";
            $tvr = mysql_query($q);
            $par = $prod = array();
            while ($sib = mysql_fetch_assoc($tvr)) {
                $prod[] = $sib;
            }
            mysql_free_result($tvr);

            if (count($prod)) {
                $c = 0;
                foreach ($prod as $tovar) {
                    $c++;
                    if ($tovar['image'] != '') {
                        $file = $this->Img_name($tovar["image"], 'm');
                        if (is_file($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->elepic_path . $file)) {
                            $file = "/" . $this->elepic_path . $file;
                        } else {
                            $file = '/i/no-image-s.png';
                        }
                    } else {
                        $file = '/i/no-image-s.png';
                    }

                    $ele_line .= Template::parse_variable($this->template['item'], array(
                        'link' => $this->lang['url_prefix'] . adds_to_path($this->root[$tovar['sid']]['alias'] . '/' . $tovar['alias']),
                        'name' => $this->lang['current'] == 1 ? $tovar['name'] : $tovar['name_en'],
                        'image' => $file != '' ? Template::parse_variable($this->template['image'], array('src' => $file, 'name' => $tovar['name'], 'size' => '')) : '',
                    ));

                }
                if ($ele_line != '') {
                    $ele_line = Template::parse_variable($this->template['item_block'], array(
                        'line' => $ele_line
                    ));
                }
            }
        }

        $q = "SELECT * FROM it_color WHERE 1";
        $cs = mysql_query($q);
        $colors = array();
        while ($rs = mysql_fetch_assoc($cs)) {
            $colors[$rs['id']] = $rs;
        }

        $color_block = '';
        $galery = $galery_block = '';
        if (is_file(ITCMS_CORE . '/modules/gallery.inc.php')) {
            include_once ITCMS_CORE . '/modules/gallery.inc.php';
            $gal = new Gallery($this->path, $this->lang, $this->info);
            $gal->setTemplate('main_gallery');
        }

        if ($ele_content->colors != '') {
            $ele_content->colors = unserialize(stripcslashes($ele_content->colors));
            $first = false;
            foreach ($ele_content->colors as $v) {
                if (isset($colors[$v])) {
                    if ($galery_block == '') {
                        $galery_block = $gal->show_gallery_block(array('ID' => $this->section->id, 'MODULS' => '51', 'rel' => '', 'color' => $colors[$v]['id'], 'name' => $this->lang['current'] == 1 ? $ele_content->zagolovok : $ele_content->zagolovok_en));
                        if ($galery_block) $first = true;
                    }
                    if ($colors[$v]['image'] != '' && is_file($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->color_path . '/' . $colors[$v]['image'])) {
                        $back = 'background:url(/' . $this->color_path . '/' . $colors[$v]["image"] . ') center center no-repeat; background-size: 18px 18px;';
                    } else {
                        $back = 'background:#' . $colors[$v]["hex"] . '; ';
                    }
                    $color_block .= Template::parse_variable($this->template['color_item'], array(
                        'back' => $back,
                        'id' => $colors[$v]['id'],
                        'name' => $this->lang['current'] == 1 ? $colors[$v]['name'] : $colors[$v]['name_en'],
                        'checked' => $first ? ' color-activ' : '',
                        'border' => $colors[$v]['hex'] === 'ffffff' ? ' borderln' : '',
                        'eid' => $this->section->id
                    ));
                    $first = false;
                }
            }
            $color_block = Template::parse_variable($this->template['color_block'], array(
                'line' => $color_block
            ));
        }

        if ($galery_block == '') {
            if ($ele_content->image != '') {
                if (is_file($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->elepic_path . $ele_content->image)) {
                    $galery_block = array(
                        'list' => Template::parse_variable($this->template['gallery_items'], array('list' => Template::parse_variable($this->template['gallery_item'], array(
                                'color' => '',
                                'img_full' => '/' . $this->elepic_path . $ele_content->image,
                                'title' => htmlspecialchars($ele_content->name, ENT_QUOTES)
                            )
                        )
                        )),
                        'nav' => ''
                    );
                }
            }
        }

        require_once ITCMS_CORE . '/modules/system.inc.php';

        $nav = new system($this->path, $this->lang, $this->info);
        $bread = $nav->navibar(array('LAST' => 1));

        $price = $ele_content->discount_price != 0 && $ele_content->size_count == 0 ? number_format($ele_content->discount_price, 0, ',', ' ') : number_format($ele_content->price, 0, ',', ' ');
        $price_value = $ele_content->discount_price != 0 && $ele_content->size_count == 0 ? $ele_content->discount_price : $ele_content->price;
        $q = "SELECT value FROM it_gl_settings WHERE id = 160";
        $valute = mysql_fetch_assoc(mysql_query($q));
        $price_en = $ele_content->discount_price != 0 && $ele_content->size_count == 0 ? $ele_content->discount_price : $ele_content->price;
        $price_en = ceil($price_en / $valute['value']);
        $price_en = number_format($price_en, 0, ',', ' ');
        $this->info['metaImg'] = '<meta property="og:image" content="http://' . $_SERVER['SERVER_NAME'] . "/" . $this->elepic_path . $this->Img_name($ele_content->image, 's') . '" />';

        $comment_line = '';
        if ($ele_content->comment == 1) {
            $comment_line = Template::parse_variable($this->template['comments'], array(
                'length' => $ele_content->length_comm
            ));
        }
        if ($ele_content->id != 545) {
            $this->content .= Template::parse_variable($this->template['element'], array(
                'gallery' => is_array($galery_block) ? $galery_block['list'] : '',
                'bread' => $bread,
                'name' => $this->lang['current'] == 1 ? $ele_content->zagolovok : $ele_content->zagolovok_en,//$ele_content->name : $ele_content->name_en,
                'article' => $ele_content->article,
                'price' => Template::parse_variable($this->template['price'], array('price' => $price, 'price_en' => $price_en)),
                'price_value' => $price_value,
                'content' => $this->lang['current'] == 1 ? $ele_content->content : $ele_content->content_en,
                'props' => $props_tv,
                'sostav' => $sostav,
                'colors' => $color_block,
                'id' => $ele_content->id,
                'sizes' => $size,
                'rost' => $rost,
                'link_ele' => $ele_line,
                'url' => urlencode('http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']),
                'title' => $this->lang['current'] == 1 ? trim(strip_tags(htmlentities($ele_content->zagolovok, ENT_QUOTES, 'UTF-8'))) : trim(strip_tags(htmlentities($ele_content->zagolovok_en, ENT_QUOTES, 'UTF-8'))),
                'titletw' => $this->lang['current'] == 1 ? urlencode(trim(strip_tags(htmlentities($ele_content->zagolovok, ENT_QUOTES, 'UTF-8')))) : urlencode(trim(strip_tags(htmlentities($ele_content->zagolovok_en, ENT_QUOTES, 'UTF-8')))),
                'desc' => $this->lang['current'] == 1 ? trim($this->clear_txt(strip_tags($ele_content->content))) : trim($this->clear_txt(strip_tags($ele_content->content_en))),
                'img' => 'http://' . $_SERVER['SERVER_NAME'] . "/" . $this->elepic_path . $this->Img_name($ele_content->image, 's'),
                'tags' => "",
                'coment' => $comment_line,
                'fast_order' => Template::parse_variable($this->template['fast_order'], array('id' => $ele_content->id)),
                'none' => $ele_content->quantity === 0 ? Template::parse_variable($this->template['none'], array()) : '',
                'vk' => '',//$vk != 0 ? Template::parse_variable($this->template['counter'], array('count' => $vk)) : '',
                'fb' => '',//$fb != 0 ? Template::parse_variable($this->template['counter'], array('count' => $fb)) : '',
                'tw' => '',//$tw	!= 0 ? Template::parse_variable($this->template['counter'], array('count' => $tw)) : ''
            ));
        } else {
            $this->content .= Template::parse_variable($this->template['sertificate'], array(
                'gallery' => is_array($galery_block) ? $galery_block['list'] : '',
                'bread' => $bread,
                'name' => $this->lang['current'] == 1 ? $ele_content->zagolovok : $ele_content->zagolovok_en,//$ele_content->name : $ele_content->name_en,
                'article' => $ele_content->article,
                'price' => Template::parse_variable($this->template['price_sert'], array()),
                'content' => $this->lang['current'] == 1 ? $ele_content->content : $ele_content->content_en,
                'id' => $ele_content->id,
                'link_ele' => $ele_line,
                'url' => urlencode('http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']),
                'title' => $this->lang['current'] == 1 ? trim(strip_tags(htmlentities($ele_content->zagolovok, ENT_QUOTES, 'UTF-8'))) : trim(strip_tags(htmlentities($ele_content->zagolovok_en, ENT_QUOTES, 'UTF-8'))),
                'titletw' => $this->lang['current'] == 1 ? urlencode(trim(strip_tags(htmlentities($ele_content->zagolovok, ENT_QUOTES, 'UTF-8')))) : urlencode(trim(strip_tags(htmlentities($ele_content->zagolovok_en, ENT_QUOTES, 'UTF-8')))),
                'desc' => $this->lang['current'] == 1 ? trim($this->clear_txt(strip_tags($ele_content->content))) : trim($this->clear_txt(strip_tags($ele_content->content_en))),
                'img' => 'http://' . $_SERVER['SERVER_NAME'] . "/" . $this->elepic_path . $this->Img_name($ele_content->image, 's'),
                'tags' => "",
                'vk' => '',
                'fb' => '',
                'tw' => ''
            ));
        }
    }

    private function email_check($email)
    {
        $patt = "/^([\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+\.)*[\w\!\#$\%\&\'\*\+\-\/\=\?\^\`{\|\}\~]+@((((([a-z0-9]{1}[a-z0-9\-]{0,62}[a-z0-9]{1})|[a-z])\.)+[a-z]{2,6})|(\d{1,3}\.){3}\d{1,3}(\:\d{1,5})?)$/i";
        if (!preg_match($patt, trim($email))) {
            return false;
        } else {
            return true;
        }
    }

    private function email_phone($uphone)
    {
        $patt = "/[%a-z_@.,^=:;а-я\"*&$#№!?<>\~`|[{}\]]/i";
        if ((strlen($uphone) < 5) || (preg_match($patt, trim($uphone)))) {
            return false;
        } else {
            return true;
        }
    }

    private function SendQuest()
    {
        error_reporting(E_ALL);
        $err = 0;
        $form_mess = $mess = '';
        foreach ($_POST as $key => $val) {
            switch ($key) {
                case "fio":
                    if (trim($val) != '') {
                        $mess .= "<p><b>Отправитель</b>: &nbsp;" . trim($val) . "</p>";
                        $fio = trim($val);
                    } else {
                        $err++;
                        $fio = '';
                        $form_mess .= "Обязательное поле \"Представьтесь, пожалуйста\" не заполнено<br>";
                    }
                    break;
                case "contact":
                    if (trim($val) != '') {
                        if ($this->email_check($val)) {
                            $mess .= "<p><b>Контактные данные</b>: &nbsp;" . trim($val) . "</p>";
                            $from = $contact = $val;
                        } elseif ($this->email_phone($val)) {
                            $mess .= "<p><b>Контактные данные</b>: &nbsp;" . trim($val) . "</p>";
                            $contact = $val;
                        } else {
                            $err++;
                            $contact = $val;
                            $form_mess .= "Обязательное поле \"Адрес эл. почты или телефон\" заполнено не корректно<br>";
                        }
                    } else {
                        $err++;
                        $contact = '';
                        $form_mess .= "Обязательное поле \"Адрес эл. почты или телефон\" не заполнено<br>";
                    }
                    break;
                case "quest":
                    if (trim($val) != '') {
                        $mess .= "<p><b>Товар</b>: &nbsp;" . $this->section->name . "</p>";
                        $mess .= "<p><b>Вопрос</b>: &nbsp;" . trim($val) . "</p>";
                        $quest = $val;
                    } else {
                        $err++;
                        $quest = '';
                        $form_mess .= "Обязательное поле \"Вопрос\" не заполнено";
                    }
                    break;
            }
        }
        if ($err == 0) {
            $subject = "Вопрос с сайта " . $_SERVER["SERVER_NAME"];
            if (isset($from)) {
                $headers = "From: =?utf-8?B?" . (empty($fio) ? '' : base64_encode($fio)) . "?= <" . $from . ">\r\n";
            } else {
                $headers = "From: =?utf-8?B?" . (empty($fio) ? '' : base64_encode($fio)) . "?= <no_replay@skbo.ru>\r\n";
            }
            //$headers = "From: =?utf-8?B?".(empty($fio)?'':base64_encode($fio))."?= <a.elsukov@itstudio.ru>\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=utf-8\nContent-Transfer-Encoding: base64\n";
            $headers .= "X-Priority: 3\nX-Mailer: PHPMail Tool\r\n";
            $headers .= "X-MSMail-Priority: Normal\r\n\r\n";
            $subject = "=?utf-8?B?" . base64_encode($subject) . "?=";
            //$to = "elsukov.alexei@yandex.ru";
            $q = "SELECT value FROM it_gl_settings WHERE id = 9";
            $res = mysql_query($q);
            if ($set = mysql_fetch_array($res)) {
                $to = $set["value"];
            } else {
                return Template::parse_variable($this->template['feedback_block'], array(
                    "mess" => "<p class=\"err\">По техническим причинам доставка вашего письма на данный момент не возможна, повторите отправку позже.</p>",
                    "fio" => $fio,
                    "contact" => $contact,
                    "quest" => $quest
                ));
            }
            $msg = chunk_split(base64_encode($mess)) . "\r\n";
            if (mail($to, $subject, $msg, $headers)) {
                $_SESSION['status_form'] = 'ok';
                unset($_POST);
                unset($subject);
                unset($msg);
                unset($headers);
                $quest = "";
                return '';
            } else {
                return Template::parse_variable($this->template['feedback_block'], array(
                    "mess" => "<p class=\"err\">По техническим причинам доставка вашего письма на данный момент не возможна, повторите отправку позже.</p>",
                    "fio" => $fio,
                    "contact" => $contact,
                    "quest" => $quest
                ));
            }
        } else {
            $form_mess = "<p class=\"err\">" . $form_mess . "</p>";
            return Template::parse_variable($this->template['feedback_block'], array(
                "mess" => $form_mess,
                "fio" => $fio,
                "contact" => $contact,
                "quest" => $quest
            ));
        }
    }

    private function getSibProd($ind = '')
    {
        $sib = array();

        $child_p = $this->GetStructureEle(1, 1);
        $items = array();

        foreach ($child_p as $ele) {
            if ($ele['sid'] == $this->section->parent_id) {
                $items[$ele["id"]] = $ele;
            }
        }

        unset($child_p);
        unset($items[$this->section->id]);
        sort($items);

        $line = 3;
        $line = $line > count($items) ? count($items) : $line;
        $elements = array();
        while ($line > 0) {
            $index = mt_rand(0, (count($items) - 1));
            $elements[] = $items[$index];
            unset($items[$index]);
            $items = array_merge($items, array());
            $line--;
        }
        unset($items);

        return $elements;
    }

    /*Ajax*/

    private function ajax()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST["type"])) {
                switch ($_POST["type"]) {
                    case 'price_by_prop':
                        $block = $this->PriceByProp();
                        break;
                    case 'order':
                        $block = $this->OrderMake();
                        break;
                    case 'chcolor':
                        $block = $this->ChColor();
                        break;
                    case 'schcolor':
                        $block = $this->SChColor();
                        break;
                    default:
                        $this->p404 = 1;
                        return '';
                        break;
                }
            } else {
                $this->p404 = 1;
                return '';
            }
            echo $block;
        } else {
            $this->p404 = 1;
            return '';
        }
    }

    private function SChColor()
    {
        clearstatcache();
        $color_id = (int)$_POST['cid'];
        $ele_id = (int)$_POST['ele'];
        $q = "SELECT * FROM `it_gallery` WHERE `enabled` = '1' AND `page_id` = '" . $ele_id . "' AND `color_id`=" . $color_id . " AND `module_id` = 51 AND `sections` = 0 ORDER BY `order`, id DESC LIMIT 1";
        $res = mysql_query($q) or die(mysql_error());
        $img = '';
        if ($r = mysql_fetch_assoc($res)) {
            $dir_gallery = 'files/img/gallery/m51/';
            foreach ($this->Img_Extensions as $ext) {
                if (is_file($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $dir_gallery . $r['page_id'] . '/' . $r['tovar_name'] . $r['id'] . '.' . $ext)) {
                    $img = '/' . $dir_gallery . $r['page_id'] . '/' . $r['tovar_name'] . $r['id'] . '.' . $ext;
                    break;
                }
            }
        }
        return $img;
    }

    private function ChColor()
    {
        $color_id = (int)$_POST['cid'];
        $ele_id = (int)$_POST['ele'];
        $galery = $galery_block = '';
        if (is_file(ITCMS_CORE . '/modules/gallery.inc.php')) {
            include_once ITCMS_CORE . '/modules/gallery.inc.php';
            $gal = new Gallery($this->path, $this->lang, $this->info);
            if ($gal->setTemplate('ajax_gallery')) {
                $galery_block = $gal->show_gallery_block(array('ID' => $ele_id, 'MODULS' => '51', 'rel' => '', 'color' => $color_id));
            }
        }
        if (is_array($galery_block)) {
            return $galery_block['list'];
        } else {
            return '';
        }
    }

    private function SendOrd()
    {
        if (isset($_SESSION['err'])) {
            unset($_SESSION['err']);
        }
        if (!isset($_POST['id'])) {
            $_SESSION['err']['tovar'];
            return '';
        }

        $company = $_SESSION["data"]['company'] = $_POST['company'];
        $fio = $_SESSION["data"]['fio'] = $_POST['fio'];
        $phone = $_SESSION["data"]['phone'] = $_POST['phone'];
        $email = $_SESSION["data"]['email'] = $_POST['email'];
        $comment = $_SESSION["data"]['comment'] = $_POST['comment'];

        if (!$this->email_check($email)) {
            $_SESSION['err']['email'] = 'Адрес электронной почты задан не корректно';
        }

        if (!$this->email_phone($phone)) {
            $_SESSION['err']['phone'] = 'Телефон задан не корректно';
        }

        if ($company == '' || strlen($company) < 3) {
            $_SESSION['err']['company'] = 'Название компании задано не корректно';
        }

        if ($fio == '' || strlen($fio) < 5) {
            $_SESSION['err']['fio'] = 'ФИО заданны не корректно';
        }

        $q = "SELECT `zagolovok` FROM it_tovar WHERE id = " . $_POST['id'];

        $res = mysql_query($q);
        if ($r = mysql_fetch_assoc($res)) {
            $tovar = $r['zagolovok'];
        }
        $msg = '';
        if (!isset($_SESSION["err"])) {
            $make_send = time();
            $bound = "--" . md5(uniqid(rand(), true) . time());

            $file = $structure = $fname = '';
            if (is_uploaded_file($_FILES['attach']['tmp_name'])) {
                if (!empty($_FILES['attach']['name'])) {
                    $file .= $this->file_attach($bound,
                        array(
                            'name' => $_FILES['attach']['name'],
                            'tmp_name' => $_FILES['attach']['tmp_name']
                        ));
                }
                $fname = strtolower($this->translit($_FILES['attach']['name']));
            }

            $structure .= "<p><b>Товар</b>: " . $tovar . "</p>\n";
            $structure .= "<p><b>ФИО</b>: " . $fio . "</p>\n";
            $structure .= "<p><b>Телефон</b>: " . $phone . "</p>\n";
            $structure .= "<p><b>Эл. почта</b>: " . $email . "</p>\n";
            $structure .= "<p><b>Комментарий</b>:<br>" . $comment . "</p>\n";

            if (!empty($file)) {
                $msg .= "--" . $bound . "\r\n";
                $msg .= "Content-type: text/html; charset=utf-8\r\n";
                $msg .= "Content-Transfer-Encoding: base64\r\n\r\n";
            }
            $msg .= chunk_split(base64_encode($structure)) . "\r\n";

            if (!empty($file)) {
                $msg .= $file . "--" . $bound . "--\r\n";;
            }

            $themes = 'Заказ товара с сайта';

            $q = "SELECT value FROM it_gl_settings WHERE id = 9";
            $res = mysql_query($q);
            if ($set = mysql_fetch_array($res)) {
                $email_cur = $set["value"];
            }
            $arr_emails = explode(",", $email_cur);
            $arr_emails[] = 'elsukov.alexei@yandex.ru';
            $arr_emails[] = 'a.elsukov@itstudio.ru';
            $arr_emails[] = 'a.andreeva@itstudio.ru';
            foreach ($arr_emails AS $emaill) {
                $to = trim($emaill);
                if ($this->send_message_form($to, $email, $msg, $themes, $fio, empty($file) ? '' : $bound)) {
                    $_SESSION['status'] = 'ok';
                }
            }
            unset($_SESSION["data"]);
        }
        return '';
    }

    private function send_message_form($to, $from, $mess, $subject, $name, $bound = '')
    {
        $headers = "From: =?utf-8?B?" . (empty($name) ? '' : base64_encode($name)) . "?= <info@bastionltd.ru>\r\n";
        $headers .= "Reply-To: <" . $from . ">\r\n";
        $headers .= "X-Priority: 3\nX-Mailer: PHPMail Tool\r\n";
        $headers .= "X-MSMail-Priority: Normal\r\n";

        if (empty($bound)) {
            $headers .= "Content-type: text/html; charset=utf-8\nContent-Transfer-Encoding: base64\n";
        } else {
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: multipart/mixed; boundary=\"" . $bound . "\"\r\n";
        }

        $subject = "=?utf-8?B?" . base64_encode($subject) . "?=";
        $msg = $mess;
        if (mail($to, $subject, $msg, $headers)) {
            return 1;
        } else {
            return 0;
        }
    }

    private function file_attach($boundary, $param)
    {
        $file = "";
        if (!empty($param["tmp_name"])) {
            $fp = fopen($param["tmp_name"], "rb");
            if ($fp) {
                $content = fread($fp, filesize($param["tmp_name"]));
                fclose($fp);
                $file .= "--" . $boundary . "\r\n";
                $file .= "Content-Type: application/octet-stream\r\n";
                $file .= "Content-Transfer-Encoding: base64\r\n";
                $file .= "Content-Disposition: attachment; filename=\"" . $param["name"] . "\"\r\n\r\n";
                $file .= chunk_split(base64_encode($content)) . "\r\n";
            }
        }
        return $file;
    }

    private function translit($str)
    {
        $str = preg_replace('/[^а-яА-Я0-9A-Za-z\-\.]+/imus', '_', $str);
        $tr = array(
            "Ґ" => "G", "Ё" => "YO", "Є" => "E", "Ї" => "YI", "І" => "I",
            "і" => "i", "ґ" => "g", "ё" => "yo", "№" => "#", "є" => "e",
            "ї" => "yi", "А" => "A", "Б" => "B", "В" => "V", "Г" => "G",
            "Д" => "D", "Е" => "E", "Ж" => "ZH", "З" => "Z", "И" => "I",
            "Й" => "Y", "К" => "K", "Л" => "L", "М" => "M", "Н" => "N",
            "О" => "O", "П" => "P", "Р" => "R", "С" => "S", "Т" => "T",
            "У" => "U", "Ф" => "F", "Х" => "H", "Ц" => "TS", "Ч" => "CH",
            "Ш" => "SH", "Щ" => "SCH", "Ъ" => "", "Ы" => "YI", "Ь" => "",
            "Э" => "E", "Ю" => "YU", "Я" => "YA", "а" => "a", "б" => "b",
            "в" => "v", "г" => "g", "д" => "d", "е" => "e", "ж" => "zh",
            "з" => "z", "и" => "i", "й" => "y", "к" => "k", "л" => "l",
            "м" => "m", "н" => "n", "о" => "o", "п" => "p", "р" => "r",
            "с" => "s", "т" => "t", "у" => "u", "ф" => "f", "х" => "h",
            "ц" => "ts", "ч" => "ch", "ш" => "sh", "щ" => "sch", "ъ" => "",
            "ы" => "yi", "ь" => "", "э" => "e", "ю" => "yu", "я" => "ya",
            " " => "_", "'" => "",
        );

        $str = strtr($str, $tr);
        $str = trim(preg_replace('/_{2}/', '_', $str), ' _');
        return $str;
    }

    private function getPriceByProp($id, $prop_value, $prop_id = 1)
    {
        //join prop price размер/цена
        $q = "SELECT IF(pp.price > 0, pp.price, t.price) as price, t.discount_price as discount_price, COUNT(pp.prop_value) as size_count 
        FROM it_tovar t 
          LEFT JOIN it_prop_price pp ON t.id = pp.tovar_id AND pp.price > 0 AND pp.prop_id = {$prop_id} AND pp.prop_value = '{$prop_value}'
        WHERE t.id = {$id} AND t.enabled=1 GROUP BY t.id";
        $price = '';
        if (($res = mysql_query($q))) {
            $row = mysql_fetch_assoc($res);
            $price = $row['price'];
            if ($row['discount_price'] && !$row['size_count']) {
                $price = $row['discount_price'];
            }
        }
        return $price;
    }

    private function PriceByProp()
    {
        if (!isset($_POST['id'])) return '';
        $id = intval($_POST['id']);
        $prop_value = !empty($_POST['size']) ? intval($_POST['size']) : 0;

        return number_format($this->getPriceByProp($id, $prop_value), 0, ',', ' ');

    }

    private function OrderMake()
    {
        if (!isset($_POST['id'])) return '';
        $block = Template::parse_variable($this->template['orderform'], array(
            'id' => $_POST['id'],
            //'page'			=>	$_POST['page'],
            'company' => isset($_SESSION["data"]['company']) ? $_SESSION['data']['company'] : '',
            'errcompany' => isset($_SESSION['err']['company']) ? Template::parse_variable($this->template['errms'], array('text' => $_SESSION['err']['company'])) : '',
            'fio' => isset($_SESSION["data"]['fio']) ? $_SESSION["data"]['fio'] : '',
            'errfio' => isset($_SESSION['err']['fio']) ? Template::parse_variable($this->template['errms'], array('text' => $_SESSION['err']['fio'])) : '',
            'phone' => isset($_SESSION["data"]['phone']) ? $_SESSION["data"]['phone'] : '',
            'errphone' => isset($_SESSION['err']['phone']) ? Template::parse_variable($this->template['errms'], array('text' => $_SESSION['err']['phone'])) : '',
            'email' => isset($_SESSION["data"]['email']) ? $_SESSION["data"]['email'] : '',
            'erremail' => isset($_SESSION['err']['email']) ? Template::parse_variable($this->template['errms'], array('text' => $_SESSION['err']['email'])) : '',
            'comment' => isset($_SESSION["data"]['comment']) ? $_SESSION["data"]['comment'] : ''
        ));
        if (isset($_SESSION['err'])) {
            unset($_SESSION['err']);
        };

        return $block;
    }

    private function SkladLoad()
    {
        if (!isset($_POST['sklad_id']) || !isset($_POST['tovar_id'])) {
            return '';
        }

        $sklad_id = (int)$_POST['sklad_id'];
        $tovar_id = (int)$_POST['tovar_id'];
        $q = "SELECT * FROM it_link_tvsk T1 LEFT JOIN it_sklad T2 ON T2.id = T1.skid WHERE T1.tid = " . $tovar_id . " AND T1.skid = " . $sklad_id . " AND T2.enabled = 1";
        $res = mysql_query($q);
        $block = '';
        if ($r = mysql_fetch_assoc($res)) {
            $prop = '';
            $r['metro'] = $r['metro'] != '' ? unserialize($r['metro']) : array();
            $line = '';
            if (count($r['metro'])) {
                $q = "SELECT * FROM it_metro WHERE 1";
                $mtres = mysql_query($q);
                $metro = array();
                while ($mt = mysql_fetch_assoc($mtres)) {
                    $metro[$mt['id']] = $mt;
                }
                mysql_free_result($mtres);
                foreach ($r['metro'] as $mid) {
                    $line .= $line == '' ? $metro[$mid]['name'] : ', ' . $metro[$mid]['name'];
                }

                $line = $line . '; ';
            }
            if ($r['phones'] != '') {
                $prop .= Template::parse_variable($this->template['prop'], array(
                    'name' => 'Телефон',
                    'val' => $r['phones']
                ));
            }
            if ($r['timework'] != '') {
                $prop .= Template::parse_variable($this->template['prop'], array(
                    'name' => 'Время работы',
                    'val' => $r['timework']
                ));
            }

            if ($r['quant'] == 1) {
                $prop .= Template::parse_variable($this->template['prop_col'], array(
                    'name' => 'Количество товара',
                    'val' => 'Последний экземпляр',
                    'class' => 'lasto'
                ));
            } elseif ($r['quant'] > 1 && $r['quant'] < 11) {
                $prop .= Template::parse_variable($this->template['prop_col'], array(
                    'name' => 'Количество товара',
                    'val' => 'Мало',
                    'class' => 'small'
                ));
            } elseif ($r['quant'] > 10 && $r['quant'] < 51) {
                $prop .= Template::parse_variable($this->template['prop_col'], array(
                    'name' => 'Количество товара',
                    'val' => 'Достаточно',
                    'class' => 'medium'
                ));
            } elseif ($r['quant'] > 50) {
                $prop .= Template::parse_variable($this->template['prop_col'], array(
                    'name' => 'Количество товара',
                    'val' => 'Много',
                    'class' => 'more'
                ));
            }

            $block = Template::parse_variable($this->template['sklad'], array(
                'name' => $r['name'],
                'metro' => $line,
                'addres' => $r['address'],
                'prop' => $prop,
                'skid' => $r['skid'],
                'tid' => $r['tid']
            ));
        }
        mysql_free_result($res);
        return $block;
    }

    private function makeReserv()
    {
        $name = mysql_escape_string($_POST['name']);
        $phone = mysql_escape_string($_POST['phone']);
        $quant = (int)$_POST['quant'];
        $q = "SELECT name FROM it_sklad WHERE id = " . $_POST['skid'];
        $res = mysql_query($q);
        $sname = mysql_fetch_assoc($res);
        $q = "SELECT name FROM it_tovar WHERE id = " . $_POST['tid'];
        $res = mysql_query($q);
        $tname = mysql_fetch_assoc($res);
        $q = "INSERT INTO it_reserv (`fio`,`phone`,`tovar_id`,`quant`,`sklad_id`) VALUES ('" . $name . "','" . $phone . "','" . $_POST['tid'] . "','" . $quant . "','" . $_POST['skid'] . "')";
        if (mysql_query($q)) {
            $id = mysql_insert_id();
            $out = '<p>Спасибо, в магазине ' . $sname['name'] . ' для вас отложен товар ' . $tname['name'] . ' в количестве ' . $quant . ' шт.</p><p>Вы можете забрать его указав номер брони - ' . $id . '</p>';
        } else {
            $out = '<p>По техническим причинам попытка бронирования не удалась попробуйте в другой раз.</p>';
        }
        return $out;
    }

    private function reserveProducts()
    {
        $out = Template::parse_variable($this->template['form_reserve'], array(
            'name' => '',
            'phone' => '',
            'quant' => '',
            'required' => 'required',
            'tid' => (int)$_POST['ele'],
            'skid' => (int)$_POST['skid']
        ));
        return Template::parse_variable($this->template['feedback_block_ajax'], array(
            "form" => $out
        ));
    }

    private function veiwProduct()
    {
        if (!isset($_POST['id'])) return '';

        $q = "SELECT * FROM it_catalog_elements WHERE pid=" . $_POST['id'];
        $res = mysql_query($q);
        if ($r = mysql_fetch_assoc($res)) {
            $img_name = $this->Img_name($r['image'], 'g');
            if (is_file($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->elepic_path . $img_name)) {
                $size = getimagesize($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->elepic_path . $img_name);
                $file = "/" . $this->elepic_path . $img_name;
                return Template::parse_variable($this->template['product_veiw_img'], array(
                    'name' => htmlentities($r['zagolovok'], ENT_QUOTES, 'UTF-8'), //htmlentities(html_entity_decode($child_p[$i]["name"],ENT_QUOTES,'UTF-8'),ENT_QUOTES,'UTF-8'),
                    'price' => number_format($r['price'], 0, ',', ' '),
                    'img' => $file,
                    'size' => $size[3],
                    'article' => $r['article'],
                    'anons' => $r['anons']
                ));
            } else {
                return Template::parse_variable($this->template['product_veiw_noimg'], array(
                    'name' => htmlentities($r['zagolovok'], ENT_QUOTES, 'UTF-8'), //htmlentities(html_entity_decode($child_p[$i]["name"],ENT_QUOTES,'UTF-8'),ENT_QUOTES,'UTF-8'),
                    'price' => number_format($r['price'], 0, ',', ' '),
                    'article' => $r['article'],
                    'anons' => $r['anons']
                ));
            }
        } else {
            return '';
        }
    }

    private function filterProducts()
    {
        $path = ITCMS_TEMPLATE . '/' . $this->lang['alias'] . '/modules/catalog/';
        $tmpl = "sections";
        if (is_file($path . $tmpl . '.php')) {
            include $path . $tmpl . '.php';
        } else {
            return false;
        }

        $this->set_template($TEMPLATE);

        $blockk = '';
        $new_mas = array();

        $cat[] = $_POST['sid'];
        $ids[] = $_POST['sid'];
        $id = $_POST['sid'];
        $cur_alias = '';
        do {
            $sql = "
					SELECT T1.id, T1.parent_id, T1.alias FROM it_st_catalog T1
					WHERE T1.name != '' AND T1.enabled = 1 AND T1.lang_id = " . $this->lang['current'] . " AND id = " . $id;
            $res = mysql_query($sql);
            if ($row = mysql_fetch_assoc($res)) {
                $id = $row['parent_id'];
                $cur_alias = $row['alias'] . ($cur_alias == '' ? '' : '/') . $cur_alias;
            }
        } while (mysql_num_rows($res) != 0);
        mysql_free_result($res);

        $alias = array($_POST['sid'] => $cur_alias);
        do {
            $par = implode(',', $cat);
            $sql = "
					SELECT T1.id, T1.parent_id, T1.alias FROM it_st_catalog T1
					WHERE T1.name != '' AND T1.enabled = 1 AND T1.lang_id = " . $this->lang['current'] . " AND T1.parent_id IN ({$par})";
            $res = mysql_query($sql);
            $cat = array();
            while ($row = mysql_fetch_assoc($res)) {
                $cat[] = $row['id'];
                $ids[] = $row['id'];
                $alias[$row['id']] = $alias[$row['parent_id']] . '/' . $row['alias'];
                //здесь делаем что-то полезное, сохраняющее рез-ты выборки
            }
            if ((count($cat) == 0)) {
                break;
            }
            //$parents = array_merge($parents,$parent);
        } while (mysql_num_rows($res) != 0);
        mysql_free_result($res);

        $ids = implode(',', $ids);
        $brand = array();
        if (isset($_POST['brand'])) {
            foreach ($_POST['brand'] as $key => $val) {
                $brand[] = $key;
            }
        }

        if (count($brand) > 0) {
            $brand = implode(',', $brand);
            $brand = " AND T1.brand IN ({$brand})";
        } else {
            $brand = '';
        }

        if (isset($_POST['prop'])) {
            $prop = array();
            $items = array();
            foreach ($_POST['prop'] as $key => $val) {
                foreach ($val as $param => $p) {
                    $items[$key][$param] = array();
                }
                $prop[] = $key;
            }

            $sql = '';
            if (count($prop) > 0) {
                $prop = implode(',', $prop);
                $sql = "SELECT tid,prid,value FROM `it_tovar_prop` WHERE sid IN ({$ids}) AND prid IN ({$prop})";
                $res = mysql_query($sql);

                if (mysql_num_rows($res) > 0) {
                    while ($r = mysql_fetch_assoc($res)) {
                        if (isset($items[$r['prid']][$r['value']])) {
                            $items[$r['prid']][$r['value']][] = $r['tid'];
                        }
                    }
                }

                foreach ($items as $key => $val) {
                    $n_mas = array();
                    foreach ($val as $its) {
                        $n_mas = array_merge($n_mas, $its);
                    }
                    $n_mas = array_unique($n_mas);
                    $items[$key] = $n_mas;
                }

                $items = array_merge($items, array());
                $c = count($items);
                $i = 0;
                while ($i < $c) {
                    if ($i == 0) {
                        $new_mas = $items[$i];
                    } else {
                        $new_mas = array_intersect($new_mas, $items[$i]);
                    }
                    $i++;
                }
            }
        }

        $minCost = (int)preg_replace('/\s/', '', $_POST['minCost']);
        $maxCost = (int)preg_replace('/\s/', '', $_POST['maxCost']);


        if (count($new_mas) > 0) {
            $new_mas = implode(',', $new_mas);
            $q = "SELECT T1.*, T3.id as sid, T3.name as name_cat, T4.name as brand_name FROM it_tovar T1 INNER JOIN it_link_sttv T2 ON T2.tid = T1.id INNER JOIN it_st_catalog T3 ON T3.id=T2.sid LEFT JOIN it_brand T4 ON T4.id = T1.brand WHERE T1.id IN ({$new_mas}) AND T1.enabled = 1 AND T1.price >= '" . $minCost . "' AND T1.price <= '" . $maxCost . "'" . $brand;
        } else {
            $q = "SELECT T1.*, T3.id as sid, T3.name as name_cat, T4.name as brand_name FROM it_tovar T1 INNER JOIN it_link_sttv T2 ON T2.tid = T1.id INNER JOIN it_st_catalog T3 ON T3.id=T2.sid LEFT JOIN it_brand T4 ON T4.id = T1.brand WHERE T3.id IN ({$ids}) AND T1.enabled = 1 AND T1.price >= '" . $minCost . "' AND T1.price <= '" . $maxCost . "'" . $brand;
        }

        $res = mysql_query($q);

        $tid = $child_p = array();
        if (mysql_num_rows($res) > 0) {
            while ($r = mysql_fetch_assoc($res)) {
                $child_p[$r['id']] = $r;
                $child_p[$r['id']]["sklad"] = array();
                $tid[] = $r['id'];
            }
        }

        $sklads = array();
        if (isset($_POST['sklad'])) {
            foreach ($_POST['sklad'] as $sk => $it) {
                $sklads[] = $sk;
            }
        }

        if (count($sklads) > 0 && count($tid) > 0) {
            $sklads = implode(',', $sklads);
            $tid = implode(',', $tid);
            $q = "SELECT T1.tid, T1.quant, T2.name FROM it_link_tvsk T1 LEFT JOIN it_sklad T2 ON T2.id = T1.skid WHERE T1.tid IN ({$tid}) AND T1.skid IN ({$sklads})";
            $rsk = mysql_query($q);
            while ($sklad = mysql_fetch_assoc($rsk)) {
                $child_p[$sklad['tid']]["sklad"][] = $sklad;
            }
            mysql_free_result($rsk);
            foreach ($child_p as $id => $it) {
                if (!isset($it["sklad"])) {
                    unset($child_p[$id]);
                }
            }
        } elseif (count($tid) > 0) {
            $tid = implode(',', $tid);
            $q = "SELECT T1.tid, T1.quant, T2.name FROM it_link_tvsk T1 LEFT JOIN it_sklad T2 ON T2.id = T1.skid WHERE T1.tid IN ({$tid})";
            $rsk = mysql_query($q);
            while ($sklad = mysql_fetch_assoc($rsk)) {
                $child_p[$sklad['tid']]["sklad"][] = $sklad;
            }
            mysql_free_result($rsk);
        }

        $child_p = array_merge($child_p, array());

        if (count($child_p)) {
            $params = $this->bild_navigation(count($child_p));

            $i = $params['start'];
            if ($params['nav_str'] == '') {
                $params['end'] = count($child_p);
            }

            $ele_line = '';
            while ($i < $params['end']) {
                /*$this->content .= "<pre>";
				$this->content .= print_r($child_p[$i],1);
				$this->content .= "</pre>";*/
                $sklad_line = '';
                $quant = 0;
                foreach ($child_p[$i]['sklad'] as $sklad) {
                    $sklad_line .= Template::parse_variable($this->template['sklad'], array(
                        'name' => $sklad['name'],
                        'quant' => $sklad['quant'],
                    ));
                    $quant = $quant + $sklad['quant'];
                }

                if ($child_p[$i]['action']) {
                    $shild = Template::parse_variable($this->template['shild'], array(
                        'class' => 'action'
                    ));
                } elseif ($child_p[$i]['new_item']) {
                    $shild = Template::parse_variable($this->template['shild'], array(
                        'class' => 'new'
                    ));
                } else {
                    $shild = '';
                }

                $img_line = '';
                if ($child_p[$i]['image'] != '') {
                    $file = $this->Img_name($child_p[$i]['image'], 'sm');
                    if (is_file($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->elepic_path . $file)) {
                        $img_line = Template::parse_variable($this->template['img_item'], array(
                            'src' => '/' . $this->elepic_path . $file,
                            'alias' => '/' . $alias[$child_p[$i]['sid']] . '/' . $child_p[$i]['alias'] . '/',
                            'name' => $child_p[$i]['name'],
                            'shild' => $shild
                        ));
                    } else {
                        $file = '/i/206_132.jpg';
                        $img_line = Template::parse_variable($this->template['img_item'], array(
                            'src' => $file,
                            'alias' => '/' . $alias[$child_p[$i]['sid']] . '/' . $child_p[$i]['alias'] . '/',
                            'name' => $child_p[$i]['name'],
                            'shild' => $shild
                        ));
                    }
                } else {
                    $file = '/i/206_132.jpg';
                    $img_line = Template::parse_variable($this->template['img_item'], array(
                        'src' => $file,
                        'alias' => '/' . $alias[$child_p[$i]['sid']] . '/' . $child_p[$i]['alias'] . '/',
                        'name' => $child_p[$i]['name'],
                        'shild' => $shild
                    ));
                }

                $ele_line .= Template::parse_variable($this->template['item'], array(
                    'name' => $child_p[$i]['name'],
                    'alias' => '/' . $alias[$child_p[$i]['sid']] . '/' . $child_p[$i]['alias'] . '/',
                    'price' => number_format($child_p[$i]['price'], 0, ',', ' '),
                    'name_cat' => $child_p[$i]['name_cat'],
                    'alias_cat' => '/' . $alias[$child_p[$i]['sid']] . '/',
                    'brand' => $child_p[$i]['brand_name'],
                    'article' => $child_p[$i]['article'],
                    'skald' => $sklad_line,
                    'id' => $child_p[$i]['id'],
                    'img' => $img_line,
                    'add_cart' => $quant > 0 ? Template::parse_variable($this->template['cart_bt'], array('id' => $child_p[$i]['id'])) : ''
                ));
                $i++;
            }
            $blockk .= Template::parse_variable($this->template['block_items_aj'], array(
                'list' => $ele_line,
                'nav' => $params['nav_str'],
            ));
        }

        return $blockk;
    }

    private function nPrice()
    {
        if (!isset($_POST['size'])) return '';
        $product_price = $_SESSION['this_price'];
        $q = "SELECT width, height FROM it_catalog_size WHERE id = '" . $_POST['size'] . "'";
        $res = mysql_query($q);
        if ($r = mysql_fetch_assoc($res)) {
            if (isset($_POST['nheight'])) {
                $r['height'] = preg_replace('/\,/', '.', $_POST['nheight']);
            }
            $price = ceil($product_price * $r['width'] * $r['height']);
            $price = $price == 0 ? ceil($product_price * $r['width']) : $price;
            return $price;
        } else {
            return '';
        }
    }

    private function changeItem()
    {
        if (!isset($_POST['id'])) return '';
        $id = $_POST['id'];
        $product_price = $_SESSION['this_price'];
        $q = "SELECT T1.image, T1.color, T2.name, T3.parent_id FROM it_catalog_elements T1 LEFT JOIN it_color T2 ON T2.item = T1.color LEFT JOIN it_st_catalog T3 ON T3.id = T1.pid WHERE T1.pid = '" . $id . "'";
        $res = mysql_query($q);
        $ret_block = array();
        if ($r = mysql_fetch_assoc($res)) {
            if (is_file($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->elepic_path . $r['image'])) {
                $size_img = getimagesize($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->elepic_path . $r['image']);
                $ret_block['image'] = Template::parse_variable($this->template['img_block'], array(
                    'image' => "/" . $this->elepic_path . $r['image'],
                    'size_img' => $size_img[3]
                ));
            } else {
                $ret_block['image'] = '';
            }
            $q = "SELECT T2.width, T2.height, T2.id FROM it_catalog_tovar_size T1 LEFT JOIN it_catalog_size T2 ON T2.id = T1.size_id WHERE T1.tovar_id = '" . $r['parent_id'] . "' ORDER BY T2.width, T2.height";
            $size_res = mysql_query($q);
            $sizes = array();
            while ($r_size = mysql_fetch_assoc($size_res)) {
                $sizes[] = $r_size;
            }

            $s = 0;
            $size_block = $size_sel = $size_line = $size_option = '';
            $size_null = false;
            foreach ($sizes as $key => $sze) {
                $s++;
                $size_line .= Template::parse_variable($this->template['size_line'], array(
                    'size' => $sze['height'] != 0 ? preg_replace('/\./', ',', $sze['width']) . 'x' . preg_replace('/\./', ',', $sze['height']) : preg_replace('/\./', ',', $sze['width']), //$sze['width'].'x'.$sze['height'],
                    'class' => ''
                ));

                $size_option .= Template::parse_variable($this->template['size_opt'], array(
                    'size' => $sze['height'] != 0 ? preg_replace('/\./', ',', $sze['width']) . 'x' . preg_replace('/\./', ',', $sze['height']) : preg_replace('/\./', ',', $sze['width']), //$sze['width'].'x'.$sze['height'],
                    'sq' => $sze['id']
                ));
                $size_null = ($sze['height'] == 0 || $size_null == true) ? true : false;
                if ($s % 7 == 0) {
                    $size_block .= Template::parse_variable($this->template['size_block'], array(
                        'line' => $size_line
                    ));
                    $size_line = '';
                }
                if ($key == 0) {
                    $price = ceil($product_price * $sze['width'] * $sze['height']);
                    $ret_block['price'] = $price == 0 ? ceil($product_price * $sze['width']) : $price;
                }
            }

            if ($size_line != '') {
                while ($s % 7 != 0) {
                    $s++;
                    $size_line .= Template::parse_variable($this->template['size_line'], array(
                        'size' => '&nbsp;',
                        'class' => ' class="no_bord"'
                    ));
                }
                $size_block .= Template::parse_variable($this->template['size_block'], array(
                    'line' => $size_line
                ));
            }

            if ($size_null) {
                $size_sel = Template::parse_variable($this->template['size_sel_input'], array(
                    'line' => $size_option
                ));

            } else {
                $size_sel = Template::parse_variable($this->template['size_sel'], array(
                    'line' => $size_option
                ));
            }

            $ret_block['size_block'] = $size_block;
            $ret_block['id'] = $id;
            $ret_block['size_option_color'] = Template::parse_variable($this->template['cl_size_aj'], array(
                'size' => $size_sel,
                'color' => $r['name'],
                'i_color' => $r['color']
            ));
            return json_encode($ret_block);
        } else {
            return '';
        }
    }

    private function Order()
    {
        if (!isset($_POST['item'])) return '';

        require_once('./include/tuning.php');
        $t = new TProtectCode(isset($_SESSION["oerr"]['captcha']) ? $_SESSION["oerr"]['captcha'] : '');

        $block = Template::parse_variable($this->template['order'], array(
            'item' => $_POST['item'],
            'size' => $_POST['size'],
            'height' => isset($_POST['nheight']) ? $_POST['nheight'] : '',
            'captcha' => $t->MakeCaptha('', 'order.php'),
        ));
        return $block;
    }

    private function sendOrder()
    {
        $nameForm = strip_tags($_POST['nameForm']);
        $phoneForm = strip_tags($_POST['phoneForm']);
        $emailForm = strip_tags($_POST['emailForm']);
        $item = strip_tags($_POST['item']);
        $size = strip_tags($_POST['size']);
        $dheight = strip_tags($_POST['vheight']);

        $product_price = $_SESSION['this_price'];

        require_once('./include/tuning.php');
        $t = new TProtectCode();
        $err = array();
        if ($_POST['kod'] == '') {
            $err['captcha'] = 'Введите защитный код.';
        }

        if (isset($_POST['kod']) && $_POST['kod'] != '') {
            if (!$t->CheckCode($_POST['kod'])) {
                $err['captcha'] = 'Неправильно введен защитный код!';
            }
        }

        if ($nameForm == 'undefined' || $nameForm == '') {
            $err['name'] = 'Введите имя';
        }
        if ($phoneForm == 'undefined' || $phoneForm == '') {
            $err['phone'] = 'Введите телефон';
        }

        if (count($err) > 0) {
            $t2 = new TProtectCode(isset($err['captcha']) ? $err['captcha'] : '');
            return Template::parse_variable($this->template['order_err'], array(
                'item' => $item,
                'size' => $size,
                'height' => $dheight,
                'name' => $nameForm,
                'err_name' => isset($err['name']) ? '<tr id="trkod"><td></td><td></td><td class="title-error">' . $err['name'] . '</td></tr>' : '',
                'phone' => $phoneForm,
                'err_phone' => isset($err['phone']) ? '<tr id="trkod"><td></td><td></td><td class="title-error">' . $err['phone'] . '</td></tr>' : '',
                'email' => $emailForm,
                'captcha' => $t2->MakeCaptha('', 'order.php'),
            ));

        } else {
            $contactemails = array();
            $arr_emails = explode(",", GetSetting('email_cat'));
            foreach ($arr_emails AS $email) {
                $contactemails[] = trim($email);
            }

            $q = "SELECT width, height FROM it_catalog_size WHERE id = '" . $size . "'";
            $res = mysql_query($q);
            $size = mysql_fetch_assoc($res);
            $size['height'] = $dheight != '' ? $dheight : $size['height'];
            $price = ceil($product_price * $size['width'] * $size['height']);
            $price = $price == 0 ? ceil($product_price * $size['width']) . " р./кв.м." : $price . " р.";

            $q = "SELECT T1.color, T2.name FROM it_catalog_elements T1 LEFT JOIN it_color T2 ON T2.item = T1.color WHERE T1.pid = '" . $item . "'";
            $res = mysql_query($q);
            $param = mysql_fetch_assoc($res);

            $q = "SELECT T2.name, T3.item, T2.parent_id FROM it_st_catalog T1 LEFT JOIN it_st_catalog T2 ON T2.id = T1.parent_id LEFT JOIN it_catalog_sections T3 ON T3.pid = T2.id WHERE T1.id = '" . $item . "'";
            $res = mysql_query($q);
            $seria = mysql_fetch_assoc($res);

            $msg = "От пользователя: " . $nameForm . "\nТелефон:  " . $phoneForm . "\nEmail: " . $emailForm . "\n\nПоступил заказ на ковер размером " . preg_replace('/\./', ',', $size['width']) . "x" . preg_replace('/\./', ',', $size['height']) . " м. из серии " . $im . " " . $seria["name"] . " #" . $seria["item"] . ", колорит " . $param['name'] . " #" . $param['color'] . ", общая стоимость ковра составляет " . $price . "";
            $msg = chunk_split(base64_encode($msg)) . "\r\n";

            if (preg_match("/^[a-z0-9_\.]+@[a-z0-9-\.]+$/is", $emailForm)) {
                $user_email = $emailForm;
            } else {
                $user_email = 'noname@noname.com';
            }

            $subject = "С сайта " . $_SERVER["SERVER_NAME"] . " поступил заказ";
            $subject = "=?utf-8?B?" . base64_encode($subject) . "?=";
            $headers = "MIME-Version: 1.0\n";
            $headers .= "Content-type: text/plain; charset=utf-8\nContent-Transfer-Encoding: base64\n";
            $headers .= "From: =?utf-8?B?" . base64_encode($_SERVER["SERVER_NAME"]) . "?= <" . $user_email . ">\n";
            $headers .= "Reply-To: =?utf-8?B?" . base64_encode($nameForm) . "?= <" . $user_email . ">\n";
            $headers .= "X-MSMail-Priority: Normal\r\n\r\n";


            if (preg_match("/^[a-z0-9_\.]+@[a-z0-9-\.]+$/is", $emailForm) && $emailForm != '') {
                $msg2 = "Вы сделали заказ на сайте " . $_SERVER["SERVER_NAME"] . "\n\n";
                $msg2 .= "Ваш заказ: \n\nСерия: " . $im . " " . $seria["name"] . " #" . $seria["item"] . "\nКолорит: " . $param['name'] . " #" . $param['color'] . "\nРазмер: " . preg_replace('/\./', ',', $size['width']) . "x" . preg_replace('/\./', ',', $size['height']) . " м.\nСтоимость: " . $price . "";
                $msg2 = chunk_split(base64_encode($msg2)) . "\r\n";
                mail($emailForm, $subject, $msg2, $headers);
            }

            foreach ($contactemails AS $email) {
                mail($email, $subject, $msg, $headers);
            }

            return Template::parse_variable($this->template['send_order'], array());
        }
    }

    private function filterSection()
    {
        if (!isset($_POST['pid'])) return '';
        if (($_POST['size']) != '') {
            $q = "SELECT tovar_id FROM it_catalog_tovar_size WHERE size_id = " . $_POST['size'] . " ORDER BY tovar_id";
            $tovars = mysql_query($q);
            $id = array();
            while ($r = mysql_fetch_assoc($tovars)) {
                $id[] = $r['tovar_id'];
            }
            $par = implode(',', $id);
            $q = "
					SELECT T1.id, T1.parent_id, T1.name, T1.alias, T2.image, T2.image, T2.anons, T2.item, T2.new, T2.price, T2.vprice FROM it_st_catalog T1
					LEFT JOIN it_catalog_sections T2 ON T2.pid = T1.id
					WHERE T1.name != '' AND T1.enabled = 1 AND T1.type_page=1 AND T1.lang_id = " . $this->lang['current'] . " AND T1.id IN ({$par}) AND parent_id = " . $_POST['pid'] . " ORDER BY T2.item ASC, T1.parent_id ASC, T1.sort ASC, T1.id ASC";
        } else {
            $q = "
					SELECT T1.id, T1.parent_id, T1.name, T1.alias, T2.image, T2.image, T2.anons, T2.item, T2.new, T2.price, T2.vprice FROM it_st_catalog T1
					LEFT JOIN it_catalog_sections T2 ON T2.pid = T1.id
					WHERE T1.name != '' AND T1.enabled = 1 AND T1.type_page=1 AND T1.lang_id = " . $this->lang['current'] . " AND parent_id = " . $_POST['pid'] . " ORDER BY T2.item ASC, T1.parent_id ASC, T1.sort ASC, T1.id ASC";
        }
        $sections = mysql_query($q);
        $s_block = $sec_line = '';
        while ($sec = mysql_fetch_assoc($sections)) {
            $q = "SELECT T2.image, T1.id FROM it_st_catalog T1 LEFT JOIN it_catalog_elements T2 ON T2.pid = T1.id WHERE T1.parent_id = '" . $sec['id'] . "' AND T1.enabled = 1 ORDER BY T1.sort LIMIT 1";
            $res = mysql_query($q);
            $r = mysql_fetch_assoc($res);
            $q = "SELECT T2.width, T2.height FROM it_catalog_tovar_size T1 LEFT JOIN it_catalog_size T2 ON T2.id = T1.size_id WHERE T1.tovar_id = '" . $sec['id'] . "' ORDER BY T2.width, T2.height LIMIT 1";
            $size = mysql_fetch_assoc(mysql_query($q));
            $sq = $size['width'] * $size['height'];
            $file = $this->Img_name($r["image"], 'sm');
            if ($sec['price']) {
                $class = 'special';
                $class2 = ' class="border-bottom-box"';
                $sp_block = Template::parse_variable($this->template['sp_block'], array(
                    'name' => 'Cуперпредложение'
                ));
                $this_price = ceil($sec['price'] * $sq);
                $this_price = $this_price == 0 ? ceil($sec['price'] * $size['width']) : $this_price;
                $this_price = Template::parse_variable($this->template['price'], array(
                    'price' => $this_price,
                    'class' => 'new-price'
                ));
                $old_price = $sec['vprice'] != 0 ? ceil($sec['vprice'] * $sq) : ceil($price * $sq);
                $old_price = $old_price == 0 ? ($sec['vprice'] != 0 ? ceil($sec['vprice'] * $size['width']) : ceil($price * $size['width'])) : $old_price;
                $old_price = Template::parse_variable($this->template['price'], array(
                    'price' => $old_price,
                    'class' => 'old-price'
                ));
            } elseif ($sec['new']) {
                $class = 'new';
                $class2 = ' class="border-bottom-box"';
                $sp_block = Template::parse_variable($this->template['sp_block'], array(
                    'name' => 'Новинка'
                ));
                $old_price = '';
                $this_price = $sec['vprice'] != 0 ? ceil($sec['vprice'] * $sq) : ceil($price * $sq);
                $this_price = $this_price == 0 ? ($sec['vprice'] != 0 ? ceil($sec['vprice'] * $size['width']) : ceil($price * $size['width'])) : $this_price;
                $this_price = Template::parse_variable($this->template['price'], array(
                    'price' => $this_price,
                    'class' => 'price'
                ));
            } else {
                $class = 'old';
                $class2 = '';
                $sp_block = '';
                $old_price = '';
                $this_price = $sec['vprice'] != 0 ? ceil($sec['vprice'] * $sq) : ceil($price * $sq);
                $this_price = $this_price == 0 ? ($sec['vprice'] != 0 ? ceil($sec['vprice'] * $size['width']) : ceil($price * $size['width'])) : $this_price;
                $this_price = Template::parse_variable($this->template['price'], array(
                    'price' => $this_price,
                    'class' => 'price'
                ));
            }


            if (is_file($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->elepic_path . $file)) {
                $size_f = getimagesize($_SERVER['DOCUMENT_ROOT'] . "/assets/" . $this->elepic_path . $file);
                $file = "/" . $this->elepic_path . $file;
                if ($class != 'old') {
                    $sec_line .= Template::parse_variable($this->template['sec_line_new'], array(
                        'anons' => $sec['anons'],
                        'name' => trim($sec['name']),
                        'link' => '/' . $sec['alias'] . '/',
                        'price' => $this_price,
                        'old_price' => $old_price,
                        'item' => $sec['item'],
                        'image' => $file,
                        'size' => $size_f[3],
                        'class' => $class,
                        'class2' => $class2,
                        'sp_block' => $sp_block
                    ));
                } else {
                    $sec_line .= Template::parse_variable($this->template['sec_line'], array(
                        'anons' => $sec['anons'],
                        'name' => trim($sec['name']),
                        'link' => '/' . $sec['alias'] . '/',
                        'price' => $this_price,
                        'item' => $sec['item'],
                        'image' => $file,
                        'size' => $size_f[3],
                        'class' => $class,
                        'class2' => $class2,
                        'sp_block' => $sp_block
                    ));
                }
            } else {
                if ($class != 'old') {
                    $sec_line .= Template::parse_variable($this->template['sec_line_new_nim'], array(
                        'anons' => $sec['anons'],
                        'name' => trim($sec['name']),
                        'link' => '/' . $sec['alias'] . '/',
                        'price' => $this_price,
                        'old_price' => $old_price,
                        'item' => $sec['item'],
                        'class' => $class,
                        'class2' => $class2,
                        'sp_block' => $sp_block
                    ));
                } else {
                    $sec_line .= Template::parse_variable($this->template['sec_line_nim'], array(
                        'anons' => $sec['anons'],
                        'name' => trim($sec['name']),
                        'link' => '/' . $sec['alias'] . '/',
                        'price' => $this_price,
                        'item' => $sec['item'],
                        'class' => $class,
                        'class2' => $class2,
                        'sp_block' => $sp_block
                    ));
                }
            }
        }

        if ($sec_line != '') {
            $s_block = Template::parse_variable($this->template['sec_block_ajax'], array(
                'line' => $sec_line
            ));
        }

        return $s_block;

    }

    private function showForm()
    {
        $this->title = $this->zagolovok = "Заявка на автомобиль";
        $status = isset($_SESSION['zayvka_status']) ? $_SESSION['zayvka_status'] : '';
        if ($status == 'ok') {
            $this->content .= Template::parse_variable($this->template['form_sended'], array());
        } else {
            $q = "SELECT id, name FROM it_st_catalog WHERE type_page = 2 AND enabled=1";
            $res = mysql_query($q);
            $sel = isset($_GET['item']) ? $_GET['item'] : '';
            $sel = isset($_SESSION['zaa']['avto']) ? $_SESSION['zaa']['avto'] : $sel;
            $line = '';
            while ($r = mysql_fetch_assoc($res)) {
                $line .= Template::parse_variable($this->template['opt'], array(
                    'id' => $r['id'],
                    'name' => $r['name'],
                    'selected' => $sel == $r['id'] ? ' selected' : '',
                ));
            }

            if ($line != '') {
                $line = Template::parse_variable($this->template['sel'], array(
                    'list' => $line
                ));
            }
            if ($status == 'err') {
                $this->content .= Template::parse_variable($this->template['mess_err'], array());
            }

            $this->content .= Template::parse_variable($this->template['form'], array(
                'name' => isset($_SESSION['zaa']['name']) ? $_SESSION['zaa']['name'] : '',
                'err_name' => isset($_SESSION['zerr']['name']) ? Template::parse_variable($this->template['err'], array('val' => $_SESSION['zerr']['name'])) : '',
                'phone' => isset($_SESSION['zaa']['phone']) ? $_SESSION['zaa']['phone'] : '',
                'err_phone' => isset($_SESSION['zerr']['phone']) ? Template::parse_variable($this->template['err'], array('val' => $_SESSION['zerr']['phone'])) : '',
                'email' => isset($_SESSION['zaa']['email']) ? $_SESSION['zaa']['email'] : '',
                'err_email' => isset($_SESSION['zerr']['email']) ? Template::parse_variable($this->template['err'], array('val' => $_SESSION['zerr']['email'])) : '',
                'company' => isset($_SESSION['zaa']['company']) ? $_SESSION['zaa']['company'] : '',
                'model' => $line,
                'requirements' => isset($_SESSION['zaa']['requirements']) ? $_SESSION['zaa']['requirements'] : '',
                'err_requirements' => isset($_SESSION['zerr']['requirements']) ? Template::parse_variable($this->template['err'], array('val' => $_SESSION['zerr']['requirements'])) : '',
                'captcha' => ''
            ));


            if (isset($_SESSION["zerr"])) {
                unset($_SESSION["zerr"]);
            }
            if (isset($_SESSION['zaa'])) {
                unset($_SESSION['zaa']);
            }
        }
        if (isset($_SESSION['zayvka_status'])) {
            unset($_SESSION['zayvka_status']);
        }
    }

    private function sendForm()
    {
        $name = $_SESSION['zaa']['name'] = strip_tags(trim($_POST['name']));
        $phone = $_SESSION['zaa']['phone'] = strip_tags(trim($_POST['phone']));
        $email = $_SESSION['zaa']['email'] = strip_tags(trim($_POST['email']));
        $company = $_SESSION['zaa']['company'] = strip_tags(trim($_POST['company']));
        $avto = $_SESSION['zaa']['avto'] = strip_tags(trim($_POST['avto']));
        $requirements = $_SESSION['zaa']['requirements'] = strip_tags(trim($_POST['requirements']));


        if ($name == '') $_SESSION["zerr"]["name"] = 'Введите имя.';
        if ($email == '') $_SESSION["zerr"]["email"] = 'Введите адрес эл. почты.';
        if ($avto != '') {
            $q = "SELECT name FROM it_st_catalog WHERE id = " . $avto;
            $res = mysql_query($q);
            if ($r = mysql_fetch_assoc($res)) {
                $avto = $r['name'];
            } else {
                $avto = '';
            }
            mysql_free_result($res);
        }
        if ($email != '' && !preg_match("/^[a-z0-9_\.-]+@[a-z0-9-\.]+$/is", $email)) $_SESSION["zerr"]["email"] = 'Неверный адрес эл. почты.';
        if ($phone == '') $_SESSION["zerr"]['phone'] = 'Введите телефон.';
        if ($requirements == '' || strlen(requirements) < 10) $_SESSION["zerr"]['phone'] = 'Введите нормальные требования.';

        if (!isset($_SESSION["zerr"])) {
            $zakaz_info = "<p><b>Имя:</b>: " . $name . "</p>\n";
            $zakaz_info .= "<p><b>Телефон:</b>: " . $phone . "</p>\n";
            $zakaz_info .= "<p><b>Email:</b>: " . $email . "</p>\n";
            $zakaz_info .= $company != '' ? "<p><b>Компания:</b>: " . $company . "</p>\n" : '';
            $zakaz_info .= $avto != '' ? "<p><b>Модель автомобиля:</b>: " . $avto . "</p>\n" : '';
            $zakaz_info .= "<p><b>Требования к автомобилю:</b>: " . $requirements . "</p>\n";

            $bound = "--" . md5(uniqid(rand(), true) . time());
            $msg .= "--" . $bound . "\r\n";
            $msg .= "Content-type: text/html; charset=utf-8\r\n";
            $msg .= "Content-Transfer-Encoding: base64\r\n\r\n";
            $msg = chunk_split(base64_encode($zakaz_info)) . "\r\n";
            $subject = "Новый заявка на сайте компании";
            $subject = "=?utf-8?B?" . base64_encode($subject) . "?=";
            $headers = "MIME-Version: 1.0\n";
            $headers .= "From: Order " . $_SERVER["SERVER_NAME"] . " <order@" . $_SERVER["SERVER_NAME"] . ">\n";
            $headers .= "Reply-To: " . $email . "\n";
            $headers .= "X-Priority: 3\n";
            $headers .= "X-MSMail-Priority: Normal\n";
            $headers .= "Content-type: text/html; charset=utf-8\nContent-Transfer-Encoding: base64\n";
            $q = "SELECT value FROM it_gl_settings WHERE id = 9";
            $res = mysql_query($q);
            if ($set = mysql_fetch_array($res)) {
                $email_cur = $set["value"];
            }
            if (mail($email_cur, $subject, $msg, $headers)) {
                unset($_SESSION['zaa']);
                $_SESSION['zayvka_status'] = 'ok';
            } else {
                $_SESSION['zayvka_status'] = 'err';
            }
        }
        header('Location:' . $_SERVER['REDIRECT_URL']);
        exit;
    }
}
