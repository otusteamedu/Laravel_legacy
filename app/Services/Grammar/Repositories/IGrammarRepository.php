<?php


namespace App\Services\Grammar\Repositories;


use App\Models\Grammar;

interface IGrammarRepository
{
    public function list();
    public function detail(int $id);
    public function update(Grammar $grammar, Array $data):Grammar;
    public function insert(Array $data):Grammar;

}
