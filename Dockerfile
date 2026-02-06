FROM php:8.4-cli


COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
COPY . .

RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    unzip \
    git \
    sqlite3 \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

COPY composer.json composer.lock* ./
RUN composer install --no-scripts --no-autoloader

RUN git config --global --add safe.directory /var/www/html

COPY . .

RUN composer dump-autoload --optimize

RUN chown -R www-data:www-data /var/www/html/Data /var/www/html/public/uploads

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]


