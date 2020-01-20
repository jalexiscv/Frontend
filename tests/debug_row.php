<?php

declare(strict_types=1);

require_once __DIR__ . '/../autoload.php';

use Higgs\Frontend\Bootstrap\v5_3_3\Layout\Row;

echo "=== ANÁLISIS PROFUNDO DE ROW ===\n\n";

// Test 1: Crear Row
echo "1. Creando Row...\n";
$row = new Row([
    'content' => 'Contenido de la fila'
]);

echo "Row creado correctamente\n";
echo "Tipo de \$row: " . get_class($row) . "\n\n";

// Test 2: Llamar render()
echo "2. Llamando render()...\n";
$result = $row->render();

echo "Render ejecutado\n";
echo "Tipo de resultado: " . get_class($result) . "\n";
echo "¿Es TagInterface?: " . ($result instanceof Higgs\Html\Tag\TagInterface ? 'SÍ' : 'NO') . "\n\n";

// Test 3: Ver métodos disponibles
echo "3. Métodos disponibles en el resultado:\n";
$methods = get_class_methods($result);
echo "Métodos: " . implode(', ', array_slice($methods, 0, 10)) . "...\n\n";

// Test 4: Intentar convertir a string
echo "4. Convertir a string:\n";
try {
    $string = (string)$result;
    echo "String length: " . strlen($string) . "\n";
    echo "String content: " . $string . "\n\n";
} catch (Exception $e) {
    echo "ERROR al convertir: " . $e->getMessage() . "\n\n";
}

// Test 5: Verificar si tiene __toString
echo "5. ¿Tiene método __toString()?: ";
echo method_exists($result, '__toString') ? 'SÍ' : 'NO';
echo "\n\n";

// Test 6: Usar var_dump
echo "6. var_dump del resultado:\n";
var_dump($result);
echo "\n\n";

// Test 7: Test directo con echo
echo "7. Echo directo del resultado:\n";
echo "INICIO->";
echo $result;
echo "<-FIN\n\n";

echo "=== FIN DEL ANÁLISIS ===\n";
