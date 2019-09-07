<?php
$host = 'mysql';
$user = getenv('MYSQL_USER');
$pass = getenv('MYSQL_PASSWORD');
$db = getenv('MYSQL_DATABASE');

$conn = mysqli_connect($host, $user, $pass, $db);
if ($conn) {
    echo '<p>MySQL connection successful</p>';
} else {
    echo '<p style="color: red">MySQL connection failed</p>';
}
