<?php

namespace App\Services\Languages\Repositories;

use App\Models\Language;

/**
 * Interface LanguageRepositoryInterface
 * @package App\Services\Languages\Repositories
 */
interface LanguageRepositoryInterface
{
    public function find(int $id);

    public function search(array $filters = []);

    public function createFromArray(array $data): Language;

    public function updateFromArray(Language $language, array $data);

    public function delete(int $id);
}
