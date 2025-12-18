# Figure - Figura con Caption

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Componente para imágenes con leyenda o caption.

**Clase PHP**: [`Figure.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Content/Figure.php)

## Ejemplos

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Figure básico
$figure = BS5::figure([
    'image' => 'imagen.jpg',
    'alt' => 'Descripción',
    'caption' => 'Leyenda de la imagen'
])->render();

// Figure con alineación
$figure = BS5::figure([
    'image' => 'foto.jpg',
    'alt' => 'Foto',
    'caption' => 'Caption centrado',
    'captionAlign' => 'center'
])->render();
```

[← Volver al Índice](../../Bootstrap.md)
