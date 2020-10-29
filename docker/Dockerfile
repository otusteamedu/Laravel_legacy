FROM  webdevops/php-dev:7.4

MAINTAINER Leonid Derevianko
# Fix debconf warnings upon build
USER root
ARG DEBIAN_FRONTEND=noninteractive
ARG PUID=1000
ENV PROVISION_CONTEXT "development"
ENV PUID ${PUID}

#####################################
RUN apt-get update -qq && apt-get install -qq -y \
    htop --no-install-recommends \
 && mkdir -p /conf \
 && mkdir -p /logs \
 && mkdir -p /shared \
 && apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

#####################################

# Deploy scripts/configurations
COPY docker/etc/ /opt/docker/etc/
RUN ln -sf /opt/docker/etc/cron/crontab /etc/cron.d/docker-boilerplate \
    && chmod 0644 /opt/docker/etc/cron/crontab \
    && echo >> /opt/docker/etc/cron/crontab \
    && ln -sf /opt/docker/etc/php/development.ini /opt/docker/etc/php/php.ini

# Configure volume/workdir
WORKDIR /app/

COPY . ./
RUN chown -R ${PUID}:${PUID} /app/ \
    && chown -R ${PUID}:${PUID} /logs/ \
    && chown -R ${PUID}:${PUID} /tmp/
USER ${PUID}

RUN composer install --optimize-autoloader --no-interaction
USER root
