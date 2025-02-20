# Proyecto Laravel

Este es un proyecto base desarrollado en Laravel, un framework de PHP que facilita la creación de aplicaciones web modernas y escalables. A continuación, encontrarás las instrucciones necesarias para configurar y ejecutar el proyecto en tu entorno local.

## Instalar Laravel

Para instalar Laravel y todas las dependencias necesarias, sigue estos pasos:

1. Clona el repositorio en tu máquina local:
   ```bash
   git clone https://github.com/obarreraf/prueba-t-full-circle-laravel.git
   ```
2. Accede a la carpeta
    ```bash
    cd tu-repositorio
    ```
3. Instala las librerias
    ```bash 
    composer install
    ```
4. Copia y renombra el archivo .evn.example
   ```bash 
    cp .env.example .env
    ```
5. Genera la key
   ```bash 
    php artisan key:generate
    ```
6. Ejecuta las migraciones y los seeders
    ```bash
    php artisan migrate --seed
    ```
## Inicia el servidor
    En mi caso rescomiendo laravel [sail](https://laravel.com/docs/11.x/sail), el cuál ya está incluido en el composer.json
   ```bash 
   ./vendor/bin/sail up -d
   ```
   Esto generará las imaganes necesarias y podrás acceder a el proyecto:

   ```bash
   http://localhost
   ```

## Acceder a Swagger
    Se acceder por medio de esta url:
    ```bash
    http://localhost/api/documentation
    ```

    Aqui podrás hacer uso de los endpoints

## Ejecuta pruebas unitarias
    ```bash
    ./vendor/bin/sail artisan test
    ```