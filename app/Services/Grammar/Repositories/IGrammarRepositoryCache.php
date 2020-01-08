<?php


namespace App\Services\Grammar\Repositories;


interface IGrammarRepositoryCache
{
    public function list();
    public function detail(int $id);

}
