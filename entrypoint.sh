#!/bin/sh
set -e

# ensure env
if [ ! -f .env ]; then
  cp .env.example .env
fi

# install deps at runtime (env SUDAH ADA)
if [ ! -d vendor ]; then
  composer install --no-dev --optimize-autoloader
fi

php artisan key:generate --force || true
php artisan storage:link || true
php artisan migrate --force || true
php artisan config:clear
php artisan config:cache
php artisan route:cache || true
php artisan view:cache || true

exec "$@"
