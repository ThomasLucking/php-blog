FROM php:8.4-fpm-alpine AS php-server

USER root


RUN apk add --no-cache \
    sqlite-dev \
    sqlite-libs \
    autoconf \
    g++ \
    make \
    npm \
    nodejs 

RUN docker-php-ext-install pdo pdo_sqlite

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www/html


COPY composer.json composer.lock* ./
COPY package.json package-lock.json ./
RUN composer install --no-scripts --no-autoloader --no-dev


COPY . .


RUN composer dump-autoload --optimize

RUN chown -R www-data:www-data /var/www/html/Data /var/www/html/public/uploads

RUN sqlite3 Data/database.db < public/schema.sql

RUN npm run build

RUN chmod -R 775 /var/www/html/Data && chown -R www-data:www-data /var/www/html/Data

RUN chmod -R 775 /var/www/html/public/uploads

FROM nginx:alpine AS nginx-server

WORKDIR /var/www/html

COPY --from=php-server /var/www/html/public /var/www/html/public

RUN chown -R nginx:nginx /var/www/html/public


