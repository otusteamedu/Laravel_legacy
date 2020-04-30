FROM php:7.4-fpm-alpine

RUN docker-php-ext-install bcmath \
    && docker-php-ext-enable bcmath

WORKDIR /var/www
COPY . .
RUN chown www-data:www-data -R storage
VOLUME /var/www
VOLUME /var/www/storage

ARG WITH_XDEBUG
RUN (test ! -z "${WITH_XDEBUG}" \
    && pecl install xdebug-2.9.4 \
    && docker-php-ext-enable xdebug \
    && { \
    echo "xdebug.remote_enable=on"; \
    && echo "xdebug.remote_autostart=on"; \
    && echo "xdebug.remote_handler=dbgp"; \
    && echo "xdebug.remote_mode=req"; \ \
    && echo "xdebug.remote_port=9000"; \
    && echo "xdebug.remote_log=/tmp/xdebug_remote.log"; \
    && echo "xdebug.idekey=PHPSTORM"; \
    && echo "xdebug.remote_connect_back=On"; \
    } >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    ) || true
