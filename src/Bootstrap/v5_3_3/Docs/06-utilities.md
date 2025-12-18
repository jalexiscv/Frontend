# Utilidades Bootstrap 5

## Espaciado

Bootstrap incluye utilidades para modificar el padding y margin de los elementos.

```php
// Margin
$element = BS5::div()
    ->margin(3)           // m-3
    ->marginTop(2)        // mt-2
    ->marginBottom(4)     // mb-4
    ->marginX(2)         // mx-2
    ->marginY(3)         // my-3
    ->render();

// Padding
$element = BS5::div()
    ->padding(3)         // p-3
    ->paddingTop(2)      // pt-2
    ->paddingBottom(4)   // pb-4
    ->paddingX(2)       // px-2
    ->paddingY(3)       // py-3
    ->render();
```

## Bordes

Utilidades para modificar los bordes de los elementos.

```php
$element = BS5::div()
    ->border()           // border
    ->borderTop()        // border-top
    ->borderBottom()     // border-bottom
    ->borderColor('primary') // border-primary
    ->borderWidth(2)     // border-2
    ->rounded()          // rounded
    ->roundedCircle()    // rounded-circle
    ->render();
```

## Colores

Utilidades para modificar colores de texto y fondo.

```php
$element = BS5::div()
    ->textColor('primary')    // text-primary
    ->bgColor('light')        // bg-light
    ->bgGradient('primary')   // bg-gradient-primary
    ->render();
```

## Display

Controla cómo se muestra un elemento.

```php
$element = BS5::div()
    ->display('none')         // d-none
    ->displayMd('block')      // d-md-block
    ->displayLg('flex')       // d-lg-flex
    ->render();
```

## Flex

Utilidades para trabajar con flexbox.

```php
$container = BS5::div()
    ->display('flex')         // d-flex
    ->justifyContent('between') // justify-content-between
    ->alignItems('center')    // align-items-center
    ->flexWrap()             // flex-wrap
    ->render();

$item = BS5::div()
    ->flex('grow-1')         // flex-grow-1
    ->flexShrink(0)         // flex-shrink-0
    ->alignSelf('start')    // align-self-start
    ->render();
```

## Posición

Utilidades para controlar la posición de elementos.

```php
$element = BS5::div()
    ->position('relative')    // position-relative
    ->position('absolute')    // position-absolute
    ->top(0)                 // top-0
    ->start(50)              // start-50
    ->translate('middle')     // translate-middle
    ->render();
```

## Sombras

Añade sombras a los elementos.

```php
$element = BS5::div()
    ->shadow()               // shadow
    ->shadowSm()            // shadow-sm
    ->shadowLg()            // shadow-lg
    ->render();
```

## Tamaño

Controla el ancho y alto de los elementos.

```php
$element = BS5::div()
    ->width(50)             // w-50
    ->height(100)           // h-100
    ->maxWidth(100)         // mw-100
    ->minHeight(100)        // mh-100
    ->render();
```

## Texto

Utilidades para el formato de texto.

```php
$text = BS5::typography('p')
    ->textAlign('center')    // text-center
    ->textTruncate()         // text-truncate
    ->textWrap()             // text-wrap
    ->fontWeight('bold')     // fw-bold
    ->fontStyle('italic')    // fst-italic
    ->render();
```

## Visibilidad

Controla la visibilidad de elementos.

```php
$element = BS5::div()
    ->visible()              // visible
    ->invisible()            // invisible
    ->render();
```

## Helpers

### Clearfix
```php
$element = BS5::div()
    ->clearfix()
    ->render();
```

### Ratio
```php
$element = BS5::div()
    ->ratio('16x9')         // ratio ratio-16x9
    ->render();
```

### Stretched Link
```php
$link = BS5::link()
    ->stretchedLink()       // stretched-link
    ->render();
```

### Text Truncation
```php
$text = BS5::typography('p')
    ->textTruncate()        // text-truncate
    ->render();
```

### Vertical Rule
```php
$vr = BS5::vr()            // vertical rule
    ->render();
```

### Visual Hidden
```php
$element = BS5::div()
    ->visuallyHidden()      // visually-hidden
    ->visuallyHiddenFocusable() // visually-hidden-focusable
    ->render();
```
