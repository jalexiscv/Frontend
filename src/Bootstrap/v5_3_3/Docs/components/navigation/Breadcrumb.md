# Breadcrumb - Migas de Pan

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Navegación jerárquica que muestra la ubicación actual del usuario.

**Clase PHP**: [`Breadcrumb.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Navigation/Breadcrumb.php)

## Ejemplos

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Breadcrumb básico
$breadcrumb = BS5::breadcrumb([
    'items' => [
        ['label' => 'Inicio', 'href' => '/'],
        ['label' => 'Productos', 'href' => '/productos'],
        ['label' => 'Categoría', 'href' => '/productos/categoria'],
        ['label' => 'Producto', 'active' => true] // Última miga activa
    ]
])->render();
```

[← Volver al Índice](../../Bootstrap.md)
