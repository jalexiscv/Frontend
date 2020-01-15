# Componentes Interactivos Bootstrap 5

> **Nota de Migración v2.0.0**: Todos los componentes ahora aceptan un único `array $options` en su constructor. Los ejemplos en esta documentación reflejan la nueva arquitectura.

## Carousel

Presentación de diapositivas para recorrer elementos.

### Carrusel Básico
```php
// Carrusel simple
$carousel = BS5::carousel([
    'id' => 'miCarrusel',
    'items' => [
        ['image' => 'imagen1.jpg', 'caption' => 'Título 1', 'text' => 'Descripción 1'],
        ['image' => 'imagen2.jpg', 'caption' => 'Título 2', 'text' => 'Descripción 2'],
        ['image' => 'imagen3.jpg', 'caption' => 'Título 3', 'text' => 'Descripción 3']
    ]
])->render();
```

### Carrusel con Controles
```php
// Carrusel con flechas y indicadores
$carousel = BS5::carousel([
    'id' => 'miCarrusel',
    'controls' => true,
    'indicators' => true,
    'items' => [
        ['image' => 'imagen1.jpg', 'caption' => 'Título 1', 'text' => 'Descripción 1'],
        ['image' => 'imagen2.jpg', 'caption' => 'Título 2', 'text' => 'Descripción 2'],
        ['image' => 'imagen3.jpg', 'caption' => 'Título 3', 'text' => 'Descripción 3']
    ]
])->render();
```

### Carrusel con Fade
```php
// Carrusel con efecto fade
$carousel = BS5::carousel([
    'id' => 'miCarrusel',
    'fade' => true,
    'items' => [
        ['image' => 'imagen1.jpg', 'caption' => 'Título 1'],
        ['image' => 'imagen2.jpg', 'caption' => 'Título 2']
    ]
])->render();
```

### Carrusel con Intervalo Personalizado
```php
// Carrusel con intervalo de 5 segundos
$carousel = BS5::carousel([
    'id' => 'miCarrusel',
    'interval' => 5000,
    'items' => [
        ['image' => 'imagen1.jpg'],
        ['image' => 'imagen2.jpg']
    ]
])->render();
```

## Collapse

Alternar la visibilidad de contenido.

### Colapso Básico
```php
// Collapse con botón de activación
$collapse = BS5::collapse([
    'id' => 'miColapso',
    'content' => 'Este contenido se puede ocultar/mostrar'
])->render();

// Botón que controla el colapso (requiere atributos data-bs-*)
$button = BS5::button([
    'content' => 'Mostrar/Ocultar',
    'attributes' => [
        'data-bs-toggle' => 'collapse',
        'data-bs-target' => '#miColapso'
    ]
])->render();
```

### Colapso Horizontal
```php
// Collapse horizontal
$collapse = BS5::collapse([
    'id' => 'colapsoHorizontal',
    'horizontal' => true,
    'content' => 'Este es un colapso horizontal'
])->render();
```

## Modal

Diálogos modales para mostrar contenido.

### Modal Básico
```php
// Modal simple
$modal = BS5::modal([
    'id' => 'miModal',
    'title' => 'Título del Modal',
    'body' => 'Contenido del modal',
    'footer' => [
        BS5::button([
            'content' => 'Cerrar',
            'attributes' => ['data-bs-dismiss' => 'modal']
        ])->render(),
        BS5::button([
            'content' => 'Guardar',
            'variant' => 'primary'
        ])->render()
    ]
])->render();

// Botón que abre el modal
$button = BS5::button([
    'content' => 'Abrir Modal',
    'attributes' => [
        'data-bs-toggle' => 'modal',
        'data-bs-target' => '#miModal'
    ]
])->render();
```

### Modal con Tamaños
```php
// Modal grande
$modal = BS5::modal([
    'id' => 'modalGrande',
    'title' => 'Modal Grande',
    'body' => 'Contenido del modal grande',
    'size' => 'lg'
])->render();

// Modal pequeño
$modal = BS5::modal([
    'id' => 'modalPequeno',
    'title' => 'Modal Pequeño',
    'body' => 'Contenido del modal pequeño',
    'size' => 'sm'
])->render();

// Modal extra grande
$modal = BS5::modal([
    'id' => 'modalXL',
    'title' => 'Modal XL',
    'body' => 'Contenido muy extenso',
    'size' => 'xl'
])->render();
```

