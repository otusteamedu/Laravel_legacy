<?php


namespace App\Base\Controller;

use App\Base\Controller\HtmlFilter\Filter;

/**
 * Страница списка элементов в админ-панели. Состоит из
 * 1. Фильтр. Массив, должен уметь переходить в фильтр репозитория
 * 2. Список (таблица) результатов
 * 3. Пагинация
 * 4. Групповые операции
 * 5. Ссылки-команды
 * 6. Сортировка
 *
 * Class AdminListController
 * @package App\Base
 */

abstract class AbstractListController extends AbstractController
{
    /** @var Filter filter */
    protected $filter;
    protected $nav;
    protected $sort;
    protected $by;

    protected $data;

    protected $request;

    public function __construct() {
        $this->request = request();
    }

    public function prepareAction($method, $parameters): void {
        // принимаем фильтр
        // п
        $this->nav = [
            'per_page' => (int) $this->request->get('per_page', 20)
        ];
        $this->limit = (int) $this->request->get('list_limit', 20);
        $this->data = [];

        parent::prepareAction($method, $parameters);
    }
}
