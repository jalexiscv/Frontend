# Card - Componente de Tarjeta

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Contenedor flexible y extensible que incluye opciones para headers, footers, contenido, colores y más.

**Clase PHP**: [`Card.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Interface/Card.php)

## Opciones de Configuración

| Opción | Tipo | Descripción |
|--------|------|-------------|
| `title` | `string` | Título de la tarjeta |
| `content` | `mixed` | Contenido del cuerpo |
| `footer` | `string` | Pie de la tarjeta |
| `image` | `string` | URL de la imagen |
| `imagePosition` | `string` | Posición: `top`, `bottom` |
| `headerTitle` | `string` | Título del header |
| `headerClass` | `string` | Clases del header |
| `headerButtons` | `array` | Botones en el header |
| `bodyAttributes` | `array` | Atributos del body |
| `attributes` | `array` | Atributos HTML |

## Ejemplos

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Card básica
$card = BS5::card([
    'title' => 'Título',
    'content' => 'Contenido de la card',
    'footer' => 'Pie de la card'
])->render();

// Card con imagen
$card = BS5::card([
    'image' => 'imagen.jpg',
    'imagePosition' => 'top',
    'title' => 'Card con Imagen',
    'content' => 'Esta card tiene una imagen en la parte superior'
])->render();

// Card con header personalizado
$card = BS5::card([
    'headerTitle' => 'Dashboard',
    'headerClass' => 'bg-primary text-white',
    'headerButtons' => [
        BS5::button(['content' => 'Acción', 'variant' => 'light', 'size' => 'sm'])->render()
    ],
    'content' => 'Contenido principal'
])->render();
```

## Componentes Relacionados

- [CardGroup](CardGroup.md) - Grupos de tarjetas
- [ListGroup](ListGroup.md) - Listas en cards

## Documentación Oficial

[Bootstrap 5.3 Cards](https://getbootstrap.com/docs/5.3/components/card/)

---

[← Volver al Índice](../../Bootstrap.md) | [Siguiente: CardGroup →](CardGroup.md)
