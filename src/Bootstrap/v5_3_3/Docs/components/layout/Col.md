# Col - Columna del Grid

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Columna del sistema de grid responsive.

**Clase PHP**: [`Col.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Layout/Col.php)

## Ejemplos `php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Columna básica
$col = BS5::col([
    'content' => 'Contenido',
    'size' => '6' // col-6
])->render();

// Columna responsive
$col = BS5::col([
    'content' => 'Contenido',
    'xs' => '12',
    'md' => '6',
    'lg' => '4'
])->render();

// Columna con offset
$col = BS5::col([
    'content' => 'Contenido centrado',
    'size' => '6',
    'offset' => '3'
])->render();
```

[← Volver al Índice](../../Bootstrap.md)
