# Check - Checkbox y Switch

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Checkboxes y switches para selección múltiple.

**Clase PHP**: [`Check.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Form/Check.php)

## Ejemplos

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Checkbox básico
$check = BS5::check([
    'name' => 'terminos',
    'label' => 'Acepto los términos y condiciones',
    'value' => '1',
    'checked' => false
])->render();

// Switch
$switch = BS5::check([
    'name' => 'notificaciones',
    'label' => 'Recibir notificaciones',
    'switch' => true,
    'checked' => true
])->render();

// Checkbox inline
$check = BS5::check([
    'name' => 'opcion',
    'label' => 'Opción',
    'inline' => true
])->render();
```

[← Volver al Índice](../../Bootstrap.md)
