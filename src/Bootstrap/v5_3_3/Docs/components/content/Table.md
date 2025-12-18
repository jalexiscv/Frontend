# Table - Tabla de Datos

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Tablas para mostrar datos tabulares con estilos de Bootstrap.

**Clase PHP**: [`Table.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Content/Table.php)

## Ejemplos

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Tabla básica
$table = BS5::table([
    'headers' => ['ID', 'Nombre', 'Email', 'Acciones'],
    'rows' => [
        ['1', 'Juan Pérez', 'juan@ejemplo.com', 'Editar | Eliminar'],
        ['2', 'María García', 'maria@ejemplo.com', 'Editar | Eliminar'],
        ['3', 'Carlos López', 'carlos@ejemplo.com', 'Editar | Eliminar']
    ]
])->render();

// Tabla striped y hover
$table = BS5::table([
    'headers' => [...],
    'rows' => [...],
    'striped' => true,
    'hover' => true
])->render();

// Tabla responsive
$table = BS5::table([
    'headers' => [...],
    'rows' => [...],
    'responsive' => true,
    'bordered' => true
])->render();
```

[← Volver al Índice](../../Bootstrap.md)
