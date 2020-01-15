# Container - Contenedor Responsive

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Contenedor principal responsive para el layout.

**Clase PHP**: [`Container.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Layout/Container.php)

## Ejemplos

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Container normal
$container = BS5::container([
    'content' => 'Contenido del sitio'
])->render();

// Container fluid (ancho completo)
$container = BS5::container([
    'content' => 'Contenido de ancho completo',
    'fluid' => true
])->render();

// Container con breakpoint
$container = BS5::container([
    'content' => 'Contenido',
    'fluid' => 'md' // Fluid hasta md, luego container
])->render();
```

[← Volver al Índice](../../Bootstrap.md)
