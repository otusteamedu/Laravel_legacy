FROM php:7.4.2-fpm-buster as base

RUN apt-get update && apt-get install -y \
    git \
    zip \
    libpq-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*


RUN docker-php-ext-install \
    pdo_pgsql

COPY ./deployment/dockerfiles/app/docker-php-entrypoint /usr/local/bin/docker-php-entrypoint
RUN chmod +x /usr/local/bin/docker-php-entrypoint

# Install composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin

FROM base as build
RUN composer global require hirak/prestissimo --no-plugins --no-scripts

WORKDIR /var/www

COPY composer.*  ./

RUN composer install \
      --no-interaction \
      --no-plugins \
      --no-suggest \
      --no-scripts \
      --no-autoloader \
      --prefer-dist

COPY app            ./app
COPY bootstrap      ./bootstrap
COPY config         ./config
COPY database       ./database
COPY public         ./public
COPY resources      ./resources
COPY routes         ./routes
COPY storage        ./storage
COPY artisan        ./artisan

RUN composer dump-autoload -o

FROM base

COPY --chown=www-data:www-data --from=build /var/www/ /var/www/

ENV PATH="${PATH}:/var/www:/var/www/vendor/bin"

EXPOSE 9000

WORKDIR /var/www
