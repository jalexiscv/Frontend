# Select - Lista Desplegable

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Listas desplegables para selección de opciones.

**Clase PHP**: [`Select.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Form/Select.php)

## Ejemplos

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Select básico
$select = BS5::select([
    'name' => 'pais',
    'label' => 'País',
    'options' => [
        'MX' => 'México',
        'CO' => 'Colombia',
        'ES' => 'España',
        'AR' => 'Argentina'
    ],
    'selected' => 'MX',
    'required' => true
])->render();

// Select con grupos
$select = BS5::select([
    'name' => 'ciudad',
    'label' => 'Ciudad',
    'options' => [
        'América' => [
            'mx' => 'México',
            'ny' => 'Nueva York'
        ],
        'Europa' => [
            'mad' => 'Madrid',
            'par' => 'París'
        ]
    ]
])->render();

// Select múltiple
$select = BS5::select([
    'name' => 'intereses[]',
    'label' => 'Intereses',
    'options' => [
        'tech' => 'Tecnología',
        'sports' => 'Deportes',
        'music' => 'Música'
    ],
    'multiple' => true,
    'size' => 3
])->render();
```

[← Volver al Índice](../../Bootstrap.md)
