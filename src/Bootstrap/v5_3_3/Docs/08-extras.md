# Características Adicionales y Migración v2.0.0

> **Nota de Migración v2.0.0**: Todos los componentes ahora aceptan un único `array $options` en su constructor. Los ejemplos en esta documentación reflejan la nueva arquitectura.

---

## Migración desde v1.x a v2.0.0

### Breaking Changes

La versión 2.0.0 introduce cambios INCOMPATIBLES con versiones anteriores. Todos los componentes ahora utilizan un único array de opciones.

#### Antes (v1.x)
```php
// Sintaxis antigua con parámetros posicionales
$alert = BS5::alert('Mensaje importante', 'primary', false, ['class' => 'mb-3'])->render();
$button = BS5::button('Guardar', 'primary', ['class' => 'btn-lg'])->render();
```

#### Después (v2.0.0)
```php
// Nueva sintaxis con array de opciones
$alert = BS5::alert([
    'content' => 'Mensaje importante',
    'type' => 'primary',
    'dismissible' => false,
    'attributes' => ['class' => 'mb-3']
])->render();

$button = BS5::button([
    'content' => 'Guardar',
    'variant' => 'primary',
    'attributes' => ['class' => 'btn-lg']
])->render();
```

### Guía de Migración Rápida

| Componente | v1.x | v2.0.0 |
|------------|------|--------|
| **Alert** | `alert($content, $type, $dismissible, $attrs)` | `alert(['content' => ..., 'type' => ..., 'dismissible' => ..., 'attributes' => ...])` |
| **Button** | `button($content, $variant, $attrs)` | `button(['content' => ..., 'variant' => ..., 'attributes' => ...])` |
| **Card** | `card($title, $content, $footer, $attrs)` | `card(['title' => ..., 'content' => ..., 'footer' => ..., 'attributes' => ...])` |
| **Modal** | `modal($id, $attrs)->setTitle()->setBody()` | `modal(['id' => ..., 'title' => ..., 'body' => ..., 'attributes' => ...])` |

---

## Componentes Base

### Alertas y Mensajes

```php
use Higgs\Html\Html;
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Alerta básica v2.0.0
$alert = BS5::alert([
    'content' => 'Mensaje importante',
    'type' => 'primary',  // primary, secondary, success, danger, warning, info, light, dark
    'attributes' => ['class' => 'mb-3']
])->render();

// Alerta con botón de cierre
$alert = BS5::alert([
    'content' => 'Mensaje descartable',
    'type' => 'warning',
    'dismissible' => true  // Agrega automáticamente clases y botón de cierre
])->render();

// Alerta con todas las opciones
$alert = BS5::alert([
    'content' => 'Operación completada exitosamente',
    'type' => 'success',
    'dismissible' => true,
    'attributes' => [
        'class' => 'shadow-sm',
        'role' => 'alert'
    ]
])->render();
```

### Botones y Enlaces

```php
// Botón con variante y tamaño
$button = BS5::button([
    'content' => 'Guardar',
    'variant' => 'primary',
    'size' => 'lg',  // 'sm', 'lg'
    'type' => 'submit'
])->render();

// Botón con atributos ARIA
$button = BS5::button([
    'content' => 'Menú',
    'variant' => 'primary',
    'attributes' => [
        'aria-expanded' => 'false',
        'aria-controls' => 'navbarMenu',
        'data-bs-toggle' => 'collapse',
        'data-bs-target' => '#navbarMenu'
    ]
])->render();

// Botón deshabilitado
$button = BS5::button([
    'content' => 'No disponible',
    'variant' => 'secondary',
    'disabled' => true
])->render();

// Botón outline
$button = BS5::button([
    'content' => 'Outline',
    'variant' => 'outline-primary'
])->render();
```

---

## Componentes Interactivos

### Modal

```php
// Modal completo v2.0.0
$modal = BS5::modal([
    'id' => 'miModal',
    'title' => 'Título del Modal',
    'body' => 'Contenido del modal aquí',
    'footer' => [
        BS5::button([
            'content' => 'Cerrar',
            'variant' => 'secondary',
            'attributes' => [
                'data-bs-dismiss' => 'modal',
                'aria-label' => 'Cerrar'
            ]
        ])->render(),
        BS5::button([
            'content' => 'Guardar cambios',
            'variant' => 'primary'
        ])->render()
    ],
    'size' => 'lg',  // 'sm', 'lg', 'xl'
    'centered' => true,
    'scrollable' => true
])->render();

// Botón que activa el modal
$triggerButton = BS5::button([
    'content' => 'Abrir Modal',
    'variant' => 'primary',
    'attributes' => [
        'data-bs-toggle' => 'modal',
        'data-bs-target' => '#miModal'
    ]
])->render();

// Eventos del modal (JavaScript)
echo <<<HTML
<script>
const modal = document.getElementById('miModal');
modal.addEventListener('show.bs.modal', function (event) {
    // Se ejecuta antes de mostrar el modal
    console.log('Modal showing...');
});
modal.addEventListener('shown.bs.modal', function (event) {
    // Se ejecuta cuando el modal se ha mostrado completamente
    console.log('Modal shown');
});
modal.addEventListener('hide.bs.modal', function (event) {
    // Se ejecuta antes de ocultar el modal
    console.log('Modal hiding...');
});
modal.addEventListener('hidden.bs.modal', function (event) {
    // Se ejecuta cuando el modal se ha ocultado completamente
    console.log('Modal hidden');
});
</script>
HTML;
```

