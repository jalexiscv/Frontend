# Offcanvas - Panel Lateral

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Paneles laterales ocultos que se deslizan desde los bordes de la pantalla.

**Clase PHP**: [`Offcanvas.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Interface/Offcanvas.php)

## Opciones

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `id` | `string` | - | **Requerido**. ID del offcanvas |
| `title` | `string` | - | Título |
| `body` | `mixed` | - | Contenido |
| `placement` | `string` | `'start'` | Posición: `start`, `end`, `top`, `bottom` |
| `backdrop` | `bool\|string` | `true` | `true`, `false` o `'static'` |
| `scroll` | `bool` | `false` | Permitir scroll del body |
| `dark` | `bool` | `false` | Tema oscuro |

## Ejemplos

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Offcanvas básico
$offcanvas = BS5::offcanvas([
    'id' => 'offcanvasExample',
    'title' => 'Menú',
    'body' => 'Contenido del panel lateral'
])->render();

// Botón para activar
$button = BS5::button([
    'content' => 'Abrir menú',
    'attributes' => [
        'data-bs-toggle' => 'offcanvas',
        'data-bs-target' => '#offcanvasExample'
    ]
])->render();

// Posición derecha
$offcanvas = BS5::offcanvas([
    'id' => 'offcanvasEnd',
    'title' => 'Panel Derecho',
    'body' => 'Contenido',
    'placement' => 'end'
])->render();
```

[← Volver al Índice](../../Bootstrap.md) | [Siguiente: Popover →](Popover.md)
