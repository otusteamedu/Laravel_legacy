#!/usr/bin/env bash

apt-get -y update
apt-get install -y nginx
apt-get install -y php
apt-get install -y php-fpm
apt-get install -y mysql-server
apt-get install -y redis-server
apt-get install -y mc

if ! [ -L /var/www ]; then
  rm -rf /var/www
  ln -fs /vagrant /var/www
fi