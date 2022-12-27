#!/bin/bash

cd /var/www

php artisan migrate:fresh --seed
php artisan optimize
php artisan config:cache
php artisan cache:clear
php artisan route:cache
php artisan view:cache
php artisan view:clear
php-fpm





