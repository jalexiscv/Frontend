# Ejemplos: Componente Icon

Componente Icon de Bootstrap 5.3.3 para renderizar iconos Font Awesome mediante la etiqueta `<i>` con las clases correspondientes.

---

## Ejemplo 1: Icono Básico

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Extras\Icon;

$icon = new Icon([
    'icon' => 'rocket'
]);

echo $icon->render();
```

**Características:**
- Estilo por defecto: `light` (`fa-light`)
- Clase base `icon` siempre presente
- Sintaxis mínima

**HTML generado:**
```html
<i class="icon fa-light fa-rocket"></i>
```

---

## Ejemplo 2: Icono con Estilo Solid

```php
$icon = new Icon([
    'icon' => 'home',
    'style' => 'solid'
]);

echo $icon->render();
```

**Características:**
- Estilo `solid` para iconos con relleno
- Ideal para acciones principales

**HTML generado:**
```html
<i class="icon fa-solid fa-home"></i>
```

---

## Ejemplo 3: Icono con Tamaño Personalizado

```php
$icon = new Icon([
    'icon' => 'star',
    'style' => 'solid',
    'size' => '2xl'
]);

echo $icon->render();
```

**Características:**
- Tamaño `2xl` para iconos grandes
- Tamaños válidos: `xs`, `sm`, `lg`, `xl`, `2xl`, `1x`–`10x`

**HTML generado:**
```html
<i class="icon fa-solid fa-star fa-2xl"></i>
```

---

## Ejemplo 4: Icono con Ancho Fijo

```php
$icon = new Icon([
    'icon' => 'user',
    'style' => 'regular',
    'fixedWidth' => true
]);

echo $icon->render();
```

**Características:**
- `fa-fw` para ancho fijo
- Ideal para listas o menús donde los iconos deben alinearse

**HTML generado:**
```html
<i class="icon fa-regular fa-user fa-fw"></i>
```

---

## Ejemplo 5: Icono con Animación Spin

```php
$icon = new Icon([
    'icon' => 'spinner',
    'style' => 'solid',
    'spin' => true
]);

echo $icon->render();
```

**Características:**
- Rotación continua con `fa-spin`
- Ideal para indicadores de carga

**HTML generado:**
```html
<i class="icon fa-solid fa-spinner fa-spin"></i>
```

---

## Ejemplo 6: Icono con Animación Pulse

```php
$icon = new Icon([
    'icon' => 'circle-notch',
    'style' => 'solid',
    'pulse' => true
]);

echo $icon->render();
```

**Características:**
- Rotación en pasos con `fa-pulse`
- Variación visual de la animación de carga

**HTML generado:**
```html
<i class="icon fa-solid fa-circle-notch fa-pulse"></i>
```

---

## Ejemplo 7: Icono con Todas las Opciones

```php
$icon = new Icon([
    'icon' => 'gear',
    'style' => 'solid',
    'size' => 'lg',
    'fixedWidth' => true,
    'spin' => true,
    'attributes' => [
        'id' => 'settings-icon',
        'title' => 'Configuración cargando...'
    ]
]);

echo $icon->render();
```

**Características:**
- Combinación de tamaño, ancho fijo y animación
- Atributos HTML personalizados
- Ideal para estados de carga en botones de configuración

**HTML generado:**
```html
<i class="icon fa-solid fa-gear fa-lg fa-fw fa-spin" id="settings-icon" title="Configuración cargando..."></i>
```

---

## Ejemplo 8: Iconos en un Menú de Navegación

```php
$menuItems = [
    ['icon' => 'house', 'label' => 'Inicio'],
    ['icon' => 'users', 'label' => 'Usuarios'],
    ['icon' => 'chart-bar', 'label' => 'Reportes'],
    ['icon' => 'gear', 'label' => 'Configuración'],
];

echo '<ul class="nav flex-column">';
foreach ($menuItems as $item) {
    $icon = new Icon([
        'icon' => $item['icon'],
        'fixedWidth' => true
    ]);
    
    echo '<li class="nav-item">';
    echo '<a class="nav-link" href="#">';
    echo $icon->render() . ' ' . $item['label'];
    echo '</a>';
    echo '</li>';
}
echo '</ul>';
```

**Características:**
- Ancho fijo para alineación perfecta en menús
- Iconos light por defecto
- Texto acompañando al icono

---

## Ejemplo 9: Iconos de Redes Sociales (Brands)

```php
$socialNetworks = [
    ['icon' => 'facebook', 'url' => 'https://facebook.com'],
    ['icon' => 'twitter', 'url' => 'https://twitter.com'],
    ['icon' => 'instagram', 'url' => 'https://instagram.com'],
    ['icon' => 'github', 'url' => 'https://github.com'],
];

echo '<div class="d-flex gap-3">';
foreach ($socialNetworks as $social) {
    $icon = new Icon([
        'icon' => $social['icon'],
        'style' => 'brands',
        'size' => 'xl'
    ]);
    
    echo '<a href="' . $social['url'] . '" class="text-decoration-none">';
    echo $icon->render();
    echo '</a>';
}
echo '</div>';
```

**Características:**
- Estilo `brands` para logos de marcas
- Tamaño `xl` para mayor visibilidad
- Disposición horizontal con gap

---

## Ejemplo 10: Iconos con Estilos Diferentes

```php
$styles = ['light', 'regular', 'solid', 'thin', 'duotone'];

