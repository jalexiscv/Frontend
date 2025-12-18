# Componentes de Navegación Bootstrap 5

## Navbar

La barra de navegación es uno de los componentes más importantes para la navegación del sitio.

### Navbar Básica
```php
// Barra de navegación simple
$navbar = BS5::navbar()
    ->brand('Mi Sitio')
    ->addItem('Inicio', '/')
    ->addItem('Productos', '/productos')
    ->addItem('Servicios', '/servicios')
    ->addItem('Contacto', '/contacto')
    ->render();

// Navbar con elementos activos
$navbar = BS5::navbar()
    ->brand('Mi Sitio')
    ->addItem('Inicio', '/')
    ->addItem('Productos', '/productos', true) // Item activo
    ->addItem('Servicios', '/servicios')
    ->render();
```

### Navbar con Dropdown
```php
// Barra de navegación con menú desplegable
$navbar = BS5::navbar()
    ->brand('Mi Sitio')
    ->addItem('Inicio', '/')
    ->addDropdown('Productos')
    ->addItem('Categoría 1', '/productos/cat1')
    ->addItem('Categoría 2', '/productos/cat2')
    ->addDivider()
    ->addItem('Ofertas', '/productos/ofertas')
    ->endDropdown()
    ->addItem('Contacto', '/contacto')
    ->render();

// Navbar con múltiples dropdowns
$navbar = BS5::navbar()
    ->brand('Mi Sitio')
    ->addItem('Inicio', '/')
    ->addDropdown('Productos')
    ->addItem('Ver todos', '/productos')
    ->addItem('Categorías', '/productos/categorias')
    ->endDropdown()
    ->addDropdown('Servicios')
    ->addItem('Consultoría', '/servicios/consultoria')
    ->addItem('Soporte', '/servicios/soporte')
    ->endDropdown()
    ->render();
```

### Navbar con Búsqueda
```php
// Barra de navegación con formulario de búsqueda
$navbar = BS5::navbar()
    ->brand('Mi Sitio')
    ->addItem('Inicio', '/')
    ->addItem('Productos', '/productos')
    ->addSearchForm()
    ->method('GET')
    ->action('/buscar')
    ->placeholder('Buscar...')
    ->endForm()
    ->render();
```

### Navbar Responsive
```php
// Barra de navegación que colapsa en móviles
$navbar = BS5::navbar()
    ->expand('lg')
    ->dark()
    ->bgDark()
    ->brand('Mi Sitio')
    ->addToggler()
    ->addCollapse()
    ->addItem('Inicio', '/')
    ->addItem('Productos', '/productos')
    ->addItem('Servicios', '/servicios')
    ->addItem('Contacto', '/contacto')
    ->endCollapse()
    ->render();

// Navbar responsive con dropdowns
$navbar = BS5::navbar()
    ->expand('lg')
    ->light()
    ->bgLight()
    ->brand('Mi Sitio')
    ->addToggler()
    ->addCollapse()
    ->addItem('Inicio', '/')
    ->addDropdown('Productos')
    ->addItem('Categoría 1', '/productos/cat1')
    ->addItem('Categoría 2', '/productos/cat2')
    ->endDropdown()
    ->addDropdown('Servicios')
    ->addItem('Soporte', '/servicios/soporte')
    ->addItem('Contacto', '/servicios/contacto')
    ->endDropdown()
    ->endCollapse()
    ->render();
```

## Breadcrumb

Indicador de la ubicación actual dentro de una jerarquía de navegación.

### Breadcrumb Básico
```php
// Migas de pan simples
$breadcrumb = BS5::breadcrumb()
    ->addItem('Inicio', '/')
    ->addItem('Productos', '/productos')
    ->addItem('Categoría', '/productos/categoria')
    ->addItem('Producto Actual')
    ->render();
```

### Breadcrumb con Separador Personalizado
```php
// Migas de pan con separador personalizado
$breadcrumb = BS5::breadcrumb()
    ->divider('>')
    ->addItem('Inicio', '/')
    ->addItem('Productos', '/productos')
    ->addItem('Producto Actual')
    ->render();
```

## Pagination

Sistema de paginación para navegar entre páginas de contenido.

### Paginación Básica
```php
// Paginación simple
$pagination = BS5::pagination()
    ->addItem('Anterior', '#', true)
    ->addItem('1', '#', true)
    ->addItem('2', '#')
    ->addItem('3', '#')
    ->addItem('Siguiente', '#')
    ->render();
```

### Paginación con Tamaños
```php
// Paginación grande
$pagination = BS5::pagination()
    ->size('lg')
    ->addItem('Anterior', '#')
    ->addItem('1', '#')
    ->addItem('2', '#', true)
    ->addItem('3', '#')
    ->addItem('Siguiente', '#')
    ->render();

// Paginación pequeña
$pagination = BS5::pagination()
    ->size('sm')
    ->addItem('Anterior', '#')
    ->addItem('1', '#')
    ->addItem('2', '#')
    ->addItem('3', '#')
    ->addItem('Siguiente', '#')
    ->render();
```

### Paginación con Estados
```php
// Paginación con elementos deshabilitados
$pagination = BS5::pagination()
    ->addItem('Anterior', '#', false, true)
    ->addItem('1', '#', true)
    ->addItem('2', '#')
    ->addItem('3', '#')
    ->addItem('Siguiente', '#')
    ->render();
```

## Ejemplo Práctico: Menú de Configuración

```php
// Menú de configuración completo
$settingsMenu = BS5::container()
    ->content([
        BS5::navbar()
            ->expand('lg')
            ->light()
            ->bgLight()
            ->brand('Configuración')
            ->addToggler()
            ->addCollapse()
            ->addItem('General', '#general', true)
            ->addDropdown('Usuario')
            ->addItem('Perfil', '#perfil')
            ->addItem('Preferencias', '#preferencias')
            ->addDivider()
            ->addItem('Cerrar Sesión', '#logout')
            ->endDropdown()
            ->addItem('Ayuda', '#ayuda')
            ->endCollapse()
            ->render(),
            
        BS5::breadcrumb()
            ->addClass('mt-3')
            ->addItem('Inicio', '/')
            ->addItem('Configuración', '/config')
            ->addItem('General')
            ->render(),
            
        BS5::grid()
            ->addRow()
            ->addCol('col-12',
                BS5::pagination()
                    ->addClass('justify-content-center mt-4')
                    ->addItem('Anterior', '#')
                    ->addItem('1', '#', true)
                    ->addItem('2', '#')
                    ->addItem('3', '#')
                    ->addItem('Siguiente', '#')
                    ->render()
            )
            ->render()
    ])
    ->render();
```
