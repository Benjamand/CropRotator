#!/bin/sh

set -e

php artisan key:generate --force || true
php artisan migrate --force

php-fpm -D
nginx -g "daemon off;"

exec "$@"
