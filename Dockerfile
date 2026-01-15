############################
# 1️⃣ Vite build stage
############################
FROM node:20-alpine AS vite-build

WORKDIR /app

# Only copy what Vite needs
COPY package*.json ./
RUN npm install

COPY resources ./resources
COPY vite.config.* ./
RUN npm run build


############################
# 2️⃣ PHP + Nginx stage
############################
FROM php:8.3-fpm

# System deps (NO node here)
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    unzip \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy full Laravel app
COPY . .

# Copy built Vite assets from stage 1
COPY --from=vite-build /app/public/build /var/www/public/build

# PHP deps
RUN composer install --no-dev --optimize-autoloader

# Laravel optimizations
RUN php artisan config:clear \
    && php artisan route:clear \
    && php artisan view:clear

# Nginx config
COPY docker/nginx.conf /etc/nginx/nginx.conf

# Permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage /var/www/bootstrap/cache

# Entrypoint
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 80

ENTRYPOINT ["/entrypoint.sh"]
CMD service nginx start && php-fpm
