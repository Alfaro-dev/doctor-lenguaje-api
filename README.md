# Doctor Lenguaje API 🗣️

API REST en **Laravel** que da soporte a una app de aprendizaje: gestiona lenguajes, niveles, módulos y lecciones, registra el progreso de cada usuario e integra **OpenAI**.

## ✨ Funciones

- Registro e inicio de sesión con tokens (**Laravel Sanctum**)
- CRUD de lenguajes, niveles, módulos y lecciones
- Seguimiento del progreso de aprendizaje por usuario
- Encuestas, experiencia y permisos
- Endpoint de integración con **OpenAI**
- Monitoreo con **Laravel Telescope**

## 🛠️ Stack

- **PHP / Laravel**
- **Laravel Sanctum** para autenticación
- **PostgreSQL**
- **Docker** y Docker Compose
- Colección de endpoints lista para importar (`api-collection.json`)

## 📁 Estructura principal

```
app/Http/Controllers/   # Auth, Lenguaje, Level, Module, Lesson, LearningProgress, OpenAI
app/Models/             # User, Lenguaje, Level, Module, Lesson, Progress, Survey, Experience, Permission
database/migrations/    # tablas del dominio
routes/api.php          # rutas de la API
```

## 🚀 Cómo correrlo

```bash
cp .env.example .env      # configura base de datos y la clave de OpenAI
docker compose up -d
composer install
php artisan key:generate
php artisan migrate
```

---

Desarrollado por [Carlos Alfaro](https://carlosalfaro.dev).
