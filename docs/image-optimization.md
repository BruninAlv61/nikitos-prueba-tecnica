# Optimización de imágenes en el panel de administración

## Resumen

Las imágenes raster subidas desde el panel de administración (campos **imagen** de producto, categoría y receta) pasan por `App\Services\Images\OptimizedPublicImage` antes de guardarse en el disco `public`. El objetivo es reducir tamaño y fijar un máximo de dimensiones sin servicios de pago ni paquetes Composer adicionales.

**Implementación:** `app/Services/Images/OptimizedPublicImage.php`  
**Puntos de uso:** `app/Http/Controllers/Admin/ProductoController.php`, `CategoriaController.php`, `RecetaController.php`

---

## Enfoque técnico

1. **Extensión GD de PHP**  
   Las imágenes se decodifican, se reescalan si hace falta y se vuelven a codificar con GD (suele venir con PHP o instalarse como `php-*-gd` en Linux). La API `Storage` de Laravel solo interviene en el `put()` final; no hay un pipeline de imágenes propio del framework.

2. **Redimensionado**  
   Si algún lado supera **1920 px**, se escala de forma proporcional para que el lado mayor quede en 1920 px. Las imágenes más pequeñas se mantienen en su resolución nativa (solo se aplica la recodificación).

3. **Formato de salida**  
   - **WebP** (calidad **82**) cuando exista `imagewebp` y `gd_info()['WebP Support']` esté activo: buena compresión y soporte amplio en navegadores para este caso de uso.  
   - **Reserva:** PNG (nivel de compresión **6**) si el origen era PNG/WebP y WebP no está disponible; JPEG (calidad **85**) si el origen era JPEG. En la ruta PNG/WebP se conserva el canal alfa con `imagesavealpha` y relleno transparente antes de `imagecopyresampled`.

4. **GIF**  
   Los GIF **no** se procesan con GD: se guardan con el `store()` habitual de Laravel para no romper ni aplanar GIFs animados.

5. **Ante fallos**  
   Si falta GD, no se puede crear el temporal, falla decodificar/codificar o el MIME no está soportado, el código **cae** a `$file->store($directory, 'public')` para que la subida no rompa el flujo del admin.

6. **Nombres de archivo**  
   Los archivos optimizados usan un **UUID** más extensión (`.webp`, `.png` o `.jpg`) para evitar colisiones y reflejar el formato real guardado.

---

## Decisiones relevantes

| Decisión | Motivo |
|----------|--------|
| **GD en lugar de Imagick o una librería Composer** | Sin dependencias extra; encaja en stacks típicos Laravel/PHP; sin coste de licencia; código fácil de revisar. |
| **Sin API “nativa” de imágenes en Laravel** | El framework no trae helpers de redimensionado/codificación; `Storage` solo maneja bytes. |
| **WebP como salida principal** | Buen equilibrio tamaño/calidad cuando GD lo soporta; alineado con frontends actuales. |
| **1920 px en el lado mayor** | Cubre uso tipo hero a ancho completo sin subidas enormes; acota CPU y memoria en hosting compartido. |
| **Paso directo de GIF** | Priorizar corrección frente a tamaño: un GIF multiframe se corrompería o aplanaría con un procesado ingenuo en GD. |
| **Procesado síncrono en la petición** | Más simple para una prueba técnica y poco tráfico de admin; el siguiente paso natural sería una cola para mucho tráfico o archivos muy grandes. |
| **PDF sin cambios** | Los catálogos PDF de categoría no son raster; por diseño no pasan por este helper. |

---

## Nota de despliegue

Asegúrate de que el entorno tenga **`ext-gd`** compilado con soporte **WebP** cuando sea posible (los nombres de paquete varían según el SO). Sin GD, el comportamiento se degrada con gracia al almacenamiento sin optimización, igual que en los controladores anteriores a esta capa.
