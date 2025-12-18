# FormControl - Control de Formulario

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Control de formulario principal para inputs de texto, email, password, number y más.

**Clase PHP**: [`FormControl.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Form/FormControl.php)

## Opciones Principales

| Opción | Tipo | Descripción |
|--------|------|-------------|
| `type` | `string` | Tipo: `text`, `email`, `password`, `number`, `date`, `tel`, etc. |
| `name` | `string` | Nombre del campo |
| `label` | `string` | Etiqueta del campo |
| `placeholder` | `string` | Texto placeholder |
| `value` | `string` | Valor por defecto |
| `required` | `bool` | Si es requerido |
| `disabled` | `bool` | Si está deshabilitado |
| `readonly` | `bool` | Si es solo lectura |

## Ejemplos

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Input de texto básico
$input = BS5::formControl([
    'type' => 'text',
    'name' => 'nombre',
    'label' => 'Nombre completo',
    'placeholder' => 'Ingrese su nombre',
    'required' => true
])->render();

// Input de email
$email = BS5::formControl([
    'type' => 'email',
    'name' => 'email',
    'label' => 'Correo electrónico',
    'placeholder' => 'usuario@ejemplo.com',
    'required' => true
])->render();

// Input de password
$password = BS5::formControl([
    'type' => 'password',
    'name' => 'password',
    'label' => 'Contraseña',
    'required' => true
])->render();

// Input de número
$edad = BS5::formControl([
    'type' => 'number',
    'name' => 'edad',
    'label' => 'Edad',
    'min' => 18,
    'max' => 100
])->render();
```

[← Volver al Índice](../../Bootstrap.md)
