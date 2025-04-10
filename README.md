# Clinica

¡Bienvenido al repositorio del proyecto web Clinica! Aquí encontrarás toda la información y recursos necesarios para empezar con el despliegue y desarrollo.

## 🚀 Pasos iniciales para el despliegue

Si es la primera vez que despliegas este proyecto en un servidor o deseas ejecutarlo en tu entorno local después de clonarlo, sigue estos pasos:

1. 📦 Instalar dependencias PHP: `composer install`.
2. 📦 Instalar dependencias Node/JS: `npm install`.
3. 📦 Generar .env: `cp .env.example .env`.

## Configurar migraciones y base de datos

Primero que nada, necesitas reemplazar esto en tu .env:

1. DB_CONNECTION=mysql
2. DB_HOST=127.0.0.1
3. DB_PORT=3307
4. DB_DATABASE=ingsoftdb
5. DB_USERNAME=root
6. DB_PASSWORD=root

7. SESSION_DRIVER=cookie

Luego configuramos Docker

1. Ejecutar docker: `docker compose up -d`.

2. 📖 Ejecutar migraciones: `php artisan migrate:refresh`.

3. Generar clave de la aplicacion: `php artisan key:generate`.

4. Para finalizar generamos la clave JWT: `php artisan jwt:secret`.

5. Limpiar cache de la app: `php artisan config:clear`.

## 🏠 ¿Cómo correr el proyecto en mi entorno local?

Para arrancar el proyecto en tu entorno local, ejecuta los siguientes comandos:

1. 🌐 `php artisan serve` - Para levantar el servidor de Laravel.

Una vez ejecutados ambos comandos, puedes acceder al proyecto a través de la URL `http://127.0.0.1:8000/` o `http://localhost:8000/`.

## ⚙️ Comandos útiles

1. 🔄 Resetear base de datos y ejecutar seeder: `php artisan migrate:refresh --seed`.
2. 🧠 Utilizar Laravel Tinker: `php artisan tinker`.
3. 📍 Ejecutar un seeder especifico: `php artisan db:seed --class=NombreClaseSeeder`.

## 👥 Ayudantes

👤 **David Alvarez**

-   💼 _FullStack Developer_
-   📧 [Email](mailto:david.alvarez@alumnos.ucn.cl)
-   🌐 [LinkedIn](https://www.linkedin.com/in/deiviid/) | [Personal Website](http://www.deiviid.com)

👤 **Renato Morales**

-   💼 _FullStack Developer_
-   📧 [Email](mailto:rento.morales@alumnos.ucn.cl)
