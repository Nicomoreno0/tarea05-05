#!/usr/bin/env bash
set -euo pipefail

mkdir -p wordpress

docker network inspect mi-network >/dev/null 2>&1 || docker network create mi-network

docker rm -f wordpress-db wordpress >/dev/null 2>&1 || true

docker run -d --name wordpress-db \
    --network mi-network \
    --mount source=wordpress-db,target=/var/lib/mysql \
    -e MYSQL_ROOT_PASSWORD=secret \
    -e MYSQL_DATABASE=wordpress \
    -e MYSQL_USER=manager \
    -e MYSQL_PASSWORD=secret \
    mariadb:10.11

docker run -d --name wordpress \
    --network mi-network \
    --mount type=bind,source="$(pwd)"/wordpress,target=/var/www/html \
    -e WORDPRESS_DB_HOST=wordpress-db:3306 \
    -e WORDPRESS_DB_USER=manager \
    -e WORDPRESS_DB_PASSWORD=secret \
    -p 8080:80 \
    wordpress:6.4.2

echo "WordPress disponible en http://localhost:8080"
echo "Nota: este script es útil para Linux/macOS, pero en Windows conviene usar Git Bash o WSL para evitar diferencias de shell."

