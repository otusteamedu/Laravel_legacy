FROM composer:latest

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

#####################################
# Non-Root User:
#####################################

# Add a non-root user to prevent files being created with root permissions on host machine.
ARG PUID=1000
ARG PGID=1000
ARG PROJECT_USER=composer
ARG PROJECT_ROOT_FOLDER_PATH=/app

ENV PUID ${PUID}
ENV PGID ${PGID}
ENV PROJECT_USER ${PROJECT_USER}
ENV PROJECT_GROUP ${PROJECT_USER}
ENV PROJECT_ROOT_FOLDER_PATH ${PROJECT_ROOT_FOLDER_PATH}

# Add user
RUN addgroup -g ${PGID} -S ${PROJECT_GROUP} \
&& adduser -D -S -u ${PUID} ${PROJECT_USER} -h /home/${PROJECT_USER} -G ${PROJECT_GROUP}
RUN chown -R ${PROJECT_USER}:${PROJECT_USER} /home/${PROJECT_USER}

#####################################
USER ${PROJECT_USER}
