# Componentes de Contenido Bootstrap 5

> **Nota de Migración v2.0.0**: Todos los componentes ahora aceptan un único `array $options` en su constructor. Los ejemplos en esta documentación reflejan la nueva arquitectura.

## Table

Tablas para mostrar datos.

### Tabla Básica
```php
// Tabla simple
$table = BS5::table([
    'header' => ['#', 'Nombre', 'Email', 'Rol'],
    'rows' => [
        ['1', 'Juan Pérez', 'juan@example.com', 'Admin'],
        ['2', 'María García', 'maria@example.com', 'Usuario'],
        ['3', 'Carlos López', 'carlos@example.com', 'Editor']
    ]
])->render();
```

### Tabla Striped
```php
// Tabla con rayas alternadas
$table = BS5::table([
    'header' => ['Producto', 'Precio', 'Stock'],
    'rows' => [
        ['Laptop', '$999', '15'],
        ['Mouse', '$25', '50'],
        ['Teclado', '$75', '30']
    ],
    'striped' => true
])->render();

// Tabla striped en columnas
$table = BS5::table([
    'header' => ['Col 1', 'Col 2', 'Col 3'],
    'rows' => [
        ['Data 1', 'Data 2', 'Data 3'],
        ['Data 4', 'Data 5', 'Data 6']
    ],
    'striped' => 'columns'
])->render();
```

### Tabla Hover
```php
// Tabla con efecto hover
$table = BS5::table([
    'header' => ['ID', 'Nombre', 'Estado'],
    'rows' => [
        ['1', 'Tarea 1', 'Completada'],
        ['2', 'Tarea 2', 'Pendiente'],
        ['3', 'Tarea 3', 'En progreso']
    ],
    'hover' => true
])->render();
```

### Tabla Bordered y Borderless
```php
// Tabla con bordes
$table = BS5::table([
    'header' => ['A', 'B', 'C'],
    'rows' => [
        ['1', '2', '3'],
        ['4', '5', '6']
    ],
    'bordered' => true
])->render();

// Tabla sin bordes
$table = BS5::table([
    'header' => ['X', 'Y', 'Z'],
    'rows' => [
        ['Data X', 'Data Y', 'Data Z']
    ],
    'borderless' => true
])->render();
```

### Tabla Small
```php
// Tabla compacta
$table = BS5::table([
    'header' => ['Código', 'Descripción'],
    'rows' => [
        ['A001', 'Artículo 1'],
        ['A002', 'Artículo 2']
    ],
    'small' => true
])->render();
```

### Tabla con Variantes de Color
```php
// Tabla con color
$table = BS5::table([
    'header' => ['Nombre', 'Puntos'],
    'rows' => [
        ['Equipo 1', '100'],
        ['Equipo 2', '85']
    ],
    'variant' => 'dark'
])->render();

// Otras variantes: 'primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'
```

### Tabla con Caption
```php
// Tabla con caption
$table = BS5::table([
    'caption' => 'Lista de usuarios registrados',
    'header' => ['Nombre', 'Fecha'],
    'rows' => [
        ['Usuario 1', '2024-01-15'],
        ['Usuario 2', '2024-01-16']
    ]
])->render();

// Caption en la parte superior
$table = BS5::table([
    'caption' => 'Reporte de ventas',
    'captionTop' => true,
    'header' => ['Mes', 'Ventas'],
    'rows' => [
        ['Enero', '$10,000'],
        ['Febrero', '$12,000']
    ]
])->render();
```

### Tabla Responsiva
```php
// Tabla responsiva (usa wrapper div)
$table = BS5::table([
    'header' => ['Col 1', 'Col 2', 'Col 3', 'Col 4', 'Col 5'],
    'rows' => [
        ['Data 1', 'Data 2', 'Data 3', 'Data 4', 'Data 5']
    ],
    'attributes' => ['class' => 'table-responsive']
])->render();
```

## Typography

Componentes tipográficos.

### Headings (Display)
```php
// Display headings
$display1 = BS5::typography([
    'tag' => 'h1',
    'display' => 1,
    'content' => 'Display 1'
])->render();

$display2 = BS5::typography([
    'tag' => 'h2',
    'display' => 2,
    'content' => 'Display 2'
])->render();

// Display 3, 4, 5, 6 también disponibles
```

### Lead Paragraph
```php
// Párrafo destacado
$lead = BS5::typography([
    'tag' => 'p',
    'lead' => true,
    'content' => 'Este es un párrafo destacado que resalta sobre el resto del texto.'
])->render();
```

### Párrafo Normal
```php
// Párrafo normal
$paragraph = BS5::typography([
    'tag' => 'p',
    'content' => 'Este es un párrafo normal de texto.'
])->render();
```

### Headings Normales
```php
// Headings estándar
$h1 = BS5::typography(['tag' => 'h1', 'content' => 'Título H1'])->render();
$h2 = BS5::typography(['tag' => 'h2', 'content' => 'Título H2'])->render();
$h3 = BS5::typography(['tag' => 'h3', 'content' => 'Título H3'])->render();
$h4 = BS5::typography(['tag' => 'h4', 'content' => 'Título H4'])->render();
$h5 = BS5::typography(['tag' => 'h5', 'content' => 'Título H5'])->render();
$h6 = BS5::typography(['tag' => 'h6', 'content' => 'Título H6'])->render();
```

## Image

Imágenes responsivas.

### Imagen Básica
```php
// Imagen fluida (responsiva)
$image = BS5::image([
    'src' => 'imagen.jpg',
    'alt' => 'Descripción de la imagen',
    'fluid' => true
])->render();
```

### Imagen Thumbnail
```php
// Imagen con estilo thumbnail
$image = BS5::image([
    'src' => 'imagen.jpg',
    'alt' => 'Thumbnail',
    'thumbnail' => true
])->render();
```

