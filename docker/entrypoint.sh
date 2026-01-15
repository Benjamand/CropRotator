#!/bin/sh
set -e

# Only migrate in production if needed
php artisan migrate --force || true
php artisan db:seed --force

# Start PHP-FPM and Nginx
php-fpm -D
nginx -g "daemon off;"

exec "$@"
