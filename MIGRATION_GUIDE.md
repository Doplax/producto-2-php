# Migration Guide: Native PHP to Laravel

## Overview

This document describes the migration of the Isla Transfers project from a native PHP MVC architecture to Laravel 12, following Laravel's recommended scaffolding and best practices.

---

## What Changed

### 1. Framework Migration

**Before:** Native PHP with custom MVC implementation
**After:** Laravel 12 with standard Laravel structure

### 2. Directory Structure

#### Old Structure
```
app/
├── config/
├── controllers/
├── core/
├── helpers/
├── models/
└── views/
```

#### New Structure (Laravel)
```
app/
├── Http/
│   ├── Controllers/
│   └── Middleware/
├── Models/
└── Providers/
```

### 3. Database Layer

**Before:** MySQLi with manual queries
**After:** Eloquent ORM with migrations

### 4. Routing

**Before:** Custom Router class parsing URLs
**After:** Laravel's routing system in `routes/web.php`

### 5. Views

**Before:** Plain PHP files with includes
**After:** Blade templating engine

### 6. Authentication

**Before:** Custom session-based auth
**After:** Laravel authentication with custom Viajero guard

---

## Key Components Migrated

### Models

All models have been converted to Eloquent models with proper relationships:

- ✅ **Zona** → `App\Models\Zona`
- ✅ **Hotel** → `App\Models\Hotel`
- ✅ **TipoReserva** → `App\Models\TipoReserva`
- ✅ **Vehiculo** → `App\Models\Vehiculo`
- ✅ **Viajero** (Usuario) → `App\Models\Viajero`
- ✅ **Precio** → `App\Models\Precio`
- ✅ **Reserva** → `App\Models\Reserva`
- ✅ **Trayecto** → `App\Models\Trayecto` (alias)

### Controllers

All controllers have been migrated to Laravel controllers:

- ✅ **AuthController** → Login, Register, Logout
- ✅ **HomeController** → Index, Test endpoints
- ✅ **AdminController** → Admin dashboard (structure)
- ✅ **UsuarioController** → User profile management (structure)
- ✅ **ReservaController** → Reservation management (structure)

### Database Migrations

All 7 tables have been converted to Laravel migrations:

1. `transfer_zona`
2. `tranfer_hotel` (note: typo preserved from original)
3. `transfer_tipo_reserva`
4. `transfer_vehiculo`
5. `transfer_viajeros`
6. `transfer_precios`
7. `transfer_reservas`

### Views

Core views have been migrated to Blade:

- ✅ **Layout** → `layouts/app.blade.php`
- ✅ **Home** → `home.blade.php`
- ✅ **Login** → `auth/login.blade.php`
- ✅ **Register** → `auth/register.blade.php`

---

## Configuration Changes

### Environment Variables

The `.env` file now uses Laravel's standard configuration:

```env
APP_NAME="Isla Transfers"
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost:8080

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=isla_transfers
DB_USERNAME=user
DB_PASSWORD=pass
DB_ROOT_PASS=root
```

### Authentication

Custom authentication guard configured in `config/auth.php`:

```php
'guards' => [
    'viajero' => [
        'driver' => 'session',
        'provider' => 'viajeros',
    ],
],

'providers' => [
    'viajeros' => [
        'driver' => 'eloquent',
        'model' => App\Models\Viajero::class,
    ],
],
```

### Routes

All routes are now defined in `routes/web.php` with proper middleware:

```php
// Public routes
Route::get('/', [HomeController::class, 'index']);
Route::get('/auth/login', [AuthController::class, 'showLogin']);

// Protected routes
Route::middleware(['auth:viajero'])->group(function () {
    Route::get('/reserva/mis-reservas', [ReservaController::class, 'misReservas']);
});

// Admin routes
Route::middleware(['auth:viajero', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
});
```

---

## Docker Configuration

### Dockerfile Updates

Added Laravel-specific permissions and composer install:

```dockerfile
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache
```

### Docker Compose

No changes needed - the existing configuration works perfectly with Laravel.

---

## Migration Steps to Production

### 1. Clone and Setup

```bash
git clone [repository-url]
cd producto-2-php
cp .env.example .env
```

### 2. Start Docker

```bash
docker-compose up -d --build
```

### 3. Run Migrations

```bash
docker exec isla_transfers_web php artisan migrate
```

