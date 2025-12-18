# Grid - Sistema de Grid

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Sistema de grid completo con filas y columnas.

**Clase PHP**: [`Grid.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Layout/Grid.php)

## Ejemplos

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Grid básico
$grid = BS5::grid([
    'rows' => [
        [
            BS5::col(['content' => 'Col 1', 'size' => '4'])->render(),
            BS5::col(['content' => 'Col 2', 'size' => '4'])->render(),
            BS5::col(['content' => 'Col 3', 'size' => '4'])->render()
        ],
        [
            BS5::col(['content' => 'Col ancho completo', 'size' => '12'])->render()
        ]
    ]
])->render();
```

[← Volver al Índice](../../Bootstrap.md)
