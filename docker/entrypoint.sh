#!/bin/sh
set -e

# Laravel migrations + seeding
php artisan migrate --force
php artisan db:wipe --force
php artisan db:seed --force

# Start services
service nginx start
php-fpm -F
