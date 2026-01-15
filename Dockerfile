############################
# 1️⃣ Vite build stage
############################
FROM node:20-alpine AS vite-build

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY resources ./resources
COPY vite.config.* ./
RUN npm run build

############################
# 2️⃣ PHP stage
############################
FROM php:8.3-cli

WORKDIR /var/www

# Copy Laravel app
COPY . .

# Copy prebuilt Vite assets
COPY --from=vite-build /app/public/build /var/www/public/build

# Set permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install PHP deps
RUN composer install --no-dev --optimize-autoloader

# Laravel optimizations
RUN php artisan config:clear \
    && php artisan route:clear \
    && php artisan view:clear

# Render Free will automatically run PHP built-in server on $PORT
EXPOSE 8000
CMD ["sh", "-c", "php -S 0.0.0.0:${PORT:-8000} -t public"]
