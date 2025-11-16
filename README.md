# 🚀 Proyecto: Isla Transfers

App de gestión de **transfers** construida con **Laravel 12**, siguiendo las mejores prácticas y el scaffolding recomendado de Laravel.

---

## ⚙️ Puesta en Marcha (Setup)

### 🧩 Requisitos

- Docker
- Docker Compose
- Composer (opcional, Docker lo instalará automáticamente)

---

### 🔧 Clonar el repositorio

```bash
git clone [URL-DE-TU-REPOSITORIO-GIT]
cd producto-2-php
```

---

### 🧱 Crear el archivo `.env`

Copia el archivo `.env.example` a `.env`:

```bash
cp .env.example .env
```

El archivo ya contiene las credenciales correctas para Docker:

```env
DB_HOST=db
DB_NAME=isla_transfers
DB_USER=user
DB_PASS=pass
DB_ROOT_PASS=root
APP_URL=http://localhost:8080
```

---

### 🐳 Construir y arrancar el entorno

(Primera vez)

```bash
docker-compose up -d --build
```

Una vez que los contenedores estén corriendo, ejecuta las migraciones:

```bash
docker exec isla_transfers_web php artisan migrate
```

---

## 🏃‍♂️ Uso Diario

**Iniciar:**

```bash
docker-compose up -d
```

**Detener:**

```bash
docker-compose down
```

**Ver logs:**

```bash
docker-compose logs -f web
```

---

## 🌐 Accesos y Credenciales

### 🔗 URLs

- **Aplicación Web:** [http://localhost:8080](http://localhost:8080)
- **phpMyAdmin:** [http://localhost:8081](http://localhost:8081)

---

### 🧠 Credenciales BD

| Clave    | Valor          |
| -------- | -------------- |
| **Host** | db             |
| **DB**   | isla_transfers |
| **User** | user           |
| **Pass** | pass           |

---

### 🔑 Credenciales phpMyAdmin

| Campo          | Valor |
| -------------- | ----- |
| **Servidor**   | db    |
| **Usuario**    | root  |
| **Contraseña** | root  |

---

## 📝 Comandos Útiles de Laravel

### Ejecutar comandos Artisan

```bash
docker exec isla_transfers_web php artisan [comando]
```

### Limpiar caché

```bash
docker exec isla_transfers_web php artisan cache:clear
docker exec isla_transfers_web php artisan config:clear
docker exec isla_transfers_web php artisan view:clear
```

### Crear migraciones

```bash
docker exec isla_transfers_web php artisan make:migration [nombre_migracion]
```

### Crear modelos

```bash
docker exec isla_transfers_web php artisan make:model [NombreModelo]
```

### Crear controladores

```bash
docker exec isla_transfers_web php artisan make:controller [NombreController]
```

---

## 🔄 Resetear los Contenedores

### 1. Destruir Contenedores

```bash
docker-compose down -v
```

### 2. Volver a Crear

```bash
docker-compose up -d --build
docker exec isla_transfers_web php artisan migrate
```

---

## 👤 Usuario Admin

Para acceder como administrador, crea un usuario con este email:

```
admin@islatransfers.com
admin
```

Este usuario tendrá acceso al panel de administración.

---

## 🏗️ Estructura del Proyecto (Laravel)

```
├── app/
│   ├── Http/
│   │   ├── Controllers/     # Controladores
│   │   └── Middleware/      # Middleware personalizado
│   └── Models/              # Modelos Eloquent
├── database/
│   ├── migrations/          # Migraciones de BD
│   └── seeders/             # Seeders
├── resources/
│   └── views/               # Vistas Blade
├── routes/
│   └── web.php              # Rutas web
├── public/                  # Punto de entrada y assets públicos
└── storage/                 # Archivos generados
```

---

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
