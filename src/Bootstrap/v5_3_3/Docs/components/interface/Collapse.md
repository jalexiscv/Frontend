# Collapse - Elementos Colapsables

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Oculta y muestra contenido con transiciones suaves. Base para componentes como Accordion.

**Clase PHP**: [`Collapse.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Interface/Collapse.php)

## Opciones

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `id` | `string` | - | **Requerido**. ID del collapse |
| `content` | `mixed` | - | Contenido a mostrar/ocultar |
| `horizontal` | `bool` | `false` | Si colapsa horizontalmente |
| `attributes` | `array` | `[]` | Atributos HTML |

## Ejemplos

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Collapse básico
$collapse = BS5::collapse([
    'id' => 'collapseExample',
    'content' => 'Este contenido se puede mostrar u ocultar'
])->render();

// Botón para activar
$button = BS5::button([
    'content' => 'Toggle Collapse',
    'variant' => 'primary',
    'attributes' => [
        'data-bs-toggle' => 'collapse',
        'data-bs-target' => '#collapseExample'
    ]
])->render();

// Collapse horizontal
$collapseH = BS5::collapse([
    'id' => 'collapseHorizontal',
    'content' => 'Colapso horizontal',
    'horizontal' => true
])->render();
```

## Componentes Relacionados

- [Accordion](Accordion.md) - Múltiples collapses organizados
- [Button](Button.md) - Para activar collapses

## Documentación Oficial

[Bootstrap 5.3 Collapse](https://getbootstrap.com/docs/5.3/components/collapse/)

---

[← Volver al Índice](../../Bootstrap.md) | [Siguiente: ListGroup →](ListGroup.md)
