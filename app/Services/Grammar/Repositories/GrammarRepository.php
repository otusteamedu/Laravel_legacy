<?php
namespace App\Services\Grammar\Repositories;

use App\Models\Grammar;
use DB;

class GrammarRepository
{
    const tableName='grammar';
    public function listGrammar(){
       return DB::table(self::tableName)->select('name', 'code')->where('deleted_at', NULL)->get();
    }
    public function detailGrammar(string $code)
    {
        $result = DB::table(self::tableName)
            ->select('id', 'name', 'code', 'title', 'meta_keywords', 'meta_description', 'grammar_text', 'arabic_text')
            ->where(['code' => $code, 'deleted_at' => NULL])->first();
        return $result;
    }

    public function updateGrammar(array $updateArray){
        return DB::table(self::tableName)->where(['id'=>$updateArray['id']])->update($updateArray);
    }
    public function insertGrammar(array $updateArray){
        return DB::table(self::tableName)->insertGetId($updateArray);
    }

}
