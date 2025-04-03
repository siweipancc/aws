FROM php:8.2-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    linux-headers \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    libpng-dev \
    libxml2-dev \
    libpq-dev \
    oniguruma-dev

RUN apk add --no-cache \
    autoconf \
    gcc \
    g++ \
    make
# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql pgsql mbstring exif pcntl bcmath gd

# Install Redis extension
RUN pecl install redis && docker-php-ext-enable redis

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy existing application directory contents
COPY . .

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html

# Change current user to www
USER www-data

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
