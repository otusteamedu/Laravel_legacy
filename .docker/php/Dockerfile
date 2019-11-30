FROM php:7.2-fpm

RUN apt-get update && apt-get install -y \
    && docker-php-ext-install sockets

WORKDIR /var/www/html

CMD ["php-fpm"]