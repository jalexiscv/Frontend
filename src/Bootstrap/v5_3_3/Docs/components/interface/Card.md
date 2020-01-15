# Card - Componente de Tarjeta

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Contenedor flexible y extensible que incluye opciones para headers, footers, contenido, colores y más.

**Clase PHP**: [`Card.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Interface/Card.php)

---

## Opciones de Configuración

### Contenedor principal

| Opción | Tipo | Descripción |
|--------|------|-------------|
| `attributes` | `array` | Atributos HTML del `div.card` |

### Header

El parámetro `header` es flexible, igual que `footer`:

| Forma | Tipo | Descripción |
|-------|------|-------------|
| Título directo | `string` | Título escapado, equivalente a `headerTitle` |
| Array de configuración | `array` | Forma recomendada: combina título, clase, botones y atributos |

**Claves del array de configuración:**

| Clave | Tipo | Descripción |
|-------|------|-------------|
| `title` | `string` | Título del header (escapado) |
| `htmlTitle` | `string` | Título HTML sin escapar (alternativa a `title`) |
| `class` | `string` | Clases CSS del `div.card-header` |
| `buttons` | `array` | Botones alineados a la derecha |
| `attributes` | `array` | Atributos HTML adicionales del `div.card-header` |

> Las claves legacy `headerTitle`, `headerHtmlTitle`, `headerClass`, `headerButtons` y `headerAttributes` se mantienen para compatibilidad. Si se proveen junto con `header`, la clave `header` tiene prioridad.

### Body

El parámetro `content` es flexible y admite cuatro formas de uso:

| Forma | Tipo | Descripción |
|-------|------|-------------|
| Texto plano | `string` | Texto escapado automáticamente |
| Componente | `TagInterface` | Resultado directo de `BS5::button()`, `BS5::badge()`, etc. |
| Lista de componentes | `array<TagInterface>` | Varios componentes como array de índices numéricos |
| Array de configuración | `array` | Forma recomendada: combina contenido y atributos del body |

**Claves del array de configuración:**

| Clave | Tipo | Descripción |
|-------|------|-------------|
| `content` | `TagInterface\|array<TagInterface>\|string` | Contenido del body |
| `htmlContent` | `string` | HTML crudo sin escapar (alternativa a `content`) |
| `class` | `string` | Clases CSS del `div.card-body` |
| `attributes` | `array` | Atributos HTML adicionales del `div.card-body` |

**Legacy:**

| Opción | Tipo | Descripción |
|--------|------|-------------|
| `title` | `string` | Título dentro del body como `<h5>` (escapado) |
| `bodyAttributes` | `array` | Atributos HTML del `div.card-body` (alternativa a `content[attributes]`) |

### Footer

El parámetro `footer` es flexible y admite cuatro formas de uso:

| Forma | Tipo | Descripción |
|-------|------|-------------|
| Texto plano | `string` | Texto escapado automáticamente |
| Componente | `TagInterface` | Resultado directo de `BS5::button()`, `BS5::badge()`, etc. |
| Lista de componentes | `array<TagInterface>` | Varios componentes como array de índices numéricos |
| Array de configuración | `array` | Forma recomendada: combina contenido y atributos del footer |

**Claves del array de configuración:**

| Clave | Tipo | Descripción |
|-------|------|-------------|
| `content` | `TagInterface\|array<TagInterface>\|string` | Contenido del footer |
| `htmlContent` | `string` | HTML crudo sin escapar (alternativa a `content`) |
| `class` | `string` | Clases CSS del `div.card-footer` |
| `attributes` | `array` | Atributos HTML adicionales del `div.card-footer` |

> `footerAttributes` se mantiene como alternativa separada para compatibilidad con código existente.

### Imagen

| Opción | Tipo | Descripción |
|--------|------|-------------|
| `image` | `string` | URL de la imagen |
| `imagePosition` | `string` | `'top'` (por defecto) o `'bottom'` |
| `imageAttributes` | `array` | Atributos HTML de la imagen |

### Especiales

| Opción | Tipo | Descripción |
|--------|------|-------------|
| `listItems` | `array` | Items de `list-group-flush` |
| `tabs` | `array` | Tabs con navegación integrada |

---

## Ejemplos

### Card básica

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

$card = BS5::card([
    'title'   => 'Título',
    'content' => 'Contenido de la card',
]);
```

### Footer como texto plano

```php
$card = BS5::card([
    'title'  => 'Artículo',
    'footer' => 'Publicado el 1 de abril de 2026',
]);
```

### Footer con un componente BS5 directo

```php
$card = BS5::card([
    'headerTitle' => 'Acceso denegado',
    'htmlContent' => '<p class="text-center">No tiene permisos.</p>',
    'footer'      => BS5::button(['content' => 'Continuar', 'variant' => 'danger', 'size' => 'sm',
                                  'attributes' => ['href' => '/inicio']]),
]);
```

### Footer con varios componentes

```php
$card = BS5::card([
    'headerTitle' => 'Confirmar eliminación',
    'htmlContent' => '<p>¿Desea eliminar este registro?</p>',
    'footer'      => [
        BS5::button(['content' => 'Cancelar',  'variant' => 'secondary', 'size' => 'sm', 'attributes' => ['href' => '/lista']]),
        BS5::button(['content' => 'Eliminar',  'variant' => 'danger',    'size' => 'sm', 'attributes' => ['href' => '/delete']]),
    ],
]);
```

### Footer con array de configuración (forma recomendada)

```php
$card = BS5::card([
    'headerTitle' => 'Se requiere inicio de sesión',
    'headerClass' => 'bg-danger text-white',
    'htmlContent' => '<div class="text-center py-3">'.BS5::icon([...]).'</div>'
                   . '<p class="text-center">Inicie sesión para continuar.</p>',
    'footer'      => [
        'content'    => BS5::button(['content' => 'Continuar', 'variant' => 'danger', 'size' => 'sm',
                                     'attributes' => ['href' => $continue]]),
        'class'      => 'd-flex justify-content-end',
        'attributes' => ['id' => 'card-footer-acceso'],
    ],
    'attributes'  => ['class' => 'border-danger shadow-sm'],
]);
```

### Header como string directo

```php
$card = BS5::card([
    'header'  => 'Dashboard',
    'content' => 'Contenido principal',
]);
```

### Header con array de configuración (forma recomendada)

```php
$card = BS5::card([
    'header' => [
        'title'   => 'Usuarios',
        'class'   => 'bg-primary text-white',
        'buttons' => [
            BS5::button(['content' => 'Editar',   'variant' => 'warning', 'size' => 'sm']),
            BS5::button(['content' => 'Eliminar', 'variant' => 'danger',  'size' => 'sm']),
        ],
        'attributes' => ['id' => 'card-header-usuarios'],
    ],
    'content' => 'Contenido principal',
]);
```

### Header con título HTML (badge, iconos, etc.)

```php
$card = BS5::card([
    'header' => [
        'htmlTitle' => 'Módulo <span class="badge bg-success ms-1">Nuevo</span>',
        'class'     => 'bg-light',
    ],
    'content' => 'Contenido del módulo...',
]);
```

### Content como array de configuración (forma recomendada)

Permite controlar las clases y atributos del body junto con el contenido:

```php
$_icon = (string)BS5::icon(['icon' => 'ban', 'style' => 'duotone', 'size' => '4x']);
$_continue = BS5::button(['content' => 'Continuar', 'variant' => 'danger', 'size' => 'md', 'attributes' => ['href' => '/login']]);

$card = BS5::card([
    'header' => [
        'title' => 'Acceso Denegado',
        'class' => 'bg-danger text-white'
    ],
    'content' => [
        'htmlContent' => $_icon . '<p class="text-center pb-2">No tienes permiso para acceder.</p>',
        'class'       => 'text-center py-3',
        'attributes'  => ['data-role' => 'error-message'],
    ],
    'footer' => [
        'content'   => $_continue,
        'class'     => 'd-flex justify-content-end',
        'attributes' => ['id' => 'card-footer-login'],
    ],
    'attributes' => ['class' => 'border-danger shadow-sm'],
]);
```

**Ventajas:**
- ✅ Simétrico con `header` y `footer`
- ✅ Sin concatenación manual de HTML fuera del componente
- ✅ Control completo del `div.card-body`

---

## Notas de seguridad

| Campo | ¿Se escapa? | Cuándo usar |
|-------|-------------|-------------|
| `title`, `content`, `footer` (string) | ✅ Sí | Texto dinámico, datos de usuario |
| `htmlContent`, `headerHtmlTitle`, `footer[htmlContent]` | ❌ No | Solo HTML confiable y hardcoded |

---

## Componentes relacionados

- [CardGroup](CardGroup.md) - Grupos de tarjetas
- [ListGroup](ListGroup.md) - Listas en cards

## Documentación oficial

[Bootstrap 5.3 Cards](https://getbootstrap.com/docs/5.3/components/card/)

---

[← Volver al Índice](../../Bootstrap.md) | [Siguiente: CardGroup →](CardGroup.md)
