[README.md](https://github.com/user-attachments/files/29476436/README.md)
# Actividad DAD - Docker (ejem01, ejem02, ejem03,ejem07,ejem09)



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

# Docker Tutorial — Ejemplos 7 y 9

## Ejemplo 7 — PHP + MySQL + PHPMyAdmin

### Consigna
- PHPMyAdmin corriendo en LocalHost
- Creación de Tabla en MySQL
- index.php corriendo en LocalHost
- Con mejor estilo visual

### Descripción

Se levanta un entorno completo con tres servicios usando Docker Compose:

- **MySQL** como base de datos
- **PHPMyAdmin** como interfaz visual para administrar la base de datos
- **PHP/Apache** para servir la aplicación web

El `index.php` se conecta a MySQL, crea automáticamente la tabla `usuarios` si no existe, inserta un registro de ejemplo y muestra los datos en pantalla con un diseño visual moderno.

### Estructura

```
ejem7/
├── docker-compose.yml
├── README.md
└── www/
    └── index.php
```

### Servicios y puertos

| Servicio   | Puerto local   | Descripción                         |
|------------|----------------|-------------------------------------|
| PHP/Apache | localhost:8000 | Aplicación web conectada a MySQL    |
| PHPMyAdmin | localhost:8080 | Interfaz visual para la base datos  |
| MySQL      | localhost:3306 | Base de datos relacional            |

### Credenciales

| Campo    | Valor      |
|----------|------------|
| Root     | `rootpass` |
| Usuario  | `usuario`  |
| Password | `userpass` |
| Base     | `mi_base`  |

### Cómo levantar

```bash
cd ejem7
docker-compose up -d
```

### Accesos

- App PHP → http://localhost:8000
- PHPMyAdmin → http://localhost:8080

### Vista previa

Al abrir `localhost:8000` se verá una tabla con los usuarios almacenados en MySQL, con diseño oscuro moderno.  
Al abrir `localhost:8080` se podrá administrar la base de datos visualmente desde PHPMyAdmin.

---

## Ejemplo 9 — Multi-Site con Nginx

### Consigna
- Site 1 Lanzado
- Site 2 Lanzado

### Descripción

Se levantan dos sitios web estáticos de forma simultánea, cada uno corriendo en su propio contenedor Nginx independiente, gestionados juntos con Docker Compose.

Cada contenedor expone un puerto distinto en el host, permitiendo acceder a ambos sitios al mismo tiempo desde el navegador.

### Estructura

```
ejem9/
├── docker-compose.yml
├── README.md
├── site1/
│   └── index.html
└── site2/
    └── index.html
```

### Servicios y puertos

| Servicio | Puerto local   | Descripción                     |
|----------|----------------|---------------------------------|
| Site 1   | localhost:8001 | Primer sitio servido por Nginx  |
| Site 2   | localhost:8002 | Segundo sitio servido por Nginx |

### Cómo levantar

```bash
cd ejem9
docker-compose up -d
```

### Accesos

- Site 1 → http://localhost:8001
- Site 2 → http://localhost:8002

### Vista previa

Cada sitio tiene su propio diseño visual. Ambos se sirven de forma independiente y simultánea desde contenedores distintos.

---

## Comandos útiles

```bash
# Ver contenedores corriendo
docker ps

# Detener todos los servicios
docker-compose down

# Ver logs de un servicio
docker-compose logs -f <nombre_servicio>

# Reconstruir y levantar
docker-compose up -d --build
```









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
