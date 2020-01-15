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
    'imagePosition' => 'top',  // 'top' o 'bottom'
    'imageAttributes' => ['class' => 'p-2']  // Clases CSS adicionales para la imagen
]);

echo $card->render();
```

**Características:**
- Imagen en la parte superior
- Imagen responsive (`img-fluid`)
- Position: 'top' o 'bottom'
- Soporte para atributos personalizados en la imagen

---

## Ejemplo 3: Footer como texto plano

```php
$card = new Card([
    'title'   => 'Artículo del Blog',
    'content' => 'Contenido del artículo...',
    'footer'  => 'Publicado el 25 de diciembre de 2024',
]);

echo $card->render();
```

**Características:**
- Texto escapado automáticamente
- Ideal para metadata estática (fechas, autoría, etc.)

---

## Ejemplo 3b: Footer con un componente BS5

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

$card = BS5::card([
    'headerTitle' => 'Acceso denegado',
    'headerClass' => 'bg-danger text-white',
    'htmlContent' => '<p class="text-center py-2">No tiene permisos para ver esta sección.</p>',
    'footer'      => BS5::button([
        'content'    => 'Volver al inicio',
        'variant'    => 'danger',
        'size'       => 'sm',
        'attributes' => ['href' => '/inicio'],
    ]),
    'footerAttributes' => ['class' => 'd-flex justify-content-end'],
    'attributes'       => ['class' => 'border-danger shadow-sm'],
]);

echo $card;
```

**Características:**
- `footer` recibe directamente el `TagInterface` de `BS5::button()`
- El componente **no se escapa** — `AbstractTag` detecta `TagInterface` y lo renderiza tal cual
- `footerAttributes` sigue siendo válido para controlar alineación y otros atributos

---

## Ejemplo 3c: Footer con varios botones (array de componentes)

```php
$cancelBtn = BS5::button([
    'content'    => 'Cancelar',
    'variant'    => 'secondary',
    'size'       => 'sm',
    'attributes' => ['href' => '/lista'],
]);
$deleteBtn = BS5::button([
    'content'    => 'Eliminar',
    'variant'    => 'danger',
    'size'       => 'sm',
    'attributes' => ['href' => '/delete/123'],
]);

$card = BS5::card([
    'headerTitle' => 'Confirmar eliminación',
    'htmlContent' => '<p class="py-2">¿Está seguro que desea eliminar este registro?</p>',
    'footer'      => [$cancelBtn, $deleteBtn],
    'footerAttributes' => ['class' => 'd-flex justify-content-end gap-2'],
]);

echo $card;
```

**Características:**
- `footer` recibe un array de índices numéricos → lista de componentes
- Cada `TagInterface` se renderiza sin escape
- Diferente del array de configuración: no contiene las claves `content`, `htmlContent`, `class` ni `attributes`

---

## Ejemplo 3d: Footer con array de configuración (forma recomendada)

```php
$_icon = (string) BS5::icon(['icon' => 'lock', 'style' => 'duotone', 'size' => '2xl']);

$card = BS5::card([
    'headerTitle' => lang('App.login-required-title'),
    'headerClass' => 'bg-danger text-white',
    'htmlContent' => '<div class="text-center py-3">'.$_icon.'</div>'
                   . '<p class="text-center pb-2">'.lang('App.login-required-message').'</p>',
    'footer'      => [
        'content'    => BS5::button([
            'content'    => lang('App.Continue'),
            'variant'    => 'danger',
            'size'       => 'sm',
            'attributes' => ['href' => $continue],
        ]),
        'class'      => 'd-flex justify-content-end',
        'attributes' => ['id' => 'footer-acceso'],
    ],
    'attributes'  => ['class' => 'border-danger shadow-sm'],
]);

echo $card;
```

**Características:**
- Combina contenido y atributos del footer en un solo array
- `content` acepta `TagInterface`, array de `TagInterface` o string
- `htmlContent` como alternativa a `content` para HTML crudo
- `class` define las clases del `div.card-footer`
- `attributes` agrega atributos HTML adicionales al footer
- Elimina la necesidad de la clave separada `footerAttributes`

**Regla de detección:** si el array contiene alguna de las claves `content`, `htmlContent`, `class` o `attributes`, se trata como array de configuración; de lo contrario, como lista de componentes (ejemplo 3c).

---

## Ejemplo 4: Content como array de configuración (NUEVO - forma recomendada)

Permite controlar las clases y atributos del body junto con el contenido, manteniendo la simetría con `header` y `footer`:

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

$_icon = (string) BS5::icon([
    'icon'  => 'ban',
    'style' => 'duotone',
    'size'  => '4x'
]);

$_continue = BS5::button([
    'content'    => lang('App.Continue'),
    'variant'    => 'danger',
    'size'       => 'md',
    'attributes' => ['href' => '/login'],
]);

