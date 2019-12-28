<?php

// Захардкодил описание товаров. 
// Не нашёл лёгкого пути как нагенерировать осмысленное описания товаров используя Faker.


class Items
{
  public static function getAll()
  {
    $items =[]; // массив с данными о товарах (фруктах)

    $item = [
      'name' => 'Яблоко жёлтое',
      'picture' => 'apple-yellow.svg',
      'tag' => 'фрукт, сладкий, сезонный',
      'description' => 'Яблоко жёлтое. Сорт "Золотинка". Кисло-сладкое. Выращено в респ. Узбекистан.',
      'price' => 80
    ];

    array_push($items,$item);

    $item = [
      'name' => 'Яблоко красное',
      'picture' => 'apple-red.svg',
      'tag' => 'фрукт, кисло-сладкий, сезонный',
      'description' => 'Яблоко красное. Сорт "Краснуха". Сладкое. Выращено в респ. Узбекистан.',
      'price' => 90
    ];

    array_push($items,$item);

    $item = [
      'name' => 'Яблоко зелёное',
      'picture' => 'apple-green.svg',
      'tag' => 'фрукт, кислый',
      'description' => 'Яблоко зелёное. Сорт "Грин Смит". С кислинкой. Выращено в Турции.',
      'price' => 100
    ];

    array_push($items,$item);

    $item = [
      'name' => 'Груши кубанские',
      'picture' => 'pear.svg',
      'tag' => 'фрукт, сладкий, сезонный',
      'description' => 'Сезонные. Собраны в ноябре 2019 г. Колхоз имени Ленина, станица Анапская.',
      'price' => 140
    ];

    array_push($items,$item);

    $item = [
      'name' => 'Персики волосатые',
      'picture' => 'peach.svg',
      'tag' => 'фрукт, сладкий, сезонный',
      'description' => 'Мягкие, сочные, сладкие. Из солнечного Узбекистана, г. Фергана.',
      'price' => 180
    ];

    array_push($items,$item);

    $item = [
      'name' => 'Сливи озимые',
      'picture' => 'plum.svg',
      'tag' => 'фрукт, сладкий',
      'description' => 'Спелые. Ароматные. Идеально подойдут для варенья. Нижний Новгород.',
      'price' => 70
    ];

    array_push($items,$item);

    $item = [
      'name' => 'Виноград кишмиш',
      'picture' => 'grape.svg',
      'tag' => 'ягода, сладкий',
      'description' => 'Без косточек. Сладкий. Ягодка-к-ягодке. Выращено в свободной Грузии.',
      'price' => 150
    ];

    array_push($items,$item);

    $item = [
      'name' => 'Арбуз',
      'picture' => 'watermelon.svg',
      'tag' => 'ягода, сладкий',
      'description' => 'Астраханский арбуз. Звонкий, спелый, ароматный. Собран собственными руками на даче.',
      'price' => 20
    ];

    array_push($items,$item);

    return $items;
  }
}