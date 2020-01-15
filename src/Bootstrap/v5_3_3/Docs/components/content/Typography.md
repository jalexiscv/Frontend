# Typography - Tipografía

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Componentes de tipografía para textos, headings y estilos de texto.

**Clase PHP**: [`Typography.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Content/Typography.php)

## Ejemplos

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Headings
$h1 = BS5::typography([
    'tag' => 'h1',
    'content' => 'Título Principal'
])->render();

// Display headings
$display = BS5::typography([
    'tag' => 'h1',
    'display' => 1, // display-1
    'content' => 'Título Display'
])->render();

// Lead paragraph
$lead = BS5::typography([
    'tag' => 'p',
    'lead' => true,
    'content' => 'Párrafo destacado con mayor tamaño de letra.'
])->render();

// Text con clases
$text = BS5::typography([
    'tag' => 'p',
    'content' => 'Texto de ejemplo',
    'textAlign' => 'center',
    'textColor' => 'primary'
])->render();
```

[← Volver al Índice](../../Bootstrap.md)
