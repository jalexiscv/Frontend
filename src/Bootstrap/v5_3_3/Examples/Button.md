# Ejemplos: Componente Button

Componente Button de Bootstrap 5.3.3 para crear botones y enlaces con apariencia de botón.

---

## Ejemplo 1: Botón Básico

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Interface\Button;

$button = new Button([
    'content' => 'Click aquí'
]);

echo $button->render();
```

**Características:**
- Variante por defecto: `primary`
- Tipo por defecto: `button`
- Contenido escapado automáticamente

---

## Ejemplo 2: Variantes de Botones

```php
// Primary (azul)
$primary = new Button([
    'content' => 'Primary',
    'variant' => 'primary'
]);

// Secondary (gris)
$secondary = new Button([
    'content' => 'Secondary',
    'variant' => 'secondary'
]);

// Success (verde)
$success = new Button([
    'content' => 'Success',
    'variant' => 'success'
]);

// Danger (rojo)
$danger = new Button([
    'content' => 'Danger',
    'variant' => 'danger'
]);

// Warning (amarillo)
$warning = new Button([
    'content' => 'Warning',
    'variant' => 'warning'
]);

// Info (celeste)
$info = new Button([
    'content' => 'Info',
    'variant' => 'info'
]);

// Light (blanco)
$light = new Button([
    'content' => 'Light',
    'variant' => 'light'
]);

// Dark (negro)
$dark = new Button([
    'content' => 'Dark',
    'variant' => 'dark'
]);

echo $primary->render();
echo $secondary->render();
echo $success->render();
echo $danger->render();
echo $warning->render();
echo $info->render();
echo $light->render();
echo $dark->render();
```

**Variantes disponibles:**
- `primary` - Azul (por defecto)
- `secondary` - Gris
- `success` - Verde ✅
- `danger` - Rojo ❌
- `warning` - Amarillo ⚠️
- `info` - Celeste ℹ️
- `light` - Blanco
- `dark` - Negro

---

## Ejemplo 3: Botones Outline (Contorno)

```php
$outlinePrimary = new Button([
    'content' => 'Outline Primary',
    'variant' => 'primary',
    'outline' => true
]);

$outlineSuccess = new Button([
    'content' => 'Outline Success',
    'variant' => 'success',
    'outline' => true
]);

$outlineDanger = new Button([
    'content' => 'Outline Danger',
    'variant' => 'danger',
    'outline' => true
]);

echo $outlinePrimary->render();
echo $outlineSuccess->render();
echo $outlineDanger->render();
```

**Características:**
- Solo borde coloreado, fondo transparente
- Relleno de color al hacer hover
- Perfecto para acciones secundarias

---

## Ejemplo 4: Tamaños de Botones

```php
// Pequeño
$small = new Button([
    'content' => 'Pequeño',
    'variant' => 'primary',
    'size' => 'sm'
]);

// Normal (sin especificar size)
$normal = new Button([
    'content' => 'Normal',
    'variant' => 'primary'
]);

// Grande
$large = new Button([
    'content' => 'Grande',
    'variant' => 'primary',
    'size' => 'lg'
]);

echo $small->render();
echo $normal->render();
echo $large->render();
```

**Tamaños disponibles:**
- `sm` - Pequeño
- (ninguno) - Normal
- `lg` - Grande

---

## Ejemplo 5: Botones de Bloque (Ancho Completo)

```php
$blockButton = new Button([
    'content' => 'Botón de Bloque',
    'variant' => 'primary',
    'block' => true
]);

echo $blockButton->render();
```

**Características:**
- Ocupa todo el ancho disponible
- Usa clases `d-block w-100`
- Perfecto para móviles

---

## Ejemplo 6: Estados del Botón

```php
// Activo
$active = new Button([
    'content' => 'Activo',
    'variant' => 'primary',
    'active' => true
]);

// Deshabilitado
$disabled = new Button([
    'content' => 'Deshabilitado',
    'variant' => 'primary',
    'disabled' => true
]);

echo $active->render();
echo $disabled->render();
```

**Características:**
- `active`: Agrega clase `active` y `aria-pressed="true"`
- `disabled`: Agrega atributo `disabled`

---

## Ejemplo 7: Botones con Iconos

```php
// Icono a la izquierda (por defecto)
$iconLeft = new Button([
    'content' => 'Descargar',
    'variant' => 'success',
    'icon' => 'fas fa-download',
    'iconPosition' => 'start'
]);

