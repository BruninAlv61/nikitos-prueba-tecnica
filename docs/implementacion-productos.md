# Implementación técnica: Productos

Este documento describe cómo están modelados, validados y expuestos los **productos** en la aplicación Laravel.

## Modelo de datos

- **Tabla:** `productos`
- **Migración principal:** `database/migrations/2026_05_13_161955_create_productos_table.php`
- **Campo adicional:** `destacado` (boolean, por defecto `false`) en `database/migrations/2026_05_14_104711_add_destacado_to_productos_table.php`

| Columna       | Tipo        | Notas |
|---------------|-------------|--------|
| `id`          | bigint PK   | |
| `nombre`      | string      | |
| `codigo`      | string      | Único en toda la tabla |
| `tamaño`      | string, null | |
| `vida_util`   | string, null | |
| `imagen`      | string, null | Ruta relativa: `public/` (prefijo `images/`) o disco `public` de storage |
| `destacado`   | boolean     | Home: hasta 4 productos con `destacado = true` |
| `categoria_id`| FK          | `constrained('categorias')->onDelete('cascade')` |
| `timestamps`  | | |

## Modelo Eloquent

- **Clase:** `App\Models\Producto`
- **Asignación masiva:** `nombre`, `codigo`, `tamaño`, `vida_util`, `imagen`, `categoria_id`, `destacado`
- **Relación:** `belongsTo(Categoria::class)` como `categoria()`
- **Atributo calculado:** `imagen_url` (accessor `getImagenUrlAttribute`)
  - Sin imagen: `asset('images/placeholder.png')`
  - Valor que empieza por `images/`: tratado como archivo bajo `public/` → `asset($this->imagen)`
  - En cualquier otro caso: imagen subida por admin → `asset('storage/'.$this->imagen)`

## Rutas públicas

Definidas en `routes/web.php`, controlador `App\Http\Controllers\ProductoController`:

| Método | URI | Nombre de ruta | Comportamiento |
|--------|-----|----------------|----------------|
| GET | `/productos` | `productos` | Lista categorías (grid); no carga productos en bloque |
| GET | `/productos/{categoria}` | `productos.categoria` | Resolución por **id** de `Categoria`; carga `productos` de esa categoría |
| GET | `/productos/{categoria}/{producto}` | `productos.show` | Ficha: requiere que el `Producto` exista; además calcula anterior/siguiente dentro de la misma categoría (por `id`) y hasta 3 relacionados |

El *route model binding* usa la clave primaria numérica (no hay `getRouteKeyName()` personalizado). Las vistas generan enlaces explícitos con `[$categoria->id, $producto->id]` donde aplica.

## Panel de administración

- **Prefijo:** `/admin` (agrupado en `routes/admin.php` con middleware `web` y `auth`)
- **Recurso:** `Route::resource('productos', ...)` con nombres `admin.productos.*`
- **Controlador:** `App\Http\Controllers\Admin\ProductoController`

Acciones:

- **index:** `Producto::with('categoria')->get()`
- **create / edit:** listan todas las categorías para el selector
- **store / update:** datos validados vía `StoreProductoRequest` / `UpdateProductoRequest`; `destacado` con `$request->boolean('destacado')`
- **Imagen:** si hay archivo, se guarda con `App\Services\Images\OptimizedPublicImage::store($file, 'productos')` (WebP/PNG/JPEG según GD; GIF sin reprocesar; fallback a `store()` de Laravel si GD no está disponible o falla el procesado)
- **update:** si llega nueva imagen, se borra la anterior del disco `public` con `Storage::disk('public')->delete($producto->imagen)` cuando existía ruta guardada
- **destroy:** elimina fichero de imagen en disco `public` si existe, luego borra el registro

## Validación (Form Requests)

- **`StoreProductoRequest`:** `nombre`, `codigo` (único en `productos`), `tamaño`, `vida_util`, `categoria_id` (exists), `imagen` (opcional, imagen, máx. 2 MB), `destacado` opcional boolean
- **`UpdateProductoRequest`:** igual salvo `codigo` con `unique` ignorando el producto actual

## Uso en la home

`App\Http\Controllers\PaginaController` (método que sirve la home) carga:

```php
Producto::where('destacado', true)->with('categoria')->take(4)->get();
```

La vista `resources/views/partials/destacados.blade.php` enlaza cada tarjeta a `route('productos.show', [$producto->categoria->id, $producto->id])`.

## Datos de ejemplo

`Database\Seeders\ProductosSeeder` inserta productos de ejemplo con imágenes bajo `images/...` en `public` y `destacado => true` en varios registros.

## Vistas públicas relacionadas

- `resources/views/productos/index.blade.php` — listado de categorías hacia `productos.categoria`
- `resources/views/productos/categoria.blade.php` — grid de productos de una categoría
- `resources/views/productos/show.blade.php` — detalle, navegación y relacionados

## Dependencias transversales

- **Categorías:** todo producto debe referenciar una categoría existente; la eliminación en cascada de la categoría borra sus productos a nivel de base de datos.
- **Imágenes:** coherente con el servicio compartido descrito en `docs/image-optimization.md` (si está presente en el repositorio).
