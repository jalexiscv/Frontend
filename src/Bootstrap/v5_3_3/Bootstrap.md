# Componentes Bootstrap 5 a Implementar

## Componentes de Diseño
1. **Containers**
   - Default container
   - Responsive containers
   - Fluid container

2. **Grid**
   - Row
   - Col
   - Gutters

3. **Columns**
   - Equal-width
   - Variable width
   - Responsive columns

## Componentes de Contenido
4. **Typography**
   - Headings
   - Display headings
   - Lead
   - Inline text elements
   - Lists

5. **Images**
   - Responsive images
   - Image thumbnails
   - Figures

6. **Tables**
   - Basic tables
   - Striped rows
   - Bordered tables
   - Hoverable rows
   - Responsive tables

## Componentes de Formulario
7. **Form Controls**
   - Input
   - Textarea
   - Select
   - Checks
   - Radios
   - Range
   - Input group
   - Floating labels

8. **Form Layout**
   - Form grid
   - Horizontal form
   - Inline form

9. **Form Validation**
   - Custom validation
   - Server side validation
   - Tooltips

## Componentes de Navegación
10. **Navbar**
    - Basic navbar
    - Brand
    - Nav items
    - Dropdowns
    - Forms
    - Text

11. **Nav**
    - Base nav
    - Tabs
    - Pills
    - Fill and justify
    - Vertical

12. **Pagination**
    - Basic pagination
    - Sized pagination
    - Alignment
    - States

## Componentes de Interfaz
13. **Alerts**
    - Basic alerts
    - Dismissible alerts
    - Links
    - Additional content

14. **Badge**
    - Basic badges
    - Positioned badges
    - Background variants
    - Pill badges

15. **Breadcrumb**
    - Basic breadcrumb
    - Dividers
    - Custom separators

16. **Buttons**
    - Basic buttons
    - Button tags
    - Outline buttons
    - Sizes
    - States
    - Toggle states
    - Button groups

17. **Card**
    - Basic cards
    - Header and footer
    - List groups
    - Navigation
    - Images
    - Horizontal cards
    - Card groups

18. **Carousel**
    - Basic carousel
    - With controls
    - With indicators
    - With captions
    - Crossfade

19. **Collapse**
    - Basic collapse
    - Accordion
    - Horizontal collapse

20. **Dropdowns**
    - Single button
    - Split button
    - Sizing
    - Directions
    - Menu items
    - Menu alignment

21. **Modal**
    - Basic modal
    - Static backdrop
    - Scrolling content
    - Vertically centered
    - Tooltips and popovers
    - Optional sizes

22. **Offcanvas**
    - Basic offcanvas
    - Placement
    - Backdrop
    - Static

23. **Progress**
    - Basic progress
    - Labels
    - Height
    - Backgrounds
    - Multiple bars
    - Striped
    - Animated stripes

24. **Spinners**
    - Border spinner
    - Growing spinner
    - Sizes
    - Buttons
    - Alignment

25. **Toasts**
    - Basic toast
    - Live example
    - Stacking
    - Placement
    - Accessibility

## Componentes de Utilidad
26. **Close Button**
    - Basic close button
    - Disabled state

27. **Placeholders**
    - Basic placeholder
    - Width
    - Color
    - Sizing
    - Animation

## Estado de Implementación

### Componentes de Diseño
- [x] Container (Implementado)
- [x] Grid (Implementado)
- [x] Columns (Implementado)

### Componentes de Contenido
- [x] Typography (Implementado)
- [x] Image (Implementado)
- [x] Table (Implementado)

### Componentes de Formulario
- [x] FormControl (Implementado)
- [x] Check (Implementado)
- [x] InputGroup (Implementado)
- [x] Form Layout (Implementado)
- [x] Form Validation (Implementado)

### Componentes de Navegación
- [x] Navbar (Implementado)
- [x] Nav (Implementado)
- [x] Breadcrumb (Implementado)
- [x] Pagination (Implementado)

