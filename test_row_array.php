<?php

declare(strict_types=1);

require_once __DIR__ . '/autoload.php';

use Higgs\Frontend\Bootstrap\v5_3_3\Layout\Row;
use Higgs\Frontend\Bootstrap\v5_3_3\Layout\Col;
use Higgs\Frontend\Bootstrap\v5_3_3\Interface\Badge;

echo "=== PRUEBA: ROW CON ARRAY DE OBJETOS COL ===\n\n";

// ============================================
// TEST 1: Array de objetos Col SIN renderizar
// ============================================
echo "TEST 1: Array de objetos Col (sin renderizar)\n";
echo "----------------------------------------------\n";

$columns = [
    new Col([
        'md' => 2,
        'content' => 'Col 1'
    ]),
    new Col([
        'md' => 2,
        'content' => 'Col 2'
    ]),
    new Col([
        'md' => 2,
        'content' => 'Col 3'
    ])
];

try {
    $statsRow = new Row([
        'content' => $columns,
        'attributes' => ['class' => 'mb-4']
    ]);

    $result = $statsRow->render();
    echo "✓ Se creó sin errores\n";
    echo "Resultado: " . $result . "\n\n";
} catch (Exception $e) {
    echo "✗ ERROR: " . $e->getMessage() . "\n\n";
}

// ============================================
// TEST 2: Array de objetos Col YA renderizados
// ============================================
echo "TEST 2: Array de objetos Col (renderizados)\n";
echo "----------------------------------------------\n";

$columnsRendered = [
    (new Col([
        'md' => 2,
        'content' => 'Col 1'
    ]))->render(),
    (new Col([
        'md' => 2,
        'content' => 'Col 2'
    ]))->render(),
    (new Col([
        'md' => 2,
        'content' => 'Col 3'
    ]))->render()
];

try {
    $statsRow2 = new Row([
        'content' => $columnsRendered,
        'attributes' => ['class' => 'mb-4']
    ]);

    $result2 = $statsRow2->render();
    echo "✓ Se creó sin errores\n";
    echo "Resultado: " . $result2 . "\n\n";
} catch (Exception $e) {
    echo "✗ ERROR: " . $e->getMessage() . "\n\n";
}

// ============================================
// TEST 3: String concatenado (RECOMENDADO)
// ============================================
echo "TEST 3: String concatenado con htmlContent (RECOMENDADO)\n";
echo "---------------------------------------------------------\n";

$col1 = new Col(['md' => 2, 'content' => 'Col 1']);
$col2 = new Col(['md' => 2, 'content' => 'Col 2']);
$col3 = new Col(['md' => 2, 'content' => 'Col 3']);

$htmlContent = $col1->render() . $col2->render() . $col3->render();

try {
    $statsRow3 = new Row([
        'htmlContent' => $htmlContent,
        'attributes' => ['class' => 'mb-4']
    ]);

    $result3 = $statsRow3->render();
    echo "✓ Se creó sin errores\n";
    echo "Resultado: " . $result3 . "\n\n";
} catch (Exception $e) {
    echo "✗ ERROR: " . $e->getMessage() . "\n\n";
}

// ============================================
// TEST 4: Caso real del usuario con Indicator
// ============================================
echo "TEST 4: Caso del usuario (simulado con Badge)\n";
echo "-----------------------------------------------\n";

$stats = [
    'total' => 100,
    'queued' => 15,
    'processing' => 5,
    'completed' => 75,
    'failed' => 3,
    'cancelled' => 2
];

// Simulando con Badge en lugar de Indicator
$columns = [
    new Col([
        'md' => 2,
        'content' => (new Badge([
            'content' => "Total: {$stats['total']}",
            'variant' => 'secondary'
        ]))->render()
    ]),
    new Col([
        'md' => 2,
        'content' => (new Badge([
            'content' => "Cola: {$stats['queued']}",
            'variant' => 'info'
        ]))->render()
    ]),
    new Col([
        'md' => 2,
        'content' => (new Badge([
            'content' => "Proceso: {$stats['processing']}",
            'variant' => 'warning'
        ]))->render()
    ])
];

try {
    $statsRow4 = new Row([
        'content' => $columns,
        'attributes' => ['class' => 'mb-4']
    ]);

    $result4 = $statsRow4->render();
    echo "✓ Se creó sin errores\n";
    echo "Resultado: " . $result4 . "\n\n";
} catch (Exception $e) {
    echo "✗ ERROR: " . $e->getMessage() . "\n\n";
}

echo "=== FIN DE LAS PRUEBAS ===\n";
