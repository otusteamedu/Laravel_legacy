<?php
namespace App\Repositories;
use Config;

abstract class Repository {

    protected $model= FALSE;

    public function get($select = '*', $take = FALSE , $pagination = false, $where = false, $orderBy=false ){

        $builder = $this->model->select($select);
        if($take){
            $builder->take($take);
        }
        if($where){
            $builder->where($where[0],$where[1]);
        }
        if($pagination){
            return $this->check($builder->paginate(Config::get('settings.pagination')));
        }
        if($orderBy){
            $builder->orderBy($orderBy);
        }
        return $this->check($builder->get());
    }
    public function getOne($select = '*', $where = false)
    {

        $builder = $this->model->select($select);
        if ($where) {
            $builder->where($where[0],$where[1]);
        }
        $result  = $builder->first();
        if ($result && is_string($result->img) && is_object(json_decode($result->img)) && json_last_error() == JSON_ERROR_NONE) {
            $result->img = json_decode($result->img);
        }
        return $result;
    }
    protected function check($result)
    {
        if ($result->isEmpty()) {
            return FALSE;
        }
        $result->transform(function ($item, $key) {
           if (is_string($item->img) && is_object(json_decode($item->img)) && json_last_error() == JSON_ERROR_NONE) {
                $item->img = json_decode($item->img);
           }
             return $item;
        });

        return $result;
    }
    public function transliterate($string) {
        $str = mb_strtolower($string, 'UTF-8');

        $letter_array = array(
            'a' => 'а',
            'b' => 'б',
            'v' => 'в',
            'g' => 'г,ґ',
            'd' => 'д',
            'e' => 'е,є,э',
            'jo' => 'ё',
            'zh' => 'ж',
            'z' => 'з',
            'i' => 'и,і',
            'ji' => 'ї',
            'j' => 'й',
            'k' => 'к',
            'l' => 'л',
            'm' => 'м',
            'n' => 'н',
            'o' => 'о',
            'p' => 'п',
            'r' => 'р',
            's' => 'с',
            't' => 'т',
            'u' => 'у',
            'f' => 'ф',
            'kh' => 'х',
            'ts' => 'ц',
            'ch' => 'ч',
            'sh' => 'ш',
            'shch' => 'щ',
            '' => 'ъ',
            'y' => 'ы',
            '' => 'ь',
            'yu' => 'ю',
            'ya' => 'я',
        );

        foreach($letter_array as $letter => $kyr) {
            $kyr = explode(',',$kyr);

            $str = str_replace($kyr,$letter, $str);

        }

        //  A-Za-z0-9-
        $str = preg_replace('/(\s|[^A-Za-z0-9\-])+/','-',$str);

        $str = trim($str,'-');

        return $str;
    }

}

?>