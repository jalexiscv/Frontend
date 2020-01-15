# Componentes de Layout Bootstrap 5

> **Nota de Migración v2.0.0**: Todos los componentes ahora aceptan un único `array $options` en su constructor. Los ejemplos en esta documentación reflejan la nueva arquitectura.

## Container

Contenedores para el diseño responsivo.

### Container Básico
```php
// Container estándar
$container = BS5::container([
    'content' => 'Contenido del container'
])->render();
```

### Tipos de Container
```php
// Container fluid (100% ancho)
$container = BS5::container([
    'type' => 'fluid',
    'content' => 'Contenido de ancho completo'
])->render();

// Container responsivo (sm, md, lg, xl, xxl)
$containerSm = BS5::container([
    'type' => 'sm',
    'content' => 'Container small'
])->render();

$containerMd = BS5::container([
    'type' => 'md',
    'content' => 'Container medium'
])->render();

$containerLg = BS5::container([
    'type' => 'lg',
    'content' => 'Container large'
])->render();

$containerXl = BS5::container([
    'type' => 'xl',
    'content' => 'Container extra large'
])->render();

$containerXxl = BS5::container([
    'type' => 'xxl',
    'content' => 'Container extra extra large'
])->render();
```

## Grid System (Row y Col)

Sistema de rejilla de 12 columnas.

### Grid Básico
```php
// Grid simple con columnas iguales
$grid = BS5::row([
    'content' => [
        BS5::col(['content' => 'Columna 1'])->render(),
        BS5::col(['content' => 'Columna 2'])->render(),
        BS5::col(['content' => 'Columna 3'])->render()
    ]
])->render();
```

### Columnas con Tamaños Específicos
```php
// Columnas con tamaños definidos
$grid = BS5::row([
    'content' => [
        BS5::col(['size' => '4', 'content' => 'Col 4'])->render(),
        BS5::col(['size' => '8', 'content' => 'Col 8'])->render()
    ]
])->render();

// Columnas con tamaños auto
$grid = BS5::row([
    'content' => [
        BS5::col(['size' => 'auto', 'content' => 'Auto width'])->render(),
        BS5::col(['content' => 'Resto del espacio'])->render()
    ]
])->render();
```

### Grid Responsivo
```php
// Columnas responsivas
$grid = BS5::row([
    'content' => [
        BS5::col([
            'size' => '12',
            'md' => '6',
            'lg' => '4',
            'content' => 'Responsivo 1'
        ])->render(),
        BS5::col([
            'size' => '12',
            'md' => '6',
            'lg' => '4',
            'content' => 'Responsivo 2'
        ])->render(),
        BS5::col([
            'size' => '12',
            'lg' => '4',
            'content' => 'Responsivo 3'
        ])->render()
    ]
])->render();
```

### Row Cols
```php
// Row cols (columnas por fila)
$grid = BS5::row([
    'cols' => '2', // 2 columnas por fila por defecto
    'colsMd' => '3', // 3 columnas en md
    'colsLg' => '4', // 4 columnas en lg
    'content' => [
        BS5::col(['content' => 'Item 1'])->render(),
        BS5::col(['content' => 'Item 2'])->render(),
        BS5::col(['content' => 'Item 3'])->render(),
        BS5::col(['content' => 'Item 4'])->render()
    ]
])->render();
```

### Gutters (Espaciado)
```php
// Row con gutters
$grid = BS5::row([
    'gutter' => '3', // Gutter en todas las direcciones
    'content' => [
        BS5::col(['size' => '6', 'content' => 'Col 1'])->render(),
        BS5::col(['size' => '6', 'content' => 'Col 2'])->render()
    ]
])->render();

// Gutters específicos horizontal y vertical
$grid = BS5::row([
    'gutterX' => '2', // Gutter horizontal
    'gutterY' => '4', // Gutter vertical
    'content' => [
        BS5::col(['size' => '6', 'content' => 'Col 1'])->render(),
        BS5::col(['size' => '6', 'content' => 'Col 2'])->render(),
        BS5::col(['size' => '6', 'content' => 'Col 3'])->render(),
        BS5::col(['size' => '6', 'content' => 'Col 4'])->render()
    ]
])->render();

// Sin gutters
$grid = BS5::row([
    'gutter' => '0',
    'content' => [
        BS5::col(['size' => '6', 'content' => 'Sin espaciado 1'])->render(),
        BS5::col(['size' => '6', 'content' => 'Sin espaciado 2'])->render()
    ]
])->render();
```

## Grid Component

Componente Grid (CSS Grid experimental en BS5).

```php
// Grid simple
$grid = BS5::grid([
    'content' => [
        BS5::col(['content' => 'Grid item 1'])->render(),
        BS5::col(['content' => 'Grid item 2'])->render(),
        BS5::col(['content' => 'Grid item 3'])->render()
    ]
])->render();

// Grid con atributos personalizados
$grid = BS5::grid([
    'attributes' => [
        'style' => 'display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;'
    ],
    'content' => [
        BS5::col(['content' => 'Item 1'])->render(),
        BS5::col(['content' => 'Item 2'])->render(),
        BS5::col(['content' => 'Item 3'])->render()
    ]
])->render();
```

## Ejemplos Prácticos

