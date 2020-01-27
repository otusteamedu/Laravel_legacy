<?php

namespace Tests\Unit;

use App\Test\Calc;
use PHPUnit\Framework\TestCase;

/**
 * Class DemoTest
 * @group calc
 * @package Tests\Unit
 */
class DemoTest extends TestCase
{
    /**

     * A basic unit test example.
     * @dataProvider data
     * @return void
     */
    public function testExample($a, $b, $c)
    {
        $res = Calc::sum($a, $b);
        $this->assertEquals($c, $res);
    }

    public function data()
    {
        return [
            [1, 2, 3],
            [4, 5, 9]
        ];
    }
}
