<?php


namespace v2\PrintForm;


use v2\PrintForm\Template\ITemplate;
use Illuminate\Database\Eloquent\Model;

interface IPrintForm
{
    public function createTemplate(): ITemplate;

    public function mapData(Model $model): array;

    public function getFilename(Model $model): string;
}
