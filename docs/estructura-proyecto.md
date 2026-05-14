# Estructura del proyecto

Visión técnica de cómo está organizado el repositorio **Nikitos** (Laravel + Blade + Vite + Tailwind en el front público).

## Stack principal

- **Framework:** Laravel 12 (bootstrap en `bootstrap/app.php`: rutas web, consola, healthcheck `/up` y carga adicional de `routes/admin.php`).
- **Front público:** Vite (`vite.config.js`) con plugin Laravel y **Tailwind CSS v4** (`@tailwindcss/vite`); entrada `resources/css/app.css` y `resources/js/app.js`.
- **Panel admin:** vistas Blade con estilos en línea en `resources/views/admin/layout.blade.php` (sin bundle Vite dedicado).
- **Autenticación:** flujo tipo **Laravel Breeze** (`routes/auth.php`, controladores en `App\Http\Controllers\Auth`).
- **Tests:** Pest/PHPUnit bajo `tests/`.

## Directorios en la raíz (resumen)

| Directorio / archivo | Rol |
|----------------------|-----|
| `app/` | Código de aplicación: modelos, HTTP, servicios, proveedores |
| `bootstrap/` | Arranque de Laravel y caché de bootstrap |
| `config/` | Configuración (base de datos, filesystems, sesión, etc.) |
| `database/` | Migraciones, seeders y factories |
| `docs/` | Documentación técnica en Markdown (estructura, admin, imágenes, dominio de negocio, etc.) |
| `public/` | Document root: `index.php`, assets compilados (`build/`), estáticos (`images/`, `videos/`) |
| `resources/` | Vistas Blade, CSS/JS fuente, otros assets del front |
| `routes/` | Definición de rutas: `web.php`, `admin.php`, `auth.php`, `console.php` |
| `storage/` | Logs, caché, sesiones, y `storage/app/public` para subidas enlazadas a `public/storage` |
| `tests/` | Pruebas automatizadas |
| `vendor/` | Dependencias Composer (no versionar cambios manuales salvo `composer.lock`) |
| `node_modules/` | Dependencias npm (generadas con `npm install`) |
| `.agents/` | Skills y material de agentes (opcional para el runtime de la app) |

## `app/` — aplicación

| Ruta | Contenido típico |
|------|------------------|
| `app/Models/` | Eloquent: `Producto`, `Categoria`, `Receta`, `Contacto`, `User`, modelos de contenido (`InicioContenido`, `NosotrosContenido`, …) |
| `app/Http/Controllers/` | Controladores del sitio público y de perfil |
| `app/Http/Controllers/Admin/` | Todo el CRUD y edición del panel `/admin` |
| `app/Http/Controllers/Auth/` | Login, registro, verificación de email, contraseñas |
| `app/Http/Requests/` | Form requests de validación |
| `app/Services/` | Lógica reutilizable; p. ej. `Services/Images/OptimizedPublicImage.php` |
| `app/Providers/` | Service providers de Laravel |
| `app/View/` | View composers o componentes registrados por PHP (si aplica) |

## `routes/` — capa HTTP

- **`web.php`:** páginas públicas (inicio, productos, recetas, contacto, RSE, etc.), perfil de usuario y grupo `auth` con `dashboard` que redirige al admin.
- **`admin.php`:** prefijo `/admin`, middleware `auth`, recursos y rutas de contenido (detalle en [panel-administracion.md](./panel-administracion.md)).
- **`auth.php`:** rutas guest/auth de Breeze.
- **`console.php`:** comandos Artisan programados o definidos.

## `resources/` — presentación y front

| Ruta | Uso |
|------|-----|
| `resources/views/` | Plantillas Blade: `layouts/`, `components/`, páginas por sección, carpeta `admin/` |
| `resources/css/` | Hojas de estilo del sitio público (Tailwind vía `@import "tailwindcss"` en `app.css`) |
| `resources/js/` | JavaScript del front (p. ej. `app.js`) |
| `resources/views/components/` | Componentes Blade reutilizables (`x-page-hero`, `x-card-grid`, etc.) |

CSS específico por página puede existir como archivos en `resources/css/` (p. ej. `productos-show.css`) según cómo los incluya cada vista.

## `database/`

- **`migrations/`:** esquema versionado (tablas de negocio y de contenido).
- **`seeders/`:** datos iniciales (`CategoriasSeeder`, `ProductosSeeder`, `RecetaSeeder`, `NosotrosContenidoSeeder`, …); `DatabaseSeeder` orquesta las llamadas.
- **`factories/`:** factories para tests o datos de prueba.

## `public/`

- Punto de entrada HTTP (`index.php`).
- **`public/build/`:** salida de `npm run build` (Vite).
- **`public/images/`**, **`public/videos/`:** recursos estáticos referenciados con `asset()`.
- Tras `php artisan storage:link`, **`public/storage`** apunta a `storage/app/public` (subidas del admin y similares).

## `config/` y entorno

- Ajustes por entorno vía `.env` (no incluir secretos en el repo; usar `.env.example` como plantilla).
- `config/filesystems.php` define el disco `public` usado para imágenes optimizadas y PDFs en `catalogos/`.

## Documentación relacionada en `docs/`

- [panel-administracion.md](./panel-administracion.md) — rutas, layout y módulos del admin.
- [image-optimization.md](./image-optimization.md) — tratamiento de imágenes en el admin.
- [implementacion-productos.md](./implementacion-productos.md) y [implementacion-categorias.md](./implementacion-categorias.md) — dominio de catálogo.

## Comandos habituales de desarrollo

- `composer install` / `npm install` — dependencias.
- `php artisan migrate` — aplicar migraciones.
- `php artisan db:seed` — datos de ejemplo (según `DatabaseSeeder`).
- `npm run dev` — Vite en caliente para el front público.
- `php artisan serve` — servidor de desarrollo PHP (opcional).

La estructura sigue las convenciones de Laravel: mantener nuevos modelos en `app/Models`, controladores agrupados por contexto (`Admin`, `Auth`), y vistas alineadas con las rutas y nombres de recurso para facilitar el mantenimiento.
