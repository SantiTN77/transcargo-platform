<h1 align="center">🚛 TransCargo Platform</h1>

<p align="center">
  <b>Sistema integral para gestión de despachos y registro de novedades con IA y alertas automáticas</b><br>
  <i>Desarrollado con Laravel · Angular · Docker · PostgreSQL · OpenAI</i>
</p>

---

<p align="center">
  <img src="https://img.shields.io/badge/PHP-8.3-blue?logo=php" />
  <img src="https://img.shields.io/badge/Laravel-11-red?logo=laravel" />
  <img src="https://img.shields.io/badge/Angular-18-DD0031?logo=angular" />
  <img src="https://img.shields.io/badge/PostgreSQL-16-blue?logo=postgresql" />
  <img src="https://img.shields.io/badge/Docker-Compose-2496ED?logo=docker" />
  <img src="https://img.shields.io/badge/OpenAI-API-black?logo=openai" />
  <img src="https://github.com/<tu_usuario>/transcargo-platform/actions/workflows/ci.yml/badge.svg" />
  <img src="https://img.shields.io/badge/Lint-passing-success?logo=eslint" />
  <img src="https://img.shields.io/badge/License-MIT-green" />
</p>

---

## 📋 Descripción general

**TransCargo Platform** es una solución moderna para la gestión de despachos logísticos.  
Permite registrar novedades operativas (retrasos, daños, transbordos o cancelaciones), consultar trazabilidad de cada despacho y generar alertas automáticas con análisis asistido por IA.

Su arquitectura modular combina **Laravel (API RESTful)** y **Angular (SPA)** bajo un entorno **Dockerizado**, aplicando buenas prácticas de un desarrollador senior:  
- Validaciones sólidas  
- Separación por capas (Controllers, Services, Repositories)  
- Colas Redis y Jobs para procesos asíncronos  
- CI/CD con GitHub Actions  

---

## 🧱 Arquitectura

transcargo-platform/
├── api/ → Backend Laravel (REST API)
├── web/ → Frontend Angular
├── docker/ → Configuración de contenedores
├── docker-compose.yml
├── .github/workflows/ci.yml
├── .env.example
├── README.md
└── LICENSE



---

## ⚙️ Stack Tecnológico

| Componente | Tecnología | Rol |
|-------------|-------------|-----|
| **Backend** | Laravel 11 + PHP 8.3 | API REST, validaciones, eventos |
| **Frontend** | Angular 18 | Interfaz SPA de usuario |
| **Base de Datos** | PostgreSQL 16 | Persistencia y trazabilidad |
| **Colas** | Redis | Alertas y generación de resúmenes IA |
| **Infraestructura** | Docker + Nginx | Despliegue portable |
| **Integración IA** | OpenAI API (GPT-4o-mini) | Resumen y análisis inteligente |
| **CI/CD** | GitHub Actions | Integración y testing continuo |

---

## 🚀 Instalación local


git clone https://github.com/<tu_usuario>/transcargo-platform.git
cd transcargo-platform
cp .env.example .env
docker compose up -d --build
El backend estará disponible en http://localhost:8000
El frontend en http://localhost:4200

🧩 Variables de entorno
env
Copiar código
DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=transcargo
DB_USERNAME=postgres
DB_PASSWORD=postgres

REDIS_HOST=redis
QUEUE_CONNECTION=redis

OPENAI_API_KEY=<tu_api_key>
OPENAI_MODEL=gpt-4o-mini
AI_ENABLED=true
🧠 Funcionalidades principales
Registro validado de novedades con tipos permitidos

Consulta de despachos y trazabilidad de estados

Alertas automáticas ante novedades críticas

Historial completo de cambios de estado

Integración con OpenAI para generar resúmenes y sugerencias

API documentada con Swagger (si el tiempo lo permite)

🔄 Flujo general
El conductor reporta una novedad (Retraso, Transbordo, Daño o Cancelación).

El backend valida, registra y dispara un evento Laravel.

Un Listener encola el envío de alerta o resumen IA.

El frontend Angular actualiza la interfaz en tiempo real vía polling o WebSocket.

🧪 Testing
Ejecución de pruebas:

php artisan test
Resultado visual (CI):


💬 Commits y ramas
Se sigue la convención Conventional Commits:

makefile
Copiar código
feat: nueva funcionalidad
fix: corrección
chore: configuración o tarea
docs: documentación
test: pruebas
Ramas activas:

main → Producción

develop → Integración

feature/* → Nuevas funcionalidades

fix/* → Correcciones

release/* → Versiones candidatas

🧑‍💻 Autor
Santiago Tafur
Desarrollador de Software · SENA
LinkedIn · GitHub

🪪 Licencia
Distribuido bajo licencia MIT.
© 2025 TransCargo S.A.S
