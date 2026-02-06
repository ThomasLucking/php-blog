FROM php:8.4-fpm-alpine

RUN apk add --no-cache \
    sqlite-dev \
    unzip \
    git \
    sqlite


RUN docker-php-ext-install pdo pdo_sqlite

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www/html


COPY composer.json composer.lock* ./
RUN composer install --no-scripts --no-autoloader --no-dev --ignore-platform-reqs


COPY . .


RUN composer dump-autoload --optimize

RUN chown -R www-data:www-data /var/www/html/Data /var/www/html/public/uploads


USER www-data

