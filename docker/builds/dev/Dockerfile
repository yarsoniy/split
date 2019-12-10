###### PHP
FROM php:7.2-fpm AS fpm
ENV REFRESHED_AT 2019-12-05

RUN apt-get update

# PDO
RUN docker-php-ext-install pdo pdo_mysql

# Redis extension
RUN apt-get install -y librabbitmq-dev \
    && pecl install amqp \
    && docker-php-ext-enable amqp

# Xdebug extension
RUN pecl install xdebug-2.8.1 && docker-php-ext-enable xdebug
COPY ./docker/builds/dev/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

VOLUME /code
WORKDIR /code

###### Nginx
FROM nginx:1.15 AS nginx
COPY ./docker/builds/dev/nginx.conf /etc/nginx/conf.d/default.conf
VOLUME /code
WORKDIR /code
