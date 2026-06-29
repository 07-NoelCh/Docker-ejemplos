#!/bin/bash
# ejem01: construir la imagen y lanzar el contenedor
set -e

IMAGE_NAME="miapache-php"
CONTAINER_NAME="miapache-php"
PORT=5555

echo "Construyendo la imagen ${IMAGE_NAME}..."
docker build -t ${IMAGE_NAME} .

echo "Lanzando el contenedor ${CONTAINER_NAME} en el puerto ${PORT}..."
docker run --rm -d -p ${PORT}:80 --name ${CONTAINER_NAME} ${IMAGE_NAME}

echo ""
echo "Listo. Abre http://localhost:${PORT} en el navegador."
echo "Para editar el index.html con vi dentro del contenedor:"
echo "  docker exec -it ${CONTAINER_NAME} bash"
echo "  vi /var/www/html/index.html"