echo '<div class="d-flex gap-4 align-items-center">';
foreach ($styles as $style) {
    $icon = new Icon([
        'icon' => 'bell',
        'style' => $style,
        'size' => 'xl'
    ]);
    
    echo '<div class="text-center">';
    echo $icon->render();
    echo '<br><small class="text-muted">' . $style . '</small>';
    echo '</div>';
}
echo '</div>';
```

**Características:**
- Comparación visual de los 5 estilos de icono
- Mismo icono con diferentes pesos visuales

---

## Ejemplo 11: Icono dentro de un Botón

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Extras\Icon;

$icon = new Icon(['icon' => 'plus', 'style' => 'solid']);

echo '<button class="btn btn-primary">';
echo $icon->render() . ' Agregar';
echo '</button>';

echo '<button class="btn btn-danger">';
echo (new Icon(['icon' => 'trash', 'style' => 'solid']))->render() . ' Eliminar';
echo '</button>';

echo '<button class="btn btn-success">';
echo (new Icon(['icon' => 'check', 'style' => 'solid']))->render() . ' Guardar';
echo '</button>';
```

**Características:**
- Iconos acompañando texto en botones
- Instanciación inline para uso rápido

---

## Ejemplo 12: Iconos con Atributos Personalizados

```php
$icon = new Icon([
    'icon' => 'bell',
    'style' => 'solid',
    'size' => 'lg',
    'attributes' => [
        'class' => 'text-warning',
        'id' => 'notification-icon',
        'data-count' => '5',
        'title' => 'Notificaciones'
    ]
]);

echo $icon->render();
```

**Características:**
- Clases CSS adicionales se combinan con las del componente
- Data attributes para JavaScript
- ID y title personalizados

**HTML generado:**
```html
<i class="icon fa-solid fa-bell fa-lg text-warning" id="notification-icon" data-count="5" title="Notificaciones"></i>
```

---

## Opciones Disponibles

### Opciones Principales

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `icon` | string | **required** | Nombre del icono FA (sin prefijo) |
| `style` | string | `'light'` | Estilo Font Awesome |
| `size` | string\|null | `null` | Tamaño del icono |
| `fixedWidth` | bool | `false` | Ancho fijo (`fa-fw`) |
| `spin` | bool | `false` | Animación de giro (`fa-spin`) |
| `pulse` | bool | `false` | Animación de pulso (`fa-pulse`) |
| `attributes` | array | `[]` | Atributos HTML adicionales |

### Estilos Disponibles

| Estilo | Clase | Descripción |
|--------|-------|-------------|
| `light` | `fa-light` | Trazo fino (por defecto) |
| `regular` | `fa-regular` | Trazo normal |
| `solid` | `fa-solid` | Relleno completo |
| `thin` | `fa-thin` | Trazo ultra fino |
| `duotone` | `fa-duotone` | Dos tonos |
| `brands` | `fa-brands` | Logos de marcas |

### Tamaños Disponibles

| Tamaño | Clase | Descripción |
|--------|-------|-------------|
| `xs` | `fa-xs` | Extra pequeño |
| `sm` | `fa-sm` | Pequeño |
| `lg` | `fa-lg` | Grande |
| `xl` | `fa-xl` | Extra grande |
| `2xl` | `fa-2xl` | Doble extra grande |
| `1x`–`10x` | `fa-1x`–`fa-10x` | Tamaño multiplicado |

---

## Estructura HTML Generada

### Icono Básico
```html
<i class="icon fa-light fa-{icon}"></i>
```

### Icono Completo
```html
<i class="icon fa-{style} fa-{icon} fa-{size} fa-fw fa-spin"></i>
```

---

## Validación de Opciones

El componente valida automáticamente:

1. ✅ **icon es requerido**: Lanza `InvalidArgumentException` si falta
2. ✅ **style válido**: Solo acepta `light`, `regular`, `solid`, `thin`, `duotone`, `brands`
3. ✅ **size válido**: Si se especifica, debe ser uno de los tamaños válidos

**Ejemplo de error:**
```php
// ❌ Esto lanzará InvalidArgumentException
$icon = new Icon([]);
// Falta 'icon' requerido

// ❌ Esto lanzará InvalidArgumentException
$icon = new Icon([
    'icon' => 'rocket',
    'style' => 'heavy' // Estilo inválido
]);
```

---

## Tips y Buenas Prácticas

### 1. Usar Ancho Fijo en Listas

```php
// ✅ Bueno - Iconos alineados
$icon = new Icon(['icon' => 'check', 'fixedWidth' => true]);

// ❌ Malo - Iconos desalineados en listas
$icon = new Icon(['icon' => 'check']);
```

### 2. Estilo Apropiado para el Contexto

```php
// ✅ Bueno - Brands para logos
$icon = new Icon(['icon' => 'github', 'style' => 'brands']);

// ❌ Malo - Light para logos de marcas
$icon = new Icon(['icon' => 'github', 'style' => 'light']);
```

### 3. Accesibilidad

```php
// ✅ Bueno - Con title para accesibilidad
$icon = new Icon([
    'icon' => 'trash',
    'style' => 'solid',
    'attributes' => ['title' => 'Eliminar']
]);

// ✅ Bueno - Decorativo con aria-hidden
$icon = new Icon([
    'icon' => 'star',
    'attributes' => ['aria-hidden' => 'true']
]);
```

---

## Referencias

- **Componente**: [`Icon.php`](file:///www/wwwroot/_development/system/Frontend/src/Bootstrap/v5_3_3/Extras/Icon.php)
- **Font Awesome Docs**: [Font Awesome Icons](https://fontawesome.com/icons)
- **Bootstrap Docs**: [Bootstrap 5.3](https://getbootstrap.com/docs/5.3/)
