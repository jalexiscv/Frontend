# Ejemplos: Componente Alert

Componente Alert de Bootstrap 5.3.3 para mostrar mensajes y notificaciones.

---

## Ejemplo 1: Alert Básico

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Interface\Alert;

$alert = new Alert([
    'content' => 'Esta es una alerta básica con información importante.'
]);

echo $alert->render();
```

**Características:**
- Tipo por defecto: `primary`
- Contenido escapado automáticamente
- Sin ícono ni botón de cierre

---

## Ejemplo 2: Alert con Icono (Font Awesome)

```php
$alert = new Alert([
    'type' => 'success',
    'icon' => 'fas fa-check-circle',
    'content' => '¡Operación completada exitosamente!'
]);

echo $alert->render();
```

**Características:**
- Icono a la izquierda
- Usa `d-flex align-items-center`
- Compatible con Font Awesome, Bootstrap Icons, etc.
- Icono con`flex-shrink-0 me-2`

---

## Ejemplo 3: Alert con Icono SVG (Bootstrap Icons)

```php
$icon = '<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:">
    <use xlink:href="#info-fill"></use>
</svg>';

$alert = new Alert([
    'type' => 'info',
    'icon' => $icon,
    'content' => 'Información importante con icono SVG'
]);

echo $alert->render();
```

**Características:**
- Soporte para SVG personalizado
- Bootstrap Icons inline
- HTML del icono se inyecta directamente

---

## Ejemplo 4: Alerts con Diferentes Tipos

```php
// Success
$success = new Alert([
    'type' => 'success',
    'content' => '¡Operación completada exitosamente!'
]);

// Danger
$danger = new Alert([
    'type' => 'danger',
    'content' => 'Error: No se pudo completar la operación.'
]);

// Warning
$warning = new Alert([
    'type' => 'warning',
    'content' => 'Advertencia: Revisa los datos antes de continuar.'
]);

// Info
$info = new Alert([
    'type' => 'info',
    'content' => 'Información: El sistema se actualizará en 10 minutos.'
]);

echo $success->render();
echo $danger->render();
echo $warning->render();
echo $info->render();
```

**Tipos disponibles:**
- `primary` - Azul (por defecto)
- `secondary` - Gris
- `success` - Verde ✅
- `danger` - Rojo ❌
- `warning` - Amarillo ⚠️
- `info` - Celeste ℹ️
- `light` - Blanco
- `dark` - Negro

---

## Ejemplo 3: Alert Dismissible (Cerrable)

```php
$alert = new Alert([
    'type' => 'warning',
    'content' => 'Este mensaje se puede cerrar haciendo clic en la X.',
    'dismissible' => true
]);

echo $alert->render();
```

**Características:**
- Botón X en la esquina superior derecha
- Se cierra con JavaScript de Bootstrap
- Animación de fade out

---

## Ejemplo 4: Alert con htmlContent

```php
$alert = new Alert([
    'type' => 'success',
    'htmlContent' => '<strong>¡Éxito!</strong> Tu cuenta ha sido creada. 
        <a href="/login" class="alert-link">Inicia sesión aquí</a>.'
]);

echo $alert->render();
```

**Características:**
- Usa `htmlContent` para HTML sin escapar
- Permite formato personalizado y enlaces
- ⚠️ **Advertencia**: Solo con HTML confiable

---

## Ejemplo 5: Alert con Ícono

```php
$alert = new Alert([
    'type' => 'info',
    'htmlContent' => '<i class="fas fa-info-circle me-2"></i>
        <strong>Información importante:</strong> El sistema estará en mantenimiento mañana.'
]);

echo $alert->render();
```

**Características:**
- Ícono de Font Awesome
- Combina ícono con texto
- Espaciado con `me-2`

---

## Ejemplo 6: Alert con Heading

```php
$alert = new Alert([
    'type' => 'danger',
    'htmlContent' => '<h4 class="alert-heading">¡Error crítico!</h4>
        <p>No se pudo conectar con la base de datos.</p>
        <hr>
        <p class="mb-0">Por favor, contacta al administrador del sistema.</p>'
]);

echo $alert->render();
```

**Características:**
- Usa clase `alert-heading` para el título
- Puede incluir múltiples párrafos
- Línea separadora con `<hr>`

---

## Ejemplo 7: Alert con Lista

```php
$alert = new Alert([
    'type' => 'warning',
    'htmlContent' => '<strong>Errores de validación:</strong>
        <ul class="mb-0 mt-2">
            <li>El campo email es requerido</li>
            <li>La contraseña debe tener al menos 8 caracteres</li>
            <li>Debes aceptar los términos y condiciones</li>
        </ul>'
]);

echo $alert->render();
```

**Características:**
- Lista de errores o mensajes
- `mb-0` para eliminar margen inferior
- Ideal para validación de formularios

---

## Ejemplo 8: Alert con Atributos Personalizados

```php
$alert = new Alert([
    'type' => 'success',
    'content' => 'Operación exitosa.',
    'dismissible' => true,
    'attributes' => [
        'class' => 'shadow-sm border-0',
        'data-auto-dismiss' => '5000',
        'id' => 'success-alert'
    ]
]);

