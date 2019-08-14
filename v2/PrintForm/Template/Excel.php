<?php


namespace v2\PrintForm\Template;


use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Excel implements ITemplate
{
    // Spreadsheet
    private $spreadsheet;

    public function __construct(string $file)
    {
        // Для внутреннего представления Excel файла используем библиотеку PhpSpreadsheet
        $this->spreadsheet = IOFactory::load($file);
    }

    public function fillWithData(array $data): void
    {
        // Наполняем шаблон данными - делаем тупую замену строк
        // (на деле тут надо бы использовать какой-нибудь синтаксис плейсхолдеров или нормальный шаблонизатор)
        // TODO: заполнить $this->spreadsheet данными
        $this->spreadsheet->getActiveSheet()->setCellValue(/*...*/);
    }

    public function getContent(): string
    {
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($this->spreadsheet, "Xlsx");
        ob_start();
        $writer->save('php://output');
        return ob_get_clean();
    }
}
