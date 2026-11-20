# ==============================================================================
# Stage 1: Build Frontend Assets (Vite)
# ==============================================================================
FROM node:20-alpine AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm ci --prefer-offline --no-audit || npm install
COPY vite.config.js ./
COPY resources/ ./resources/
COPY public/ ./public/
RUN npm run build

# ==============================================================================
# Stage 2: Production PHP 8.2-FPM Runtime
# ==============================================================================
FROM php:8.2-fpm-alpine

# Set Working Directory
WORKDIR /var/www

# Install System Dependencies & Build Tools
RUN apk add --no-cache \
    bash \
    curl \
    git \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    libxml2-dev \
    oniguruma-dev \
    mariadb-client \
    shadow

# Configure and Install PHP Extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
        opcache

# Copy Composer from Official Image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy Custom PHP & Opcache Configuration
COPY docker/php/custom.ini /usr/local/etc/php/conf.d/custom.ini
COPY docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

# Copy Application Source Code
COPY . /var/www

# Copy Compiled Frontend Assets from Stage 1
COPY --from=frontend /app/public/build /var/www/public/build

# Set permissions and install Composer production dependencies
RUN mkdir -p /var/www/resources/views/vendor/laravelpwa \
    && chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache \
    && su www-data -s /bin/sh -c "composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist"

# Expose PHP-FPM Port
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
