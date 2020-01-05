<?php

namespace App\Services\Test;

use App\Models\Test;
use App\Services\Test\Repositories\TestRepository;
use App\Services\Test\Repositories\TestRepositoryCache;
use DB;
use Cache;

class TestService
{

    private $testRepository;
    private $testRepositoryCache;
    public function __construct(
        TestRepository $testRepository,
        TestRepositoryCache $testRepositoryCache)
    {
        $this->testRepository = $testRepository;
        $this->testRepositoryCache = $testRepositoryCache;
    }
    public function listTest(){
        return Test::all();
    }
    public function updateTest(Test $test, Array $data){
        $test->update($data);
    }
    public function insert($data){
        $test = new Test();
        $test->create($data);
        //return Test::all();
    }
}
