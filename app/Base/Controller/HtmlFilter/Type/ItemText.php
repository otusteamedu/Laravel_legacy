<?php

namespace App\Base\Controller\HtmlFilter\Type;

use App\Base\Controller\HtmlFilter\Item;

class ItemText extends Item
{
    /**
     * @return array
     */
    protected function defaultOpts(): array {
        return [
            'choose_match' => false
        ];
    }
    /**
     * @return mixed
     */
    protected function defaultValue() {
        $opts = $this->options;

        if($opts['choose_match']) {
            return [
                'text' => '',
                'exact' => false
            ];
        }

        return '';
    }
    /**
     * Возвращает массив для передачи в фильтр
     * @return array|null
     */
    public function getResult(): ?array {
        $opts = $this->options;
        $key = $this->name;
        $value = $this->value;
        if($opts['choose_match']) {
            if(empty($value['text']))
                return null;

            return [
                $key => $value['text'],
                $key . '_exact' => $value['exact']
            ];
        }

        if(empty($value))
            return null;
        return [
            $key => $value,
            $key . '_exact' => false
        ];
    }
    /**
     * инициализация значения Item
     */
    public function initValue($value) {
        $opts = $this->options;
        if($opts['choose_match']) {
            if(!is_array($value)) {
                $value = array(
                    'text' => (string) $value,
                    'exact' => false
                );
            }

            $this->value = array_merge(
                $this->defaultValue(),
                $value
            );

            return;
        }

        $this->value = (string) $value;
    }
}

