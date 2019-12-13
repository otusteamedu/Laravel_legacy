<?php

$product =[]; // массив с данными о товарах (фруктах)

$item = [
  'name' => 'Яблоко жёлтое',
  'src' => 'apple-yellow.svg',
  'description' => 'Яблоко жёлтое. Сорт "Золотинка". Кисло-сладкое. Выращено в респ. Узбекистан.',
  'price' => '80'
];

array_push($product,$item);

$item = [
  'name' => 'Яблоко красное',
  'src' => 'apple-red.svg',
  'description' => 'Яблоко красное. Сорт "Краснуха". Сладкое. Выращено в респ. Узбекистан.',
  'price' => '90'
];

array_push($product,$item);

$item = [
  'name' => 'Яблоко зелёное',
  'src' => 'apple-green.svg',
  'description' => 'Яблоко зелёное. Сорт "Грин Смит". С кислинкой. Выращено в Турции.',
  'price' => '100'
];

array_push($product,$item);

$item = [
  'name' => 'Груши кубанские',
  'src' => 'pear.svg',
  'description' => 'Сезонные. Собраны в ноябре 2019 г. Колхоз имени Ленина, станица Анапская.',
  'price' => '140'
];

array_push($product,$item);

$item = [
  'name' => 'Персики волосатые',
  'src' => 'peach.svg',
  'description' => 'Мягкие, сочные, сладкие. Из солнечного Узбекистана, г. Фергана.',
  'price' => '180'
];

array_push($product,$item);

$item = [
  'name' => 'Сливи озимые',
  'src' => 'plum.svg',
  'description' => 'Спелые. Ароматные. Идеально подойдут для варенья. Нижний Новгород.',
  'price' => '70'
];

array_push($product,$item);

$item = [
  'name' => 'Виноград кишмиш',
  'src' => 'grape.svg',
  'description' => 'Без косточек. Сладкий. Ягодка-к-ягодке. Выращено в свободной Грузии.',
  'price' => '150'
];

array_push($product,$item);

$item = [
  'name' => 'Арбуз',
  'src' => 'watermelon.svg',
  'description' => 'Астраханский арбуз. Звонкий, спелый, ароматный. Собран собственными руками на даче.',
  'price' => '20'
];

array_push($product,$item);

// var_dump($product);