echo $alert->render();
```

**Características:**
- Clases CSS adicionales
- Data attributes para JavaScript
- ID personalizado

---

## Ejemplo 9: Alert de Confirmación con Botones

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Interface\Button;

$yesBtn = new Button([
    'content' => 'Sí, eliminar',
    'variant' => 'danger',
    'size' => 'sm'
]);

$noBtn = new Button([
    'content' => 'Cancelar',
    'variant' => 'secondary',
    'size' => 'sm'
]);

$alert = new Alert([
    'type' => 'warning',
    'htmlContent' => '<div class="d-flex justify-content-between align-items-center">
        <div>
            <i class="fas fa-exclamation-triangle me-2"></i>
            ¿Estás seguro de que deseas eliminar este elemento?
        </div>
        <div class="btn-group ms-3">
            ' . $yesBtn->render() . '
            ' . $noBtn->render() . '
        </div>
    </div>'
]);

echo $alert->render();
```

**Características:**
- Alert interactivo con botones
- Layout flex para distribución
- Útil para confirmaciones

---

## Ejemplo 10: Alert de Progreso

```php
$alert = new Alert([
    'type' => 'info',
    'htmlContent' => '<div class="mb-2">
            <strong>Subiendo archivo...</strong>
        </div>
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" 
                 role="progressbar" 
                 style="width: 75%" 
                 aria-valuenow="75" 
                 aria-valuemin="0" 
                 aria-valuemax="100">
                75%
            </div>
        </div>'
]);

echo $alert->render();
```

**Características:**
- Incluye barra de progreso
- Progress bar animada
- Útil para uploads o procesos largos

---

## Ejemplo 11: Alert Compacto

```php
$alert = new Alert([
    'type' => 'success',
    'content' => '✓ Guardado',
    'attributes' => [
        'class' => 'd-inline-block px-3 py-2'
    ]
]);

echo $alert->render();
```

**Características:**
- Alert pequeño e inline
- Padding reducido
- Ideal para notificaciones discretas

---

## Ejemplo 12: Múltiples Alerts (Notification Stack)

```php
$alerts = [
    [
        'type' => 'success',
        'content' => 'Usuario creado correctamente.',
        'dismissible' => true
    ],
    [
        'type' => 'info',
        'content' => 'Se ha enviado un email de confirmación.',
        'dismissible' => true
    ],
    [
        'type' => 'warning',
        'content' => 'Recuerda verificar tu email en las próximas 24 horas.',
        'dismissible' => true
    ]
];

echo '<div class="notification-stack position-fixed top-0 end-0 p-3" style="z-index: 1050;">';
foreach ($alerts as $alertData) {
    $alert = new Alert($alertData);
    echo '<div class="mb-2">' . $alert->render() . '</div>';
}
echo '</div>';
```

**Características:**
- Stack de notificaciones
- Posicionadas en esquina superior derecha
- Todas dismissibles

---

## Ejemplo 13: Alert con Cuenta Regresiva

```php
$alert = new Alert([
    'type' => 'warning',
    'htmlContent' => '<div class="d-flex justify-content-between align-items-center">
        <span>
            <i class="fas fa-clock me-2"></i>
            Esta sesión expirará en <strong id="countdown">5:00</strong> minutos
        </span>
        <button class="btn btn-warning btn-sm" onclick="extendSession()">
            Extender sesión
        </button>
    </div>
    <script>
        let timeLeft = 300; // 5 minutos en segundos
        const countdown = document.getElementById("countdown");
        
        setInterval(() => {
            if (timeLeft > 0) {
                timeLeft--;
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                countdown.textContent = minutes + ":" + (seconds < 10 ? "0" : "") + seconds;
            }
        }, 1000);
    </script>'
]);

echo $alert->render();
```

**Características:**
- Cuenta regresiva en tiempo real
- JavaScript embebido
- Botón interactivo

---

## Opciones Disponibles

### Opciones Principales

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `content` | string | null | Contenido del alert (escapado) |
| `htmlContent` | string | null | HTML sin escapar (alternativa a content) |
| `type` | string | 'primary' | Tipo/color del alert |
| `icon` | string | null | Clase de ícono o HTML/SVG del ícono |
| `dismissible` | bool | false | Si el alert es cerrable |
| `attributes` | array | [] | Atributos HTML adicionales |

### Tipos Válidos

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

### Clases Base

```html
<div class="alert alert-{type}" role="alert">
    {content}
</div>
```

### Si es Dismissible

```html
<div class="alert alert-{type} alert-dismissible fade show" role="alert">
    {content}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
```

### Clases Útiles

- `alert-heading` - Para títulos dentro del alert
- `alert-link` - Para enlaces con color apropiado
- `border-0` - Sin borde
- `shadow` - Sombra

---

## Validación

El componente valida:

