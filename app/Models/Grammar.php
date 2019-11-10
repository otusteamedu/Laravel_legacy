<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grammar extends Page{

    private $grammar_text;
    private $arabic_text;

    public function __construct($data = null)
    {
        if (is_array($data)) {
            self::initFromArray($data);
        }
        if (is_object($data)) {
            self::initFromArrayObj($data);
        }
    }

    public function setGrammarText($grammar_text)
    {
        $this->grammar_text = ($grammar_text) ?? '';
    }

    public function getGrammarText(): string
    {
        return ($this->grammar_text) ?? '';
    }

    public function setArabicText($arabic_text)
    {
        $this->arabic_text = ($arabic_text) ?? '';
    }

    public function getArabicText(): string
    {
        return ($this->arabic_text) ?? '';
    }

    public function initFromArrayObj($obj)
    {
        if (isset($obj->grammar_text)) {
            self::setGrammarText($obj->grammar_text);
        }
        if (isset($obj->grammar_text)) {
            self::setGrammarText($obj->grammar_text);
        }
        if (isset($obj->arabic_text)) {
            self::setArabicText($obj->arabic_text);
        }
        if (isset($obj->id)) {
            self::setId($obj->id);
        }
        if (isset($obj->name)) {
            self::setName($obj->name);
        }
        if (isset($obj->code)) {
            self::setCode($obj->code);
        }
        if (isset($obj->title)) {
            self::setTitle($obj->title);
        }
        if (isset($obj->meta_keywords)) {
            self::setMetaKeywords($obj->meta_keywords);
        }
        if (isset($obj->meta_description)) {
            self::setMetaDescription($obj->meta_description);
        }
    }

    public function initFromArray($array)
    {
        if($array['id']) self::setId($array['id']);
        if($array['name']) self::setName($array['name']);
        if($array['code']) self::setCode($array['code']);
        if($array['title']) self::setTitle($array['title']);
        if($array['meta_keywords']) self::setMetaKeywords($array['meta_keywords']);
        if($array['meta_description']) self::setMetaDescription($array['meta_description']);
        if($array['grammar_text']) self::setGrammarText($array['grammar_text']);
        if($array['arabic_text']) self::setArabicText($array['arabic_text']);
    }
    public function getArray():array{
        $array=[];
        if (isset($this->id)) {
            $array['id']=$this->id;
        }
        if (isset($this->name)) {
            $array['name']=$this->name;
        }
        if (isset($this->code)) {
            $array['code']=$this->code;
        }
        if (isset($this->title)) {
            $array['title']=$this->title;
        }
        if (isset($this->meta_keywords)) {
            $array['meta_keywords']=$this->meta_keywords;
        }
        if (isset($this->meta_description)) {
            $array['meta_description']=$this->meta_description;
        }
        if (isset($this->grammar_text)) {
            $array['grammar_text']=$this->grammar_text;
        }
        if (isset($this->arabic_text)) {
            $array['arabic_text']=$this->arabic_text;
        }
        return $array;
    }
    public function getArrayForInsert(){
        $array=[];
        if (isset($this->name)) {
            $array['name']=$this->name;
        }
        if (isset($this->code)) {
            $array['code']=$this->code;
        }
        if (isset($this->title)) {
            $array['title']=$this->title;
        }
        if (isset($this->meta_keywords)) {
            $array['meta_keywords']=$this->meta_keywords;
        }
        if (isset($this->meta_description)) {
            $array['meta_description']=$this->meta_description;
        }
        if (isset($this->grammar_text)) {
            $array['grammar_text']=$this->grammar_text;
        }
        if (isset($this->arabic_text)) {
            $array['arabic_text']=$this->arabic_text;
        }
        return $array;
    }

    public function setEmpty(){

            self::setGrammarText('');
            self::setGrammarText('');
            self::setArabicText('');
            self::setId('');
            self::setName('');
            self::setCode('');
            self::setTitle('');
            self::setMetaKeywords('');
            self::setMetaDescription('');

    }
}
