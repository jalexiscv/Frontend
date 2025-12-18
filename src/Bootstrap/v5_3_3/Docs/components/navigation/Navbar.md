# Navbar - Barra de Navegación

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Barra de navegación responsive con brand, enlaces y collapse.

**Clase PHP**: [`Navbar.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Navigation/Navbar.php)

## Ejemplos

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Navbar básico
$navbar = BS5::navbar([
    'brand' => 'Mi Sitio',
    'brandHref' => '/',
    'items' => [
        ['label' => 'Inicio', 'href' => '/', 'active' => true],
        ['label' => 'Productos', 'href' => '/productos'],
        ['label' => 'Contacto', 'href' => '/contacto']
    ]
])->render();

// Navbar con dropdown
$navbar = BS5::navbar([
    'brand' => 'App',
    'items' => [
        ['label' => 'Inicio', 'href' => '/'],
        [
            'label' => 'Más',
            'dropdown' => [
                ['label' => 'Opción 1', 'href' => '#'],
                ['label' => 'Opción 2', 'href' => '#']
            ]
        ]
    ],
    'theme' => 'dark',
    'bg' => 'dark'
])->render();
```

[← Volver al Índice](../../Bootstrap.md)
