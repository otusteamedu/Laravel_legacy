#!/bin/bash

mkdir /var/log/app 2> /dev/null
crond &
php -f /app/server.php 1>/var/log/app/server.log &
php -f /app/client.php 1>/var/log/app/client.log