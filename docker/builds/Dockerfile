###### Builders
FROM composer:1.9 AS backend_builder
RUN composer global require hirak/prestissimo --no-plugins --no-scripts
WORKDIR /code
# install dependencies
COPY ./composer.json ./composer.json
COPY ./composer.lock ./composer.lock
RUN composer install --prefer-dist --no-scripts --no-dev --no-autoloader \
    && rm -rf /root/.composer
# build
COPY ./ ./
RUN composer dump-autoload --no-scripts --no-dev --optimize
RUN composer run-script post-install-cmd

FROM node:12.10 AS frontend_builder
# install dependencies
WORKDIR /code
COPY ./package.json ./package.json
COPY ./yarn.lock ./yarn.lock
RUN yarn install
# build
COPY ./assets ./assets
COPY ./webpack.config.js ./webpack.config.js
RUN mkdir -p ./public/build
RUN yarn build

###### PHP
FROM php:7.2-fpm AS fpm_base
RUN docker-php-ext-install pdo pdo_mysql

FROM fpm_base AS fpm_dev
RUN pecl install xdebug-2.6.1 && docker-php-ext-enable xdebug
COPY ./docker/builds/php/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
VOLUME /code
WORKDIR /code

FROM fpm_base AS fpm_prod
COPY --from=backend_builder /code /code
COPY --from=frontend_builder /code /code
RUN chmod -R 777 /code
WORKDIR /code

###### Nginx
FROM nginx:1.15 AS nginx_base
COPY ./docker/builds/nginx/nginx.conf /etc/nginx/conf.d/default.conf

FROM nginx_base AS nginx_dev
VOLUME /code

FROM nginx_base AS nginx_prod
COPY --from=fpm_prod /code /code
RUN chmod -R 777 /code
WORKDIR /code
