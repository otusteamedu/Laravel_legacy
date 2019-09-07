FROM php:7.3-fpm

RUN docker-php-ext-install mysqli \
    && pecl install redis \
    && pecl install xdebug \
    && docker-php-ext-enable redis xdebug

COPY 99-dev.ini /etc/php/7.3/cli/conf.d/99-dev.ini
