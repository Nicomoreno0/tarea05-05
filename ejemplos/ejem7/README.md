# Ejemplo 7 - Docker Compose con MySQL, PHPMyAdmin y PHP

## Descripción
Este ejemplo levanta un entorno completo con tres servicios usando Docker Compose:

- **MySQL** como base de datos relacional
- **PHPMyAdmin** como interfaz visual para administrar la base de datos
- **PHP/Apache** para servir la aplicación web

El `index.php` se conecta a MySQL, crea automáticamente la tabla `usuarios` si no existe, inserta registros de ejemplo y muestra los datos en pantalla con un diseño visual moderno.

## Estructura
```
ejem7/
├── docker-compose.yml
├── Dockerfile
├── README.md
└── www/
    └── index.php
```

## Servicios y puertos

| Servicio | Puerto local | Descripción |
|----------|-------------|-------------|
| PHP/Apache | localhost:8000 | Aplicación web conectada a MySQL |
| PHPMyAdmin | localhost:8081 | Interfaz visual para la base de datos |
| MySQL | localhost:3306 | Base de datos relacional |

## Credenciales

| Campo | Valor |
|-------|-------|
| Root | rootpass |
| Usuario | usuario |
| Password | userpass |
| Base de datos | mi_base |

## Cómo levantar el entorno

```bash
cd ejem7
docker-compose up -d --build
```

## Accesos

- **App PHP** → http://localhost:8000
- **PHPMyAdmin** → http://localhost:8081

## Funcionalidades

- ✅ Conexión automática a MySQL desde PHP
- ✅ Creación automática de tabla `usuarios`
- ✅ Inserción de datos de ejemplo
- ✅ Visualización de datos con diseño moderno
- ✅ PHPMyAdmin para administración visual
