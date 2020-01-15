# Ejemplos: Componente Shortcuts

Componente Shortcuts de Bootstrap 5.3.3 para generar cuadrículas responsivas de accesos directos con ícono, título y descripción.

---

## Ejemplo 1: Uso Básico

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
    ],
]);

echo $shortcuts->render();
```

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
    <div class="col mb-1">
        <a href="/settings/countries/list/b153a3e6b08e7" class="shortcut border w-100" target="_self">
            <div class="container-icon"><i class="icon fa-light fa-globe"></i></div>
            <h5>Paises</h5>
            <p>Listado</p>
        </a>
    </div>
</div>
```

---

## Ejemplo 2: Sin Subtítulo

```php
$shortcuts = new Shortcuts([
    'items' => [
        [
            'href'  => '/dashboard',
            'icon'  => 'fa-light fa-house',
            'title' => 'Inicio',
        ],
        [
            'href'  => '/users/list',
            'icon'  => 'fa-light fa-users',
            'title' => 'Usuarios',
        ],
        [
            'href'  => '/reports',
            'icon'  => 'fa-light fa-chart-bar',
            'title' => 'Reportes',
        ],
    ],
]);

echo $shortcuts->render();
```

**Características:**
- `subtitle` es opcional; si se omite, el `<p>` no se renderiza
- Ideal para menús de navegación compactos

---

## Ejemplo 3: Columnas Responsivas Personalizadas

```php
$shortcuts = new Shortcuts([
    'cols' => [
        'xxl'     => 6,
        'xl'      => 4,
        'lg'      => 3,
        'md'      => 2,
        'default' => 1,
    ],
    'items' => [
        ['href' => '/module-a', 'icon' => 'fa-light fa-cube',     'title' => 'Módulo A', 'subtitle' => 'Gestión'],
        ['href' => '/module-b', 'icon' => 'fa-light fa-database', 'title' => 'Módulo B', 'subtitle' => 'Datos'],
        ['href' => '/module-c', 'icon' => 'fa-light fa-cog',      'title' => 'Módulo C', 'subtitle' => 'Config'],
    ],
]);

echo $shortcuts->render();
```

**Características:**
- `cols.default` controla las columnas en pantallas xs/sm
- Los breakpoints siguen el orden Bootstrap: `xxl`, `xl`, `lg`, `md`, `default`

---

## Ejemplo 4: Target en Nueva Pestaña

```php
$shortcuts = new Shortcuts([
    'items' => [
        [
            'href'     => 'https://docs.example.com',
            'icon'     => 'fa-light fa-book-open',
            'title'    => 'Documentación',
            'subtitle' => 'Guías y tutoriales',
            'target'   => '_blank',
        ],
        [
            'href'     => 'https://support.example.com',
            'icon'     => 'fa-light fa-headset',
            'title'    => 'Soporte',
            'subtitle' => 'Centro de ayuda',
            'target'   => '_blank',
        ],
    ],
]);

echo $shortcuts->render();
```

**Características:**
- `target` acepta cualquier valor válido de HTML (`_self`, `_blank`, `_parent`, `_top`)
- Por defecto es `_self`

---

## Ejemplo 5: Clases Adicionales en el Enlace

```php
$shortcuts = new Shortcuts([
    'items' => [
        [
            'href'     => '/reports/sales',
            'icon'     => 'fa-light fa-chart-line',
            'title'    => 'Ventas',
            'subtitle' => 'Reporte mensual',
            'class'    => 'text-success',
        ],
        [
            'href'     => '/reports/errors',
            'icon'     => 'fa-light fa-triangle-exclamation',
            'title'    => 'Errores',
            'subtitle' => 'Log del sistema',
            'class'    => 'text-danger',
        ],
    ],
]);

echo $shortcuts->render();
```

**Características:**
- `class` se fusiona con `shortcut border w-100` usando `mergeClasses()`
- Útil para colorear o estilizar individualmente cada acceso directo

---

## Ejemplo 6: Clases Adicionales en el Ícono

```php
$shortcuts = new Shortcuts([
    'items' => [
        [
            'href'       => '/fire-alerts',
            'icon'       => 'fa-light fa-fire',
            'title'      => 'Alertas',
            'subtitle'   => 'Críticas',
            'icon_class' => 'text-danger',
        ],
        [
            'href'       => '/status',
            'icon'       => 'fa-light fa-circle-check',
            'title'      => 'Estado',
            'subtitle'   => 'Sistema OK',
            'icon_class' => 'text-success',
        ],
    ],
]);

echo $shortcuts->render();
```

**Características:**
- `icon_class` se fusiona con `container-icon`
- Permite colorear el contenedor del ícono de forma independiente al enlace

