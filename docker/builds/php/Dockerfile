FROM php:7.2-fpm AS stage_base
# php-cli is already here


FROM stage_base AS stage_dev
RUN pecl install xdebug-2.6.1 && docker-php-ext-enable xdebug
COPY ./docker/builds/php/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
VOLUME /code
