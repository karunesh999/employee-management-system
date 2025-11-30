# Use official PHP image with required extensions
FROM php:8.2-fpm

# Install system dependencies + pgsql dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    zip \
    unzip \
    git \
    curl

# Install PHP extensions (pgsql instead of mysql)
RUN docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expose port
EXPOSE 8000

# AUTO-MIGRATE + SEED + START SERVER
CMD php artisan migrate --force && \
    php artisan db:seed --class=AdminSeeder && \
    php artisan serve --host=0.0.0.0 --port=8000
