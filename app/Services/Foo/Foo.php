<?php
/**
 * Description of Foo.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Foo;


class Foo implements FooInterface
{

    public function save(array $data)
    {
        \Log::info('Foo', $data);
    }

}