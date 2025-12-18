# Utilidades de Bootstrap 5

> **⚠️ NOTA IMPORTANTE**: Este documento describe utilidades CSS de Bootstrap 5, no componentes del Framework Frontend.
> 
> Las utilidades de Bootstrap son **clases CSS** que se aplican directamente a elementos HTML. Este framework no proporciona métodos PHP para cada utilidad CSS.
> 
> **Uso recomendado**: Aplicar las clases CSS directamente en el atributo `attributes` de los componentes.

---

## Cómo Usar Utilidades de Bootstrap

Las utilidades de Bootstrap se aplican mediante el array `attributes` de cualquier componente:

```php
// Aplicar clases de espaciado
$card = BS5::card([
    'content' => 'Mi contenido',
    'attributes' => ['class' => 'm-3 p-4']  // margin-3, padding-4
])->render();

// Aplicar múltiples utilidades
$button = BS5::button([
    'content' => 'Click me',
    'variant' => 'primary',
    'attributes' => [
        'class' => 'shadow-lg rounded-pill mt-3'
    ]
])->render();
```

---

## Espaciado

Bootstrap incluye utilidades para modificar el padding y margin de los elementos.

### Clases Disponibles

**Margin**: `m-{size}`, `mt-{size}`, `mb-{size}`, `ms-{size}`, `me-{size}`, `mx-{size}`, `my-{size}`  
**Padding**: `p-{size}`, `pt-{size}`, `pb-{size}`, `ps-{size}`, `pe-{size}`, `px-{size}`, `py-{size}`  
**Tamaños**: 0, 1, 2, 3, 4, 5, auto

```php
// Ejemplos de uso
$element = BS5::container([
    'content' => 'Contenido',
    'attributes' => ['class' => 'm-3 p-4']  // margin 3, padding 4
])->render();

$card = BS5::card([
    'content' => 'Card content',
    'attributes' => ['class' => 'mt-5 mb-3']  // margin-top 5, margin-bottom 3
])->render();
```

---

## Bordes

Utilidades para modificar los bordes de los elementos.

### Clases Disponibles

**Bordes**: `border`, `border-{side}`, `border-{color}`, `border-{width}`  
**Redondeado**: `rounded`, `rounded-{size}`, `rounded-circle`, `rounded-pill`

```php
$card = BS5::card([
    'content' => 'Contenido',
    'attributes' => ['class' => 'border border-primary rounded']
])->render();

$image = BS5::image([
    'src' => 'foto.jpg',
    'attributes' => ['class' => 'rounded-circle border border-3']
])->render();
```

---

## Colores

Utilidades para modificar colores de texto y fondo.

### Clases Disponibles

**Texto**: `text-{color}` (primary, secondary, success, danger, warning, info, light, dark, muted)  
**Fondo**: `bg-{color}`, `bg-gradient`

```php
$alert = BS5::alert([
    'content' => 'Mensaje importante',
    'type' => 'primary',
    'attributes' => ['class' => 'text-white bg-gradient']
])->render();

$badge = BS5::badge([
    'content' => 'Nuevo',
    'attributes' => ['class' => 'bg-success text-white']
])->render();
```

---

## Display

Controla cómo se muestra un elemento.

### Clases Disponibles

**Display**: `d-{value}`, `d-{breakpoint}-{value}`  
**Valores**: none, inline, inline-block, block, grid, table, flex, inline-flex

```php
$element = BS5::card([
    'content' => 'Visible en desktop',
    'attributes' => ['class' => 'd-none d-md-block']  // oculto en móvil, visible en md+
])->render();

$flex = BS5::row([
    'content' => '...',
    'attributes' => ['class' => 'd-flex justify-content-between']
])->render();
```

---

## Flexbox

Utilidades para trabajar con flexbox.

### Clases Disponibles

**Flex**: `d-flex`, `flex-{direction}`, `flex-{wrap}`, `justify-content-{value}`, `align-items-{value}`  

```php
$container = BS5::row([
    'content' => [...],
    'attributes' => ['class' => 'd-flex justify-content-between align-items-center flex-wrap']
])->render();

$item = BS5::col([
    'content' => '...',
    'attributes' => ['class' => 'flex-grow-1 align-self-start']
])->render();
```

