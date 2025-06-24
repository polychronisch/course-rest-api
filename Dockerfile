FROM php:8.2-fpm

# Install system dependencies and PHP extensions needed by Laravel
RUN apt-get update && apt-get install -y \
    git \
    curl \
    && docker-php-ext-install pdo_mysql mbstring zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer (copy from official Composer image)
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install PHP dependencies via Composer
RUN composer install --no-interaction --optimize-autoloader

# Expose port 8000 for Laravel development server
EXPOSE 8000

# Start Laravel dev server on container start
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
