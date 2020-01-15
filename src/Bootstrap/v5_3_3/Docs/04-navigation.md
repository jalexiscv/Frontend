# Componentes de Navegación Bootstrap 5

> **Nota de Migración v2.0.0**: Todos los componentes ahora aceptan un único `array $options` en su constructor. Los ejemplos en esta documentación reflejan la nueva arquitectura.

## Breadcrumb

Migas de pan para navegación jerárquica.

### Breadcrumb Básico
```php
// Breadcrumb simple
$breadcrumb = BS5::breadcrumb([
    'items' => [
        ['label' => 'Inicio', 'href' => '/'],
        ['label' => 'Categoría', 'href' => '/categoria'],
        ['label' => 'Producto', 'active' => true]
    ]
])->render();
```

### Breadcrumb con Divisor Personalizado
```php
// Breadcrumb con divisor personalizado
$breadcrumb = BS5::breadcrumb([
    'divider' => '>',
    'items' => [
        ['label' => 'Home', 'href' => '/'],
        ['label' => 'Library', 'href' => '/library'],
        ['label' => 'Data', 'active' => true]
    ]
])->render();
```

## Nav

Componentes de navegación.

### Nav Básico
```php
// Nav simple
$nav = BS5::nav([
    'items' => [
        ['label' => 'Inicio', 'href' => '/', 'active' => true],
        ['label' => 'Perfil', 'href' => '/profile'],
        ['label' => 'Mensajes', 'href' => '/messages'],
        ['label' => 'Deshabilitado', 'href' => '#', 'disabled' => true]
    ]
])->render();
```

### Nav con Tabs
```php
// Nav con pestañas
$nav = BS5::nav([
    'variant' => 'tabs',
    'items' => [
        ['label' => 'Inicio', 'href' => '#', 'active' => true],
        ['label' => 'Perfil', 'href' => '#'],
        ['label' => 'Contacto', 'href' => '#']
    ]
])->render();
```

### Nav con Pills
```php
// Nav con pills
$nav = BS5::nav([
    'variant' => 'pills',
    'items' => [
        ['label' => 'Inicio', 'href' => '#', 'active' => true],
        ['label' => 'Perfil', 'href' => '#'],
        ['label' => 'Mensajes', 'href' => '#']
    ]
])->render();
```

### Nav con Underline
```php
// Nav con underline (Bootstrap 5.3+)
$nav = BS5::nav([
    'variant' => 'underline',
    'items' => [
        ['label' => 'Inicio', 'href' => '#', 'active' => true],
        ['label' => 'Acerca de', 'href' => '#'],
        ['label' => 'Servicios', 'href' => '#']
    ]
])->render();
```

### Nav Fill y Justified
```php
// Nav fill (ocupa todo el ancho disponible)
$nav = BS5::nav([
    'fill' => true,
    'items' => [
        ['label' => 'Inicio', 'href' => '#'],
        ['label' => 'Perfil', 'href' => '#'],
        ['label' => 'Contacto', 'href' => '#']
    ]
])->render();

// Nav justified (todos los items del mismo ancho)
$nav = BS5::nav([
    'justified' => true,
    'variant' => 'pills',
    'items' => [
        ['label' => 'Inicio', 'href' => '#'],
        ['label' => 'Perfil', 'href' => '#'],
        ['label' => 'Contacto', 'href' => '#']
    ]
])->render();
```

### Nav Vertical
```php
// Nav vertical
$nav = BS5::nav([
    'vertical' => true,
    'variant' => 'pills',
    'items' => [
        ['label' => 'Inicio', 'href' => '#', 'active' => true],
        ['label' => 'Perfil', 'href' => '#'],
        ['label' => 'Mensajes', 'href' => '#']
    ]
])->render();
```

## Navbar

Barra de navegación completa.

### Navbar Básico
```php
// Navbar simple
$navbar = BS5::navbar([
    'brand' => 'Mi Sitio',
    'theme' => 'light',
    'bg' => 'bg-light',
    'expand' => 'lg',
    'content' => BS5::nav([
        'items' => [
            ['label' => 'Inicio', 'href' => '/', 'active' => true],
            ['label' => 'Características', 'href' => '/features'],
            ['label' => 'Precios', 'href' => '/pricing'],
            ['label' => 'Acerca de', 'href' => '/about']
        ]
    ])->render()
])->render();
```

### Navbar Oscuro
```php
// Navbar con tema oscuro
$navbar = BS5::navbar([
    'brand' => 'Mi App',
    'theme' => 'dark',
    'bg' => 'bg-dark',
    'expand' => 'md',
    'content' => BS5::nav([
        'items' => [
            ['label' => 'Dashboard', 'href' => '/', 'active' => true],
            ['label' => 'Usuarios', 'href' => '/users'],
            ['label' => 'Reportes', 'href' => '/reports']
        ]
    ])->render()
])->render();
```

### Navbar con Formulario
```php
// Navbar con buscador
$navbar = BS5::navbar([
    'brand' => 'Search App',
    'theme' => 'dark',
    'bg' => 'bg-primary',
    'content' => [
        BS5::nav([
            'items' => [
                ['label' => 'Inicio', 'href' => '/'],
                ['label' => 'Explorar', 'href' => '/explore']
            ]
        ])->render(),
        
        BS5::form([
            'inline' => true,
            'content' => [
                BS5::input([
                    'type' => 'search',
                    'name' => 'q',
                    'placeholder' => 'Buscar...',
                    'attributes' => ['class' => 'me-2']
                ])->render(),
                BS5::button([
                    'content' => 'Buscar',
                    'variant' => 'outline-light'
                ])->render()
            ]
        ])->render()
    ]
])->render();
```

