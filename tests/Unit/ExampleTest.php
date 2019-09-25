<?php

namespace Tests\Unit;

use App\Services\SimpleFoo;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @group a
     * @return void
     */
    public function testBasicTest()
    {
//        $this->mock(\App\Services\SimpleFoo::class, function ($mock) {
//            $mock->shouldReceive('getSeconds')->once();
//        });

        /** @var SimpleFoo $simpleMake */
        $simpleMake = app()->make(SimpleFoo::class);
        $simpleMake->getSeconds();

        $this->assertTrue(true);
    }
}
