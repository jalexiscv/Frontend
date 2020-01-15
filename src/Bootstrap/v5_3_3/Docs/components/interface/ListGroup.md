# ListGroup - Lista de Grupos

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Componente flexible para mostrar series de contenido, desde listas simples hasta complejas con contenido personalizado.

**Clase PHP**: [`ListGroup.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Interface/ListGroup.php)

## Opciones

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `items` | `array` | `[]` | Array de items |
| `flush` | `bool` | `false` | Elimina bordes y esquinas redondeadas |
| `numbered` | `bool` | `false` | Lista numerada |
| `horizontal` | `bool\|string` | `false` | Horizontal o breakpoint |
| `attributes` | `array` | `[]` | Atributos HTML |

## Ejemplos

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Lista básica
$listGroup = BS5::listGroup([
    'items' => [
        ['content' => 'Item 1'],
        ['content' => 'Item 2', 'active' => true],
        ['content' => 'Item 3']
    ]
])->render();

// Lista con enlaces
$listGroup = BS5::listGroup([
    'items' => [
        ['content' => 'Inicio', 'href' => '/', 'active' => true],
        ['content' => 'Perfil', 'href' => '/perfil'],
        ['content' => 'Configuración', 'href' => '/config']
    ]
])->render();

// Lista numerada
$listGroup = BS5::listGroup([
    'numbered' => true,
    'items' => [
        ['content' => 'PrimerPaso'],
        ['content' => 'Segundo paso'],
        ['content' => 'Tercer paso']
    ]
])->render();

// Lista flush
$listGroup = BS5::listGroup([
    'flush' => true,
    'items' => [
        ['content' => 'Sin bordes']
    ]
])->render();
```

[← Volver al Índice](../../Bootstrap.md) | [Siguiente: CardGroup →](CardGroup.md)
