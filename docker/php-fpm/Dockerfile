FROM php:8.3.10-fpm-alpine

# Install packages
RUN apk add --no-cache curl git build-base zlib-dev oniguruma-dev autoconf bash linux-headers

# Install PostgreSQL driver
RUN apk add --no-cache postgresql-dev \
    && docker-php-ext-install pdo_pgsql

# Xdebugg
RUN pecl install xdebug && docker-php-ext-enable xdebug
COPY ./php-fpm/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Configure non-root user.
ARG PUID=1000
ARG PGID=1000
RUN apk --no-cache add shadow && \
    groupmod -o -g ${PGID} www-data && \
    usermod -o -u ${PUID} -g www-data www-data

# Source code
COPY ./ /var/www
WORKDIR /var/www

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
#RUN composer install --no-interaction

CMD php-fpm

EXPOSE 9000
ENV XDEBUG_MODE=debug
ENV XDEBUG_DISCOVER_CLIENT_HOST=1
ENV XDEBUG_START_WITH_REQUEST=yes
ENV XDEBUG_IDEKEY=PHPSTORM
