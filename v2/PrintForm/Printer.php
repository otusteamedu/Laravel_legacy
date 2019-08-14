<?php


namespace v2\PrintForm;

use Illuminate\Database\Eloquent\Model;
use Psr\Http\Message\ResponseInterface;
use v2\PrintForm\Template\Excel;
use v2\PrintForm\Template\Html;
use v2\PrintForm\Template\HtmlToPdf;
use v2\PrintForm\Template\ITemplate;

class Printer
{
    public function printToFile(IPrintForm $printForm, Model $model, string $targetDir)
    {
        $dataForTemplate = $printForm->mapData($model);
        $outFilename = $printForm->getFilename($model);

        $template = $printForm->createTemplate();
        $template->fillWithData($dataForTemplate);
        $content = $template->getContent();
        file_put_contents("$targetDir/$outFilename", $content);
    }

    public function writeToResponse(IPrintForm $printForm, Model $model, ResponseInterface $response)
    {
        $dataForTemplate = $printForm->mapData($model);
        $outFilename = $printForm->getFilename($model);

        $template = $printForm->createTemplate();
        $template->fillWithData($dataForTemplate);
        $content = $template->getContent();
        $contentType = $this->getContentType($template);

        $response = $response
            ->withHeader('Content-type', $contentType)
            ->withHeader('Content-length', strlen($content))
            ->withHeader('Content-Disposition', 'attachment;filename*=UTF-8\'\'' . rawurlencode($outFilename));

        $body = $response->getBody();
        $body->write($content);
    }

    private function getContentType(ITemplate $template): string
    {
        if ($template instanceof Html) {
            return 'text/html';
        }

        if ($template instanceof HtmlToPdf) {
            return 'application/pdf';
        }

        if ($template instanceof Excel) {
            return 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
        }
    }
}
