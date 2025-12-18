# Button - Componente de Botón

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Botones personalizados de Bootstrap que incluyen soporte para múltiples tamaños, estados y variantes. Utiliza clases predefinidas para generar botones con estilos consistentes.

**Clase PHP**: [`Button.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Interface/Button.php)

## Opciones de Configuración

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `content` | `string` | - | **Requerido**. Texto del botón |
| `variant` | `string` | `'primary'` | Variante: `primary`, `secondary`, `success`, `danger`, `warning`, `info`, `light`, `dark`, `link` |
| `outline` | `bool` | `false` | Si es estilo outline (sin relleno) |
| `size` | `string\|null` | `null` | Tamaño: `sm` (pequeño), `lg` (grande) |
| `block` | `bool` | `false` | Si ocupa todo el ancho disponible |
| `active` | `bool` | `false` | Si aparece presionado |
| `disabled` | `bool` | `false` | Si está deshabilitado |
| `loading` | `bool` | `false` | Si muestra estado de carga |
| `loadingText` | `string` | `'Cargando...'` | Texto mientras carga |
| `icon` | `string\|null` | `null` | Clase del ícono a mostrar |
| `iconPosition` | `string` | `'start'` | Posición del ícono: `start`, `end` |
| `type` | `string` | `'button'` | Tipo: `button`, `submit`, `reset` |
| `attributes` | `array` | `[]` | Atributos HTML adicionales (ej: `['href' => '/url']` para enlace) |

## Ejemplos Básicos

### Botones por Variante

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Primary
BS5::button(['content' => 'Primary', 'variant' => 'primary'])->render();

// Secondary
BS5::button(['content' => 'Secondary', 'variant' => 'secondary'])->render();

// Success
BS5::button(['content' => 'Success', 'variant' => 'success'])->render();

// Danger
BS5::button(['content' => 'Danger', 'variant' => 'danger'])->render();

// Warning
BS5::button(['content' => 'Warning', 'variant' => 'warning'])->render();

// Info
BS5::button(['content' => 'Info', 'variant' => 'info'])->render();

// Light
BS5::button(['content' => 'Light', 'variant' => 'light'])->render();

// Dark
BS5::button(['content' => 'Dark', 'variant' => 'dark'])->render();

// Link (estilo de enlace)
BS5::button(['content' => 'Link', 'variant' => 'link'])->render();
```

### Botones Outline

```php
// Outline Primary
BS5::button([
    'content' => 'Outline Primary',
    'variant' => 'primary',
    'outline' => true
])->render();

// Outline Danger
BS5::button([
    'content' => 'Outline Danger',
    'variant' => 'danger',
    'outline' => true
])->render();
```

### Tamaños de Botones

```php
// Botón pequeño
BS5::button([
    'content' => 'Pequeño',
    'variant' => 'primary',
    'size' => 'sm'
])->render();

// Botón normal (sin especificar size)
BS5::button([
    'content' => 'Normal',
    'variant' => 'primary'
])->render();

// Botón grande
BS5::button([
    'content' => 'Grande',
    'variant' => 'primary',
    'size' => 'lg'
])->render();
```

## Ejemplos Avanzados

### Botones con Iconos

```php
// Icono al inicio
BS5::button([
    'content' => 'Guardar',
    'variant' => 'success',
    'icon' => 'bi bi-save',
    'iconPosition' => 'start'
])->render();

// Icono al final
BS5::button([
    'content' => 'Siguiente',
    'variant' => 'primary',
    'icon' => 'bi bi-arrow-right',
    'iconPosition' => 'end'
])->render();

// Solo icono (usando solo icono en content)
BS5::button([
    'content' => '<i class="bi bi-trash"></i>',
    'variant' => 'danger',
    'size' => 'sm',
    'attributes' => ['aria-label' => 'Eliminar']
])->render();
```

> [!NOTE]
> El ejemplo anterior mostrará el HTML escapado: `&lt;i class="bi bi-trash"&gt;&lt;/i&gt;`
> Para incluir HTML real (sin escapar), usa `Html::raw()` como se muestra a continuación.

### Botones con Contenido HTML (usando Html::raw())

Para incluir contenido HTML real (como íconos) que NO debe ser escapado:

```php
use Higgs\Html\Html;

// ✅ Botón con ícono Font Awesome (HTML sin escapar)
$icon = Html::raw('<i class="fas fa-user"></i>');
$button = BS5::button([
    'content' => [$icon, ' Usuario'],
    'variant' => 'primary'
])->render();

// ✅ Botón de edición con ícono
$editIcon = Html::raw('<i class="fa-sharp fa-light fa-pen-to-square"></i>');
$editButton = BS5::button([
    'content' => [$editIcon, ' Editar'],
    'variant' => 'warning',
    'size' => 'sm'
])->render();

// ✅ Botón solo con ícono
$deleteIcon = Html::raw('<i class="fas fa-trash"></i>');
$deleteButton = BS5::button([
    'content' => $deleteIcon,
    'variant' => 'danger',
    'size' => 'sm',
    'attributes' => ['aria-label' => 'Eliminar']
])->render();
```

> [!CAUTION]
> **Advertencia de Seguridad**: Solo usa `Html::raw()` con HTML **confiable** (hardcoded).
> 
> **NUNCA** lo uses con entrada de usuario sin sanitizar:
> ```php
> // ⚠️ PELIGROSO - Vulnerabilidad XSS
> $userInput = $_POST['html'];
> $unsafe = Html::raw($userInput); // ❌ NO HACER
> 
> // ✅ SEGURO - HTML hardcoded
> $icon = Html::raw('<i class="fas fa-save"></i>');
> $safe = BS5::button(['content' => [$icon, ' Guardar']]);
> ```


### Botones con Estado de Carga

```php
// Botón en estado de carga
BS5::button([
    'content' => 'Guardar',
    'variant' => 'primary',
    'loading' => true,
    'loadingText' => 'Guardando...'
])->render();

// Botón de envío con carga
BS5::button([
    'content' => 'Enviar Formulario',
    'variant' => 'success',
    'type' => 'submit',
    'loading' => false //  Cambiaría a true con JavaScript cuando se envíe
])->render();
```

### Botones Deshabilitados

```php
// Botón deshabilitado
BS5::button([
    'content' => 'No Disponible',
    'variant' => 'primary',
    'disabled' => true
])->render();
```

### Botones de Bloque (Ancho Completo)

```php
// Botón de ancho completo
BS5::button([
    'content' => 'Botón de Bloque',
    'variant' => 'primary',
    'block' => true
])->render();
```

### Botones como Enlaces

```php
// Botón que actúa como enlace
BS5::button([
    'content' => 'Ir al Dashboard',
    'variant' => 'primary',
    'attributes' => [
        'href' => '/dashboard'
    ]
])->render();

// Se renderiza as <a href="/dashboard" class="btn btn-primary">...</a>
```

## Casos de Uso Comunes

### Formularios

```php
// Grupo de botones de formulario
$submitButton = BS5::button([
    'content' => 'Guardar Cambios',
    'variant' => 'primary',
    'type' => 'submit'
])->render();

$cancelButton = BS5::button([
    'content' => 'Cancelar',
    'variant' => 'secondary',
    'attributes' => [
        'onclick' => 'history.back()'
    ]
])->render();
```

### Acciones de Datos

```php
// Botones de CRUD
$createBtn = BS5::button([
    'content' => '<i class="bi bi-plus"></i> Crear Nuevo',
    'variant' => 'success',
    'icon' => 'bi bi-plus-circle'
])->render();

$editBtn = BS5::button([
    'content' => 'Editar',
    'variant' => 'warning',
    'size' => 'sm'
])->render();

$deleteBtn = BS5::button([
    'content' => 'Eliminar',
    'variant' => 'danger',
    'size' => 'sm',
    'attributes' => [
        'onclick' => 'return confirm("¿Estás seguro?")'
    ]
])->render();
```

### Navegación

```php
// Botones de paginación personalizada
$prevBtn = BS5::button([
    'content' => '<i class="bi bi-chevron-left"></i> Anterior',
    'variant' => 'outline-primary'
])->render();

$nextBtn = BS5::button([
    'content' => 'Siguiente <i class="bi bi-chevron-right"></i>',
    'variant' => 'outline-primary'
])->render();
```

### Call-to-Action

```php
// Botón prominente de CTA
$ctaButton = BS5::button([
    'content' => 'Comienza Ahora Gratis',
    'variant' => 'success',
    'size' => 'lg',
    'block' => true
])->render();
```

## Métodos Fluentes

```php
// Construcción fluida de botones
$button = BS5::button(['content' => 'Click'])
    ->setVariant('primary')
    ->size('lg')
    ->outline(true)
    ->render();

// Con estado activo
$button = BS5::button(['content' => 'Seleccionado'])
    ->setVariant('primary')
    ->active(true)
    ->render();
```

## Accesibilidad

- Usa `type="button"` por defecto para evitar envíos accidentales de formularios
- Los botones deshabilitados incluyen atributos ARIA apropiados
- Para botones de solo icono, incluye `aria-label`:

```php
BS5::button([
    'content' => '<i class="bi bi-search"></i>',
    'variant' => 'primary',
    'attributes' => ['aria-label' => 'Buscar']
])->render();
```

## Componentes Relacionados

- [ButtonGroup](ButtonGroup.md) - Para agrupar botones
- [Dropdown](Dropdown.md) - Para menús desplegables en botones
- [Modal](Modal.md) - Para activar modales con botones

## Documentación Oficial de Bootstrap

[Bootstrap 5.3 Buttons](https://getbootstrap.com/docs/5.3/components/buttons/)

---

[← Volver al Índice](../../Bootstrap.md) | [Siguiente: ButtonGroup →](ButtonGroup.md)
