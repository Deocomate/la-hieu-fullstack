FROM serversideup/php:8.2-fpm-nginx-alpine

ENV PHP_OPCACHE_ENABLE=1 \
    NGINX_WEBROOT=/var/www/html/public \
    AUTORUN_ENABLED=false

WORKDIR /var/www/html

USER root
RUN install-php-extensions exif pcntl intl
USER www-data

COPY --chown=www-data:www-data composer.json composer.lock ./
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev --no-scripts

COPY --chown=www-data:www-data . .

USER root
COPY --chmod=755 docker/entrypoint.sh /etc/entrypoint.d/99-laravel-setup.sh
RUN docker-php-serversideup-s6-init
USER www-data

RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

RUN APP_KEY=base64:AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA= \
    php artisan storage:link && \
    php artisan filament:assets
