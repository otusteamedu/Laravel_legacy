<?php
/**
 * @copyright Copyright (c) Archvile <info@0x25.ru>
 * @link https://0x25.ru
 */

namespace App\Services\Products\Repositories;


interface CachedProductsRepositoryInterface
{
    /**
     * @param $event
     */
    public function warmProduct($event) :void;
}