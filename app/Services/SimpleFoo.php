<?php
/**
 * Description of SimpleFoo.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services;

use App\Services\Foo\FooInterface;

class SimpleFoo
{
    protected $seconds;
    protected $fooInterface;

    public function __construct(
        FooInterface $fooInterface
    )
    {
        $this->fooInterface = $fooInterface;
    }

    public function getSeconds()
    {
        return $this->seconds;
    }

    public function saveFoo()
    {
        $this->fooInterface->save([]);
    }
    
}