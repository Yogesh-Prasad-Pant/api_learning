FROM php:8.3-fpm-alpine

# Install system dependencies & Postgres extensions
RUN apk add --no-cache unzip nodejs npm postgresql-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy code
COPY . .

# Run production configurations
RUN composer install --no-dev --optimize-autoloader

EXPOSE 8000

CMD php artisan migrate: --force && php artisan serve --host=0.0.0.0 --port=8000