// Icono a la derecha
$iconRight = new Button([
    'content' => 'Siguiente',
    'variant' => 'primary',
    'icon' => 'fas fa-arrow-right',
    'iconPosition' => 'end'
]);

// Solo icono
$iconOnly = new Button([
    'content' => '',
    'variant' => 'danger',
    'icon' => 'fas fa-trash'
]);

echo $iconLeft->render();
echo $iconRight->render();
echo $iconOnly->render();
```

**Características:**
- Compatible con Font Awesome, Bootstrap Icons, etc.
- Posiciones: `start` (izquierda) o `end` (derecha)
- Espaciado automático entre icono y texto

---

## Ejemplo 8: Botones de Carga (Loading)

```php
$loadingButton = new Button([
    'content' => 'Guardar',
    'variant' => 'primary',
    'loading' => true,
    'loadingText' => 'Guardando...'
]);

echo $loadingButton->render();
```

**Características:**
- Muestra spinner animado de Bootstrap
- Texto personalizable durante la carga
- Se deshabilita automáticamente
- Útil para operaciones asíncronas

---

## Ejemplo 9: Tipos de Botón

```php
// Submit (para formularios)
$submit = new Button([
    'content' => 'Enviar Formulario',
    'variant' => 'primary',
    'type' => 'submit'
]);

// Reset (limpiar formulario)
$reset = new Button([
    'content' => 'Limpiar',
    'variant' => 'secondary',
    'type' => 'reset'
]);

// Button (por defecto)
$button = new Button([
    'content' => 'Acción',
    'variant' => 'info',
    'type' => 'button'
]);

echo $submit->render();
echo $reset->render();
echo $button->render();
```

**Tipos disponibles:**
- `button` - Por defecto, solo ejecuta JavaScript
- `submit` - Envía el formulario
- `reset` - Limpia el formulario

---

## Ejemplo 10: 🔗 Enlace con Apariencia de Botón

```php
// Enlace básico
$linkButton = new Button([
    'content' => 'Ir a Google',
    'variant' => 'primary',
    'attributes' => [
        'href' => 'https://google.com'
    ]
]);

// Enlace con target="_blank"
$externalLink = new Button([
    'content' => 'Abrir en Nueva Pestaña',
    'variant' => 'success',
    'attributes' => [
        'href' => 'https://example.com',
        'target' => '_blank'
    ]
]);

// Enlace interno
$internalLink = new Button([
    'content' => 'Ir al Dashboard',
    'variant' => 'info',
    'attributes' => [
        'href' => '/dashboard'
    ]
]);

echo $linkButton->render();
echo $externalLink->render();
echo $internalLink->render();
```

**Características:**
- ✅ Renderiza como `<a>` en lugar de `<button>`
- ✅ Detección automática: si tiene `href`, es un enlace
- ✅ Agrega `role="button"` automáticamente (accesibilidad)
- ✅ Soporta todas las variantes y estilos
- ✅ Funciona con clic derecho, abrir en nueva pestaña, etc.

---

## Ejemplo 11: 🔗 Enlace Deshabilitado

```php
$disabledLink = new Button([
    'content' => 'No Disponible',
    'variant' => 'secondary',
    'disabled' => true,
    'attributes' => [
        'href' => '/unavailable'
    ]
]);

echo $disabledLink->render();
```

**Características:**
- No agrega `disabled` (no válido en `<a>`)
- Agrega `aria-disabled="true"` y `tabindex="-1"`
- Cumple con estándares de accesibilidad

---

## Ejemplo 12: 🔗 Enlace con Icono

```php
$downloadLink = new Button([
    'content' => 'Descargar PDF',
    'variant' => 'danger',
    'icon' => 'fas fa-file-pdf',
    'iconPosition' => 'start',
    'attributes' => [
        'href' => '/files/documento.pdf',
        'download' => 'documento.pdf'
    ]
]);

