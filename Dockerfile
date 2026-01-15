FROM php:8.2-fpm

# ---- System dependencies ----
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    default-mysql-client \
    nginx \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl

# ---- Composer ----
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ---- App setup ----
WORKDIR /var/www

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN php artisan config:clear && php artisan route:clear && php artisan view:clear

# ---- Nginx config ----
COPY ./docker/nginx.conf /etc/nginx/nginx.conf

# ---- Permissions ----
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 80

CMD service nginx start && php-fpm