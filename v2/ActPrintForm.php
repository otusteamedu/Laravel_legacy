<?php

namespace v2;

use v2\PrintForm\IPrintForm;
use v2\PrintForm\Template\HtmlToPdf;
use v2\PrintForm\Template\ITemplate;

use Illuminate\Database\Eloquent\Model;

/**
 * Пример использования: опишем форму акта, которая основавывается на некоем html шаблоне
 * (шаблон заранее известен и хранится в репозитории проекта - html_template.html)
 */
class ActPrintForm implements IPrintForm
{
    public function createTemplate(): ITemplate
    {
        return new HtmlToPdf('path/to/html_template.html');
    }

    public function getFilename(Model $model): string
    {
        // Разработчик при описании формы задаёт желаемое имя файла для данной модели
        return 'Акт выполненных работ ' . $model->no . ' от ' . $model->date->format('d.m.Y') . '.pdf';
    }

    public function mapData(Model $model): array
    {
        // Печатная форма на вход принимает некую модель и подготавливает данные для вывода на печать
        // Разработчик должен сформировать переменные, которые затем будут переданы в шаблон
        // (в данном случае шаблон html_template.html)
        return [
            'ActNo' => $model->no,
            'ActDate' => $model->date->format('d.m.Y'),
            'Amount' => number_format($model->amount, 2, ',', ' '),
        ];
    }
}
