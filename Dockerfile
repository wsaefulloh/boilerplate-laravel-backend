# High-Performance FrankenPHP Dockerfile for Laravel Backend
FROM dunglas/frankenphp:latest-php8.2-alpine

# Set server environment variables
ENV SERVER_NAME=":8000"
ENV CADDY_GLOBAL_OPTIONS="debug"

# Install required PHP extensions
RUN install-php-extensions \
    pdo_mysql \
    pdo_sqlite \
    gd \
    intl \
    zip \
    opcache \
    bcmath

# Set working directory
WORKDIR /app

# Copy application files
COPY . /app

# Optimize Composer Autoloader
RUN composer install --no-interaction --prefer-dist --optimize-autoloader || true

# Set storage and cache permissions
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

EXPOSE 8000

# Start Laravel Octane with FrankenPHP
CMD ["php", "artisan", "octane:start", "--server=frankenphp", "--host=0.0.0.0", "--port=8000"]
