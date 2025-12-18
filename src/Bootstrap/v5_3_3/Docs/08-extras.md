# Características Adicionales Bootstrap 5

## Componentes Base

### Alertas y Mensajes
```php
use Higgs\Html\Html;
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Alerta básica
$alert = BS5::alert(
    'Mensaje importante',
    'primary',          // primary, secondary, success, danger, warning, info, light, dark
    false,             // dismissible
    ['class' => 'mb-3'] // atributos adicionales
)->render();

// Alerta con botón de cierre
$alert = BS5::alert(
    'Mensaje descartable',
    'warning',
    true              // agrega automáticamente: alert-dismissible fade show
)->render();         // agrega automáticamente: role="alert"
```

### Botones y Enlaces
```php
// Botón con variante y tamaño
$button = BS5::button(
    'Guardar',
    'primary',         // primary, secondary, success, danger, warning, info, light, dark
    ['class' => 'btn-lg'] // sm, lg
)->render();

// Botón con atributos ARIA
$button = BS5::button(
    'Menú',
    'primary',
    [
        'aria-expanded' => 'false',
        'aria-controls' => 'navbarMenu'
    ]
)->render();
```

## Componentes Interactivos

### Modal
```php
// Modal con todas las opciones
$modal = BS5::modal(
    'miModal',          // id (requerido)
    [                   // atributos (opcionales)
        'class' => 'custom-modal'
    ]
)
->setTitle('Título')
->setBody('Contenido')
->setFooter([
    BS5::button('Cerrar', 'secondary', [
        'data-bs-dismiss' => 'modal',
        'aria-label' => 'Cerrar'
    ])->render()
])
->render();

// Eventos del modal
echo <<<HTML
<script>
const modal = document.getElementById('miModal')
modal.addEventListener('show.bs.modal', function (event) {
    // Se ejecuta antes de mostrar el modal
})
modal.addEventListener('shown.bs.modal', function (event) {
    // Se ejecuta cuando el modal se ha mostrado completamente
})
</script>
HTML;
```

### Tooltip y Popover
```php
// Tooltip con todas las opciones
$tooltip = BS5::tooltip(
    'Información adicional',          // contenido
    'Ayuda',                         // título
    [                                // atributos
        'class' => 'tooltip-custom',
        'tabindex' => '0'            // para accesibilidad
    ]
)->render();                         // agrega data-bs-* automáticamente

// Popover con todas las opciones
$popover = BS5::popover(
    'Contenido detallado',           // contenido
    'Título',                        // título
    [                                // atributos
        'class' => 'popover-custom',
        'tabindex' => '0'            // para accesibilidad
    ]
)->render();                        // agrega data-bs-* automáticamente
```

## Formularios

### Input y Select
```php
// Input con todas las opciones
$input = BS5::input(
    'text',             // tipo (text, email, password, etc.)
    'username',         // nombre
    [                   // atributos
        'class' => 'form-control',
        'required' => true,
        'pattern' => '[A-Za-z0-9]+',
        'placeholder' => 'Usuario'
    ]
)->render();

// Select con opciones
$select = BS5::select(
    'categoria',        // nombre
    [                   // opciones
        '1' => 'Opción 1',
        '2' => 'Opción 2'
    ],
    [                   // atributos
        'class' => 'form-select',
        'required' => true
    ]
)->render();
```

## Extensión y Personalización

### Componentes Personalizados
```php
namespace MiApp\Components;

use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap;

class CustomComponents extends Bootstrap
{
    /**
     * Crea una alerta con icono de Bootstrap Icons
     * Requiere: <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
     */
    public static function iconAlert(
        string $content,
        string $icon,
        string $type = 'primary'
    ): TagInterface {
        self::validateOption($type, [
            'primary', 'secondary', 'success',
            'danger', 'warning', 'info',
            'light', 'dark'
        ], 'type');

        $iconHtml = Html::tag('i', [
            'class' => "bi bi-{$icon} me-2",
            'aria-hidden' => 'true'
        ])->render();

        return self::alert(
            $iconHtml . $content,
            $type,
            false,
            [
                'class' => 'alert-icon d-flex align-items-center'
            ]
        );
    }
}