$card = BS5::card([
    'header' => [
        'title' => lang('App.Access-denied-title'),
        'class' => 'bg-danger text-white'
    ],
    'content' => [
        'htmlContent' => $_icon . '<p class="text-center pb-2">' . lang('App.Access-denied-message') . '</p>',
        'class'       => 'text-center py-3',
        'attributes'  => ['data-role' => 'error-message'],
    ],
    'footer' => [
        'content'   => $_continue,
        'class'     => 'd-flex justify-content-end',
        'attributes' => ['id' => 'footer-acceso'],
    ],
    'attributes' => ['class' => 'border-danger shadow-sm'],
]);

echo $card;
```

**Características:**
- ✅ Simétrico con `header` y `footer` — mismo patrón de configuración
- ✅ Sin concatenación manual de HTML fuera del componente
- ✅ Control completo del `div.card-body` (clase, atributos)
- ✅ Soporta `htmlContent` (HTML sin escapar) y `content` (texto escapado)
- ✅ Claves: `content`, `htmlContent`, `class`, `attributes`

**Detección automática:**
Si el array `content` contiene alguna de las claves `content`, `htmlContent`, `class` o `attributes`, se trata como array de configuración; de lo contrario, como lista de componentes.

---

## Ejemplo 4b: Card con htmlContent (legacy)

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

## Ejemplo 5: Header como string directo

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

$card = BS5::card([
    'header'  => 'Usuario #1234',
    'content' => 'Información del usuario...',
]);

echo $card;
```

**Características:**
- Forma más concisa para headers simples
- El string se escapa automáticamente

---

## Ejemplo 5b: Header con array de configuración (forma recomendada)

```php
$editBtn = BS5::button(['htmlContent' => '<i class="fas fa-edit"></i>',  'variant' => 'warning', 'size' => 'sm']);
$deleteBtn = BS5::button(['htmlContent' => '<i class="fas fa-trash"></i>', 'variant' => 'danger',  'size' => 'sm']);

$card = BS5::card([
    'header' => [
        'title'   => 'Usuario #1234',
        'class'   => 'bg-primary text-white',
        'buttons' => [$editBtn, $deleteBtn],
    ],
    'content' => 'Información del usuario...',
]);

echo $card;
```

**Características:**
- Combina título, clase y botones en un único array
- `buttons` → alineados a la derecha con `btn-group`
- Reemplaza las claves legacy `headerTitle`, `headerClass`, `headerButtons`

---

## Ejemplo 5c: Header con título HTML (badges, iconos)

```php
$card = BS5::card([
    'header' => [
        'htmlTitle' => 'Módulo <span class="badge bg-success ms-1">Nuevo</span>',
        'class'     => 'bg-light',
    ],
    'content' => 'Contenido del módulo...',
]);

echo $card;
```

**Características:**
- `htmlTitle` para HTML sin escapar en el título
- ⚠️ **Advertencia**: Solo con HTML confiable y hardcoded

---

## Ejemplo 5d: Header con atributos HTML adicionales

```php
$card = BS5::card([
    'header' => [
        'title'      => 'Configuración',
        'class'      => 'bg-dark text-white',
        'attributes' => ['id' => 'header-config', 'data-section' => 'admin'],
    ],
    'content' => 'Opciones de configuración...',
]);

echo $card;
```

---

## Ejemplo 6: Compatibilidad con claves legacy

Las claves `headerTitle`, `headerHtmlTitle`, `headerClass`, `headerButtons` y `headerAttributes`
siguen funcionando. Si se proveen junto a `header`, la clave `header` tiene prioridad.

```php
// Legacy (sigue siendo válido)
$card = BS5::card([
    'headerTitle'   => 'Dashboard',
    'headerClass'   => 'bg-info text-white',
    'headerButtons' => [BS5::button(['content' => 'Acción', 'variant' => 'light', 'size' => 'sm'])],
    'content'       => 'Contenido...',
]);
```

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
    'imageAttributes' => ['class' => 'p-3'],  // Padding para la imagen
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

## Ejemplo 7.2: Card con boton de retorno tipo enlace


