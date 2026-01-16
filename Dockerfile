FROM php:8.2-apache

# Install necessary PHP extensions for WordPress
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd mysqli zip pdo pdo_mysql opcache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set the working directory
WORKDIR /var/www/html

# Copy the WordPress files from app/public into the container
COPY app/public/ .

# Set permissions for WordPress
RUN chown -R www-data:www-data /var/www/html

# Expose port 80 (Railway will map this to a public URL)
EXPOSE 80

# Use the default production configuration for PHP
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Start Apache in the foreground
CMD ["apache2-foreground"]
