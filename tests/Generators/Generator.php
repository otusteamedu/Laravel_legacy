<?php


namespace Tests\Generators;


class Generator
{
    public static function getCreateGrammarData():array{
        return [
            'name' => "Личные местоимения",
            'title' => "Личные местоимения",
            'code' => rand(),
            'meta_keywords' => "Личные местоимения",
            'meta_description' => "Личные местоимения",
            'grammar_text' => " Личные местоимения, приведённые в ",
            'arabic_text' => "ٌ. أَنَا مُؤَذِّنٌ. هُمْ عُلَمَاءُ. هُنَّ جَاهِلاَتٌ.   ",
            'create_user_id'=>'1'
        ];
    }
    public static function getUpdateGrammarData($id,$update=[]):array{
        $array= [
            'id'=> $id,
            'name' => "Личные местоимения",
            'title' => "Личные местоимения",
            'code' => rand(),
            'meta_keywords' => "Личные местоимения",
            'meta_description' => "Личные местоимения",
            'grammar_text' => " Личные местоимения, приведённые в ",
            'arabic_text' => "ٌ. أَنَا مُؤَذِّنٌ. هُمْ عُلَمَاءُ. هُنَّ جَاهِلاَتٌ.   ",
            'create_user_id'=>'1'
        ];
        foreach ($update as $key=>$item) {
            $array[$key]=$item;
        }
        return $array;
    }
}