```php
$backBtn = new Button([
    'htmlContent' => '<i class="fas fa-chevron-left"></i>',
    'variant' => 'secondary',
    'size' => 'md',
    'attributes' => [
        'href' => $back,
    ]
]);

$card = new Card([
    'headerTitle' => lang("Sie_Progress.edit-title"),
    'headerButtons' => [$backBtn->render()],
    'htmlContent' => $f,
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
    'header' => [
        'htmlTitle'  => 'Usuario: <strong>John Doe</strong>',
        'class'      => 'bg-primary text-white',
        'buttons'    => [$editBtn, $deleteBtn],
        'attributes' => ['data-user-id' => '123'],
    ],

    // Imagen
    'image' => '/images/user-avatar.jpg',
    'imagePosition' => 'top',
    'imageAttributes' => ['class' => 'p-1', 'alt' => 'Avatar de John Doe'],

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
| `content` | `string\|TagInterface\|array` | null | Contenido del body. Ver formas de uso abajo. |
| `htmlContent` | string | null | HTML sin escapar (alternativa a content a nivel raíz) |
| `footer` | `string\|TagInterface\|array` | null | Texto del footer |
| `image` | string | null | URL de la imagen |
| `imagePosition` | string | 'top' | Posición: 'top' o 'bottom' |
| `imageAttributes` | array | [] | Atributos de la imagen |
| `attributes` | array | [] | Atributos del contenedor principal |

### Header

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `header` | `string\|array` | null | Header unificado. Ver formas de uso abajo. |
| `headerTitle` | `string` | null | Título del header, escapado (legacy, alternativa a `header[title]`) |
| `headerHtmlTitle` | `string` | null | Título HTML sin escapar (legacy, alternativa a `header[htmlTitle]`) |
| `headerClass` | `string` | null | Clases CSS del header (legacy, alternativa a `header[class]`) |
| `headerButtons` | `array` | [] | Botones del header (legacy, alternativa a `header[buttons]`) |
| `headerAttributes` | `array` | [] | Atributos del header (legacy, alternativa a `header[attributes]`) |

**Formas de uso de `header`:**

| Forma | Ejemplo | Resultado |
|-------|---------|-----------|
| Título directo | `'header' => 'Título'` | Escapado automáticamente |
| Array de configuración | `'header' => ['title' => ..., 'class' => ..., 'buttons' => [...], 'attributes' => [...]]` | Forma recomendada |

**Claves del array de configuración de `header`:**

| Clave | Tipo | Descripción |
|-------|------|-------------|
| `title` | `string` | Título del header (escapado) |
| `htmlTitle` | `string` | Título HTML sin escapar (alternativa a `title`) |
| `class` | `string` | Clases CSS del `div.card-header` |
| `buttons` | `array<TagInterface>` | Botones alineados a la derecha |
| `attributes` | `array` | Atributos HTML adicionales del `div.card-header` |

### Body (Content)

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `content` | `string\|TagInterface\|array` | null | Contenido del body. Ver formas de uso abajo. |
| `bodyAttributes` | array | [] | Atributos del body (alternativa a `content[attributes]`) |

**Formas de uso de `content`:**

| Forma | Ejemplo | Resultado |
|-------|---------|-----------|
| Texto plano | `'content' => 'Texto'` | Escapado automáticamente |
| Componente | `'content' => BS5::button([...])` | Renderizado sin escape |
| Lista de componentes | `'content' => [BS5::button([...]), BS5::button([...])]` | Cada uno renderizado sin escape |
| Array de configuración | `'content' => ['htmlContent' => ..., 'class' => ..., 'attributes' => [...]]` | Forma recomendada |

**Claves del array de configuración de `content`:**

| Clave | Tipo | Descripción |
|-------|------|-------------|
| `content` | `TagInterface\|array<TagInterface>\|string` | Contenido del body |
| `htmlContent` | `string` | HTML crudo sin escapar (alternativa a `content`) |
| `class` | `string` | Clases CSS del `div.card-body` |
| `attributes` | `array` | Atributos HTML adicionales del `div.card-body` |

### Footer

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `footer` | `string\|TagInterface\|array` | null | Pie de la tarjeta. Ver formas de uso abajo. |
| `footerAttributes` | `array` | [] | Atributos del `div.card-footer` (alternativa a `footer[attributes]`) |

**Formas de uso de `footer`:**

| Forma | Ejemplo | Resultado |
|-------|---------|-----------|
| Texto plano | `'footer' => 'Texto'` | Escapado automáticamente |
| Componente | `'footer' => BS5::button([...])` | Renderizado sin escape |
| Lista de componentes | `'footer' => [BS5::button([...]), BS5::button([...])]` | Cada uno renderizado sin escape |
| Array de configuración | `'footer' => ['content' => ..., 'class' => ..., 'attributes' => [...]]` | Forma recomendada |

**Claves del array de configuración de `footer`:**

| Clave | Tipo | Descripción |
|-------|------|-------------|
| `content` | `TagInterface\|array<TagInterface>\|string` | Contenido del footer |
| `htmlContent` | `string` | HTML crudo sin escapar (alternativa a `content`) |
| `class` | `string` | Clases CSS del `div.card-footer` |
| `attributes` | `array` | Atributos HTML adicionales del `div.card-footer` |

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

### ✅ content, title y footer (string)

Cuando `footer` recibe un **string**, se escapa automáticamente:

```php
// ✅ SEGURO - Automáticamente escapado
$card = new Card([
    'title'   => $_POST['title'],    // ✅ Se escapa automáticamente
    'content' => $_GET['content'],   // ✅ Se escapa automáticamente
    'footer'  => $_POST['footer'],   // ✅ Se escapa automáticamente (solo cuando es string)
]);
```

Cuando `footer` recibe un `TagInterface` o un array de configuración con `content` (TagInterface), **no se escapa** — el componente ya genera HTML seguro. Solo use `footer[htmlContent]` con HTML confiable y hardcoded.

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
    'imageAttributes' => ['class' => 'p-2'],
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
    'imageAttributes' => ['class' => 'p-1', 'alt' => 'Avatar de ' . $user->name],
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
