# ApiSistemadeComisiones

## Instalamos los paquetes de composer con este comando
- composer install
## Configurar las variables de entorno

- Al archivo .env.example le borras el .example
- Configura los datos de conexión a la base de datos Mysql
- Generamos la key con este comando: <b>php artisan key:generate</b>
- Generamos la key Json Web Token con este comando: <b>php artisan jwt:secret</b>
- Ponemos esta variable de entorno para el guardado de archivos <b>RUTA_SERVER=http://localhost:8000/storage/</b>

## Realizamos las migraciones con este comando

- php artisan migrate --path=/database/migrations/locales/
- php artisan migrate
- php artisan migrate --path=/database/migrations/productos/
- php artisan migrate --path=/database/migrations/trabajadores/
