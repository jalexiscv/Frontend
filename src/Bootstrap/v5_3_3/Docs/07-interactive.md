# Componentes Interactivos Bootstrap 5

## Carousel

Presentación de diapositivas para recorrer elementos.

### Carrusel Básico
```php
// Carrusel simple
$carousel = BS5::carousel('miCarrusel')
    ->addSlide('imagen1.jpg', 'Título 1', 'Descripción 1')
    ->addSlide('imagen2.jpg', 'Título 2', 'Descripción 2')
    ->addSlide('imagen3.jpg', 'Título 3', 'Descripción 3')
    ->render();
```

### Carrusel con Controles
```php
// Carrusel con flechas y indicadores
$carousel = BS5::carousel('miCarrusel')
    ->withControls()
    ->withIndicators()
    ->addSlide('imagen1.jpg', 'Título 1', 'Descripción 1')
    ->addSlide('imagen2.jpg', 'Título 2', 'Descripción 2')
    ->addSlide('imagen3.jpg', 'Título 3', 'Descripción 3')
    ->render();
```

### Carrusel con Fade
```php
// Carrusel con efecto fade
$carousel = BS5::carousel('miCarrusel')
    ->fade()
    ->addSlide('imagen1.jpg', 'Título 1', 'Descripción 1')
    ->addSlide('imagen2.jpg', 'Título 2', 'Descripción 2')
    ->render();
```

## Collapse

Alternar la visibilidad de contenido.

### Colapso Básico
```php
// Botón que controla un colapso
$collapse = [
    BS5::button('Mostrar/Ocultar')
        ->dataToggle('collapse')
        ->dataTarget('#miColapso')
        ->render(),

    BS5::collapse('miColapso')
        ->content('Este contenido se puede ocultar/mostrar')
        ->render()
];
```

### Colapso con Acordeón
```php
// Acordeón con múltiples items
$accordion = BS5::accordion('miAcordeon')
    ->addItem('Item 1', 'Contenido del item 1', true)
    ->addItem('Item 2', 'Contenido del item 2')
    ->addItem('Item 3', 'Contenido del item 3')
    ->render();

// Acordeón con contenido complejo
$accordion = BS5::accordion('miAcordeon')
    ->addItem('Productos', [
        BS5::list('ul')
            ->addItem('Producto 1')
            ->addItem('Producto 2')
            ->addItem('Producto 3')
            ->render()
    ])
    ->addItem('Servicios', [
        BS5::card()
            ->body('Descripción de servicios')
            ->render()
    ])
    ->render();
```

## Modal

Diálogos modales para mostrar contenido.

### Modal Básico
```php
// Botón que abre el modal
$modal = [
    BS5::button('Abrir Modal')
        ->dataToggle('modal')
        ->dataTarget('#miModal')
        ->render(),

    BS5::modal('miModal')
        ->header('Título del Modal')
        ->body('Contenido del modal')
        ->footer([
            BS5::button('Cerrar')
                ->dataDismiss('modal')
                ->render(),
            BS5::button('Guardar')
                ->variant('primary')
                ->render()
        ])
        ->render()
];
```

### Modal con Tamaños
```php
// Modal grande
$modal = BS5::modal('modalGrande')
    ->size('lg')
    ->header('Modal Grande')
    ->body('Contenido del modal grande')
    ->footer([
        BS5::button('Cerrar')
            ->dataDismiss('modal')
            ->render()
    ])
    ->render();

// Modal pequeño
$modal = BS5::modal('modalPequeno')
    ->size('sm')
    ->header('Modal Pequeño')
    ->body('Contenido del modal pequeño')
    ->footer([
        BS5::button('Cerrar')
            ->dataDismiss('modal')
            ->render()
    ])
    ->render();
```

## Tooltips

Información emergente al pasar el mouse.

### Tooltip Básico
```php
// Botón con tooltip
$button = BS5::button('Ayuda')
    ->tooltip('Información de ayuda')
    ->render();

// Enlace con tooltip
$link = BS5::link('#')
    ->content('Más información')
    ->tooltip('Haz clic para ver más detalles')
    ->render();
```

### Tooltip con Posición
```php
// Tooltips en diferentes posiciones
$tooltips = [
    BS5::button('Arriba')
        ->tooltip('Tooltip arriba')
        ->tooltipPlacement('top')
        ->render(),

    BS5::button('Derecha')
        ->tooltip('Tooltip derecha')
        ->tooltipPlacement('right')
        ->render(),

    BS5::button('Abajo')
        ->tooltip('Tooltip abajo')
        ->tooltipPlacement('bottom')
        ->render(),

    BS5::button('Izquierda')
        ->tooltip('Tooltip izquierda')
        ->tooltipPlacement('left')
        ->render()
];
```

## Popovers

Información emergente más detallada.

### Popover Básico
```php
// Botón con popover
$button = BS5::button('Más Info')
    ->popover('Título', 'Contenido detallado del popover')
    ->render();

// Enlace con popover
$link = BS5::link('#')
    ->content('Ayuda')
    ->popover('Ayuda', 'Información de ayuda detallada')
    ->render();
```

### Popover con Posición
```php
// Popovers en diferentes posiciones
$popovers = [
    BS5::button('Arriba')
        ->popover('Título', 'Contenido')
        ->popoverPlacement('top')
        ->render(),

    BS5::button('Derecha')
        ->popover('Título', 'Contenido')
        ->popoverPlacement('right')
        ->render(),

    BS5::button('Abajo')
        ->popover('Título', 'Contenido')
        ->popoverPlacement('bottom')
        ->render(),

    BS5::button('Izquierda')
        ->popover('Título', 'Contenido')
        ->popoverPlacement('left')
        ->render()
];
```

## Ejemplo Práctico: Panel de Control

```php
// Panel de control con componentes interactivos
$dashboard = BS5::container()
    ->content([
        // Barra de herramientas
        BS5::buttonGroup()
            ->addClass('mb-3')
            ->addButton('Nuevo', [
                'variant' => 'primary',
                'data-toggle' => 'modal',
                'data-target' => '#nuevoModal'
            ])
            ->addButton('Ayuda')
            ->tooltip('Centro de ayuda')
            ->render(),

        // Modal para nuevo elemento
        BS5::modal('nuevoModal')
            ->header('Nuevo Elemento')
            ->body([
                BS5::form()
                    ->addInput('nombre', 'Nombre')
                    ->addTextarea('descripcion', 'Descripción')
                    ->render()
            ])
            ->footer([
                BS5::button('Cancelar')
                    ->dataDismiss('modal')
                    ->render(),
                BS5::button('Guardar')
                    ->variant('primary')
                    ->render()
            ])
            ->render(),

        // Acordeón con información
        BS5::accordion('infoPrincipal')
            ->addItem('Estadísticas', [
                BS5::card()
                    ->body('Contenido de estadísticas')
                    ->render()
            ], true)
            ->addItem('Configuración', [
                BS5::list('ul')
                    ->addItem('Opción 1')
                    ->addItem('Opción 2')
                    ->render()
            ])
            ->render(),

        // Carrusel de novedades
        BS5::carousel('novedades')
            ->withControls()
            ->withIndicators()
            ->addSlide('novedad1.jpg', 'Novedad 1', 'Descripción 1')
            ->addSlide('novedad2.jpg', 'Novedad 2', 'Descripción 2')
            ->render()
    ])
    ->render();
```
