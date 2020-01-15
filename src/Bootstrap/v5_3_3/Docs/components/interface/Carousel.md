# Carousel - Carrusel de Imágenes

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Carrusel o slideshow para rotar elementos, imágenes o diapositivas de texto, como un carrusel.

**Clase PHP**: [`Carousel.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Interface/Carousel.php)

## Opciones

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `id` | `string` | - | **Requerido**. ID del carousel |
| `slides` | `array` | `[]` | Array de slides |
| `controls` | `bool` | `true` | Mostrar controles prev/next |
| `indicators` | `bool` | `true` | Mostrar indicadores |
| `fade` | `bool` | `false` | Animación fade  |
| `dark` | `bool` | `false` | Versión oscura |

## Estructura de Slides

```php
[
    [
        'image' => 'ruta/imagen.jpg',
        'title' => 'Título opcional',
        'caption' => 'Descripción opcional',
        'active' => true // Primer slide activo
    ]
]
```

## Ejemplos

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Carousel básico
$carousel = BS5::carousel([
    'id' => 'myCarousel',
    'slides' => [
        [
            'image' => 'img/slide1.jpg',
            'title' => 'Primera Diapositiva',
            'caption' => 'Descripción de la primera',
            'active' => true
        ],
        [
            'image' => 'img/slide2.jpg',
            'title' => 'Segunda Diapositiva',
            'caption' => 'Descripción de la segunda'
        ],
        [
            'image' => 'img/slide3.jpg',
            'title' => 'Tercera Diapositiva',
            'caption' => 'Descripción de la tercera'
        ]
    ]
])->render();

// Carousel con fade
$carousel = BS5::carousel([
    'id' => 'fadeCarousel',
    'fade' => true,
    'slides' => [...]
])->render();

// Carousel sin controles ni indicadores
$carousel = BS5::carousel([
    'id' => 'simpleCarousel',
    'controls' => false,
    'indicators' => false,
    'slides' => [...]
])->render();
```

[← Volver al Índice](../../Bootstrap.md) | [Siguiente: CardGroup →](CardGroup.md)
