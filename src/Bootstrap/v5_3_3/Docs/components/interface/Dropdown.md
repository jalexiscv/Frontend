# Dropdown - Menú Desplegable

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Menús desplegables contextuales para mostrar listas de enlaces y acciones.

**Clase PHP**: [`Dropdown.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Interface/Dropdown.php)

## Opciones

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `label` | `string` | `'Dropdown'` | Texto del botón |
| `items` | `array` | `[]` | Items del menú |
| `variant` | `string` | `'secondary'` | Variante de color |
| `split` | `bool` | `false` | Si es split button |
| `dropup` | `bool` | `false` | Si abre hacia arriba |
| `dropend` | `bool` | `false` | Si abre hacia la derecha |
| `dropstart` | `bool` | `false` | Si abre hacia la izquierda |
| `dark` | `bool` | `false` | Si es menú oscuro |
| `size` | `string\|null` | `null` | Tamaño: `sm`, `lg` |
| `attributes` | `array` | `[]` | Atributos HTML |

## Estructura de Items

```php
[
    ['label' => 'Acción 1', 'href' => '#', 'active' => false],
    ['divider' => true], // Divisor
    ['header' => true, 'label' => 'Encabezado'], // Encabezado
    ['label' => 'Acción 2', 'href' => '#']
]
```

## Ejemplos

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Dropdown básico
$dropdown = BS5::dropdown([
    'label' => 'Opciones',
    'items' => [
        ['label' => 'Acción 1', 'href' => '#'],
        ['label' => 'Acción 2', 'href' => '#'],
        ['divider' => true],
        ['label' => 'Otra acción', 'href' => '#']
    ]
])->render();

// Split button
$dropdown = BS5::dropdown([
    'label' => 'Acciones',
    'variant' => 'primary',
    'split' => true,
    'items' => [
        ['label' => 'Primera opción', 'href' => '#'],
        ['label' => 'Segunda opción', 'href' => '#']
    ]
])->render();

// Dropup
$dropdown = BS5::dropdown([
    'label' => 'Dropup',
    'dropup' => true,
    'items' => [
        ['label' => 'Opción', 'href' => '#']
    ]
])->render();
```

## Componentes Relacionados

- [Button](Button.md) - Botones individuales
- [ButtonGroup](ButtonGroup.md) - Grupos de botones

## Documentación Oficial

[Bootstrap 5.3 Dropdowns](https://getbootstrap.com/docs/5.3/components/dropdowns/)

---

[← Volver al Índice](../../Bootstrap.md) | [Siguiente: Collapse →](Collapse.md)
