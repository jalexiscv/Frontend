# Modal - Componente Modal

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Diálogos modales para contenido superpuesto, lightboxes o mensajes de usuario.

**Clase PHP**: [`Modal.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Interface/Modal.php)

## Opciones

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `id` | `string` | - | **Requerido**. ID único del modal |
| `title` | `string` | - | Título del modal |
| `body` | `mixed` | - | Contenido del cuerpo |
| `footer` | `mixed` | - | Contenido del pie |
| `size` | `string\|null` | `null` | Tamaño: `sm`, `lg`, `xl` |
| `centered` | `bool` | `false` | Si está centrado verticalmente |
| `scrollable` | `bool` | `false` | Si el body es scrollable |
| `static` | `bool` | `false` | Si tiene backdrop estático |
| `fullscreen` | `bool\|string` | `false` | Fullscreen o breakpoint |
| `animation` | `bool` | `true` | Si tiene animación fade |
| `attributes` | `array` | `[]` | Atributos HTML |

## Ejemplos

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Modal básico
$modal = BS5::modal([
    'id' => 'myModal',
    'title' => 'Título',
    'body' => 'Contenido del modal',
    'footer' => [
        BS5::button(['content' => 'Cerrar', 'attributes' => ['data-bs-dismiss' => 'modal']])->render(),
        BS5::button(['content' => 'Guardar', 'variant' => 'primary'])->render()
    ]
])->render();

// Modal grande
$modal = BS5::modal([
    'id' => 'largeModal',
    'title' => 'Modal Grande',
    'body' => 'Contenido extenso...',
    'size' => 'lg'
])->render();

// Modal centrado
$modal = BS5::modal([
    'id' => 'centeredModal',
    'title' => 'Centrado',
    'body' => 'Este modal está centrado verticalmente',
    'centered' => true
])->render();

// Botón para activar modal
$triggerButton = BS5::button([
    'content' => 'Abrir Modal',
    'variant' => 'primary',
    'attributes' => [
        'data-bs-toggle' => 'modal',
        'data-bs-target' => '#myModal'
    ]
])->render();
```

## Componentes Relacionados

- [Button](Button.md) - Para activar modales
- [Alert](Alert.md) - Para mensajes menos intrusivos

## Documentación Oficial

[Bootstrap 5.3 Modal](https://getbootstrap.com/docs/5.3/components/modal/)

---

[← Volver al Índice](../../Bootstrap.md) | [Siguiente: Offcanvas →](Offcanvas.md)