### 4. Import Seed Data (if available)

```bash
docker exec isla_transfers_web php artisan db:seed
```

### 5. Set Permissions

```bash
docker exec isla_transfers_web chmod -R 775 storage bootstrap/cache
```

### 6. Clear Cache

```bash
docker exec isla_transfers_web php artisan config:cache
docker exec isla_transfers_web php artisan route:cache
docker exec isla_transfers_web php artisan view:cache
```

---

## Code Comparison Examples

### Example 1: Model Usage

**Before (Native PHP):**
```php
$userModel = new Usuario();
$usuario = $userModel->verificarCredenciales($email, $password);
```

**After (Laravel):**
```php
$viajero = Viajero::where('email', $email)->first();
if ($viajero && Hash::check($password, $viajero->password)) {
    // Login success
}
```

### Example 2: Routing

**Before (Custom Router):**
```php
// URL: /auth/login
// Parsed by Router::dispatch()
$controllerName = 'AuthController';
$methodName = 'login';
```

**After (Laravel):**
```php
Route::get('/auth/login', [AuthController::class, 'showLogin'])->name('login');
```

### Example 3: Views

**Before (Plain PHP):**
```php
require_once '../app/views/layout/header.php';
require_once '../app/views/auth/login.php';
require_once '../app/views/layout/footer.php';
```

**After (Blade):**
```blade
@extends('layouts.app')

@section('content')
    <!-- Login form -->
@endsection
```

---

## Benefits of Migration

### 1. **Modern Framework**
- Laravel 12 with latest PHP 8.2+ features
- Regular security updates and community support

### 2. **Better Database Management**
- Eloquent ORM for cleaner queries
- Migrations for version control of database schema
- Built-in relationships and eager loading

### 3. **Enhanced Security**
- CSRF protection out of the box
- Secure password hashing with bcrypt
- SQL injection prevention
- XSS protection in Blade templates

### 4. **Developer Experience**
- Artisan CLI for common tasks
- Better error handling and debugging
- Extensive documentation
- Large ecosystem of packages

### 5. **Code Organization**
- Clear separation of concerns
- PSR-4 autoloading
- Service container for dependency injection
- Middleware for request filtering

### 6. **Testing**
- Built-in testing framework (PHPUnit)
- Database factories and seeders
- Easy to write unit and feature tests

---

## Backward Compatibility Notes

### Database Schema
- All table names preserved exactly (including the typo in `tranfer_hotel`)
- All column names preserved
- Foreign key relationships maintained

### User Data
- Existing user passwords remain valid (bcrypt compatible)
- Session management compatible through migration
- All user data structure preserved

### URLs
- Most URLs remain the same
- Named routes provide flexibility for future changes

---

## Next Steps (Optional Enhancements)

### 1. Complete Remaining Views
- Admin dashboard
- User profile management
- Reservation CRUD operations
- Calendar view

### 2. Add API Endpoints
```php
Route::prefix('api')->group(function () {
    Route::get('/reservations', [ApiController::class, 'getReservations']);
    Route::post('/reservations', [ApiController::class, 'createReservation']);
});
```

### 3. Implement Form Request Validation
```bash
php artisan make:request StoreReservaRequest
```

### 4. Add Database Seeders
```bash
php artisan make:seeder ZonaSeeder
php artisan make:seeder HotelSeeder
```

### 5. Set Up Mail Configuration
Update `.env` with mail settings for notifications

### 6. Add Unit Tests
```bash
php artisan make:test ReservaTest
```

---

## Troubleshooting

### Issue: 500 Error on Page Load
**Solution:** Check storage permissions
```bash
docker exec isla_transfers_web chmod -R 775 storage bootstrap/cache
```

### Issue: Database Connection Failed
**Solution:** Verify `.env` database credentials match docker-compose.yml

### Issue: CSRF Token Mismatch
**Solution:** Clear config cache
```bash
docker exec isla_transfers_web php artisan config:clear
```

### Issue: Route Not Found
**Solution:** Clear route cache
```bash
docker exec isla_transfers_web php artisan route:clear
```

---

## Support

For Laravel-specific questions, refer to:
- [Laravel Documentation](https://laravel.com/docs)
- [Laravel News](https://laravel-news.com)
- [Laracasts](https://laracasts.com)

For project-specific questions, contact the development team.
