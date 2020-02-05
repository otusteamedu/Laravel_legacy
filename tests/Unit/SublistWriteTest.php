<?php

namespace Tests\Unit;

use App\Services\Subscriptions\SublistService;
use PHPUnit\Framework\TestCase;

/**
 * Class SublistWriteTest
 * @package Tests\Unit
 * @group write
 */
class SublistWriteTest extends TestCase
{
    /**
     * @param $email
     * @testWith ["admin@ya.ru"]
     * ["admin@otus.ru"]
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function testWrite($email)
    {
        $sublist = app()->make(SublistService::class);

        $sublist->SaveResult($email);
        $data = $sublist->GetResult();

        $this->assertEquals($email,$data);


    }
}
