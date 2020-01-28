<?php


namespace App\Services\News\Repositories;


use App\Models\News;

class EloquentNewsRepository
{
    public function getAll()
    {
        return News::all();
    }
}
