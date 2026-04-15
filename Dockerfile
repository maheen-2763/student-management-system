FROM php:8.4-cli

# Install system dependencies + Node.js
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libzip-dev \
    libpq-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    nodejs \
    npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) zip pdo pdo_pgsql gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Install Node dependencies & build Vite assets
RUN npm install && npm run build

# Fix permissions
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

ENV PORT=10000
EXPOSE 10000

CMD ["sh", "-c", "php artisan migrate --force && php -S 0.0.0.0:$PORT -t public"]