#!/bin/bash

cd /var/www

php artisan migrate:fresh --seed
php artisan cache:clear
php artisan route:cache
php-fpm





