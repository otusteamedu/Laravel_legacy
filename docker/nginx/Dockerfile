FROM nginx:latest

COPY default.conf /etc/nginx/conf.d/
RUN usermod -aG www-data nginx

EXPOSE 80
