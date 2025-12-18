# Componentes de Interfaz Bootstrap 5

> **Nota de Migración v2.0.0**: Todos los componentes ahora aceptan un único `array $options` en su constructor. Los ejemplos en esta documentación reflejan la nueva arquitectura.

## Alert

Las alertas proporcionan mensajes de retroalimentación contextual.

### Alerta Básica
```php
// Alerta simple
$alert = BS5::alert([

    'content' => '¡Operación exitosa!',
    'type' => 'success'
])->render();

// Alerta con mensaje largo
$alert = BS5::alert([
    'type' => 'info',
    'content' => 'Esta es una información importante que el usuario debe leer.'
])->render();
```

### Alerta Descartable
```php
// Alerta que se puede cerrar
$alert = BS5::alert([
    'content' => 'Mensaje importante',
    'type' => 'warning',
    'dismissible' => true
])->render();
```

### Tipos de Alertas
```php
// Primary
$alert = BS5::alert(['content' => 'Mensaje primary', 'type' => 'primary'])->render();

// Success
$alert = BS5::alert(['content' => '¡Éxito!', 'type' => 'success'])->render();

// Danger
$alert = BS5::alert(['content' => '¡Error!', 'type' => 'danger'])->render();

// Warning
$alert = BS5::alert(['content' => 'Advertencia', 'type' => 'warning'])->render();

// Info
$alert = BS5::alert(['content' => 'Información', 'type' => 'info'])->render();

// Light
$alert = BS5::alert(['content' => 'Mensaje claro', 'type' => 'light'])->render();

// Dark
$alert = BS5::alert(['content' => 'Mensaje oscuro', 'type' => 'dark'])->render();
```

## Card

Tarjetas flexibles y extensibles para mostrar contenido.

### Card Básica
```php
// Card simple
$card = BS5::card([
    'title' => 'Título de la Card',
    'content' => 'Contenido de la card',
    'footer' => 'Pie de la card'
])->render();

// Card con imagen
$card = BS5::card([
    'image' => 'ruta/imagen.jpg',
    'imagePosition' => 'top',
    'title' => 'Título',
    'content' => 'Contenido'
])->render();
```

### Card con Header Completo
```php
// Card con header personalizado
$card = BS5::card([
    'headerTitle' => 'Card con Header',
    'headerClass' => 'bg-primary text-white',
    'content' => 'Contenido de la card'
])->render();

// Card con header y botones
$card = BS5::card([
    'headerTitle' => 'Dashboard',
    'headerButtons' => [
        BS5::button(['content' => 'Editar', 'variant' => 'sm'])->render(),
        BS5::button(['content' => 'Eliminar', 'variant' => 'danger', 'size' => 'sm'])->render()
    ],
    'content' => 'Contenido principal'
])->render();
```

### Card con Atributos Personalizados
```php
// Card con clases personalizadas
$card = BS5::card([
    'title' => 'Card Centrada',
    'content' => 'Contenido centrado',
    'attributes' => ['class' => 'text-center']
])->render();

// Card con atributos en body
$card = BS5::card([
    'content' => 'Contenido con padding grande',
    'bodyAttributes' => ['class' => 'p-5']
])->render();
```

### Card Group
```php
// Grupo de cards
$cardGroup = BS5::cardGroup([
    'cards' => [
        BS5::card([
            'title' => 'Card 1',
            'content' => 'Contenido de la card 1'
        ])->render(),
        BS5::card([
            'title' => 'Card 2',
            'content' => 'Contenido de la card 2'
        ])->render(),
        BS5::card([
            'title' => 'Card 3',
            'content' => 'Contenido de la card 3'
        ])->render()
    ]
])->render();
```

## Badge

Badges para contar y etiquetar.

### Badge Básico
```php
// Badge simple
$badge = BS5::badge([
    'content' => 'Nuevo',
    'variant' => 'primary'
])->render();

// Badge con pill
$badge = BS5::badge([
    'content' => '42',
    'variant' => 'info',
    'pill' => true
])->render();
```

