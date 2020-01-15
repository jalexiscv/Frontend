<?php

/**
 * Ejemplos de uso de htmlContent en Button
 * 
 * Demuestra el nuevo parámetro htmlContent que simplifica
 * el uso de HTML sin escape en botones.
 */

require_once __DIR__ . '/autoload.php';

use Higgs\Frontend\Frontend;

$frontend = new Frontend('bootstrap', '5.3.3');
$bootstrap = $frontend->get_Builder();

echo "<!DOCTYPE html>\n";
echo "<html lang='es'>\n";
echo "<head>\n";
echo "    <meta charset='UTF-8'>\n";
echo "    <title>Ejemplo htmlContent</title>\n";
echo "    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>\n";
echo "    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css' rel='stylesheet'>\n";
echo "</head>\n";
echo "<body class='p-5'>\n";
echo "    <div class='container'>\n";
echo "        <h1 class='mb-4'>Parámetro htmlContent - Ejemplos</h1>\n\n";

// ========================================
// Ejemplo 1: Comparación de métodos
// ========================================
echo "        <h2>Comparación: content vs htmlContent vs Html::raw()</h2>\n";
echo "        <div class='mb-4'>\n";
echo "            <table class='table table-bordered'>\n";
echo "                <thead><tr><th>Método</th><th>Código</th><th>Resultado</th></tr></thead>\n";
echo "                <tbody>\n";

// Método 1: content (escapado)
$btn1 = $bootstrap->button([
    'content' => '<i class="fas fa-user"></i> Usuario',
    'variant' => 'danger'
])->render();
echo "                    <tr>\n";
echo "                        <td><code>content</code> (escapado)</td>\n";
echo "                        <td><code>'content' => '&lt;i&gt;...&lt;/i&gt; Usuario'</code></td>\n";
echo "                        <td>$btn1</td>\n";
echo "                    </tr>\n";

// Método 2: htmlContent (sin escapar - CONVENIENTE)
$btn2 = $bootstrap->button([
    'htmlContent' => '<i class="fas fa-user"></i> Usuario',
    'variant' => 'success'
])->render();
echo "                    <tr>\n";
echo "                        <td><code>htmlContent</code> (sin escapar)</td>\n";
echo "                        <td><code>'htmlContent' => '&lt;i&gt;...&lt;/i&gt; Usuario'</code></td>\n";
echo "                        <td>$btn2</td>\n";
echo "                    </tr>\n";

// Método 3: Html::raw() (sin escapar - MÁS CONTROL)
use Higgs\Html\Html;

$icon = Html::raw('<i class="fas fa-user"></i>');
$btn3 = $bootstrap->button([
    'content' => [$icon, ' Usuario'],
    'variant' => 'primary'
])->render();
echo "                    <tr>\n";
echo "                        <td><code>Html::raw()</code> manual</td>\n";
echo "                        <td><code>Html::raw('&lt;i&gt;...&lt;/i&gt;')</code></td>\n";
echo "                        <td>$btn3</td>\n";
echo "                    </tr>\n";
echo "                </tbody>\n";
echo "            </table>\n";
echo "        </div>\n\n";

// ========================================
// Ejemplo 2: Botones de acción con htmlContent
// ========================================
echo "        <h2>Botones de CRUD con htmlContent</h2>\n";
echo "        <div class='mb-4'>\n";

$editBtn = $bootstrap->button([
    'htmlContent' => '<i class="fa-sharp fa-light fa-pen-to-square"></i> Editar',
    'variant' => 'warning',
    'size' => 'sm'
])->render();

$deleteBtn = $bootstrap->button([
    'htmlContent' => '<i class="fas fa-trash"></i> Eliminar',
    'variant' => 'danger',
    'size' => 'sm'
])->render();

$saveBtn = $bootstrap->button([
    'htmlContent' => '<i class="fas fa-save"></i> Guardar',
    'variant' => 'success',
    'size' => 'sm'
])->render();

echo "            $editBtn\n";
echo "            $deleteBtn\n";
echo "            $saveBtn\n";
echo "        </div>\n\n";

// ========================================
// Ejemplo 3: Caso de uso real
// ========================================
echo "        <h2>Caso de Uso: Card con botones de acción</h2>\n";
echo "        <div class='mb-4'>\n";

$headerButtons = [
    $bootstrap->button([
        'htmlContent' => '<i class="fa-sharp fa-light fa-floppy-disk"></i>',
        'variant' => 'success',
        'size' => 'sm',
        'attributes' => ['title' => 'Guardar']
    ]),
    $bootstrap->button([
        'htmlContent' => '<i class="fa-sharp fa-light fa-pen-to-square"></i>',
        'variant' => 'warning',
        'size' => 'sm',
        'attributes' => ['title' => 'Editar']
    ])
];

$card = $bootstrap->card([
    'headerTitle' => 'Producto #1234',
    'headerClass' => 'bg-primary text-white',
    'headerButtons' => $headerButtons,
    'content' => '<p>Descripción del producto con detalles importantes.</p>',
    'footer' => 'Última actualización: hoy'
])->render();

echo "            $card\n";
echo "        </div>\n\n";

// ========================================
// ADVERTENCIA DE SEGURIDAD
// ========================================
echo "        <div class='alert alert-danger' role='alert'>\n";
echo "            <h4 class='alert-heading'><i class='fas fa-exclamation-triangle'></i> Advertencia de Seguridad</h4>\n";
echo "            <p><strong>NUNCA</strong> uses <code>htmlContent</code> con entrada de usuario sin sanitizar:</p>\n";
echo "            <pre><code class='text-danger'>// ⚠️ PELIGROSO - Vulnerabilidad XSS\n";
echo "\$userInput = \$_POST['html'];\n";
echo "\$unsafe = \$bootstrap->button(['htmlContent' => \$userInput]); // ❌ NO HACER\n";
echo "</code></pre>\n";
echo "            <p><strong>Razón de diseño:</strong> El parámetro <code>htmlContent</code> requiere que el desarrollador\n";
echo "            declare <em>explícitamente</em> que el HTML es confiable, evitando conversiones automáticas que\n";
echo "            podrían introducir vulnerabilidades XSS accidentalmente.</p>\n";
echo "            <p class='mb-0'>Solo usa <code>htmlContent</code> con HTML hardcoded o sanitizado apropiadamente.</p>\n";
echo "        </div>\n\n";

echo "    </div>\n";
echo "</body>\n";
echo "</html>\n";
