#!/usr/bin/env bash

cd /var/www/html

php composer.phar install
cp .env.example .env
php artisan key:generate
chmod -R a+w storage/ bootstrap/cache
php composer.phar dump-autoload
php artisan migrate --seed
APP_ENV=testing php artisan migrate

npm install
