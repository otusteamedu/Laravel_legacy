FROM php:7.3-fpm

RUN apt-get update && apt-get install -y zlib1g-dev libmemcached-dev \
    && pecl install memcached \
    && docker-php-ext-enable memcached \
    && docker-php-ext-install mysqli

WORKDIR /var/www

EXPOSE 9000