---

## Ejemplo 7: Clases Adicionales en el Contenedor

```php
$shortcuts = new Shortcuts([
    'class' => 'g-2 px-2',
    'items' => [
        ['href' => '/a', 'icon' => 'fa-light fa-star',   'title' => 'Favoritos'],
        ['href' => '/b', 'icon' => 'fa-light fa-clock',  'title' => 'Recientes'],
        ['href' => '/c', 'icon' => 'fa-light fa-thumbtack', 'title' => 'Fijados'],
    ],
]);

echo $shortcuts->render();
```

**Características:**
- `class` se agrega al `div.row` contenedor
- Útil para agregar gutters (`g-*`), márgenes o padding al grid

---

## Ejemplo 8: Atributos HTML en el Contenedor

```php
$shortcuts = new Shortcuts([
    'attributes' => [
        'id'           => 'main-shortcuts',
        'data-section' => 'navigation',
    ],
    'items' => [
        ['href' => '/home',     'icon' => 'fa-light fa-house',    'title' => 'Inicio'],
        ['href' => '/profile',  'icon' => 'fa-light fa-user',     'title' => 'Perfil'],
        ['href' => '/settings', 'icon' => 'fa-light fa-gear',     'title' => 'Config'],
        ['href' => '/logout',   'icon' => 'fa-light fa-right-from-bracket', 'title' => 'Salir'],
    ],
]);

echo $shortcuts->render();
```

**Características:**
- `attributes` acepta cualquier atributo HTML válido
- Los atributos se fusionan con la clase generada del row

---

## Ejemplo 9: Generado Dinámicamente desde Base de Datos

```php
// Resultado típico de un modelo
$modules = $moduleModel
    ->where('active', 1)
    ->where('user_id', $currentUserId)
    ->findAll();

$items = array_map(fn($mod) => [
    'href'     => $mod['url'],
    'icon'     => $mod['icon'],
    'title'    => $mod['name'],
    'subtitle' => $mod['description'],
], $modules);

if (!empty($items)) {
    $shortcuts = new Shortcuts(['items' => $items]);
    echo $shortcuts->render();
}
```

**Características:**
- Compatible con cualquier fuente de datos
- Usa `array_map` para transformar filas de BD al formato requerido
- Verificar que `$items` no esté vacío antes de instanciar

---

## Ejemplo 10: Usando la Facade Bootstrap

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap;

echo Bootstrap::shortcuts([
    'items' => [
        ['href' => '/settings/logos',    'icon' => 'fa-light fa-image',  'title' => 'Logotipos',  'subtitle' => 'Herramienta'],
        ['href' => '/settings/countries','icon' => 'fa-light fa-globe',  'title' => 'Paises',     'subtitle' => 'Listado'],
        ['href' => '/settings/cities',   'icon' => 'fa-light fa-city',   'title' => 'Ciudades',   'subtitle' => 'Listado'],
        ['href' => '/settings/regions',  'icon' => 'fa-light fa-map',    'title' => 'Regiones',   'subtitle' => 'Listado'],
    ],
]);
```

**Características:**
- Método estático conveniente de la facade
- Mismas opciones que el constructor
- Imprime directamente (sin necesidad de `->render()`)

---

## Ejemplo 11: Panel de Accesos en Vista de Módulo

```php
// En una vista PHP típica del framework
$shortcuts = new Shortcuts([
    'cols'  => ['xxl' => 5, 'xl' => 4, 'lg' => 3, 'md' => 2, 'default' => 2],
    'class' => 'mt-3',
    'items' => [
        ['href' => site_url('access/events/list'),       'icon' => 'fa-light fa-calendar-days', 'title' => lang('Access.events'),      'subtitle' => lang('Access.list')],
        ['href' => site_url('access/attendances/check'), 'icon' => 'fa-light fa-qrcode',        'title' => lang('Access.check'),       'subtitle' => lang('Access.scanner')],
        ['href' => site_url('access/attendances/list'),  'icon' => 'fa-light fa-clipboard-list','title' => lang('Access.attendances'), 'subtitle' => lang('Access.list')],
        ['href' => site_url('access/reports'),           'icon' => 'fa-light fa-chart-pie',     'title' => lang('Access.reports'),     'subtitle' => lang('Access.analytics')],
    ],
]);

