# Nikitos — Prueba técnica (Laravel 12, PHP 8.2+)

Réplica orientada al sitio **Nikitos**: catálogo público por categorías, recetas, páginas institucionales, mapa de puntos de venta, contacto segmentado (ventas / RRHH) y **panel de administración** para gestionar productos, categorías, recetas, textos de inicio y nosotros, y mensajes recibidos.

**Repositorio de entrega:** [github.com/BruninAlv61/nikitos-prueba-tecnica](https://github.com/BruninAlv61/nikitos-prueba-tecnica)

```bash
git clone https://github.com/BruninAlv61/nikitos-prueba-tecnica.git
cd nikitos-prueba-tecnica
```

**Documentación técnica ampliada:** carpeta `[docs/](docs/)` — en particular [estructura del proyecto](docs/estructura-proyecto.md), [panel de administración](docs/panel-administracion.md) e [optimización de imágenes](docs/image-optimization.md).

---

## Qué incluye este proyecto

### Sitio público


| Área          | Rutas (ejemplos)                                                            | Descripción breve                                                                                 |
| ------------- | --------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------- |
| Inicio        | `/`                                                                         | Hero, destacados, categorías, recetas recientes; textos editables vía `InicioContenido`.          |
| Productos     | `/productos`, `/productos/{categoria}`, `/productos/{categoria}/{producto}` | Listado, filtro por categoría (binding por **id** de categoría) y ficha de producto.              |
| Nosotros      | `/nosotros`                                                                 | Contenido desde modelo singleton `NosotrosContenido`.                                             |
| Dónde comprar | `/donde-comprar`                                                            | Mapa interactivo (**Leaflet**) con sedes de ejemplo en Argentina.                                 |
| Recetas       | `/recetas`, `/recetas/{receta}`                                             | Listado y detalle por **id** de receta (enlaces en vistas usan el id).                            |
| Institucional | `/rse`, `/politicas-de-calidad`                                             | Placeholders listos para ampliar.                                                                 |
| Contacto      | `GET/POST /contacto`                                                        | Dos flujos: **ventas** (datos comerciales) y **RRHH** (postulación, CV opcional en PDF/DOC/DOCX). |


### Panel `/admin`

Requiere usuario **autenticado** (Laravel Breeze). En el código actual **no** hay rol `is_admin`: cualquier usuario con sesión válida puede acceder a las rutas bajo `/admin` (en producción conviene restringir; detalle en `[docs/panel-administracion.md](docs/panel-administracion.md)`).


| Módulo     | Funcionalidad                                                                                                                         |
| ---------- | ------------------------------------------------------------------------------------------------------------------------------------- |
| Productos  | CRUD, categoría, imagen, flag **destacado**.                                                                                          |
| Categorías | CRUD, color de acento, imagen, **PDF de catálogo** en disco `public` (`catalogos/`).                                                  |
| Recetas    | CRUD, ingredientes y pasos, imagen opcional.                                                                                          |
| Contactos  | Listado, detalle y eliminación de envíos del formulario público.                                                                      |
| Contenido  | Índice con enlaces a edición de **Inicio** y **Nosotros**; inicio incluye textos del hero, PDF de catálogo en hero y banner opcional. |


Tras iniciar sesión, la ruta `dashboard` redirige a `admin.productos.index`.

### Front-end

- **Público:** Blade + **Vite 7** + **Tailwind CSS v4** (`resources/css/app.css` importa módulos por página).
- **Admin:** Blade con estilos embebidos en `resources/views/admin/layout.blade.php` (independiente del bundle Vite del sitio público).
- **Mapas:** Leaflet desde `public/vendor/leaflet/`.

### Imágenes en el admin

Las subidas raster (productos, categorías, recetas) pasan por `App\Services\Images\OptimizedPublicImage` (**GD** de PHP, salida preferente **WebP**). Sin GD o ante error, se guarda el archivo con el flujo estándar de `Storage`. Ver `[docs/image-optimization.md](docs/image-optimization.md)`.

---

## Stack principal


| Componente                              | Detalle                                                                        |
| --------------------------------------- | ------------------------------------------------------------------------------ |
| Framework                               | **Laravel 12** (`laravel/framework ^12.0`)                                     |
| PHP                                     | **^8.2** (ver `composer.json`)                                                 |
| Base de datos                           | **SQLite** por defecto en `.env.example`; compatible con **MySQL**             |
| Autenticación                           | **Laravel Breeze** (login, registro, perfil, flujo de contraseñas)             |
| Front build                             | **Vite** + `@tailwindcss/vite`                                                 |
| Colas / sesión / caché (`.env.example`) | `QUEUE_CONNECTION=database`, `SESSION_DRIVER=database`, `CACHE_STORE=database` |
| Tests                                   | **Pest** + plugin Laravel                                                      |


---

## Estructura del proyecto

```text
nikitos-prueba-tecnica/
├── app/
│   ├── Http/
│   │   ├── Controllers/           # Sitio público, perfil
│   │   ├── Controllers/Admin/     # Panel bajo /admin
│   │   ├── Controllers/Auth/      # Breeze
│   │   └── Requests/
│   ├── Models/
│   ├── Services/Images/           # OptimizedPublicImage (GD / WebP)
│   └── Providers/
├── bootstrap/
│   └── app.php                    # Rutas web, consola, health /up, routes/admin.php
├── config/
├── database/
│   ├── migrations/
│   ├── seeders/                   # Categorías, productos, recetas, nosotros (sin usuario admin fijo)
│   └── factories/
├── public/
│   ├── index.php
│   ├── build/                     # npm run build (Vite)
│   ├── images/                    # Estáticos y demos de catálogo / marketing
│   ├── vendor/leaflet/
│   └── storage -> ../storage/app/public   # Tras php artisan storage:link
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
├── routes/
│   ├── web.php
│   ├── admin.php
│   └── auth.php
├── storage/
├── tests/
├── composer.json
├── package.json
└── vite.config.js
```

### Rutas y capas principales


| Ubicación                                     | Uso                                                                                                                       |
| --------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------- |
| `routes/web.php`                              | Home, productos, nosotros, dónde comprar, recetas, RSE, políticas, contacto, perfil y redirección del dashboard al admin. |
| `routes/admin.php`                            | Recursos y contenido bajo `/admin` (middleware `auth`).                                                                   |
| `routes/auth.php`                             | Login, registro, recuperación de contraseña, verificación de email.                                                       |
| `app/Http/Controllers/PaginaController.php`   | Home y páginas estáticas / placeholders.                                                                                  |
| `app/Http/Controllers/ProductoController.php` | Catálogo público.                                                                                                         |
| `app/Http/Controllers/RecetaController.php`   | Recetas públicas.                                                                                                         |
| `app/Http/Controllers/ContactoController.php` | Formulario de contacto.                                                                                                   |


---

## Requisitos

### Versiones (importante)


| Herramienta  | Versión                                                                                                                           |
| ------------ | --------------------------------------------------------------------------------------------------------------------------------- |
| **PHP**      | **8.2, 8.3 o 8.4** (`composer.json`: `^8.2`). Comprobar con `php -v` en la **misma terminal** que usarás para Composer y Artisan. |
| **Composer** | 2.x                                                                                                                               |
| **Node.js**  | **LTS 20+** recomendado (Vite 7 y Tailwind 4).                                                                                    |


### Extensiones PHP

Recomendadas: `openssl`, `pdo`, `pdo_sqlite` o `pdo_mysql`, `mbstring`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo`.

Para optimización de imágenes en el admin: `**ext-gd`** con soporte **WebP** cuando sea posible. Sin GD, las subidas siguen funcionando sin ese paso extra.

### `composer install` y `composer.lock`

`composer install` respeta el lockfile. Si falla por **platform** o versión de PHP, ajustá el entorno o usá `composer why-not php <versión>`. Para reproducir el proyecto, preferí `composer install` frente a `composer update` salvo que actualicéis dependencias a propósito.

---

## Instalación (desarrollo local)

Seguí los pasos en orden. No pegues comentarios `# ...` en la misma línea que `php artisan`.

### 0. PHP, Composer y Node

```bash
php -v
composer --version
node -v
```

### 1. Código y dependencias PHP

```bash
git clone https://github.com/BruninAlv61/nikitos-prueba-tecnica.git
cd nikitos-prueba-tecnica
composer install
```

### 2. Entorno y clave de aplicación

```bash
cp .env.example .env
php artisan key:generate
```

Editá `.env`: al menos `**APP_URL**` acorde a cómo servís el sitio (p. ej. `http://127.0.0.1:8000` con `php artisan serve`).

### 3. Base de datos

**Opción A — SQLite**

```bash
touch database/database.sqlite
```

Con `DB_CONNECTION=sqlite` en `.env` (como en `.env.example`).

**Opción B — MySQL**

Configurá `DB_CONNECTION=mysql`, host, puerto, base, usuario y contraseña; creá la base antes de migrar.

### 4. Migraciones, datos de prueba y enlace de storage

```bash
php artisan migrate
php artisan db:seed
php artisan storage:link
```

- `**db:seed`:** categorías, productos, recetas y contenido de nosotros; **no** crea un usuario administrador.
- `**storage:link`:** necesario para ver subidas (imágenes, CVs, PDFs) bajo `public/storage`.

**Nota sobre imágenes de demo:** los seeders de categorías y productos usan rutas bajo `public/images/` (p. ej. `images/cat1.png`, `images/des1.png`). La primera receta demo puede apuntar a `images/recetas/nachos-tacos.jpg`; si esa ruta no existe en tu clon, agregá el archivo o ajustá el seeder para usar otra imagen ya presente (p. ej. `images/recetas.png`).

### 5. Assets front-end (Vite)

```bash
npm install
npm run dev
```

- `**npm run dev`:** Vite en desarrollo (ideal junto a `php artisan serve`).
- `**npm run build`:** build de producción (`public/build/`).

### 6. Servidor de desarrollo

```bash
php artisan serve
```

#### Atajo Composer (setup rápido)

```bash
composer run setup
```

Instala dependencias PHP, prepara `.env` si falta, genera clave, migra y ejecuta `npm run build`. Con **SQLite**, creá antes `database/database.sqlite` para que la migración no falle.

#### Desarrollo con varios procesos

```bash
composer run dev
```

Levanta servidor PHP, worker de cola, Pail y Vite según el script definido en `composer.json`.

---

## Acceso al panel (Demo)

Para pruebas rápidas, podés usar el siguiente usuario administrador ya creado en el seeder:

- **Email:** `admin@nikitos.com.ar`
- **Contraseña:** `admin123`

También podés:
1. Registrarte en `**/register**` (nombre, apellido, email, contraseña).
2. Login en `**/login**`.
3. Acceder al panel en `**/admin**` (o vía redirección del `dashboard`).


---

## Reiniciar base de datos

```bash
php artisan migrate:fresh --seed
php artisan storage:link
```

---

## Tests y salud

```bash
composer test
```

Healthcheck HTTP por defecto de Laravel: `**GET /up**`.

---

## Problemas frecuentes


| Síntoma                  | Qué revisar                                                                                                                                                              |
| ------------------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| `composer install` y PHP | `php -v` ≥ 8.2.                                                                                                                                                          |
| SQLite                   | Archivo `database/database.sqlite` y `DB_CONNECTION=sqlite`.                                                                                                             |
| Sesión / cola / caché    | Migraciones aplicadas (`sessions`, `jobs`, `cache`).                                                                                                                     |
| Manifest de Vite         | `npm run dev` o `npm run build`.                                                                                                                                         |
| Subidas no visibles      | Permisos en `storage/` y `bootstrap/cache/`; `php artisan storage:link`.                                                                                                 |
| Mapa vacío               | Assets en `public/vendor/leaflet/`.                                                                                                                                      |
| Imagen “placeholder” 404 | Los modelos pueden usar `images/placeholder.png` cuando no hay imagen; si no existe en `public/images/`, agregá un PNG con ese nombre o ajustá el fallback en el modelo. |


---

## Licencia

El framework **Laravel** y el esqueleto del proyecto se publican bajo la licencia **MIT**. El contenido de marca y materiales de diseño de Nikitos pertenecen a sus titulares; este repositorio es una **prueba técnica** con de evaluación.