### Variantes de Badge
```php
// Primary
$badge = BS5::badge(['content' => 'Primary', 'variant' => 'primary'])->render();

// Secondary
$badge = BS5::badge(['content' => 'Secondary', 'variant' => 'secondary'])->render();

// Success
$badge = BS5::badge(['content' => 'Success', 'variant' => 'success'])->render();

// Danger
$badge = BS5::badge(['content' => 'Danger', 'variant' => 'danger'])->render();

// Warning
$badge = BS5::badge(['content' => 'Warning', 'variant' => 'warning'])->render();

// Info
$badge = BS5::badge(['content' => 'Info', 'variant' => 'info'])->render();

// Light
$badge = BS5::badge(['content' => 'Light', 'variant' => 'light'])->render();

// Dark
$badge = BS5::badge(['content' => 'Dark', 'variant' => 'dark'])->render();
```

### Badge en Botón
```php
// Botón con badge
$button = BS5::button([
    'content' => [
        'Notificaciones ',
        BS5::badge(['content' => '4', 'variant' => 'light'])->render()
    ],
    'variant' => 'primary'
])->render();
```

## Accordion

Paneles colapsables.

### Accordion Básico
```php
// Accordion simple
$accordion = BS5::accordion([
    'id' => 'accordionExample',
    'items' => [
        [
            'title' => 'Ítem #1',
            'content' => 'Contenido del primer ítem',
            'show' => true // Item abierto por defecto
        ],
        [
            'title' => 'Ítem #2',
            'content' => 'Contenido del segundo ítem'
        ],
        [
            'title' => 'Ítem #3',
            'content' => 'Contenido del tercer ítem'
        ]
    ]
])->render();
```

### Accordion Flush
```php
// Accordion sin bordes
$accordion = BS5::accordion([
    'id' => 'flushExample',
    'flush' => true,
    'items' => [
        [
            'title' => 'Ítem #1',
            'content' => 'Contenido del primer ítem'
        ],
        [
            'title' => 'Ítem #2',
            'content' => 'Contenido del segundo ítem'
        ]
    ]
])->render();
```

### Accordion con Múltiples Items Abiertos
```php
// Accordion que permite múltiples items abiertos
$accordion = BS5::accordion([
    'id' => 'multipleExample',
    'alwaysOpen' => true,
    'items' => [
        [
            'title' => 'Ítem #1',
            'content' => 'Contenido del primer ítem',
            'show' => true
        ],
        [
            'title' => 'Ítem #2',
            'content' => 'Contenido del segundo ítem',
            'show' => true
        ]
    ]
])->render();
```

## Button

Botones de acción.

### Botón Básico
```php
// Botón simple
$button = BS5::button([
    'content' => 'Click me',
    'variant' => 'primary'
])->render();

// Botón outline
$button = BS5::button([
    'content' => 'Outline',
    'variant' => 'outline-primary'
])->render();
```

### Tamaños de Botón
```php
// Botón pequeño
$button = BS5::button([
    'content' => 'Pequeño',
    'variant' => 'primary',
    'size' => 'sm'
])->render();

// Botón grande
$button = BS5::button([
    'content' => 'Grande',
    'variant' => 'primary',
    'size' => 'lg'
])->render();
```

### Botón Deshabilitado
```php
// Botón deshabilitado
$button = BS5::button([
    'content' => 'Deshabilitado',
    'variant' => 'primary',
    'disabled' => true
])->render();
```

## ButtonGroup

Agrupación de botones.

```php
// Grupo de botones
$buttonGroup = BS5::buttonGroup([
    'buttons' => [
        BS5::button(['content' => 'Izquierda', 'variant' => 'primary'])->render(),
        BS5::button(['content' => 'Centro', 'variant' => 'primary'])->render(),
        BS5::button(['content' => 'Derecha', 'variant' => 'primary'])->render()
    ]
])->render();

// Grupo vertical
$buttonGroup = BS5::buttonGroup([
    'vertical' => true,
    'buttons' => [
        BS5::button(['content' => 'Botón 1', 'variant' => 'secondary'])->render(),
        BS5::button(['content' => 'Botón 2', 'variant' => 'secondary'])->render()
    ]
])->render();
```

## Modal

Diálogos modales.

