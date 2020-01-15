# Table - Tabla de Datos

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Tablas para mostrar datos tabulares con estilos de Bootstrap.

**Clase PHP**: [`Table.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Content/Table.php)

## Ejemplos

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Tabla básica con headers simples (strings)
$table = BS5::table([
    'header' => ['ID', 'Nombre', 'Email', 'Acciones'],
    'rows' => [
        ['1', 'Juan Pérez', 'juan@ejemplo.com', 'Editar | Eliminar'],
        ['2', 'María García', 'maria@ejemplo.com', 'Editar | Eliminar'],
        ['3', 'Carlos López', 'carlos@ejemplo.com', 'Editar | Eliminar']
    ]
])->render();

// Headers con atributos HTML y content escapado
$table = BS5::table([
    'header' => [
        ['content' => 'ID', 'class' => 'text-center', 'style' => 'width: 60px'],
        ['content' => 'Nombre', 'class' => 'text-start'],
        ['content' => 'Email', 'class' => 'text-start d-none d-md-table-cell'],
        ['content' => 'Acciones', 'class' => 'text-end', 'style' => 'width: 150px']
    ],
    'rows' => [
        ['1', 'Juan Pérez', 'juan@ejemplo.com', 'Editar | Eliminar'],
        ['2', 'María García', 'maria@ejemplo.com', 'Editar | Eliminar']
    ]
])->render();

// Headers con htmlContent (HTML crudo sin escapar)
$table = BS5::table([
    'header' => [
        ['htmlContent' => '<i class="fas fa-hashtag"></i> ID', 'class' => 'text-center'],
        ['htmlContent' => '<i class="fas fa-user"></i> Nombre'],
        ['htmlContent' => '<i class="fas fa-cog"></i> Acciones', 'class' => 'text-end']
    ],
    'rows' => [...],
    'striped' => true
])->render();

// Headers mixtos: strings, content y htmlContent combinados
$table = BS5::table([
    'header' => [
        'ID',                                                         // string simple
        ['content' => 'Nombre'],                                      // content escapado
        ['htmlContent' => '<i class="fas fa-cog"></i> Acciones',      // HTML crudo
         'class' => 'text-end', 'style' => 'width: 150px']
    ],
    'rows' => [...],
    'hover' => true
])->render();
```

[← Volver al Índice](../../Bootstrap.md)
