# Actividad DAD - Docker (ejem01, ejem02, ejem03)

Fecha: 05/05/2026

Resumen: ejercicios para practicar edicion dentro de un contenedor Docker, uso de
editores (vi/vim), y uso de VS Code Remote Explorer.

## Estructura

```
actividad_dad/
├── ejem01/
│   ├── Dockerfile      # PHP 8.2 + apache, incluye vim/nano
│   ├── index.html      # pagina de ejemplo a editar
│   └── run.sh           # construye y lanza el contenedor
├── ejem02/
│   ├── Dockerfile
│   ├── index.html
│   └── run_ejem02.sh    # construye, lanza y entra a editar con vi
├── ejem03/
│   ├── Dockerfile
│   ├── index.html
│   └── run_ejem03.sh    # construye, lanza y verifica PHP/Apache dentro
└── screens/              # coloca aqui tus capturas de pantalla
```

## Instrucciones rapidas

### ejem01 - Construir y lanzar la imagen

```bash
cd ejem01
sh run.sh
```

Esto construye la imagen `miapache-php` y la lanza en http://localhost:5555

### ejem01 - Entrar al contenedor y editar con vi/vim

```bash
# listar contenedores
docker ps

# entrar al contenedor
docker exec -it miapache-php bash

# dentro del contenedor: actualizar apt y, si hace falta, instalar vim
apt-get update
apt-get install -y vim

# editar con vi
vi /var/www/html/index.html
# i para insertar, ESC y luego :wq para guardar y salir
```

### ejem02 - Construir, lanzar y editar (script automatico)

```bash
cd ejem02
sh run_ejem02.sh
```

El script construye la imagen, la lanza en el puerto 5555 y abre directamente
`vi` dentro del contenedor sobre `index.html`.

### Editar desde VS Code (Remote Explorer)

- Instala la extension "Dev Containers" / "Remote Explorer" para conectar a Docker.
- Si al abrir el contenedor aparece un error relacionado con GLIBC (por usar una
  imagen vieja, por ejemplo PHP 7.0), usa una imagen reciente como `php:8.2-apache`
  (ya configurada en estos Dockerfiles) y reconstruye:

```bash
docker build -t miapache-php .
docker run --rm -d -p 5555:80 --name miapache-php miapache-php
```

### ejem03 - Construir, lanzar y verificar

```bash
cd ejem03
sh run_ejem03.sh
```

El script construye la imagen, la lanza en el puerto 5555 y muestra la version
de PHP y Apache dentro del contenedor para confirmar que todo funciona.

## Capturas y README

- Toma capturas de pantalla de: la edicion con vi dentro del contenedor, y del
  despliegue en Docker (puerto 5555).
- Guarda las imagenes en `screens/` (por ejemplo `screens/vi-edit.png`,
  `screens/docker-run.png`) y referencialas en este README.

## Notas de resolucion de errores

- Si aparece un error de GLIBC al intentar conectar o ejecutar binarios, la causa
  suele ser incompatibilidad entre librerias del host/imagen. La solucion mas
  practica para este ejercicio es usar una imagen oficial reciente:
  `php:8.2-apache`.
