# Usar la imagen oficial de PHP con Laravel
FROM php:8.0-fpm

# Instalar dependencias de sistema
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    libpq-dev \
    libssl-dev \
    pkg-config

# Instalar extensiones de PHP
RUN docker-php-ext-install pdo_pgsql pdo_mysql mbstring exif pcntl bcmath gd zip

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Establecer directorio de trabajo
WORKDIR /var/www

# Copiar todos los archivos y directorios al contenedor
COPY . .

# Establecer permisos de directorio para evitar problemas de permisos
RUN chown -R www-data:www-data /var/www
RUN chmod -R 755 /var/www

# Instalar dependencias de PHP
RUN composer install --optimize-autoloader --no-dev

# Exponer el puerto 9000 y ejecutar el servidor PHP
EXPOSE 9000
CMD ["php-fpm"]