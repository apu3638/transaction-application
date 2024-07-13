# Use the official PHP 7.1 FPM with Alpine base image
FROM php:7.4-fpm-alpine as php

MAINTAINER Nurul Amin Limon <limonfpi408@gmail.com>

# Set environment variables for the container
ENV COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_HOME=/composer

# Install system dependencies
RUN apk update && apk add --no-cache \
    build-base \
    shadow \
    curl \
    git \
    bash \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    freetype-dev \
    libzip-dev \
    zlib-dev \
    icu-dev \
    oniguruma-dev \
    nodejs \
    npm

# Install PHP extensions
RUN  docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo pdo_mysql zip bcmath intl mbstring

# Install Composer globally
COPY --from=composer:2.2.21 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy existing application directory contents
COPY . /var/www/html

# Copy existing application directory permissionsl
COPY --chown=www-data:www-data . /var/www/html


# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]

# Instructions for the default Laravel 6 Docker setup
# The following section is optional and typically used for local development.
# It includes a default nginx configuration for Laravel.
# Uncomment if you need nginx as part of your Docker setup.

# Use the official Nginx stable image
# FROM nginx:alpine
# COPY . /var/www
# COPY .docker/nginx/nginx.conf /etc/nginx/nginx.conf
# EXPOSE 80
# CMD ["nginx", "-g", "daemon off;"]
