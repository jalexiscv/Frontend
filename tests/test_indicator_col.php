<?php

declare(strict_types=1);

require_once __DIR__ . '/../autoload.php';

use Higgs\Frontend\Bootstrap\v5_3_3\Layout\Col;

echo "=== ANÁLISIS: COL CON INDICATOR ===\n\n";

// Simulación de stats
$stats = ['total' => 100];

// TEST 1: Verificar si Indicator existe
echo "TEST 1: ¿Existe la clase Indicator?\n";
echo "-------------------------------------\n";
if (class_exists('Higgs\Frontend\Bootstrap\v5_3_3\Interface\Indicator')) {
    echo "✓ Indicator existe en Interface\n";
    $indicatorClass = 'Higgs\Frontend\Bootstrap\v5_3_3\Interface\Indicator';
} elseif (class_exists('Higgs\Frontend\Bootstrap\v5_3_3\Components\Indicator')) {
    echo "✓ Indicator existe en Components\n";
    $indicatorClass = 'Higgs\Frontend\Bootstrap\v5_3_3\Components\Indicator';
} elseif (class_exists('Higgs\Frontend\Bootstrap\v5_3_3\Content\Indicator')) {
    echo "✓ Indicator existe en Content\n";
    $indicatorClass = 'Higgs\Frontend\Bootstrap\v5_3_3\Content\Indicator';
} else {
    echo "✗ Indicator NO encontrado\n";
    echo "Buscando todas las clases disponibles...\n";

    // Listar archivos en Interface
    $files = glob(__DIR__ . '/src/Bootstrap/v5_3_3/Interface/*.php');
    echo "\nArchivos en Interface/:\n";
    foreach ($files as $file) {
        echo "- " . basename($file) . "\n";
    }

    $indicatorClass = null;
}

if ($indicatorClass) {
    echo "\nTEST 2: Crear Indicator\n";
    echo "-------------------------------------\n";
    try {
        $iTotal = new $indicatorClass([
            'value' => $stats['total'],
            'label' => 'Total',
            'variant' => 'secondary'
        ]);
        echo "✓ Indicator creado\n";
        echo "Tipo: " . get_class($iTotal) . "\n";

        echo "\nTEST 3: Renderizar Indicator solo\n";
        echo "-------------------------------------\n";
        $rendered = $iTotal->render();
        echo "Tipo de render: " . get_class($rendered) . "\n";
        echo "HTML: " . $rendered . "\n";

        echo "\nTEST 4: Indicator como objeto en Col\n";
        echo "-------------------------------------\n";
        $colTotal = new Col([
            'md' => 2,
            'content' => $iTotal  // ❌ Objeto sin renderizar
        ]);
        $result1 = (string)$colTotal->render();
        echo "Con objeto: " . $result1 . "\n";
        echo "Longitud: " . strlen($result1) . " caracteres\n";

        echo "\nTEST 5: Indicator renderizado en Col\n";
        echo "-------------------------------------\n";
        $colTotal2 = new Col([
            'md' => 2,
            'content' => $iTotal->render()  // ✅ Renderizado
        ]);
        $result2 = (string)$colTotal2->render();
        echo "Con render: " . $result2 . "\n";
        echo "Longitud: " . strlen($result2) . " caracteres\n";
    } catch (Exception $e) {
        echo "✗ ERROR: " . $e->getMessage() . "\n";
        echo "Trace: " . $e->getTraceAsString() . "\n";
    }
}

echo "\n=== FIN DEL ANÁLISIS ===\n";