echo $shortcuts->render();
```

**Características:**
- Integración con `site_url()` y `lang()` del framework
- `cols` ajustado para paneles de módulo con más ítems
- Subtítulos con cadenas de traducción

---

## Opciones Disponibles

### Opciones del Componente

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `items` | array | **requerido** | Arreglo de accesos directos |
| `cols` | array | ver abajo | Columnas por breakpoint |
| `class` | string | `''` | Clases adicionales para el `div.row` |
| `attributes` | array | `[]` | Atributos HTML adicionales para el `div.row` |

### Columnas Responsivas por Defecto

| Breakpoint | Default |
|------------|---------|
| `xxl` | 4 |
| `xl` | 4 |
| `lg` | 3 |
| `md` | 2 |
| `default` (xs/sm) | 2 |

### Opciones por Ítem

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `href` | string | **requerido** | URL del enlace |
| `icon` | string | **requerido** | Clases del ícono (ej: `fa-light fa-image`) |
| `title` | string | **requerido** | Título visible del acceso directo |
| `subtitle` | string | `''` | Descripción/subtítulo (omite `<p>` si vacío) |
| `target` | string | `'_self'` | Atributo `target` del enlace |
| `class` | string | `''` | Clases adicionales para el `<a>` |
| `icon_class` | string | `''` | Clases adicionales para el `div.container-icon` |

---

## Estructura HTML Generada

```html
<div class="row row-cols-xxl-{n} row-cols-xl-{n} row-cols-lg-{n} row-cols-md-{n} row-cols-{n} text-center shortcuts {class}">
    <div class="col mb-1">
        <a href="{href}" class="shortcut border w-100 {item.class}" target="{target}">
            <div class="container-icon {icon_class}">
                <i class="icon {icon}"></i>
            </div>
            <h5>{title}</h5>
            <p>{subtitle}</p><!-- Solo si subtitle no está vacío -->
        </a>
    </div>
    <!-- más .col por cada ítem -->
</div>
```

---

## Validación de Opciones

El componente valida automáticamente:

1. ✅ `items` es requerido y debe ser un array no vacío
2. ✅ Cada ítem debe tener `href`, `icon` y `title`

**Ejemplos de errores:**
```php
// ❌ InvalidArgumentException: "items" es requerido
new Shortcuts([]);

// ❌ InvalidArgumentException: ítem [1] requiere "icon"
new Shortcuts([
    'items' => [
        ['href' => '/a', 'icon' => 'fa-light fa-home', 'title' => 'Inicio'],
        ['href' => '/b', 'title' => 'Sin ícono'],  // falta 'icon'
    ],
]);
```

---

## Tips y Buenas Prácticas

### 1. Usar íconos descriptivos

```php
// ✅ Bueno - Ícono semánticamente correcto
['href' => '/users', 'icon' => 'fa-light fa-users', 'title' => 'Usuarios']

// ❌ Malo - Ícono genérico sin relación
['href' => '/users', 'icon' => 'fa-light fa-star', 'title' => 'Usuarios']
```

### 2. Subtítulos concisos

```php
// ✅ Bueno - Subtítulo breve y útil
['title' => 'Facturas', 'subtitle' => 'Listado mensual']

// ❌ Malo - Subtítulo demasiado largo
['title' => 'Facturas', 'subtitle' => 'Ver el listado completo de todas las facturas del mes actual']
```

### 3. Ajustar columnas según cantidad de ítems

```php
// 3 ítems → máximo 3 columnas tiene sentido
$shortcuts = new Shortcuts([
    'cols'  => ['xxl' => 3, 'xl' => 3, 'lg' => 3, 'md' => 2, 'default' => 1],
    'items' => [...], // 3 ítems
]);

// 8 ítems → más columnas en pantallas grandes
$shortcuts = new Shortcuts([
    'cols'  => ['xxl' => 4, 'xl' => 4, 'lg' => 4, 'md' => 2, 'default' => 2],
    'items' => [...], // 8 ítems
]);
```

### 4. Verificar permisos antes de agregar ítems

```php
$items = [];

if ($auth->can('events.view')) {
    $items[] = ['href' => '/access/events', 'icon' => 'fa-light fa-calendar', 'title' => 'Eventos'];
}
if ($auth->can('attendances.view')) {
    $items[] = ['href' => '/access/attendances', 'icon' => 'fa-light fa-list', 'title' => 'Asistencias'];
}

if (!empty($items)) {
    echo (new Shortcuts(['items' => $items]))->render();
}
```

---

## Referencias

- **Componente**: [`Extras/Shortcuts.php`](../Extras/Shortcuts.php)
- **Clase Base**: [`AbstractComponent.php`](../AbstractComponent.php)
- **Docs Extras**: [`Docs/08-extras.md`](../Docs/08-extras.md)
- **Bootstrap Docs**: [Bootstrap 5.3 Grid](https://getbootstrap.com/docs/5.3/layout/grid/)