$backLink = new Button([
    'content' => 'Volver',
    'variant' => 'secondary',
    'outline' => true,
    'icon' => 'fas fa-arrow-left',
    'iconPosition' => 'start',
    'attributes' => [
        'href' => '/back'
    ]
]);

echo $downloadLink->render();
echo $backLink->render();
```

**Características:**
- Combina iconos con enlaces
- Atributo `download` para descargas
- Perfecto para navegación y descarga de archivos

---

## Ejemplo 13: Botones con Atributos Personalizados

```php
$customButton = new Button([
    'content' => 'Botón Modal',
    'variant' => 'primary',
    'attributes' => [
        'data-bs-toggle' => 'modal',
        'data-bs-target' => '#myModal',
        'id' => 'openModalBtn',
        'class' => 'shadow-lg'
    ]
]);

echo $customButton->render();
```

**Características:**
- Atributos `data-*` para Bootstrap JavaScript
- ID personalizado
- Clases adicionales (se combinan con las de Bootstrap)

---

## Ejemplo 14: Grupo de Botones

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Interface\Button;

echo '<div class="btn-group" role="group">';

$left = new Button([
    'content' => 'Izquierda',
    'variant' => 'primary'
]);

$middle = new Button([
    'content' => 'Centro',
    'variant' => 'primary'
]);

$right = new Button([
    'content' => 'Derecha',
    'variant' => 'primary'
]);

echo $left->render();
echo $middle->render();
echo $right->render();

echo '</div>';
```

**Características:**
- Usa `<div class="btn-group">` como contenedor
- Botones unidos visualmente
- Perfecto para controles relacionados

---

## Ejemplo 15: Botón con htmlContent

```php
$htmlButton = new Button([
    'htmlContent' => '<span class="badge bg-light text-dark me-2">3</span> Notificaciones',
    'variant' => 'primary'
]);

echo $htmlButton->render();
```

**Características:**
- Permite HTML personalizado
- ⚠️ **Advertencia**: Solo con HTML confiable
- Útil para badges, iconos SVG, etc.

---

## Ejemplo 16: Botones con Métodos Fluent

```php
$button = new Button(['content' => 'Mi Botón']);

// Configurar con métodos
$button->setVariant('success')
       ->outline(true)
       ->size('lg')
       ->active(true)
       ->icon('fas fa-check', 'start');

echo $button->render();
```

**Métodos disponibles:**
- `setVariant(string $variant)` - Cambia la variante
- `outline(bool $outline = true)` - Activa/desactiva outline
- `size(string $size)` - Cambia el tamaño
- `block(bool $block = true)` - Activa/desactiva block
- `active(bool $active = true)` - Activa/desactiva estado activo
- `disabled(bool $disabled = true)` - Activa/desactiva deshabilitado
- `loading(bool $loading = true, ?string $text = null)` - Activa estado de carga
- `icon(string $icon, string $position = 'start')` - Agrega icono

---

## Ejemplo 17: Botones en Formulario

```php
echo '<form action="/submit" method="POST">';

$submit = new Button([
    'content' => 'Guardar Cambios',
    'variant' => 'primary',
    'type' => 'submit',
    'icon' => 'fas fa-save'
]);

$reset = new Button([
    'content' => 'Limpiar',
    'variant' => 'secondary',
    'type' => 'reset',
    'outline' => true
]);

$cancel = new Button([
    'content' => 'Cancelar',
    'variant' => 'danger',
    'outline' => true,
    'attributes' => [
        'href' => '/cancel'
    ]
]);

echo $submit->render() . ' ';
echo $reset->render() . ' ';
echo $cancel->render();

echo '</form>';
```

**Características:**
- Submit para enviar
- Reset para limpiar
- Cancelar como enlace (no envía el formulario)

---

## Ejemplo 18: Botón de Confirmación con JavaScript

```php
$deleteButton = new Button([
    'content' => 'Eliminar',
    'variant' => 'danger',
    'icon' => 'fas fa-trash',
    'attributes' => [
        'onclick' => 'return confirm("¿Estás seguro de eliminar este elemento?")',
        'data-id' => '123'
    ]
]);

echo $deleteButton->render();
```

**Características:**
- Evento `onclick` personalizado
- Confirmación nativa del navegador
- Data attributes para JavaScript

---

## Ejemplo 19: Botones de Redes Sociales

