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
- `database/migrations/*.php`: esquema reproducible.
- `database/seeders/DespachosSeeder.php`: datos de ejemplo para pruebas locales.
- `tests/Feature/*.php`: validan registro y consulta de novedad.

## Comandos útiles (no ejecutar automáticamente)

```bash
composer create-project laravel/laravel backend "11.*"
cd backend
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed --class=DespachosSeeder
php artisan test --filter=RegistrarNovedadTest
php artisan test --filter=ConsultarDespachoTest
```

Configurar en `.env` el canal `slack` en `logging.php` para recibir alertas críticas de novedades (Daño o Cancelación).

