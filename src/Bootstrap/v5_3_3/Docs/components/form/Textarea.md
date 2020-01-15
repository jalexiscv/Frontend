# Textarea - Área de Texto

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Área de texto multilínea para contenido extenso.

**Clase PHP**: [`Textarea.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Form/Textarea.php)

## Ejemplos

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Textarea básico
$textarea = BS5::textarea([
    'name' => 'comentarios',
    'label' => 'Comentarios',
    'placeholder' => 'Escriba sus comentarios aquí...',
    'rows' => 5,
    'required' => true
])->render();

// Textarea con contador de caracteres
$textarea = BS5::textarea([
    'name' => 'descripcion',
    'label' => 'Descripción',
    'rows' => 4,
    'maxlength' => 500
])->render();
```

[← Volver al Índice](../../Bootstrap.md)