### Navbar con Container
```php
// Navbar con container fluid
$navbar = BS5::navbar([
    'brand' => 'Sitio Web',
    'container' => 'fluid', // 'fluid', false, o tamaño específico
    'content' => BS5::nav([
        'items' => [
            ['label' => 'Inicio', 'href' => '/'],
            ['label' => 'Productos', 'href' => '/products']
        ]
    ])->render()
])->render();
```

## Pagination

Paginación para dividir contenido.

### Paginación Básica
```php
// Paginación simple
$pagination = BS5::pagination([
    'total' => 5,
    'current' => 1
])->render();
```

### Paginación Activa
```php
// Paginación con página actual
$pagination = BS5::pagination([
    'total' => 10,
    'current' => 5
])->render();
```

### Tamaños de Paginación
```php
// Paginación pequeña
$pagination = BS5::pagination([
    'total' => 3,
    'current' => 1,
    'size' => 'sm'
])->render();

// Paginación grande
$pagination = BS5::pagination([
    'total' => 3,
    'current' => 1,
    'size' => 'lg'
])->render();
```

### Paginación Alineada
```php
// Paginación centrada
$pagination = BS5::pagination([
    'total' => 5,
    'current' => 3,
    'alignment' => 'center'
])->render();

// Paginación alineada al final
$pagination = BS5::pagination([
    'total' => 5,
    'current' => 3,
    'alignment' => 'end'
])->render();
```

## ListGroup

Listas de elementos.

```php
// List group básico
$listGroup = BS5::listGroup([
    'items' => [
        'Item 1',
        'Item 2',
        'Item 3',
        'Item 4'
    ]
])->render();

// List group con enlaces
$listGroup = BS5::listGroup([
    'items' => [
        ['label' => 'Item 1', 'href' => '#', 'active' => true],
        ['label' => 'Item 2', 'href' => '#'],
        ['label' => 'Item 3', 'href' => '#', 'disabled' => true]
    ]
])->render();

// List group con badges
$listGroup = BS5::listGroup([
    'items' => [
        [
            'label' => 'Inbox',
            'badge' => BS5::badge(['content' => '12', 'variant' => 'primary', 'pill' => true])->render()
        ],
        [
            'label' => 'Sent',
            'badge' => BS5::badge(['content' => '5', 'variant' => 'secondary', 'pill' => true])->render()
        ]
    ]
])->render();

// List group flush
$listGroup = BS5::listGroup([
    'flush' => true,
    'items' => ['Item 1', 'Item 2', 'Item 3']
])->render();
```

## Ejemplo Práctico: Navegación Completa

```php
// Sistema de navegación completo
$navegacion = [
    // Navbar principal
    BS5::navbar([
        'brand' => [
            BS5::image(['src' => '/logo.png', 'fluid' => false, 'attributes' => ['height' => '30', 'class' => 'me-2']])->render(),
            'Mi Aplicación'
        ],
        'theme' => 'dark',
        'bg' => 'bg-primary',
        'expand' => 'lg',
        'content' => [
            BS5::nav([
                'items' => [
                    ['label' => 'Dashboard', 'href' => '/', 'active' => true],
                    ['label' => 'Productos', 'href' => '/products'],
                    ['label' => 'Clientes', 'href' => '/customers'],
                    ['label' => 'Reportes', 'href' => '/reports']
                ]
            ])->render(),
            
            BS5::form([
                'inline' => true,
                'content' => [
                    BS5::inputGroup([
                        'content' => BS5::input([
                            'type' => 'search',
                            'name' => 'q',
                            'placeholder' => 'Buscar...'
                        ])->render(),
                        'append' => BS5::button([
                            'content' => 'Buscar',
                            'variant' => 'outline-light'
                        ])->render()
                    ])->render()
                ]
            ])->render()
        ]
    ])->render(),
    
    // Breadcrumb de contexto
    BS5::breadcrumb([
        'items' => [
            ['label' => 'Inicio', 'href' => '/'],
            ['label' => 'Productos', 'href' => '/products'],
            ['label' => 'Electrónicos', 'active' => true]
        ],
        'attributes' => ['class' => 'mt-3']
    ])->render(),
    
    // Navegación secundaria
    BS5::nav([
        'variant' => 'pills',
        'items' => [
            ['label' => 'Todos', 'href' => '#', 'active' => true],
            ['label' => 'Disponibles', 'href' => '#'],
            ['label' => 'Agotados', 'href' => '#']
        ],
        'attributes' => ['class' => 'mb-3']
    ])->render(),
    
    // Paginación al final
    BS5::pagination([
        'total' => 10,
        'current' => 3,
        'alignment' => 'center',
        'attributes' => ['class' => 'mt-4']
    ])->render()
];
```

## Opciones Disponibles

Para consultar todas las opciones disponibles de cada componente, revisa el PHPDoc en:
- `Navigation\Breadcrumb.php`
- `Navigation\Nav.php`
- `Navigation\Navbar.php`
- `Navigation\Pagination.php`
- `Interface\ListGroup.php`

O consulta `COMPONENT_STANDARDS.md` para entender el patrón arquitectónico completo.
