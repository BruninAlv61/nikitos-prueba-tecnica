# Nikitos — Prueba técnica (Laravel 12, PHP 8.2+)

Réplica orientada al sitio **Nikitos**: catálogo público por categorías, recetas, páginas institucionales, mapa de puntos de venta, contacto segmentado (ventas / RRHH) y **panel de administración** para gestionar productos, categorías, recetas, textos de inicio y nosotros, y mensajes recibidos.

**Repositorio de entrega:** [github.com/BruninAlv61/nikitos-prueba-tecnica](https://github.com/BruninAlv61/nikitos-prueba-tecnica)

### Demo en línea (Railway)

| | |
| --- | --- |
| **Sitio** | https://nikitos-prueba-tecnica-production-b652.up.railway.app |
| **Panel admin** | https://nikitos-prueba-tecnica-production-b652.up.railway.app/admin |
| **Usuario demo** | `admin@nikitos.com.ar` |
| **Contraseña** | `admin123` |

En producción el front compilado se sirve desde `public/build/` (no hace falta Vite en el servidor). El panel admin usa estilos propios y no depende de ese build.

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

El repositorio **no incluye** `.env` (es correcto: contiene secretos). Hay que crearlo a partir de `.env.example`.

Seguí los pasos **en orden**. No pegues comentarios `# ...` en la misma línea que `php artisan`.

### 0. Comprobar herramientas

```bash
php -v          # debe ser 8.2, 8.3 o 8.4
composer -V
node -v         # LTS 20+ recomendado
```

### 1. Clonar e instalar dependencias PHP

```bash
git clone https://github.com/BruninAlv61/nikitos-prueba-tecnica.git
cd nikitos-prueba-tecnica
composer install
```

### 2. Crear `.env` y clave de la app

```bash
cp .env.example .env
php artisan key:generate
```

Con eso, `APP_KEY` queda guardado en `.env`. **No hace falta inventar más variables** para un primer arranque local con SQLite: `.env.example` ya trae valores válidos para desarrollo.

| Variable | ¿Tocarla al clonar? | Notas |
| -------- | ------------------- | ----- |
| `APP_KEY` | Se genera con `key:generate` | Obligatoria; sin ella Laravel no arranca. |
| `APP_URL` | Recomendado | Con `php artisan serve` usá `http://127.0.0.1:8000` (no `localhost` a secas, para evitar rarezas con cookies). |
| `DB_CONNECTION` | Opcional | Por defecto `sqlite` en `.env.example`. |
| `SESSION_DRIVER`, `QUEUE_CONNECTION`, `CACHE_STORE` | No | Dejá `database`; requieren migraciones (paso 4). |
| `MAIL_*` | No | En local los mails van al log (`MAIL_MAILER=log`). |

### 3. Base de datos (SQLite, recomendado en local)

```bash
touch database/database.sqlite
```

Dejá en `.env`: `DB_CONNECTION=sqlite` (ya viene así en el ejemplo).

**MySQL (opcional):** cambiá `DB_CONNECTION=mysql` y completá `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`; creá la base vacía antes de migrar.

### 4. Tablas, datos de prueba y storage

```bash
php artisan migrate
php artisan db:seed
php artisan storage:link
```

- **`db:seed`:** categorías, productos, recetas, contenido de nosotros y usuario **admin** (`admin@nikitos.com.ar` / `admin123`).
- **`storage:link`:** enlaza `storage/app/public` → `public/storage` (subidas del admin y CVs de contacto).

**Imágenes de demo:** los seeders apuntan a archivos en `public/images/`. Si falta alguno (p. ej. `images/recetas/nachos-tacos.jpg`), verás un 404 puntual; el resto del sitio sigue funcionando.

### 5. Dependencias front-end

```bash
npm install
```

### 6. Levantar el proyecto (dos terminales)

El **sitio público** usa Vite + Tailwind. El **panel `/admin`** lleva CSS propio y se ve bien solo con PHP; el home y productos **necesitan Vite en desarrollo** (o un build previo).

**Terminal 1 — PHP (backend y páginas):**

```bash
php artisan serve
```

Abrí: http://127.0.0.1:8000

**Terminal 2 — Vite (estilos y assets del sitio público):**

```bash
npm run dev
```

Dejá **las dos corriendo** mientras desarrollás. Si solo corrés `php artisan serve`, verás HTML sin estilos en la parte pública (el admin puede verse normal).

**Alternativa sin segunda terminal:** compilá una vez y no uses `npm run dev`:

```bash
npm run build
php artisan serve
```

Cada vez que cambies CSS/JS en `resources/`, volvé a ejecutar `npm run build`.

**Alternativa todo-en-uno** (PHP + cola + logs + Vite en un solo comando):

```bash
composer run dev
```

#### Atajo de instalación inicial

```bash
touch database/database.sqlite   # antes, si usás SQLite
composer run setup
```

Ejecuta `composer install`, copia `.env` si falta, genera clave, migra y `npm run build`. Después igual podés usar `npm run dev` + `php artisan serve` para desarrollo con recarga en caliente.

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


| Síntoma | Qué revisar |
| ------- | ----------- |
| Sitio público sin estilos (HTML plano) | ¿Tenés `npm run dev` o corriste `npm run build`? El admin no usa Vite. |
| `No application encryption key` | `cp .env.example .env` y `php artisan key:generate`. |
| `composer install` falla por PHP | `php -v` ≥ 8.2 en la misma terminal. |
| SQLite / migraciones | `touch database/database.sqlite` y `DB_CONNECTION=sqlite`. |
| Sesión / login raro | `php artisan migrate` (tablas `sessions`, `jobs`, `cache`). |
| `Vite manifest not found` | `npm run dev` o `npm run build`. |
| Subidas no visibles | `php artisan storage:link` y permisos en `storage/`, `bootstrap/cache/`. |
| Mapa vacío | Assets en `public/vendor/leaflet/`. |
| Imagen “placeholder” 404 | Agregá `public/images/placeholder.png` o ignorá si es solo demo. |


---

## Licencia

El framework **Laravel** y el esqueleto del proyecto se publican bajo la licencia **MIT**. El contenido de marca y materiales de diseño de Nikitos pertenecen a sus titulares; este repositorio es una **prueba técnica** con de evaluación.