```php
$facebook = new Button([
    'content' => ' Facebook',
    'variant' => 'primary',
    'icon' => 'fab fa-facebook-f',
    'attributes' => [
        'href' => 'https://facebook.com/share',
        'class' => 'd-flex align-items-center'
    ]
]);

$twitter = new Button([
    'content' => ' Twitter',
    'variant' => 'info',
    'icon' => 'fab fa-twitter',
    'attributes' => [
        'href' => 'https://twitter.com/intent/tweet',
        'class' => 'd-flex align-items-center'
    ]
]);

$linkedin = new Button([
    'content' => ' LinkedIn',
    'variant' => 'primary',
    'attributes' => [
        'href' => 'https://linkedin.com/share',
        'class' => 'd-flex align-items-center',
        'style' => 'background-color: #0077b5; border-color: #0077b5;'
    ]
]);

echo $facebook->render();
echo $twitter->render();
echo $linkedin->render();
```

**Características:**
- Enlaces a redes sociales
- Iconos de Font Awesome
- Colores personalizados con inline styles

---

## Ejemplo 20: Botones Responsivos

```php
// Botón normal en escritorio, block en móvil
$responsiveButton = new Button([
    'content' => 'Continuar',
    'variant' => 'success',
    'attributes' => [
        'class' => 'd-block d-md-inline-block w-100 w-md-auto'
    ]
]);

echo $responsiveButton->render();
```

**Características:**
- Usa clases responsive de Bootstrap
- Block en móvil, inline en escritorio
- Ancho completo en móvil, automático en escritorio

---

## Opciones Disponibles

### Opciones Principales

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `content` | string\|array | null | Contenido del botón (escapado) |
| `htmlContent` | string | null | HTML sin escapar (alternativa a content) |
| `variant` | string | 'primary' | Variante de color del botón |
| `outline` | bool | false | Si el botón tiene solo borde |
| `size` | string\|null | null | Tamaño del botón (sm, lg) |
| `block` | bool | false | Si ocupa todo el ancho |
| `active` | bool | false | Si está en estado activo |
| `disabled` | bool | false | Si está deshabilitado |
| `loading` | bool | false | Si muestra spinner de carga |
| `loadingText` | string | 'Cargando...' | Texto durante la carga |
| `icon` | string\|null | null | Clase del icono o HTML/SVG |
| `iconPosition` | string | 'start' | Posición del icono (start, end) |
| `type` | string | 'button' | Tipo de botón (button, submit, reset) |
| `attributes` | array | [] | Atributos HTML adicionales |
| `attributes.href` | string | - | Si se define, renderiza como `<a>` |

### Variantes Válidas

- `primary` - Azul
- `secondary` - Gris
- `success` - Verde
- `danger` - Rojo
- `warning` - Amarillo
- `info` - Celeste
- `light` - Blanco
- `dark` - Negro

---

## Clases de Bootstrap

### Botón Normal

```html
<button type="button" class="btn btn-{variant}">
    {content}
</button>
```

### Botón Outline

```html
<button type="button" class="btn btn-outline-{variant}">
    {content}
</button>
```

### Enlace con Apariencia de Botón

```html
<a href="{url}" class="btn btn-{variant}" role="button">
    {content}
</a>
```

### Con Tamaño

```html
<button class="btn btn-{variant} btn-{size}">
    {content}
</button>
```

### Con Loading

```html
<button class="btn btn-{variant}" disabled>
    <span class="spinner-border spinner-border-sm me-2" role="status"></span>
    {loadingText}
</button>
```

---

## Notas de Seguridad

### ⚠️ htmlContent

**NUNCA** usar con entrada de usuario no sanitizada:

```php
// ❌ PELIGROSO - Vulnerabilidad XSS
$button = new Button([
    'htmlContent' => $_POST['label']  // ❌ PELIGROSO
]);

// ✅ SEGURO - HTML confiable
$button = new Button([
    'htmlContent' => '<i class="fas fa-check"></i> Aceptar'  // ✅ SEGURO
]);
```

### ✅ content

Por defecto, `content` **siempre escapa** el HTML:

```php
// ✅ SEGURO - Automáticamente escapado
$button = new Button([
    'content' => $_POST['label']  // ✅ Se escapa automáticamente
]);
```

