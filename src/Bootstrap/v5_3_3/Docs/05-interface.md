# Componentes de Interfaz Bootstrap 5

## Alert

Las alertas proporcionan mensajes de retroalimentación contextual.

### Alerta Básica
```php
// Alerta simple
$alert = BS5::alert('¡Operación exitosa!', 'success')->render();

// Alerta con título
$alert = BS5::alert()
    ->variant('info')
    ->title('¡Atención!')
    ->content('Esta es una información importante.')
    ->render();
```

### Alerta Descartable
```php
// Alerta que se puede cerrar
$alert = BS5::alert('Mensaje importante')
    ->variant('warning')
    ->dismissible()
    ->render();
```

### Alerta con HTML
```php
// Alerta con contenido HTML
$alert = BS5::alert()
    ->variant('info')
    ->content([
        BS5::typography('h4')
            ->content('¡Actualización disponible!')
            ->render(),
        BS5::typography('p')
            ->content('Se ha lanzado una nueva versión.')
            ->render(),
        BS5::button('Actualizar ahora')
            ->variant('primary')
            ->small()
            ->render()
    ])
    ->render();
```

## Card

Tarjetas flexibles y extensibles para mostrar contenido.

### Card Básica
```php
// Card simple
$card = BS5::card()
    ->header('Título de la Card')
    ->body('Contenido de la card')
    ->footer('Pie de la card')
    ->render();

// Card con imagen
$card = BS5::card()
    ->image('ruta/imagen.jpg', 'top')
    ->header('Título')
    ->body('Contenido')
    ->render();
```

### Card con Tabs
```php
// Card con pestañas
$card = BS5::card()
    ->header('Card con Tabs')
    ->tabs([
        'tab1' => [
            'title' => 'Pestaña 1',
            'content' => 'Contenido de la pestaña 1'
        ],
        'tab2' => [
            'title' => 'Pestaña 2',
            'content' => 'Contenido de la pestaña 2'
        ]
    ])
    ->render();
```

### Card con Lista
```php
// Card con lista de elementos
$card = BS5::card()
    ->header('Lista de Elementos')
    ->listGroup([
        'Elemento 1',
        'Elemento 2',
        'Elemento 3'
    ])
    ->render();
```

### Card Group
```php
// Grupo de cards
$cardGroup = BS5::cardGroup()
    ->addCard(function($card) {
        return $card
            ->header('Card 1')
            ->body('Contenido de la card 1');
    })
    ->addCard(function($card) {
        return $card
            ->header('Card 2')
            ->body('Contenido de la card 2');
    })
    ->addCard(function($card) {
        return $card
            ->header('Card 3')
            ->body('Contenido de la card 3');
    })
    ->render();
```

## Badge

Badges para contar y etiquetar.

### Badge Básico
```php
// Badge simple
$badge = BS5::badge('Nuevo', 'primary')->render();

// Badge con pill
$badge = BS5::badge('42')
    ->variant('info')
    ->pill()
    ->render();
```

### Badge en Botón
```php
// Botón con badge
$button = BS5::button()
    ->content([
        'Notificaciones ',
        BS5::badge('4', 'light')->render()
    ])
    ->variant('primary')
    ->render();
```

## Accordion

Paneles colapsables.

### Accordion Básico
```php
// Accordion simple
$accordion = BS5::accordion('accordionExample')
    ->addItem('item1', [
        'header' => 'Ítem #1',
        'body' => 'Contenido del primer ítem'
    ])
    ->addItem('item2', [
        'header' => 'Ítem #2',
        'body' => 'Contenido del segundo ítem'
    ])
    ->addItem('item3', [
        'header' => 'Ítem #3',
        'body' => 'Contenido del tercer ítem'
    ])
    ->render();
```

### Accordion Flush
```php
// Accordion sin bordes
$accordion = BS5::accordion('flushExample')
    ->flush()
    ->addItem('item1', [
        'header' => 'Ítem #1',
        'body' => 'Contenido del primer ítem'
    ])
    ->addItem('item2', [
        'header' => 'Ítem #2',
        'body' => 'Contenido del segundo ítem'
    ])
    ->render();
```

### Accordion con Múltiples Items Abiertos
```php
// Accordion que permite múltiples items abiertos
$accordion = BS5::accordion('multipleExample')
    ->alwaysOpen()
    ->addItem('item1', [
        'header' => 'Ítem #1',
        'body' => 'Contenido del primer ítem'
    ])
    ->addItem('item2', [
        'header' => 'Ítem #2',
        'body' => 'Contenido del segundo ítem'
    ])
    ->render();
```

## Ejemplo Práctico: Dashboard

```php
// Dashboard con múltiples componentes
$dashboard = BS5::container()
    ->content([
        // Fila de estadísticas
        BS5::grid()
            ->addRow()
            ->addCol('col-md-4',
                BS5::card()
                    ->addClass('text-center')
                    ->body([
                        BS5::typography('h2')
                            ->content('150')
                            ->render(),
                        'Usuarios Activos'
                    ])
                    ->render()
            )
            ->addCol('col-md-4',
                BS5::card()
                    ->addClass('text-center')
                    ->body([
                        BS5::typography('h2')
                            ->content('85%')
                            ->render(),
                        'Satisfacción'
                    ])
                    ->render()
            )
            ->addCol('col-md-4',
                BS5::card()
                    ->addClass('text-center')
                    ->body([
                        BS5::typography('h2')
                            ->content('1,234')
                            ->render(),
                        'Ventas Totales'
                    ])
                    ->render()
            )
            ->render(),
        
        // Fila de gráficos
        BS5::grid()
            ->addRow()
            ->addClass('mt-4')
            ->addCol('col-md-8',
                BS5::card()
                    ->header('Ventas Mensuales')
                    ->body('Gráfico de ventas aquí')
                    ->render()
            )
            ->addCol('col-md-4',
                BS5::card()
                    ->header('Distribución')
                    ->body('Gráfico circular aquí')
                    ->render()
            )
            ->render(),
        
        // Fila de actividad reciente
        BS5::grid()
            ->addRow()
            ->addClass('mt-4')
            ->addCol('col-md-6',
                BS5::card()
                    ->header('Actividad Reciente')
                    ->listGroup([
                        'Usuario A realizó una compra',
                        'Usuario B actualizó su perfil',
                        'Usuario C envió un comentario',
                        'Usuario D compartió un producto'
                    ])
                    ->render()
            )
            ->addCol('col-md-6',
                BS5::card()
                    ->header('Tareas Pendientes')
                    ->body(
                        BS5::listGroup()
                            ->addItem('Revisar inventario')
                            ->addItem('Contactar proveedores')
                            ->addItem('Actualizar precios')
                            ->render()
                    )
                    ->render()
            )
            ->render()
    ])
    ->render();
```
