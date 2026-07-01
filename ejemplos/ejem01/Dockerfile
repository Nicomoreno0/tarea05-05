# Imagen a usar
FROM php:8.2-apache

# Instalamos un editor de texto para trabajar dentro del contenedor
RUN apt-get update && apt-get install -y --no-install-recommends vim && rm -rf /var/lib/apt/lists/*

# Copiamos todos los ficheros al directorio web
COPY src/ /var/www/html

# Exponemos el puerto 80
EXPOSE 80

# Quien lo ha realizado
LABEL maintainer="JL Gonzalez <jlgs@cifpvirgendegracia.com>"