### Offcanvas

```php
// Offcanvas v2.0.0
$offcanvas = BS5::offcanvas([
    'id' => 'miOffcanvas',
    'title' => 'Título Offcanvas',
    'body' => 'Contenido del panel lateral',
    'placement' => 'start',  // 'start', 'end', 'top', 'bottom'
    'backdrop' => true,
    'scroll' => false
])->render();

// Botón que activa el offcanvas
$triggerButton = BS5::button([
    'content' => 'Abrir Panel',
    'variant' => 'primary',
    'attributes' => [
        'data-bs-toggle' => 'offcanvas',
        'data-bs-target' => '#miOffcanvas'
    ]
])->render();
```

### Tooltip y Popover

```php
// Tooltip v2.0.0
$tooltip = BS5::tooltip([
    'content' => 'Información adicional en tooltip',
    'placement' => 'top',  // 'top', 'right', 'bottom', 'left'
    'attributes' => [
        'label' => 'Ayuda',
        'tabindex' => '0'
    ]
])->render();

// Popover v2.0.0
$popover = BS5::popover([
    'title' => 'Título del Popover',
    'content' => 'Contenido detallado del popover con más información',
    'placement' => 'right',
    'dismissible' => true,
    'attributes' => [
        'label' => 'Más Info',
        'tabindex' => '0'
    ]
])->render();

// Inicialización de Tooltips y Popovers (JavaScript requerido)
echo <<<HTML
<script>
// Inicializar todos los tooltips
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

// Inicializar todos los popovers
const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));
</script>
HTML;
```

---

## Formularios

### Input y Select

```php
// Input v2.0.0
$input = BS5::input([
    'type' => 'text',
    'name' => 'username',
    'label' => 'Nombre de Usuario',
    'placeholder' => 'Ingrese su usuario',
    'attributes' => [
        'required' => 'required',
        'pattern' => '[A-Za-z0-9]+',
        'autocomplete' => 'username'
    ]
])->render();

// Input con validación
$inputWithValidation = BS5::input([
    'type' => 'email',
    'name' => 'email',
    'label' => 'Correo Electrónico',
    'attributes' => [
        'required' => 'required',
        'class' => 'is-valid'  // o 'is-invalid'
    ]
])->render();

// Select v2.0.0
$select = BS5::select([
    'name' => 'categoria',
    'label' => 'Categoría',
    'options' => [
        '1' => 'Opción 1',
        '2' => 'Opción 2',
        '3' => 'Opción 3'
    ],
    'attributes' => [
        'required' => 'required'
    ]
])->render();

// Select múltiple
$multiSelect = BS5::select([
    'name' => 'categorias[]',
    'label' => 'Categorías',
    'multiple' => true,
    'options' => [
        '1' => 'Categoría 1',
        '2' => 'Categoría 2',
        '3' => 'Categoría 3'
    ],
```

---

## Componentes Extras

### Shortcuts (Cuadrícula de Accesos Directos)

El componente `Shortcuts` genera una cuadrícula responsiva de enlaces con ícono, título y descripción opcional. Ideal para paneles de módulos, menús de inicio y dashboards de navegación.

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Extras\Shortcuts;

$shortcuts = new Shortcuts([
    'items' => [
        [
            'href'     => '/settings/logos/view/253acc7991b32',
            'icon'     => 'fa-light fa-image',
            'title'    => 'Logotipos',
            'subtitle' => 'Herramienta',
        ],
        [
            'href'     => '/settings/countries/list/b153a3e6b08e7',
            'icon'     => 'fa-light fa-globe',
            'title'    => 'Paises',
            'subtitle' => 'Listado',
        ],
        [
            'href'     => '/settings/cities',
            'icon'     => 'fa-light fa-city',
            'title'    => 'Ciudades',
            'subtitle' => 'Listado',
            'target'   => '_self',
        ],
    ],
]);

