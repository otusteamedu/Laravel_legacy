FROM php:7.4-fpm-alpine

RUN apk add --no-cache git unzip sudo bash

RUN docker-php-ext-install bcmath \
    && docker-php-ext-enable bcmath

RUN apk add --no-cache postgresql-dev \
    && docker-php-ext-install -j$(nproc) pdo_pgsql

ARG WITH_XDEBUG
RUN (test ! -z "${WITH_XDEBUG}" \
    && apk add --no-cache --virtual .deps $PHPIZE_DEPS \
    && pecl install xdebug-2.9.4 \
    && apk del .deps \
    && docker-php-ext-enable xdebug \
    && { \
        echo "xdebug.remote_enable=on"; \
        echo "xdebug.remote_autostart=on"; \
        echo "xdebug.remote_handler=dbgp"; \
        echo "xdebug.remote_mode=req"; \ \
        echo "xdebug.remote_port=9000"; \
        echo "xdebug.remote_log=/tmp/xdebug_remote.log"; \
        echo "xdebug.idekey=PHPSTORM"; \
        echo "xdebug.remote_connect_back=On"; \
    } >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    ) || true

RUN curl -sS https://getcomposer.org/installer | php -- \
    --quiet --install-dir=/usr/local/bin/ --filename=composer

WORKDIR /var/www
