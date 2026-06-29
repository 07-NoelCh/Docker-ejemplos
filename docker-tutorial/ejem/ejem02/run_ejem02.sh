#!/bin/bash
# ejem02: construir y lanzar la imagen, y editar index.html con vi/vim dentro del contenedor
set -e

IMAGE_NAME="miapache-php"
CONTAINER_NAME="miapache-php"
PORT=5555

echo "Construyendo la imagen ${IMAGE_NAME}..."
docker build -t ${IMAGE_NAME} .

echo "Lanzando el contenedor ${CONTAINER_NAME} en el puerto ${PORT}..."
docker run --rm -d -p ${PORT}:80 --name ${CONTAINER_NAME} ${IMAGE_NAME}

echo ""
echo "Contenedor listo en http://localhost:${PORT}"
echo "Entrando al contenedor para editar index.html con vi..."
echo "(presiona i para insertar, ESC y luego :wq para guardar y salir)"
docker exec -it ${CONTAINER_NAME} vi /var/www/html/index.html

echo ""
echo "Tip: tambien puedes conectarte desde VS Code -> Remote Explorer -> Containers -> ${CONTAINER_NAME}"
