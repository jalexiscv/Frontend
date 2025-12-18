# Form - Contenedor de Formulario

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Contenedor principal para formularios con validación.

**Clase PHP**: [`Form.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Form/Form.php)

## Ejemplos

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Formulario básico
$form = BS5::form([
    'action' => '/submit',
    'method' => 'POST',
    'content' => [
        BS5::formControl(['type' => 'text', 'name' => 'nombre', 'label' => 'Nombre'])->render(),
        BS5::formControl(['type' => 'email', 'name' => 'email', 'label' => 'Email'])->render(),
        BS5::button(['content' => 'Enviar', 'type' => 'submit'])->render()
    ]
])->render();
```

[← Volver al Índice](../../Bootstrap.md)
