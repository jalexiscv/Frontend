# InputGroup - Grupo de Inputs

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Agrupa inputs con texto, botones o dropdowns como complementos.

**Clase PHP**: [`InputGroup.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Form/InputGroup.php)

## Ejemplos

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Input con prepend
$inputGroup = BS5::inputGroup([
    'prepend' => '@',
    'input' => BS5::formControl(['type' => 'text', 'name' => 'usuario'])->render()
])->render();

// Input con append
$inputGroup = BS5::inputGroup([
    'input' => BS5::formControl(['type' => 'number', 'name' => 'precio'])->render(),
    'append' => '.00'
])->render();

// Input con botón
$inputGroup = BS5::inputGroup([
    'input' => BS5::formControl(['type' => 'text', 'name' => 'buscar'])->render(),
    'append' => BS5::button(['content' => 'Buscar', 'variant' => 'primary'])->render()
])->render();
```

[← Volver al Índice](../../Bootstrap.md)
