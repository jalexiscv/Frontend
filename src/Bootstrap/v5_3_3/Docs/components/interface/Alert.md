# Alert - Componente de Alerta

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Las alertas proporcionan mensajes de retroalimentación contextual para acciones típicas del usuario. Disponibles para cualquier longitud de texto, así como con un botón de cierre opcional.

**Clase PHP**: [`Alert.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Interface/Alert.php)

## Opciones de Configuración

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `content` | `string` | - | **Requerido**. Contenido de la alerta |
| `type` | `string` | `'primary'` | Tipo de alerta: `primary`, `secondary`, `success`, `danger`, `warning`, `info`, `light`, `dark` |
| `dismissible` | `bool` | `false` | Si la alerta puede ser cerrada |
| `attributes` | `array` | `[]` | Atributos HTML adicionales |

## Ejemplos Básicos

### Alerta Simple

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Alerta de éxito
$alert = BS5::alert([
    'content' => '¡Operación exitosa!',
    'type' => 'success'
])->render();

// Alerta de error
$alert = BS5::alert([
    'content' => 'Ha ocurrido un error',
    'type' => 'danger'
])->render();

// Alerta informativa
$alert = BS5::alert([
    'content' => 'Esta es una información importante',
    'type' => 'info'
])->render();
```

### Todos los Tipos de Alertas

```php
// Primary
BS5::alert(['content' => 'Mensaje primary', 'type' => 'primary'])->render();

// Secondary
BS5::alert(['content' => 'Mensaje secondary', 'type' => 'secondary'])->render();

// Success
BS5::alert(['content' => '¡Éxito!', 'type' => 'success'])->render();

// Danger
BS5::alert(['content' => '¡Error!', 'type' => 'danger'])->render();

// Warning
BS5::alert(['content' => 'Advertencia', 'type' => 'warning'])->render();

// Info
BS5::alert(['content' => 'Información', 'type' => 'info'])->render();

// Light
BS5::alert(['content' => 'Mensaje claro', 'type' => 'light'])->render();

// Dark
BS5::alert(['content' => 'Mensaje oscuro', 'type' => 'dark'])->render();
```

## Ejemplos Avanzados

### Alerta Descartable

```php
// Alerta que el usuario puede cerrar
$alert = BS5::alert([
    'content' => 'Esta alerta se puede cerrar haciendo clic en la X',
    'type' => 'warning',
    'dismissible' => true
])->render();
```

### Alerta con Contenido HTML

```php
// Alerta con contenido rico
$alert = BS5::alert([
    'content' => '<strong>¡Atención!</strong> Este es un mensaje importante que requiere tu atención inmediata.',
    'type' => 'danger',
    'dismissible' => true
])->render();
```

### Alerta con Clases Personalizadas

```php
// Alerta con clases adicionales
$alert = BS5::alert([
    'content' => 'Alerta con sombra personalizada',
    'type' => 'info',
    'attributes' => [
        'class' => 'shadow-lg rounded-3'
    ]
])->render();
```

## Casos de Uso Comunes

### Mensajes de Formulario

```php
// Mensaje de éxito después de guardar
$successAlert = BS5::alert([
    'content' => '<strong>¡Guardado!</strong> Los cambios se han guardado exitosamente.',
    'type' => 'success',
    'dismissible' => true
])->render();

// Mensaje de error de validación
$errorAlert = BS5::alert([
    'content' => '<strong>Error de validación:</strong> Por favor, revisa los campos marcados en rojo.',
    'type' => 'danger'
])->render();
```

### Notificaciones del Sistema

```php
// Notificación de mantenimiento
$maintenanceAlert = BS5::alert([
    'content' => '<i class="bi bi-tools me-2"></i><strong>Mantenimiento programado:</strong> El sistema estará en mantenimiento el próximo domingo de 2:00 AM a 6:00 AM.',
    'type' => 'warning',
    'dismissible' => true
])->render();

// Alerta de información general
$infoAlert = BS5::alert([
    'content' => '<i class="bi bi-info-circle me-2"></i>Tienes 5 mensajes sin leer.',
    'type' => 'info'
])->render();
```

### Alerta con Múltiples Párrafos

```php
$detailedAlert = BS5::alert([
    'content' => '
        <h4 class="alert-heading">¡Bien hecho!</h4>
        <p>Completaste exitosamente el registro. Ahora puedes acceder a todas las funciones del sistema.</p>
        <hr>
        <p class="mb-0">Para comenzar, visita tu panel de control y configura tu perfil.</p>
    ',
    'type' => 'success',
    'dismissible' => true
])->render();
```

## Accesibilidad

Las alertas automáticamente incluyen:
- `role="alert"` para lectores de pantalla
- `aria-label="Close"` en el botón de cerrar (cuando es dismissible)

## Componentes Relacionados

- [Toast](Toast.md) - Para notificaciones no intrusivas
- [Modal](Modal.md) - Para mensajes que requieren atención inmediata
- [Badge](Badge.md) - Para etiquetas y contadores

## Documentación Oficial de Bootstrap

[Bootstrap 5.3 Alerts](https://getbootstrap.com/docs/5.3/components/alerts/)

---

[← Volver al Índice](../../Bootstrap.md) | [Siguiente: Accordion →](Accordion.md)
