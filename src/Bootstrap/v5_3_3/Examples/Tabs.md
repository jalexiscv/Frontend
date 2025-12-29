# Ejemplos: Componente Tabs

Componente Tabs de Bootstrap 5.3.3 refactorizado según COMPONENT_STANDARDS.md.

---

## Ejemplo 1: Tabs Básicos

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Extras\Tabs;

$tabs = new Tabs([
    'tabs' => [
        [
            'id' => 'home',
            'title' => 'Inicio',
            'content' => 'Contenido de la pestaña de inicio',
            'active' => true
        ],
        [
            'id' => 'profile',
            'title' => 'Perfil',
            'content' => 'Contenido del perfil del usuario'
        ],
        [
            'id' => 'contact',
            'title' => 'Contacto',
            'content' => 'Información de contacto'
        ]
    ]
]);

echo $tabs->render();
```

**Salida:**
- Navegación con 3 pestañas horizontales
- Primera pestaña activa por defecto
- Contenido escapado por seguridad

---

## Ejemplo 2: Tabs con htmlContent

```php
$tabs = new Tabs([
    'tabs' => [
        [
            'id' => 'dashboard',
            'title' => 'Dashboard',
            'htmlContent' => '<div class="alert alert-info">
                <strong>Bienvenido!</strong> Este es tu panel principal.
            </div>',
            'active' => true
        ],
        [
            'id' => 'stats',
            'title' => 'Estadísticas',
            'htmlContent' => '<table class="table">
                <tr><td>Usuarios</td><td>1,234</td></tr>
                <tr><td>Ventas</td><td>$45,678</td></tr>
            </table>'
        ]
    ]
]);

echo $tabs->render();
```

**Características:**
- Usa `htmlContent` para contenido HTML sin escapar
- Permite incluir componentes HTML completos
- ⚠️ **Advertencia**: Solo usar con HTML confiable

---

## Ejemplo 3: Tabs Solo con Iconos

```php
$tabs = new Tabs([
    'tabs' => [
        [
            'id' => 'home',
            'icon' => 'fas fa-home',
            'content' => 'Inicio',
            'active' => true
        ],
        [
            'id' => 'settings',
            'icon' => 'fas fa-cog',
            'content' => 'Configuración'
        ],
        [
            'id' => 'user',
            'icon' => 'fas fa-user',
            'content' => 'Usuario'
        ]
    ]
]);

echo $tabs->render();
```

**Características:**
- Tabs solo con iconos (sin texto)
- Ideal para interfaces compactas
- Requiere Font Awesome u otra librería de iconos

---

## Ejemplo 4: Tabs con Iconos y Texto

```php
$tabs = new Tabs([
    'tabs' => [
        [
            'id' => 'dashboard',
            'icon' => 'fas fa-tachometer-alt',
            'title' => 'Dashboard',
            'content' => 'Panel principal',
            'active' => true
        ],
        [
            'id' => 'reports',
            'icon' => 'fas fa-chart-bar',
            'title' => 'Reportes',
            'content' => 'Ver reportes'
        ],
        [
            'id' => 'settings',
            'icon' => 'fas fa-cog',
            'title' => 'Configuración',
            'content' => 'Ajustes del sistema'
        ]
    ]
]);

echo $tabs->render();
```

**Características:**
- Combina iconos y texto
- Navegación más descriptiva
- Mejor UX

---

## Ejemplo 5: Pills (Estilo Alternativo)

```php
$tabs = new Tabs([
    'pills' => true,  // Usar estilo pills en lugar de tabs
    'tabs' => [
        [
            'id' => 'overview',
            'title' => 'Resumen',
            'content' => 'Vista general del proyecto',
            'active' => true
        ],
        [
            'id' => 'details',
            'title' => 'Detalles',
            'content' => 'Información detallada'
        ],
        [
            'id' => 'history',
            'title' => 'Historial',
            'content' => 'Registro de cambios'
        ]
    ]
]);

