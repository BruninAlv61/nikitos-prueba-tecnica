# Implementación técnica: Categorías

Este documento describe cómo están modeladas, validadas y usadas las **categorías de productos** en la aplicación Laravel.

## Modelo de datos

- **Tabla:** `categorias`
- **Migración:** `database/migrations/2026_05_13_161955_create_categorias_table.php`

| Columna   | Tipo        | Notas |
|-----------|-------------|--------|
| `id`      | bigint PK   | Usado en URLs públicas (`/productos/{id}`, etc.) |
| `nombre`  | string      | |
| `color`   | string, null | En admin es obligatorio; formato hex `#RRGGBB` |
| `imagen`  | string, null | Misma convención que productos: `images/...` en `public` o ruta en disco `public` |
| `catalogo`| string, null | PDF en storage (`catalogos/...`), URL absoluta `http(s)://...`, o vacío |
| `timestamps` | | |

## Modelo Eloquent

- **Clase:** `App\Models\Categoria`
- **Asignación masiva:** `nombre`, `color`, `imagen`, `catalogo`
- **Relación:** `hasMany(Producto::class)` como `productos()`
- **Atributo calculado:** `imagen_url` — misma lógica que en `Producto`: placeholder, prefijo `images/`, o `storage/` para subidas

No existe accessor para URL del catálogo PDF; la resolución del enlace “Descargar catálogo” se hace en la vista de categoría de productos (ver más abajo).

## Rutas públicas (solo lectura)

Las categorías **no** tienen una ruta dedicada tipo `/categorias/{id}`. El flujo público es:

1. **`GET /productos`** — muestra todas las categorías como tarjetas (`ProductoController@index`).
2. **`GET /productos/{categoria}`** — `{categoria}` se resuelve al modelo `Categoria` por id (`ProductoController@categoria`).

El *binding* es el estándar de Laravel sobre la clave primaria.

## Panel de administración

- **Archivo de rutas:** `routes/admin.php` (grupo `prefix('admin')` + `middleware('auth')`)
- **Recurso:** `Route::resource('categorias', ...)` con nombres `admin.categorias.*`
- **Controlador:** `App\Http\Controllers\Admin\CategoriaController`

Acciones:

- **index:** `Categoria::withCount('productos')->get()` — muestra cuántos productos tiene cada categoría
- **store:** campos `nombre`, `color`; imagen opcional vía `OptimizedPublicImage::store(..., 'categorias')`; PDF opcional con `$request->file('catalogo')->store('catalogos', 'public')`
- **update:** mismos campos; reemplazo de imagen o PDF borra el fichero previo en disco `public` si existía
- **destroy:** elimina imagen y catálogo del disco `public` si están definidos, luego el registro (los productos asociados se eliminan por **cascade** en BD al borrar la categoría)

## Validación (Form Requests)

- **`StoreCategoriaRequest` / `UpdateCategoriaRequest`:**
  - `nombre`: requerido, string, máx. 255
  - `color`: requerido, hex de 6 dígitos (`#` + `[0-9A-Fa-f]{6}`)
  - `imagen`: opcional, imagen, máx. 2 MB
  - `catalogo`: opcional, solo PDF, máx. 10 MB (`File::types(['pdf'])->max(10240)`)

## Catálogo PDF en la ficha pública de categoría

En `resources/views/productos/categoria.blade.php`:

- Si `catalogo` está vacío: enlace por defecto a `asset('images/Catálogo 2026 para la pagina web.pdf')`.
- Si `catalogo` empieza por `http`: se usa tal cual (enlace externo).
- En otro caso: `asset($categoria->catalogo)`.

Los archivos subidos desde admin quedan con rutas relativas tipo `catalogos/nombre.pdf` en el disco `public` de Laravel (servidos habitualmente bajo `/storage/...` si existe el enlace simbólico `public/storage`). Conviene verificar en entorno que la URL generada coincida con la ruta real de los PDF (si hiciera falta, alinear con `asset('storage/'.$categoria->catalogo)` para rutas no HTTP).

El botón aplica el atributo `download` solo cuando la URL final **no** es `http://` ni `https://`.

## Integración con productos

- Los productos referencian `categoria_id`; la migración de productos usa `onDelete('cascade')` sobre `categorias`.
- La navegación lateral y el selector móvil en la vista de categoría listan todas las categorías ordenadas por `id` y enlazan a `route('productos.categoria', $cat->id)`.

## Datos de ejemplo

`Database\Seeders\CategoriasSeeder` crea varias categorías con `nombre`, `color` e `imagen` bajo `images/...` en `public` (sin `catalogo` en el seeder).

## Vistas de administración

- `resources/views/admin/categorias/index.blade.php` — listado con conteo de productos e indicador de si hay PDF
- `resources/views/admin/categorias/create.blade.php` / `edit.blade.php` — formularios con color, imagen y catálogo

## Servicio de imágenes

Las imágenes de categoría subidas por el admin pasan por `App\Services\Images\OptimizedPublicImage` (mismo criterio que en productos: GD, WebP preferente, límites de tamaño, etc.).
