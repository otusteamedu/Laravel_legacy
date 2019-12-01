<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once __DIR__.'/vendor/autoload.php';

use Predis\Client as RedisClient;

echo 'hello';

// test memcached
//$memcached = new Memcached();
//$memcached->addServer('memcached', 11211);
//echo '<pre>'; print_r($memcached->getServerList()); echo '</pre>';
//$memcached->set('test_h', 'hihahe');
//echo $memcached->get('test_h');

// test postgres work

//$postgres_dsn = 'pgsql:dbname=otus;host=postgres';
//$postgres_user = 'otus';
//$postgres_password = 'otus_password';
//
//try {
//    $postgres = new PDO($postgres_dsn, $postgres_user, $postgres_password);
//} catch (PDOException $e) {
//    echo 'Подключение не удалось: ' . $e->getMessage();
//    exit();
//}

//$sql = 'SELECT * FROM users';
//$res = $postgres->query($sql)->fetchAll();
//var_dump($res);


// test redis work

//$redisConf = [
//    "scheme" => "tcp",
//    "host" => "redis",
//];
//
//$redis = new RedisClient($redisConf);

//echo $redis->get('test_key');