echo $tabs->render();
```

**Características:**
- Estilo "pills" redondeado
- Alternativa visual a tabs tradicionales
- Mismo comportamiento funcional

---

## Ejemplo 6: Tabs Verticales

```php
$tabs = new Tabs([
    'vertical' => true,  // Orientación vertical
    'tabs' => [
        [
            'id' => 'general',
            'title' => 'General',
            'content' => 'Configuración general',
            'active' => true
        ],
        [
            'id' => 'security',
            'title' => 'Seguridad',
            'content' => 'Opciones de seguridad'
        ],
        [
            'id' => 'notifications',
            'title' => 'Notificaciones',
            'content' => 'Preferencias de notificaciones'
        ]
    ]
]);

echo $tabs->render();
```

**Características:**
- Navegación vertical (sidebar)
- Ideal para menús de configuración
- Usa `flex-column`

---

## Ejemplo 7: Tabs Justified (Ancho Completo)

```php
$tabs = new Tabs([
    'justified' => true,  // Ocupar todo el ancho
    'tabs' => [
        [
            'id' => 'tab1',
            'title' => 'Opción 1',
            'content' => 'Contenido 1',
            'active' => true
        ],
        [
            'id' => 'tab2',
            'title' => 'Opción 2',
            'content' => 'Contenido 2'
        ],
        [
            'id' => 'tab3',
            'title' => 'Opción 3',
            'content' => 'Contenido 3'
        ]
    ]
]);

echo $tabs->render();
```

**Características:**
- Las pestañas ocupan todo el ancho disponible
- Distribución equitativa del espacio
- Usa `nav-justified`

---

## Ejemplo 8: Tabs con htmlTitle

```php
$tabs = new Tabs([
    'tabs' => [
        [
            'id' => 'premium',
            'htmlTitle' => '<i class="fas fa-star text-warning"></i> Premium',
            'content' => 'Funciones premium',
            'active' => true
        ],
        [
            'id' => 'basic',
            'htmlTitle' => '<span class="badge bg-primary">Free</span> Básico',
            'content' => 'Funciones básicas'
        ]
    ]
]);

echo $tabs->render();
```

**Características:**
- Usa `htmlTitle` para títulos con HTML
- Permite badges, iconos, formato personalizado
- ⚠️ **Advertencia**: Solo con HTML confiable

---

## Ejemplo 9: Tabs con Pestaña Deshabilitada

```php
$tabs = new Tabs([
    'tabs' => [
        [
            'id' => 'available',
            'title' => 'Disponible',
            'content' => 'Esta función está disponible',
            'active' => true
        ],
        [
            'id' => 'coming-soon',
            'title' => 'Próximamente',
            'content' => 'Esta función estará disponible pronto',
            'disabled' => true  // Pestaña deshabilitada
        ],
        [
            'id' => 'beta',
            'title' => 'Beta',
            'content' => 'Función en pruebas',
            'class' => 'text-warning'  // Clase CSS adicional
        ]
    ]
]);

echo $tabs->render();
```

**Características:**
- `disabled` para deshabilitar pestañas
- `class` para clases CSS adicionales
- Útil para indicar funciones no disponibles

---

## Ejemplo 10: Tabs sin Animación Fade

```php
$tabs = new Tabs([
    'fade' => false,  // Deshabilitar animación fade
    'tabs' => [
        [
            'id' => 'tab1',
            'title' => 'Tab 1',
            'content' => 'Cambio instantáneo',
            'active' => true
        ],
        [
            'id' => 'tab2',
            'title' => 'Tab 2',
            'content' => 'Sin animación'
        ]
    ]
]);

