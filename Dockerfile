FROM php:8.2-apache

# Instala extensiones necesarias
RUN apt-get update && apt-get install -y \
    zip unzip git curl libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo_mysql zip

# Habilita Apache Rewrite
RUN a2enmod rewrite
RUN echo "DirectoryIndex index.php" >> /etc/apache2/apache2.conf

# Copia el código
COPY . /var/www

# Establece directorio de trabajo
WORKDIR /var/www

RUN mv /var/www/public /var/www/html

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instala dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage