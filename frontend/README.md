# Módulo Frontend - Seguimiento de Despachos

Aplicación Angular 18 que consume la API de despachos para registrar novedades y visualizar el detalle de cada despacho. El módulo utiliza servicios centralizados (`DespachosFachadaService`) para aislar la lógica de datos y componentes presentacionales para mantener la vista simple.

## Estructura relevante

- `src/app/core/modelos`: contratos TypeScript reutilizables.
- `src/app/core/servicios/despachos-api.service.ts`: comunicación HTTP con la API.
- `src/app/core/servicios/despachos-fachada.service.ts`: estado compartido, errores y orquestación.
- `src/app/modulos/despachos`: módulo funcional con componentes y routing lazily loadable.
- `src/app/modulos/despachos/componentes/detalle-despacho`: detalle con línea de tiempo de estados y novedades.
- `src/app/modulos/despachos/componentes/formulario-estado-despacho`: formulario reactivo para actualizar el estado.
- `src/environments/environment.ts`: URL base de la API.
- `src/app/**/**/*.spec.ts`: pruebas unitarias de servicios y componentes.

## Comandos útiles (no ejecutar automáticamente)

```bash
cd frontend
npm install
ng serve --open
ng test
ng generate component shared/ejemplo --standalone=false # ejemplo de extensión
```

Configura la variable `apiUrl` en `environment.ts` según la URL expuesta por Laravel (`http://localhost:8000/api` por defecto).

