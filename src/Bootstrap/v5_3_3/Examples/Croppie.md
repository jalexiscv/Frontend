# Ejemplos: Componente Croppie

Componente Croppie de Bootstrap 5.3.3 para recortar y subir imágenes.

---

## Ejemplo 1: Croppie Básico (Cuadrado)

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Extras\Croppie;

$croppie = new Croppie([
    'oid' => $userId,
    'reference' => 'USER_PHOTO'
]);

echo $croppie->render();
```

**Características:**
- Viewport 720x480 (cuadrado)
- Boundary 740x500
- Upload a `/storage/images/croppie/{oid}`

---

## Ejemplo 2: Avatar Circular

```php
$avatar = new Croppie([
    'id' => 'avatar-cropper',
    'oid' => $userId,
    'viewport' => [
        'width' => 300,
        'height' => 300,
        'type' => 'circle'  // Circular
    ],
    'boundary' => [
        'width' => 400,
        'height' => 400
    ],
    'output' => [
        'width' => 600,
        'height' => 600
    ],
    'reference' => 'USER_AVATAR'
]);

echo $avatar->render();
```

**Características:**
- Recorte circular para avatares
- Output 600x600 (alta resolución)
- Ideal para fotos de perfil

---

## Ejemplo 3: Con Imagen Precargada

```php
$croppie = new Croppie([
    'id' => 'photo-editor',
    'oid' => $productId,
    'image' => '/uploads/products/photo-original.jpg',  // Imagen existente
    'viewport' => [
        'width' => 600,
        'height' => 400,
        'type' => 'square'
    ],
    'boundary' => [
        'width' => 700,
        'height' => 500
    ],
    'reference' => 'PRODUCT_IMAGE'
]);

echo $croppie->render();
```

**Características:**
- Carga imagen existente automáticamente
- Permite editar foto ya subida
- Útil para actualizar imágenes

---

## Ejemplo 4: URL de Upload Personalizada

```php
$croppie = new Croppie([
    'oid' => $postId,
    'reference' => 'POST_COVER',
    'uploadUrl' => '/api/posts/upload-cover',  // URL personalizada
    'viewport' => [
        'width' => 800,
        'height' => 400,
        'type' => 'square'
    ],
    'output' => [
        'width' => 1600,
        'height' => 800
    ]
]);

echo $croppie->render();
```

**Características:**
- URL de endpoint personalizada
- No usa URL por defecto
- Útil para diferentes rutas de API

---

## Ejemplo 5: Con CSRF Tokens (Framework)

```php
$croppie = new Croppie([
    'oid' => $userId,
    'reference' => 'PROFILE_PIC',
    'uploadUrl' => '/users/upload-photo',
    'csrfToken' => csrf_token(),   // Nombre del token CSRF
    'csrfHash' => csrf_hash(),     // Hash del token
    'viewport' => [
        'width' => 400,
        'height' => 400,
        'type' => 'circle'
    ]
]);

echo $croppie->render();
```

**Características:**
- Envía tokens CSRF en FormData
- Compatible con frameworks (CodeIgniter, Laravel, etc.)
- Seguridad contra CSRF

---

## Ejemplo 6: Campo de Formulario Personalizado

```php
$croppie = new Croppie([
    'oid' => $companyId,
    'reference' => 'COMPANY_LOGO',
    'fieldName' => 'companyLogo',  // Nombre del campo en FormData
    'viewport' => [
        'width' => 200,
        'height' => 200,
        'type' => 'square'
    ],
    'output' => [
        'width' => 400,
        'height' => 400
    ]
]);

echo $croppie->render();
```

**Características:**
- Nombre de campo personalizado
- Útil para múltiples croppers en misma página
- FormData enviará: `companyLogo => Blob`

---

## Ejemplo 7: Assets Personalizados

```php
$croppie = new Croppie([
    'oid' => $userId,
    'reference' => 'PHOTO',
    'assetsUrl' => '/public/libs/croppie',  // Carpeta personalizada
    'viewport' => [
        'width' => 500,
        'height' => 500,
        'type' => 'circle'
    ]
]);

echo $croppie->render();
```

**Características:**
- Carga CSS/JS desde ubicación personalizada
- Útil si Croppie.js está en otra carpeta
- Permite versiones personalizadas

---

## Ejemplo 8: Sin Assets (Cargados Externamente)

```php
// En el HTML, cargar manualmente:
// <link rel="stylesheet" href="/libs/croppie/croppie.css">
// <script src="/libs/croppie/croppie.js"></script>

$croppie = new Croppie([
    'oid' => $userId,
    'reference' => 'AVATAR',
    'includeAssets' => false,  // No incluir assets automáticamente
    'viewport' => [
        'width' => 300,
        'height' => 300,
        'type' => 'circle'
    ]
]);

echo $croppie->render();
```

**Características:**
- Assets ya cargados en el layout
- Evita cargar múltiples veces
- Mejor para múltiples instancias

---

## Ejemplo 9: Foto de Producto (Rectangular)

```php
$croppie = new Croppie([
    'id' => 'product-photo',
    'oid' => $productId,
    'reference' => 'PRODUCT_MAIN',
    'viewport' => [
        'width' => 600,
        'height' => 800,  // Formato vertical
        'type' => 'square'
    ],
    'boundary' => [
        'width' => 700,
        'height' => 900
    ],
    'output' => [
        'width' => 1200,
        'height' => 1600
    ]
]);

