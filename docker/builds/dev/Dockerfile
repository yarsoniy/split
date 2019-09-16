###### PHP
FROM php:7.2-fpm AS fpm
RUN docker-php-ext-install pdo pdo_mysql

RUN pecl install xdebug-2.6.1 && docker-php-ext-enable xdebug
COPY ./docker/builds/dev/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
VOLUME /code
WORKDIR /code

###### Nginx
FROM nginx:1.15 AS nginx
COPY ./docker/builds/dev/nginx.conf /etc/nginx/conf.d/default.conf
VOLUME /code
WORKDIR /code
