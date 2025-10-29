# Módulo Backend - Gestión de Despachos

## Introducción

Solución basada en Laravel 11 diseñada para registrar novedades de despachos y consultar su estado con trazabilidad. El módulo sigue una arquitectura por capas (Controladores → Servicios → Repositorios → Modelos) y utiliza DTOs, Form Requests, Resources y pruebas feature.

## Estructura relevante

- `app/Enums/TipoNovedadEnum.php`: catálogo permitido de tipos de novedad.
- `app/DTOs/RegistrarNovedadDTO.php`: transferencia inmutable de datos entre capas.
- `app/Servicios/GestionDespachosServicio.php`: orquestación de reglas de negocio.
- `app/Repositorios/*`: encapsulan el acceso a Eloquent.
- `app/Http/Requests/Despacho/RegistrarNovedadRequest.php`: validaciones de entrada.
- `app/Http/Resources/*`: serialización consistente de respuestas.
- `app/Events/NovedadCriticaRegistrada.php` y `app/Listeners/EnviarAlertaNovedadCritica.php`: alertas automáticas ante novedades críticas.
- `app/Mail/AlertaNovedadCriticaMailable.php` y `resources/views/emails/alerta_novedad_critica.blade.php`: plantilla de correo operativo.
- `app/Enums/EstadoDespachoEnum.php` y `app/Models/HistorialEstadoDespacho.php`: catálogo de estados y persistencia del historial de cambios.
- `database/migrations/*.php`: esquema reproducible.
- `database/seeders/DespachosSeeder.php`: datos de ejemplo para pruebas locales.
- `tests/Feature/*.php`: validan registro y consulta de novedad.

La configuración por defecto utiliza SQLite (archivo `database/database.sqlite`) para facilitar la ejecución de pruebas rápidas; puedes ajustar `DB_CONNECTION` en `.env` si prefieres otro motor.

## Configuración de alertas críticas

Define en `.env` la variable `ALERTAS_OPERACIONES_EMAIL` (ver `backend/.env.example`) para indicar el correo del área de operaciones. Se añadió el archivo `config/alertas.php` para centralizar esta configuración.

## Comandos útiles (no ejecutar automáticamente)

```bash
cd backend
composer install
cp .env.example .env
touch database/database.sqlite # crea el archivo para SQLite local
php artisan key:generate
php artisan migrate
php artisan db:seed --class=DespachosSeeder
php artisan test --filter=RegistrarNovedadTest
php artisan test --filter=ConsultarDespachoTest
php artisan test --filter=AlertasCriticasTest
php artisan test --filter=ActualizarEstadoDespachoTest
```

Configurar en `.env` el canal `slack` en `logging.php` para recibir alertas críticas de novedades (Daño o Cancelación).