echo $croppie->render();
```

**Características:**
- Formato vertical para productos
- Alta resolución de salida
- Boundary adaptado al viewport

---

## Ejemplo 10: Banner Horizontal

```php
$croppie = new Croppie([
    'id' => 'banner-cropper',
    'oid' => $eventId,
    'reference' => 'EVENT_BANNER',
    'viewport' => [
        'width' => 900,
        'height' => 300,  // Formato horizontal
        'type' => 'square'
    ],
    'boundary' => [
        'width' => 1000,
        'height' => 400
    ],
    'output' => [
        'width' => 1800,
        'height' => 600
    ]
]);

echo $croppie->render();
```

**Características:**
- Formato panorámico 3:1
- Ideal para banners y covers
- Output de alta resolución

---

## Ejemplo 11: Con Atributos HTML Personalizados

```php
$croppie = new Croppie([
    'oid' => $userId,
    'reference' => 'PHOTO',
    'attributes' => [
        'class' => 'my-custom-cropper',
        'data-analytics' => 'photo-upload',
        'data-user-id' => $userId
    ],
    'viewport' => [
        'width' => 400,
        'height' => 400,
        'type' => 'circle'
    ]
]);

echo $croppie->render();
```

**Características:**
- Clases CSS personalizadas
- Data attributes para JavaScript/Analytics
- Totalmente personalizable

---

## Opciones Disponibles

### Opciones Principales

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `id` | string | auto | ID único del componente |
| `oid` | string\|int | '0' | Object ID (para URL y POST) |
| `image` | string | null | URL de imagen a precargar |
| `reference` | string | 'DEFAULT' | Referencia para identificar upload |
| `uploadUrl` | string | `/storage/images/croppie/{oid}` | URL del endpoint |
| `fieldName` | string | 'attachment' | Nombre del campo en FormData |
| `csrfToken` | string | null | Nombre token CSRF |
| `csrfHash` | string | null | Valor del hash CSRF |
| `assetsUrl` | string | `/themes/assets/libraries/croppie` | URL de assets |
| `includeAssets` | bool | true | Incluir CSS/JS automáticamente |
| `attributes` | array | [] | Atributos HTML adicionales |

### Viewport (Área de Recorte)

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `width` | int | 720 | Ancho del viewport |
| `height` | int | 480 | Alto del viewport |
| `type` | string | 'square' | Tipo: 'square' o 'circle' |

### Boundary (Contenedor)

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `width` | int | 740 | Ancho del contenedor |
| `height` | int | 500 | Alto del contenedor |

### Output (Salida)

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `width` | int | null | Ancho de imagen final |
| `height` | int | null | Alto de imagen final |

---

## FormData Enviado

El componente envía los siguientes datos en el POST:

```javascript
{
    "field": "attachment",
    "object": "{oid}",           // Object ID
    "reference": "{reference}",  // Referencia
    "{fieldName}": Blob,         // Imagen (Blob)
    "{csrfToken}": "{csrfHash}"  // Si está configurado
}
```

---

## Controles del Modal

El modal de Croppie incluye:

**Rotación:**
- 🔄 Rotar izquierda (90°)
- 🔄 Rotar derecha (-90°)

**Zoom:**
- 🔍 Zoom in (paso 0.1)
- 🔍 Zoom out (paso 0.1)
- 🖱️ Ctrl + rueda del mouse

**Upload:**
- ☁️ Botón "Recortar y subir"

---

## Validaciones

El componente valida:

1. ✅ Viewport type debe ser 'square' o 'circle'
2. ✅ Viewport width/height > 0
3. ✅ Boundary width >= Viewport width
4. ✅ Boundary height >= Viewport height

**Ejemplo de error:**
```php
// ❌ Esto lanzará InvalidArgumentException
$croppie = new Croppie([
    'viewport' => ['width' => 500, 'height' => 500],
    'boundary' => ['width' => 400, 'height' => 400]  // ❌ Menor que viewport
]);
```

---

## Notas Importantes

### 📝 Object ID (oid)

El `oid` se usa para:
1. Construir URL por defecto: `/storage/images/croppie/{oid}`
2. Enviar en FormData: `object => {oid}`
3. Identificar el objeto asociado en el servidor

### 📝 Reference

La `reference` permite identificar el tipo de upload:
- `'USER_AVATAR'` - Avatar de usuario
- `'PRODUCT_IMAGE'` - Foto de producto
- `'POST_COVER'` - Portada de post
- etc.

### 📝 Output Dimensions

Si no se especifica `output`, se usa el tamaño del viewport.

Para imágenes de alta calidad, usar output 2x del viewport:
```php
'viewport' => ['width' => 400, 'height' => 400],
'output' => ['width' => 800, 'height' => 800]  // 2x para alta resolución
```

---

## Referencias

- **Componente**: [`Croppie.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Extras/Croppie.php)
- **Estándares**: [`COMPONENT_STANDARDS.md`](file:///c:/xampp/htdocs/system/Frontend/COMPONENT_STANDARDS.md)
- **Librería**: [Croppie.js](https://foliotek.github.io/Croppie/)
