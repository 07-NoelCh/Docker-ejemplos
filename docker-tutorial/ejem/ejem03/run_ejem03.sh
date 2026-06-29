#!/bin/bash
# ejem03: lanzar el contenedor y ejecutar una tarea de verificacion dentro de el
set -e

IMAGE_NAME="miapache-php"
CONTAINER_NAME="miapache-php"
PORT=5555

echo "Construyendo la imagen ${IMAGE_NAME}..."
docker build -t ${IMAGE_NAME} .

echo "Lanzando el contenedor ${CONTAINER_NAME} en el puerto ${PORT}..."
docker run --rm -d -p ${PORT}:80 --name ${CONTAINER_NAME} ${IMAGE_NAME}

echo ""
echo "Verificando version de PHP y Apache dentro del contenedor..."
docker exec ${CONTAINER_NAME} php -v
docker exec ${CONTAINER_NAME} apache2 -v

echo ""
echo "Contenedor listo en http://localhost:${PORT}"
echo "Puedes conectarte desde VS Code -> Remote Explorer -> Containers -> ${CONTAINER_NAME}"
