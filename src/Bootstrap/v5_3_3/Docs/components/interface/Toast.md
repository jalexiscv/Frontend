# Toast - Notificaciones Push

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Notificaciones ligeras y personalizables diseñadas para imitar las notificaciones push.

**Clase PHP**: [`Toast.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Interface/Toast.php)

## Opciones

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `id` | `string` | - | **Requerido**. ID del toast |
| `content` | `mixed` | - | Contenido del toast |
| `title` | `string\|null` | `null` | Título del toast |
| `autohide` | `bool` | `true` | Si se oculta automáticamente |
| `delay` | `int` | `5000` | Delay en milisegundos |
| `animation` | `bool` | `true` | Si tiene animación |
| `position` | `string\|null` | `null` | Posición: `top-right`, `top-left`, `bottom-right`,`bottom-left`, `middle-center` |
| `container` | `bool` | `false` | Si usa contenedor |
| `attributes` | `array` | `[]` | Atributos HTML |

## Ejemplos

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Toast básico
$toast = BS5::toast([
    'id' => 'myToast',
    'title' => 'Notificación',
    'content' => 'Este es un mensaje de toast'
])->render();

// Toast con autohide personalizado
$toast = BS5::toast([
    'id' => 'toast2',
    'title' => 'Mensaje',
    'content' => 'Se oculta en 3 segundos',
    'autohide' => true,
    'delay' => 3000
])->render();

// Toast posicionado
$toast = BS5::toast([
    'id' => 'toast3',
    'content' => 'Toast en la esquina superior derecha',
    'position' => 'top-right',
    'container' => true
])->render();
```

## Activación con JavaScript

```javascript
// Mostrar el toast
const toast = new bootstrap.Toast(document.getElementById('myToast'));
toast.show();
```

## Componentesrelacionados

- [Alert](Alert.md) - Para mensajes permanentes

## Documentación Oficial

[Bootstrap 5.3 Toasts](https://getbootstrap.com/docs/5.3/components/toasts/)

---

[← Volver al Índice](../../Bootstrap.md) | [Siguiente: Tooltip →](Tooltip.md)
