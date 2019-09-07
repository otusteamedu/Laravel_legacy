<?php
$redis = new Redis();

$host = 'redis';
$conn = $redis->connect($host);
if ($conn) {
    echo '<p>Redis connection successful</p>';
} else {
    echo '<p style="color: red">Redis connection failed</p>';
}
