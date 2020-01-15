# Tooltip - Información Contextual

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Tooltips pequeños con información contextual que aparecen al pasar el mouse sobre un elemento.

**Clase PHP**: [`Tooltip.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Interface/Tooltip.php)

## Opciones

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `content` | `string` | - | **Requerido**. Texto del tooltip |
| `placement` | `string` | `'top'` | Posición: `top`, `right`, `bottom`, `left` |
| `html` | `bool` | `false` | Si el contenido es HTML |
| `attributes` | `array` | `[]` | Atributos del elemento trigger |

## Ejemplos

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Tooltip básico
$tooltip = BS5::tooltip([
    'content' => 'Información útil',
    'attributes' => ['label' => 'Pasa el mouse aquí']
])->render();

// Tooltip en posiciones diferentes
$tooltipTop = BS5::tooltip([
    'content' => 'Tooltip arriba',
    'placement' => 'top',
    'attributes' => ['label' => 'Arriba']
])->render();

$tooltipRight = BS5::tooltip([
    'content' => 'Tooltip derecha',
    'placement' => 'right',
    'attributes' => ['label' => 'Derecha']
])->render();

// Tooltip con HTML
$tooltipHTML = BS5::tooltip([
    'content' => '<strong>Texto</strong> con HTML',
    'html' => true,
    'attributes' => ['label' => 'HTML']
])->render();
```

**Nota**: Los tooltips requieren inicialización con JavaScript:

```javascript
// Inicializar todos los tooltips
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})
```

## Componentes Relacionados

- [Popover](Popover.md) - Para información más extensa

## Documentación Oficial

[Bootstrap 5.3 Tooltips](https://getbootstrap.com/docs/5.3/components/tooltips/)

---

[← Volver al Índice](../../Bootstrap.md)
