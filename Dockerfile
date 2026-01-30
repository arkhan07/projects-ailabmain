# =====================================================
# Stage 1 – Build frontend (Vite)
# =====================================================
FROM node:20-alpine AS frontend

WORKDIR /app

COPY package*.json ./
RUN npm ci

COPY resources ./resources
COPY vite.config.js postcss.config.js tailwind.config.js ./

RUN npm run build


# =====================================================
# Stage 2 – PHP 8.2 + Nginx
# =====================================================
FROM php:8.2-fpm

WORKDIR /var/www/html

# system deps
RUN apt-get update && apt-get install -y \
    nginx \
    git curl unzip zip \
    libpng-dev libonig-dev libxml2-dev libzip-dev \
    libfreetype6-dev libjpeg62-turbo-dev \
    default-mysql-client \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
ENV COMPOSER_MEMORY_LIMIT=-1

# nginx
RUN rm -f /etc/nginx/sites-enabled/default
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf

# php config
RUN echo "memory_limit = 512M" > /usr/local/etc/php/conf.d/memory-limit.ini \
 && echo "upload_max_filesize = 100M" > /usr/local/etc/php/conf.d/upload-limit.ini \
 && echo "post_max_size = 100M" >> /usr/local/etc/php/conf.d/upload-limit.ini

# app source
COPY . .

# vite build
COPY --from=frontend /app/public/build public/build

# laravel dirs ONLY (NO COMPOSER HERE)
RUN mkdir -p \
    storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
 && chown -R www-data:www-data /var/www/html \
 && chmod -R 775 storage bootstrap/cache

# entrypoint
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80

ENTRYPOINT ["entrypoint.sh"]
CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]
