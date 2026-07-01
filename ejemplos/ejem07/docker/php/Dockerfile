# Imagen de PHP
FROM php:8.2-fpm

# Instalamos los paquetes que necesitamos
RUN apt-get update && apt-get install -y --no-install-recommends libpng-dev libonig-dev libxml2-dev && rm -rf /var/lib/apt/lists/* && docker-php-ext-install mysqli pdo pdo_mysql