<?php
/**
 * Description of Bar.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Foo;


class Bar implements FooInterface
{

    public function __construct()
    {
        \Log::info('Bar created');
    }

    public function save(array $data)
    {
        \Log::info('Bar', $data);
    }

}