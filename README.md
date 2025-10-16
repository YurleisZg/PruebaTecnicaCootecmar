
# Proyecto Laravel - Vue3

Este proyecto es una aplicación web desarrollada en **Laravel 12**, usando **Inertia.js** y **SQLite** como base de datos. Permite gestionar usuarios con autenticación, registro y operaciones CRUD.

---

## 🛠 Requisitos

Antes de empezar, asegúrate de tener instaladas las siguientes herramientas:

- PHP >= 8.3  
- Composer  
- Node.js >= 20  
- NPM o Yarn  
- SQLite (incluido en PHP, normalmente)


## 1️⃣ Clonar el proyecto

```bash
git clone https://github.com/YurleisZg/PruebaTecnicaCootecmar.git
cd PruebaTecnicaCootecmar




##2️⃣ Instalar dependencias

PHP

composer install

JavaScript

npm install
# o si usas yarn
yarn


---

## 3️⃣ Configurar entorno

1. Crear el archivo .env:

cp .env.example .env

2. Configurar SQLite en .env:

DB_CONNECTION=sqlite
DB_DATABASE=/ruta/a/tu/proyecto/database/database.sqlite

> Crear el archivo SQLite si no existe:



touch database/database.sqlite

3. Generar clave de la aplicación:



php artisan key:generate


---

## 4️⃣ Migraciones y Seeders

Ejecutar migraciones y cargar datos de prueba:

php artisan migrate --seed

> Esto creará todas las tablas necesarias y cargará datos iniciales.




---

## 5️⃣ Ejecutar la aplicación

Iniciar el servidor de desarrollo:

php artisan serve

> Por defecto estará disponible en http://127.0.0.1:8000




---

## 6️⃣ Comandos útiles

Limpiar y reiniciar la base de datos:


php artisan migrate:fresh --seed

Compilar assets (desarrollo):


npm run dev
# o yarn dev

Compilar assets (producción):


npm run build
# o yarn build

Ejecutar tests:


php artisan test


---

## 7️⃣ Notas importantes

La autenticación usa Inertia.js, por lo que los formularios POST deben ser manejados con form.post('/login').

Solo se guardan name y password en la tabla users.

Si cambias de base de datos, actualiza .env y ejecuta migraciones.

Asegúrate de que database.sqlite sea escribible:


chmod 777 database/database.sqlite


---

## 8️⃣ Estructura del proyecto

app/Models/User.php → Modelo de usuario

app/Http/Controllers/AuthController.php → Controlador de autenticación

app/Http/Controllers/Records/FormController.php → Controlador de CRUD

database/migrations/ → Migraciones de la base de datos

resources/js/Pages/ → Vistas de Inertia/Vue

routes/web.php → Rutas web



