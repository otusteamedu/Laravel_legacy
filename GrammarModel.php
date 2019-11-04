<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class GrammarModel extends Model
{
    const tableName='grammar';
    /**
     * @return mixed
     */
    public static function getList()
    {
        return DB::table(self::tableName)->select('name', 'code')->where('deleted_at', NULL)->get();
    }

    /**
     * @param $code
     * @return mixed
     */
    public static function getDetail($code)
    {
        return DB::table(self::tableName)
            ->select('name', 'code', 'title', 'meta_keywords', 'meta_description', 'grammar_text', 'arabic_text')
            ->where(['code' => $code, 'deleted_at' => NULL])->first();
    }

    /**
     * @param array $data
     * @return bool
     */
    public static function insertData($data)
    {
        $updateArray=self::updateArray($data);
        if (!empty($updateArray)) {
            return DB::table(self::tableName)->insert($updateArray);
        }
        return false;
    }

    /**
     * @param $id
     * @param $data
     * @return bool
     */
    public static function updateData($id,$data)
    {
        $updateArray=self::updateArray($data);
        if (!empty($updateArray)) {
            return DB::table(self::tableName)->where('id',$id)->update($updateArray);
        }
        return false;
    }

    private static function updateArray($data)
    {
        $updateArray = [];
        if (isset($data['name'])) {
            $updateArray['name'] = $data['name'];
        }
        if (isset($data['code'])) {
            $updateArray['code'] = $data['code'];
        }
        if (isset($data['title'])) {
            $updateArray['title'] = $data['title'];
        }
        if (isset($data['meta_keywords'])) {
            $updateArray['meta_keywords'] = $data['meta_keywords'];
        }
        if (isset($data['meta_description'])) {
            $updateArray['meta_description'] = $data['meta_description'];
        }
        if (isset($data['grammar_text'])) {
            $updateArray['grammar_text'] = $data['grammar_text'];
        }
        if (isset($data['arabic_text'])) {
            $updateArray['arabic_text'] = $data['arabic_text'];
        }
        return $updateArray;
    }

}