```php
// Modal básico
$modal = BS5::modal([
    'id' => 'exampleModal',
    'title' => 'Título del Modal',
    'body' => 'Contenido del modal',
    'footer' => [
        BS5::button(['content' => 'Cerrar', 'attributes' => ['data-bs-dismiss' => 'modal']])->render(),
        BS5::button(['content' => 'Guardar', 'variant' => 'primary'])->render()
    ]
])->render();

// Modal grande
$modal = BS5::modal([
    'id' => 'largeModal',
    'title' => 'Modal Grande',
    'body' => 'Contenido extenso...',
    'size' => 'lg'
])->render();

// Modal centrado
$modal = BS5::modal([
    'id' => 'centeredModal',
    'title' => 'Modal Centrado',
    'body' => 'Este modal está centrado verticalmente',
    'centered' => true
])->render();
```

## Spinner

Indicadores de carga.

```php
// Spinner básico
$spinner = BS5::spinner([
    'variant' => 'primary'
])->render();

// Spinner grow
$spinner = BS5::spinner([
    'variant' => 'success',
    'grow' => true
])->render();

// Spinner pequeño
$spinner = BS5::spinner([
    'variant' => 'danger',
    'size' => 'sm'
])->render();
```

## Progress

Barras de progreso.

```php
// Barra de progreso básica
$progress = BS5::progress([
    'value' => 75,
    'variant' => 'success'
])->render();

// Barra striped
$progress = BS5::progress([
    'value' => 50,
    'striped' => true
])->render();

// Barra animada
$progress = BS5::progress([
    'value' => 60,
    'striped' => true,
    'animated' => true
])->render();

// Múltiples barras
$progress = BS5::progress([
    'bars' => [
        ['value' => 15, 'variant' => 'success'],
        ['value' => 30, 'variant' => 'warning'],
        ['value' => 20, 'variant' => 'danger']
    ]
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
    'title' => 'Mensaje',
    'body' => 'Este toast se ocultará automáticamente',
    'autohide' => true,
    'delay' => 3000
])->render();
```

## Ejemplo Práctico: Panel de Control

```php
// Dashboard con múltiples componentes
$dashboard = BS5::container([
    'content' => [
        // Fila de alertas
        BS5::alert([
            'type' => 'info',
            'content' => 'Bienvenido al panel de control',
            'dismissible' => true
        ])->render(),
        
        // Fila de estadísticas con cards
        BS5::row([
            'content' => [
                BS5::col([
                    'size' => '4',
                    'content' => BS5::card([
                        'title' => 'Usuarios',
                        'content' => BS5::typography([
                            'tag' => 'h2',
                            'content' => '150',
                            'attributes' => ['class' => 'text-center']
                        ])->render(),
                        'attributes' => ['class' => 'text-center']
                    ])->render()
                ])->render(),
                
                BS5::col([
                    'size' => '4',
                    'content' => BS5::card([
                        'title' => 'Ventas',
                        'content' => BS5::typography([
                            'tag' => 'h2',
                            'content' => '1,234',
                            'attributes' => ['class' => 'text-center']
                        ])->render(),
                        'attributes' => ['class' => 'text-center']
                    ])->render()
                ])->render(),
                
                BS5::col([
                    'size' => '4',
                    'content' => BS5::card([
                        'headerTitle' => 'Notificaciones',
                        'headerButtons' => [
                            BS5::badge(['content' => '3', 'variant' => 'danger', 'pill' => true])->render()
                        ],
                        'content' => 'Sin notificaciones nuevas'
                    ])->render()
                ])->render()
            ]
        ])->render()
    ]
])->render();
```

## Opciones Disponibles

Para consultar todas las opciones disponibles de cada componente, revisa el PHPDoc en:
- `Interface\Alert.php`
- `Interface\Card.php`
- `Interface\Badge.php`
- `Interface\Accordion.php`
- `Interface\Button.php`
- `Interface\ButtonGroup.php`
- `Interface\Modal.php`
- `Interface\Spinner.php`
- `Interface\Progress.php`
- `Interface\Toast.php`

O consulta `COMPONENT_STANDARDS.md` para entender el patrón arquitectónico completo.