### Layout de Dashboard
```php
// Dashboard completo
$dashboard = BS5::container([
    'type' => 'fluid',
    'content' => [
        // Header
        BS5::row([
            'content' => BS5::col([
                'size' => '12',
                'content' => BS5::card([
                    'headerTitle' => 'Dashboard',
                    'content' => 'Bienvenido al panel de control'
                ])->render()
            ])->render(),
            'attributes' => ['class' => 'mb-3']
        ])->render(),
        
        // Estadísticas
        BS5::row([
            'gutter' => '3',
            'content' => [
                BS5::col([
                    'size' => '12',
                    'md' => '6',
                    'lg' => '3',
                    'content' => BS5::card([
                        'title' => 'Usuarios',
                        'content' => '1,234',
                        'attributes' => ['class' => 'text-center']
                    ])->render()
                ])->render(),
                BS5::col([
                    'size' => '12',
                    'md' => '6',
                    'lg' => '3',
                    'content' => BS5::card([
                        'title' => 'Ventas',
                        'content' => '$12,345',
                        'attributes' => ['class' => 'text-center']
                    ])->render()
                ])->render(),
                BS5::col([
                    'size' => '12',
                    'md' => '6',
                    'lg' => '3',
                    'content' => BS5::card([
                        'title' => 'Pedidos',
                        'content' => '567',
                        'attributes' => ['class' => 'text-center']
                    ])->render()
                ])->render(),
                BS5::col([
                    'size' => '12',
                    'md' => '6',
                    'lg' => '3',
                    'content' => BS5::card([
                        'title' => 'Productos',
                        'content' => '89',
                        'attributes' => ['class' => 'text-center']
                    ])->render()
                ])->render()
            ],
            'attributes' => ['class' => 'mb-3']
        ])->render(),
        
        // Contenido principal
        BS5::row([
            'gutter' => '3',
            'content' => [
                BS5::col([
                    'size' => '12',
                    'lg' => '8',
                    'content' => BS5::card([
                        'headerTitle' => 'Gráfico de Ventas',
                        'content' => 'Aquí va el gráfico...'
                    ])->render()
                ])->render(),
                BS5::col([
                    'size' => '12',
                    'lg' => '4',
                    'content' => BS5::card([
                        'headerTitle' => 'Actividad Reciente',
                        'content' => BS5::listGroup([
                            'items' => [
                                'Nueva venta',
                                'Nuevo usuario',
                                'Actualización de producto'
                            ]
                        ])->render()
                   ])->render()
                ])->render()
            ]
        ])->render()
    ]
])->render();
```

### Layout de Blog
```php
// Layout típico de blog
$blog = BS5::container([
    'content' => [
        BS5::row([
            'gutter' => '4',
            'content' => [
                // Contenido principal
                BS5::col([
                    'size' => '12',
                    'lg' => '8',
                    'content' => [
                        BS5::card([
                            'image' => 'post1.jpg',
                            'title' => 'Título del Post 1',
                            'content' => 'Contenido del primer post...',
                            'footer' => 'Publicado hace 2 días',
                            'attributes' => ['class' => 'mb-4']
                        ])->render(),
                        BS5::card([
                            'image' => 'post2.jpg',
                            'title' => 'Título del Post 2',
                            'content' => 'Contenido del segundo post...',
                            'footer' => 'Publicado hace 5 días',
                            'attributes' => ['class' => 'mb-4']
                        ])->render()
                    ]
                ])->render(),
                
                // Sidebar
                BS5::col([
                    'size' => '12',
                    'lg' => '4',
                    'content' => [
                        BS5::card([
                            'headerTitle' => 'Acerca de',
                            'content' => 'Información sobre el autor...',
                            'attributes' => ['class' => 'mb-3']
                        ])->render(),
                        BS5::card([
                            'headerTitle' => 'Categorías',
                            'content' => BS5::listGroup([
                                'items' => [
                                    ['label' => 'Tecnología', 'href' => '#'],
                                    ['label' => 'Diseño', 'href' => '#'],
                                    ['label' => 'Programación', 'href' => '#']
                                ]
                            ])->render()
                        ])->render()
                    ]
                ])->render()
            ]
        ])->render()
    ]
])->render();
```

### Galería de Productos
```php
// Galería responsiva
$galeria = BS5::container([
    'content' => BS5::row([
        'cols' => '1',
        'colsSm' => '2',
        'colsMd' => '3',
        'colsLg' => '4',
        'gutter' => '3',
        'content' => [
            BS5::col([
                'content' => BS5::card([
                    'image' => 'producto1.jpg',
                    'title' => 'Producto 1',
                    'content' => '$19.99'
                ])->render()
            ])->render(),
            BS5::col([
                'content' => BS5::card([
                    'image' => 'producto2.jpg',
                    'title' => 'Producto 2',
                    'content' => '$29.99'
                ])->render()
            ])->render(),
            BS5::col([
                'content' => BS5::card([
                    'image' => 'producto3.jpg',
                    'title' => 'Producto 3',
                    'content' => '$39.99'
                ])->render()
            ])->render(),
            BS5::col([
                'content' => BS5::card([
                    'image' => 'producto4.jpg',
                    'title' => 'Producto 4',
                    'content' => '$49.99'
                ])->render()
            ])->render()
        ]
    ])->render()
])->render();
```

## Opciones Disponibles

Para consultar todas las opciones disponibles de cada componente, revisa el PHPDoc en:
- `Layout\Container.php`
- `Layout\Row.php`
- `Layout\Col.php`
- `Layout\Grid.php`

O consulta `COMPONENT_STANDARDS.md` para entender el patrón arquitectónico completo.
