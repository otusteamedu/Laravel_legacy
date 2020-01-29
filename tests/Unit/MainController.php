<?php

namespace Tests\Unit;

use App\Http\Controllers\Subscriptions\WriteFileController;
use PHPUnit\Framework\TestCase;

class MainController extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testWriteFile()
    {
        $data = 123;
        WriteFileController::writeFile($data);
    }
}