### Componentes de Interfaz
- [x] Alert (Implementado)
- [x] Badge (Implementado)
- [x] Button (Implementado)
- [x] ButtonGroup (Implementado)
- [x] Card (Implementado)
- [x] Carousel (Implementado)
- [x] Collapse (Implementado)
- [x] Dropdown (Implementado)
- [x] ListGroup (Implementado)
- [x] Modal (Implementado)
- [x] Offcanvas (Implementado)
- [x] Progress (Implementado)
- [x] Spinner (Implementado)
- [x] Toast (Implementado)
- [x] Tooltip (Implementado)
- [x] Popover (Implementado)
- [x] Accordion (Implementado)

## Ejemplos de Uso

### Componentes de Diseño

```php
// Container
$container = BS5::container()
    ->fluid()
    ->content('Contenido');

// Grid
$grid = BS5::grid()
    ->addRow()
    ->addCol('col-md-6', 'Columna 1')
    ->addCol('col-md-6', 'Columna 2');
```

### Componentes de Contenido

```php
// Typography
$heading = BS5::typography('h1')
    ->display(1)
    ->content('Título Grande');

// Image
$image = BS5::image('imagen.jpg')
    ->fluid()
    ->thumbnail();

// Table
$table = BS5::table()
    ->striped()
    ->hover()
    ->responsive();
```

### Componentes de Formulario

```php
// FormControl
$input = BS5::formControl('text', 'nombre')
    ->label('Nombre')
    ->placeholder('Ingrese su nombre')
    ->required();

// Check
$check = BS5::check('acepto')
    ->label('Acepto los términos')
    ->switch()
    ->inline();

// InputGroup
$inputGroup = BS5::inputGroup()
    ->prepend('@')
    ->input('text', 'usuario');
```

### Componentes de Navegación

```php
// Navbar
$navbar = BS5::navbar()
    ->setBrand('Mi Sitio')
    ->addItem('Inicio', '/', ['active' => true])
    ->addDropdown('Usuario', [
        ['text' => 'Perfil', 'href' => '/perfil'],
        'divider',
        ['text' => 'Salir', 'href' => '/logout']
    ]);

// Nav
$nav = BS5::nav()
    ->pills()
    ->addItem('Inicio', '/', ['active' => true]);

// Breadcrumb
$breadcrumb = BS5::breadcrumb()
    ->addItem('Inicio', '/')
    ->addItem('Categoría', '/categoria')
    ->addItem('Producto', null, true);

// Pagination
$pagination = BS5::pagination()
    ->size('lg')
    ->addItem(1, '?page=1', true)
    ->addItem(2, '?page=2');
```

### Componentes de Interfaz

```php
// Alert
$alert = BS5::alert('¡Operación exitosa!', 'success')
    ->dismissible();

// Badge
$badge = BS5::badge('Nuevo')
    ->pill()
    ->variant('primary');

// Button
$button = BS5::button('Guardar')
    ->variant('primary')
    ->size('lg')
    ->outline();

// Card
$card = BS5::card()
    ->header('Título')
    ->body('Contenido')
    ->footer('Pie');

// Modal
$modal = BS5::modal('miModal', 'Título')
    ->body('Contenido')
    ->addButton('Cerrar', ['dismiss' => true])
    ->addButton('Guardar', ['variant' => 'primary']);

// Toast
$toast = BS5::toast('miToast', 'Mensaje')
    ->header('Notificación')
    ->autohide();

// Progress
$progress = BS5::progress()
    ->value(75)
    ->striped()
    ->animated();

// Spinner
$spinner = BS5::spinner()
    ->type('border')
    ->variant('primary')
    ->size('sm');
```

## Prioridad de Implementación

1. **Alta Prioridad**
   - Buttons (fundamental)
   - Forms (uso frecuente)
   - Navbar (navegación esencial)
   - Modal (interactividad común)

2. **Media Prioridad**
   - Dropdown
   - List Group
   - Pagination
   - Progress

3. **Baja Prioridad**
   - Carousel
   - Popovers
   - Scrollspy
   - Toasts

## Notas de Implementación

- Cada componente debe implementar la interfaz `AbstractComponent`
- Incluir soporte para accesibilidad (ARIA)
- Mantener compatibilidad con JavaScript de Bootstrap
- Documentar ejemplos de uso
- Incluir pruebas unitarias
