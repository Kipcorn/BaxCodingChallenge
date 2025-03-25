# stage 1: php
FROM php:8.2-fpm-alpine as php
RUN apk update && apk add --no-cache $PHPIZE_DEPS
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
COPY . /var/www/html/
COPY .env /var/www/html/.env
RUN composer install --no-interaction --optimize-autoloader --no-scripts

# Stage 2: Nginx
FROM nginx:alpine AS nginx

COPY --from=php /var/www/html/public /var/www/html/public
COPY ./docker/nginx/nginx.conf /etc/nginx/conf.d/default.conf
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]