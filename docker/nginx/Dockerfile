FROM  webdevops/nginx-dev:alpine

MAINTAINER Leonid Derevianko
# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive
ENV PROVISION_CONTEXT "development"

#####################################
RUN apk add --no-cache htop \
 && mkdir /conf \
 && mkdir /logs \
 && mkdir /shared

#####################################

# Deploy scripts/configurations
COPY docker/etc/nginx /opt/docker/etc/nginx