echo $shortcuts->render();
```

**Opciones del componente:**

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `items` | array | **requerido** | Arreglo de accesos directos |
| `cols` | array | `[xxl=4, xl=4, lg=3, md=2, default=2]` | Columnas por breakpoint responsivo |
| `class` | string | `''` | Clases adicionales para el `div.row` |
| `attributes` | array | `[]` | Atributos HTML adicionales para el contenedor |

**Opciones por ítem:**

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `href` | string | **requerido** | URL del enlace |
| `icon` | string | **requerido** | Clases del ícono (ej: `fa-light fa-image`) |
| `title` | string | **requerido** | Título visible |
| `subtitle` | string | `''` | Descripción (omite `<p>` si vacío) |
| `target` | string | `'_self'` | Atributo `target` del `<a>` |
| `class` | string | `''` | Clases adicionales para el `<a>` |
| `icon_class` | string | `''` | Clases adicionales para el `div.container-icon` |

**HTML generado:**
```html
<div class="row row-cols-xxl-4 row-cols-xl-4 row-cols-lg-3 row-cols-md-2 row-cols-2 text-center shortcuts">
    <div class="col mb-1">
        <a href="/settings/logos/view/253acc7991b32" class="shortcut border w-100" target="_self">
            <div class="container-icon"><i class="icon fa-light fa-image"></i></div>
            <h5>Logotipos</h5>
            <p>Herramienta</p>
        </a>
    </div>
    <!-- ... -->
</div>
```

**Columnas responsivas personalizadas:**
```php
$shortcuts = new Shortcuts([
    'cols' => ['xxl' => 6, 'xl' => 4, 'lg' => 3, 'md' => 2, 'default' => 1],
    'items' => [...],
]);
```

**Generación dinámica desde BD:**
```php
$items = array_map(fn($mod) => [
    'href'     => $mod['url'],
    'icon'     => $mod['icon'],
    'title'    => $mod['name'],
    'subtitle' => $mod['description'],
], $moduleModel->findAll());

if (!empty($items)) {
    echo (new Shortcuts(['items' => $items]))->render();
}
```

> **Ver todos los ejemplos**: [Examples/Shortcuts.md](../Examples/Shortcuts.md)

---

### Icon (Iconos Font Awesome)

El componente `Icon` genera un elemento `<i>` con las clases necesarias para renderizar iconos de Font Awesome. Soporta todos los estilos (light, solid, regular, thin, duotone, brands), tamaños y animaciones.

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Extras\Icon;

// Icono básico (estilo light por defecto)
$icon = new Icon(['icon' => 'rocket']);
echo $icon->render();
// <i class="icon fa-light fa-rocket"></i>

// Icono con estilo y tamaño
$icon = new Icon([
    'icon' => 'home',
    'style' => 'solid',
    'size' => '2xl'
]);
echo $icon->render();
// <i class="icon fa-solid fa-home fa-2xl"></i>

// Icono con animación (ideal para loading)
$icon = new Icon([
    'icon' => 'spinner',
    'style' => 'solid',
    'spin' => true
]);
echo $icon->render();
// <i class="icon fa-solid fa-spinner fa-spin"></i>
```

**Opciones del componente:**

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `icon` | string | **requerido** | Nombre del icono FA sin prefijo (ej: `rocket`, `home`) |
| `style` | string | `'light'` | Estilo: `light`, `regular`, `solid`, `thin`, `duotone`, `brands` |
| `size` | string\|null | `null` | Tamaño: `xs`, `sm`, `lg`, `xl`, `2xl`, `1x`–`10x` |
| `fixedWidth` | bool | `false` | Ancho fijo (`fa-fw`) para alineación en listas |
| `spin` | bool | `false` | Animación de giro continuo (`fa-spin`) |
| `pulse` | bool | `false` | Animación de giro en pasos (`fa-pulse`) |
| `attributes` | array | `[]` | Atributos HTML adicionales |

**Uso en menús con ancho fijo:**
```php
$menuItems = [
    ['icon' => 'house', 'label' => 'Inicio'],
    ['icon' => 'users', 'label' => 'Usuarios'],
    ['icon' => 'gear', 'label' => 'Configuración'],
];

foreach ($menuItems as $item) {
    $icon = new Icon(['icon' => $item['icon'], 'fixedWidth' => true]);
    echo '<a class="nav-link" href="#">' . $icon->render() . ' ' . $item['label'] . '</a>';
}
```

**Uso en botones:**
```php
echo '<button class="btn btn-primary">';
echo (new Icon(['icon' => 'plus', 'style' => 'solid']))->render() . ' Agregar';
echo '</button>';
```

