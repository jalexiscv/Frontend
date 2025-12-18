<?php

/**
 * Ejemplo de uso de Html::raw()
 * 
 * Demuestra cómo usar Html::raw() para incluir contenido HTML
 * sin escapar en componentes Bootstrap.
 */

require_once __DIR__ . '/../autoload.php';

use Higgs\Html\Html;
use Higgs\Frontend\Frontend;

// 1. Inicializar Frontend Framework
$frontend = new Frontend('bootstrap', '5.3.3');
$bootstrap = $frontend->get_Builder();

echo "<!DOCTYPE html>\n";
echo "<html lang='es'>\n";
echo "<head>\n";
echo "    <meta charset='UTF-8'>\n";
echo "    <title>Ejemplo Html::raw()</title>\n";
echo "    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>\n";
echo "    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css' rel='stylesheet'>\n";
echo "</head>\n";
echo "<body class='p-5'>\n";
echo "    <div class='container'>\n";
echo "        <h1 class='mb-4'>Ejemplos de Html::raw()</h1>\n\n";

// ========================================
// Ejemplo 1: Botón con ícono HTML directo
// ========================================
echo "        <h2>Ejemplo 1: Botón con ícono (HTML directo)</h2>\n";
echo "        <div class='mb-4'>\n";

// ❌ MAL - El HTML se escapa
$buttonEscaped = $bootstrap->button([
    'content' => '<i class="fas fa-user"></i> Usuario',
    'variant' => 'primary'
])->render();
echo "            <p><strong>Sin Html::raw() (escapado):</strong></p>\n";
echo "            $buttonEscaped\n\n";

// ✅ BIEN - Usando Html::raw()
$icon = Html::raw('<i class="fas fa-user"></i>');
$buttonWithIcon = $bootstrap->button([
    'content' => [$icon, ' Usuario'],
    'variant' => 'success'
])->render();
echo "            <p class='mt-3'><strong>Con Html::raw() (correcto):</strong></p>\n";
echo "            $buttonWithIcon\n";
echo "        </div>\n\n";

// ========================================
// Ejemplo 2: Botones de acción con íconos
// ========================================
echo "        <h2>Ejemplo 2: Botones de acción</h2>\n";
echo "        <div class='mb-4'>\n";

$editIcon = Html::raw('<i class="fa-sharp fa-light fa-pen-to-square"></i>');
$deleteIcon = Html::raw('<i class="fas fa-trash"></i>');
$saveIcon = Html::raw('<i class="fas fa-save"></i>');

$editButton = $bootstrap->button([
    'content' => [$editIcon, ' Editar'],
    'variant' => 'warning',
    'size' => 'sm'
])->render();

$deleteButton = $bootstrap->button([
    'content' => [$deleteIcon, ' Eliminar'],
    'variant' => 'danger',
    'size' => 'sm'
])->render();

$saveButton = $bootstrap->button([
    'content' => [$saveIcon, ' Guardar'],
    'variant' => 'primary',
    'size' => 'sm'
])->render();

echo "            $editButton\n";
echo "            $deleteButton\n";
echo "            $saveButton\n";
echo "        </div>\n\n";

// ========================================
// Ejemplo 3: Alert con contenido HTML
// ========================================
echo "        <h2>Ejemplo 3: Alert con HTML formateado</h2>\n";
echo "        <div class='mb-4'>\n";

$htmlContent = Html::raw('<strong>¡Atención!</strong> Esta es una alerta con <em>contenido HTML</em> formateado.');
$alert = $bootstrap->alert([
    'content' => $htmlContent,
    'type' => 'warning',
    'dismissible' => true
])->render();

echo "            $alert\n";
echo "        </div>\n\n";

// ========================================
// Ejemplo 4: Badge con ícono
// ========================================
echo "        <h2>Ejemplo 4: Badge con ícono</h2>\n";
echo "        <div class='mb-4'>\n";

$notificationIcon = Html::raw('<i class="fas fa-bell"></i>');
$badge = $bootstrap->badge([
    'content' => [$notificationIcon, ' 5'],
    'variant' => 'danger'
])->render();

echo "            <p>Notificaciones: $badge</p>\n";
echo "        </div>\n\n";

// ========================================
// ADVERTENCIA DE SEGURIDAD
// ========================================
echo "        <div class='alert alert-danger' role='alert'>\n";
echo "            <h4 class='alert-heading'><i class='fas fa-exclamation-triangle'></i> Advertencia de Seguridad</h4>\n";
echo "            <p><strong>NUNCA</strong> uses <code>Html::raw()</code> con entrada de usuario sin sanitizar:</p>\n";
echo "            <pre><code class='text-danger'>// ⚠️ PELIGROSO - NUNCA HACER ESTO\n";
echo "\$userInput = \$_POST['html'];\n";
echo "\$unsafe = Html::raw(\$userInput); // Vulnerabilidad XSS\n";
echo "</code></pre>\n";
echo "            <p class='mb-0'>Solo usa <code>Html::raw()</code> con HTML hardcoded o confiable.</p>\n";
echo "        </div>\n\n";

echo "    </div>\n";
echo "</body>\n";
echo "</html>\n";
