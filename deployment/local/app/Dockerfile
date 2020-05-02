# docker build . -t local/php-fmp-test -f testing/images/php-fpm.docker
# docker run --rm -it --env PHP_ENABLE_XDEBUG=1 local/php-fmp-test bash
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


# LOCAL ONLY BLOCK
# set path
ENV PATH="${PATH}:/var/www:/var/www/vendor/bin"

# https://bugs.xdebug.org/view.php?id=1584
# https://github.com/yiisoft/yii2-docker/blob/master/php/image-files/usr/local/bin/docker-php-entrypoint
RUN pecl install xdebug-beta
COPY ./deployment/local/app/docker-php-entrypoint /usr/local/bin/docker-php-entrypoint
RUN chmod +x /usr/local/bin/docker-php-entrypoint

RUN echo "alias a='php artisan'" >> /root/.bashrc
RUN echo "alias p='phpunit'" >> /root/.bashrc
RUN echo "alias pf='p --filter'" >> /root/.bashrc
#END LOCAL ONLY BLOCK

WORKDIR /var/www
