# Ejemplos: Componente Card

Componente Card de Bootstrap 5.3.3 para crear tarjetas con header, body, footer e imágenes.

---

## Ejemplo 1: Card Básica

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Interface\Card;

$card = new Card([
    'title' => 'Título de la tarjeta',
    'content' => 'Este es el contenido de la tarjeta. Puede incluir texto, imágenes o cualquier otro elemento.'
]);

echo $card->render();
```

**Características:**
- Card básica con título y contenido
- Contenido escapado por seguridad
- Sin imagen ni footer

---

## Ejemplo 2: Card con Imagen

```php
$card = new Card([
    'title' => 'Producto Premium',
    'content' => 'Descripción del producto con todas sus características.',
    'image' => '/images/product.jpg',
    'imagePosition' => 'top'  // 'top' o 'bottom'
]);

echo $card->render();
```

**Características:**
- Imagen en la parte superior
- Imagen responsive (`img-fluid`)
- Position: 'top' o 'bottom'

---

## Ejemplo 3: Card con Footer

```php
$card = new Card([
    'title' => 'Artículo del Blog',
    'content' => 'Contenido del artículo...',
    'footer' => 'Publicado el 25 de diciembre de 2024'
]);

echo $card->render();
```

**Características:**
- Footer para metadata
- Típico en artículos o posts
- Texto escapado automáticamente

---

## Ejemplo 4: Card con htmlContent

```php
$card = new Card([
    'title' => 'Dashboard',
    'htmlContent' => '<div class="row">
        <div class="col-6">
            <strong>Usuarios:</strong> 1,234
        </div>
        <div class="col-6">
            <strong>Ventas:</strong> $45,678
        </div>
    </div>'
]);

echo $card->render();
```

**Características:**
- Usa `htmlContent` para HTML sin escapar
- Permite estructura HTML compleja
- ⚠️ **Advertencia**: Solo con HTML confiable

---

## Ejemplo 5: Card con Header Completo y Botones

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Interface\Button;

$editBtn = new Button([
    'htmlContent' => '<i class="fas fa-edit"></i>',
    'variant' => 'warning',
    'size' => 'sm'
]);

$deleteBtn = new Button([
    'htmlContent' => '<i class="fas fa-trash"></i>',
    'variant' => 'danger',
    'size' => 'sm'
]);

$card = new Card([
    'headerTitle' => 'Usuario #1234',
    'headerClass' => 'bg-primary text-white',
    'headerButtons' => [$editBtn, $deleteBtn],
    'content' => 'Información del usuario...'
]);

echo $card->render();
```

**Características:**
- Header con título y botones
- Botones alineados a la derecha
- Usa `btn-toolbar` y `btn-group`
- `<h5 class="card-title mb-0">` para el título

---

## Ejemplo 6: Card con headerHtmlTitle

```php
$card = new Card([
    'headerHtmlTitle' => 'Módulo <span class="text-muted">v2.0</span>',
    'headerClass' => 'bg-light',
    'content' => 'Contenido del módulo...'
]);

echo $card->render();
```

**Características:**
- `headerHtmlTitle` para HTML sin escapar
- Permite formato personalizado
- ⚠️ **Advertencia**: Solo con HTML confiable

---

## Ejemplo 7: Card con Imagen y Todo

```php
$saveBtn = new Button([
    'content' => 'Guardar',
    'variant' => 'success',
    'size' => 'sm'
]);

$card = new Card([
    'headerHtmlTitle' => 'Producto <span class="badge bg-success">Nuevo</span>',
    'headerButtons' => [$saveBtn],
    'image' => '/images/product.jpg',
    'imagePosition' => 'top',
    'htmlContent' => '<p>Este producto incluye:</p>
        <ul>
            <li>Característica 1</li>
            <li>Característica 2</li>
            <li>Característica 3</li>
        </ul>',
    'footer' => 'Precio: $99.99'
]);

echo $card->render();
```

**Características:**
- Header completo con título HTML y botones
- Imagen superior
- Contenido HTML estructurado
- Footer con información adicional

---

## Ejemplo 8: Card con Atributos Personalizados

```php
$card = new Card([
    'title' => 'Tarjeta Personalizada',
    'content' => 'Contenido...',
    'attributes' => [
        'class' => 'shadow-lg border-0',
        'data-card-id' => '12345',
        'style' => 'max-width: 400px;'
    ]
]);

echo $card->render();
```

**Características:**
- Clases CSS adicionales
- Data attributes
- Estilos inline
- Totalmente personalizable

