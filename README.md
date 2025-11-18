# Plataforma de Financiamiento Social - Crowdfunding

## Descripción del Proyecto

El contexto de la aplicación es una Plataforma de Financiamiento Social (Crowdfunding) construida con Laravel. Sus roles clave son:
*   **Emprendedor**: Publica proyectos que buscan financiamiento.
*   **Donante**: Financia los proyectos que le interesan.
*   **Administrador**: Gestiona el sistema, las categorías de los proyectos y aprueba los proyectos enviados por los emprendedores.

## Especificaciones del Proyecto

*   **Backend**: Laravel
*   **Frontend**: Blade, Vite, Bootstrap, Sass
*   **Base de Datos**: Compatible con MySQL, MariaDB, PostgreSQL, etc. (configurable en `.env`).
*   **Servidor de Desarrollo**: Se recomienda Laragon, pero es compatible con cualquier entorno que soporte PHP y Node.js.

## Replicación y Puesta en Marcha

Siga estos pasos para instalar y ejecutar el proyecto en su entorno de desarrollo local.

### Requisitos Previos

*   PHP >= 8.2 (o la versión especificada en `composer.json`)
*   Composer
*   Node.js y npm
*   Un servidor de base de datos (ej. MySQL)
*   Un entorno de desarrollo como Laragon, XAMPP, o similar.

### Pasos de Instalación

1.  **Clonar el repositorio:**
    ```bash
    git clone <URL_DEL_REPOSITORIO>
    cd Laragon-lp3
    ```

2.  **Instalar dependencias de PHP:**
    ```bash
    composer install
    ```

3.  **Instalar dependencias de Node.js:**
    ```bash
    npm install
    ```

4.  **Crear el archivo de entorno:**
    Copie el archivo de ejemplo `.env.example` y renómbrelo a `.env`.
    ```bash
    cp .env.example .env
    ```

5.  **Configurar la base de datos:**
    Abra el archivo `.env` y configure los parámetros de conexión a su base de datos (nombre de la base de datos, usuario, contraseña).
    ```ini
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nombre_de_tu_bd
    DB_USERNAME=tu_usuario_bd
    DB_PASSWORD=tu_contraseña_bd
    ```
    **Importante:** Asegúrese de que la base de datos (`nombre_de_tu_bd`) exista en su gestor de bases de datos.

6.  **Generar la clave de la aplicación:**
    Este comando es crucial para la seguridad de la aplicación.
    ```bash
    php artisan key:generate
    ```

7.  **Ejecutar las migraciones:**
    Esto creará la estructura de tablas en su base de datos.
    ```bash
    php artisan migrate
    ```

8.  **(Opcional) Ejecutar los seeders:**
    Si el proyecto tiene seeders для poblar la base de datos con datos de prueba, ejecútelos.
    ```bash
    php artisan db:seed
    ```

### Ejecución de la Aplicación

Para iniciar el servidor de desarrollo y el compilador de assets de Vite, puede usar el comando unificado `npm run start`.

1.  **Iniciar el servidor:**
    ```bash
    npm run start
    ```
    Este comando ejecutará `php artisan serve` y `npm run dev` simultáneamente. La aplicación estará disponible en la dirección que indique `php artisan serve` (normalmente `http://122.0.0.1:8000`).

¡Con esto, el proyecto debería estar funcionando en su máquina local!