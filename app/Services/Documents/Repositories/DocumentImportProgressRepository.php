<?php
/**
 * Description of JobProgressRepository.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Documents\Repositories;

use Cache;

class DocumentImportProgressRepository
{

    const PREFIX = 'progress-document';

    public function get(string $id): ?int
    {
        return Cache::get($this->generateKey($id));
    }

    public function set(string $id, int $progress)
    {
        Cache::put($this->get($id), $progress);
    }

    private function generateKey(string $id): string
    {
        return self::PREFIX . '|' . $id;
    }

}
