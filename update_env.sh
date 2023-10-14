#!/bin/bash

composer dump-autoload
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan config:cache
php artisan migrate