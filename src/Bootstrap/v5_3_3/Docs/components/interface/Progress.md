# Progress - Barra de Progreso

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Componentes de progreso para mostrar el avance de procesos, carga de archivos, completitud de formularios y más.

**Clase PHP**: [`Progress.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Interface/Progress.php)

## Opciones

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `value` | `int` | `0` | Valor actual (0-100) |
| `min` | `int` | `0` | Valor mínimo |
| `max` | `int` | `100` | Valor máximo |
| `variant` | `string` | `'primary'` | Color de la barra |
| `striped` | `bool` | `false` | Si tiene rayas |
| `animated` | `bool` | `false` | Si está animado |
| `label` | `string\|null` | `null` | Etiqueta visible |
| `height` | `string\|null` | `null` | Altura personalizada |
| `attributes` | `array` | `[]` | Atributos HTML |

## Ejemplos

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Barra básica
$progress = BS5::progress([
    'value' => 75,
    'variant' => 'success'
])->render();

// Barra con rayas
$progress = BS5::progress([
    'value' => 50,
    'striped' => true,
    'variant' => 'info'
])->render();

// Barra animada
$progress = BS5::progress([
    'value' => 60,
    'striped' => true,
    'animated' => true,
    'variant' => 'warning'
])->render();

// Con etiqueta
$progress = BS5::progress([
    'value' => 80,
    'label' => '80%',
    'variant' => 'primary'
])->render();

// Altura personalizada
$progress = BS5::progress([
    'value' => 40,
    'height' => '3px'
])->render();
```

[← Volver al Índice](../../Bootstrap.md) | [Siguiente: Toast →](Toast.md)
