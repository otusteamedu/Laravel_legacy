FROM php:7.3-fpm-alpine

COPY www.conf /etc/php/php-fpm.d/www.conf
COPY socket-docker.conf /usr/local/etc/php-fpm.d/zz-docker.conf
COPY init.sh /usr/bin/init.sh
COPY cron /etc/crontabs/root

RUN docker-php-ext-install sockets \
    && apk add --no-cache --virtual .phpize-deps $PHPIZE_DEPS \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

WORKDIR /app

ENTRYPOINT ["sh", "/usr/bin/init.sh"]