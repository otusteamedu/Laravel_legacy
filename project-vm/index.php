<?php
require_once __DIR__.'/vendor/autoload.php';

use Predis\Client as RedisClient;

/* test mariadb
//$mysql_dsn = 'mysql:dbname=otus;host=localhost';
//$mysql_user = 'otus';
//$mysql_password = 'otus_password';
//
//try {
//    $mariadb = new PDO($mysql_dsn, $mysql_user, $mysql_password);
//} catch (PDOException $e) {
//    echo 'Подключение не удалось: ' . $e->getMessage();
//    exit();
//}
//
//$sql = 'SELECT * FROM users';
//
//var_dump($mariadb->query($sql)->fetchAll());


//test redis
//$client = new RedisClient();
//$client->set('foo', 'bar');
//var_dump($value = $client->get('foo'));