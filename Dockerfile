# syntax=docker/dockerfile:1.5

##############################################
# Base PHP image with required extensions    #
##############################################
FROM php:8.3-fpm-alpine AS base-php

ENV PHP_MEMORY_LIMIT=512M \
    PHP_OPCACHE_VALIDATE_TIMESTAMPS=0 \
    PHP_OPCACHE_REVALIDATE_FREQ=0

# Install system dependencies and PHP extensions
RUN set -eux; \
    apk add --no-cache \
        bash \
        curl \
        fcgi \
        freetype \
        git \
        icu \
        libjpeg-turbo \
        libpng \
        libzip \
        mysql-client \
        oniguruma \
        unzip; \
    apk add --no-cache --virtual .build-deps \
        autoconf \
        build-base \
        freetype-dev \
        icu-dev \
        libjpeg-turbo-dev \
        libpng-dev \
        libzip-dev \
        oniguruma-dev; \
    docker-php-ext-configure gd --with-freetype --with-jpeg; \
    docker-php-ext-install -j"$(nproc)" \
        gd \
        intl \
        mbstring \
        opcache \
        pdo_mysql \
        zip; \
    pecl install redis; \
    docker-php-ext-enable redis; \
    apk del --no-network .build-deps

# Configure PHP and FPM defaults
COPY php/conf/php.ini /usr/local/etc/php/conf.d/zz-musclemind.ini

RUN set -eux; \
    { \
        echo "log_limit = 8192"; \
        echo "emergency_restart_threshold = 10"; \
        echo "emergency_restart_interval = 1m"; \
        echo "process_control_timeout = 10s"; \
        echo "pm.status_path = /fpm-status"; \
        echo "ping.path = /fpm-ping"; \
        echo "ping.response = pong"; \
    } >> /usr/local/etc/php-fpm.d/zz-healthcheck.conf; \
    mkdir -p /app/var; \
    chown -R www-data:www-data /app

WORKDIR /app

##############################################
# Composer dependencies                       #
##############################################
FROM composer:2 AS composer

WORKDIR /app

COPY composer.json composer.lock symfony.lock* ./

RUN --mount=type=cache,target=/tmp/cache/composer \
    composer install \
        --no-dev \
        --prefer-dist \
        --no-progress \
        --no-interaction \
        --classmap-authoritative

##############################################
# Node build for front assets                 #
##############################################
FROM node:20-alpine AS node

WORKDIR /app

COPY package.json package-lock.json* ./
RUN --mount=type=cache,target=/root/.npm \
    npm ci

COPY . ./

ENV NODE_ENV=production
RUN npm run build

##############################################
# Runtime image                               #
##############################################
FROM base-php AS runtime

ENV APP_ENV=prod \
    APP_DEBUG=0

# Copy application source (excluding files from .dockerignore)
COPY --chown=www-data:www-data . ./
COPY --chown=www-data:www-data --from=composer /app/vendor ./vendor
COPY --chown=www-data:www-data --from=node /app/public/build ./public/build
COPY --from=composer /usr/bin/composer /usr/local/bin/composer

RUN set -eux; \
    mkdir -p var/cache var/log var/sessions; \
    chown -R www-data:www-data var; \
    find var -type d -exec chmod 775 {} \; ; \
    find var -type f -exec chmod 664 {} \;

EXPOSE 9000

USER www-data

HEALTHCHECK --interval=30s --timeout=5s --retries=5 --start-period=30s \
    CMD SCRIPT_NAME=/fpm-ping REQUEST_METHOD=GET cgi-fcgi -bind -connect 127.0.0.1:9000 || exit 1

CMD ["php-fpm"]