---

## Ejemplo 9: Card con Header, Body y Footer Attributes

```php
$card = new Card([
    'headerTitle' => 'Configuración',
    'headerAttributes' => [
        'class' => 'bg-dark text-white'
    ],
    'content' => 'Opciones de configuración...',
    'bodyAttributes' => [
        'class' => 'bg-light',
        'style' => 'min-height: 200px;'
    ],
    'footer' => 'Guardar cambios',
    'footerAttributes' => [
        'class' => 'text-end bg-secondary text-white'
    ]
]);

echo $card->render();
```

**Características:**
- Atributos específicos para header, body y footer
- Control total sobre estilos
- Clases CSS personalizadas

---

## Ejemplo 10: Card Horizontal

```php
$card = Card::horizontal(
    '/images/product.jpg',
    'Producto Destacado',
    'Descripción del producto...',
    ['class' => 'shadow']
);

echo $card->render();
```

**Características:**
- Método estático `horizontal()`
- Layout horizontal (imagen a la izquierda)
- Usa `flex-row`

---

## Ejemplo 11: Card con List Group

```php
$card = new Card([
    'title' => 'Tareas Pendientes',
    'listItems' => [
        'Revisar correos',
        'Actualizar documentación',
        'Preparar presentación'
    ]
]);

echo $card->render();
```

**Características:**
- Lista dentro de la card
- Usa `list-group-flush`
- Sin bordes entre items

---

## Ejemplo 12: Card con Tabs

```php
$card = new Card([
    'tabs' => [
        'home' => [
            'title' => 'Inicio',
            'content' => 'Contenido de inicio'
        ],
        'profile' => [
            'title' => 'Perfil',
            'content' => 'Contenido del perfil'
        ],
        'contact' => [
            'title' => 'Contacto',
            'content' => 'Información de contacto'
        ]
    ]
]);

echo $card->render();
```

**Características:**
- Tabs integrados en la card
- Header con navegación
- Content con tab-panes

---

## Ejemplo 13: Card Completa (Todo junto)

```php
$editBtn = new Button([
    'htmlContent' => '<i class="fas fa-edit"></i> Editar',
    'variant' => 'warning',
    'size' => 'sm'
]);

$deleteBtn = new Button([
    'htmlContent' => '<i class="fas fa-trash"></i> Eliminar',
    'variant' => 'danger',
    'size' => 'sm'
]);

$card = new Card([
    // Header
    'headerHtmlTitle' => 'Usuario: <strong>John Doe</strong>',
    'headerClass' => 'bg-primary text-white',
    'headerButtons' => [$editBtn, $deleteBtn],
    'headerAttributes' => ['data-user-id' => '123'],
    
    // Imagen
    'image' => '/images/user-avatar.jpg',
    'imagePosition' => 'top',
    
    // Body
    'htmlContent' => '<div class="user-info">
        <p><strong>Email:</strong> john@example.com</p>
        <p><strong>Rol:</strong> <span class="badge bg-success">Admin</span></p>
        <p><strong>Estado:</strong> <span class="badge bg-info">Activo</span></p>
    </div>',
    'bodyAttributes' => ['class' => 'p-4'],
    
    // Footer
    'footer' => 'Última conexión: Hace 2 horas',
    'footerAttributes' => ['class' => 'text-muted small'],
    
    // Container
    'attributes' => [
        'class' => 'shadow-lg border-0',
        'style' => 'max-width: 500px;'
    ]
]);

echo $card->render();
```

**Características:**
- Todas las opciones combinadas
- Header con título HTML y botones
- Imagen
- Body con HTML personalizado
- Footer con metadata
- Atributos en todos los niveles

---

## Opciones Disponibles

### Opciones Principales

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `title` | string | null | Título en el body (escapado) |
| `content` | string | null | Contenido del body (escapado) |
| `htmlContent` | string | null | HTML sin escapar (alternativa a content) |
| `footer` | string | null | Texto del footer |
| `image` | string | null | URL de la imagen |
| `imagePosition` | string | 'top' | Posición: 'top' o 'bottom' |
| `attributes` | array | [] | Atributos del contenedor principal |

### Header Completo

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `headerTitle` | string | null | Título del header (escapado) |
| `headerHtmlTitle` | string | null | Título HTML sin escapar |
| `headerClass` | string | null | Clases CSS del header |
| `headerButtons` | array | [] | Botones alineados a la derecha |
| `headerAttributes` | array | [] | Atributos del header |