---

## Posición

Utilidades para controlar la posición de elementos.

### Clases Disponibles

**Posición**: `position-{value}` (static, relative, absolute, fixed, sticky)  
**Posicionamiento**: `top-{value}`, `bottom-{value}`, `start-{value}`, `end-{value}`

```php
$badge = BS5::badge([
    'content' => '5',
    'notification' => true,
    'attributes' => ['class' => 'position-absolute top-0 start-100 translate-middle']
])->render();
```

---

## Sombras

Añade sombras a los elementos.

### Clases Disponibles

**Sombra**: `shadow-none`, `shadow-sm`, `shadow`, `shadow-lg`

```php
$card = BS5::card([
    'content' => 'Card con sombra',
    'attributes' => ['class' => 'shadow-lg']
])->render();
```

---

## Tamaño

Controla el ancho y alto de los elementos.

### Clases Disponibles

**Ancho**: `w-{value}` (25, 50, 75, 100, auto)  
**Alto**: `h-{value}` (25, 50, 75, 100, auto)  
**Max/Min**: `mw-{value}`, `mh-{value}`, `min-vw-{value}`, `min-vh-{value}`

```php
$container = BS5::container([
    'content' => 'Full width',
    'attributes' => ['class' => 'w-100']
])->render();

$image = BS5::image([
    'src' => 'imagen.jpg',
    'attributes' => ['class' => 'mw-100 h-auto']
])->render();
```

---

## Texto

Utilidades para el formato de texto.

### Clases Disponibles

**Alineación**: `text-{alignment}` (start, center, end, justify)  
**Wrap**: `text-wrap`, `text-nowrap`, `text-truncate`  
**Peso**: `fw-{weight}` (light, normal, bold, bolder)  
**Estilo**: `fst-{style}` (italic, normal)

```php
$heading = BS5::typography([
    'tag' => 'h1',
    'content' => 'Título importante',
    'attributes' => ['class' => 'text-center fw-bold']
])->render();

$paragraph = BS5::typography([
    'tag' => 'p',
    'content' => 'Texto con estilo',
    'attributes' => ['class' => 'text-truncate fst-italic']
])->render();
```

---

## Visibilidad

Controla la visibilidad de elementos.

### Clases Disponibles

**Visibilidad**: `visible`, `invisible`

```php
$element = BS5::alert([
    'content' => 'Este elemento está invisible',
    'attributes' => ['class' => 'invisible']
])->render();
```

---

## Helpers

### Clearfix
```php
$container = BS5::row([
    'content' => '...',
    'attributes' => ['class' => 'clearfix']
])->render();
```

### Ratio
```php
$videoWrapper = BS5::figure([
    'image' => '<iframe src="..."></iframe>',
    'attributes' => ['class' => 'ratio ratio-16x9']
])->render();
```

### Stretched Link
```php
$card = BS5::card([
    'content' => [
        BS5::typography(['tag' => 'h5', 'content' => 'Título'])->render(),
        BS5::typography([
            'tag' => 'a',
            'content' => 'Link que cubre toda la card',
            'attributes' => ['href' => '#', 'class' => 'stretched-link']
        ])->render()
    ]
])->render();
```

### Vertical Rule
```php
// Usando componente div con clase vr
$vr = BS5::container([
    'content' => '',
    'attributes' => ['class' => 'vr']
])->render();
```

### Visually Hidden
```php
$label = BS5::typography([
    'tag' => 'span',
    'content' => 'Label para lectores de pantalla',
    'attributes' => ['class' => 'visually-hidden']
])->render();

$skipLink = BS5::typography([
    'tag' => 'a',
    'content' => 'Saltar al contenido',
    'attributes' => ['href' => '#main', 'class' => 'visually-hidden-focusable']
])->render();
```

---

## Referencia Completa

Para la lista completa de utilidades de Bootstrap 5.3, consulta:
- [Documentación oficial de Bootstrap 5.3 - Utilities](https://getbootstrap.com/docs/5.3/utilities/)
- [Cheat Sheet de Bootstrap 5](https://bootstrap-cheatsheet.themeselection.com/)

---

**Versión**: 2.0.0  
**Última actualización**: 2025-12-18
