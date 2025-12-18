# Nav - Navegación

[← Volver al Índice](../../Bootstrap.md)

## Descripción 

Componente de navegación base para tabs, pills y más.

**Clase PHP**: [`Nav.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Navigation/Nav.php)

## Ejemplos

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Nav con tabs
$nav = BS5::nav([
    'type' => 'tabs',
    'items' => [
        ['label' => 'Inicio', 'href' => '#home', 'active' => true],
        ['label' => 'Perfil', 'href' => '#profile'],
        ['label' => 'Mensajes', 'href' => '#messages']
    ]
])->render();

// Nav con pills
$nav = BS5::nav([
    'type' => 'pills',
    'items' => [
        ['label' => 'Activo', 'href' => '#', 'active' => true],
        ['label' => 'Enlace', 'href' => '#'],
        ['label' => 'Deshabilitado', 'href' => '#', 'disabled' => true]
    ]
])->render();

// Nav vertical
$nav = BS5::nav([
    'type' => 'pills',
    'vertical' => true,
    'items' => [...]
])->render();
```

[← Volver al Índice](../../Bootstrap.md)
