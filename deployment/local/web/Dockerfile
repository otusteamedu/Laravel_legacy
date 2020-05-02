FROM nginx:1.15.3 as base

COPY ./deployment/local/web/default.conf /etc/nginx/conf.d/default.conf

WORKDIR /var/www/public

#потому что 403
RUN touch index.php

RUN echo "daemon off;" >> /etc/nginx/nginx.conf

EXPOSE 80

CMD ["service", "nginx", "start"]
