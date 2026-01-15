FROM php:8.3-cli

WORKDIR /var/www

# Install PHP extensions needed for Laravel & Composer
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Copy Composer binary
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy Laravel app INCLUDING prebuilt assets in public/build
COPY . .

# Set permissions for storage & cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Laravel optimizations
RUN php artisan config:clear \
    && php artisan route:clear \
    && php artisan view:clear

# Expose default port for Render
EXPOSE 8000

# Run PHP built-in server
CMD ["sh", "-c", "php -S 0.0.0.0:${PORT:-8000} -t public"]
