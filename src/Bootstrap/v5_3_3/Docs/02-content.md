# Componentes de Contenido Bootstrap 5

## Typography

Bootstrap incluye una amplia variedad de elementos tipográficos.

### Encabezados
```php
// Encabezados básicos
$h1 = BS5::typography('h1')
    ->content('Encabezado h1')
    ->render();

// Display headings
$display = BS5::typography('h1')
    ->display(1)
    ->content('Display 1')
    ->render();

// Lead
$lead = BS5::typography('p')
    ->lead()
    ->content('Párrafo destacado')
    ->render();
```

### Elementos de Texto
```php
// Texto marcado
$mark = BS5::typography('mark')
    ->content('Texto resaltado')
    ->render();

// Texto eliminado
$del = BS5::typography('del')
    ->content('Texto eliminado')
    ->render();

// Texto subrayado
$u = BS5::typography('u')
    ->content('Texto subrayado')
    ->render();

// Texto pequeño
$small = BS5::typography('small')
    ->content('Texto pequeño')
    ->render();

// Texto en negrita
$strong = BS5::typography('strong')
    ->content('Texto en negrita')
    ->render();
```

### Listas
```php
// Lista desordenada
$ul = BS5::list('ul')
    ->addItem('Item 1')
    ->addItem('Item 2')
    ->addItem('Item 3')
    ->render();

// Lista ordenada
$ol = BS5::list('ol')
    ->addItem('Primer item')
    ->addItem('Segundo item')
    ->addItem('Tercer item')
    ->render();

// Lista sin estilo
$ul = BS5::list('ul')
    ->unstyled()
    ->addItem('Sin viñeta 1')
    ->addItem('Sin viñeta 2')
    ->render();

// Lista inline
$ul = BS5::list('ul')
    ->inline()
    ->addItem('Inline 1')
    ->addItem('Inline 2')
    ->addItem('Inline 3')
    ->render();
```

## Tables

Las tablas Bootstrap ofrecen estilos y funcionalidades avanzadas.

### Tabla Básica
```php
// Tabla simple
$table = BS5::table()
    ->headers(['#', 'Nombre', 'Email'])
    ->addRow(['1', 'Juan', 'juan@email.com'])
    ->addRow(['2', 'María', 'maria@email.com'])
    ->render();

// Tabla con estilos
$table = BS5::table()
    ->striped()
    ->hover()
    ->bordered()
    ->headers(['ID', 'Producto', 'Precio'])
    ->addRow(['1', 'Laptop', '$999'])
    ->addRow(['2', 'Mouse', '$29'])
    ->render();
```

### Tabla Responsive
```php
// Tabla que se adapta a diferentes tamaños
$table = BS5::table()
    ->responsive()
    ->headers(['Producto', 'Descripción', 'Precio', 'Stock'])
    ->addRow([
        'Laptop',
        'Laptop gaming de última generación',
        '$1299',
        '10'
    ])
    ->addRow([
        'Monitor',
        'Monitor 4K de 27 pulgadas',
        '$399',
        '5'
    ])
    ->render();
```

### Tabla con Cabecera Personalizada
```php
// Tabla con cabecera oscura
$table = BS5::table()
    ->darkHead()
    ->headers(['#', 'Usuario', 'Rol', 'Estado'])
    ->addRow(['1', 'admin', 'Administrador', 'Activo'])
    ->addRow(['2', 'user', 'Usuario', 'Inactivo'])
    ->render();

// Tabla con cabecera personalizada
$table = BS5::table()
    ->addClass('table-primary')
    ->headers(['Código', 'Producto', 'Categoría'])
    ->addRow(['001', 'Teclado', 'Periféricos'])
    ->addRow(['002', 'Mouse', 'Periféricos'])
    ->render();
```

## Images

Bootstrap proporciona utilidades para trabajar con imágenes.

### Imagen Responsive
```php
// Imagen que se adapta al contenedor
$img = BS5::image('ruta/imagen.jpg')
    ->fluid()
    ->alt('Descripción de la imagen')
    ->render();

// Imagen con bordes redondeados
$img = BS5::image('ruta/avatar.jpg')
    ->rounded()
    ->alt('Avatar de usuario')
    ->render();
```

### Imagen con Thumbnail
```php
// Imagen con estilo thumbnail
$img = BS5::image('ruta/producto.jpg')
    ->thumbnail()
    ->alt('Producto')
    ->render();

// Thumbnail con enlace
$img = BS5::link('#')
    ->content(
        BS5::image('ruta/producto.jpg')
            ->thumbnail()
            ->alt('Ver producto')
            ->render()
    )
    ->render();
```

### Figura
```php
// Figura con caption
$figure = BS5::figure()
    ->image('ruta/imagen.jpg', 'Título de la imagen')
    ->caption('Descripción detallada de la imagen')
    ->render();

// Figura con imagen responsive
$figure = BS5::figure()
    ->image('ruta/imagen.jpg', 'Título')
    ->fluid()
    ->caption('Esta imagen se adaptará al contenedor')
    ->render();
```

## Ejemplo Práctico: Artículo de Blog

```php
// Artículo completo con diferentes elementos de contenido
$article = BS5::article()
    ->content([
        BS5::typography('h1')
            ->display(4)
            ->content('Título del Artículo')
            ->render(),
            
        BS5::typography('p')
            ->lead()
            ->content('Introducción al artículo con texto destacado.')
            ->render(),
            
        BS5::figure()
            ->image('ruta/imagen.jpg', 'Imagen principal')
            ->fluid()
            ->caption('Descripción de la imagen principal')
            ->render(),
            
        BS5::typography('h2')
            ->content('Subtítulo')
            ->render(),
            
        BS5::typography('p')
            ->content('Párrafo con contenido normal del artículo.')
            ->render(),
            
        BS5::list('ul')
            ->addItem('Punto importante 1')
            ->addItem('Punto importante 2')
            ->addItem('Punto importante 3')
            ->render(),
            
        BS5::table()
            ->striped()
            ->headers(['Característica', 'Descripción'])
            ->addRow(['Item 1', 'Descripción del item 1'])
            ->addRow(['Item 2', 'Descripción del item 2'])
            ->render()
    ])
    ->render();
```
