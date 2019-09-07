<?php
namespace v2;

use v2\PrintForm\IPrintForm;
use v2\PrintForm\Template\Excel;
use v2\PrintForm\Template\ITemplate;

use Illuminate\Database\Eloquent\Model;

/**
 * Пример использования: опишем форму счёта, которая основавывается на некоем xlsx шаблоне
 * (шаблон заранее известен и хранится в репозитории проекта - invoice_template.xlsx)
 */
class InvoicePrintForm implements IPrintForm
{
    public function createTemplate(): ITemplate
    {
        // Разработчик задаёт шаблон для данной печатной формы
        return new Excel('path/to/invoice_template.xlsx');
    }

    public function getFilename(Model $model): string
    {
        // Разработчик при описании формы задаёт желаемое имя файла для данной модели
        return 'Счёт на оплату ' . $model->no . '.xlsx';
    }

    public function mapData(Model $model): array
    {
        // Печатная форма на вход принимает некую модель и подготавливает данные для вывода на печать
        // Разработчик должен сформировать переменные, которые затем будут переданы в шаблон
        // (в данном случае шаблон invoice_template.xlsx)
        return [
            'InvoiceNo' => $model->no,
            'InvoiceDate' => $model->date->format('d.m.Y'),
            'Amount' => number_format($model->amount, 2, ',', ' ')
        ];
    }
}