### Imagen Redondeada
```php
// Imagen con esquinas redondeadas
$image = BS5::image([
    'src' => 'imagen.jpg',
    'alt' => 'Imagen redondeada',
    'rounded' => true
])->render();
```

### Imagen Alineada
```php
// Imagen alineada a la izquierda
$image = BS5::image([
    'src' => 'imagen.jpg',
    'alt' => 'Izquierda',
    'align' => 'start'
])->render();

// Imagen centrada
$image = BS5::image([
    'src' => 'imagen.jpg',
    'alt' => 'Centrada',
    'align' => 'center'
])->render();

// Imagen alineada a la derecha
$image = BS5::image([
    'src' => 'imagen.jpg',
    'alt' => 'Derecha',
    'align' => 'end'
])->render();
```

### Imagen No Fluida
```php
// Imagen sin fluid (tamaño original)
$image = BS5::image([
    'src' => 'logo.png',
    'alt' => 'Logo',
    'fluid' => false,
    'attributes' => ['width' => '200']
])->render();
```

## Figure

Figuras con captions.

### Figure Básica
```php
// Figure simple
$figure = BS5::figure([
    'image' => 'imagen.jpg', // Puede ser string (src) o TagInterface
    'caption' => 'Descripción de la imagen'
])->render();
```

### Figure con Alineación
```php
// Figure con caption alineado al final
$figure = BS5::figure([
    'image' => 'imagen.jpg',
    'caption' => 'Caption alineado a la derecha',
    'align' => 'end'
])->render();

// Figure con caption centrado
$figure = BS5::figure([
    'image' => 'imagen.jpg',
    'caption' => 'Caption centrado',
    'align' => 'center'
])->render();
```

### Figure con Imagen Componente
```php
// Figure con componente Image
$figure = BS5::figure([
    'image' => BS5::image([
        'src' => 'imagen.jpg',
        'alt' => 'Descripción',
        'rounded' => true,
        'attributes' => ['class' => 'figure-img img-fluid']
    ])->render(),
    'caption' => 'Imagen con bordes redondeados'
])->render();
```

## Ejemplos Prácticos

### Tabla de Datos Completa
```php
// Tabla de dashboard
$dataTable = BS5::table([
    'caption' => 'Ventas del último mes',
    'header' => ['Fecha', 'Producto', 'Cantidad', 'Total', 'Estado'],
    'rows' => [
        ['2024-01-15', 'Laptop', '2', '$1,998', 'Entregado'],
        ['2024-01-16', 'Mouse', '5', '$125', 'Pendiente'],
        ['2024-01-17', 'Teclado', '3', '$225', 'Entregado'],
        ['2024-01-18', 'Monitor', '1', '$299', 'En tránsito']
    ],
    'striped' => true,
    'hover' => true,
    'small' => true,
    'attributes' => ['class' => 'table-responsive']
])->render();
```

### Galería de Imágenes
```php
// Galería con figures
$gallery = BS5::row([
    'cols' => '1',
    'colsSm' => '2',
    'colsMd' => '3',
    'gutter' => '3',
    'content' => [
        BS5::col([
            'content' => BS5::figure([
                'image' => BS5::image([
                    'src' => 'foto1.jpg',
                    'alt' => 'Foto 1',
                    'attributes' => ['class' => 'figure-img img-fluid rounded']
                ])->render(),
                'caption' => 'Foto de paisaje'
            ])->render()
        ])->render(),
        
        BS5::col([
            'content' => BS5::figure([
                'image' => BS5::image([
                    'src' => 'foto2.jpg',
                    'alt' => 'Foto 2',
                    'attributes' => ['class' => 'figure-img img-fluid rounded']
                ])->render(),
                'caption' => 'Foto de ciudad'
            ])->render()
        ])->render(),
        
        BS5::col([
            'content' => BS5::figure([
                'image' => BS5::image([
                    'src' => 'foto3.jpg',
                    'alt' => 'Foto 3',
                    'attributes' => ['class' => 'figure-img img-fluid rounded']
                ])->render(),
                'caption' => 'Foto de naturaleza'
            ])->render()
        ])->render()
    ]
])->render();
```

### Artículo de Blog
```php
// Artículo completo
$article = BS5::container([
    'content' => [
        BS5::typography([
            'tag' => 'h1',
            'display' => 3,
            'content' => 'Título del Artículo',
            'attributes' => ['class' => 'mb-3']
        ])->render(),
        
        BS5::typography([
            'tag' => 'p',
            'lead' => true,
            'content' => 'Este es el párrafo introductorio que capta la atención del lector.',
            'attributes' => ['class' => 'mb-4']
        ])->render(),
        
        BS5::figure([
            'image' => 'articulo-hero.jpg',
            'caption' => 'Imagen principal del artículo',
            'align' => 'center',
            'attributes' => ['class' => 'mb-4']
        ])->render(),
        
        BS5::typography([
            'tag' => 'p',
            'content' => 'Contenido del artículo...',
            'attributes' => ['class' => 'mb-3']
        ])->render(),
        
        BS5::typography([
            'tag' => 'h2',
            'content' => 'Subtítulo',
            'attributes' => ['class' => 'mt-4 mb-3']
        ])->render(),
        
        BS5::typography([
            'tag' => 'p',
            'content' => 'Más contenido...'
        ])->render()
    ]
])->render();
```

## Opciones Disponibles

Para consultar todas las opciones disponibles de cada componente, revisa el PHPDoc en:
- `Content\Table.php`
- `Content\Typography.php`
- `Content\Image.php`
- `Content\Figure.php`

O consulta `COMPONENT_STANDARDS.md` para entender el patrón arquitectónico completo.
