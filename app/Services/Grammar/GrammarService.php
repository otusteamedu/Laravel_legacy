<?php

namespace App\Services\Grammar;

use App\Models\Grammar;
use App\Services\Grammar\Repositories\GrammarRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GrammarService
{

    private $grammarRepository;

    public function __construct(GrammarRepository $grammarRepository)
    {
        $this->grammarRepository = $grammarRepository;
    }

    public function listGrammar()
    {
        $data = $this->grammarRepository->listGrammar();
        $list = [];
        foreach ($data as $item) {
            $list[] = new Grammar($item);
        }
        return $list;
    }

    public function detailGrammar(string $id): Grammar
    {
        $data = $this->grammarRepository->detailGrammar($id);
        $grammar = new Grammar($data);
        return $grammar;
    }

    public function updateGrammar($data)
    {
        $grammar = new Grammar($data);

        if(empty($data['id'])){
            $updateArray=$grammar->getArrayForInsert();
            $id = $this->grammarRepository->insertGrammar($updateArray);
            if($id>0){
                $updateArray['id']= $id;
                $grammar=new Grammar($updateArray);
                return $grammar;
            }
            return 0;
        }else {
            $updateArray=$grammar->getArray();
            if ($this->grammarRepository->updateGrammar($updateArray)) {
                return $grammar;
            } else {
                return 0;
            }
        }
    }

    public function newGrammar(){
        $grammar = new Grammar();
        $grammar->setEmpty();

        return $grammar;
    }


}
