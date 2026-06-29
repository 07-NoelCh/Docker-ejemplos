FROM php:8.2-apache

# Instala editores de texto dentro del contenedor (vi/vim y nano)
RUN apt-get update && \
    apt-get install -y vim nano && \
    rm -rf /var/lib/apt/lists/*

# Copia el index.html de ejemplo al directorio publico de apache
COPY index.html /var/www/html/index.html

EXPOSE 80
