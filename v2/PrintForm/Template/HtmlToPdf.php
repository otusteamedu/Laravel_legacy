<?php


namespace v2\PrintForm\Template;

/**
 * Особый вариант шаблона, который загружает шаблон из html, но сохраняет его в PDF
 * За базу возьмём класс Html шаблона и переопределим только метод save
 */
class HtmlToPdf extends Html
{
    public function getContent(): string
    {
        return $this->convertHtmlToPdf($this->internalHtml);
    }

    private function convertHtmlToPdf(string $html): string
    {
        // TODO: скорвертировать html в pdf
        return '';
    }

}
