# Gunakan FrankenPHP image berbasis ARM64
FROM dunglas/frankenphp:latest-php8.2-arm64

# Install dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    && docker-php-ext-install pdo pdo_mysql

# Set working dir
WORKDIR /app

# Salin semua file ke container
COPY . /app

# Install composer dependencies
RUN curl -sS https://getcomposer.org/installer | php && \
    php composer.phar install --no-dev --optimize-autoloader

# Set permission
RUN chown -R www-data:www-data /app && chmod -R 775 /app/storage

# Gunakan frankenphp config
COPY frankenphp.ini /etc/php/8.2/fpm/conf.d/99-frankenphp.ini

# Expose port FrankenPHP
EXPOSE 80

# Jalankan FrankenPHP server
CMD ["frankenphp", "--document-root", "public"]
