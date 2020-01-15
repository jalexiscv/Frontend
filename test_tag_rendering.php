<?php

require_once __DIR__ . '/autoload.php';

use Higgs\Frontend\Bootstrap\v5_3_3\Interface\Card;

echo "========================================\n";
echo "VERIFICACIÓN DE RENDERIZADO DE ETIQUETAS\n";
echo "========================================\n\n";

try {
    $card = new Card(['title' => 'Test Card']);
    $output = $card->render();

    echo "Output inicial: " . substr($output, 0, 50) . "...\n\n";

    if (strpos($output, '<div class="card"') === 0) {
        echo "✅ ÉXITO: La tarjeta se renderiza como <div ...>\n";
    } elseif (strpos($output, '<bs5-div class="card"') === 0) {
        echo "❌ FALLO: La tarjeta se renderiza como <bs5-div ...>\n";
        exit(1);
    } else {
        echo "⚠️  ADVERTENCIA: Renderizado inesperado.\n";
        exit(1);
    }
} catch (\Throwable $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
