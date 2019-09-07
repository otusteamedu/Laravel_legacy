<?php


namespace v2\PrintForm\Template;


interface ITemplate
{
    public function fillWithData(array $data): void;

    public function getContent(): string;
}
