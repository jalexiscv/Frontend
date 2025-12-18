# Componentes de Diseño Bootstrap 5

## Container

El contenedor es el elemento de diseño más básico en Bootstrap y es **requerido cuando se usa el sistema de grid**. 

### Container Regular
```php
// Contenedor básico con ancho máximo que cambia en cada breakpoint
$container = BS5::container()
    ->content('Contenido del contenedor')
    ->render();

// Contenedor con múltiples elementos
$container = BS5::container()
    ->content([
        BS5::typography('h1')
            ->content('Título')
            ->render(),
        BS5::typography('p')
            ->content('Párrafo')
            ->render()
    ])
    ->render();
```

### Container Fluid
```php
// Contenedor que ocupa el 100% del ancho
$container = BS5::container()
    ->fluid()
    ->content('Contenido del contenedor fluid')
    ->render();
```

### Container con Breakpoint
```php
// Contenedor fluid hasta llegar al breakpoint
$container = BS5::container()
    ->breakpoint('md') // sm|md|lg|xl|xxl
    ->content('Contenedor responsive')
    ->render();
```

## Grid

El sistema de grid de Bootstrap usa flexbox y permite hasta 12 columnas.

### Grid Básico
```php
// Grid con columnas iguales
$grid = BS5::grid()
    ->addRow()
    ->addCol('col-md-6', 'Columna 1')
    ->addCol('col-md-6', 'Columna 2')
    ->render();

// Grid con contenido complejo
$grid = BS5::grid()
    ->addRow()
    ->addCol('col-md-8', 
        BS5::card()
            ->header('Título')
            ->body('Contenido')
            ->render()
    )
    ->addCol('col-md-4',
        BS5::listGroup()
            ->addItem('Item 1')
            ->addItem('Item 2')
            ->render()
    )
    ->render();
```

### Grid con Diferentes Tamaños
```php
// Grid responsive
$grid = BS5::grid()
    ->addRow()
    ->addCol('col-12 col-md-8', 'Columna Principal')
    ->addCol('col-12 col-md-4', 'Barra Lateral')
    ->render();
```

### Grid con Alineación
```php
// Alineación vertical
$grid = BS5::grid()
    ->addRow()
    ->alignItems('center')
    ->addCol('col-md-4', 'Arriba')
    ->addCol('col-md-4', 'Centro')
    ->addCol('col-md-4', 'Abajo')
    ->render();

// Alineación horizontal
$grid = BS5::grid()
    ->addRow()
    ->justifyContent('between')
    ->addCol('col-2', 'Izquierda')
    ->addCol('col-2', 'Centro')
    ->addCol('col-2', 'Derecha')
    ->render();
```

### Grid con Gutters
```php
// Espaciado entre columnas
$grid = BS5::grid()
    ->addRow()
    ->gutter(4)
    ->addCol('col-md-6', 'Columna 1')
    ->addCol('col-md-6', 'Columna 2')
    ->render();

// Espaciado vertical y horizontal
$grid = BS5::grid()
    ->addRow()
    ->gutterX(3)
    ->gutterY(5)
    ->addCol('col-md-4', 'Col 1')
    ->addCol('col-md-4', 'Col 2')
    ->addCol('col-md-4', 'Col 3')
    ->render();
```

## Ejemplo Práctico: Layout de Página

```php
// Layout completo de una página
$page = BS5::container()
    ->fluid()
    ->content([
        // Header
        BS5::container()
            ->breakpoint('lg')
            ->content(
                BS5::grid()
                    ->addRow()
                    ->alignItems('center')
                    ->addCol('col-12 col-lg-6',
                        BS5::typography('h1')
                            ->content('Mi Sitio Web')
                            ->render()
                    )
                    ->addCol('col-12 col-lg-6',
                        BS5::nav()
                            ->addClass('justify-content-end')
                            ->addItem('Inicio', '#')
                            ->addItem('Acerca', '#')
                            ->addItem('Contacto', '#')
                            ->render()
                    )
                    ->render()
            )
            ->render(),

        // Main Content
        BS5::container()
            ->breakpoint('lg')
            ->addClass('my-4')
            ->content(
                BS5::grid()
                    ->addRow()
                    ->gutter(4)
                    ->addCol('col-12 col-lg-8', [
                        BS5::card()
                            ->header('Contenido Principal')
                            ->body('Aquí va el contenido principal')
                            ->render()
                    ])
                    ->addCol('col-12 col-lg-4', [
                        BS5::card()
                            ->header('Barra Lateral')
                            ->body('Contenido secundario')
                            ->render()
                    ])
                    ->render()
            )
            ->render(),

        // Footer
        BS5::container()
            ->breakpoint('lg')
            ->addClass('mt-4')
            ->content(
                BS5::grid()
                    ->addRow()
                    ->addCol('col-12',
                        BS5::typography('p')
                            ->addClass('text-center')
                            ->content(' 2025 Mi Sitio Web')
                            ->render()
                    )
                    ->render()
            )
            ->render()
    ])
    ->render();
```
