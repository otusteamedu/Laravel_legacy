<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    protected $id;
    protected $name;
    protected $code;
    protected $title;
    protected $meta_keywords;
    protected $meta_description;

    public function __construct($data = null)
    {
        if(is_array($data)){
            self::initFromArray($data);
        }
        if(is_object($data)){
            self::initFromArrayObj($data);
        }
    }

    public function setId($id)
    {
        $this->id = ($id)??"";
    }

    public function getId(): string
    {
        return ($this->id) ?? '';
    }
    public function setName($name)
    {
        $this->name = ($name)??"";
    }

    public function getName(): string
    {
        return ($this->name) ?? '';
    }

    public function setCode($code)
    {
        $this->code = ($code)??"";
    }

    public function getCode(): string
    {
        return ($this->code) ?? '';
    }

    public function setTitle($title)
    {
        $this->title = ($title)??"";
    }

    public function getTitle(): string
    {
        return ($this->title) ?? '';
    }

    public function setMetaKeywords($meta_keywords)
    {
        $this->meta_keywords = ($meta_keywords)??"";
    }

    public function getMetaKeywords(): string
    {
        return ($this->meta_keywords) ?? '';
    }

    public function setMetaDescription($meta_description)
    {
        $this->meta_description = ($meta_description)??"";
    }

    public function getMetaDescription(): string
    {
        return ($this->meta_description) ?? '';
    }

    public function initFromObj($obj)
    {
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
        self::setId($array['id']);
        self::setName($array['name']);
        self::setCode($array['code']);
        self::setTitle($array['title']);
        self::setMetaKeywords($array['meta_keywords']);
        self::setMetaDescription($array['meta_description']);
    }
}
