<?php

namespace App\Helpers;

class RandomMessageGenerator
{
    private $firstWordsArray = [
        'Я',
        'Ты',
        'Вы',
        'Он',
        'Оно',
        'Кто-то',
        'Что-то',
    ];
    
    private $secondWordsArray = [
        'Горбатый',
        'Лохматый',
        'Чумазый',
        'Кривоватый',
        'Криповатый',
        'Крутецкий',
        'Пельмецкий',
    ];
    
    private $thirdWordsArray = [
        'Чумазод',
        'Луноход',
        'Тык-мык-пык',
        'Размалюн',
        'Столоед',
        'Снежеход',
        'Сын-подруги-мамы',
    ];
    
    public function generateRandomMessage()
    {
        $firstWord = $this->firstWordsArray[rand(0, count($this->firstWordsArray) - 1)];
        $secondWord = $this->secondWordsArray[rand(0, count($this->secondWordsArray) - 1)];
        $thirdWord = $this->thirdWordsArray[rand(0, count($this->thirdWordsArray) - 1)];
        
        return "$firstWord $secondWord $thirdWord";
    }
}