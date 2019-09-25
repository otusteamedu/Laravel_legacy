<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SimpleFooTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @group simple
     * @return void
     */
    public function testSimple()
    {
//        $this->mock(\App\Services\SimpleFoo::class, function ($mock) {
//            $mock->shouldReceive('getSeconds')->once();
//        });

        $this->assertTrue(true);
    }
}
