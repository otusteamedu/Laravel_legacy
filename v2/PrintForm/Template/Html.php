<?php


namespace v2\PrintForm\Template;


class Html implements ITemplate
{
    protected $internalHtml;

    public function __construct(string $file)
    {
        // HTML шаблон читаем просто как строку
        $this->internalHtml = file_get_contents($file);
    }

    public function fillWithData(array $data): void
    {
        // Наполняем шаблон данными - делаем тупую замену строк
        // (на деле тут надо бы использовать какой-нибудь синтаксис плейсхолдеров или нормальный шаблонизатор)
        $this->internalHtml = str_replace(array_keys($data), array_values($data), $this->internalHtml);
    }

    public function getContent(): string
    {
        return $this->internalHtml;
    }
}
