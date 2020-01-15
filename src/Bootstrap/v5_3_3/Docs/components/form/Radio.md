# Radio - Botones de Radio

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Botones de radio para selección única entre múltiples opciones.

**Clase PHP**: [`Radio.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Form/Radio.php)

## Ejemplos

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Grupo de radios
$radio = BS5::radio([
    'name' => 'genero',
    'options' => [
        'M' => 'Masculino',
        'F' => 'Femenino',
        'O' => 'Otro'
    ],
    'selected' => 'M
'
])->render();

// Radios inline
$radio = BS5::radio([
    'name' => 'metodo_pago',
    'options' => [
        'tarjeta' => 'Tarjeta',
        'efectivo' => 'Efectivo',
        'transferencia' => 'Transferencia'
    ],
    'inline' => true
])->render();
```

[← Volver al Índice](../../Bootstrap.md)
