FROM nginx:1.15 AS stage_base
COPY ./docker/builds/nginx/nginx.conf /etc/nginx/conf.d/default.conf

FROM stage_base AS stage_dev
VOLUME /code
