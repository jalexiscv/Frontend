# Badge - Componente de Etiqueta

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Los badges son pequeños componentes de conteo y etiquetado. Perfectos para mostrar cantidades, estados o categorías de forma visual y compacta.

**Clase PHP**: [`Badge.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Interface/Badge.php)

## Opciones de Configuración

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `content` | `string` | - | **Requerido**. Contenido del badge |
| `variant` | `string` | `'primary'` | Color: `primary`, `secondary`, `success`, `danger`, `warning`, `info`, `light`, `dark` |
| `pill` | `bool` | `false` | Si tiene forma de píldora (bordes completamente redondeados) |
| `position` | `string\|null` | `null` | Posición del badge |
| `notification` | `bool` | `false` | Si es un badge de notificación |
| `attributes` | `array` | `[]` | Atributos HTML adicionales |

## Ejemplos Básicos

### Badge Simple

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Badge básico
$badge = BS5::badge([
    'content' => 'Nuevo',
    'variant' => 'primary'
])->render();

// Badge de éxito
$badge = BS5::badge([
    'content' => 'Activo',
    'variant' => 'success'
])->render();

// Badge de error
$badge = BS5::badge([
    'content' => 'Error',
    'variant' => 'danger'
])->render();
```

### Todas las Variantes

```php
// Primary
BS5::badge(['content' => 'Primary', 'variant' => 'primary'])->render();

// Secondary
BS5::badge(['content' => 'Secondary', 'variant' => 'secondary'])->render();

// Success
BS5::badge(['content' => 'Success', 'variant' => 'success'])->render();

// Danger
BS5::badge(['content' => 'Danger', 'variant' => 'danger'])->render();

// Warning
BS5::badge(['content' => 'Warning', 'variant' => 'warning'])->render();

// Info
BS5::badge(['content' => 'Info', 'variant' => 'info'])->render();

// Light
BS5::badge(['content' => 'Light', 'variant' => 'light'])->render();

// Dark
BS5::badge(['content' => 'Dark', 'variant' => 'dark'])->render();
```

## Ejemplos Avanzados

### Badge Tipo Píldora

```php
// Badge con bordes redondeados
$badge = BS5::badge([
    'content' => '99+',
    'variant' => 'danger',
    'pill' => true
])->render();

// Badge de contador
$badge = BS5::badge([
    'content' => '42',
    'variant' => 'info',
    'pill' => true
])->render();
```

### Badge en Botones

```php
// Botón con contador
$button = BS5::button([
    'content' => 'Notificaciones ' . BS5::badge([
        'content' => '4',
        'variant' => 'light'
    ])->render(),
    'variant' => 'primary'
])->render();

// Botón con estado
$button = BS5::button([
    'content' => 'Mensajes ' . BS5::badge([
        'content' => 'Nuevo',
        'variant' => 'danger',
        'pill' => true
    ])->render(),
    'variant' => 'secondary'
])->render();
```

## Casos de Uso Comunes

### Contadores de Notificaciones

```php
// Contador de mensajes sin leer
$messagesBadge = BS5::badge([
    'content' => '15',
    'variant' => 'danger',
    'pill' => true
])->render();

// Contador de tareas pendientes
$tasksBadge = BS5::badge([
    'content' => '7',
    'variant' => 'warning',
    'pill' => true
])->render();
```

### Estados y Categorías

```php
// Estado de pedido
$statusBadge = BS5::badge([
    'content' => 'Enviado',
    'variant' => 'info'
])->render();

// Categoría de producto
$categoryBadge = BS5::badge([
    'content' => 'Electrónica',
    'variant' => 'secondary'
])->render();

// Nivel de usuario
$levelBadge = BS5::badge([
    'content' => 'Premium',
    'variant' => 'success',
    'pill' => true
])->render();
```

### Badges en Listas

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Lista de tareas con badges de prioridad
$taskList = '
<ul class="list-group">
    <li class="list-group-item d-flex justify-content-between align-items-center">
        Revisar documentación
        ' . BS5::badge(['content' => 'Alta', 'variant' => 'danger'])->render() . '
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
        Actualizar dependencias
        ' . BS5::badge(['content' => 'Media', 'variant' => 'warning'])->render() . '
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
        Limpiar caché
        ' . BS5::badge(['content' => 'Baja', 'variant' => 'info'])->render() . '
    </li>
</ul>
';
```

### Badges con Iconos

```php
// Badge con icono
$badge = BS5::badge([
    'content' => '<i class="bi bi-check-circle me-1"></i>Verificado',
    'variant' => 'success'
])->render();

// Badge de nuevo item
$badge = BS5::badge([
    'content' => '<i class="bi bi-star-fill me-1"></i>Nuevo',
    'variant' => 'warning',
    'pill' => true
])->render();
```

### Badges en Headers

```php
// Título con badge
$header = '
<h1>
    Mi Dashboard 
    ' . BS5::badge(['content' => 'Beta', 'variant' => 'secondary'])->render() . '
</h1>

<h3>
    Proyectos Activos 
    ' . BS5::badge(['content' => '12', 'variant' => 'primary', 'pill' => true])->render() . '
</h3>
';
```

## Métodos Fluentes Opcionales

```php
// Usar métodos encadenados
$badge = BS5::badge(['content' => '5'])
    ->setVariant('success')
    ->pill(true)
    ->render();
```

## Accesibilidad

Para badges que transmiten significado a través del color:
- Usa texto descriptivo dentro del badge
- Considera agregar `sr-only` con texto adicional para lectores de pantalla

```php
$badge = BS5::badge([
    'content' => '<span class="visually-hidden">Mensajes sin leer: </span>15',
    'variant' => 'danger',
    'pill' => true
])->render();
```

## Componentes Relacionados

- [Button](Button.md) - Para acciones interactivas con badges
- [Alert](Alert.md) - Para mensajes más extensos
- [ListGroup](ListGroup.md) - Para listas con badges

## Documentación Oficial de Bootstrap

[Bootstrap 5.3 Badges](https://getbootstrap.com/docs/5.3/components/badge/)

---

[← Volver al Índice](../../Bootstrap.md) | [Siguiente: Button →](Button.md)
