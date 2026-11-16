# Clínica Chiclayo — Grupo 7

API REST de triaje desarrollada con Laravel 11, PHP 8.4, MySQL 8.0 y Docker. Permite registrar, listar, consultar, actualizar y eliminar triajes. La API genera la alerta automáticamente según la temperatura registrada.

## Ejecutar el proyecto

Con Docker Desktop abierto, ejecuta estos comandos en PowerShell desde la carpeta del proyecto.

```powershell
Copy-Item .env.example .env
```

Abre `.env` y reemplaza la configuración de base de datos por estas líneas. Cambia `TU_CLAVE_LOCAL` por una contraseña de prueba para tu instalación. Docker Compose usa ese mismo valor al crear la base de datos.

```ini
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=bd_clinica_chiclayo
DB_USERNAME=root
DB_PASSWORD=TU_CLAVE_LOCAL
```

Instala las dependencias y levanta los contenedores.

```powershell
docker run --rm -v "${PWD}:/app" -w /app composer:2 install
docker compose up -d --build
docker compose exec app php artisan key:generate
```

Cuando MySQL termine de iniciar, ejecuta la migración.

```powershell
docker compose exec app php artisan migrate
```

## Rutas de la API

Dirección local `http://localhost:8085`

| Método | Ruta | Operación |
|---|---|---|
| GET | `/api/v1/triaje` | Listar registros |
| POST | `/api/v1/triaje` | Crear un registro |
| GET | `/api/v1/triaje/{id}` | Consultar un registro |
| PUT | `/api/v1/triaje/{id}` | Actualizar un registro |
| DELETE | `/api/v1/triaje/{id}` | Eliminar un registro |

## Alertas por temperatura

| Temperatura | Alerta generada |
|---|---|
| Menor de 36.0 °C | `ALERTA: HIPOTERMIA` |
| De 36.0 °C a 37.5 °C, inclusive | `SIGNOS VITALES NORMALES` |
| Mayor de 37.5 °C | `ALERTA: FIEBRE / DERIVAR` |

## Pruebas en Postman

Importa `Clinica_Chiclayo_Grupo7.postman_collection.json` y configura `base_url` con `http://localhost:8085`. Usa datos ficticios para la demostración.

La colección incluye 10 solicitudes para probar el CRUD, las tres alertas, los límites de 36.0 °C y 37.5 °C, la validación de datos (`422`) y la consulta de un registro eliminado (`404`).

Para repetir la demostración, copia el `id` que devuelve el `POST` de hipotermia y guárdalo en la variable `id_triaje`. Usa ese mismo ID para consultar, actualizar, eliminar y comprobar el `404`.

Proyecto académico para demostración local. La versión de Laravel 11 utilizada presenta alertas conocidas de seguridad.