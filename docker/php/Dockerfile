FROM php:7.3-fpm

RUN apt-get update && apt-get install -y zlib1g-dev libmemcached-dev \
    && pecl install memcached \
    && docker-php-ext-enable memcached \
    && docker-php-ext-install mysqli

COPY www.conf /usr/local/etc/php-fpm.d/www.conf
RUN rm /usr/local/etc/php-fpm.d/zz-docker.conf

WORKDIR /var/www