### Modal Centrado y Scrollable
```php
// Modal centrado verticalmente
$modal = BS5::modal([
    'id' => 'modalCentrado',
    'title' => 'Modal Centrado',
    'body' => 'Este modal está centrado verticalmente',
    'centered' => true
])->render();

// Modal scrollable
$modal = BS5::modal([
    'id' => 'modalScrollable',
    'title' => 'Modal con Scroll',
    'body' => 'Contenido muy largo...',
    'scrollable' => true
])->render();
```

## Offcanvas

Paneles laterales deslizantes.

### Offcanvas Básico
```php
// Offcanvas desde el inicio (izquierda)
$offcanvas = BS5::offcanvas([
    'id' => 'miOffcanvas',
    'title' => 'Título Offcanvas',
    'body' => 'Contenido del offcanvas',
    'placement' => 'start' // 'start', 'end', 'top', 'bottom'
])->render();

// Botón que abre el offcanvas
$button = BS5::button([
    'content' => 'Abrir Offcanvas',
    'attributes' => [
        'data-bs-toggle' => 'offcanvas',
        'data-bs-target' => '#miOffcanvas'
    ]
])->render();
```

### Offcanvas con Diferentes Posiciones
```php
// Offcanvas desde la derecha
$offcanvas = BS5::offcanvas([
    'id' => 'offcanvasEnd',
    'title' => 'Panel Derecho',
    'body' => 'Contenido desde la derecha',
    'placement' => 'end'
])->render();

// Offcanvas desde arriba
$offcanvas = BS5::offcanvas([
    'id' => 'offcanvasTop',
    'title' => 'Panel Superior',
    'body' => 'Contenido desde arriba',
    'placement' => 'top'
])->render();

// Offcanvas desde abajo
$offcanvas = BS5::offcanvas([
    'id' => 'offcanvasBottom',
    'title' => 'Panel Inferior',
    'body' => 'Contenido desde abajo',
    'placement' => 'bottom'
])->render();
```

### Offcanvas con Opciones
```php
// Offcanvas con scroll del body
$offcanvas = BS5::offcanvas([
    'id' => 'offcanvasScroll',
    'title' => 'Con Scroll',
    'body' => 'El body puede hacer scroll',
    'scroll' => true
])->render();

// Offcanvas con backdrop estático
$offcanvas = BS5::offcanvas([
    'id' => 'offcanvasStatic',
    'title' => 'Backdrop Estático',
    'body' => 'No se cierra al hacer clic fuera',
    'backdrop' => 'static'
])->render();

// Offcanvas sin backdrop
$offcanvas = BS5::offcanvas([
    'id' => 'offcanvasNoBackdrop',
    'title' => 'Sin Backdrop',
    'body' => 'No tiene backdrop',
    'backdrop' => false
])->render();

// Offcanvas tema oscuro
$offcanvas = BS5::offcanvas([
    'id' => 'offcanvasDark',
    'title' => 'Tema Oscuro',
    'body' => 'Offcanvas con tema oscuro',
    'dark' => true
])->render();
```

## Tooltip

Información emergente al pasar el mouse.

```php
// Tooltip básico
$button = BS5::tooltip([
    'content' => 'Información de ayuda',
    'attributes' => [
        'label' => 'Ayuda'
    ]
])->render();

// Tooltip con diferentes posiciones
$tooltipTop = BS5::tooltip([
    'content' => 'Tooltip arriba',
    'placement' => 'top',
    'attributes' => ['label' => 'Arriba']
])->render();

$tooltipRight = BS5::tooltip([
    'content' => 'Tooltip derecha',
    'placement' => 'right',
    'attributes' => ['label' => 'Derecha']
])->render();

$tooltipBottom = BS5::tooltip([
    'content' => 'Tooltip abajo',
    'placement' => 'bottom',
    'attributes' => ['label' => 'Abajo']
])->render();

$tooltipLeft = BS5::tooltip([
    'content' => 'Tooltip izquierda',
    'placement' => 'left',
    'attributes' => ['label' => 'Izquierda']
])->render();
```

## Popover

Información emergente más detallada.

```php
// Popover básico
$button = BS5::popover([
    'title' => 'Título del Popover',
    'content' => 'Contenido detallado del popover',
    'attributes' => ['label' => 'Más Info']
])->render();

// Popover con diferentes posiciones
$popoverTop = BS5::popover([
    'title' => 'Título',
    'content' => 'Contenido',
    'placement' => 'top',
    'attributes' => ['label' => 'Arriba']
])->render();

$popoverRight = BS5::popover([
    'title' => 'Título',
    'content' => 'Contenido',
    'placement' => 'right',
    'attributes' => ['label' => 'Derecha']
])->render();

// Popover dismissible (se cierra al hacer clic fuera)
$popover = BS5::popover([
    'title' => 'Popover Dismissible',
    'content' => 'Haz clic fuera para cerrar',
    'dismissible' => true,
    'attributes' => ['label' => 'Click me']
])->render();
```

