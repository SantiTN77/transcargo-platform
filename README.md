# 🚛 TransCargo Platform

**TransCargo S.A.S** – Sistema para gestión de despachos y registro de novedades en tiempo real, con trazabilidad, alertas automáticas y análisis asistido por IA (ChatGPT API).

---

## 🧠 Tecnologías principales
| Stack | Tecnología |
|--------|-------------|
| Backend | Laravel 11 (PHP 8.3) |
| Frontend | Angular 18 |
| Base de Datos | PostgreSQL |
| Infraestructura | Docker + Nginx + Redis |
| Integración IA | OpenAI GPT API |
| CI/CD | GitHub Actions |

---

## ⚙️ Instalación local
```bash
git clone https://github.com/<usuario>/transcargo-platform.git
cd transcargo-platform
cp .env.example .env
docker compose up -d --build