1. ✅ El tipo debe ser uno de los 8 tipos válidos
2. ✅ Si el tipo es inválido, lanza `InvalidArgumentException`

**Ejemplo de error:**
```php
// ❌ Esto lanzará InvalidArgumentException
$alert = new Alert([
    'type' => 'custom',  // ❌ Tipo inválido
    'content' => 'Mensaje'
]);
```

---

## Notas de Seguridad

### ⚠️ htmlContent

**NUNCA** usar con entrada de usuario no sanitizada:

```php
// ❌ PELIGROSO - Vulnerabilidad XSS
$alert = new Alert([
    'htmlContent' => $_POST['message']  // ❌ PELIGROSO
]);

// ✅ SEGURO - HTML confiable
$alert = new Alert([
    'htmlContent' => '<strong>Éxito:</strong> Operación completada.'  // ✅ SEGURO
]);
```

### ✅ content

Por defecto, `content` **siempre escapa** el HTML:

```php
// ✅ SEGURO - Automáticamente escapado
$alert = new Alert([
    'content' => $_POST['message']  // ✅ Se escapa automáticamente
]);
```

---

## Ejemplos de Uso Real

### Mensajes Flash (Sesión)

```php
if (isset($_SESSION['success'])) {
    $alert = new Alert([
        'type' => 'success',
        'content' => $_SESSION['success'],
        'dismissible' => true
    ]);
    echo $alert->render();
    unset($_SESSION['success']);
}

if (isset($_SESSION['error'])) {
    $alert = new Alert([
        'type' => 'danger',
        'content' => $_SESSION['error'],
        'dismissible' => true
    ]);
    echo $alert->render();
    unset($_SESSION['error']);
}
```

### Validación de Formulario

```php
if (!empty($errors)) {
    $errorList = '<ul class="mb-0">';
    foreach ($errors as $error) {
        $errorList .= "<li>{$error}</li>";
    }
    $errorList .= '</ul>';
    
    $alert = new Alert([
        'type' => 'danger',
        'htmlContent' => '<strong>Errores de validación:</strong>' . $errorList,
        'dismissible' => true
    ]);
    
    echo $alert->render();
}
```

### Confirmación de Acción

```php
if ($accountCreated) {
    $alert = new Alert([
        'type' => 'success',
        'htmlContent' => '<h4 class="alert-heading">¡Cuenta creada!</h4>
            <p>Tu cuenta ha sido creada exitosamente.</p>
            <hr>
            <p class="mb-0">
                Hemos enviado un email de confirmación a <strong>' . htmlspecialchars($email) . '</strong>.
                Por favor, verifica tu bandeja de entrada.
            </p>',
        'dismissible' => true
    ]);
    
    echo $alert->render();
}
```

### Estado del Sistema

```php
if ($maintenanceMode) {
    $alert = new Alert([
        'type' => 'warning',
        'htmlContent' => '<div class="d-flex align-items-center">
            <i class="fas fa-tools fa-2x me-3"></i>
            <div>
                <strong>Modo de mantenimiento</strong><br>
                El sistema estará en mantenimiento el ' . $maintenanceDate . ' de ' . $maintenanceTime . '.
            </div>
        </div>',
        'attributes' => ['class' => 'border-start border-5 border-warning']
    ]);
    
    echo $alert->render();
}
```

---

## Tips y Buenas Prácticas

### 1. Usar el Tipo Correcto

```php
// ✅ Bueno - Tipo apropiado
$success = new Alert(['type' => 'success', 'content' => 'Guardado']);
$error = new Alert(['type' => 'danger', 'content' => 'Error']);
$warning = new Alert(['type' => 'warning', 'content' => 'Advertencia']);

// ❌ Malo - Tipo inapropiado
$error = new Alert(['type' => 'success', 'content' => 'Error grave']);
```

### 2. Mensajes Dismissibles para UX

```php
// ✅ Bueno - Usuario puede cerrar
$alert = new Alert([
    'content' => 'Archivo subido correctamente.',
    'dismissible' => true
]);

// ❌ Malo - Mensaje que debería poder cerrarse pero no puede
$alert = new Alert([
    'content' => 'Email enviado.',
    'dismissible' => false  // Usuario no puede cerrar
]);
```

### 3. Usar alert-heading

```php
// ✅ Bueno - Estructura clara
$alert = new Alert([
    'type' => 'info',
    'htmlContent' => '<h4 class="alert-heading">Información</h4>
        <p>Contenido detallado...</p>'
]);

// ❌ Malo - Todo en el mismo nivel
$alert = new Alert([
    'type' => 'info',
    'htmlContent' => '<strong>Información</strong> Contenido...'
]);
```

---

## Referencias

- **Componente**: [`Alert.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Interface/Alert.php)
- **Estándares**: [`COMPONENT_STANDARDS.md`](file:///c:/xampp/htdocs/system/Frontend/COMPONENT_STANDARDS.md)
- **Bootstrap Docs**: [Bootstrap 5.3 Alerts](https://getbootstrap.com/docs/5.3/components/alerts/)