## Toast

Notificaciones push.

```php
// Toast básico
$toast = BS5::toast([
    'title' => 'Notificación',
    'body' => 'Este es un mensaje de toast',
    'time' => 'hace 11 mins'
])->render();

// Toast con autohide
$toast = BS5::toast([
    'title' => 'Mensaje Temporal',
    'body' => 'Este toast se ocultará automáticamente',
    'autohide' => true,
    'delay' => 3000 // 3 segundos
])->render();

// Toast sin header
$toast = BS5::toast([
    'body' => 'Mensaje simple sin título',
    'autohide' => true
])->render();
```

## Dropdown

Menús desplegables.

```php
// Dropdown básico
$dropdown = BS5::dropdown([
    'label' => 'Opciones',
    'items' => [
        ['label' => 'Acción 1', 'href' => '#'],
        ['label' => 'Acción 2', 'href' => '#'],
        ['label' => 'Acción 3', 'href' => '#']
    ]
])->render();

// Dropdown con separadores
$dropdown = BS5::dropdown([
    'label' => 'Menú',
    'items' => [
        ['label' => 'Acción', 'href' => '#'],
        ['label' => 'Otra acción', 'href' => '#'],
        'divider',
        ['label' => 'Algo separado', 'href' => '#']
    ]
])->render();

// Dropdown con variantes
$dropdown = BS5::dropdown([
    'label' => 'Dropdown Primary',
    'variant' => 'primary',
    'items' => [
        ['label' => 'Opción 1', 'href' => '#'],
        ['label' => 'Opción 2', 'href' => '#']
    ]
])->render();
```

## Ejemplo Práctico: Panel Interactivo

```php
// Panel con componentes interactivos
$panel = BS5::container([
    'content' => [
        // Toast de bienvenida
        BS5::toast([
            'title' => 'Bienvenido',
            'body' => 'Has iniciado sesión correctamente',
            'time' => 'justo ahora',
            'autohide' => true,
            'delay' => 5000
        ])->render(),
        
        // Barra de herramientas
        BS5::row([
            'content' => [
                BS5::col([
                    'size' => '12',
                    'content' => BS5::buttonGroup([
                        'buttons' => [
                            BS5::button([
                                'content' => 'Nuevo',
                                'variant' => 'primary',
                                'attributes' => [
                                    'data-bs-toggle' => 'modal',
                                    'data-bs-target' => '#nuevoModal'
                                ]
                            ])->render(),
                            
                            BS5::tooltip([
                                'content' => 'Ver ayuda',
                                'attributes' => [
                                    'label' => 'Ayuda',
                                    'tag' => 'button'
                                ]
                            ])->render()
                        ]
                    ])->render()
                ])->render()
            ],
            'attributes' => ['class' => 'mb-3']
        ])->render(),
        
        // Modal para nuevo elemento
        BS5::modal([
            'id' => 'nuevoModal',
            'title' => 'Crear Nuevo',
            'body' => BS5::form([
                'content' => [
                    BS5::input([
                        'type' => 'text',
                        'name' => 'nombre',
                        'label' => 'Nombre'
                    ])->render(),
                    BS5::textarea([
                        'name' => 'descripcion',
                        'label' => 'Descripción',
                        'rows' => 3
                    ])->render()
                ]
            ])->render(),
            'footer' => [
                BS5::button([
                    'content' => 'Cancelar',
                    'attributes' => ['data-bs-dismiss' => 'modal']
                ])->render(),
                BS5::button([
                    'content' => 'Guardar',
                    'variant' => 'primary'
                ])->render()
            ]
        ])->render()
    ]
])->render();
```

## Opciones Disponibles

Para consultar todas las opciones disponibles de cada componente, revisa el PHPDoc en:
- `Interface\Carousel.php`
- `Interface\Collapse.php`
- `Interface\Modal.php`
- `Interface\Offcanvas.php`
- `Interface\Tooltip.php`
- `Interface\Popover.php`
- `Interface\Toast.php`
- `Interface\Dropdown.php`

O consulta `COMPONENT_STANDARDS.md` para entender el patrón arquitectónico completo.
