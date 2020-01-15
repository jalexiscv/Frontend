# Popover - Información Ampliada

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Popovers con información más extensa que los tooltips, incluyendo títulos y contenido estructurado.

**Clase PHP**: [`Popover.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Interface/Popover.php)

## Opciones

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `content` | `string` | - | **Requerido**. Contenido del popover |
| `title` | `string` | - | Título |
| `placement` | `string` | `'right'` | Posición: `top`, `right`, `bottom`, `left` |
| `trigger` | `string` | `'click'` | Trigger: `click`, `hover`, `focus` |
| `dismissible` | `bool` | `false` | Si es descartable |

## Ejemplos

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Popover básico
$popover = BS5::popover([
    'title' => 'Título del Popover',
    'content' => 'Contenido detallado del popover',
    'attributes' => ['label' => 'Click aquí']
])->render();

// Popover dismissible
$popover = BS5::popover([
    'content' => 'Click fuera para cerrar',
    'dismissible' => true,
    'attributes' => ['label' => 'Popover dismissible']
])->render();
```

**Nota**: Requiere inicialización JavaScript:
```javascript
var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
    return new bootstrap.Popover(popoverTriggerEl)
})
```

[← Volver al Índice](../../Bootstrap.md) | [Siguiente: Carousel →](Carousel.md)
