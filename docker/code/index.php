<?php

error_reporting(E_ALL & ~E_NOTICE);


$host = 'mysql';
$user = getenv('MYSQL_USER');
$pass = getenv('MYSQL_PASSWORD');
$db = getenv('MYSQL_DATABASE');

echo sprintf("MYSQL user: %s, pass: %s, db: %s", $user, $pass, $db);

$conn = mysqli_connect($host, $user, $pass, $db);

if ($conn) {
    echo '<p>MYSQL connection successful</p>';
} else {
    echo '<p>MYSQL connection failed!</p>';
}

$memcached = new Memcached;
$memcached->addServer('memcached', 11211);

echo 'memcached server list:<pre>';
print_r($memcached->getServerList());
echo '</pre><br>';

$response = $memcached->get('test_value');

if ($response) {
   echo "found test value in memcached: " . $response;
} else {
   echo "test value not found in memcached, adding new value with TTL = 10 sec";
   $memcached->set('test_value', 'Hello from memchached', 10) or die("couldn't set value in memcache");
}

phpinfo();