echo $tabs->render();
```

**Características:**
- Sin animación de transición
- Cambio instantáneo entre pestañas
- Mejor rendimiento en dispositivos lentos

---

## Ejemplo 11: Tabs con ID y Atributos Personalizados

```php
$tabs = new Tabs([
    'id' => 'customTabs',  // ID personalizado
    'attributes' => [
        'class' => 'my-custom-tabs',
        'data-analytics' => 'user-settings'
    ],
    'tabs' => [
        [
            'id' => 'account',
            'title' => 'Cuenta',
            'content' => 'Configuración de cuenta',
            'active' => true
        ],
        [
            'id' => 'privacy',
            'title' => 'Privacidad',
            'content' => 'Configuración de privacidad'
        ]
    ]
]);

echo $tabs->render();
```

**Características:**
- ID personalizado para JavaScript
- Atributos HTML adicionales
- Útil para analytics o estilos personalizados

---

## Opciones Disponibles

### Opciones Principales

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `tabs` | array | requerido | Array de pestañas |
| `id` | string | auto | ID base para las pestañas |
| `pills` | bool | false | Usar estilo pills |
| `vertical` | bool | false | Orientación vertical |
| `fade` | bool | true | Animación fade |
| `justified` | bool | false | Ancho completo |
| `attributes` | array | [] | Atributos HTML adicionales |

### Opciones de Cada Tab

| Opción | Tipo | Requerido | Descripción |
|--------|------|-----------|-------------|
| `id` | string | ✅ Sí | ID único de la pestaña |
| `title` | string | Si no hay htmlTitle ni icon | Título (escapado) |
| `htmlTitle` | string | Alternativa a title | Título HTML sin escapar |
| `icon` | string | Alternativa a title | Clase de ícono |
| `content` | string | No | Contenido (escapado) |
| `htmlContent` | string | Alternativa a content | HTML sin escapar |
| `active` | bool | false | Pestaña activa |
| `disabled` | bool | false | Pestaña deshabilitada |
| `class` | string | null | Clases CSS adicionales |

---

## Validación

El componente valida:

1. ✅ Al menos una pestaña requerida
2. ✅ Cada tab debe tener `id`
3. ✅ Cada tab debe tener al menos uno de: `title`, `htmlTitle` o `icon`

**Ejemplo de error:**
```php
// ❌ Esto lanzará InvalidArgumentException
$tabs = new Tabs([
    'tabs' => [
        ['id' => 'invalid']  // Sin title, htmlTitle ni icon
    ]
]);
```

---

## Notas de Seguridad

### ⚠️ htmlContent y htmlTitle

**NUNCA** usar con entrada de usuario no sanitizada:

```php
// ❌ PELIGROSO - Vulnerabilidad XSS
$tabs = new Tabs([
    'tabs' => [
        [
            'id' => 'user',
            'htmlTitle' => $_POST['title'],  // ❌ PELIGROSO
            'htmlContent' => $_GET['content']  // ❌ PELIGROSO
        ]
    ]
]);

// ✅ SEGURO - HTML confiable
$tabs = new Tabs([
    'tabs' => [
        [
            'id' => 'user',
            'htmlTitle' => '<i class="fas fa-user"></i> Usuario',  // ✅ SEGURO
            'htmlContent' => '<div class="alert">Mensaje</div>'    // ✅ SEGURO
        ]
    ]
]);
```

### ✅ content y title

Por defecto, `content` y `title` **siempre escapan** el HTML:

```php
// ✅ SEGURO - Automáticamente escapado
$tabs = new Tabs([
    'tabs' => [
        [
            'id' => 'user',
            'title' => $_POST['title'],    // ✅ Se escapa automáticamente
            'content' => $_GET['content']  // ✅ Se escapa automáticamente
        ]
    ]
]);
```

---

## Referencias

- **Componente**: [`Tabs.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Extras/Tabs.php)
- **Estándares**: [`COMPONENT_STANDARDS.md`](file:///c:/xampp/htdocs/system/Frontend/COMPONENT_STANDARDS.md)
- **Bootstrap Docs**: [Bootstrap 5.3 Tabs](https://getbootstrap.com/docs/5.3/components/navs-tabs/)
