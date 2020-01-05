<?php


namespace App\Services\Word;

use App\Models\Word;
use App\Services\Word\Repositories\WordRepository;
use App\Services\Word\Repositories\WordRepositoryCache;
use DB;

class WordService
{
    private $wordRepository;
    private $wordRepositoryCache;
    public function __construct(
        WordRepository $wordRepository,
        WordRepositoryCache $wordRepositoryCache)
    {
        $this->wordRepository = $wordRepository;
        $this->wordRepositoryCache = $wordRepositoryCache;
    }
    public function list(){
        return Word::all();
    }
    public function update(Word $test, Array $data){
        $test->update($data);
    }
    public function insert($data){
        $test = new Word();
        $test->create($data);
    }
}
