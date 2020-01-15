<?php

declare(strict_types=1);

require_once __DIR__ . '/autoload.php';

use Higgs\Frontend\Bootstrap\v5_3_3\Extras\Indicator;
use Higgs\Frontend\Bootstrap\v5_3_3\Layout\Col;

echo "=== PRUEBA: INDICATOR EN COL ===\n\n";

$stats = ['total' => 100];

// Reproducir EXACTAMENTE el código del usuario
echo "CASO DEL USUARIO:\n";
echo "-----------------\n\n";

try {
    $iTotal = new Indicator([
        'value' => $stats['total'],
        'label' => 'Total',
        'variant' => 'secondary'
    ]);

    echo "✓ Indicator creado\n";

    $colTotal = new Col([
        'md' => 2,
        'content' => $iTotal  // ❌ OBJETO sin render()
    ]);

    echo "✓ Col creado\n";

    $output = (string)$colTotal->render();
    echo "\nResultado (object como content):\n";
    echo "HTML: $output\n";
    echo "Longitud: " . strlen($output) . " caracteres\n\n";

    if (strlen($output) < 50) {
        echo "⚠️  PROBLEMA: Output demasiado corto, probablemente vacío\n\n";
    }
} catch (Exception $e) {
    echo "✗ ERROR: " . $e->getMessage() . "\n\n";
}

// SOLUCIÓN CORRECTA
echo "SOLUCIÓN CORRECTA:\n";
echo "------------------\n\n";

try {
    $iTotal2 = new Indicator([
        'value' => $stats['total'],
        'label' => 'Total',
        'variant' => 'secondary'
    ]);

    $colTotal2 = new Col([
        'md' => 2,
        'content' => $iTotal2->render()  // ✅ RENDERIZADO
    ]);

    $output2 = (string)$colTotal2->render();
    echo "HTML: $output2\n";
    echo "Longitud: " . strlen($output2) . " caracteres\n\n";

    if (strlen($output2) > 100) {
        echo "✅ Funciona correctamente!\n\n";
    }
} catch (Exception $e) {
    echo "✗ ERROR: " . $e->getMessage() . "\n\n";
}

echo "=== RESUMEN ===\n\n";
echo "❌ INCORRECTO: 'content' => \$iTotal\n";
echo "   El objeto Indicator NO se convierte a HTML automáticamente\n\n";
echo "✅ CORRECTO: 'content' => \$iTotal->render()\n";
echo "   Llamar ->render() convierte el objeto a TagInterface/HTML\n";
