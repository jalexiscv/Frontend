<?php

/**
 * Test para verificar la estructura del header del Card
 */

require_once __DIR__ . '/autoload.php';

use Higgs\Frontend\Frontend;

echo "========================================\n";
echo "TEST: Estructura del Header de Card\n";
echo "========================================\n\n";

$frontend = new Frontend('bootstrap', '5.3.3');
$bootstrap = $frontend->get_Builder();

// Crear botones de ejemplo
$btnAdd = $bootstrap->button([
    'htmlContent' => '<i class="fas fa-plus"></i>',
    'variant' => 'primary',
    'size' => 'sm'
]);

$btnBack = $bootstrap->button([
    'htmlContent' => '<i class="fas fa-arrow-left"></i>',
    'variant' => 'primary',
    'size' => 'sm'
]);

// Crear card con header
$card = $bootstrap->card([
    'headerHtmlTitle' => 'Listado de <span class="text-muted">estudiantes</span>',
    'headerClass' => 'bg-light',
    'headerButtons' => [$btnAdd, $btnBack],
    'content' => 'Contenido del card'
]);

$output = $card->render();

echo "Verificando estructura del header:\n\n";

// Test 1: Verificar h5.card-title
if (strpos($output, '<h5 class="card-title mb-0">') !== false) {
    echo "✅ Título usa <h5 class=\"card-title mb-0\">\n";
} else {
    echo "❌ No se encontró h5.card-title mb-0\n";
}

// Test 2: Verificar btn-toolbar
if (strpos($output, 'class="btn-toolbar ms-auto"') !== false) {
    echo "✅ Botones usan btn-toolbar ms-auto\n";
} else {
    echo "❌ No se encontró btn-toolbar ms-auto\n";
}

// Test 3: Verificar btn-group
if (strpos($output, 'class="btn-group mx-0"') !== false) {
    echo "✅ Botones usan btn-group mx-0\n";
} else {
    echo "❌ No se encontró btn-group mx-0\n";
}

// Test 4: Verificar d-flex
if (strpos($output, 'd-flex justify-content-between align-items-center') !== false) {
    echo "✅ Container usa d-flex justify-content-between align-items-center\n";
} else {
    echo "❌ No se encontró d-flex\n";
}

echo "\n========================================\n";
echo "Estructura HTML generada:\n";
echo "========================================\n";
echo $output . "\n";
