FROM nginx:1.15.3 as base

COPY ./deployment/dockerfiles/web/default.conf /etc/nginx/conf.d/default.conf

WORKDIR /var/www/public

#потому что 403
RUN touch index.php

RUN echo "daemon off;" >> /etc/nginx/nginx.conf

EXPOSE 80


FROM node:14.1.0-alpine as builder
#собрать
WORKDIR /source
COPY . /source
RUN npm install && npm run prod

FROM base

COPY --from=builder /source/public/favicon.ico .
COPY --from=builder /source/public/mix-manifest.json .
COPY --from=builder /source/public/robots.txt .
COPY --from=builder /source/public/css ./css
COPY --from=builder /source/public/js ./js


CMD ["service", "nginx", "start"]
