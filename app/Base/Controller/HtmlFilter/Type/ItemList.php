<?php


namespace App\Base\Controller\HtmlFilter\Type;


class ItemList
{
    /**
     * @return array
     */
    protected function defaultOpts(): array {
        return [
            'data' => [], // \Closure|array|Model
            'multi' => false,
            'model_filter' => null,
            'model_value' => 'id',
            'model_text' => 'name'
        ];
    }
}