---

## Ejemplos de Uso Real

### Confirmar Eliminación

```php
$deleteBtn = new Button([
    'content' => 'Eliminar Usuario',
    'variant' => 'danger',
    'icon' => 'fas fa-trash',
    'attributes' => [
        'onclick' => 'return confirm("¿Seguro que deseas eliminar este usuario?")',
        'data-user-id' => $userId
    ]
]);

echo $deleteBtn->render();
```

### Botón de Descarga

```php
$downloadBtn = new Button([
    'content' => 'Descargar Reporte',
    'variant' => 'success',
    'icon' => 'fas fa-download',
    'attributes' => [
        'href' => '/reports/download/' . $reportId,
        'download' => 'reporte_' . date('Y-m-d') . '.pdf'
    ]
]);

echo $downloadBtn->render();
```

### Botón de Envío con Loading

```php
// HTML
<form id="myForm" action="/submit" method="POST">
    <?php
    $submitBtn = new Button([
        'content' => 'Guardar',
        'variant' => 'primary',
        'type' => 'submit',
        'attributes' => ['id' => 'submitBtn']
    ]);
    echo $submitBtn->render();
    ?>
</form>

// JavaScript
<script>
document.getElementById('myForm').addEventListener('submit', function() {
    const btn = document.getElementById('submitBtn');
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Guardando...';
});
</script>
```

### Navegación de Paginación

```php
$prevBtn = new Button([
    'content' => 'Anterior',
    'variant' => 'secondary',
    'outline' => true,
    'disabled' => $currentPage === 1,
    'attributes' => [
        'href' => '?page=' . ($currentPage - 1)
    ]
]);

$nextBtn = new Button([
    'content' => 'Siguiente',
    'variant' => 'secondary',
    'outline' => true,
    'disabled' => $currentPage === $totalPages,
    'attributes' => [
        'href' => '?page=' . ($currentPage + 1)
    ]
]);

echo $prevBtn->render() . ' ' . $nextBtn->render();
```

---

## Tips y Buenas Prácticas

### 1. Usar la Variante Correcta

```php
// ✅ Bueno - Variante apropiada
$save = new Button(['variant' => 'success', 'content' => 'Guardar']);
$delete = new Button(['variant' => 'danger', 'content' => 'Eliminar']);
$cancel = new Button(['variant' => 'secondary', 'content' => 'Cancelar']);

// ❌ Malo - Variante inapropiada
$delete = new Button(['variant' => 'success', 'content' => 'Eliminar']);
```

### 2. Botones vs Enlaces

```php
// ✅ Bueno - Enlace para navegación
$navBtn = new Button([
    'content' => 'Ver Perfil',
    'attributes' => ['href' => '/profile']
]);

// ✅ Bueno - Botón para acciones
$actionBtn = new Button([
    'content' => 'Guardar',
    'type' => 'submit'
]);

// ❌ Malo - Botón con onclick para navegar
$badNav = new Button([
    'content' => 'Ir a Perfil',
    'attributes' => ['onclick' => 'window.location="/profile"']
]);
```

### 3. Iconos Descriptivos

```php
// ✅ Bueno - Icono que complementa el texto
$save = new Button([
    'content' => 'Guardar',
    'icon' => 'fas fa-save'
]);

// ✅ Bueno - Solo icono con aria-label
$close = new Button([
    'htmlContent' => '<i class="fas fa-times"></i>',
    'variant' => 'danger',
    'attributes' => ['aria-label' => 'Cerrar']
]);
```

### 4. Estados de Loading

```php
// ✅ Bueno - Texto descriptivo durante la carga
$submit = new Button([
    'content' => 'Procesar Pago',
    'variant' => 'success',
    'loading' => $isProcessing,
    'loadingText' => 'Procesando pago...'
]);

// ❌ Malo - Sin feedback visual
$submit = new Button([
    'content' => 'Procesar Pago',
    'variant' => 'success'
]);
// No indica al usuario que está procesando
```

---

## Referencias

- **Componente**: [`Button.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Interface/Button.php)
- **Bootstrap Docs**: [Bootstrap 5.3 Buttons](https://getbootstrap.com/docs/5.3/components/buttons/)
