<?php


namespace App\Services\Format\Repositories;


use App\Models\Format;
use Illuminate\Database\Eloquent\Collection;

class FormatRepository
{
    /**
     * @return Collection
     */
    public function getAll(): Collection {
        return Format::all();
    }
}