> **Ver todos los ejemplos**: [Examples/Icon.md](../Examples/Icon.md)

---

### DataTable (Tabla Dinámica Local)

El componente `DataTable` genera una tabla avanzada con un motor de Javascript puro inyectado, que soporta ordenamiento, búsqueda y paginación 100% en cliente sin pesadas dependencias externas.

```php
$dtable = BS5::dtable([
    'columns' => [
        'id' => '#',
        'name' => 'Empleado',
        'role' => 'Posición'
    ],
    'data' => [
        ['id' => 1, 'name' => 'John Doe', 'role' => 'Developer'],
        ['id' => 2, 'name' => 'Jane Smith', 'role' => 'Designer']
    ],
    'searchable' => true,
    'pagination' => true,
    'perPage' => 10
])->render();
```

> **Ver más ejemplos**: [Ejemplos Completos de DataTable](../Examples/DataTable.md)

---

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
    public static function iconAlert(array $options = []): TagInterface
    {
        $icon = $options['icon'] ?? 'info-circle';
        $content = $options['content'] ?? '';
        $type = $options['type'] ?? 'primary';
        
        $iconHtml = Html::tag('i', [
            'class' => "bi bi-{$icon} me-2",
            'aria-hidden' => 'true'
        ])->render();
        
        return self::alert([
            'content' => $iconHtml . $content,
            'type' => $type,
            'dismissible' => $options['dismissible'] ?? false,
            'attributes' => array_merge(
                ['class' => 'd-flex align-items-center'],
                $options['attributes'] ?? []
            )
        ]);
    }
    
    /**
     * Crea una card con estadística
     */
    public static function statCard(array $options = []): TagInterface
    {
        $icon = $options['icon'] ?? 'graph-up';
        $value = $options['value'] ?? '0';
        $label = $options['label'] ?? 'Estadística';
        $variant = $options['variant'] ?? 'primary';
        
        return self::card([
            'content' => [
                Html::tag('div', ['class' => 'd-flex justify-content-between align-items-center'], [
                    Html::tag('div', [], [
                        Html::tag('h2', ['class' => 'mb-0'], $value),
                        Html::tag('p', ['class' => 'text-muted mb-0'], $label)
                    ]),
                    Html::tag('i', [
                        'class' => "bi bi-{$icon} fs-1 text-{$variant}",
                        'aria-hidden' => 'true'
                    ])
                ])
            ],
            'attributes' => ['class' => 'shadow-sm']
        ]);
    }
}

// Uso
$alertWithIcon = CustomComponents::iconAlert([
    'icon' => 'check-circle',
    'content' => 'Operación exitosa',
    'type' => 'success',
    'dismissible' => true
])->render();

$statCard = CustomComponents::statCard([
    'icon' => 'people',
    'value' => '1,234',
    'label' => 'Usuarios Activos',
    'variant' => 'primary'
])->render();
```

---

## Best Practices

### Accesibilidad

```php
// Siempre incluir atributos ARIA apropiados
$button = BS5::button([
    'content' => 'Menú',
    'attributes' => [
        'aria-label' => 'Abrir menú de navegación',
        'aria-expanded' => 'false',
        'aria-controls' => 'navMenu'
    ]
])->render();

// Labels para inputs
$input = BS5::input([
    'type' => 'text',
    'name' => 'search',
    'label' => 'Buscar',  // Genera <label> visible
    'attributes' => [
        'aria-describedby' => 'searchHelp'
    ]
])->render();
```

### Validación de Formularios

```php
// Formulario con validación Bootstrap
$form = BS5::form([
    'action' => '/submit',
    'method' => 'POST',
    'attributes' => ['class' => 'needs-validation', 'novalidate' => 'novalidate'],
    'content' => [
        BS5::input([
            'type' => 'text',
            'name' => 'username',
            'label' => 'Usuario',
            'attributes' => [
                'required' => 'required',
                'minlength' => '3'
            ]
        ])->render(),
        
        BS5::button([
            'content' => 'Enviar',
            'type' => 'submit',
            'variant' => 'primary'
        ])->render()
    ]
])->render();

// JavaScript para validación
echo <<<HTML
<script>
(function() {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
})();
</script>
HTML;
```

---

## Recursos Adicionales

- [Documentación oficial de Bootstrap 5.3](https://getbootstrap.com/docs/5.3/)
- [Bootstrap Icons](https://icons.getbootstrap.com/)
- [COMPONENT_STANDARDS.md](../../COMPONENT_STANDARDS.md) - Estándares arquitectónicos del framework
- [CHANGELOG.md](../../CHANGELOG.md) - Historial de cambios

---

**Versión**: 2.0.0  
**Última actualización**: 2025-12-18
