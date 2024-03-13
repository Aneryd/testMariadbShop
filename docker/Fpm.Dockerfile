FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

RUN docker-php-ext-install mysqli pdo pdo_mysql

WORKDIR /var/www/testMariadbShop

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer