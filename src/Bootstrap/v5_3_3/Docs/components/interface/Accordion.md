# Accordion - Componente Acordeón

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Los acordeones permiten crear paneles colapsables donde el contenido se puede mostrar u ocultar haciendo clic en los encabezados. Son perfectos para organizar grandes cantidades de contenido en espacios reducidos.

**Clase PHP**: [`Accordion.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Interface/Accordion.php)

## Opciones de Configuración

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `id` | `string` | - | **Requerido**. ID único del acordeón |
| `items` | `array` | `[]` | Array de items del acordeón |
| `flush` | `bool` | `false` | Elimina bordes y esquinas redondeadas |
| `alwaysOpen` | `bool` | `false` | Permite que múltiples items estén abiertos simultáneamente |
| `attributes` | `array` | `[]` | Atributos HTML adicionales |

### Estructura de Items

Cada item en el array `items` puede tener:

| Propiedad | Tipo | Descripción |
|-----------|------|-------------|
| `title` | `string` | Título del panel |
| `content` | `string\|mixed` | Contenido del panel |
| `show` | `bool` | Si el panel está abierto por defecto |

## Ejemplos Básicos

### Acordeón Simple

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

$accordion = BS5::accordion([
    'id' => 'accordionExample',
    'items' => [
        [
            'title' => 'Ítem #1',
            'content' => 'Este es el contenido del primer ítem del acordeón.',
            'show' => true // Abierto por defecto
        ],
        [
            'title' => 'Ítem #2',
            'content' => 'Este es el contenido del segundo ítem del acordeón.'
        ],
        [
            'title' => 'Ítem #3',
            'content' => 'Este es el contenido del tercer ítem del acordeón.'
        ]
    ]
])->render();
```

### Acordeón Flush (Sin Bordes)

```php
// Acordeón sin bordes, ideal para layouts sin bordes
$accordion = BS5::accordion([
    'id' => 'accordionFlush',
    'flush' => true,
    'items' => [
        [
            'title' => 'Panel 1',
            'content' => 'Contenido del panel 1'
        ],
        [
            'title' => 'Panel 2',
            'content' => 'Contenido del panel 2'
        ]
    ]
])->render();
```

## Ejemplos Avanzados

### Acordeón con Múltiples Items Abiertos

```php
// Permite que varios panels estén abiertos al mismo tiempo
$accordion = BS5::accordion([
    'id' => 'accordionMultiple',
    'alwaysOpen' => true,
    'items' => [
        [
            'title' => 'Sección 1',
            'content' => 'Contenido de la sección 1',
            'show' => true
        ],
        [
            'title' => 'Sección 2',
            'content' => 'Contenido de la sección 2',
            'show' => true
        ],
        [
            'title' => 'Sección 3',
            'content' => 'Contenido de la sección 3'
        ]
    ]
])->render();
```

### Acordeón con Contenido Rico

```php
// Acordeón con HTML complejo en el contenido
$accordion = BS5::accordion([
    'id' => 'accordionRich',
    'items' => [
        [
            'title' => '<i class="bi bi-info-circle me-2"></i>Información General',
            'content' => '
                <p>Este panel contiene información importante.</p>
                <ul>
                    <li>Punto 1</li>
                    <li>Punto 2</li>
                    <li>Punto 3</li>
                </ul>
            ',
            'show' => true
        ],
        [
            'title' => '<i class="bi bi-gear me-2"></i>Configuración',
            'content' => '
                <div class="mb-3">
                    <label>Opción 1</label>
                    <input type="text" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Opción 2</label>
                    <select class="form-select">
                        <option>Opción A</option>
                        <option>Opción B</option>
                    </select>
                </div>
            '
        ]
    ]
])->render();
```

## Casos de Uso Comunes

### FAQ (Preguntas Frecuentes)

```php
$faqAccordion = BS5::accordion([
    'id' => 'faqAccordion',
    'items' => [
        [
            'title' => '¿Cómo puedo resetear mi contraseña?',
            'content' => 'Para resetear tu contraseña, haz clic en "¿Olvidaste tu contraseña?" en la página de inicio de sesión y sigue las instrucciones que recibirás por correo electrónico.',
            'show' => true
        ],
        [
            'title' => '¿Cuánto tarda el procesamiento de mi pedido?',
            'content' => 'Los pedidos generalmente se procesan en 24-48 horas hábiles. Recibirás un correo de confirmación cuando tu pedido sea enviado.'
        ],
        [
            'title' => '¿Puedo cancelar mi suscripción?',
            'content' => 'Sí, puedes cancelar tu suscripción en cualquier momento desde tu panel de control, en la sección de "Facturación".'
        ],
        [
            'title' => '¿Ofrecen soporte técnico?',
            'content' => 'Sí, ofrecemos soporte técnico 24/7 a través de chat en vivo, correo electrónico y teléfono.'
        ]
    ]
])->render();
```

### Documentación con Secciones

```php
$docsAccordion = BS5::accordion([
    'id' => 'docsAccordion',
    'alwaysOpen' => true, // Permite leer varias secciones a la vez
    'items' => [
        [
            'title' => '1. Introducción',
            'content' => '<p>Bienvenido a la documentación del sistema...</p>',
            'show' => true
        ],
        [
            'title' => '2. Instalación',
            'content' => '
                <h5>Requisitos del Sistema</h5>
                <ul>
                    <li>PHP 8.0 o superior</li>
                    <li>MySQL 5.7 o superior</li>
                    <li>Apache 2.4 o Nginx</li>
                </ul>
                <h5>Pasos de Instalación</h5>
                <ol>
                    <li>Descargar el paquete</li>
                    <li>Configurar la base de datos</li>
                    <li>Ejecutar las migraciones</li>
                </ol>
            '
        ],
        [
            'title' => '3. Configuración',
            'content' => '<p>Instrucciones de configuración...</p>'
        ]
    ]
])->render();
```

### Panel de Filtros

```php
$filtersAccordion = BS5::accordion([
    'id' => 'filtersAccordion',
    'flush' => true,
    'alwaysOpen' => true,
    'items' => [
        [
            'title' => 'Categoría',
            'content' => '
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="cat1">
                    <label class="form-check-label" for="cat1">Electrónica</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="cat2">
                    <label class="form-check-label" for="cat2">Ropa</label>
                </div>
            ',
            'show' => true
        ],
        [
            'title' => 'Precio',
            'content' => '
                <input type="range" class="form-range" min="0" max="1000" step="10">
                <div class="d-flex justify-content-between">
                    <span>$0</span>
                    <span>$1000</span>
                </div>
            ',
            'show' => true
        ],
        [
            'title' => 'Marca',
            'content' => '
                <select class="form-select">
                    <option>Todas</option>
                    <option>Marca A</option>
                    <option>Marca B</option>
                </select>
            '
        ]
    ]
])->render();
```

## Accesibilidad

El componente Accordion incluye automáticamente:
- Atributos ARIA apropiados (`aria-expanded`, `aria-controls`)
- Navegación por teclado
- Roles semánticos para lectores de pantalla

## Componentes Relacionados

- [Collapse](Collapse.md) - Para elementos colapsables individuales
- [Card](Card.md) - Para contenedores de contenido
- [Modal](Modal.md) - Para diálogos modales

## Documentación Oficial de Bootstrap

[Bootstrap 5.3 Accordion](https://getbootstrap.com/docs/5.3/components/accordion/)

---

[← Volver al Índice](../../Bootstrap.md) | [Siguiente: Badge →](Badge.md)
