<?php

declare(strict_types=1);

require_once __DIR__ . '/../autoload.php';

use Higgs\Frontend\Bootstrap\v5_3_3\Layout\Row;
use Higgs\Frontend\Bootstrap\v5_3_3\Layout\Col;

echo "ANÁLISIS: ¿Row acepta array de objetos Col?\n";
echo str_repeat("=", 60) . "\n\n";

// Crear columnas
$columns = [
    new Col(['md' => 2, 'content' => 'Col 1']),
    new Col(['md' => 2, 'content' => 'Col 2']),
    new Col(['md' => 2, 'content' => 'Col 3'])
];

// TEST 1: Pasar array de objetos Col directamente
echo "❌ FORMA INCORRECTA (array de objetos):\n";
echo "-" . str_repeat("-", 59) . "\n";
$row1 = new Row(['content' => $columns]);
$output1 = (string)$row1->render();
echo "Código: \$row = new Row(['content' => \$columns]);\n";
echo "Output: $output1\n";
echo "Longitud: " . strlen($output1) . " caracteres\n";
echo "Problema: Los objetos Col NO se convierten a HTML automáticamente\n\n";

// TEST 2: Renderizar cada Col y concatenar manualmente
echo "✅ FORMA CORRECTA (concatenar renders):\n";
echo "-" . str_repeat("-", 59) . "\n";
$htmlContent = '';
foreach ($columns as $col) {
    $htmlContent .= $col->render();
}
$row2 = new Row(['htmlContent' => $htmlContent]);
$output2 = (string)$row2->render();
echo "Código:\n";
echo "  \$html = '';\n";
echo "  foreach (\$columns as \$col) \$html .= \$col->render();\n";
echo "  \$row = new Row(['htmlContent' => \$html]);\n";
echo "Output: $output2\n";
echo "Longitud: " . strlen($output2) . " caracteres\n\n";

// TEST 3: Forma más corta con array_map
echo "✅ FORMA CORRECTA OPTIMIZADA (array_map):\n";
echo "-" . str_repeat("-", 59) . "\n";
$row3 = new Row([
    'htmlContent' => implode('', array_map(fn($col) => $col->render(), $columns))
]);
$output3 = (string)$row3->render();
echo "Código:\n";
echo "  \$row = new Row([\n";
echo "    'htmlContent' => implode('', array_map(\n";
echo "      fn(\$col) => \$col->render(), \$columns\n";
echo "    ))\n";
echo "  ]);\n";
echo "Output: $output3\n";
echo "Longitud: " . strlen($output3) . " caracteres\n\n";

// RECOMENDACIÓN FINAL
echo str_repeat("=", 60) . "\n";
echo "RECOMENDACIÓN PARA TU CÓDIGO:\n";
echo str_repeat("=", 60) . "\n\n";

echo "// Tu código actual (NO funcionará):\n";
echo "\$statsRow = new Row([\n";
echo "    'content' => \$columns  // ❌ Array de objetos\n";
echo "]);\n\n";

echo "// SOLUCIÓN 1: Renderizar en el array\n";
echo "\$columns = [\n";
echo "    (new Col([...]))->render(),  // ✅ Ya renderizado\n";
echo "    (new Col([...]))->render(),\n";
echo "    ...\n";
echo "];\n";
echo "\$statsRow = new Row([\n";
echo "    'htmlContent' => implode('', \$columns)\n";
echo "]);\n\n";

echo "// SOLUCIÓN 2: Renderizar después\n";
echo "\$columns = [\n";
echo "    new Col([...]),  // Objetos Col\n";
echo "    new Col([...]),\n";
echo "    ...\n";
echo "];\n";
echo "\$html = implode('', array_map(fn(\$c) => \$c->render(), \$columns));\n";
echo "\$statsRow = new Row(['htmlContent' => \$html]);\n";
