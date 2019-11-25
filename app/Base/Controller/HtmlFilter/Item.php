<?php


namespace App\Base\Controller\HtmlFilter;

use Illuminate\Support\Facades\View;

abstract class Item
{
    /**
     * ссылка на объект фильтра
     * @var Filter
     */
    protected $filter;
    /**
     * имя для запроса
     * @var string
     */
    protected $name;
    /**
     * имя для печати
     * @var string
     */
    protected $title;
    /**
     * @var mixed
     */
    protected $value;
    /**
     * @var mixed
     */
    protected $options;
    /**
     * Item constructor.
     * @param Filter $filter
     */
    public function __construct(Filter $filter, string $name, array $opts = [])
    {
        $this->filter = $filter;
        $this->name = $name;
        $this->options = array_merge($this->defaultOpts(), $opts);
        $this->default = '';
        $this->title = '';
        $this->value = '';
    }
    /**
     * @return array
     */
    protected function defaultOpts(): array {
        return [];
    }
    /**
     * значение по умолчанию. Ничего не установлено
     * @return mixed
     */
    protected function defaultValue() {
        return '';
    }
    /**
     * @param string|null $template
     * @return string
     */
    public function render(string $template = null): string {
        return view(
            $this->resolveTemplate($template),
            [
                'prefix' => Filter::VAR_PREFIX,
                'name' => $this->getName(),
                'title' => $this->getTitle(),
                'value' => $this->getValue(),
                'opts' => $this->options
            ]
        )->toHtml();
    }
    /**
     * Возвращает массив для передачи в фильтр
     * @return array
     */
    public function getResult(): ?array {
        return [$this->name => $this->value];
    }
    /**
     * инициализация значения Item
     */
    public function initValue($value) {
        $this->value = $value;
    }
    /**
     * шаблоны по-умолчанию находятся в admin/elements/filter/item/<type>.blade.php
     * переопределенные шаблоны сначала ищутся в admin/elements/filter/item/custom/<type>.blade.php,
     * если $template == null, иначе в admin/elements/filter/item/custom/<template>.blade.php
     *
     * @param string|null $template
     * @return string
     */
    protected function resolveTemplate(string $template = null): string {
        $type = $this->getType();
        if (!empty($template)) {
            $template = 'admin.elements.filter.item.custom.' . $template;
        }
        else {
            $template = 'admin.elements.filter.item.custom.' . $type;
        }

        if(View::exists($template))
            return $template;

        return 'admin.elements.filter.item.' . $type;
    }
    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }
    /**
     * @return mixed
     */
    public function getValue() {
        return $this->value;
    }
    /**
     * @return string
     */
    public function getTitle(): string {
        return $this->title;
    }
    /**
     * доступ к родительскому фильтру
     */
    public function filter(): Filter {
        return $this->filter;
    }
    /**
     * получить тип себя. Утилита в фильтре
     */
    protected function getType(): string {
        return Filter::getType($this);
    }
    /**
     * @param $value
     * @return Item
     */
    public function default($value): Item {
        $this->value = $value;
        return $this;
    }
    /**
     * @param $value
     * @return Item
     */
    public function title($value): Item {
        $this->title = $value;
        return $this;
    }
}
