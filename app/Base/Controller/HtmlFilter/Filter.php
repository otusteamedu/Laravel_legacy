<?php


namespace App\Base\Controller\HtmlFilter;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class Filter
{
    /**
     * префикс для переменных из фильтра
     */
    const VAR_PREFIX = "filter_";
    const ITEM_PREFIX = "Item";
    /**
     * @var bool
     */
    private $bInitialized;
    /**
     * @var array
     */
    private $arItems;
    /**
     * @var Request
     */
    private $request;
    /**
     * Filter constructor.
     * @param Request $request
     * @param array $arItems
     */
    public function __construct(Request $request, $arItems = []) {
        $this->arItems = $arItems;
        $this->request = $request;
        $this->bInitialized = false;
    }
    /**
     * @param string $type
     * @param string $name
     * @param array $opts
     * @return Item
     */
    public function add(string $type, string $name, array $opts = []): Item {
        $item = $this->makeItem($type, $name, $opts);
        $this->addItem($item);
        return $item;
    }
    /**
     * @param Item $item
     * @return Filter
     */
    public function addItem(Item $item): Filter {
        $key = $item->getName();
        $this->arItems[$key] = $item;

        return $this;
    }
    /**
     * 1. инициализируем параметры фильтрации из сессии
     * 2. счтитаем из запроса все переменные c префиксом VAR_PREFIX
     * 3.
     */
    public function init(): Filter {
        $req = $this->request;
        /** @var $item Item */
        foreach($this->arItems as $item) {
            $reqName = self::VAR_PREFIX . $item->getName();
            // + посмотреть в сессии
            if($req->has($reqName)) {
                $value = $req->input($reqName);
                $item->initValue($value);
                // +сохранить в сессии
            }
        }

        $this->bInitialized = true;
        return $this;
    }
    /**
     * получить результат фильтрации. Если Item возвращает null, то результат Item не добавляем в общий
     */
    public function getData(): array {
        $result = [];
        if(!$this->bInitialized)
            return $result;
        foreach($this->arItems as $item) {
            if(!$item->getValue())
                continue;
			if(!is_array($item->getResult()))	
				continue;
            $result = array_merge($result, $item->getResult());
        }

        return $result;
    }

    /**
     * @param string $type
     * @param string $name
     * @param array $opts
     * @return Item
     */
    private function makeItem(string $type, string $name, array $opts = []): Item {
        $fqcName = get_class($this);
        $pos = strrpos($fqcName, "\\");
        $className = strtoupper(substr($type, 0, 1)).strtolower(substr($type, 1));
        $fqcName = substr($fqcName, 0, $pos + 1) . "Type\\" . self::ITEM_PREFIX . $className;

        return new $fqcName($this, $name, $opts);
    }
    /**
     * получить тип Item
     */
    public static function getType(Item $item): string {
        $fqcName = get_class($item);
        $pos = strrpos($fqcName, "\\");
        $type = substr($fqcName, $pos + 1 + strlen(self::ITEM_PREFIX));

        return strtolower($type);
    }
    /**
     * шаблоны по-умолчанию находятся в admin/elements/filter/widget.blade.php
     * переопределенные шаблоны сначала ищутся в admin/elements/filter/custom/widget.blade.php,
     * если $template == null, иначе в admin/elements/filter/custom/<template>.blade.php
     *
     * @param string|null $template
     * @return string
     */
    protected function resolveTemplate(string $template = null): string {
        if (!empty($template)) {
            $template = 'admin.elements.filter.custom.' . $template;
        }
        else {
            $template = 'admin.elements.filter.custom.widget';
        }

        if(View::exists($template))
            return $template;

        return 'admin.elements.filter.widget';
    }
    /**
     * @param string|null $template
     * @return string
     */
    public function render(string $template = null, array $itemsTpl = []): string {
        $items = [];
        if(!$this->bInitialized)
            return '';
        /** @var $item Item */
        foreach($this->arItems as $key => $item) {
            $tpl = array_key_exists($key, $itemsTpl) ? is_string($itemsTpl[$key])
                ? $itemsTpl[$key] : null : null;
            $items[$key] = [
                'name' => $item->getName(),
                'title' => $item->getTitle(),
                'html' => $item->render($tpl)
            ];
        }

        return view(
            $this->resolveTemplate($template),
            [
                'action' => $this->request->url(),
                'prefix' => self::VAR_PREFIX,
                'items' => $items
            ]
        )->toHtml();
    }
}
