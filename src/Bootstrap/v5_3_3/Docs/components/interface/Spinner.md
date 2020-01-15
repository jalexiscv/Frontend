# Spinner - Indicador de Carga

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Indicadores de carga animados para mostrar el estado de carga en proyectos. Perfecto para botones, páginas y componentes mientras se cargan.

**Clase PHP**: [`Spinner.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Interface/Spinner.php)

## Opciones

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `type` | `string` | `'border'` | Tipo: `border`, `grow` |
| `size` | `string\|null` | `null` | Tamaño: `sm` |
| `variant` | `string` | `'primary'` | Color del spinner |
| `label` | `string` | `'Loading...'` | Texto de accesibilidad |
| `attributes` | `array` | `[]` | Atributos HTML |

## Ejemplos

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Spinner border
$spinner = BS5::spinner(['variant' => 'primary'])->render();

// Spinner grow
$spinner = BS5::spinner([
    'type' => 'grow',
    'variant' => 'success'
])->render();

// Spinner pequeño
$spinner = BS5::spinner([
    'size' => 'sm',
    'variant' => 'danger'
])->render();

// En botones
$button = BS5::button([
    'content' => BS5::spinner(['size' => 'sm'])->render() . ' Cargando...',
    'variant' => 'primary',
    'disabled' => true
])->render();
```

[← Volver al Índice](../../Bootstrap.md) | [Siguiente: Progress →](Progress.md)