### Body

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `bodyAttributes` | array | [] | Atributos del body |

### Footer

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `footerAttributes` | array | [] | Atributos del footer |

### Características Especiales

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `listItems` | array | [] | Items de lista |
| `tabs` | array | [] | Tabs dentro de la card |

---

## Estructura del Header con Botones

Cuando se usa `headerTitle` o `headerHtmlTitle` con `headerButtons`, se genera:

```html
<div class="card-header {headerClass}">
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">
            {headerTitle or headerHtmlTitle}
        </h5>
        <div class="btn-toolbar ms-auto" role="toolbar">
            <div class="btn-group mx-0" role="group">
                <!-- headerButtons aquí -->
            </div>
        </div>
    </div>
</div>
```

---

## Método Estático: horizontal()

```php
Card::horizontal(
    string $imageUrl,
    ?string $title = null,
    $content = null,
    array $attributes = []
): Card
```

**Ejemplo:**
```php
$card = Card::horizontal(
    '/images/product.jpg',
    'Producto',
    'Descripción',
    ['class' => 'shadow']
);
```

Automáticamente agrega `flex-row` a los atributos.

---

## Notas de Seguridad

### ⚠️ htmlContent y headerHtmlTitle

**NUNCA** usar con entrada de usuario no sanitizada:

```php
// ❌ PELIGROSO - Vulnerabilidad XSS
$card = new Card([
    'headerHtmlTitle' => $_POST['title'],     // ❌ PELIGROSO
    'htmlContent' => $_GET['content']         // ❌ PELIGROSO
]);

// ✅ SEGURO - HTML confiable
$card = new Card([
    'headerHtmlTitle' => 'Producto <span class="badge">Nuevo</span>',  // ✅ SEGURO
    'htmlContent' => '<p>Descripción <strong>formateada</strong></p>'  // ✅ SEGURO
]);
```

### ✅ content, title y footer

Por defecto, estos campos **siempre escapan** el HTML:

```php
// ✅ SEGURO - Automáticamente escapado
$card = new Card([
    'title' => $_POST['title'],      // ✅ Se escapa automáticamente
    'content' => $_GET['content'],   // ✅ Se escapa automáticamente
    'footer' => $_POST['footer']     // ✅ Se escapa automáticamente
]);
```

---

## Ejemplos de Uso Real

### Dashboard Widget

```php
$statsCard = new Card([
    'headerTitle' => 'Estadísticas del Mes',
    'headerClass' => 'bg-info text-white',
    'htmlContent' => '<div class="row text-center">
        <div class="col-4">
            <h3>1,234</h3>
            <small>Usuarios</small>
        </div>
        <div class="col-4">
            <h3>567</h3>
            <small>Ventas</small>
        </div>
        <div class="col-4">
            <h3>$89K</h3>
            <small>Ingresos</small>
        </div>
    </div>',
    'attributes' => ['class' => 'shadow']
]);
```

### Card de Producto

```php
$productCard = new Card([
    'image' => $product->imageUrl,
    'imagePosition' => 'top',
    'title' => $product->name,
    'content' => $product->shortDescription,
    'footer' => 'Precio: $' . number_format($product->price, 2),
    'attributes' => ['class' => 'h-100']
]);
```

### Card de Perfil con Acciones

```php
$editBtn = new Button(['content' => 'Editar', 'variant' => 'primary', 'size' => 'sm']);
$deleteBtn = new Button(['content' => 'Eliminar', 'variant' => 'danger', 'size' => 'sm']);

$profileCard = new Card([
    'headerHtmlTitle' => $user->name . ' <span class="badge bg-' . $user->statusColor . '">' . $user->status . '</span>',
    'headerButtons' => [$editBtn, $deleteBtn],
    'image' => $user->avatarUrl,
    'htmlContent' => "<p><strong>Email:</strong> {$user->email}</p>
                      <p><strong>Teléfono:</strong> {$user->phone}</p>
                      <p><strong>Departamento:</strong> {$user->department}</p>",
    'footer' => 'Miembro desde: ' . $user->createdAt->format('d/m/Y')
]);
```

---

## Referencias

- **Componente**: [`Card.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Interface/Card.php)
- **Estándares**: [`COMPONENT_STANDARDS.md`](file:///c:/xampp/htdocs/system/Frontend/COMPONENT_STANDARDS.md)
- **Bootstrap Docs**: [Bootstrap 5.3 Cards](https://getbootstrap.com/docs/5.3/components/card/)
