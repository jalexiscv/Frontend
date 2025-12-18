# File - Input de Archivo

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Input para carga de archivos con validación de tipos.

**Clase PHP**: [`File.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Form/File.php)

## Ejemplos

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Input de archivo básico
$file = BS5::file([
    'name' => 'documento',
    'label' => 'Subir documento',
    'accept' => '.pdf,.doc,.docx',
    'required' => true
])->render();

// Input múltiple
$file = BS5::file([
    'name' => 'imagenes[]',
    'label' => 'Subir imágenes',
    'accept' => 'image/*',
    'multiple' => true
])->render();
```

[← Volver al Índice](../../Bootstrap.md)
