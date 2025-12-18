# CardGroup - Grupo de Tarjetas

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Agrupa múltiples tarjetas en una columna conectada con ancho y alto uniforme.

**Clase PHP**: [`CardGroup.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Interface/CardGroup.php)

## Opciones

| Opción | Tipo | Default | Descripción  |
|--------|------|---------|-------------|
| `cards` | `array` | `[]` | Array de tarjetas renderizadas |
| `attributes` | `array` | `[]` | Atributos HTML |

## Ejemplos

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Grupo de tarjetas
$cardGroup = BS5::cardGroup([
    'cards' => [
        BS5::card([
            'title' => 'Card 1',
            'content' => 'Contenido de la primera tarjeta'
        ])->render(),
        BS5::card([
            'title' => 'Card 2',
            'content' => 'Contenido de la segunda tarjeta'
        ])->render(),
        BS5::card([
            'title' => 'Card 3',
            'content' => 'Contenido de la tercera tarjeta'
        ])->render()
    ]
])->render();
```

[← Volver al Índice](../../Bootstrap.md)
