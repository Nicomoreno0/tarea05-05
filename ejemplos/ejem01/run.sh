#!/usr/bin/env bash
set -euo pipefail

docker rm -f miapache-php >/dev/null 2>&1 || true
docker rmi -f miapache-php >/dev/null 2>&1 || true

docker build -t miapache-php .
docker run -dit --name miapache-php -p 5555:80 --mount type=bind,source="$(pwd)/src",target=/var/www/html miapache-php

echo "Contenedor arrancado en http://localhost:5555"
echo "Para editar dentro del contenedor: docker exec -it miapache-php bash"
echo "Dentro del contenedor: apt-get update && apt-get install -y vim"
echo "Y luego: vi /var/www/html/index.html"

