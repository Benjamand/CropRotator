# 1️⃣ Vite build stage
FROM node:20-alpine AS vite-build
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY resources ./resources
COPY vite.config.* ./
RUN npm run build
# 2️⃣ PHP + Nginx stage
FROM php:8.3-fpm
# System deps
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    unzip \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /var/www
# Copy Laravel app
COPY . .
# Copy prebuilt Vite assets
COPY --from=vite-build /app/public/build /var/www/public/build
# Permissions for Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache
# Composer install
RUN composer install --optimize-autoloader
# Laravel optimizations
RUN php artisan config:clear \
    && php artisan route:clear \
    && php artisan view:clear
# Nginx
COPY docker/nginx.conf /etc/nginx/nginx.conf
# Entrypoint
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
EXPOSE 80
ENTRYPOINT ["/entrypoint.sh"]