# Image - Imagen Responsive

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Imágenes responsive con clases útiles de Bootstrap.

**Clase PHP**: [`Image.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Content/Image.php)

## Ejemplos

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Imagen responsive
$img = BS5::image([
    'src' => 'imagen.jpg',
    'alt' => 'Descripción de la imagen',
    'fluid' => true
])->render();

// Imagen thumbnail
$img = BS5::image([
    'src' => 'foto.jpg',
    'alt' => 'Foto',
    'thumbnail' => true
])->render();

// Imagen redondeada
$img = BS5::image([
    'src' => 'avatar.jpg',
    'alt' => 'Avatar',
    'rounded' => true // o 'circle' para circular
])->render();
```

[← Volver al Índice](../../Bootstrap.md)
