# Pagination - Paginación

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Paginación para navegación entre páginas de contenido.

**Clase PHP**: [`Pagination.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Navigation/Pagination.php)

## Ejemplos

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Paginación básica
$pagination = BS5::pagination([
    'totalPages' => 10,
    'currentPage' => 3,
    'baseUrl' => '/productos?page='
])->render();

// Paginación tamaño grande
$pagination = BS5::pagination([
    'totalPages' => 5,
    'currentPage' => 2,
    'size' => 'lg',
    'baseUrl' => '?page='
])->render();

// Paginación simple (prev/next)
$pagination = BS5::pagination([
    'simple' => true,
    'prevHref' => '?page=1',
    'nextHref' => '?page=3',
    'prevDisabled' => false,
    'nextDisabled' => false
])->render();
```

[← Volver al Índice](../../Bootstrap.md)
