<?php

/**
 * Test para verificar que Card funciona con htmlContent
 */

require_once __DIR__ . '/autoload.php';

use Higgs\Frontend\Frontend;

echo "========================================\n";
echo "VERIFICACIÓN DE htmlContent EN CARD\n";
echo "========================================\n\n";

$frontend = new Frontend('bootstrap', '5.3.3');
$bootstrap = $frontend->get_Builder();

// Test 1: Card con htmlContent
echo "Test 1: Card con htmlContent...\n";

$editBtn = $bootstrap->button([
    'content' => 'Guardar',
    'variant' => 'success',
    'icon' => 'fa-sharp fa-light fa-floppy-disk',
    'iconPosition' => 'start',
    'size' => 'sm'
]);

$deleteBtn = $bootstrap->button([
    'htmlContent' => '<i class="fa-sharp fa-light fa-pen-to-square"></i>Editar',
    'variant' => 'warning',
    'size' => 'sm'
]);

$card = $bootstrap->card([
    'headerTitle' => 'Producto #1234',
    'headerClass' => 'bg-primary text-white',
    'headerButtons' => [$editBtn, $deleteBtn],
    'htmlContent' => '<p>Descripción del producto con <strong>formato</strong> HTML.</p>',
    'footer' => 'Última actualización: hoy'
]);

$output = $card->render();

if (strpos($output, '<p>Descripción del producto con <strong>formato</strong> HTML.</p>') !== false) {
    echo "✅ PASÓ: El HTML en card NO fue escapado\n";
    echo "   Contenido encontrado: <p>...<strong>formato</strong>...</p>\n\n";
} else {
    echo "❌ FALLÓ: El HTML fue escapado\n";
    echo "   Salida: $output\n\n";
    exit(1);
}

// Test 2: Card con content normal (debe escapar)
echo "Test 2: Card con 'content' normal debe escapar HTML...\n";
$card2 = $bootstrap->card([
    'title' => 'Test',
    'content' => '<script>alert("XSS")</script>'
]);

$output2 = $card2->render();

if (strpos($output2, '&lt;script&gt;') !== false) {
    echo "✅ PASÓ: El contenido fue escapado correctamente\n";
    echo "   Encontrado: &lt;script&gt;\n\n";
} else {
    echo "❌ FALLÓ: El contenido NO fue escapado (VULNERABILIDAD)\n";
    echo "   Salida: $output2\n\n";
    exit(1);
}

echo "========================================\n";
echo "✨ TODOS LOS TESTS DE CARD PASARON\n";
echo "========================================\n\n";

echo "✅ Card ahora soporta htmlContent correctamente!\n";
