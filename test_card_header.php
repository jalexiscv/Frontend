<?php

/**
 * Test para verificar headerHtmlTitle en Card
 */

require_once __DIR__ . '/autoload.php';

use Higgs\Frontend\Frontend;

echo "========================================\n";
echo "TEST: headerHtmlTitle en Card\n";
echo "========================================\n\n";

$frontend = new Frontend('bootstrap', '5.3.3');
$bootstrap = $frontend->get_Builder();

// Test: headerHtmlTitle con HTML
echo "Test: Card con headerHtmlTitle...\n";

$version = "1.2.3";
$card = $bootstrap->card([
    'headerHtmlTitle' => "Módulo Plex <span class='text-muted'>v{$version}</span>",
    'htmlContent' => '<p>Contenido del <strong>card</strong>.</p>',
]);

$output = $card->render();

if (strpos($output, "<span class='text-muted'>v{$version}</span>") !== false) {
    echo "✅ PASÓ: El HTML en headerHtmlTitle NO fue escapado\n";
    echo "   Encontrado: <span class='text-muted'>v1.2.3</span>\n\n";
} else {
    echo "❌ FALLÓ: El HTML fue escapado\n";
    echo "   Salida: $output\n\n";
    exit(1);
}

// Test 2: headerTitle normal (debe escapar)
echo "Test 2: headerTitle normal debe escapar...\n";
$card2 = $bootstrap->card([
    'headerTitle' => "<script>alert('XSS')</script>Título",
    'content' => 'Contenido'
]);

$output2 = $card2->render();

if (strpos($output2, '&lt;script&gt;') !== false) {
    echo "✅ PASÓ: El HTML en headerTitle fue escapado\n";
    echo "   Encontrado: &lt;script&gt;\n\n";
} else {
    echo "❌ FALLÓ: El HTML NO fue escapado (VULNERABILIDAD)\n";
    echo "   Salida: $output2\n\n";
    exit(1);
}

echo "========================================\n";
echo "✨ TODOS LOS TESTS PASARON\n";
echo "========================================\n\n";

echo "✅ Ahora puedes usar:\n";
echo "   'headerTitle' => 'Texto' (escapado)\n";
echo "   'headerHtmlTitle' => '<span>HTML</span>' (sin escapar)\n";
