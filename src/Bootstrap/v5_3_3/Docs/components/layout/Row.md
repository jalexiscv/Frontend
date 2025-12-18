# Row - Fila del Grid

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Fila del sistema de grid de Bootstrap.

**Clase PHP**: [`Row.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Layout/Row.php)

## Ejemplos

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Row básico
$row = BS5::row([
    'content' => [
        BS5::col(['content' => 'Columna 1', 'size' => '6'])->render(),
        BS5::col(['content' => 'Columna 2', 'size' => '6'])->render()
    ]
])->render();

// Row con gutters personalizados
$row = BS5::row([
    'content' => '...',
    'gutter' => 5 // g-5
])->render();
```

[← Volver al Índice](../../Bootstrap.md)
