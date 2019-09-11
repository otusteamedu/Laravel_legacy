FROM nginx
COPY ./dockerfiles/nginx/conf/nginx.conf /etc/nginx/nginx.conf
RUN ["apt-get", "update"]
RUN ["apt-get", "install", "-y", "less"]