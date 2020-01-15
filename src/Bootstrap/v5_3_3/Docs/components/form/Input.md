# Input - Campo de Entrada

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Campo de entrada de texto genérico.

**Clase PHP**: [`Input.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Form/Input.php)

## Ejemplos

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Input de texto
$input = BS5::input([
    'name' => 'nombre',
    'placeholder' => 'Nombre completo'
])->render();

// Input con validación
$input = BS5::input([
    'name' => 'email',
    'type' => 'email',
    'required' => true,
    'pattern' => '[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$'
])->render();
```

[← Volver al Índice](../../Bootstrap.md)
