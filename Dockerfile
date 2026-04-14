FROM php:8.4-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libzip-dev \
    libpq-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) zip pdo pdo_pgsql gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy project files
COPY . .

# Install dependencies (no-interaction is key for CI/CD)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Set permissions for Laravel (Essential for Render)
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

# Render uses port 10000 by default, but we'll use an ENV to be safe
ENV PORT=10000
EXPOSE 10000

# Start server using the environment variable
CMD ["sh", "-c", "php -S 0.0.0.0:$PORT -t public"]