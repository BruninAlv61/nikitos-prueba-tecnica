# Panel de administración

Documentación técnica del **back-office** bajo el prefijo `/admin`: autenticación, rutas, layout y módulos.

## Acceso y seguridad

- **URL base:** todas las rutas del panel viven bajo el prefijo `admin` (p. ej. `/admin/productos`).
- **Middleware:** el grupo en `routes/admin.php` usa `middleware('auth')`. Cualquier usuario **autenticado** puede entrar; no hay roles ni permisos granulares en código.
- **Sesión:** misma pila `web` que el resto del sitio (sesión, CSRF, cookies).
- **Entrada habitual:** tras iniciar sesión (`/login`, Breeze), la ruta nombrada `dashboard` en `routes/web.php` **redirige** a `admin.productos.index` en lugar de mostrar un dashboard genérico.

## Registro de rutas

El archivo `routes/admin.php` se carga desde `bootstrap/app.php` con el middleware `web`, igual que `routes/web.php`, de modo que el panel comparte cookies de sesión y protección CSRF con el sitio público.

Estructura del grupo (resumen):

| Tipo | Ruta HTTP | Controlador | Nombres de ruta (`admin.*`) |
|------|-----------|---------------|---------------------------|
| Resource | `/admin/productos` | `Admin\ProductoController` | `admin.productos.*` |
| Resource | `/admin/categorias` | `Admin\CategoriaController` | `admin.categorias.*` |
| Resource | `/admin/recetas` | `Admin\RecetaController` | `admin.recetas.*` |
| Resource (parcial) | `/admin/contactos` | `Admin\ContactoController` | solo `index`, `show`, `destroy` |
| GET | `/admin/contenido` | `Admin\ContenidoController@index` | `admin.contenido.index` |
| GET/PUT | `/admin/nosotros-contenido` | `Admin\NosotrosContenidoController` | `admin.nosotros.edit` / `update` |
| GET/PUT | `/admin/inicio-contenido` | `Admin\InicioContenidoController` | `admin.inicio-contenido.edit` / `update` |

Los verbos estándar de `Route::resource` aplican donde el recurso está completo (productos, categorías, recetas).

## Layout y navegación

- **Plantilla:** `resources/views/admin/layout.blade.php`.
- **Sección de contenido:** las vistas hijas usan `@section('contenido')` (no `@section('content')` del layout público).
- **Estilos y scripts:** CSS y JS del shell del admin van **embebidos** en el layout (variables CSS, sidebar, tablas, formularios, alertas). No dependen de Vite; el panel es autocontenido y usable aunque el build del front público falle.
- **Sidebar:** enlaces a Productos, Categorías, Recetas, Contactos, Contenido; enlace “Ver sitio” a la home pública; formulario POST a `route('logout')` con `@csrf` para cerrar sesión.
- **Estado activo:** cada enlace marca `active` con `request()->routeIs('admin.productos.*')` (y análogos); la sección Contenido agrupa rutas `admin.contenido.*`, `admin.nosotros.*` e `admin.inicio-contenido.*`.
- **Responsive:** por debajo de ~900px hay topbar con botón menú, drawer lateral y backdrop; desde desktop el sidebar queda fijo a la izquierda.

## Módulos (responsabilidades)

### Productos y categorías

CRUD completo con Form Requests, asignación de categoría en productos, checkbox **destacado** en productos, subida de imágenes vía `OptimizedPublicImage`, y en categorías además **color** (hex), **imagen** y **catálogo PDF** en disco `public` (`catalogos/`). Detalle de modelo y rutas públicas en [implementacion-productos.md](./implementacion-productos.md) e [implementacion-categorias.md](./implementacion-categorias.md).

### Recetas

Listado ordenado por más recientes (`latest()`), CRUD con ingredientes y pasos como arrays filtrados en el controlador, imagen opcional con el mismo servicio de optimización en carpeta `recetas/`.

### Contactos

Solo lectura y borrado: listado de mensajes del formulario público, vista detalle y `destroy`. No hay edición ni respuesta desde el panel.

### Contenido del sitio

- **`ContenidoController@index`:** página índice con enlaces a las pantallas de edición de textos (Inicio, Nosotros, etc.).
- **`NosotrosContenidoController`:** edición del registro singleton `NosotrosContenido` (validación con `UpdateNosotrosContenidoRequest`).
- **`InicioContenidoController`:** edición del registro `InicioContenido` (textos del hero y bloques); permite subir/reemplazar un PDF de catálogo en hero (`store` en `catalogos/`, disco `public`), borrando el anterior si existe.

## Mensajes flash y formularios

- Tras crear, actualizar o eliminar, los controladores suelen hacer `redirect()->route(...)->with('success', '...')`.
- El layout muestra `@if(session('success'))` un bloque `.alert-success` encima del `@yield('contenido')`.
- Formularios con archivos usan `enctype="multipart/form-data"` donde corresponde.

## Imágenes en el admin

Productos, categorías y recetas comparten el flujo documentado en [image-optimization.md](./image-optimization.md) (`App\Services\Images\OptimizedPublicImage`).

## Relación con el sitio público

- Los datos editados en el admin alimentan las vistas públicas (productos, categorías, recetas, textos de inicio/nosotros).
- El enlace “Ver sitio” usa `route('home')` para comprobar cambios en contexto real.

## Ampliaciones típicas

- Restringir `/admin` a usuarios con un campo `is_admin` o un paquete de roles.
- Extraer el CSS del layout a un archivo compilado o a un `@vite` dedicado si el panel crece mucho.
- Añadir políticas Laravel (`authorize` en controladores o Form Requests) por recurso.

Para la organización general del repositorio, ver [estructura-proyecto.md](./estructura-proyecto.md).
